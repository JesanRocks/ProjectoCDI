<?php 
	include("conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Consulta de niños</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/c_niños.css">
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
		 <?php 
		 	if ($_SESSION['rol'] == 1) {
		 		include('include/menu.php');
		 	}else{
		 		include('include/menu2.php');
		 	}
		  ?>
		  <div class="row">
		  	<div class="col-md-12">
				<section class="container" id="container1">
					<h1>Lista de Niños</h1>
					<table id="table-ninos">
						<thead>
							<tr>
								<th>N°</th>
								<th>Nombres</th>
								<th>Sexo</th>
								<th>Condición</th>
								<th>Fecha de N</th>
								<th>Acción</th>
							</tr>
						</thead>
						<?php 

						$query = mysqli_query($conexion,"
							SELECT 
							t1.`id`, 
							t2.`nombre`,
							t2.`apellido`,
							t2.`sexo`,
							t2.`fecha_nac`,
							t4.`descripcion` 
							FROM `ninos` t1 
							INNER JOIN `personas` t2 		ON t1.`persona_id` = t2.`id` 
							INNER JOIN `nino_condicion` t3 	ON t1.`id` = t3.`nino_id`
							INNER JOIN `condiciones` t4 	ON t4.`id` = t3.`condicion_id`
						");

						$result = mysqli_num_rows($query);

						if ($result > 0) {
							while ($data = mysqli_fetch_array($query)) {
						?>
						<tbody>
							<tr>
								<td><?php echo $data['id'] ?></td>
								<td>
									<a href="infoniño.php?id=<?php echo $data['id'] ?>">
									<?php echo $data['nombre'],"&nbsp;",$data['apellido']; ?>		
									</a>
								</td>
								<td><?php echo $data['sexo']; ?></td>
								<td><?php echo $data['descripcion']; ?></td>
								<td><?php echo $data['fecha_nac']; ?></td>
								<td>
									<a class="link_edit" href="actualizar_ninos.php?id=<?php echo $data['id'];?>">Editar</a>

									<a class="link_edit" href="constancia_nino.php?id=<?php echo $data['id'];?>">Generar constancia</a>

								</td>
							</tr>
						</tbody>
						<?php
							}
						}
						?>
					</table>
				</section>
		  		
		  	</div>
		  </div>
		<?php 
			include('include/footer.php');
		 ?>
    </table>
	</div>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>

$(document).ready(function() {
    $('#table-ninos').DataTable();
} );
 
</script>
</html>

