<?php 
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (isset($_POST['ENVIAR'])) {
		$expediente = $_POST['expediente'];
		$id_persona = $_POST['id_personas'];
		date_default_timezone_set('America/Caracas');
		$fecha = date("Y-m-d");

		$insert = mysqli_query($conexion,"
				INSERT INTO `expedientes`(`fecha_expediente`, `descripcion`, `id_personas`) 
				VALUES ('$fecha','$expediente','$id_persona')");

		if ($insert >= 1) {
			header("location: C_expedientes.php");

		}
	}

	$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Registrar evaluaciones</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/consultas.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.min.css"/>
	<style>
		body{
			background:url(img/font.jpg) no-repeat;
			background-size: 100% 100%;
			background-position: center;
		}

		.navbar{
			margin-bottom: 0px;
			width: 100%;
			margin: 4px auto;
			background-color: rgba(255,255,255,.8);
			border: 0px;
			border-radius: 0px;
		}

		.navbar-right{
			margin-right: 5px;
		}

		textarea {
		  width: 500px;
		  height: 100px;
		  margin-top: 30px;
		}

	</style>
</head>
<body>
	<div class="container">
		<?php 
			include('include/header.php');
		 ?>
		<div class="user">
			<?php 
				include("bienvenida.php");
			 ?>
		</div>

    	<div class="row">
		  	<div class="col-md-12">
				<section class="container" id="container1">
					<h1>Crear evaluacion</h1>
					<form action="#" method="post">
						<table id="table-ninos">
							<thead>
								<tr>
									<th>Docente encargado</th>
									<th>Formular evaluacion</th>
									<th>Acción</th>
								</tr>
								<tr>
									<td>
										<select class="form-control">
											<option value="0">Seleccione</option>
									        <?php
									          $query = mysqli_query ($conexion,"SELECT 
t1.`id`,t1.`telefono`, t1.`profesion`, t1.`cargo_id`, 
t2.`nombre`, t2.`apellido`, t2.`cedula`, t2.`fecha_nac`,
t3.`descripcion` AS direccion,
t4.`descripcion` AS parroquia,
t6.`descripcion` AS cargo
FROM `personal` t1 
INNER JOIN `personas` t2 ON t1.`persona_id` = t2.`id` 
INNER JOIN `direcciones` t3 ON t3.`persona_id` = t2.`id`
INNER JOIN `parroquias` t4 ON t3.`parroquia_id` = t4.`id`
INNER JOIN `eav` t6 ON t1.`cargo_id` = t6.`id`
WHERE t1.`cargo_id`= 6
");
									          while ($docente = mysqli_fetch_array($query)) {
									            echo '<option value="">'.$docente[nombre].' '.$docente[apellido].'</option>';
									          }
									        ?>
										</select>
									</td>
									<td><textarea name="expediente"></textarea></td>
									<td><input class="btn btn-primary" type="submit" name="ENVIAR" onclick="alert('Guardado exitosa mente')" value="Guardar expediente"></td>
								</tr>
							</thead>
						</table>
						<input type="hidden" name="id_personas" value="<?php echo $id; ?>">

					</form>
			</div>
		</div>
		<?php 
			include('include/footer.php');
		 ?>
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
</html>