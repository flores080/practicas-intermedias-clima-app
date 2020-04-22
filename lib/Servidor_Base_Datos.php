<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Servidor_Base_Datos
{
    private $servidor;
    private $usuario;
    private $pass;
    private $base_datos;
    private $descriptor;
    public $resultado;

    function __construct($servidor, $usuario, $pass, $base_datos)
    {
        $this->servidor = $servidor;
        $this->usuario = $usuario;
        $this->pass = $pass;
        $this->base_datos = $base_datos;
        $this->conectar_base_datos();
    }

    private function conectar_base_datos()
    {


        $this->descriptor = mysqli_connect($this->servidor, $this->usuario, $this->pass);
        mysqli_query($this->descriptor,"SET NAMES 'utf8'");
        mysqli_query($this->descriptor,"SET CHARACTER_SET NAMES 'utf8'");
        mysqli_select_db($this->descriptor, $this->base_datos);

        //if (!$this->descriptor){header('Location: ./404.php');}

    }

    public function parametros()
    {
        return $this->servidor . " " . $this->usuario . " " . $this->pass . " " . $this->base_datos;
    }

    public function verConsulta($campos, $tabla, $restriccion, $order)
    {
        $query = "SELECT " . $campos . " ";
        $query = $query . "FROM " . $tabla . " ";
        if ($restriccion != "") {
            $query = $query . "WHERE " . $restriccion . " ";
        }
        if ($order != "") {
            $query = $query . "ORDER BY " . $order;
        }

        return $query;
    }

    public function consultar($consulta)
    {
        $this->resultado = mysqli_query($this->descriptor, $consulta);
    }


    public function cunsultaTradicional($campos, $tabla, $restriccion, $order)
    {
        $query = "SELECT " . $campos . " ";
        $query = $query . "FROM " . $tabla . " ";
        if ($restriccion != "") {
            $query = $query . "WHERE " . $restriccion . " ";
        }
        if ($order != "") {
            $query = $query . "ORDER BY " . $order;
        }
        $this->resultado = mysqli_query($this->descriptor, $query);
    }


    public function cunsultaTradicionalDistintoDe($campos, $tabla, $restriccion, $order)
    {
        $query = "SELECT DISTINCT " . $campos . " ";
        $query = $query . "FROM " . $tabla . " ";
        if ($restriccion != "") {
            $query = $query . "WHERE " . $restriccion . " ";
        }
        if ($order != "") {
            $query = $query . "ORDER BY " . $order;
        }

        $this->resultado = mysqli_query($this->descriptor, $query);

    }


    public function consultacatalogo($catalogo)
    {
        $query = "SELECT id,nombre FROM " . $catalogo . " WHERE estado=1";
        $this->resultado = mysqli_query($this->descriptor, $query);
    }

    public function insertarRegistro($tabla, $campos, $valores)
    {
        $query = "INSERT INTO " . $tabla;
        $query .= " (" . $campos . ") VALUES (" . $valores . ") ";
        $this->resultado = mysqli_query($this->descriptor, $query);
    }

    public function actualizarRegistro($tabla, $campos, $restriccion)
    {
        $query = "UPDATE " . $tabla . " SET ";
        $query .= $campos;
        if ($restriccion != "") {
            $query .= " WHERE " . $restriccion;
        }
        $this->resultado = mysqli_query($this->descriptor, $query);


    }

    public function extraer_registro()
    {
        if ($fila = mysqli_fetch_array($this->resultado, MYSQLI_ASSOC)) {
            return $fila;
        }
        return false;
    }

    public function numero_filas()
    {
        if ($this->resultado) {
            return mysqli_num_rows($this->resultado);
        }
    }

    public function ultimoID()
    {
        return mysqli_insert_id($this->descriptor);
    }

    public function miconsulta($query)
    {
        return mysqli_query($this->descriptor, $query);
    }

    public function error()
    {
        return mysqli_error($this->descriptor);
    }
}

