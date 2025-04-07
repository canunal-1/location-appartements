<?php
include_once "proprietaire.php";

class proprietaireBD{

private $conn;

public function __construct()
{
    $pdo = new connexionPDO();
    $this->conn = $pdo->getConn();
}

public function addPropio($proprietaire)
{
    $mdp = $proprietaire->getMdp();
    $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);

    try {
        $req = $this->conn->prepare("INSERT INTO proprietaires (id_proprietaire, nom, prenom, mail, mdp, adresse, ville, tel) values (:id_proprietaire, :nom, :prenom, :mail, :mdp, :adresse, :ville, :tel)");
        $req->bindValue(':id_proprietaire', $proprietaire->getID());
        $req->bindValue(':nom', $proprietaire->getNom());
        $req->bindValue(':prenom', $proprietaire->getPrenom());
        $req->bindValue(':mail', $proprietaire->getMail());
        $req->bindValue(':mdp', $mdpHash);
        $req->bindValue(':adresse', $proprietaire->getAdresse());
        $req->bindValue(':ville', $proprietaire->getVille());
        $req->bindValue(':tel', $proprietaire->getTel());
        $req->execute();

        // Récupérer l'ID de la personne ajoutée
        $lastInsertedID = $this->conn->lastInsertId();
    
        // Retourner l'objet personne avec l'ID attribué
        return $this->getProprioByID($lastInsertedID);

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
}

public function getProprios()
{
    try {
        $req = $this->conn->prepare("SELECT * from proprietaires");
        $req->execute();
        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        if ($resultat) {
            foreach ($resultat as $ligne ) {
                $proprietaire = new proprietaire(
                    $ligne["id_proprietaire"],
                    $ligne["nom"],
                    $ligne["prenom"],
                    $ligne["mail"],
                    $ligne["mdp"],
                    $ligne["adresse"],
                    $ligne["ville"],
                    $ligne["tel"]
                );
                $proprietaires[] = $proprietaire;
            }
            return $proprietaire;
        }
        else{
            return null;
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

public function getProprioById($id_proprietaire)
{
    try{
        $req = $this->conn->prepare("SELECT * FROM proprietaires WHERE id_proprietaire=:id_proprietaire");
        $req->bindValue(":id_proprietaire", $id_proprietaire);

        $req->execute();

        $resultat=$req->fetch(PDO::FETCH_ASSOC);
        if($resultat){
            $proprietaire = new proprietaire(
                $resultat["id_proprietaire"],
                $resultat["nom"],
                $resultat["prenom"],
                $resultat["mail"],
                $resultat["mdp"],
                $resultat["adresse"],
                $resultat["ville"],
                $resultat["tel"]
            );
            return $proprietaire;
        }
        else{
            return null;
        }

    } catch(PDOException $e){
        print "Erreur !: ". $e->getMessage();
        die();
    }
}

public function getProprioByMail($mail)
    {
        try {
            $req = $this->conn->prepare("SELECT * from proprietaires where mail=:mail");
            $req->bindValue(':mail', $mail);
            $req->execute();
            $resultat = $req->fetch(PDO::FETCH_ASSOC);

            if($resultat){
                return new proprietaire(
                    $resultat["id_proprietaire"],
                    $resultat["nom"],
                    $resultat["prenom"],
                    $resultat["mail"],
                    $resultat["mdp"],
                    $resultat["adresse"],
                    $resultat["ville"],
                    $resultat["tel"]
                );
            }
            else{
                return null;
            }

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function deleteProprietaire($id_proprietaire)
    {
        try {
            $query = "DELETE FROM proprietaires WHERE id_proprietaire = :id_proprietaire";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_proprietaire', $id_proprietaire, PDO::PARAM_INT);
            $stmt->execute();

            return true; // Indique que la suppression s'est bien déroulée
        } catch (PDOException $e) {
            // En cas d'erreur, afficher un message d'erreur et retourner false
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function updateProprio(proprietaire $proprietaire)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE proprietaires SET nom = :nom, prenom = :prenom, mdp = :mdp, adresse = :adresse, ville = :ville, tel = :tel WHERE mail = :mail");
            $stmt->bindParam(':nom', $proprietaire->getNom());
            $stmt->bindParam(':prenom', $proprietaire->getPrenom());
            $stmt->bindParam(':mdp', $proprietaire->getMdp());
            $stmt->bindParam(':adresse', $proprietaire->getAdresse());
            $stmt->bindParam(':ville', $proprietaire->getVille());
            $stmt->bindParam(':tel', $proprietaire->getTel());
            $stmt->bindParam(':mail', $proprietaire->getMail());
            
            $stmt->execute();
            
            // Si vous avez besoin de retourner quelque chose après la mise à jour, vous pouvez le faire ici
            
            return true; // Indique que la mise à jour s'est bien déroulée
        } catch (PDOException $e) {
            // Vous pouvez gérer l'erreur de mise à jour ici
            return false; // Indique que la mise à jour a échoué
        }
    }

    public function updtMdpProprio($proprietaire, $mdpNouveau) 
    {
        $resultat = -1;
        try {
            $mdpAncien = $this->getMDPById($proprietaire->getId());
    
            if (password_verify($mdpNouveau['ancien'], $mdpAncien)) {
            $mdpHash = password_hash($mdpNouveau['nouveau'], PASSWORD_BCRYPT );
            $req = $this->conn->prepare("UPDATE proprietaires set mdp=:mdp where id_proprietaire=:id_proprietaire");
            $req->bindValue(':id_proprietaire', $proprietaire->getId(), PDO::PARAM_STR);
            $req->bindValue(':mdp', $mdpHash, PDO::PARAM_STR);

            $resultat = $req->execute();
            }else{
                $resultat = 0;
            }
        }
        catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public function getMDPById($id_proprietaire)
    {
    try {
        $req = $this->conn->prepare("SELECT mdp FROM proprietaires WHERE id_proprietaire = :id_proprietaire");
        $req->bindParam(':id_proprietaire', $id_proprietaire);
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            return $resultat['mdp'];
        } else {
            return null;
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    }
}
?>