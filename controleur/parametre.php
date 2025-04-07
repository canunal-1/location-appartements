<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";

$auth = new authentification();

if($auth->isLoggedOn()){

$mail = $auth->getMailLoggedOn();
$proprietaireBD = new proprietaireBD();
$proprietaire = $proprietaireBD->getProprioByMail($mail);
$id_proprietaire = $proprietaire->getId();
}elseif($auth->isLoggedOnLoc())
{
    $mailLoc = $auth->getMailLoggedOnLoc();
    $locataireBD = new locataireBD();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);
    $id_locataire = $locataire->getIdLoc();
}

include "$racine/vue/vueParam.php"
?>