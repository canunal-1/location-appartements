<?php
include_once "banque.php";

class banqueBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn(); 
    }

    public function addCB($banque)
    {
        try {
            // Insérez l'image dans la table images associée au produit
            $req = $this->conn->prepare("INSERT INTO banque (id_banque, code_banque, id_locataire) VALUES (:id_banque, :code_banque, :id_locataire)");
            $req->bindValue(':id_banque', $banque->getIdBanque());
            $req->bindValue(':code_banque', $banque->getCode());
            $req->bindValue(':id_locataire', $banque->getIdLocataire());
            $req->execute();

            return true; // Indique que l'ajout de l'image s'est bien déroulé
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getCBByIdLoc($id_locataire)
    {
        try{
            $req = $this->conn->prepare("SELECT * FROM banque WHERE id_locataire=:id_locataire");
            $req->bindValue(":id_locataire", $id_locataire);
    
            $req->execute();
    
            $resultat=$req->fetch(PDO::FETCH_ASSOC);
            if($resultat){
                $banque = new banque(
                    $resultat["id_banque"],
                    $resultat["code_banque"],
                    $resultat["id_locataire"]
                );
                return $banque;
            }
            else{
                return null;
            }
    
        } catch(PDOException $e){
            print "Erreur !: ". $e->getMessage();
            die();
        }
    }

    public function updateSolde($id_locataire, $nouveauSolde)
    {
        try {
            $req = $this->conn->prepare("UPDATE banque SET solde = :nouveauSolde WHERE id_locataire = :id_locataire");
            $req->bindValue(':nouveauSolde', $nouveauSolde);
            $req->bindValue(':id_locataire', $id_locataire);
            $req->execute();

            return true;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function deleteCB($id_locataire, $id_banque)
    {
        try {
            $req = $this->conn->prepare("DELETE FROM banque WHERE id_locataire = :id_locataire AND id_banque = :id_banque");
            $req->bindValue(':id_locataire', $id_locataire);
            $req->bindValue(':id_banque', $id_banque);
            $req->execute();

            return true;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
?>