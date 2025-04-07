<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ajoutImg.css">
    <title>Ajouter des Images</title>
</head>
<body>
    <header>
        <h1>Ajouter des Images à l'Appartement</h1>
    </header>
    <form action="./?action=ajoutImage&id_appartement=<?php echo $id_appartement ?>" method="POST" enctype="multipart/form-data">
        <label for="images">Sélectionner des Images :</label>
        <input type="file" id="images" name="images[]" multiple accept="image/*" required>
        
        <input type="submit" value="Ajouter Images">
        <a href="./?action=defaut" class="later-button">Ajouter Plus Tard</a>
    </form>
</body>
</html>
