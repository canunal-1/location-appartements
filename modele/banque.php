<?php
class banque
{
    private $id_banque;
    private $code_banque;
    private $id_locataire;

    public function __construct($id_banque, $code_banque, $id_locataire)
    {
        $this->id_banque = $id_banque;
        $this->code_banque = $code_banque;
        $this->id_locataire = $id_locataire;
    }

    public function getIdBanque()
    {
        return $this->id_banque;
    }

    public function getCode()
    {
        return $this->code_banque;
    }

    public function getIdLocataire()
    {
        return $this->id_locataire;
    }

}
?>