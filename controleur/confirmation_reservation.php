<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/locataire.php";
include_once "$racine/modele/banqueBD.php";
include_once "$racine/modele/banque.php";

include "$racine/vue/confirmation_reservation.php";