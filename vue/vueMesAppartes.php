<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Appartements</title>
    <link rel="stylesheet" href="../css/mesAppartes.css">
</head>
<body>
    <header>
        <h1>Mes Appartements</h1>
        <a href="./?action=defaut">Accueil</a>
        <a href="./?action=profil">Mon Profil</a>
    </header>
    <main>
        <section class="appartements">
            <?php foreach ($mesAppartes as $appartement) { ?>
                <div class="appartement">
                    <h2><?php echo $appartement->getVille(); ?></h2>
                    <p><strong>Rue :</strong> <?php echo $appartement->getRue(); ?></p>
                    <p><strong>Arrondissement :</strong> <?php echo $appartement->getArr(); ?></p>
                    <p><strong>Étage :</strong> <?php echo $appartement->getEtage(); ?></p>
                    <p><strong>Type :</strong> <?php echo $appartement->getType(); ?></p>
                    <p><strong>Prix de Location :</strong> <?php echo $appartement->getPrixLoc(); ?> €</p>
                    <p><strong>Prix des Charges :</strong> <?php echo $appartement->getPrixCharg(); ?> €</p>
                    <p><strong>Ascenseur :</strong> <?php echo ($appartement->getAscenceur() ? "Oui" : "Non"); ?></p>
                    <p><strong>Préavis :</strong> <?php echo ($appartement->getPreavis() ? "Oui" : "Non"); ?></p>
                    <p><strong>Date de Disponibilité :</strong> <?php echo $appartement->getDateLibre(); ?></p>

                    <!-- Affichage des images -->
                    <div class="images">
                        <?php foreach ($images[$appartement->getID()] as $image) { ?>
                            <img src="<?php echo $image->getChmImgae(); ?>" alt="Image Appartement">
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>
</body>
</html>
