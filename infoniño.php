<?php
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (empty($_GET['id'])) {
		header("Location: C_ninos.php");
	}

	$id = $_GET['id'];
	# Primero consulta al niño y su docente asignado
	$sql = mysqli_query($conexion,"							
		SELECT 
		t1.`id`, t1.`nivel_educ`,
		t2.`nombre`,t2.`apellido`,t2.`sexo`,t2.`fecha_nac`,t2.`lugar_nac`,
		t3.`descripcion` AS direccion,
		t4.`descripcion` AS parroquia, 
		t5.`condicion_id`,
		t6.`descripcion` AS condicion,
		t7.`docente_id`,
		t8.`persona_id`,
		t9.`nombre` AS DocenteNom, t9.`apellido`AS DocenteApe,

		t10.`vivienda` AS vivienda_id, t10.`pertenece` AS pertenece_id, t10.`condicion` AS cdv_id, 
    	t10.`agua`, t10.`aseo`, t10.`luz`, t10.`otroServicio`,
    	t10.`radio`, t10.`tv`, t10.`pc`, t10.`otroBien`, 
    	t11.`descripcion` AS vivienda,
    	t12.`descripcion` AS pertenece,
    	t13.`descripcion` AS cdv
		FROM `ninos` t1 
		INNER JOIN `personas` t2 ON t1.`persona_id` = t2.`id`
		INNER JOIN `direcciones` t3 ON t2.`id` = t3.`persona_id` 
		INNER JOIN `parroquias` t4 ON t4.`id` = t3.`parroquia_id`
		INNER JOIN `nino_condicion` t5 ON t1.`id` = t5.`nino_id`
		INNER JOIN `eav` t6 ON t6.`id` = t5.`condicion_id` 
		INNER JOIN `nino_docente` t7 ON t1.`id` = t7.`nino_id`
		INNER JOIN `personal` t8 ON t7.`docente_id` = t8.`id`
		INNER JOIN `personas` t9 ON t8.`persona_id` = t9.`id`

		INNER JOIN `socioeconomico` t10 ON t10.`nino_id` = t1.`id`
		INNER JOIN `eav` 		t11 ON t11.`id` = t10.`vivienda`
		INNER JOIN `eav` 		t12 ON t12.`id` = t10.`pertenece`
		INNER JOIN `eav` 		t13 ON t13.`id` = t10.`condicion` 
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
			
			$DocenteNom     = $data['DocenteNom'];
			$DocenteApe     = $data['DocenteApe'];

			$vivienda  	   = $data['vivienda'];
			$pertenece     = $data['pertenece'];
			$cdv   	       = $data['cdv'];

			// $vivienda_id   = $data['vivienda_id'];
			// $pertenece_id  = $data['pertenece_id'];
			// $cdv_id   	   = $data['cdv_id'];		
			$agua   	   = $data['agua'];
			$aseo   	   = $data['aseo'];
			$luz   	   = $data['luz'];
			$radio   	   = $data['radio'];
			$tv   	   = $data['tv'];
			$pc   	   = $data['pc'];
			$otroBien   	   = $data['otroBien'];			
			$otroServicio   	   = $data['otroServicio'];
		}
	}
	# Consulta al representante
	$sql = mysqli_query($conexion,"							
		SELECT 
		t1.`id`, 
		t2.`id` AS representante, t2.`profesion`,  t2.`telefono`,
		t3.`nombre`, t3.`apellido`, t3.`cedula`, t3.`fecha_nac`,
		t4.`descripcion` AS direccion,
		t5.`descripcion` AS parroquia,
		t6.`descripcion` AS parentesco
		FROM `ninos` t1 
		INNER JOIN `representantes` t2 ON t1.`representante_id` = t2.`id` 
		INNER JOIN `personas` t3 ON t2.`persona_id` = t3.`id`
		INNER JOIN `direcciones` t4 ON t3.`id` = t4.`persona_id` 
		INNER JOIN `parroquias` t5 ON t5.`id` = t4.`parroquia_id`
		INNER JOIN `eav` t6 ON t6.`id` = t2.`parentesco_id`
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
					<?php echo $DocenteNom." ".$DocenteApe; ?>
				</div>
				<h1>Datos socioeconomicos</h1>
				<div class="col-sm-6">
					<label for="estado">Tipo de vivienda</label>
					<?php echo $vivienda ?>
					<label for="fecha">Propiedad de vivienda</label>
					<?php echo $pertenece; ?>
					<label for="direcion">Condicion de vivienda</label>
					<?php echo $cdv; ?>
				</div>
				<div class="col-sm-6">
					<label for="nivel">Servicios</label>
					<b>Agua:</b>	<?php if ($agua=="66") { echo "Si";}else{echo "No";}?> 
					<b>Luz:</b>		<?php if ($luz=="67") { echo "Si";}else{echo "No";}?> 
					<b>Aseo:</b>	<?php if ($aseo=="68") { echo "Si";}else{echo "No";}?>
					<b>Otros:</b>	<?php echo $otroServicio;?>	
					<label for="condicion">Posee</label>
					<b>Radio:</b>		<?php if ($radio=="70") { echo "Si";}else{echo "No";}?> 
					<b>TV:</b>			<?php if ($tv=="71") { echo "Si";}else{echo "No";}?> 
					<b>Computadora:</b> <?php if ($pc=="72") { echo "Si";}else{echo "No";}?> 
					<b>Otros:</b>		<?php echo $otroBien;?>				
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