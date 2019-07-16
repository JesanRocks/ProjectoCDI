<div class="usern">
	Bienvenido al sistema de registro CDI Maturín. Usuario en linea:
	<?php 
	if (!isset($_SESSION['active'])) {
		header('Location: index.php');
	}

	if ($_SESSION['rol']==48) {
		$rol="Administrador";
	}else{
		$rol="Usuario";
	}

		echo $_SESSION['nombre'].", "."CI: ".$_SESSION['cedula'].", "." "."Rol: "." ".$rol; 

	?>
</div>
	<?php
		 	if ($_SESSION['rol'] == 48) {
		 		include('include/menu.php');
		 	}else{
		 		include('include/menu2.php');
		 	}
	?>