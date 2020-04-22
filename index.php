<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'controlador.php';
require_once 'lib/Servidor_Base_Datos.php';
require_once 'lib/request.php';
require_once 'lib/toJSON.php';
require_once 'endpoints/yahoodata.php';

$query = "
		SELECT * from tipo;
		";


        $request = new request($query);
        $tipos = $request->arrayResponse();

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
					<h1><?php echo $location ?></h1>
		</div>
		<div class="col l2 m1 s0">
		</div>
	</div>
	<div class="row">
		<div class="col l2 m1 s0">
		</div>
		<div class="col l8 m10 s12">
					<h3>Hoy</h3>
					<h5><?php echo $clima; ?></h5>

		</div>
		<div class="col l2 m1 s0">
		</div>
	</div>

		<div class="row">
		<div class="col l2 m1 s0">
		</div>
		<div class="col l4 m5 s6">
					<h1>
						<span style="font-size: 3.5em;">
							<?php echo $temperatura; ?>
						</span>
						<span>
							ºC
						</span>
					</h1>
		</div>
		<div class="col l4 m5 s6">
					<h5>Probabilidad de precipitaciones: <?php echo $precipitacion; ?>%</h5>
					<h5>Humedad: <?php echo $humedad; ?>%</h5>
					<h5>Viento: <?php echo $viento; ?> km/h</h5>

		</div>
		<div class="col l2 m1 s0">
		</div>
	</div>

<form action="endpoints/savePrediccion.php" method="post">
	<div class="row">
		<div class="col l2 m1 s0"></div>
		<div class="input-field col l4 m5 s12">
			<select style="width: 100%" name="tipoclima">
				<?php for($i = 0; $i<sizeof($tipos); $i++){ 
					echo "<option value=\"".$tipos[$i]['id']."\">".$tipos[$i]['description']."</option>";
				} ?>
			</select>
			<label for="tipoclima">Tipo de Clima</label>
		</div>
		<div class="input-field col l4 m5 s12">
			<input style="width: 100%" type="submit" class="btn" value="Enviar">
		</div>	
		<div class="col l2 m1 s0"></div>
	</div>
		<div class="row">
		<div class="col l2 m1 s0"></div>
		<div class="input-field col l8 m10 s12">
			<textarea name="prediccion" class="materialize-textarea" style="width: 100%; height: 20vh"></textarea>
			<label for="prediccion">Predicción</label>
		</div>
		<div class="col l2 m1 s0"></div>
	</div>
</form>


<script src="assets/js/jquery-3.1.1.min.js"></script>
<script src="assets/js/materialize.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('select');
		var instances = M.FormSelect.init(elems, {});
	});

	$(document).ready(function () {
		$('select').formSelect();
	});
</script>

<script src="utils/principal-menu.js"></script>

	</body>
</html>
