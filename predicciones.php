<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'controlador.php';
require_once 'lib/Servidor_Base_Datos.php';
require_once 'lib/request.php';
require_once 'lib/toJSON.php';


        $query = "
		SELECT p.id id, p.prediccion prediccion, date_format(p.fecha, '%d-%m-%Y') fecha, date_format(p.fecha, '%h:%i:%s') hora, t.description tipo from prediccion p join tipo t on p.tipo = t.id 
		where p.status = 0;
		";


        $request = new request($query);
        $arr = $request->arrayResponse();
?>



<!DOCTYPE HTML5>
<html>
	<head>
		<title>Predicciones del Clima</title>
		<link rel="stylesheet" href="assets/css/prism.css">
	    <link rel="stylesheet" href="assets/css/ghpages-materialize.css">
	    <link rel="stylesheet" href="assets/css/materialize.min.css">
	    <link rel="stylesheet" href="assets/css/mystyles.css">

	</head>
	<body>
		<div class="row">
				<div class="col l2 m1 s0">
				</div>
				<div class="col l8 m10 s12">
							<h1>Predicciones</h1>
				</div>
				<div class="col l2 m1 s0">
				</div>
			</div>
		<table border="1" style="width: 80%; margin-left: 	10%">

		<tr>
			<th>No</th>
			<th>Tipo de Clima</th>
			<th>Predicción</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th></th>
		</tr>
		<?php for($i = 0; $i<sizeof($arr); $i++){ ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $arr[$i]['tipo']; ?></td>
				<td><?php echo $arr[$i]['prediccion']; ?></td>
				<td><?php echo $arr[$i]['fecha']; ?></td>
				<td><?php echo $arr[$i]['hora']; ?></td>
				<td>
					<?php echo "<span class=\"input-field\"><a class=\"btn red\" href=\"#\" onclick=\"deleteReg(".$arr[$i]['id'].")\">Eliminar</a></span>"; ?>
				</td>
			</tr>
		<?php  } ?>
		</table>

<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/materialize.min.js"></script>
<script src="utils/principal-menu.js"></script>
<script>
	function deleteReg(reg){
		if(confirm('Esta a Punto de eliminar un registro desea continuar?')){
		$.get("endpoints/deletePrediccion.php?id="+reg, function(data){
	            window.location.reload();
	        });	
	}
	}
</script>

	</body>
</html>
