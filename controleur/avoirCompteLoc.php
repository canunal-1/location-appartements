<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/occuperBD.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/notificationBD.php";

$auth = new authentification();

$id_dem = $_GET["id_dem"]; 

// Récupération des données POST
if (isset($_POST["mailLoc"]) && isset($_POST["mdpLoc"])) {
    $mailLoc = $_POST['mailLoc'];
    $mdpLoc = $_POST['mdpLoc'];

    $locataireBD = new locataireBD();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);
    $id_locataire = $locataire->getIdLoc();

    if (!$locataire) {
        $erreur = "Le mail et le mot de passe saisis sont incorrects ou inexistants !";
    } else {
        $connexionReussie = $auth->loginLoc($mailLoc, $mdpLoc);
        if (!$connexionReussie) {
            // Définissez un message d'erreur
            $erreur = "Le mail et le mot de passe saisis sont incorrects ou inexistants !";
        }
    }
}

if ($auth->isLoggedOnLoc()) {

    $demandeurBD = new demandeurBD();
    $demandeur = $demandeurBD->getDemandeurById($id_dem);
    $id_appartement = $demandeur->getIdApparteDem();

    $occuper = new occuper($id_appartement, $id_locataire);
    $occuperBD = new occuperBD();
    $occuperBD->addOccuper($occuper);
    $appartementBD = new appartementBD();
    $appartement = $appartementBD->getApparteById($id_appartement);
    $prixTTC = $appartement->getPrixLoc() + $appartement->getPrixCharg();
    $notificationBD = new notificationBD();
    $notificationBD->deleteNotificationByIdDem($id_dem);
    $demandeurBD->deleteDemandeur($id_dem);

    include "$racine/vue/vueConfirmeInscriptionLoc.php";
} else {
    // L'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    $titre = "Connexion";
    include "$racine/vue/vueLocataire.php";
}
?>