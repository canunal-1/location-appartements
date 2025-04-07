<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétaire</title>
    <link rel="stylesheet" href="../css/locataire.css">
</head>
<body>
<header>
        <h1>Propriétaire</h1>
        <a href="./?action=defaut">Accueil</a>
    </header>
    <div class="container">
        <div class="choice">
            <h2>Choisissez une option :</h2>
            <div class="options">
                <a href="#" class="option" id="connexion-link">Connexion</a>
                <a href="#" class="option" id="inscription-link">Inscription</a>
            </div>
        </div>
        <div class="form" id="connexion-form">
            <h2>Connexion</h2>
            <form action="./?action=connexion" method="POST">
                <label for="email">Adresse Email :</label>
                <input type="email" id="email" name="email" required>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
                <button type="submit">Se Connecter</button>
            </form>
        </div>
        <div class="form" id="inscription-form">
            <h2>Inscription</h2>
            <form action="./?action=inscription" method="POST">
            <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
                
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
                
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" required>
                
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" required>
                
                <label for="confirmer_mdp">Confirmer le mot de passe :</label>
                <input type="password" id="confirmer_mdp" name="confirmer_mdp" required>
                
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>
                
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required>
                
                <label for="tel">Téléphone :</label>
                <input type="tel" id="tel" name="tel" required>
                <br>
                <br>
                <button type="submit">S'Inscrire</button>
            </form>
        </div>
    </div>

    <script>
        const connexionLink = document.getElementById("connexion-link");
        const inscriptionLink = document.getElementById("inscription-link");
        const connexionForm = document.getElementById("connexion-form");
        const inscriptionForm = document.getElementById("inscription-form");

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
