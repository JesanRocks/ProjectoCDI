<?php
	include("conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	// if (empty($_GET['id'])) {
	// 	header("Location: C_ninos.php");
	// }

	$id = $_GET['id'];

	$sql = mysqli_query($conexion,"
		SELECT 
		t1.`id`,
		t1.`nivel_educ`,
		t1.`estatus_id`,
		t2.`id` AS persona_id,
		t2.`nombre`,
		t2.`apellido`,
		t2.`sexo`,
		t2.`cedula`,
		t2.`fecha_nac`,
		t2.`lugar_nac`,
		t3.`descripcion` AS direccion,
		t3.`parroquia_id`,
		t4.`descripcion` AS parroquia, 
		t5.`condicion_id`,
		t6.`descripcion` AS condicion,
		t7.`docente_id`,
		t8.`persona_id` AS docente,
		t9.`nombre` AS nomDocente,
		t9.`apellido` AS apeDocente,
		t10.`descripcion` AS estatus
		FROM `ninos` t1 
		INNER JOIN `personas` 		t2 ON t1.`persona_id` = t2.`id`
		INNER JOIN `direcciones` 	t3 ON t2.`id` = t3.`persona_id` 
		INNER JOIN `parroquias` 	t4 ON t4.`id` = t3.`parroquia_id`
		INNER JOIN `nino_condicion` t5 ON t1.`id` = t5.`nino_id`
		INNER JOIN `condiciones` 	t6 ON t6.`id` = t5.`condicion_id`
		INNER JOIN `nino_docente` 	t7 ON t7.`id` = t5.`nino_id`
		INNER JOIN `personal`		t8 ON t8.`id` = t7.`docente_id`
		INNER JOIN `personas` 		t9 ON t8.`persona_id` = t9.`id` 
		INNER JOIN `estatus` 		t10 ON t10.`id` = t1.`estatus_id` 
		WHERE t1.`id` = $id
	");

	$result = mysqli_num_rows($sql);

	if ($result == 0) {
		header("Location: C_ninos.php");

	}else{
		while ($data = mysqli_fetch_array($sql)) {
			$id 	       = $data['id'];
			$persona_id    = $data['persona_id'];
			$nombre        = $data['nombre'];
			$apellido 	   = $data['apellido'];
			$sexo          = $data['sexo'];
			$cedula        = $data['cedula'];
			$lugar         = $data['lugar_nac'];
			$condicion     = $data['condicion'];
			$condicion_id  = $data['condicion_id'];
			$parroquia     = $data['parroquia'];
			$parroquia_id  = $data['parroquia_id'];
			$fecha         = $data['fecha_nac'];
			$direccion     = $data['direccion'];
			$nivel         = $data['nivel_educ'];
			$docente_id    = $data['docente_id'];
			$docente 	   = $data['nomDocente']." ".$data['apeDocente'];
			$estatus_id    = $data['estatus_id'];
			$estatus   	   = $data['estatus'];

		}
	}

	if (!empty($_POST)) {
		$alert='';
		if (empty($_POST['apellidoNew']) || empty($_POST['nombreNew']) || empty($_POST['sexoNew']) || empty($_POST['lugarNew']) || empty($_POST['fechaNew']) || empty($_POST['cedulaNew']) || empty($_POST['nivelNew']) ||empty($_POST['condicionNew']) || empty($_POST['parroquiaNew']) || empty($_POST['direccionNew']) || empty($_POST['estatusNew'])) {

			$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
		}else{
			extract($_POST);

			$ejec=mysqli_query($conexion,"UPDATE `ninos` SET `nivel_educ`='$nivelNew', `estatus_id`='$estatusNew' WHERE `id`='$id'");

			$ejec=mysqli_query($conexion,"UPDATE `nino_condicion` SET `condicion_id`='$condicionNew' WHERE `nino_id`='$id'");

			$ejec=mysqli_query($conexion,"UPDATE `nino_docente` SET `docente_id`='$docenteNew' WHERE `nino_id`='$id'");
			
			$ejec=mysqli_query($conexion,"UPDATE `personas` SET `nombre`='$nombreNew',`apellido`='$apellidoNew',`sexo`='$sexoNew',`fecha_nac`='$fechaNew',`lugar_nac`='$lugarNew',`cedula`='$cedulaNew' WHERE `personas`.`id`= '$persona_id'");

			$ejec=mysqli_query($conexion,"UPDATE `direcciones` SET `descripcion`='$direccionNew',`parroquia_id`='$parroquiaNew' WHERE `persona_id`= '$persona_id'");

			if ($ejec) {
				$alert = '<p class="msg_save">Niño Actualizado Correctamente.</p>';
			}else{
				$alert = '<p class="msg_error">Error al Actualizar.</p>';
			}
		}
		
	}
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Actualizar niños</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/registro_representante.css">
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
			margin-right:5px;
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
		 <?php 
		 	if ($_SESSION['rol'] == 1) {
		 		include('include/menu.php');
		 	}else{
		 		include('include/menu2.php');
		 	}
		  ?>
		<section class="container section">
			<div class="form_registro">
			<form class="form" action="" method="post">
				<h1>Datos del Niño</h1>
				<div class=""><?php echo isset($alert) ? $alert : ''; ?></div>
				<div class="form_representado">
					<label for="apellido">Apellidos</label>
					<input type="text" name="apellidoNew" placeholder="Apellidos" value="<?php echo $apellido; ?>">
					<label for="nombren">Nombres</label>
					<input type="text" name="nombreNew" placeholder="Nombres del representado" value="<?php echo $nombre; ?>">
					<label for="sexo">Sexo</label>
					<select name="sexoNew"  id="sexo">
						<option value="<?php echo $sexo;?>"><?php echo $sexo;?>*</option>
						<option value="Masculino">Masculino</option>
						<option value="Femenino">Femenino</option>
					</select>
					<label for="lugardn">Lugar de Nac</label>
					<input type="text" name="lugarNew" value="<?php echo $lugar; ?>">
					<label for="fecha">Fecha de Nac</label>
					<input type="date" name="fechaNew" value="<?php echo $fecha; ?>">
					<label for="edad">Docente asignado</label>
					<select name="docenteNew" id="condicion">
						<option value="<?php echo $docente; ?>"><?php echo $docente; ?>*</option>
						<?php
						  $ejc=mysqli_query($conexion,"
						  	SELECT t1.`id`, t2.`nombre`, t2.`apellido` 
						  	FROM personal t1 
						  	INNER JOIN `personas` t2 ON t1.`persona_id` =t2.`id` 
						  	WHERE t1.`cargo_id` = 3 
						  	ORDER BY t1.`id` ASC
						  	");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['nombre']." ".$filaP['apellido']; ?></option>
						<?php
						  }
						?>
					</select>
				</div>
				<div class="form_representado">
					<label for="cedula">Cédula escolar</label>
					<input type="text" name="cedulaNew" value="<?php echo $cedula; ?>">
					<label for="nivel">Nivel educativo</label>
					<input type="text" name="nivelNew" value="<?php echo $nivel; ?>">
					<label for="condicion">Condición</label>
					<select name="condicionNew" id="condicion">
						<option value="<?php echo $condicion_id?>"><?php echo $condicion;?>*</option>
						<?php
						  $ejc=mysqli_query($conexion,"SELECT * FROM condiciones ORDER BY descripcion ASC");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
						<?php
						  }
						?>
					</select>
					<label for="parroquia">Parroquia</label>
					<select name="parroquiaNew" id="parroquia">
						<option value="<?php echo $parroquia_id; ?>"><?php echo $parroquia; ?>*</option>
						<?php
						  $ejc=mysqli_query($conexion,"SELECT * FROM parroquias ORDER BY descripcion ASC");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
						<?php
						  }
						?>
					</select>
					<label for="direcion">Dirección</label>
					<input type="text" name="direccionNew" placeholder="Dirección" value="<?php echo $direccion; ?>">
					<label for="estatus">Estatus</label>
					<select name="estatusNew">
						<option value="<?php echo $estatus_id; ?>"><?php echo $estatus; ?>*</option>
						<option value="1">Activo</option>
						<option value="2">Inactivo</option>
					</select>
				</div>
				<div class="submit">
					<input class="btn_save" type="submit" value="REGISTRAR">
				</div>
			</form>
			</div>
		</section>
		<?php 
			include('include/footer.php');
				mysqli_close($conexion);
		 ?>
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>