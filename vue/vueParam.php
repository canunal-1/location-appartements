<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du compte</title>
    <link rel="stylesheet" href="../css/parametre.css">
</head>
<body>
    <header>
        <h1>Paramètres du compte</h1>
        <br>
        <a href="./?action=defaut">Accueil</a>
        <a href="javascript:history.back()">Retour</a>
    </header>

    <div class="container">

    <div class="modif">
        <a href="./?action=modifProfil&partie=nom">Modifier mon Nom</a>
        <br>
        <a href="./?action=modifProfil&partie=prenom">Modifier mon Prenom</a>
        <br>
        <a href="./?action=modifProfil&partie=mdp">Modifier mon Mot De Passe</a>
        <br>
        <a href="./?action=modifProfil&partie=adr">Modifier mon Adresse</a>
        <br>
        <a href="./?action=modifProfil&partie=tel">Modifier mon Numéro de Téléphone</a>
        <br>
    </div>
        <hr>

        <h2>Supprimer le compte</h2>
        <p>Attention : cette action est irréversible.</p>
        <?php if($auth->isLoggedOn()){ ?>
                <form action="./?action=supprCompte&id_proprietaire=<?php echo $id_proprietaire?>" method="POST">
        <?php }elseif($auth->isLoggedOnLoc()){ ?>
            <form action="./?action=supprCompte&id_locataire=<?php echo $id_locataire?>" method="POST">
            <?php } ?>
            <label for="confirmation">Pour confirmer, tapez votre mot de passe :</label>
            <input type="password" id="confirmation" name="confirmation" required>

            <button type="submit">Supprimer mon compte</button>
        </form>
    </div>
</body>
</html>
