<?php
function controleurPrincipal($action)
{
    $lesActions = array();
    $lesActions["defaut"] = "accueil.php";
    $lesActions["inscription"] = "inscription.php";
    $lesActions["inscriptionLoc"] = "inscriptionLoc.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["connexionLoc"] = "connexionLoc.php";
    $lesActions["connexionDem"] = "connexionDem.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "profil.php";
    $lesActions["ajoutLoc"] = "ajoutLoc.php";
    $lesActions["ajoutImage"] = "ajoutImage.php";
    $lesActions["mesAppartes"] = "mesAppartes.php";
    $lesActions["locataire"] = "locataire.php";
    $lesActions["proprietaire"] = "proprietaire.php";
    $lesActions["demandeur"] = "demandeur.php";
    $lesActions["detailApparte"] = "detailApparte.php";
    $lesActions["ajtCB"] = "ajtCB.php";
    $lesActions["supprApparte"] = "supprApparte.php";
    $lesActions["reserver"] = "reserver.php";
    $lesActions["confirmation_reservation"] = "confirmation_reservation.php";
    $lesActions["mesLoc"] = "mesLocations.php";
    $lesActions["supprCB"] = "supprCB.php";
    $lesActions["parametre"] = "parametre.php";
    $lesActions["supprCompte"] = "supprCompte.php";
    $lesActions["modifProfil"] = "modifProfil.php";
    $lesActions["ajoutDemande"] = "ajoutDemande.php";
    $lesActions["profilDem"] = "profilDem.php";
    $lesActions["supprDem"] = "supprDemande.php";
    $lesActions["maDemande"] = "maDemande.php";
    $lesActions["detailDemande"] = "detailDemande.php";
    $lesActions["accepterDemande"] = "accepterDemande.php";
    $lesActions["refuserDemande"] = "refuserDemande.php";
    $lesActions["avoirCompteLoc"] = "avoirCompteLoc.php";

    if (array_key_exists ($action, $lesActions)){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }
}
?>