<?php
class demandeur 
{
    private $id_dem;
    private $nom_dem;
    private $prenom_dem;
    private $adresse_dem;
    private $ville_dem;
    private $codeville_dem;
    private $tel_dem;
    private $code_dem;
    private $decision;
    private $id_appartement;

    public function __construct($id_dem, $nom_dem, $prenom_dem, $adresse_dem, $ville_dem, $codeville_dem, $tel_dem, $code_dem, $decision, $id_appartement)
    {
        $this->id_dem = $id_dem;
        $this->nom_dem = $nom_dem;
        $this->prenom_dem = $prenom_dem;
        $this->adresse_dem = $adresse_dem;
        $this->ville_dem = $ville_dem;
        $this->codeville_dem = $codeville_dem;
        $this->tel_dem = $tel_dem;
        $this->code_dem = $code_dem;
        $this->decision = $decision;
        $this->id_appartement = $id_appartement;
    }

    public function getID()
    {
        return $this->id_dem;
    }

    public function getNom()
    {
        return $this->nom_dem;
    }

    public function getPrenom()
    {
        return $this->prenom_dem;
    }

    public function getAdresse()
    {
        return $this->adresse_dem;
    }

    public function getVille()
    {
        return $this->ville_dem;
    }

    public function getCodeVille()
    {
        return $this->codeville_dem;
    }

    public function getTelDem()
    {
        return $this->tel_dem;
    }

    public function getCodeDem()
    {
        return $this->code_dem;
    }

    public function getDecision()
    {
        return $this->decision;
    }

    public function getIdApparteDem()
    {
        return $this->id_appartement;
    }
}
?>