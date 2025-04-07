<?php
    include_once "proprietaireBD.php";
    include_once "locataireBD.php";
    include_once "demandeurBD.php";
    include_once "connexionPDO.php";
class authentification{

    private $conn;

    public function __construct()
    {
        $pdo = new connexionPDO();
        $this->conn = $pdo->getConn();
    }

    public function login($mail, $mdp)
    {
    if (!isset($_SESSION)) {
        session_start();
    }

    $proprietaireBD = new proprietaireBD();
    $proprietaire = $proprietaireBD->getProprioByMail($mail);

    if ($proprietaire) {
        $mdpBD = $proprietaire->getMdp();
        if (password_verify(trim($mdp), trim($mdpBD))) {
            // Le mot de passe est correct
            $_SESSION["mail"] = $mail;
            $_SESSION["mdp"] = $mdpBD;
            return true; 
        } else {
            return false; 
        }
    }
    }

    public function loginLoc($mailLoc, $mdpLoc)
    {
    if (!isset($_SESSION)) {
        session_start();
    }

    $locataireBD = new locataireBD();
    $locataire = $locataireBD->getLocataireByMail($mailLoc);

    if ($locataire) {
        $mdpBD = $locataire->getMdpLoc();
        if (password_verify(trim($mdpLoc), trim($mdpBD))) {
            // Le mot de passe est correct
            $_SESSION["mailLoc"] = $mailLoc;
            $_SESSION["mdpLoc"] = $mdpBD;
            return true; 
        } else {
            return false; 
        }
    }
    }

    public function loginDem($code_dem)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    
        $demandeurBD = new demandeurBD();
        $demandeur = $demandeurBD->getDemandeurByCode($code_dem);
    
        if ($demandeur) {
            $codeBD = $demandeur->getCodeDem();
            if (trim($code_dem) === trim($codeBD)) { // Comparaison simple
                $_SESSION["code_dem"] = $code_dem;
                return true; 
            } else {
                return false; 
            }
        }
    }
    

    public function logout() {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION["mail"]);
        unset($_SESSION["mdp"]);
    }

    public function logoutLoc() {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION["mailLoc"]);
        unset($_SESSION["mdpLoc"]);
    }

    public function logoutDem() {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION["code_dem"]);
    }

    public function getMailLoggedOn(){
        if ($this->isLoggedOn()){
            $ret = $_SESSION["mail"];
        }
        else {
            $ret = null;
        }
        return $ret;
    }

    public function getMailLoggedOnLoc(){
        if ($this->isLoggedOnLoc()){
            $ret = $_SESSION["mailLoc"];
        }
        else {
            $ret = null;
        }
        return $ret;
    }

    public function getCodeLoggedOnDem(){
        if ($this->isLoggedOnDEM()){
            $ret = $_SESSION["code_dem"];
        }
        else {
            $ret = null;
        }
        return $ret;
    }

    public function isLoggedOn() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;
    
        if (isset($_SESSION["mail"])) {
            $proprietaireBD = new proprietaireBD();
            $proprietaire = $proprietaireBD->getProprioByMail($_SESSION["mail"]);
            if ($proprietaire && $proprietaire->getMail() == $_SESSION["mail"] && $proprietaire->getMdp() == $_SESSION["mdp"]
            ) {
                $ret = true;
            }
        }
        return $ret;
    }

    public function isLoggedOnLoc() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;
    
        if (isset($_SESSION["mailLoc"])) {
            $locataireBD = new locataireBD();
            $locataire = $locataireBD->getLocataireByMail($_SESSION["mailLoc"]);
            if ($locataire && $locataire->getMailLoc() == $_SESSION["mailLoc"] && $locataire->getMdpLoc() == $_SESSION["mdpLoc"]
            ) {
                $ret = true;
            }
        }
        return $ret;
    }

    public function isLoggedOnDEM() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;
    
        if (isset($_SESSION["code_dem"])) {
            $demandeurBD = new demandeurBD();
            $demandeur = $demandeurBD->getDemandeurByCode($_SESSION["code_dem"]);
            if ($demandeur && $demandeur->getCodeDem() == $_SESSION["code_dem"]) {
                $ret = true;
            }
        }
        return $ret;
    }
    


}