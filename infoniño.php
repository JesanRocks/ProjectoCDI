<?php
	include("conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (empty($_GET['id'])) {
		header("Location: C_ninos.php");
	}

	$id = $_GET['id'];
	//Primero consulta al niño
	$sql = mysqli_query($conexion,"							
		SELECT 
		t1.`id`,
		t1.`nivel_educ`,
		t2.`nombre`,
		t2.`apellido`,
		t2.`sexo`,
		t2.`fecha_nac`,
		t2.`lugar_nac`,
		t3.`descripcion` AS direccion,
		t4.`descripcion` AS parroquia, 
		t5.`condicion_id`,
		t6.`descripcion` AS condicion
		FROM `ninos` t1 
		INNER JOIN `personas` t2 ON t1.`persona_id` = t2.`id`
		INNER JOIN `direcciones` t3 ON t2.`id` = t3.`persona_id` 
		INNER JOIN `parroquias` t4 ON t4.`id` = t3.`parroquia_id`
		INNER JOIN `nino_condicion` t5 ON t1.`id` = t5.`nino_id`
		INNER JOIN `condiciones` t6 ON t6.`id` = t5.`condicion_id` 
		WHERE t1.`id` = $id
	");

	$result = mysqli_num_rows($sql);

	if ($result == 0) {
		header("Location: C_ninos.php");

	}else{
		while ($data = mysqli_fetch_array($sql)) {
			$id 	       = $data['id'];
			$nombre        = $data['nombre'];
			$apellido 	   = $data['apellido'];
			$sexo          = $data['sexo'];
			$lugar         = $data['lugar_nac'];
			$condicion     = $data['condicion'];
			$parroquia     = $data['parroquia'];
			$fecha         = $data['fecha_nac'];
			$direccion     = $data['direccion'];
			$nivel         = $data['nivel_educ'];
		}
	}
	//Consulta al representante
	$sql = mysqli_query($conexion,"							
		SELECT 
		t1.`id`, 
		t2.`id` AS representante,
		t2.`profesion`, 
		t2.`telefono`,
		t3.`nombre`,
		t3.`apellido`,
		t3.`cedula`,
		t3.`fecha_nac`,
		t4.`descripcion` AS direccion,
		t5.`descripcion` AS parroquia,
		t6.`descripcion` AS parentesco
		FROM `ninos` t1 
		INNER JOIN `representantes` t2 ON t1.`representante_id` = t2.`id` 
		INNER JOIN `personas` t3 ON t2.`persona_id` = t3.`id`
		INNER JOIN `direcciones` t4 ON t3.`id` = t4.`persona_id` 
		INNER JOIN `parroquias` t5 ON t5.`id` = t4.`parroquia_id`
		INNER JOIN `parentesco` t6 ON t6.`id` = t2.`parentesco_id` 
		WHERE t1.`id` = $id
	");

	while ($data = mysqli_fetch_array($sql)) {
			$id_r		= $data['representante'];
			$nom        = $data['nombre'];
			$ape 		= $data['apellido'];
			$fec 		= $data['fecha_nac'];
			$cedula   	= $data['cedula'];
			$profesion	= $data['profesion'];
			$telefono   = $data['telefono'];
			$parro	= $data['parroquia'];
			$direcc	= $data['direccion'];
			$parentesco = $data['parentesco'];

	}
	mysqli_close($conexion);
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Visualisar | niño </title>
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
					<?php echo $apellido; ?>
					<label for="nombren">Nombres</label>
					<?php echo $nombre; ?>
					<label for="sexo">Sexo</label>
					<?php echo $sexo; ?>
					<label for="lugardn">Lugar de Nacimiento</label>
					<?php echo $lugar; ?>
					<label for="condicion">Condición</label>
					<?php echo $condicion; ?>
				</div>
				<div class="form_representado">
					<label for="estado">Parroquia</label>
					<?php echo $parroquia; ?>
					<label for="fecha">Fecha de Nacimiento</label>
					<?php echo $fecha; ?>
					<label for="direcion">Dirección</label>
					<?php echo $direccion; ?>
					<label for="nivel">Nivel educativo</label>
					<?php echo $nivel; ?>
					<label for="condicion">Docente Asignado</label>
				</div>
				<div class="submit">
				</div>
			</form>
			</div>
			
			<div class="form_registro">
			<form class="form" action="" method="post">
				<h1>Datos del Representante</h1>
				<div class=""><?php echo isset($alert) ? $alert : ''; ?></div>
				<div class="form_representado">
					<label for="apellido">Apellidos</label>
					<?php echo $ape;?>
					<label for="nombren">Nombres</label>
					<?php echo $nom; ?>
					<label for="sexo">Cedula</label>
					<?php echo $cedula;?>
					<label for="sexo">Parentesco</label>
					<?php echo $parentesco;?>
				</div>
				<div class="form_representado">
					<label for="procedencia">Profesion u Oficio</label>
					<?php echo $profesion; ?>
					<label for="fecha">Fecha de Nacimiento</label>
					<?php echo $fec; ?>
					<label for="direcion">Dirección</label>
					<?php echo $direcc;?>
					<label for="nivel">Telefono</label>
					<?php echo $telefono;?>
				</div>
				<div class="submit">
					<a href="actualizar_representante.php?id=<?php echo $id_r;?>" class="btn btn-info" >Editar</a>
				</div>
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