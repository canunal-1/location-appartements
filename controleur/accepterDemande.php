<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/notificationBD.php";
$demandeurBD = new demandeurBD();

$id_dem = $_GET["id_dem"];
$accepter = $demandeurBD->accepterDemande($id_dem);

$notificationBD = new notificationBD();
$notificationBD->deleteNotificationByIdDem($id_dem);
if(!$accepter)
{
    header("Location: ?action=defaut");

}else{
    header("Location: ?action=detailDemande&id_dem=$id_dem");
}
?>