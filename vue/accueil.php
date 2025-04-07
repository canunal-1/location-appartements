<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../modele/script.js"></script>
    <link rel="stylesheet" href="../css/accueil.css">
    <title>Réservation d'Appartements</title>
</head>
<body>
    <header>
        <h1>Réservation d'Appartements</h1>
        <br>
        <p>Trouvez l'appartement parfait pour votre séjour</p>
        <br>
        <!-- Rubrique connexion/inscription -->
        <?php if($auth->isLoggedOn()){ 
        if(!empty($notifications)){?>
    <div class="notification" counter=<?php echo $unreadCount; ?>>
        <img src="../image/cloche.png">

        <div class="notification-bar" style="display: none;">
        <?php  
    foreach ($notifications as $notification)
    {
        $demandeur = $demandeurBD->getDemandeurByIdNotif($notification->getIdNotif());

        if ($demandeur)
        {
            $appartement = $appartementBD->getApparteById($demandeur->getIdApparteDem());
            $id_notification = $notification->getIdNotif();
            $id_dem = $notification->getIdDem();

            echo '<div class="msg-notif">';
            echo '<a href="./?action=detailDemande&id_dem='. $id_dem .'">' . $msgnotif . '</a>';
            echo '</div>';
        }
    }
    }else{
        echo '<div class="notification"counter=0>';
        echo '<img src="../image/cloche.png">';
        echo '<div class="notification-bar" style="display: none;">';
        echo '<a>Aucune notification</a>';
        echo '</div>';
        }
        ?>
        </div>
    </div>
            <div class="login-section">
                <a href="./?action=ajoutLoc&id_proprietaire=<?php echo $id_proprietaire ?>">Ajout Location</a>
                <a href="./?action=profil">Mon Profil</a>
            </div>
        <?php }elseif($auth->isLoggedOnLoc()){ ?>
            <div class="login-section">
                <a href="./?action=mesLoc&id_locataire=<?php echo $id_locataire ?>">Mes Locations</a>
                <a href="./?action=profil">Mon Profil</a>
            </div>
        <?php }elseif($auth->isLoggedOnDEM()){ ?>
            <div class="login-section">
                <a href="./?action=maDemande&id_dem=<?php echo $id_dem ?>">Ma Demande</a>
                <a href="./?action=profil">Mon Profil</a>
            </div>
        <?php }else{ ?>
            <div class="login-section">
            <a href="./?action=proprietaire">Proprietaire</a>
            <a href="./?action=locataire">Locataire</a>
            <a href="./?action=demandeur">Demandeur</a>
        </div>
        <?php } ?>
        <nav>
        <a href="./?action=defaut">Accueil</a>
        <?php if ($auth->isLoggedOn()){ ?>
        <a href="./?action=mesAppartes">Mes Appartements</a>
        <?php } ?>
    </nav>
    </header>

    <div class="container">
        <div class="hero">
            <div>
            <div class="center-content">
                <h1>Explorez des Appartements Uniques</h1>
                <p>Découvrez une sélection d'appartements incroyables disponibles à la réservation.</p>
            </div>
            <br>
                <main>
                    <section class="appartements">
                        <?php foreach ($appartements as $appartement) { ?>
                            <div class="appartement" >
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
                                <div class="descrCard">
                                    <?php
                                    echo "<a href='./?action=detailApparte&id_appartement=" . $appartement->getID() . "'>En Savoir Plus</a>";
                                    ?>
                                </div>

                            </div>
                        <?php } ?>
                    </section>
                </main>
            </div>
        </div>
    </div>
</body>
</html>
