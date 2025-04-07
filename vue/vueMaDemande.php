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
        <h1>Ma Demande</h1>
        <nav>
            <a href="./?action=defaut">Accueil</a>
            <a href="./?action=profil">Mon Profil</a>
        </nav>
    </header>

    <main>
        <section class="demandes">
                    <div class="demande">
                        <h2><?php echo $demande->getVille(); ?></h2>
                        <p><strong>Rue :</strong> <?php echo $demande->getRue(); ?></p>
                        <p><strong>Arrondissement :</strong> <?php echo $demande->getArr(); ?></p>
                        <p><strong>Étage :</strong> <?php echo $demande->getEtage(); ?></p>
                        <p><strong>Type :</strong> <?php echo $demande->getType(); ?></p>
                    </div>
        </section>
    </main>
    <?php if($decision === NULL){ ?>
    <p>En Attente de la réponse du propriétaire</p>
    <?php }elseif($decision === 1){ ?>
    <p>Votre demande a été acceptée, veuillez consulter votre profil</p>
    <?php }elseif($decision === 0){ ?>
    <p>Votre demande a été refusée, veuillez consulter votre profil</p>
    <?php } ?>
</body>
</html>
