<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <title>Profil</title>
</head>
<body>
    <header>
        <a href="./?action=defaut">Accueil</a>
        <a href="./?action=deconnexion">Déconnexion</a>
    </header>
    <?php if ($auth->isLoggedOn()){ ?>
    <div class="container">
        <h2>Profil du Propriétaire</h2>
        <div class="profile-info">
            <p><strong>Nom :</strong> <?php echo $nom ?></p>
            <p><strong>Prénom :</strong> <?php echo $prenom ?></p>
            <p><strong>Email :</strong> <?php echo $mail ?></p>
            <p><strong>Adresse :</strong> <?php echo $adresse ?></p>
            <p><strong>Ville :</strong> <?php echo $ville ?></p>
            <p><strong>Téléphone :</strong> <?php echo $tel ?></p>
        </div>
    </div>
    <div class="param">
    <a href='./?action=parametre'>Paramètre du compte</a>
    </div>
    <?php } elseif($auth->isLoggedOnLoc()){ ?>
    <div class="container">
        <h2>Profil du Locataire</h2>
        <div class="profile-info">
            <p><strong>Nom :</strong> <?php echo $nomLoc ?></p>
            <p><strong>Prénom :</strong> <?php echo $prenomLoc ?></p>
            <p><strong>Email :</strong> <?php echo $mailLoc ?></p>
            <p><strong>Date De Naissance :</strong> <?php echo $dateNaissLoc ?></p>
            <p><strong>Téléphone :</strong> <?php echo $telLoc ?></p>
        </div>
        <?php if(isset($compteBancaire)){ ?>
        <div class="bank-info">
            <br>
            <h2>Votre Compte Bancaire : </h2>
            <p><strong>Mon IBAN :</strong> <?php echo $compteBancaire->getCode(); ?></p>
            <a href="./?action=supprCB&id_locataire=<?php echo $locataire->getIdLoc() ?>&id_banque=<?php echo $compteBancaire->getIdBanque() ?>">Supprimer</a>
        </div>
        <?php } ?>
    </div>
<br>
<div class="param">
    <a href='./?action=parametre'>Paramètre du compte</a>
    </div>
    <?php }elseif($auth->isLoggedOnDEM()){ ?>
        <?php if($decision === 1){ ?>

            <div class=container>
                <div class="accepter">
                <h2>Votre demande a été accepté</h2>
                <p>Veuillez confirmer les informations suivantes :</p>
                <form action="./?action=inscriptionLoc" method="post">
                    <label for="nomLoc">Nom :</label>
                    <input type="text" id="nomLoc" name="nomLoc" value="<?php echo $nomDem ?>" required>
                    <br>
                    <label for="prenomLoc">Prénom :</label>
                    <input type="text" id="prenomLoc" name="prenomLoc" value="<?php echo $prenomDem ?>" required>
                    <br>
                    <br>
                    <label for="telLoc">Téléphone :</label>
                    <input type="tel" id="telLoc" name="telLoc" value="<?php echo $telDem ?>" required>
                    <br>
                    <p>Veuillez renseigner les informations suivantes :</p>
                    <br>
                    <label for="mailLoc">E-mail :</label>
                    <input type="email" id="mailLoc" name="mailLoc" required>
                    <br>
                    <br>
                    <label for="mdpLoc">Mot De Passe :</label>
                    <input type="password" id="mdpLoc" name="mdpLoc" required>
                    <br>
                    <br>
                    <label for="mdpLoc2">Confirmer Le Mot De Passe :</label>
                    <input type="password" id="mdpLoc2" name="mdpLoc2" required>
                    <br>
                    <br>
                    <label for="dateNaissLoc">Date De Naissance :</label>
                    <input type="date" id="dateNaissLoc" name="dateNaissLoc" required>
                    <br>
                    <br>
                    <input type="submit" value="Suivant">
                </form>
                <br>
                <a href="./?action=avoirCompteLoc&id_dem=<?php echo $id_dem ?>">J'ai déja un compte locataire</a>
            </div>
        <?php }elseif($decision === 0){ ?>
            <div class="container">
            <h2>Votre Demande A Été Refusée</h2>
            <a href="./?action=supprDem&id_dem=<?php echo $id_dem ?>">Supprimer la demande</a>
            </div>

        <?php }elseif($decision === NULL){ ?>
    <div class="container">
        <h2>Profil du Demandeur</h2>
        <div class="profile-info">
            <label for="nom">Nom :</label>
            <span id="nom"><?php echo $nomDem ?></span>
        </div>
        <div class="profile-info">
            <label for="prenom">Prénom :</label>
            <span id="prenom"><?php echo $prenomDem ?></span>
        </div>
        <div class="profile-info">
            <label for="adresse">Adresse :</label>
            <span id="adresse"><?php echo $adresseDem ?></span>
        </div>
        <div class="profile-info">
            <label for="ville">Ville :</label>
            <span id="ville"><?php echo $villeDem ?></span>
        </div>
        <div class="profile-info">
            <label for="codeville">Code Postale :</label>
            <span id="codeville"><?php echo $codevilleDem ?></span>
        </div>
        <div class="profile-info">
            <label for="telephone">Téléphone :</label>
            <span id="telephone"><?php echo $telDem ?></span>
        </div>
        <h3 style="color: red;">ATTENTION !</h3>
        <p style="color: red;">Veuillez conserver ce code pour vous connecté plus tard, sans ce code l'accès à votre compte demandeur sera impossible :</p>
        <div class="profile-info">
            <label for="code_dem"><strong>Code de connexion :</strong></label>
            <span id="code_dem"><strong><?php echo $code_dem ?></strong></span>
        </div>
    </div>
    <div class="bout">
        <a href="./?action=accueil" >Accueil</a>
        <br>
        <div class="suppr">
            <a href="./?action=deconnexion&id_dem=<?php echo $id_dem ?>">Déconnexion</a>
        </div>
        <div class="suppr">
            <a href="./?action=supprDem&id_dem=<?php echo $id_dem ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre demande ? Cette action est irréversible !')">Supprimer la demande</a>
        </div>
    </div>
    <script>
        function confirmerSuppression() {
            return confirm('Êtes-vous sûr de vouloir supprimer votre demande ? Cette action est irréversible !');
        }
    </script>
    <?php 
            }
            } ?>
</body>
</html>
