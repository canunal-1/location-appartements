<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "modele/appartementBD.php";
include_once "modele/authentification.php";
include_once "modele/proprietaireBD.php";
include_once "modele/imageBD.php";
include_once "modele/occuperBD.php";

$id_appartement = $_GET['id_appartement'];

$appartementBD = new appartementBD();

$auth = new authentification();

if($auth->isLoggedOn())
{
$mail = $auth->getMailLoggedOn();
$proprietaireBD = new proprietaireBD();
$proprietaire = $proprietaireBD->getProprioByMail($mail);
$id_proprietaire = $proprietaire->getId();

// Vérification si l'appartement est occupé avant de le supprimer
$occuperBD = new occuperBD();
if ($occuperBD->isAppartementOccupied($id_appartement)) {
    // Afficher un message d'erreur et arrêter l'exécution du script
    $erreur = "L'appartement est occupé. Vous ne pouvez pas le supprimer.";
    include "$racine/vue/vueErreur.php";
    exit();
}

// Si l'appartement n'est pas occupé, continuer la suppression
$imageBD = new imageBD();
$imageBD->getImageByAppart($id_appartement);
$imageBD->deleteImagesByAppart($id_appartement);
$appartementBD->deleteApparteByIdProprio($id_appartement, $id_proprietaire);
}

include "$racine/vue/vueSupprApparte.php";
?>
