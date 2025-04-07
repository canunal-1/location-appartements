<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modifProfil.css">
    <title>Modifier Mon Profil</title>
</head>
<body>
    <header>
        <h1>Modifier Le Profil</h1>
        <br>
        <a href="./?action=defaut">Accueil</a>
        <a href="javascript:history.back()">Retour</a>
    </header>

    <?php if ($_GET['partie'] === 'nom'): ?>
        <!-- Formulaire pour modifier le nom -->
        <form action="./?action=modifProfil&partie=nom" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $nom ?>">
            <input type="submit" value="Enregistrer les modifications">
        </form>
    <?php elseif ($_GET['partie'] === 'prenom'): ?>
        <!-- Formulaire pour modifier le prénom -->
        <form action="./?action=modifProfil&partie=prenom" method="post">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>">
            <input type="submit" value="Enregistrer les modifications">
        </form>
    <?php elseif ($_GET['partie'] === 'adr'): ?>
        <!-- Formulaire pour modifier l'adresse -->
        <form action="./?action=modifProfil&partie=adr" method="post">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $adresse ?>">
            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" value="<?php echo $ville ?>">
            <input type="submit" value="Enregistrer les modifications">
        </form>
        <?php elseif ($_GET['partie'] === 'mdp'): ?>
        <!-- Formulaire pour modifier l'adresse -->
        <form action="./?action=modifProfil&partie=mdp" method="post">
            <label for="mdp">Saisir le Mot De Passe Actuel :</label>
            <input type="password" id="mdp" name="mdp">
            <label for="mdp1">Saisir le nouveau Mot De Passe :</label>
            <input type="password" id="mdp1" name="mdp1">
            <label for="mdp2">Confirmer le nouveau Mot De Passe :</label>
            <input type="password" id="mdp2" name="mdp2">
            <input type="submit" value="Enregistrer les modifications">
        </form>
    <?php elseif ($_GET['partie'] === 'tel'): ?>
        <!-- Formulaire pour modifier le téléphone -->
        <form action="./?action=modifProfil&partie=tel" method="post">
            <label for="tel">Téléphone :</label>
            <input type="tel" id="tel" name="tel" value="<?php echo $tel ?>">
            <input type="submit" value="Enregistrer les modifications">
        </form>
    <?php endif; ?>
</body>
</html>
