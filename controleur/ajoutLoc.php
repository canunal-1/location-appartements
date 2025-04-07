<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/proprietaire.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/appartement.php";

$appartementBD = new appartementBD();
$proprietaireBD = new proprietaireBD();
$auth = new authentification();

$mail = $auth->getMailLoggedOn();
$proprietaire = $proprietaireBD->getProprioByMail($mail);
$id_proprietaire = $proprietaire->getId();


// Vérification si tous les champs sont définis et non vides
if (!empty($_POST["villeAppart"]) && !empty($_POST["rue"]) && !empty($_POST["arrondissement"]) && !empty($_POST["etage"]) && !empty($_POST["type"]) && !empty($_POST["prix_loc"]) && !empty($_POST["prix_charg"]) && !empty($_POST["date_libre"])) {

            // Récupération des données du formulaire
            $villeAppart = $_POST["villeAppart"];
            $rue = $_POST["rue"];
            $arrondissement = $_POST["arrondissement"];
            $etage = intval($_POST["etage"]);
            $type = $_POST["type"];
            $prix_loc = $_POST["prix_loc"];
            $prix_charg = $_POST["prix_charg"];
            $ascenseur = isset($_POST["ascenseur"]) ? 1 : 0;
            $preavis = isset($_POST["preavis"]) ? 1 : 0;
            $date_libre = $_POST["date_libre"];

            // Création d'un objet visiteur
            $appartement = new appartement(NULL, $villeAppart, $rue, $arrondissement, $etage, $type, $prix_loc, $prix_charg, $ascenseur, $preavis, $date_libre, $id_proprietaire);

            // Ajout du visiteur dans la base de données
            $nouveauApparte = $appartementBD->addAppart($appartement);

            if ($nouveauApparte) {
                // Récupération de l'ID de l'appartement nouvellement ajouté
                $id_appartement = $nouveauApparte->getID();
                
                // Redirection vers la page d'ajout d'image avec l'ID de l'appartement
                header("Location: ./?action=ajoutImage&id_appartement=" . $id_appartement);
                exit(); // Arrêt de l'exécution du script après la redirection
            } else {
                echo "Erreur : ajout non réussi. Veuillez réessayer.";
                // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou afficher un message d'erreur
            }
        }



$titre = "Ajout - Réservation d'Appartements";
include "$racine/vue/vueAjoutLoc.php";
?>