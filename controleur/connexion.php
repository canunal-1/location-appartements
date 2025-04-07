<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/proprietaire.php";

$auth = new authentification();

// Récupération des données POST
if (isset($_POST["email"]) && isset($_POST["mdp"])) {
    $mail = $_POST['email'];
    $mdp = $_POST['mdp'];

    $proprietaireBD = new proprietaireBD();
    $proprietaire = $proprietaireBD->getProprioByMail($mail);

    if (!$proprietaire) {
        $erreur = "Le mail et le mot de passe saisis sont incorrects ou inexistants !";
    } else {
        $connexionReussie = $auth->login($mail, $mdp);
        if (!$connexionReussie) {
            // Définissez un message d'erreur
            $erreur = "Le mail et le mot de passe saisis sont incorrects ou inexistants !";
        }
    }
}

if ($auth->isLoggedOn()) {
    include "accueil.php";
} else {
    // L'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    $titre = "Connexion";
    include "$racine/vue/vueProprietaire.php";
}
?>
