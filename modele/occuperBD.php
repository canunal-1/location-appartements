<?php
include_once "occuper.php";
class occuperBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function addOccuper($occuper)
    {
        try {
            $req = $this->conn->prepare("INSERT INTO occuper (id_appartement, id_locataire) VALUES (:id_appartement, :id_locataire)");
            $req->bindValue(':id_appartement', $occuper->getIdApparte());
            $req->bindValue(':id_locataire', $occuper->getIdLocataire());
            $req->execute();

            return true; // Indique que l'ajout de l'occupant s'est bien déroulé
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getAppartementInfoById($id_appartement)
    {
        try {
            // Requête pour récupérer les informations de l'appartement en fonction de son ID
            $query = "SELECT * FROM appartements WHERE id_appartement = :id_appartement";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_appartement', $id_appartement, PDO::PARAM_INT);
            $stmt->execute();

            // Récupération des résultats
            $appartement = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retourne les informations de l'appartement
            return $appartement;
        } catch (PDOException $e) {
            // En cas d'erreur, affiche un message d'erreur
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    public function getLocationsByLocataire($mailLoc)
    {
        try {
            $query = "SELECT * FROM occuper o INNER JOIN appartements a ON o.id_appartement = a.id_appartement WHERE o.id_locataire IN (SELECT id_locataire FROM locataires WHERE mailLoc = :mailLoc)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':mailLoc', $mailLoc);
            $stmt->execute();

            $locations = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $location = new occuper($row['id_appartement'], $row['id_locataire']);
                $locations[] = $location;
            }

            return $locations;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getInfoLocationByLocataire($id_locataire)
{
    try {
        $query = "SELECT a.id_appartement, a.villeAppart, a.rue, a.arrondissement, a.etage, a.type, a.prix_loc, a.prix_charg, a.ascenceur, a.preavis, a.date_libre, a.id_proprietaire
                  FROM occuper o
                  INNER JOIN appartements a ON o.id_appartement = a.id_appartement
                  WHERE o.id_locataire = :id_locataire";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_locataire', $id_locataire, PDO::PARAM_INT);
        $stmt->execute();

        $locations = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $appartement = new appartement(
                $row['id_appartement'],
                $row['villeAppart'],
                $row['rue'],
                $row['arrondissement'],
                $row['etage'],
                $row['type'],
                $row['prix_loc'],
                $row['prix_charg'],
                $row['ascenceur'],
                $row['preavis'],
                $row['date_libre'],
                $row['id_proprietaire']
            );
            $locations[] = $appartement;
        }
        return $locations;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return [];
    }
}

public function isAppartementOccupied($id_appartement)
    {
        try {
            $query = "SELECT COUNT(*) AS count FROM occuper WHERE id_appartement = :id_appartement";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_appartement', $id_appartement, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $row['count'];
            return $count > 0; // Si le compte est supérieur à zéro, l'appartement est occupé
        } catch (PDOException $e) {
            // Gérer l'erreur ici (optionnel)
            return false; // En cas d'erreur, on suppose que l'appartement n'est pas occupé
        }
    }

    
}
?>