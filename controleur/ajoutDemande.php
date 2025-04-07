<?php
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/notificationBD.php";

$auth = new authentification();
$demandeurBD = new demandeurBD();
$id_appartement = $_GET['id_appartement'];

if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["adresse"]) && !empty($_POST["ville"]) && !empty($_POST["codeville"]) && !empty($_POST["telephone"])) {

    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $ville = $_POST["ville"];
    $codeville = $_POST["codeville"];
    $telephone = $_POST["telephone"];
    $code_dem = $demandeurBD->genererCodeAleatoire(10);

    // Création d'un objet demandeur
    $demandeur = new demandeur(NULL, $nom, $prenom, $adresse, $ville, $codeville, $telephone, $code_dem, NULL, $id_appartement);

    // Ajout du visiteur dans la base de données
    $nouveauDem = $demandeurBD->addDemandeur($demandeur);

    if ($nouveauDem) {
        // Récupération de l'ID de l'appartement nouvellement ajouté
        $id_dem = $nouveauDem->getID();

        $appartementBD = new appartementBD();

        $appartement = $appartementBD->getApparteById($id_appartement);

        $id_proprietaire = $appartement->getIdProprio();

        $message = "Vous avez une demande sur l'appartement à " . $appartement->getVille();
        $date_notif = date("Y-m-d H:i:s");
        $notification = new notification(NULL, $message, $date_notif, $id_proprietaire, $id_dem);
        $notificationBD = new notificationBD();
        $notificationBD->addNotif($notification);

        // Utilisation de la fonction header() pour rediriger l'utilisateur
        header("Location: ?action=profilDem&id_dem=" . $id_dem);

        exit(); // Arrêt de l'exécution du script après la redirection
    } else {
        echo "Erreur : ajout non réussi. Veuillez réessayer.";
        // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message d'erreur
    }
}

include "$racine/vue/vueFormulaireDemande.php";
?>