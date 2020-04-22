<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../controlador.php';
require_once '../lib/Servidor_Base_Datos.php';
require_once '../lib/request.php';
require_once '../lib/toJSON.php';

$tipoclima = $_POST['tipoclima'];
$prediccion = $_POST['prediccion'];
$fecha = date("Y-m-d h:i:s");
        $query = "
		insert into prediccion(tipo, prediccion, fecha, status) values ($tipoclima, '$prediccion', '$fecha', 0);
		";


        $request = new request($query);
        $request->execute();

//echo $tipoclima." ".$prediccion;
?>

<!DOCTYPE HTML5>
<html>
	<head>
		<title>Predicciones del Clima</title>
		<link rel="stylesheet" href="../assets/css/prism.css">
	    <link rel="stylesheet" href="../assets/css/ghpages-materialize.css">
	    <link rel="stylesheet" href="../assets/css/materialize.min.css">
	    <link rel="stylesheet" href="../assets/css/mystyles.css">

	</head>
	<body>
		
			<div class="row" style="padding-top: 30vh">
				<div class="col l2 m1 s0">
				</div>
				<div class="col l8 m10 s12">
							<h1 style="text-align: center;">Prediccion Almacenada con Exito</h1>
				</div>
				<div class="col l2 m1 s0">
				</div>
			</div>

				<div class="row">
				<div class="col l3 m2 s0">
				</div>
				<div class="input-field col l3 m4 s12" style="text-align: center;">
					<a class="btn" href="../index.php">Nueva Prediccion</a>
				</div>
				<div class="input-field col l3 m4 s12" style="text-align: center;">
					<a class="btn" href="../predicciones.php">Ver Reporte</a>		
				</div>
				<div class="col l3 m2 s0">
				</div>
			</div>
		

<script src="../assets/js/jquery-3.1.1.min.js"></script>
<script src="../assets/js/materialize.min.js"></script>
<script src="../utils/principal-menu.js"></script>

	</body>
</html>
