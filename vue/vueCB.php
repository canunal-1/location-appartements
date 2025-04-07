<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ajoutCB.css">
    <title>Ajout d'un compte bancaire</title>
        <div class="bank-account">
            <h2>Mon Compte Bancaire :</h2>
            <form action="./?action=ajtCB&id_locataire=<?php echo $id_locataire ?>" method="POST">
                <label for="iban">IBAN :</label>
                <input type="text" id="iban" name="iban" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>
        <a href='#'>Annuler</a>