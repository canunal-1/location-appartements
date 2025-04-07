<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/banqueBD.php";

$auth = new authentification();

if ($auth->isLoggedOn()) {
    $mail = $auth->getMailLoggedOn();

    $proprietaireBD = new proprietaireBD();
    $proprietaire = $proprietaireBD->getProprioByMail($mail);
    $nom = $proprietaire->getNom();
    $prenom = $proprietaire->getPrenom();
    $mail = $proprietaire->getMail();
    $adresse = $proprietaire->getAdresse();
    $ville = $proprietaire->getVille();
    $tel = $proprietaire->getTel();

}

if ($auth->isLoggedOnLoc()) {
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
}

if ($auth->isLoggedOnDem()) {
    $code_dem = $auth->getCodeLoggedOnDem();

    $demandeurBD = new demandeurBD();
    $demandeur = $demandeurBD->getDemandeurByCode($code_dem);
    $nomDem = $demandeur->getNom();
    $prenomDem = $demandeur->getPrenom();
    $adresseDem = $demandeur->getAdresse();
    $villeDem = $demandeur->getVille();
    $codevilleDem = $demandeur->getCodeVille();
    $telDem = $demandeur->getTelDem();
    $code_dem = $demandeur->getCodeDem();
    $id_appartement = $demandeur->getIdApparteDem();
    $id_dem = $demandeur->getID();
    $decision = $demandeur->getDecision();  
}

include "$racine/vue/vueProfil.php";
?>