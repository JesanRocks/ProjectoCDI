<?php 
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	if (isset($_POST['ENVIAR'])) {

	$representante = $_POST['representante'];

	$validar = mysqli_query($conexion,'SELECT * FROM personas t1 INNER JOIN representantes t2 ON t2.persona_id=t1.id WHERE cedula ='.$representante);
	$result = mysqli_num_rows($validar);
	
	if ($result) {
		$data = mysqli_fetch_array($validar);
		$_SESSION['representante']=$data['id'];

		$alert = '<p class="msg_save">La C.I.'.$data['cedula'].' le pertenece a '.$data['nombre'].' '.$data['apellido'].' ¿Desea Inscribir un niño a nombre del representante?</p>';
		$alert .= '<a href="R_datos_nino.php">Inscribir Niño aqui</a>';

	}else{
		$alert = '<p class="msg_save">Aun no se ha inscrito<br>';
		$alert .= '<a href="R_datos_representante.php">Inscribir aqui</a>';

		$_SESSION['newCI']=$_POST['representante'];
		// header('location: R_datos_representante.php');
	}

}

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
			margin-right: 5px;
		}

		textarea {
		  width: 500px;
		  height: 100px;
		  margin-top: 30px;
		}

		form{
			width:40% !important;
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
				<section class="container" id="container1">
					<center><h1>Cedula del representante</h1></center>
					<form action="" method="post" class="form" style="width: 50%; margin:auto; padding:10px;" >
						<div class="row">
								<div class="col-md-12"><input class="form-control" type="number" name="representante" placeholder="Cedula" required></div>
						</div>
						<div style="margin-top: 10px;">
						<center>
							<div><input class="btn btn-primary" type="submit" name="ENVIAR" value="Consultar"></div>
							<p class="alert1"><?php echo isset($alert) ? $alert : ''; ?></p>
						</center>
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
<script src="js/jquery.dataTables.min.js"></script>
</html>