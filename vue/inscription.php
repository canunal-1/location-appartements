<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inscription.css">
    <title>Inscription</title>
</head>
<body>
    <header>
        <a href="./?action=defaut">Accueil</a>
        <a href="./?action=connexion">Connexion</a>
    </header>
    <form action="./?action=inscription" method="POST">
        <h2>Inscription</h2>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        
        <label for="email">E-mail :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>
        
        <label for="confirmer_mdp">Confirmer le mot de passe :</label>
        <input type="password" id="confirmer_mdp" name="confirmer_mdp" required>
        
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" required>
        
        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" required>
        
        <label for="tel">Téléphone :</label>
        <input type="tel" id="tel" name="tel" required>
        
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
