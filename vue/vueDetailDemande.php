<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detailDemande.css">
    <title>Profil</title>
</head>
<body>
    <header>
        <a href="./?action=defaut">Accueil</a>
    </header>

    <div class="container">
        <h2>Profil du Demandeur</h2>
        <div class="profile-info">
            <label for="nom">Nom :</label>
            <span id="nom"><?php echo $nom_dem ?></span>
        </div>
        <div class="profile-info">
            <label for="prenom">Prénom :</label>
            <span id="prenom"><?php echo $prenom_dem ?></span>
        </div>
        <div class="profile-info">
            <label for="adresse">Adresse :</label>
            <span id="adresse"><?php echo $adresse_dem ?></span>
        </div>
        <div class="profile-info">
            <label for="ville">Ville :</label>
            <span id="ville"><?php echo $ville_dem ?></span>
        </div>
        <div class="profile-info">
            <label for="codeville">Code Postale :</label>
            <span id="codeville"><?php echo $codeville_dem ?></span>
        </div>
        <div class="profile-info">
            <label for="telephone">Téléphone :</label>
            <span id="telephone"><?php echo $tel_dem ?></span>
        </div>
    <br>
    <a href="./?action=detailApparte&id_appartement=<?php echo $id_appartement ?>">Voir l'appartement demandé</a>
    </div>

    <div class="bool">
        <a href="./?action=accepterDemande&id_dem=<?php echo $id_dem ?>">Accepter</a>
        <a href="./?action=refuserDemande&id_dem=<?php echo $id_dem ?>">Refuser</a>
    </div>