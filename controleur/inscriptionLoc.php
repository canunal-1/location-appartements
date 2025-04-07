<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/locataire.php";

$locataireBD = new locataireBD();

// Vérification si tous les champs sont définis et non vides
if (!empty($_POST["nomLoc"]) && !empty($_POST["prenomLoc"]) && !empty($_POST["mailLoc"]) && !empty($_POST["mdpLoc"]) && !empty($_POST["mdpLoc2"]) && !empty($_POST["dateNaissLoc"]) && !empty($_POST["telLoc"])) {

    // Vérification si les champs email et mots de passe sont non vides
    if ($_POST["mailLoc"] != "" && $_POST["mdpLoc"] != "" && $_POST["mdpLoc2"] != "") {

        // Vérification si les mots de passe saisis sont identiques
        if ($_POST["mdpLoc"] === $_POST["mdpLoc2"]) {

            // Récupération des données du formulaire
            $nomLoc = $_POST["nomLoc"];
            $prenomLoc = $_POST["prenomLoc"];
            $mailLoc = $_POST["mailLoc"];
            $mdpLoc = $_POST["mdpLoc"];
            $mdpLoc2 = $_POST["mdpLoc2"];
            $dateNaissLoc = $_POST["dateNaissLoc"];
            $telLoc = $_POST["telLoc"];

            // Création d'un objet visiteur
            $locataire = new locataire(NULL, $nomLoc, $prenomLoc, $mailLoc, $mdpLoc, $dateNaissLoc, $telLoc);

            // Ajout du visiteur dans la base de données
            $nouveauLocataire = $locataireBD->addLocataire($locataire);

            if ($nouveauLocataire) {

                $id_locataire = $nouveauLocataire->getIdLoc();
                header("Location: ./?action=ajtCB&id_locataire=$id_locataire");
                exit(); // Arrêt de l'exécution du script après la redirection
            } else {
                echo "Erreur : inscription non réussie. Veuillez réessayer.";
            }
        } else {
            echo "Les mots de passe saisis ne sont pas identiques !";
        }
    } else {
        echo "Veuillez renseigner tous les champs.";
    }
}

$titre = "Inscription - Réservation d'Appartements";
include "$racine/vue/vueLocataire.php";
?>
