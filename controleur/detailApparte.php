<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/occuperBD.php";
include_once "$racine/modele/imageBD.php";
include_once "$racine/modele/proprietaire.php";

$auth = new authentification();
$id_appartement = $_GET['id_appartement'];

$appartementBD = new appartementBD();
$appartement = $appartementBD->getApparteById($id_appartement);
$id_proprietaire = $appartement->getIdProprio();

$proprietaireBD = new proprietaireBD();
$proprietaire = $proprietaireBD->getProprioById($id_proprietaire);
$nom = $proprietaire->getNom();
$prenom = $proprietaire->getPrenom();
$mail = $proprietaire->getMail();
$tel =  $proprietaire->getTel();

$imageBD = new imageBD();
$images = $imageBD->getImageByAppart($id_appartement);

$demandeurBD = new demandeurBD();

$code_dem = $auth->getCodeLoggedOnDem();
$demandeur = $demandeurBD->getDemandeurByCode($code_dem);

$occuperBD = new occuperBD();
$estOccupe = $occuperBD->isAppartementOccupied($id_appartement);

include "$racine/vue/vueDetailApparte.php";
?>
