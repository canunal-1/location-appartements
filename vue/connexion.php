<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connexion.css">
    <title>Connexion</title>
</head>
<body>
    <header>
        <a href="./?action=defaut">Accueil</a>
    </header>
    <form action="./?action=connexion" method="POST">
        <h2>Connexion</h2>
        <label for="email">E-mail :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required>
        
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
