<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "modele/appartementBD.php";
include_once "modele/imageBD.php";
include_once "modele/proprietaireBD.php";
include_once "modele/proprietaire.php";
include_once "modele/authentification.php";

$auth = new authentification();

$mail = $auth->getMailLoggedOn();

$proprietaireBD = new proprietaireBD();
$proprietaire = $proprietaireBD->getProprioByMail($mail);
$id_proprietaire = $proprietaire->getId();

$appartementBD = new appartementBD();
$mesAppartes = $appartementBD->getApparteByIdProprio($id_proprietaire);

$imageBD = new imageBD();

foreach ($mesAppartes as $appartement) {
    $id_appartement = $appartement->getID();
    $images[$id_appartement] = $imageBD->getImageByAppart($id_appartement);
}

// Inclusion de la vue pour afficher les appartements ajoutés avec leurs images
include "$racine/vue/vueMesAppartes.php";
?>
