<?php
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (!empty($_POST)) {
		extract($_POST);
			
		if (empty($nombre) || empty($apellido) || empty($sexo) || empty($lugar) || empty($fecha) || empty($cedula) || empty($nivel) || empty($condicion) || empty($parroquia) || empty($direccion) || empty($estatus)) {

			$alert = '<p class="msg_error">Todos los campos son requeridos</p>';

		 }else{

			extract($_POST);
			$query = mysqli_query($conexion,"
				SELECT t1.`nombre`, t1.`apellido`,t1.`cedula`, 
				t2.`descripcion`, t3.`nivel_educ` 
				FROM `personas` t1 
				INNER JOIN `direcciones` t2 ON t1.`id` = t2.`persona_id` 
				INNER JOIN `ninos` t3 ON t1.`id` = t3.`persona_id` 
				WHERE t1.`cedula` = '$cedula'
			");

			$result = mysqli_fetch_array($query);
			
			if ($result > 0) {
				$alert = '<p class="msg_error">Este niño ya existe</p>';
			}else{
				extract($_POST);

				$insert = mysqli_query($conexion,"
					INSERT INTO `personas`( `nombre`, `apellido`, `sexo`, `fecha_nac`, `lugar_nac`, `cedula`) 
					VALUES ('$nombre','$apellido','$sexo','$fecha','$lugar','$cedula')
				");

				$query = mysqli_query($conexion,"SELECT id FROM `personas` WHERE `cedula`='$cedula'");
				$data = mysqli_fetch_array($query);
				$persona_id = $data['id'];
				$representante_id = $_SESSION['representante'];
				//$fecha_ingreso = strval(date('Y-m-d'));

				$insert = mysqli_query($conexion,"
					INSERT INTO `direcciones`(`descripcion`, `parroquia_id`, `persona_id`) 
					VALUES ('$direccion','$parroquia','$persona_id')
				");				

				$insert = mysqli_query($conexion,"
					INSERT INTO `ninos`(`nivel_educ`, `fecha_ingreso`, `persona_id`, `representante_id`, `estatus_id`) 
					VALUES ('$nivel','$fecha_ingreso','$persona_id','$representante_id','$estatus')
				");
				/*Consultamos el id del niño para asignarlo a la condicion*/
				$query = mysqli_query($conexion,"SELECT id FROM `ninos` WHERE `persona_id`='$persona_id'");
				$data = mysqli_fetch_array($query);
				$nino_id = $data['id'];

				$insert = mysqli_query($conexion,"INSERT INTO nino_docente (nino_id, docente_id) 
                      VALUES ('$nino_id','$docente')");

        		$insert = mysqli_query($conexion,"INSERT INTO nino_condicion (nino_id, condicion_id) 
                      VALUES ('$nino_id','$condicion')");

        		if( !isset($agua) ){ $agua="1";}

        		if(!isset($aseo)){ $aseo="1";}

        		if(!isset($luz)){ $luz="1";}

        		if(!isset($radio)){ $radio="1";}

        		if(!isset($tv)){ $tv="1";}

        		if(!isset($pc)){ $pc="1";}

        		$insert = mysqli_query($conexion,"INSERT INTO `socioeconomico`(`vivienda`, `pertenece`, `condicion`, `agua`, `luz`, `aseo`,  `otroServicio`, `radio`, `tv`, `pc`, `otroBien`, `nino_id`) 
        			VALUES ('$vivienda','$pertenece','$cdv','$agua','$luz','$aseo','$otroServicio','$radio',$tv,'$pc','$otroBien','$nino_id')
        		");

				if ($insert) {
					$alert = '<p class="msg_save">Registro completado exitosamente</p>';
				}
			}

		}	
	}
		

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Registro de niños</title>
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

		.check{
			margin:10px;
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

		<section class="section">
			<form class="form" action="" method="post">
				<h1>Datos del Niño</h1>
				<div class=""><?php echo isset($alert) ? $alert : ''; ?></div>
				<div class="form_representado">
					<label for="apellido">Apellidos</label>
					<input type="text" name="apellido" placeholder="Apellidos">
					<label for="nombren">Nombres</label>
					<input type="text" name="nombre" placeholder="Nombres del representado">
					<label for="sexo">Sexo</label>
					<select name="sexo" id="sexo">
						<option value="">Seleccione sexo</option>
						<option value="Masculino">Masculino</option>
						<option value="Femenino">Femenino</option>
					</select>
					<label for="lugardn">Lugar de Nac</label>
					<input type="text" name="lugar" placeholder="Lugar de nacimiento">
					<label for="fecha">Fecha de Nac</label>
					<input type="date" name="fecha">
					<label for="edad">Docente asignado</label>
					<select name="docente" id="condicion">
						<option value="">Seleccionar</option>
						<?php
						  $ejc=mysqli_query($conexion,"
						  	SELECT t1.`id`, t2.`nombre`, t2.`apellido` 
						  	FROM personal t1 
						  	INNER JOIN `personas` t2 ON t1.`persona_id` =t2.`id` 
						  	WHERE t1.`cargo_id` = 6 
						  	ORDER BY t1.`id` ASC
						  	");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['nombre']." ".$filaP['apellido']; ?></option>
						<?php
						  }
						?>
					</select>
					<label for="fecha_ingreso">Fecha de Ingreso</label>
					<input type="date" name="fecha_ingreso">
					<label for="estatus">Estatus</label>
					<select name="estatus">
						<option value="39">Activo</option>
						<option value="40">Inactivo</option>
					</select>
					<div>	
						<label for="Posee">Posee</label><br>
						<label class="check">
							Radio
							<input type="checkbox" name="radio" value="70">
						</label>
						<label class="check">
							TV
							<input type="checkbox" name="tv" value="71">
						</label>
						<label class="check">
							Computadora
							<input type="checkbox" name="pc" value="72">
						</label><br>
						<label>Otros</label>
						<input type="text"  name="otroBien" placeholder="Otros articulos">
					</div>
				</div>
				<div class="form_representado">
					<label for="cedula">Cedula escolar</label>
					<input type="text" name="cedula" placeholder="Cedula escolar">
					<label for="nivel">Nivel educativo</label>
					<input type="text" name="nivel" placeholder="Nivel educativo">
					<label for="condicion">Condición</label>
					<select name="condicion" id="condicion">
						<option value="">Seleccionar</option>
						<?php
						  $ejc=mysqli_query($conexion,"SELECT * FROM `eav` WHERE tipo_id=9 ORDER BY `eav`.`descripcion` ASC");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
						<?php
						  }
						?>
					</select>	
					<label for="parroquia">Parroquia</label>
					<select name="parroquia" id="parroquia">
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
				  	<label for="direcion">Dirección</label>
					<input type="text" name="direccion" placeholder="Dirección">
					
					<label for="condicion">Tipo de vivienda</label>
					<select name="vivienda" id="vivienda" required>
						<option value="">Seleccionar</option>
						<?php
						  $ejc=mysqli_query($conexion,"SELECT * FROM `eav` WHERE tipo_id=51 ORDER BY `eav`.`descripcion` ASC");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
						<?php
						  }
						?>
					</select>

					<label for="condicion">Propiedad</label>
					<select name="pertenece" id="pertenece" required>
						<option value="">Seleccionar</option>
						<?php
						  $ejc=mysqli_query($conexion,"SELECT * FROM `eav` WHERE tipo_id=57 ORDER BY `eav`.`descripcion` ASC");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
						<?php
						  }
						?>
					</select>

					<label for="">Condicion de vivienda</label>
					<select name="cdv" id="cdv" required>
						<option value="">Seleccionar</option>
						<?php
						  $ejc=mysqli_query($conexion,"SELECT * FROM `eav` WHERE tipo_id=61 ORDER BY `eav`.`descripcion` ASC");
						  while ($filaP=mysqli_fetch_assoc($ejc)) {
						?>
						  <option value="<?php echo $filaP['id']; ?>"> <?php echo $filaP['descripcion']; ?></option>
						<?php
						  }
						?>
					</select>
					<div>
						<label for="Servicios">Servicios</label><br>
						<label class="check">
							Agua<input type="checkbox" name="agua" value="66">
						</label>
						<label class="check">
							Luz<input type="checkbox" name="luz" value="67">
						</label>
						<label class="check">
							Aseo<input type="checkbox" name="aseo" value="68">
						</label><br>
						<label>Otros</label>	
						<input type="text" name="otroServicio" placeholder="Otros servicios">	
					</div>

				</div>


				<div class="submit">
					<input class="btn_save" type="submit" value="REGISTRAR">
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