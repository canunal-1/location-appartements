<?php
class proprietaire
{
    private $id_proprietaire;
    private $nom;
    private $prenom;
    private $mail;
    private $mdp;
    private $adresse;
    private $ville;
    private $tel;

    public function __construct($id_proprietaire, $nom, $prenom, $mail, $mdp, $adresse, $ville, $tel)
    {
        $this->id_proprietaire = $id_proprietaire;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->tel = $tel;
    }

    public function getId()
    {
        return $this->id_proprietaire;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getMail()
    {
        return $this->mail;
    }
    public function getMdp()
    {
        return $this->mdp;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setMDP($mdp)
    {
        $this->mdp = $mdp;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }
}
?>