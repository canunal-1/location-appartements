<?php
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/authentification.php";

$demandeurBD = new demandeurBD();

$id_dem = $_GET['id_dem'];

$demandeur = $demandeurBD->getDemandeurById($id_dem);

$nom = $demandeur->getNom();
$prenom = $demandeur->getPrenom();
$adresse = $demandeur->getAdresse();
$ville = $demandeur->getVille();
$codeville = $demandeur->getCodeVille();
$tel = $demandeur->getTelDem();
$code_dem = $demandeur->getCodeDem();
$id_appartement = $demandeur->getIdApparteDem();

$auth = new authentification();

$auth->isLoggedOnDEM();

include "$racine/vue/vueProfilDem.php";
?>