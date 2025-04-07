<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandeur</title>
    <link rel="stylesheet" href="../css/locataire.css">
</head>
<body>
<header>
        <h1>Demandeur</h1>
        <a href="./?action=defaut">Accueil</a>
    </header>
    <div class="demandeur">
            <h2>Connexion Demandeur</h2>
            <form action="./?action=connexionDem" method="POST">
                <label for="code_dem">Code de Connexion :</label>
                <input type="text" id="code_dem" name="code_dem" required>
                <br>
                <br>
                <button type="submit">Se Connecter</button>
            </form>
    </div>
</body>
</html>
