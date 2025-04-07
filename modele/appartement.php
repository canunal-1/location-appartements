<?php 
class appartement
{
    private $id_appartement;
    private $ville;
    private $rue;
    private $arrondissement;
    private $etage;
    private $type;
    private $prix_loc;
    private $prix_charg;
    private $ascenceur;
    private $preavis;
    private $date_libre;
    private $id_proprietaire;

    public function __construct($id_appartement, $ville, $rue, $arrondissement, $etage, $type, $prix_loc, $prix_charg, $ascenceur, $preavis, $date_libre, $id_proprietaire)
    {
        $this->id_appartement = $id_appartement;
        $this->ville = $ville;
        $this->rue = $rue;
        $this->arrondissement = $arrondissement;
        $this->etage = $etage;
        $this->type = $type;
        $this->prix_loc = $prix_loc;
        $this->prix_charg = $prix_charg;
        $this->ascenceur = $ascenceur;
        $this->preavis = $preavis;
        $this->date_libre = $date_libre;
        $this->id_proprietaire = $id_proprietaire;
    }

    public function getID()
    {
        return $this->id_appartement;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getRue()
    {
        return $this->rue;
    }

    public function getArr()
    {
        return $this->arrondissement;
    }

    public function getEtage()
    {
        return $this->etage;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPrixLoc()
    {
        return $this->prix_loc;
    }

    public function getPrixCharg()
    {
        return $this->prix_charg;
    }

    public function getAscenceur()
    {
        return $this->ascenceur;
    }

    public function getPreavis()
    {
        return $this->preavis;
    }

    public function getDateLibre()
    {
        return $this->date_libre;
    }

    public function getIdProprio()
    {
        return $this->id_proprietaire;
    }
}
?>