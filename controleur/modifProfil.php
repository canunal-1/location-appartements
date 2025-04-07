<?php
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";

$auth = new authentification();
$proprietaireBD = new proprietaireBD();

$mail = $auth->getMailLoggedOn();
$proprietaire = $proprietaireBD->getProprioByMail($mail);
$nom = $proprietaire->getNom();
$prenom = $proprietaire->getPrenom();
$mdp = $proprietaire->getMdp();
$adresse = $proprietaire->getAdresse();
$ville = $proprietaire->getVille();
$tel = $proprietaire->getTel();

if ($_GET['partie'] === 'nom') {
    if (isset($_POST["nom"])) {
        $nouveauNom = $_POST["nom"];
        // Vérifier si le nom est vide
        if (!empty($nouveauNom)) {
            // Mise à jour du nom
            $proprietaire->setNom($nouveauNom);
            $proprietaireBD->updateProprio($proprietaire);
            
            // Redirection vers la page de profil
            header("Location: ./?action=profil");
            exit();
        } else {
            // Si le nom est vide, afficher un message d'erreur ou gérer l'erreur d'une autre manière
            $erreur = "Le nom ne peut pas être vide.";
        }
    }
} elseif ($_GET['partie'] === 'prenom') {
    if (isset($_POST["prenom"])) {
        $nouveauPrenom = $_POST["prenom"];
        // Vérifier si le prenom est vide
        if (!empty($nouveauPrenom)) {
            // Mise à jour du prenom
            $proprietaire->setPrenom($nouveauPrenom);
            $proprietaireBD->updateProprio($proprietaire);
            
            // Redirection vers la page de profil
            header("Location: ./?action=profil");
            exit();
        } else {
            // Si le prenom est vide, afficher un message d'erreur ou gérer l'erreur d'une autre manière
            $erreur = "Le prenom ne peut pas être vide.";
        }
    }
} elseif ($_GET['partie'] === 'mdp') {
    if (isset($_POST["mdp"]) && isset($_POST["mdp1"]) && isset($_POST["mdp2"])) {
        $mdpAncien = $_POST["mdp"];
        $mdpNouveau = $_POST["mdp1"];
        $mdpConfirmation = $_POST["mdp2"];

        $i = 0;

        if ($mdpAncien != "") {
            $i++;
        }
    
        if ($mdpNouveau != "") {
            $i++;
        }
    
        if ($mdpConfirmation != "") {
            $i++;
        }

        if ($i == 1) {
            $messageErreurRubriqueUnique = "Erreur : Vous devez remplir tout les champs liés au mot de passe.";
        }elseif ($i == 0){
            $msgChmpsMdp = "Les champs liés à la modification du mot de passe sont vides.";
        } else {
            // Vérifier les conditions du mot de passe
            if (!password_verify($mdpAncien, $mdp)) {
                $messageErreurAncienMdp = "Erreur : L'ancien mot de passe est incorrect.";
            } elseif ($mdpNouveau != $mdpConfirmation){
                $messageErreurMdp = "Erreur : Les nouveaux mots de passe ne correspondent pas.";
            } else {
                // Mise à jour du mot de passe
                $resultatMdp = $proprietaireBD->updtMdpProprio($proprietaire, array('ancien' => $mdpAncien, 'nouveau' => $mdpNouveau));
                header("Location: ./?action=connexion");
                exit();
            }
        }
    }
} elseif ($_GET['partie'] === 'adr') {
    if (isset($_POST["adresse"]) && isset($_POST["ville"])) {
        $nouvelleAdresse = $_POST["adresse"];
        $nouvelleVille = $_POST["ville"];
        // Vérifier si l'adresse est vide
        if (!empty($nouvelleAdresse) && !empty($nouvelleVille)) {
            // Mise à jour de l'adresse
            $proprietaire->setAdresse($nouvelleAdresse);
            $proprietaire->setVille($nouvelleVille);
            $proprietaireBD->updateProprio($proprietaire);
            
            // Redirection vers la page de profil
            header("Location: ./?action=profil");
            exit();
        } else {
            // Si l'adresse est vide, afficher un message d'erreur ou gérer l'erreur d'une autre manière
            $erreur = "L'adresse ne peut pas être vide.";
        }
    }
    if (isset($_POST["ville"])) {
        $nouvelleVille = $_POST["ville"];
        // Vérifier si la ville est vide
        if (!empty($nouvelleVille)) {
            // Mise à jour de la ville
            $proprietaire->setVille($nouvelleVille);
            $proprietaireBD->updateProprio($proprietaire);
            
            // Redirection vers la page de profil
            header("Location: ./?action=profil");
            exit();
        } else {
            // Si la ville est vide, afficher un message d'erreur ou gérer l'erreur d'une autre manière
            $erreur = "La ville ne peut pas être vide.";
        }
    }
} elseif ($_GET['partie'] === 'tel') {
    if (isset($_POST["tel"])) {
        $nouveauTel = $_POST["tel"];
        // Vérifier si le prenom est vide
        if (!empty($nouveauTel)) {
            // Mise à jour du prenom
            $proprietaire->setTel($nouveauTel);
            $proprietaireBD->updateProprio($proprietaire);
            
            // Redirection vers la page de profil
            header("Location: ./?action=profil");
            exit();
        } else {
            // Si le prenom est vide, afficher un message d'erreur ou gérer l'erreur d'une autre manière
            $erreur = "Le prenom ne peut pas être vide.";
        }
    }
}

include "$racine/vue/vueModifProfil.php";
?>
