<?php
include_once "image.php";
class imageBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function addImage($chemin_image, $id_appartement)
    {
        try {
            // Insérez l'image dans la table images associée au produit
            $req = $this->conn->prepare("INSERT INTO image (chemin_image, id_appartement) VALUES (:chemin_image, :id_appartement)");
            $req->bindParam(':chemin_image', $chemin_image);
            $req->bindParam(':id_appartement', $id_appartement);
            $req->execute();

            return true; // Indique que l'ajout de l'image s'est bien déroulé
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getImageByAppart($id_appartement)
    {
        try {
            $req = $this->conn->prepare("select * from image where id_appartement=:id_appartement");
            $req->bindValue(':id_appartement', $id_appartement, PDO::PARAM_INT);

            $req->execute();

            $images = array();
            while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
                $image = new image(
                    $resultat["id_image"],
                    $resultat["chemin_image"],
                    $resultat["id_appartement"]
                );
                $images[] = $image;
            }

            return $images;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function deleteImagesByAppart($id_appartement)
    {
        try {
            $req = $this->conn->prepare("DELETE FROM image WHERE id_appartement = :id_appartement");
            $req->bindParam(':id_appartement', $id_appartement);
            $req->execute();

            return true;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function deleteAllImagesByProprio($id_appartement)
    {
        try {
            $req = $this->conn->prepare("DELETE FROM image WHERE id_appartement = :id_appartement");
            $req->bindParam(':id_appartement', $id_appartement);
            $req->execute();

            return true;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
?>