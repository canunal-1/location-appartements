<?php
include_once "demandeur.php";

class demandeurBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function addDemandeur(demandeur $demandeur)
    {
        try {
            $req = $this->conn->prepare("INSERT INTO demandeur (id_dem, nom_dem, prenom_dem, adresse_dem, ville_dem, codeville_dem, tel_dem, code_dem, decision, id_appartement) values (:id_dem, :nom_dem, :prenom_dem, :adresse_dem, :ville_dem, :codeville_dem, :tel_dem, :code_dem, :decision,:id_appartement)");
            $req->bindValue(':id_dem', $demandeur->getID());
            $req->bindValue(':nom_dem', $demandeur->getNom());
            $req->bindValue(':prenom_dem', $demandeur->getPrenom());
            $req->bindValue(':adresse_dem', $demandeur->getAdresse());
            $req->bindValue(':ville_dem', $demandeur->getVille());
            $req->bindValue(':codeville_dem', $demandeur->getCodeVille());
            $req->bindValue(':tel_dem', $demandeur->getTelDem());
            $req->bindValue(':code_dem', $demandeur->getCodeDem());
            $req->bindValue(':decision', $demandeur->getDecision());
            $req->bindValue(':id_appartement', $demandeur->getIdApparteDem());
            $req->execute();

            // Récupérer l'ID de la personne ajoutée
            $lastInsertedID = $this->conn->lastInsertId();
        
            // Retourner l'objet personne avec l'ID attribué
            return $this->getDemandeurById($lastInsertedID);

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage();
                die();
            }
    }

    public function getDemandeurById($id_dem)
    {
        try{
            $req = $this->conn->prepare("SELECT * FROM demandeur WHERE id_dem=:id_dem");
            $req->bindValue(":id_dem", $id_dem);

            $req->execute();

            $resultat=$req->fetch(PDO::FETCH_ASSOC);
            if($resultat){
                $demandeur = new demandeur(
                    $resultat["id_dem"],
                    $resultat["nom_dem"],
                    $resultat["prenom_dem"],
                    $resultat["adresse_dem"],
                    $resultat["ville_dem"],
                    $resultat["codeville_dem"],
                    $resultat["tel_dem"],
                    $resultat["code_dem"],
                    $resultat["decision"],
                    $resultat["id_appartement"]
                );
                return $demandeur;
            }
            else{
                return null;
            }

        } catch(PDOException $e){
            print "Erreur !: ". $e->getMessage();
            die();
        }
    }

    public function getDemandeurByCode($code_dem)
    {
        try{
            $req = $this->conn->prepare("SELECT * FROM demandeur WHERE code_dem=:code_dem");
            $req->bindValue(":code_dem", $code_dem);

            $req->execute();

            $resultat=$req->fetch(PDO::FETCH_ASSOC);
            if($resultat){
                $demandeur = new demandeur(
                    $resultat["id_dem"],
                    $resultat["nom_dem"],
                    $resultat["prenom_dem"],
                    $resultat["adresse_dem"],
                    $resultat["ville_dem"],
                    $resultat["codeville_dem"],
                    $resultat["tel_dem"],
                    $resultat["code_dem"],
                    $resultat["decision"],
                    $resultat["id_appartement"]
                );
                return $demandeur;
            }
            else{
                return null;
            }

        } catch(PDOException $e){
            print "Erreur !: ". $e->getMessage();
            die();
        }
    }

    public function genererCodeAleatoire($longueur) {
        $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurCode = strlen($caracteres);
        
        // Générer un code unique
        do {
            $code = '';
            for ($i = 0; $i < $longueur; $i++) {
                $position = rand(0, $longueurCode - 1);
                $code .= $caracteres[$position];
            }
            
            // Vérifier si le code généré existe déjà dans la base de données
            $req = $this->conn->prepare("SELECT COUNT(*) AS count FROM demandeur WHERE code_dem = ?");
            $req->execute([$code]);
            $row = $req->fetch(PDO::FETCH_ASSOC);
            $count = $row['count'];
        } while ($count > 0);
        
        return $code;
    }

    public function getDemandeurByIdNotif($id_notification)
    {
        try {
            $req = $this->conn->prepare("SELECT d.* FROM demandeur d INNER JOIN notification n ON d.id_dem = n.id_dem WHERE n.id_notification = :id_notification");
            $req->bindValue(':id_notification', $id_notification, PDO::PARAM_INT);
            $req->execute();
    
            $resultat = $req->fetch(PDO::FETCH_ASSOC);
    
            if ($resultat) {
                $demandeur = new demandeur(
                    $resultat["id_dem"],
                    $resultat["nom_dem"],
                    $resultat["prenom_dem"],
                    $resultat["adresse_dem"],
                    $resultat["ville_dem"],
                    $resultat["codeville_dem"],
                    $resultat["tel_dem"],
                    $resultat["code_dem"],
                    $resultat["decision"],
                    $resultat["id_appartement"]
                );
    
                return $demandeur;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function accepterDemande($id_dem) {
        try {
            $req = $this->conn->prepare("UPDATE demandeur SET decision = 1 WHERE id_dem = :id_dem");
            $req->bindValue(':id_dem', $id_dem, PDO::PARAM_INT);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function refuserDemande($id_dem) {
        try {
            $req = $this->conn->prepare("UPDATE demandeur SET decision = 0 WHERE id_dem = :id_dem");
            $req->bindValue(':id_dem', $id_dem, PDO::PARAM_INT);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    

    public function deleteDemandeur($id_dem)
    {
        try {
            $query = "DELETE FROM demandeur WHERE id_dem = :id_dem";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_dem', $id_dem, PDO::PARAM_INT);
            $stmt->execute();

            return true; // Indique que la suppression s'est bien déroulée
        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message d'erreur et retourner false
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function isLoggedOnDEM() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;
    
        if (isset($_SESSION["code_dem"])) {
            $demandeurBD = new demandeurBD();
            $demandeur = $demandeurBD->getDemandeurByCode($_SESSION["code_dem"]);
            if ($demandeur->getCodeDem() == $_SESSION["code_dem"]
            ) {
                $ret = true;
            }
        }
        return $ret;
    }
}
?>