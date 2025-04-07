<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/locataire.php";
include_once "$racine/modele/occuperBD.php";
include_once "$racine/modele/occuper.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/authentification.php";

$id_locataire = $_GET['id_locataire'];

$auth = new authentification();

if($auth->isLoggedOnLoc())
{
$mailLoc = $auth->getMailLoggedOn();
$locataireBD = new locataireBD();
$locataire = $locataireBD->getLocataireByMail($mailLoc);

$occuperBD = new occuperBD();
$locations = $occuperBD->getInfoLocationByLocataire($id_locataire);
}

include "$racine/vue/vueMesLocations.php";
?>
