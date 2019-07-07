<?php 
	include("conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (empty($_GET['id'])) {
		header("Location: C_usuarios.php");
	}

	$id = $_GET['id'];

	$sql = mysqli_query($conexion,"
SELECT 
t1.`id`, t1.`clave`, t1.`rol_id`, 
t2.`id` AS persona_id,t2.`nombre`, t2.`apellido`, t2.`cedula`,
t3.`descripcion` AS direccion,
t4.`descripcion` AS parroquia,
t5.`telefono`, t5.`profesion`, t5.`cargo_id`,t5.`estatus_id`,
t6.`descripcion` AS cargo,
t7.`descripcion` AS rol,
t8.`descripcion` AS estatus
FROM `usuarios` t1 
INNER JOIN `personas` t2 ON t1.`persona_id` = t2.`id` 
INNER JOIN `direcciones` t3 ON t3.`persona_id` = t2.`id`
INNER JOIN `parroquias` t4 ON t3.`parroquia_id` = t4.`id`
INNER JOIN `personal` t5 ON t5.`persona_id` = t2.`id`
INNER JOIN `cargos` t6 ON t5.`cargo_id` = t6.`id`
INNER JOIN `roles` t7 ON t1.`rol_id` = t7.`id`
INNER JOIN `estatus` t8 ON t5.`estatus_id` = t8.`id`
WHERE t1.`id`= $id ");

	$result = mysqli_num_rows($sql);

	if ($result == 0) {
		header("Location: C_usuarios.php");

	}else{
		while ($data = mysqli_fetch_array($sql)) {
			$id         = $data['id'];
			$persona_id = $data['persona_id'];
			$nombre     = $data['nombre'];
			$apellido   = $data['apellido'];
			$cedula     = $data['cedula'];
			$parroquia  = $data['parroquia'];
			$direccion  = $data['direccion'];
			$telefono   = $data['telefono'];
			$profesion  = $data['profesion'];
			$cargo_id   = $data['cargo_id'];
			$cargo      = $data['cargo'];
			$rol_id     = $data['rol_id'];
			$rol        = $data['rol'];
			$estatus_id = $data['estatus_id'];
			$estatus    = $data['estatus'];
			$clave      = $data['clave'];
		}
	}

	if (!empty($_POST)) {
		$alert='';
		if (empty($_POST['apellidoNew']) || empty($_POST['nombreNew']) || empty($_POST['cedulaNew']) ||	empty($_POST['parroquiaNew']) || empty($_POST['direccionNew']) || empty($_POST['telefonoNew']) || empty($_POST['profesionNew']) || empty($_POST['cargoNew']) || empty($_POST['rolNew']) || empty($_POST['claveNew']) || empty($_POST['estatusNew'])) {

			$alert = '<p class="msg_error">Todos los campos son requeridos</p>';
		}else{
			extract($_POST);

			$ejec=mysqli_query($conexion,"UPDATE `personal` SET `telefono`='$telefonoNew',`profesion`='$profesionNew',`cargo_id`='$cargoNew',`estatus_id`='$estatusNew' WHERE `id` = '$id'");

			$ejec=mysqli_query($conexion,"UPDATE `personas` SET `nombre`='$nombreNew',`apellido`='$apellidoNew',`cedula`='$cedulaNew' WHERE `personas`.`id`= '$persona_id'");

			$ejec=mysqli_query($conexion,"UPDATE `direcciones` SET `descripcion`='$direccionNew',`parroquia_id`='$parroquiaNew' WHERE `persona_id`= '$persona_id'");

			$ejec=mysqli_query($conexion,"UPDATE `usuarios` SET `clave` = '$claveNew', `rol_id` = '$rolNew' WHERE `usuarios`.`persona_id`= '$persona_id'");

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
	<title>CDI - Matúrin | Actualizar usuarios</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/forms.css">
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
				<h1>Actualizar Usuarios</h1>
				<hr>
			</div>	
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
				<form action="" method="post">
					<div class="col-md-4">
						<label for="nombre">Nombres</label>
						<input type="text" id="nombre" value="<?php echo $nombre; ?>" name="nombreNew" placeholder="Nombres">			
					</div>
					<div class="col-md-4">
						<label for="apellido">Apellidos</label>
						<input type="text" id="apellido" value="<?php echo $apellido; ?>" name="apellidoNew" placeholder="Apellidos">
					</div>
					<div class="col-md-4">
						<label for="cedula">Cédula</label>
						<input type="text" id="cedula" value="<?php echo $cedula; ?>" name="cedulaNew" placeholder="N° Cedula">
					</div>
					<div class="col-md-4">
						<label for="parroquia">Parroquia</label>
						<select  name="parroquiaNew">
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
					</div>
					<div class="col-md-4">
						<label for="direccion">Dirección</label>
						<input type="text" id="direccion" value="<?php echo $direccion; ?>" name="direccionNew" placeholder="Dirección">
					</div>
					<div class="col-md-4">
						<label for="telefono">Telefono</label>
						<input type="text" id="telefono" value="<?php echo $telefono; ?>" name="telefonoNew" placeholder="Numero de telfono">
					</div>
					<div class="col-md-4">
						<label for="profesion">Profesión</label>
						<input type="text" id="profesion" value="<?php echo $profesion; ?>" name="profesionNew" placeholder="Profesión">
					</div>
					<div class="col-md-4">
						<label for="cargos">Cargo de Usuario</label>
						<select  name="cargoNew">
							<option value="<?php echo $cargo_id; ?>"><?php echo $cargo; ?>*</option>
							<?php
							  $ejc=mysqli_query($conexion,"SELECT * FROM cargos ORDER BY descripcion ASC");
							  while ($filaP=mysqli_fetch_assoc($ejc)) {
							?>
							  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion'];?></option>
							<?php
							  }
							?>
						</select>
					</div>
					<div class="col-md-4">				
						<label for="rol">Tipo de Usuario</label>
						<select name="rolNew">
							<option value="<?php echo $rol_id; ?>"><?php echo $rol;?>*</option>
							<?php
							  $ejc=mysqli_query($conexion,"SELECT * FROM roles ORDER BY descripcion ASC");
							  while ($filaP=mysqli_fetch_assoc($ejc)) {
							?>
							  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion'];?></option>
							<?php
							  }
							?>
						</select>
					</div>
					<div class="col-md-4">							
						<label for="clave">Contraseña</label>
						<input type="password" id="clave" value="<?php echo $clave; ?>" name="claveNew" placeholder="Contraseña">	
					</div>

					<div class="col-md-4">	
						<label for="estatus">Estatus</label>
						<select name="estatusNew">
							<option value="<?php echo $estatus_id; ?>"><?php echo $estatus;?>*</option>
							<option value="1">Activo</option>
							<option value="2">Inactivo</option>
						</select>
						<br><br><br>
					</div>	
					<input class="btn-save" type="submit" value="ACTUALIZAR">
				</form>
			
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