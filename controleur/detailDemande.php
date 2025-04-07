<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "modele/appartementBD.php";
include_once "modele/demandeurBD.php";
include_once "modele/authentification.php";

$id_dem = $_GET["id_dem"];

$demandeurBD = new demandeurBD();
$demandeur = $demandeurBD->getDemandeurById($id_dem);

$nom_dem = $demandeur->getNom();
$prenom_dem = $demandeur->getPrenom();
$adresse_dem = $demandeur->getAdresse();
$ville_dem = $demandeur->getVille();
$codeville_dem = $demandeur->getCodeVille();
$tel_dem = $demandeur->getTelDem();
$id_appartement = $demandeur->getIdApparteDem();

include "$racine/vue/vueDetailDemande.php";
?>