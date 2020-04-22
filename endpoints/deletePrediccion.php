<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../controlador.php';
require_once '../lib/Servidor_Base_Datos.php';
require_once '../lib/request.php';
require_once '../lib/toJSON.php';


$id = $_GET['id'];
echo $id;

$tipoclima = $_POST['tipoclima'];
$prediccion = $_POST['prediccion'];
$fecha = date("Y-m-d h:i:s");
        $query = "
		update prediccion set status = 1 where id = $id;
		";


        $request = new request($query);
        $request->execute();
