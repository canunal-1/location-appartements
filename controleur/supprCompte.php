<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/imageBD.php";


// Vérification de la session utilisateur
$auth = new authentification();

if($auth->isLoggedOn())
{
$id_appartement = $_GET['id_appartement'];
$proprietaireBD = new proprietaireBD();
$mail = $auth->isLoggedOn();
$proprietaire = $proprietaireBD->getProprioByMail($mail);

$imageBD = new imageBD();
$imageBD->deleteImagesByAppart($id_appartement);

$appartementBD = new appartementBD();
$appartement = $appartementBD->deleteApparteByIdProprio($id_appartement, $id_proprietaire);

// Suppression du compte 
$suppression_reussie = $proprietaireBD->deleteProprietaire($id_proprietaire);

// Redirection vers la page de confirmation de suppression ou d'erreur
if ($suppression_reussie) {
    header("Location: ./?action=defaut");
} else {
    header("Location: $racine/vue/vueErreur.php");
}
}elseif($auth->isLoggedOnLoc())
{
    $id_locataire = $_GET['id_locataire'];

    $locataireBD = new locataireBD();
    $mailLoc = $auth->isLoggedOnLoc();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);
    
    // Suppression du compte 
    $suppression_reussieLoc = $locataireBD->deleteLocataire($id_proprietaire);
    
    // Redirection vers la page de confirmation de suppression ou d'erreur
    if ($suppression_reussieLoc) {
        header("Location: ./?action=defaut");
    } else {
        header("Location: $racine/vue/vueErreur.php");
    }
}
?>
