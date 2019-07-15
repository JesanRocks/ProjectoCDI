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
	<title>CDI - Matúrin | Consulta de representantes</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="img/icon.gif">
	<link rel="stylesheet" href="css/c_r_d.css">
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
					<h1>Lista de Representantes</h1>
					<div class="table-responsive">
						<table id="table-reprecentantes" class="display">
						<thead>
							<tr>
								<th>N°</th>
								<th>Apellidos</th>
								<th>Nombres</th>
								<th>Nacionalidad</th>
								<th>Cedula</th>
								<th>Lugar de Nac</th>
								<th>Estado</th>
								<th>Edad</th>
								<th>Profesión</th>
								<th>Fecha de Nac</th>
								<th>Nivel Aca</th>
								<th>Telefono</th>
								<th>Dirección</th>
								<th>Acción</th>
							</tr>	
						</thead>
							<tbody>
							<?php 

								$query = mysqli_query($conexion,"SELECT id, nombre_r, apellido_r, nacionalidad_r, 
								cedula_r, lugar_nacimiento_r, estado_r, edad_r, profesion_r, fecha_nac_r,
								nivel_aca_r, telefono_r, direccion_r FROM representante");

								$result = mysqli_num_rows($query);

								if ($result > 0) {
									while ($data = mysqli_fetch_array($query)) {
							?>		
								<tr>
									<td><?php echo $data['id'] ?></td>
									<td><?php echo $data['nombre_r'] ?></td>
									<td><?php echo $data['apellido_r'] ?></td>
									<td><?php echo $data['nacionalidad_r'] ?></td>
									<td><?php echo $data['cedula_r'] ?></td>
									<td><?php echo $data['lugar_nacimiento_r'] ?></td>
									<td><?php echo $data['estado_r'] ?></td>
									<td><?php echo $data['edad_r'] ?></td>
									<td><?php echo $data['profesion_r'] ?></td>
									<td><?php echo $data['fecha_nac_r'] ?></td>
									<td><?php echo $data['nivel_aca_r'] ?></td>
									<td><?php echo $data['telefono_r'] ?></td>
									<td><?php echo $data['direccion_r'] ?></td>

									<td>
										<a class="link_edit" href="actualizar_representante.php?id=<?php echo $data['id'] ?>">Editar
										</a>
									</td>
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
    $('#table-reprecentantes').DataTable();
} );
 
</script>
</html>