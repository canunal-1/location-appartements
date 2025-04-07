<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail.css">
    <title>Détails de l'Appartement</title>
</head>
<body>
    <header>
        <h1>Réservation d'Appartements</h1>
        <br>
        <p>Trouvez l'appartement parfait pour votre séjour</p>
        <br>
        <nav>
            <a href="./?action=defaut">Accueil</a>
            <?php if ($auth->isLoggedOn()){ ?>
                <a href="./?action=mesAppartes">Mes Appartements</a>
            <?php } ?>
        </nav>
    </header>

    <div class="container">
        <div class="hero">
            <div class="center-content">
                <h1>Détails de l'Appartement</h1>
            </div>
            <br>
            <div class="appartement-details">
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

                <div class="proprietaire-info">
                    <h2>Informations du Propriétaire</h2>
                    <p><strong>Nom :</strong> <?php echo $proprietaire->getNom(); ?></p>
                    <p><strong>Prénom :</strong> <?php echo $proprietaire->getPrenom(); ?></p>
                    <p><strong>Email :</strong> <?php echo $proprietaire->getMail(); ?></p>
                    <p><strong>Téléphone :</strong> <?php echo $proprietaire->getTel(); ?></p>
                </div>

                <!-- Affichage des images -->
                <div class="images">
                    <?php foreach ($images as $image) { ?>
                        <img src="<?php echo $image->getChmImgae(); ?>" alt="Image Appartement">
                    <?php } ?>
                </div>
            </div>
            <?php if ($estOccupe){ ?>
                <p>Cet appartement est actuellement occupé</p>
            <?php }else{ ?>
            <?php if ($auth->isLoggedOnLoc()){ ?>
            <div class="reservation-button">
                <p>Pour faire une demande, veuillez vous déconnecter de votre compte locataire.</p>
            </div>
            <?php }elseif($auth->isLoggedOn()){ ?>
            <div class="reservation-button">
                <?php if($auth->getMailLoggedOn() == $mail){ ?>
                <a href="./?action=supprApparte&id_appartement=<?php echo $id_appartement ?>">Supprimer</a>
                <a href="./?action=modifApparte&id_appartement=<?php echo $id_appartement ?>">Modifier</a>
                <?php }?>
            </div>
            <?php }elseif($auth->isLoggedOnDem()){ ?>

                <div class="reservation-button">
                <?php if($auth->getCodeLoggedOnDem() == $code_dem)
                { 
                    if($demandeur->getIdApparteDem() == $id_appartement)
                    {
                        echo "Votre demande a été envoyée au propriétaire";
                    }else{
                        echo "Vous avez déjà fait une demande, veuillez recréer une demande";
                    }
                }?>
                
            <?php }elseif(date('Y-m-d') < $appartement->getDateLibre()){ ?>
                <div class="reservation-button">
                <a href="./?action=ajoutDemande&id_appartement=<?php echo $id_appartement ?>">Faire une demande</a>
                </div>
                <?php }else{ ?>
                    <h4>Indisponible</h4>
                <?php }
                }?>

        </div>
    </div>
</body>
</html>
