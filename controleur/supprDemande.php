<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/notificationBD.php";

$demandeurBD = new demandeurBD();
$notificationBD = new notificationBD();

$id_dem = $_GET["id_dem"];

$notificationBD->deleteNotificationByIdDem($id_dem);
$demandeurBD->deleteDemandeur($id_dem);

header("Location: ?action=defaut");
?>