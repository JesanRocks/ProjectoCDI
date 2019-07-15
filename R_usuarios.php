<?php 
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (!empty($_POST)) {
		$alert='';

		if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['cedula']) ||  empty($_POST['rol']) || empty($_POST['clave'])) {
			
			$alert = '<p class="msg_error">Todos los campos son obligatorios</p>';

		}else{
			extract($_POST);
	
			$query = mysqli_query($conexion,"
				SELECT * FROM `personas` t1 
				INNER JOIN `usuarios` t2 ON t1.`id` = t2.`persona_id` 
				WHERE t2.`cedula` = '$cedula'
			");
			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">El usuario ya existe.</p>';
			}else{
			extract($_POST);	
				$query_insert = mysqli_query($conexion,"
					INSERT INTO `personas`(`nombre`, `apellido`, `sexo`, `fecha_nac`, `lugar_nac`, `cedula`) 
					VALUES ('$nombre','$apellido','N/A','2019-07-05','CDI Usuario','$cedula')
				");

				$query = mysqli_query($conexion,"
					SELECT id FROM `personas` WHERE `cedula`='$cedula'
				");
				
				$data = mysqli_fetch_array($query);
				$persona_id = $data['id'];
				//$fecha_ingreso = strval(date('Y-m-d'));
				
				$query_insert = mysqli_query($conexion,"
					INSERT INTO `direcciones`( `descripcion`, `parroquia_id`, `persona_id`) 
					VALUES ('$direccion','$parroquia','$persona_id')
				");

				$query_insert = mysqli_query($conexion,"
					INSERT INTO `personal`(`persona_id`, `telefono`, `profesion`, `cargo_id`, `fecha_ingreso`, `estatus_id`) 
					VALUES ('$persona_id','$telefono','$profesion','$cargos','$fecha_ingreso','$estatus')
				");
				
				$query_insert = mysqli_query($conexion,"
					INSERT INTO `usuarios`(`cedula`, `clave`, `rol_id`, `persona_id`) 
					VALUES ('$cedula','$clave','$rol','$persona_id')
				");
				if ($query_insert) {
					$alert = '<p class="msg_save">Usuario registrado exitosamente.</p>';
				}else{
					$alert = '<p class="msg_error">El registro no se ha completado.</p>';
				}
			}
		}
	}
	// mysqli_close($conexion);
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Registro de usuarios</title>
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

		<section class="container section">
			<div class="form_registro">
				<h1>Registrar Usuarios</h1>
				<hr>
			</div>	
				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
				<form action="" method="post">
					<div class="col-md-4">
						<label for="nombre">Nombres</label>
						<input type="text" id="nombre" name="nombre" placeholder="Nombres">			
					</div>
					<div class="col-md-4">
						<label for="apellido">Apellidos</label>
						<input type="text" id="apellido" name="apellido" placeholder="Apellidos">
					</div>
					<div class="col-md-4">
						<label for="cedula">Cédula</label>
						<input type="text" id="cedula" name="cedula" placeholder="N° Cedula">
					</div>
					<div class="col-md-4">
						<label for="parroquia">Parroquia</label>
						<select name="parroquia">
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
					</div>
					<div class="col-md-4">
						<label for="direccion">Dirección</label>
						<input type="text" id="direccion" name="direccion" placeholder="Dirección">
					</div>
					<div class="col-md-4">
						<label for="telefono">Telefono</label>
						<input type="text" id="telefono" name="telefono" placeholder="Numero de telfono">
					</div>
					<div class="col-md-4">
						<label for="profesion">Profesión</label>
						<input type="text" id="profesion" name="profesion" placeholder="Profesión">
					</div>
					<div class="col-md-4">
						<label for="cargos">Cargo de Usuario</label>
						<select name="cargos">
							<option value="">Seleccionar</option>
							<?php
							  $ejc=mysqli_query($conexion,"SELECT * FROM `eav` WHERE tipo_id=3 ORDER BY `eav`.`id` ASC");
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
						<select name="rol">
							<option value="">Seleccionar</option>
							<?php
							  $ejc=mysqli_query($conexion,"SELECT * FROM `eav` WHERE tipo_id= 47 ORDER BY `eav`.`id` ASC");
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
						<input type="password" id="clave" name="clave" placeholder="Contraseña">	
					</div>

					<div class="col-md-4">	
						<label for="estatus">Estatus</label>
						<select name="estatus">
							<option value="39">Activo</option>
							<option value="40">Inactivo</option>
						</select>
						<label for="fecha_ingreso">Fecha de Ingreso</label>
						<input type="date" name="fecha_ingreso">
						<br><br><br>
					</div>	
					<input class="btn-save" type="submit" value="REGISTRAR">
				</form>
			</div>
		</section>
		<?php 
			include('include/footer.php');
		 ?>
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>