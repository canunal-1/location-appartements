<?php
include_once "modele/appartementBD.php";
include_once "modele/imageBD.php";
include_once "modele/proprietaireBD.php";
include_once "modele/proprietaire.php";
include_once "modele/locataireBD.php";
include_once "modele/locataire.php";
include_once "modele/authentification.php";
include_once "modele/occuperBD.php";
include_once "modele/banqueBD.php";

$auth = new authentification();

// Vérification si un locataire est connecté
if($auth->isLoggedOnLoc()) {
    // Récupération des informations du locataire connecté
    $mailLoc = $auth->getMailLoggedOnLoc();

    $locataireBD = new locataireBD();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);
    $id_locataire = $locataire->getIdLoc();
    $banqueBD = new banqueBD();
    $compteBancaire = $banqueBD->getCBByIdLoc($id_locataire);
} else {
    // Redirection vers la page de connexion pour les locataires non connectés
    header("Location: ./?action=connexionLoc");
    exit;
}

// Récupération de l'identifiant de l'appartement à réserver
$id_appartement = $_GET['id_appartement']; 

// Instanciation de la classe appartementBD
$appartementBD = new appartementBD();

// Récupération de l'appartement à réserver
$appartement = $appartementBD->getApparteById($id_appartement);

// Vérification si l'appartement existe et s'il est disponible
if($appartement) {
    // Calcul du nouveau solde après réservation
    $nouveauSolde = $solde - $appartement->getPrixLoc() + $appartement->getPrixCharg();

    // Vérification si le solde du locataire est suffisant pour la réservation
    if($nouveauSolde >= 0) {
        // Mise à jour du solde du locataire dans la base de données
        $banqueBD = new banqueBD();
        $banqueBD->updateSolde($id_locataire, $nouveauSolde);

        // Ajout de l'occupation de l'appartement par le locataire dans la base de données
        $occuper = new occuper($id_appartement, $id_locataire);
        $occuperBD = new occuperBD();
        $occuperBD->addOccuper($occuper);

        // Redirection vers une page de confirmation ou de détails de réservation
        header("Location: ./?action=confirmation_reservation&id_locataire=$id_locataire&id_appartement=$id_appartement");
        exit;
    } else {
        // Redirection vers une page d'erreur indiquant que le solde est insuffisant
        header("Location: ./?action=erreur_solde_insuffisant");
        exit;
    }
} else {
    // Redirection vers une page d'erreur indiquant que l'appartement est introuvable ou non disponible
    header("Location: ./?action=erreur_appartement_non_disponible");
    exit;
}
?>
