<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/proprietaireBD.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/imageBD.php";
include_once "$racine/modele/proprietaire.php";
include_once "$racine/modele/locataire.php";
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/notificationBD.php";

$auth = new authentification();

$notificationBD = new notificationBD();

if ($auth->isLoggedOn())
{
    $proprietaireBD = new proprietaireBD();

    $mail = $auth->getMailLoggedOn();
    $proprietaire = $proprietaireBD->getProprioByMail($mail);
    $id_proprietaire = $proprietaire->getId();
    $notifications = $notificationBD->getNotificationsByProprio($id_proprietaire);

    // Trier les notifications par ordre décroissant de date de création
    usort($notifications, function($a, $b) {
        return strtotime($b->getHorodatage()) - strtotime($a->getHorodatage());
    });

    // Vérifier s'il y a des notifications à afficher
if (!empty($notifications)) {
    // Parcourir les notifications
    foreach ($notifications as $notification) {
        if ($auth->isLoggedOn()) {
            // Récupérer la question associée
            $demandeurBD = new demandeurBD();
            $demandeur = $demandeurBD->getDemandeurByIdNotif($notification->getIdNotif());

            // Si la question existe, ajoutez le message à afficher
            if ($demandeur) {
                $unreadCount = $notificationBD->countNotificationsByProprietaire($id_proprietaire);
                $id_appartemment = $demandeur->getIdApparteDem();
                $msgnotif = $notification->getMessage();
                
                }
            }
        }
    }
}

if ($auth->isLoggedOn()){
$proprietaireBD = new proprietaireBD();

$mail = $auth->getMailLoggedOn();
$proprietaire = $proprietaireBD->getProprioByMail($mail);
$id_proprietaire = $proprietaire->getId();
}elseif ($auth->isLoggedOnLoc()){
    $locataireBD = new locataireBD();
    
    $mailLoc = $auth->getMailLoggedOnLoc();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);
    $id_locataire = $locataire->getIdLoc();
}elseif ($auth->isLoggedOnDEM())
{
    $demandeurBD = new demandeurBD();
    $code_dem = $auth->getCodeLoggedOnDem();
    $demandeur = $demandeurBD->getDemandeurByCode($code_dem);
    $id_dem = $demandeur->getID();
}

$appartementBD = new appartementBD();
$appartements = $appartementBD->getAppartements();

$imageBD = new imageBD();

foreach ($appartements as $appartement) {
    $id_appartement = $appartement->getID();
    $images[$id_appartement] = $imageBD->getImageByAppart($id_appartement);
}

$titre = "Accueil - Réservation d'Appartements";
include "$racine/vue/accueil.php";
?>
