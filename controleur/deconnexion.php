<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.php";

$auth = new authentification();

if ($auth->isLoggedOn())
{
    $auth->logout();
include "$racine/vue/vueProprietaire.php";
}elseif($auth->isLoggedOnLoc())
{
    $auth->logoutLoc();
    include "$racine/vue/vueLocataire.php";
}elseif($auth->isLoggedOnDEM())
{
    $auth->logoutDem();
    include "$racine/vue/vueDemandeur.php";
}
?>