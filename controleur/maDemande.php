<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "modele/appartementBD.php";
include_once "modele/imageBD.php";
include_once "modele/demandeurBD.php";
include_once "modele/authentification.php";

$auth = new authentification();
$code_dem = $auth->getCodeLoggedOnDem();

$demandeurBD = new demandeurBD();
$demandeur = $demandeurBD->getDemandeurByCode($code_dem);
$decision = $demandeur->getDecision();
$id_appartement = $demandeur->getIdApparteDem(); 

$appartementBD = new appartementBD();

$demande = $appartementBD->getApparteById($id_appartement);

include "$racine/vue/vueMaDemande.php";
?>