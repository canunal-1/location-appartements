<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/banque.php";
include_once "$racine/modele/banqueBD.php";

    $auth = new authentification();

    $mailLoc = $auth->getMailLoggedOnLoc();

    $locataireBD = new locataireBD();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);
    $nomLoc = $locataire->getNomLoc();
    $prenomLoc = $locataire->getPrenomLoc();
    $mailLoc = $locataire->getMailLoc();
    $dateNaissLoc = $locataire->getDateNaiss();
    $telLoc = $locataire->getTelLoc();
    $banqueBD = new banqueBD();
    $compteBancaire = $banqueBD->getCBByIdLoc($locataire->getIdLoc());
    $id_banque = $compteBancaire->getIdBanque();

    // Instanciation de la classe banqueBD pour accéder aux méthodes de manipulation de la base de données
    $banqueBD = new banqueBD();

    // Suppression du compte bancaire
    $suppression_reussie = $banqueBD->deleteCB($locataire->getIdLoc(), $compteBancaire->getIdBanque());

    header("Location: ./?action=profil");
    exit();
?>
