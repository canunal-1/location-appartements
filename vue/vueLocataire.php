<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locataire</title>
    <link rel="stylesheet" href="../css/locataire.css">
</head>
<body>
<header>
        <h1>Locataire</h1>
        <a href="./?action=defaut">Accueil</a>
    </header>
    <div class="container">
        <div class="choice">
            <h2>Choisissez une option :</h2>
            <div class="options">
                <a href="#" class="option" id="connexion-link">Connexion</a>
            </div>
        </div>
        <div class="form" id="connexion-form">
            <h2>Connexion</h2>
            <?php if(isset($_GET['action']) && $_GET['action'] == 'connexionLoc'){ ?>
            <form action="./?action=connexionLoc" method="POST">
            <?php }elseif(isset($_GET['action']) && $_GET['action'] == 'avoirCompteLoc'){ ?>
                <form action="./?action=avoirCompteLoc&id_dem=<?php echo $id_dem ?>" method="POST">
            <?php } ?>
                <label for="mailLoc">Adresse Email :</label>
                <input type="email" id="mailLoc" name="mailLoc" required>
                <label for="mdpLoc">Mot de passe :</label>
                <input type="password" id="mdpLoc" name="mdpLoc" required>
                <button type="submit">Se Connecter</button>
            </form>
        </div>
    </div>

    <script>
        const connexionLink = document.getElementById("connexion-link");
        const connexionForm = document.getElementById("connexion-form");

        connexionLink.addEventListener("click", () => {
            connexionForm.classList.add("active");
            inscriptionForm.classList.remove("active");
        });

        inscriptionLink.addEventListener("click", () => {
            inscriptionForm.classList.add("active");
            connexionForm.classList.remove("active");
        });

    </script>

</body>
</html>
