<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Demande</title>
    <link rel="stylesheet" href="../css/profil.css">
</head>
<body>
    <div class="confirme">
        <h2>Confirmation de Demande</h2>
        <h3 style="color: red;">ATTENTION !</h3>
        <p style="color: red;">Veuillez conserver ce code pour vous connecté plus tard, sans ce code l'accès à votre compte demandeur sera impossible :</p>
        <div class="profile-info">
            <label for="code_dem"><strong>Code de connexion :</strong></label>
            <span id="code_dem"><strong><?php echo $code_dem ?></strong></span>
        </div>
    </div>
    <div class="formulaire">
        <form action="./?action=connexionDem&id_appartement=<?php echo $id_appartement ?>" method="post">
            <label for="code_dem">Veuillez renseigner le code de connexion ci-dessus :</label>
            <br>
            <input type="text" id="code_dem" name="code_dem" required>
            <br>
            <input type="submit" value="Se connecter">
        </form>
    </div>
    <div class="bout">
        <div class="suppr">
            <a href="./?action=supprDem&id_dem=<?php echo $id_dem ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre demande ? Cette action est irréversible !')">Supprimer la demande</a>
        </div>
    </div>
    <script>
        function confirmerSuppression() {
            return confirm('Êtes-vous sûr de vouloir supprimer votre demande ? Cette action est irréversible !');
        }
    </script>
</body>
</html>
