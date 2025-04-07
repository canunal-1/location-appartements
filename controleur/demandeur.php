<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/demandeurBD.php";

$titre = "Demandeur - Réservation d'Appartements";
include "$racine/vue/vueDemandeur.php";
?>