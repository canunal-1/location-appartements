<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/demandeur.php";

$auth = new authentification();

// Récupération des données POST
if (isset($_POST["code_dem"])) {
    $code_dem = $_POST['code_dem'];

    $demandeurBD = new demandeurBD();
    $demandeur = $demandeurBD->getDemandeurByCode($code_dem);
    $connexionReussie = $auth->loginDem($code_dem);
        if (!$connexionReussie) {
            // Définissez un message d'erreur
            echo "Le code saisie est incorrect ou inexistant !";
        }
    }

if ($auth->isLoggedOnDEM()) {
    header("Location: ./?action=profil");
} else {
    // L'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    $titre = "Connexion";
    include "$racine/vue/vueDemandeur.php";
}
?>