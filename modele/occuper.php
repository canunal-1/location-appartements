<?php
class occuper
{
    private $id_appartement;
    private $id_locataire;

    public function __construct($id_appartement, $id_locataire)
    {
        $this->id_appartement = $id_appartement;
        $this->id_locataire = $id_locataire;
    }

    public function getIdApparte()
    {
        return $this->id_appartement;
    }

    public function getIdLocataire()
    {
        return $this->id_locataire;
    }
}
?>