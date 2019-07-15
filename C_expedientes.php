<?php 
	include("include/db/conectar.php");
	session_start();
	if (empty($_SESSION['active'])) {
		header("location: index.php");
	}

	$query = "SELECT * FROM expedientes
				INNER JOIN personas on expedientes.id_personas = personas.id";
	$sql = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CDI - Matúrin | Consulta de evaluaciones</title>
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
    <div class="row">
		  	<div class="col-md-12">
				<section class="container" id="container1">
					<h1>Lista de evaluaciones</h1>
					<div class="table-responsive">
					<table id="table-expedientes" class="display">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Descripcion de Expediente</th>
								<th>Niño</th>
								<th>Docente encargado</th>
								<!--<th>Acción</th>-->
							</tr>
						</thead>
						<tbody>
						<?php 
						
						$result = mysqli_num_rows($sql);

						if ($result > 0) {
							while ($data = mysqli_fetch_array($sql)) {
						?>
						
							<tr>
								<td><?php echo $data['fecha_expediente']; ?></td>
								<td><?php echo $data['descripcion']; ?></td>
								<td><?php echo $data['nombre'].' '.$data['apellido']; ?></td>
								<td><?php echo $data['nombre'].' '.$data['apellido']; ?></td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
				</section>
			</div>
		</div>
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
     $('#table-expedientes').DataTable();
 } );
 
</script>
</html>