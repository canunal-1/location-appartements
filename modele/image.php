<?php
class image
{
    private $id_image;
    private $chemin_image;
    private $id_appartement;

    public function __construct($id_image, $chemin_image, $id_appartement)
    {
        $this->id_image = $id_image;
        $this->chemin_image = $chemin_image;
        $this->id_appartement = $id_appartement;
    }

    public function getID()
    {
        return $this->id_image;
    }

    public function getChmImgae()
    {
        return $this->chemin_image;
    }

    public function IdApparte()
    {
        return $this->id_appartement;
    }
}
?>