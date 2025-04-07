<?php
include_once "appartement.php";

class appartementBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

public function addAppart($appartement)
{
    try {
        $req = $this->conn->prepare("INSERT INTO appartements (id_appartement, villeAppart, rue, arrondissement, etage, type, prix_loc, prix_charg, ascenceur, preavis, date_libre, id_proprietaire) VALUES (:id_appartement, :villeAppart, :rue, :arrondissement, :etage, :type, :prix_loc, :prix_charg, :ascenceur, :preavis, :date_libre, :id_proprietaire)");
        $req->bindValue(':id_appartement', $appartement->getID());
        $req->bindValue(':villeAppart', $appartement->getVille());
        $req->bindValue(':rue', $appartement->getRue());
        $req->bindValue(':arrondissement', $appartement->getArr());
        $req->bindValue(':etage', $appartement->getEtage());
        $req->bindValue(':type', $appartement->getType());
        $req->bindValue(':prix_loc', $appartement->getPrixLoc());
        $req->bindValue(':prix_charg', $appartement->getPrixCharg());
        $req->bindValue(':ascenceur', $appartement->getAscenceur());
        $req->bindValue(':preavis', $appartement->getPreavis());
        $req->bindValue(':date_libre', $appartement->getDateLibre());
        $req->bindValue(':id_proprietaire', $appartement->getIdProprio());
        $req->execute();

        // Récupérer l'ID de l'appartement ajouté
        $lastInsertedID = $this->conn->lastInsertId();
        
        // Retourner l'objet appartement avec l'ID attribué
        return $this->getApparteById($lastInsertedID);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


    public function getAppartements()
    {
        $resultat = array();
    
        try {
            $req = $this->conn->prepare("SELECT * FROM appartements");
            $req->execute();
    
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
                $appartement = new appartement(
                        $ligne["id_appartement"],
                        $ligne["villeAppart"],
                        $ligne["rue"],
                        $ligne["arrondissement"],
                        $ligne["etage"],
                        $ligne["type"],
                        $ligne["prix_loc"],
                        $ligne["prix_charg"],
                        $ligne["ascenceur"],
                        $ligne["preavis"],
                        $ligne["date_libre"],
                        $ligne["id_proprietaire"]
                    );
                $resultat[] = $appartement;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public function getApparteById($id_appartement)
{
    try {
        $req = $this->conn->prepare("SELECT * FROM appartements WHERE id_appartement=:id_appartement");
        $req->bindValue(":id_appartement", $id_appartement);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            $appartement = new appartement(
                $resultat["id_appartement"],
                $resultat["villeAppart"],
                $resultat["rue"],
                $resultat["arrondissement"],
                $resultat["etage"],
                $resultat["type"],
                $resultat["prix_loc"],
                $resultat["prix_charg"],
                $resultat["ascenceur"],
                $resultat["preavis"],
                $resultat["date_libre"],
                $resultat["id_proprietaire"]
            );
            return $appartement;
        } else {
            return null;
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

    public function getApparteByIdProprio($id_proprietaire)
    {
        $resultat = array();
    
        try {
            $req = $this->conn->prepare("SELECT * FROM appartements WHERE id_proprietaire=:id_proprietaire");
            $req->bindValue(':id_proprietaire', $id_proprietaire, PDO::PARAM_STR);
            $req->execute();
    
            while ($ligne = $req->fetch(PDO::FETCH_ASSOC)) {
                $appartement = new appartement(
                        $ligne["id_appartement"],
                        $ligne["villeAppart"],
                        $ligne["rue"],
                        $ligne["arrondissement"],
                        $ligne["etage"],
                        $ligne["type"],
                        $ligne["prix_loc"],
                        $ligne["prix_charg"],
                        $ligne["ascenceur"],
                        $ligne["preavis"],
                        $ligne["date_libre"],
                        $ligne["id_proprietaire"]
                    );
                $resultat[] = $appartement;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public function deleteApparteByAppart($id_appartement)
    {
        try {
            $req = $this->conn->prepare("DELETE * FROM appartements WHERE id_proprietaire = :id_proprietaire");
            $req->bindParam(':id_appartement', $id_appartement);
            $req->execute();

            return true;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function deleteApparteByIdProprio($id_appartement, $id_proprietaire)
    {
        try {
            $req = $this->conn->prepare("DELETE FROM appartements WHERE id_appartement = :id_appartement and id_proprietaire = :id_proprietaire");
            $req->bindParam(':id_appartement', $id_appartement);
            $req->bindParam(':id_proprietaire', $id_proprietaire);
            $req->execute();

            return true;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
?>