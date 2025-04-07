<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/locataire.php";

$auth = new authentification();

// Récupération des données POST
if (isset($_POST["mailLoc"]) && isset($_POST["mdpLoc"])) {
    $mailLoc = $_POST['mailLoc'];
    $mdpLoc = $_POST['mdpLoc'];

    $locataireBD = new locataireBD();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);

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
    include "accueil.php";
} else {
    // L'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    $titre = "Connexion";
    include "$racine/vue/vueLocataire.php";
}
?>