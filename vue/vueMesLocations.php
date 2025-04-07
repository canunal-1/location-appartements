<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Locations</title>
    <link rel="stylesheet" href="../css/mesLocations.css">
</head>
<body>
    <header>
        <h1>Mes Locations</h1>
        <nav>
            <a href="./?action=defaut">Accueil</a>
            <a href="./?action=profil">Mon Profil</a>
        </nav>
    </header>

    <main>
        <section class="locations">
            <?php if (empty($locations)) { ?>
                <p>Aucune location effectuée.</p>
            <?php } else { ?>
                <?php foreach ($locations as $location) { ?>
                    <div class="location">
                        <h2><?php echo $location->getVille(); ?></h2>
                        <p><strong>Rue :</strong> <?php echo $location->getRue(); ?></p>
                        <p><strong>Arrondissement :</strong> <?php echo $location->getArr(); ?></p>
                        <p><strong>Étage :</strong> <?php echo $location->getEtage(); ?></p>
                        <p><strong>Type :</strong> <?php echo $location->getType(); ?></p>
                        <p><strong>Prix Payé :</strong> <?php echo $location->getPrixCharg() + $location->getPrixLoc(); ?>€</p>
                    </div>
                <?php } ?>
            <?php } ?>
        </section>
    </main>
</body>
</html>
