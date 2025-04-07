<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/connexionPDO.php";
include_once "$racine/modele/authentification.php";
include_once "$racine/modele/locataireBD.php";
include_once "$racine/modele/appartementBD.php";
include_once "$racine/modele/banqueBD.php";
include_once "$racine/modele/demandeurBD.php";
include_once "$racine/modele/notificationBD.php";
include_once "$racine/modele/occuperBD.php";

$auth = new authentification();

$id_locataire = $_GET["id_locataire"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["iban"])) {
    // Récupération des données du formulaire
    $iban = $_POST["iban"];

    // Vous devez obtenir l'id du locataire, supposons que vous l'avez déjà dans une variable $id_locataire

    // Création d'une instance de la classe banqueBD
    $banqueBD = new banqueBD();

    // Création d'une instance de la classe banque avec les données du formulaire
    $banque = new banque(null, $iban, $id_locataire);

    // Ajout du compte bancaire dans la base de données
    $ajoutReussi = $banqueBD->addCB($banque);

    if ($ajoutReussi) {
        $demandeurBD = new demandeurBD();
        $code_dem = $auth->getCodeLoggedOnDem();
        $demandeur = $demandeurBD->getDemandeurByCode($code_dem);
        $id_dem = $demandeur->getID();
        $id_appartement = $demandeur->getIdApparteDem();

        $appartementBD = new appartementBD();

        // Récupération de l'appartement à réserver
        $appartement = $appartementBD->getApparteById($id_appartement);

        // Vérification si l'appartement existe et s'il est disponible
        if($appartement) {
            $occuper = new occuper($id_appartement, $id_locataire);
            $occuperBD = new occuperBD();
            $occuperBD->addOccuper($occuper);
            // Calcul du nouveau solde après réservation
            $prixTTC = $appartement->getPrixLoc() + $appartement->getPrixCharg();
            $notificationBD = new notificationBD();
            $notificationBD->deleteNotificationByIdDem($id_dem);
            $demandeurBD->deleteDemandeur($id_dem);

        // Redirection vers la page du profil après l'ajout réussi
        include "$racine/vue/vueConfirmeInscriptionLoc.php";
        }
        exit();
    } else {
        // Gestion de l'erreur si l'ajout échoue
        echo "Une erreur s'est produite lors de l'ajout du compte bancaire.";
    }

}


include "$racine/vue/vueCB.php";
