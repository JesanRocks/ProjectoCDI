<div class="usern">
	Bienvenido al sistema de registro CDI Maturín. Usuario en linea:
	<?php 
	if ($_SESSION['rol']==1) {
		$rol="Administrador";
	}else{
		$rol="Usuario";
	}

		echo $_SESSION['nombre'].", "."CI: ".$_SESSION['cedula'].", "." "."Rol: "." ".$rol; 
	?>
</div>