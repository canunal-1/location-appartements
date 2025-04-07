<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Demande de Location</title>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
    <header>
    <h2>Formulaire de Demande de Location</h2>
    <a href="./?action=defaut">Accueil</a>
        <a href="javascript:history.back()">Retour</a>
    </header>
    <form action="./?action=ajoutDemande&id_appartement=<?php echo $id_appartement ?>" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" required>

        <label for="codeville">Code Postale :</label>
        <input type="num" id="codeville" name="codeville" required>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required>

        <input type="submit" value="Envoyer la Demande">
    </form>
</body>
</html>
