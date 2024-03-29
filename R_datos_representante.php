<?php
	include("conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (!empty($_POST)) {
		$alert='';
		if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['parentesco']) || empty($_POST['cedula']) || empty($_POST['profesion']) || empty($_POST['fecha']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {

		$alert = '<p class="msg_error">Todos los campos son requeridos</p>';

	}else{

		extract($_POST);

		$query = mysqli_query($conexion,"	
			SELECT t1.`nombre`, t1.`apellido`,t1.`cedula`, t2.`descripcion`, t3.`id` 
			FROM `personas` t1 
			INNER JOIN `direcciones` t2 ON t1.`id` = t2.`persona_id` 
			INNER JOIN `representantes` t3 ON t1.`id` = t3.`persona_id` WHERE t1.`cedula` = '$cedula'
		");

		$result = mysqli_fetch_array($query);
		$_SESSION['representante']	= $result['id'];

		if ($result > 0) {
			$alert = '<p class="msg_error">El representante ya existe</p>';

		}else{

			//Primero hacemos el registro
			$insert = mysqli_query($conexion,"
				INSERT INTO `personas`(`nombre`, `apellido`, `sexo`, `fecha_nac`, `lugar_nac`, `cedula`) 
				VALUES ('$nombre','$apellido','','$fecha','','$cedula') 
			");
			//Hecho el registro rescatamos el id del registro que se insertó
			//Consultamos que exista a traves de la C.I. y que nos retorne el id
			$query = mysqli_query($conexion,"SELECT id FROM `personas` WHERE `cedula`='$cedula'");
			//Guardamos el valor obtenido en una variable $persona_id
			$data = mysqli_fetch_array($query);
			$persona_id =$data['id'];

			$insert = mysqli_query($conexion,"
				INSERT INTO `representantes`(`persona_id`, `parentesco_id`, `profesion`, `telefono`, `nivel_acad`) 
				VALUES ('$persona_id','$parentesco','$profesion','$telefono','') 
			");

			$query = mysqli_query($conexion,"SELECT id FROM `representantes` WHERE `persona_id`='$persona_id'");
			//Guardamos el valor obtenido en una variable $_SESSION
			
			$result = mysqli_fetch_array($query);
			$_SESSION['representante']	= $result['id'];

			$insert = mysqli_query($conexion,"
				INSERT INTO `direcciones`(`descripcion`, `parroquia_id`, `persona_id`) 
				VALUES ('$direccion','$parroquia','$persona_id') 
			");

			if ($insert) {
				$alert = '<p class="msg_save">Representante registrado exitosamente</p>';

			}else{
				$alert = '<p class="msg_error">No se completo su registro</p>';
			}

		}

	}

	}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Registro de representantes</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/registro_representante.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
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
		<section class="section">
			<form class="form" action="" method="post">
				<h1>Datos del representante</h1>
				<div class=""><?php echo isset($alert) ? $alert : ''; ?></div>
				<div class="form_representante">
					<label for="apellido">Apellidos</label>
					<input type="text" name="apellido" placeholder="Apellido">
					<label for="nombren">Nombres</label>
					<input type="text" name="nombre" placeholder="Nombre">
					<label for="cedula">Cedula</label>
					<input type="text" name="cedula" placeholder="N° Cedula">
					<label for="parentesco">Parentesco</label>
					<select name="parentesco">
						<option>Seleccionar</option>
						<option value="1">Padre</option>
						<option value="2">Madre</option>
						<option value="3">Representante Legal</option>
						<OPTION value="4">Otro</OPTION>
					</select>
				</div>
				<div class="form_representante">
					<label for="profesion">Profesión u Oficio</label>
					<input type="text" name="profesion" placeholder="Profesión">
					<label for="fecha">Fecha de Nacimiento</label>
					<input type="date" name="fecha" placeholder="Fecha de nacimiento">
					<label for="telefono">Telefono</label>
					<input type="text" name="telefono" placeholder="Telfono">
								
				  <label for="parroquia">Parroquia</label>
				  <select name="parroquia" id="parroquia" required>
					<option value="">Seleccionar</option>
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
					<input type="text" name="direccion" placeholder="Dirección">
				</div>
				<div class="submit">
					<input a href="R_datos_nino.php" class="btn_save" type="submit" value="REGISTRAR">
					<?php 
						if (isset($alert)) {
							echo "<a href='R_datos_nino.php' class='btn btn-info btn-block btn-lg'>REGISTRAR NIÑO</a>";
						}
					?>

				</div>
			</form>
		</section>
		<?php 
			include('include/footer.php');
		 ?>
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>