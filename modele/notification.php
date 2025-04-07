<?php
class notification{

    private $id_notif;
    private $message;
    private $date_notif;
    private $id_proprietaire;
    private $id_dem;
    
    public function __construct($id_notif, $message, $date_notif, $id_proprietaire, $id_dem)
    {
        $this->id_notif = $id_notif;
        $this->message = $message;
        $this->date_notif = $date_notif;
        $this->id_proprietaire = $id_proprietaire;
        $this->id_dem = $id_dem;
    }

    public function getIdNotif()
    {
        return $this->id_notif;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getDateNotif()
    {
        return $this->date_notif;
    }

    public function getIdProprio()
    {
        return $this->id_proprietaire;
    }

    public function getIdDem()
    {
        return $this->id_dem;
    }
}
?>