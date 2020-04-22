<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class request{
    private $query;
    private $bdd;
    function __construct($query)
    {
        $this->query = $query;
        $this->bdd =
            new Servidor_Base_Datos(
                $_SESSION['DBServer1'],
                $_SESSION['DBUser1'],
                $_SESSION['DBPwd1'],
                $_SESSION['DBName1']);
    }
    public function response(){
        $this->bdd->consultar("SET NAMES 'utf8'");
        $this->bdd->consultar($this->query);
        return getJSON($this->bdd->resultado);
    }
    public function response2(){
        $this->bdd->consultar("SET NAMES 'utf8'");
        $this->bdd->consultar($this->query);
        return getArray($this->bdd->resultado);
    }
    public function execute(){
        $this->bdd->consultar("SET NAMES 'utf8'");
        $this->bdd->consultar($this->query);
    }

    public function arrayResponse(){
        $this->bdd->consultar("SET NAMES 'utf8'");
        $this->bdd->consultar($this->query);
        return getArray($this->bdd->resultado);
    }
}