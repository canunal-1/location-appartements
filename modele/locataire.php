<?php

class locataire
{
    private $id_locataire;
    private $nomLoc;
    private $prenomLoc;
    private $mailLoc;
    private $mdpLoc;
    private $dateNaiss;
    private $telLoc;

    public function __construct($id_locataire, $nomLoc, $prenomLoc, $mailLoc, $mdpLoc, $dateNaiss, $telLoc)
    {
        $this->id_locataire = $id_locataire;
        $this->nomLoc = $nomLoc;
        $this->prenomLoc = $prenomLoc;
        $this->mailLoc = $mailLoc;
        $this->mdpLoc = $mdpLoc;
        $this->dateNaiss = $dateNaiss;
        $this->telLoc = $telLoc;
    }

    public function getIdLoc()
    {
        return $this->id_locataire;
    }

    public function getNomLoc()
    {
        return $this->nomLoc;
    }

    public function getPrenomLoc()
    {
        return $this->prenomLoc;
    }

    public function getMailLoc()
    {
        return $this->mailLoc;
    }

    public function getMDPLoc()
    {
        return $this->mdpLoc;
    }

    public function getDateNaiss()
    {
        return $this->dateNaiss;
    }

    public function getTelLoc()
    {
        return $this->telLoc;
    }
}
?>