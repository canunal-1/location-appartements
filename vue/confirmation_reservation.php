<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/confirmation.css">
    <title>Confirmation Réservation</title>
</head>
<body>
    <header>
        <h1>Réservation d'Appartements</h1>
        <br>
        <p>Votre réservation a été confirmée avec succès !</p>
        <br>
        <nav>
            <?php $id_locataire = $_GET['id_locataire']; ?>
            <a href="./?action=mesLoc&id_locataire=<?php echo $id_locataire?>">Mes locations</a>
        </nav>
    </header>
</body>
</html>
