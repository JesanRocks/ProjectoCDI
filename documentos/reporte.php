<?php 
require_once("vendor/autoload.php");
require '../include/db/conectar.php';

$query = mysqli_query($conexion,"SELECT COUNT(*) total FROM ninos");
$data = mysqli_fetch_array($query);

date_default_timezone_set('UTC');
setlocale(LC_ALL,"ES");

switch (date('m')) {
	case '01':
		$mes="Enero";
		break;

	case '02':
		$mes="Febrero";
		break;	

	case '03':
		$mes="Marzo";
		break;

	case '04':
		$mes="Abril";
		break;

	case '05':
		$mes="Mayo";
		break;

	case '06':
		$mes="Junio";
		break;	

	case '07':
		$mes="Julio";
		break;

	case '08':
		$mes="Agosto";
		break;

	case '09':
		$mes="Septiembre";
		break;

	case '10':
		$mes="Octubre";
		break;	

	case '11':
		$mes="Noviembre";
		break;

	case '12':
		$mes="Diciembre";
		break;	
	default:
		# code...
		break;
}

$año=date('Y');

/* Start to develop here. Best regards https://php-download.com/ */

// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'Letter',
	'default_font_size' => 12,
	'default_font' => 'arial'
]);

$cintillo="<img src=../img/cintillomppe.png>";

$membrete="<br><br><br><br><br><br><p align=center><b> República Bolivariana de Venezuela<br>	Ministerio del poder popular para Educación<br> Centro de Desarollo Infantil  &quot;Cacique Guanaguanay&quot;<br> Modalidad de Educacion Especial<br> Maturín - Estado Monagas<br></b></p>";

$fecha="<br><h4 align='right'>Maturin, ".strftime('%d')." de ".$mes." de ".$año."</h4><br>";

$titulo="<br><h2 align='center'>Reportes</h2><br>";

$texto="<p align=justify>Numero de niños inscritos: ".$data['total']."<br/><br/>
Constancia que se expide a peticion de la parte interesada a los ".strftime('%d')." dias del mes de ".$mes." del ".$año." </p><br><h4 align='center'>Atentamente.</h4><br>";	

$Firma="<br><p align=center><b>____________________________<br>Profa. Yolimar Rangel<br>Directora (E)<br>C.I: 17.242.686<br> Teléfonos: 04262036560
</b><br></p>";

$footer="<hr>
<p align=center>Dirección: Hospital Dr. Manuel Núñez Tovar, Sector las Casitas. Telefono: 0291-6438489.<br>Email: cdimaturin@gmail.com</p>";
// Write some HTML code:
$mpdf->SetHeader($cintillo);
$mpdf->WriteHTML($membrete);
$mpdf->WriteHTML($fecha);
$mpdf->WriteHTML($titulo);
$mpdf->WriteHTML($texto);
$mpdf->WriteHTML($Firma);
$mpdf->SetFooter($footer);
// Output a PDF file directly to the browser
$mpdf->Output();
?>