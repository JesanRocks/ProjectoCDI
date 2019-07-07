<?php
setlocale(LC_ALL,"es_ES");
require('fpdf/tfpdf.php');

include("conectar.php");
$query = mysqli_query($conexion,"SELECT COUNT(*) total FROM ninos");
$data = mysqli_fetch_array($query);

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

$pdf=new tFPDF();
$pdf->Text(20,30,'utf8_decode');
$pdf->AddPage();
$pdf->Image('img/logo.png',190,3,-600);
$pdf->Image('img/zonaeducativa.png',0,3,0);
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,40,'Republica Bolivariana de Venezuela',0,2,'C');
$pdf->Cell(0,-30,'Ministerio del Poder Popular para la Educacion',0,2,'C');
$pdf->Cell(0,40,'Centro de Desarollo Infantil "Cacique Guanaguanay"',0,2,'C');
$pdf->Cell(0,-30,'Modalidad de Educacion Especial',0,2,'C');
$pdf->Cell(0,40,'Maturin Estado Monagas',0,2,'C');
$pdf->Cell(300,10,'Maturin, '.strftime('%d').' de '.$mes.' de '.$año ,0,2,'C');
$pdf->SetFont('Arial','U',16);
$pdf->Cell(0,40,'Reportes',0,2,'C');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,'Numero de ninos inscritos: '.$data['total'],0,2);
$pdf->Ln();
$pdf->MultiCell(0,5,'Constancia que se expide a peticion de la parte interesada a los '.strftime('%d').' dias del mes de '.$mes.' del '.$año ,0,2);
$pdf->Cell(0,40,'Atentamente,',0,2,'C');
$pdf->Cell(0,40,'_______________',0,2,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,-20,'Profa. Yolimar Rangel',0,2,'C');
$pdf->Cell(0,30,'Directora (E)',0,2,'C');
$pdf->Cell(0,-20,'C.I: 17.242.686',0,2,'C');
$pdf->Cell(0,30,'Teléfonos: 04262036560',0,2,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,10,'______________________________________________________________________________________________',0,2,'C');
$pdf->Cell(0,-0,'Dirección: Hospital Dr. Manuel Núñez Tovar, Sector las Casitas. Telefono: 0291-6438489.',0,2,'C');
$pdf->Cell(0,10,'Email: cdimaturin@gmail.com',0,2,'C');
$pdf->Output();
?>

