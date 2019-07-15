<?php 
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (empty($_GET['id'])) {
		header("Location: C_representantes.php");
	}

	$id = $_GET['id'];

	$sql = mysqli_query($conexion,"
	SELECT 
	t1.`id`,t1.`profesion`, t1.`parentesco_id`,t1.`telefono`, 
	t2.`id`AS persona_id,t2.`nombre`, t2.`apellido`,t2.`cedula`,t2.`fecha_nac`, 
	t3.`descripcion` AS direccion,
	t3.`parroquia_id`,
	t4.`descripcion` AS parroquia,
	t5.`descripcion` AS parentesco
	FROM `representantes` t1 
	INNER JOIN `personas` t2 ON t2.`id` = t1.`persona_id` 
	INNER JOIN `direcciones` t3 ON t2.`id` = t3.`persona_id` 
	INNER JOIN `parroquias` t4 ON t4.`id` = t3.`parroquia_id`
	INNER JOIN `eav` t5 ON t5.`id` = t1.`parentesco_id` 
	WHERE t1.`id` = '$id'
	");

	$result = mysqli_num_rows($sql);

	if ($result == 0) {
		//header("Location: C_representantes.php");

	}else{
		while ($data = mysqli_fetch_array($sql)) {
			$id 	       = $data['id'];
			$parentesco_id = $data['parentesco_id'];
			$parentesco    = $data['parentesco'];
			$persona_id    = $data['persona_id'];
			$apellido      = $data['apellido'];
			$nombre 	   = $data['nombre'];
			$cedula        = $data['cedula'];
			$profesion     = $data['profesion'];
			$fecha         = $data['fecha_nac'];
			$telefono      = $data['telefono'];
			$direccion     = $data['direccion'];
			$parroquia_id  = $data['parroquia_id'];
			$parroquia     = $data['parroquia'];

		}
	}

	if (!empty($_POST)) {
		$alert='';
		if (empty($_POST['apellidoNew']) || empty($_POST['nombreNew']) || empty($_POST['cedulaNew']) ||	empty($_POST['parentescoNew']) || empty($_POST['profesionNew']) || empty($_POST['fechaNew']) || empty($_POST['telefonoNew']) || empty($_POST['parroquiaNew']) || empty($_POST['direccionNew'])) {

			$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
		}else{
			extract($_POST);

			// print_r($_POST);

			$ejec=mysqli_query($conexion,"UPDATE `representantes` SET `parentesco_id` = '$parentescoNew', `profesion` = '$profesionNew', `telefono` = '$telefonoNew' WHERE `representantes`.`id` = '$id'");

			$ejec=mysqli_query($conexion,"UPDATE `personas` SET `nombre`='$nombreNew',`apellido`='$apellidoNew',`fecha_nac`='$fechaNew',`cedula`='$cedulaNew' WHERE `personas`.`id`= '$persona_id'");

			$ejec=mysqli_query($conexion,"UPDATE `direcciones` SET `descripcion`='$direccionNew',`parroquia_id`='$parroquiaNew' WHERE `persona_id`= '$persona_id'");

			if ($ejec) {
				$alert = '<p class="msg_save">Representante actualizado correctamente.</p>';
			}else{
				$alert = '<p class="msg_error">Error al actualizar.</p>';
			}
		}
		
	}
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Actualizar representante</title>
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

		<section class="container section">
			<div class="form_registro">
			<form class="form" action="" method="post">
				<h1>Datos del representante</h1>
				<div class=""><?php echo isset($alert) ? $alert : ''; ?></div>
				<div class="form_representante">
					<label for="apellido">Apellidos</label>
					<input type="text" value="<?php echo $apellido;?>" name="apellidoNew">
					<label for="nombren">Nombres</label>
					<input type="text" value="<?php echo $nombre;?>" name="nombreNew">
					<label for="cedula">Cedula</label>
					<input type="text" value="<?php echo $cedula;?>" name="cedulaNew">
					<label for="parentesco">Parentesco</label>
					<select name="parentescoNew">
						<option value="<?php echo $parentesco_id;?>"><?php echo $parentesco;?>*</option>
						<option value="43">Madre</option>
						<option value="44">Padre</option>
						<option value="45">Otro</option>
					</select>
				</div>
				<div class="form_representante">
					<label for="profesion">Profesión u Oficio</label>
					<input type="text" value="<?php echo $profesion;?>" name="profesionNew">
					<label for="fecha">Fecha de Nacimiento</label>
					<input type="date" value="<?php echo $fecha;?>" name="fechaNew" >
					<label for="telefono">Telefono</label>
					<input type="text" value="<?php echo $telefono;?>" name="telefonoNew">
								
				  <label for="parroquia">Parroquia</label>
				  <select  name="parroquiaNew" id="parroquia" required>
					<option value="<?php echo $parroquia_id;?>"><?php echo $parroquia;?>*</option>
					<?php
					  $ejc=mysqli_query($conexion,"SELECT * FROM parroquias ORDER BY descripcion ASC");
					  while ($filaP=mysqli_fetch_assoc($ejc)) {
					?>
					  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
					<?php
					  }
					?>
				  </select>

					<label for="direccion">Dirección</label>
					<input type="text" value="<?php echo $direccion;?>" name="direccionNew">
				</div>
				<div class="submit">
					<input class="btn_save" type="submit" value="ACTUALIZAR">
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