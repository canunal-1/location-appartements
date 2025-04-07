<?php
include_once "$racine/modele/imageBD.php";
include_once "$racine/modele/appartementBD.php";

$id_appartement = isset($_GET['id_appartement']) ? intval($_GET['id_appartement']) : 0;

$appartementBD = new appartementBD();

$appartement = $appartementBD->getApparteById($id_appartement);

if (!$appartement) {
    echo "Le produit spécifié n'existe pas.";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification si des fichiers ont été envoyés
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        // Récupération de l'ID de l'appartement depuis l'URL
        $id_appartement = $_GET['id_appartement'];

        // Chemin vers le répertoire de stockage des images
        $targetDir = "image/";

        // Boucle à travers chaque fichier téléchargé
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            // Nom du fichier
            $fileName = basename($_FILES['images']['name'][$key]);

            // Chemin complet du fichier sur le serveur
            $targetFilePath = $targetDir . $fileName;

            // Vérification si le fichier est une image
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            if ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png" || $imageFileType == "gif") {
                // Déplacement du fichier vers le répertoire de stockage
                if (move_uploaded_file($tmpName, $targetFilePath)) {
                    // Instanciation de l'objet imageBD
                    $imageDB = new imageBD();

                    // Ajout de l'image à la base de données
                    $imageDB->addImage($targetFilePath, $id_appartement);
                    // Redirection vers la page d'accueil
                    header("Location: ./?action=defaut");
                }
            }
        }
    }
}
include "$racine/vue/vueAjoutImage.php";
?>