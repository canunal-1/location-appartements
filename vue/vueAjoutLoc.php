<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ajoutLoc.css">
    <title>Ajouter une Location</title>
</head>
<body>
    <header>
        <h1>Ajouter une Location d'Appartement</h1>
        <br>
        <a href="./?action=defaut">Accueil</a>
        <a href="./?action=profil">Mon Profil</a>
    </header>
    <form action="./?action=ajoutLoc&id_proprietaire=<?php echo $id_proprietaire ?>" method="POST">
        <label for="villeAppart">Ville de l'Appartement :</label>
        <input type="text" id="villeAppart" name="villeAppart" required>
        
        <label for="rue">Rue :</label>
        <input type="text" id="rue" name="rue" required>
        
        <label for="arrondissement">Arrondissement :</label>
        <input type="text" id="arrondissement" name="arrondissement" required>
        
        <label for="etage">Étage :</label>
        <input type="number" id="etage" name="etage" min="-1" required>
        
        <label for="type">Type d'Appartement :</label>
        <input type="text" id="type" name="type" required>
        
        <label for="prix_loc">Prix de Location :</label>
            <div class="input-with-icon">
                <span class="euro-icon">€</span>
                <input type="number" id="prix_loc" name="prix_loc" min="0" required>
            </div>

        <label for="prix_charg">Prix des Charges :</label>
        <div class="input-with-icon">
            <span class="euro-icon">€</span>
            <input type="number" id="prix_charg" name="prix_charg" min="0" required>
        </div>

        
        <label for="ascenseur">Ascenseur :</label>
        <input type="checkbox" id="ascenseur" name="ascenseur">
        
        <label for="preavis">Préavis :</label>
        <input type="checkbox" id="preavis" name="preavis">
        
        <label for="date_libre">Date de Disponibilité :</label>
        <input type="date" id="date_libre" name="date_libre" required>
        
        <input type="submit" value="Ajouter Location">
    </form>
</body>
</html>
