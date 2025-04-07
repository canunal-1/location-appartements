<?php
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";

$authentification = new authentification(); 
$auth = $authentification->isLoggedOn();

if ($auth)
{
    
}
?>