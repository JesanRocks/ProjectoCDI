<?php
	$alert = '';
	session_start();
	
	if (isset($_SESSION['active'])) {							
		header("location: sistema.php");
	}

	if (!empty($_POST)) {
		
		if (empty($_POST['cedula']) || empty($_POST['clave'])){

			echo $alert = "Ingrese su Usuario y Contraseña";

		}else{

			require_once 'include/db/conectar.php';
			
			$cedula = mysqli_real_escape_string($conexion,$_POST['cedula']);
			$clave = mysqli_real_escape_string($conexion,$_POST['clave']);

			$query = mysqli_query($conexion,"SELECT * FROM `usuarios` WHERE `cedula`='$cedula' AND `clave`='$clave' ");

			$result = mysqli_num_rows($query);

			if ($result > 0 ){
				
				$query = mysqli_query($conexion,"
					SELECT 
					t1.`nombre`, t1.`apellido`,t1.`cedula`, 
					t2.`id` AS docenteID, t2.`profesion`, 
					t3.`rol_id` 
					FROM `personas` t1 
					inner JOIN `personal` t2 ON t1.`id` = t2.`persona_id` 
					inner JOIN `usuarios` t3 ON t1.`id` = t3.`persona_id` 
					WHERE t1.`cedula` = $cedula
				");

				$data = mysqli_fetch_array($query);

				$_SESSION['active'] = true;
				$_SESSION['id']     = $data['docenteID'];
				$_SESSION['nombre'] = $data['nombre']." ".$data['apellido'];
				$_SESSION['cedula'] = $data['cedula'];
				$_SESSION['rol']    = $data['rol_id'];
				$_SESSION['clave']  = $data['clave'];

				if (isset($_SESSION['active'])) {							
					header("location: sistema.php");
				}

			}else{
				$alert = '<p class="msg_error">Usuario Incorrecto</p>';
				$_SESSION['active'] = true;
				//session_destroy();
			}

		}

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CDI | Maturín</title>
	<link rel="stylesheet" href="css/logueo.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
		body{
			background:url(img/fondo.jpg) no-repeat;
			background-size: 100%;
			background-position: center ;
		}

		/*.input-group-addon{
			color:#4e4e4e;
			padding: 10px;
			border-radius: 5px;
			background:#ddd;
			width: 30px;
			display: block;

		}

		span{
			margin-right: -5px;
		}*/
	</style>
</head>
<body>
	<div class="container">
		<div class="form">
			<form action="" method="post">
				<center><h3 class="title">Iniciar Sesión</h3>
				<img class="img-loguin" src="img/user.png" alt=""><br>
				<input type="hidden" name="nombre">
				<!--<span class="input-group-addon"><i class="fa fa-user"></i></span>-->
				<input type="text" name="cedula" placeholder="N° Cedula" required=""><br>
				<!--<span class="input-group-addon"><i class="fa fa-lock"></i></span>-->
				<input type="password" name="clave" placeholder="Contraseña" required=""></center>
				<center><p class="alert1"><?php echo isset($alert) ? $alert : ''; ?></p>
				<input type="submit" name="enviar" value="INGRESAR"></center>
			</form>
		</div>
	</div>
</body>
</html>