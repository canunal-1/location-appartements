<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/erreur.css">
    <title>Erreur</title>
</head>
<body>
    <div class="error-box">
        <h1>Erreur</h1>
        <p><?php echo $erreur; ?></p>
        <a href="javascript:history.back()">Retour</a>
    </div>
</body>
</html>
