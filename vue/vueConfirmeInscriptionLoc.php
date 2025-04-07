<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/confirmation.css">
    <title>Inscription Confirmée</title>
</head>
<body>
    <header>
        <a href="./?action=defaut">Accueil</a>
    </header>
    <div class="container">
        <h2>Inscription Confirmée</h2>
        <p>Votre inscription a été effectuée avec succès. Bienvenue !</p>
        <p>Vous avez payé : <?php echo $prixTTC ?> €</p>
        <?php if($auth->isLoggedOnLoc()){ ?>
            <a href="./?action=profil" class="btn">Mon Profil</a>
        <?php }else{ ?>
        <p>Vous pouvez maintenant vous connecter à votre compte.</p>
        <a href="./?action=connexionLoc" class="btn">Se connecter</a>
        <?php } ?>
    </div>
</body>
</html>
