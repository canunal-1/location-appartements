<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/proprietaire.php";

$proprietaireBD = new proprietaireBD();

// Vérification si tous les champs sont définis et non vides
if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["confirmer_mdp"]) && !empty($_POST["adresse"]) && !empty($_POST["ville"]) && !empty($_POST["tel"])) {

    // Vérification si les champs email et mots de passe sont non vides
    if ($_POST["email"] != "" && $_POST["mdp"] != "" && $_POST["confirmer_mdp"] != "") {

        // Vérification si les mots de passe saisis sont identiques
        if ($_POST["mdp"] === $_POST["confirmer_mdp"]) {

            // Récupération des données du formulaire
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $mail = $_POST["email"];
            $mdp = $_POST["mdp"];
            $mdp2 = $_POST["confirmer_mdp"];
            $adresse = $_POST["adresse"];
            $ville = $_POST["ville"];
            $tel = $_POST["tel"];

            // Création d'un objet visiteur
            $proprietaire = new proprietaire(NULL, $nom, $prenom, $mail, $mdp, $adresse, $ville, $tel);

            // Ajout du visiteur dans la base de données
            $nouveauProprio = $proprietaireBD->addPropio($proprietaire);

            if ($nouveauProprio) {
                // Redirection vers la page de profil avec l'ID du visiteur ajouté
                include "$racine/vue/vueConfirmeInscription.php";
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
include "$racine/vue/vueProprietaire.php";
?>
