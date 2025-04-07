<?php
include_once "notification.php";
class notificationBD
{
    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function addNotif(notification $notification)
    {
        try {
            $req = $this->conn->prepare("INSERT INTO notification (id_notification, message, date_notif, id_proprietaire, id_dem) VALUES (:id_notification, :message, :date_notif, :id_proprietaire, :id_dem)");
            $req->bindValue(':id_notification', $notification->getIdNotif());
            $req->bindValue(':message', $notification->getMessage());
            $req->bindValue(':date_notif', $notification->getDateNotif());
            $req->bindValue(':id_proprietaire', $notification->getIdProprio());
            $req->bindValue(':id_dem', $notification->getIdDem());
            $req->execute();

            // Récupérer l'ID de la personne ajoutée
            $lastInsertedID = $this->conn->lastInsertId();
        
            // Retourner l'objet personne avec l'ID attribué
            return $this->getNotifById($lastInsertedID);

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage();
                die();
            }
    }

    public function getNotifById($id_notification)
    {
        try{
            $req = $this->conn->prepare("SELECT * FROM notification WHERE id_notification=:id_notification");
            $req->bindValue(":id_notification", $id_notification);

            $req->execute();

            $resultat=$req->fetch(PDO::FETCH_ASSOC);
            if($resultat){
                $notification = new notification(
                    $resultat["id_notification"],
                    $resultat["message"],
                    $resultat["date_notif"],
                    $resultat["id_proprietaire"],
                    $resultat["id_dem"]
                );
                return $notification;
            }
            else{
                return null;
            }

        } catch(PDOException $e){
            print "Erreur !: ". $e->getMessage();
            die();
        }
    }

    public function getNotificationsByProprio($id_proprietaire)
    {
        try {
            $req = $this->conn->prepare("SELECT * FROM notification WHERE id_proprietaire = :id_proprietaire");
            $req->bindValue(':id_proprietaire', $id_proprietaire);
            $req->execute();

            $notifications = array();

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $notification = new notification(
                    $row["id_notification"],
                    $row["message"],
                    $row["date_notif"],
                    $row["id_proprietaire"],
                    $row["id_dem"]
                );

                $notifications[] = $notification;
            }

            return $notifications;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function getNotificationById($id_notification)
    {
        try {
            $req = $this->conn->prepare("SELECT * from notification where id_notification = :id_notification");
            $req->bindValue(':id_notification', $id_notification);
            $req->execute();

            // Assurez-vous que la requête ne retourne qu'une seule ligne
            if ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $notification = new notification(
                    $row["id_notification"],
                    $row["message"],
                    $row["date_notif"],
                    $row["id_proprietaire"],
                    $row["id_dem"]
                );

                return $notification;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function supprimeNotification(notification $notification) {
        try {
            $req = $this->conn->prepare("DELETE FROM notification WHERE id_notification = :id_notification");
            $id_notification = $notification->getIdNotif();
            $req->bindParam(':id_notification', $id_notification);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function countNotificationsByProprietaire($id_proprietaire)
{
    try {
        // Préparez la requête SQL pour compter le nombre de notifications pour un propriétaire donné
        $req = $this->conn->prepare("SELECT COUNT(*) AS total_notifications FROM notification WHERE id_proprietaire = :id_proprietaire");
        
        // Liaison du paramètre :id_proprietaire
        $req->bindValue(':id_proprietaire', $id_proprietaire, PDO::PARAM_INT);
        
        // Exécutez la requête
        $req->execute();
        
        // Récupérer le résultat
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        // Retourner le nombre total de notifications
        return $result['total_notifications'];

    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        echo "Erreur : " . $e->getMessage();
        return false; // Ou lancez une exception pour gérer l'erreur ailleurs
    }
}

public function deleteNotificationByIdDem($id_dem) {
    try {
        $req = $this->conn->prepare("DELETE FROM notification WHERE id_dem = :id_dem");
        $req->bindParam(':id_dem', $id_dem);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


}
?>