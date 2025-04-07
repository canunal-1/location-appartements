<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";

$titre = "Proprietaire - Réservation d'Appartements";
include "$racine/vue/vueProprietaire.php";
?>