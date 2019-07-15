<?php 
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {	
		header("location: index.php");	
	}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Consulta de usuarios</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/consultas.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.jqueryui.min.css"/>
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

		<section class="" id="container1">
			<h1>Lista de Docentes</h1>
			<table id="table" class="display">
				<thead>
					<tr>
						<th>ID</th>
 						<th>Nombres</th>
						<th>Cedula</th>
						<th>Parroquia / Dirección</th>
						<th>Telefono</th>
						<th>Profesión</th>
						<th>Cargo</th>
						<th>Tipo de usuario</th>
						<th>Contraseña</th> 
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					<?php 

						$query = mysqli_query($conexion,"
SELECT 
t1.`clave`, t1.`rol_id`, 
t2.`nombre`, t2.`apellido`, t2.`cedula`, t2.`fecha_nac`,
t3.`descripcion` AS direccion,
t4.`descripcion` AS parroquia,
t5.`id`, t5.`telefono`, t5.`profesion`, t5.`cargo_id`,
t6.`descripcion` AS cargo,
t7.`descripcion` AS rol
FROM `usuarios` t1 
INNER JOIN `personas` t2 ON t1.`persona_id` = t2.`id` 
INNER JOIN `direcciones` t3 ON t3.`persona_id` = t2.`id`
INNER JOIN `parroquias` t4 ON t3.`parroquia_id` = t4.`id`
INNER JOIN `personal` t5 ON t5.`persona_id` = t2.`id`
INNER JOIN `eav` t6 ON t5.`cargo_id` = t6.`id`
INNER JOIN `eav` t7 ON t1.`rol_id` = t7.`id`
						");

						$result = mysqli_num_rows($query);

						if ($result > 0) {
							while ($data = mysqli_fetch_array($query)) {
					?>
						<tr>
 							<td><?php echo $data['id'] ?></td>
							<td><?php echo $data['nombre']." ".$data['apellido'] ?></td>
							<td><?php echo $data['cedula'] ?></td>
							<td><?php echo $data['parroquia']."<hr>".$data['direccion'] ?></td>
							<td><?php echo $data['telefono'] ?></td>
							<td><?php echo $data['profesion'] ?></td>
							<td><?php echo $data['cargo'] ?></td>
							<td><?php echo $data['rol'] ?></td>
							<td><?php echo $data['clave'] ?></td> 
							<td>
								<a class="link_edit" href="actualizar_usuarios.php?id=<?php echo $data['id'] ?>">Editar
								</a>
							</td>
						</tr>
					<?php
							}
						}

					?>
					</tbody>
					<tfoot>
						
					</tfoot>		
			</table>
		</section>
		<?php 
			include('include/footer.php');
		 ?>
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>

$(document).ready(function() {
    $('#table').DataTable();
} );
 
</script>
</html>