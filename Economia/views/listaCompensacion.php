<?php
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$id=$_POST['bsprov'];
$dni=$_POST['nrodni'];

$conprov=mysqli_query($conexion,"select razonsocial from acreedoreconomia where nroprov='".$id."';");
$fil=mysqli_fetch_array($conprov);
$razon=$fil['razonsocial'];


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
    $this->Image('../images/logolista.jpg',20,8,180,20);
//    $this->Image('../images/logo2.jpg',10,8,45,20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    //$this->Cell(30,10,'Title',1,0,'C');
    $this->Cell(120);
    $this->SetFont('Arial','',9);
    $this->Cell(50,10,'Fecha: '.date('d-m-Y').'',0);
    $this->Ln(10);
	$this->Ln(10);
    $this->Cell(45);
    //setea fuente de titulo
    $this->SetFont('Arial','B',15);
    $this->SetFont('','U');
    //$this->Cell(100,10,'Lista de Facturas sin Gestion Judicial ',0,0,'C'); $this->Ln(10);
	$this->Cell(100,10,'ANEXO II ',0,0,'C'); $this->Ln(10);$this->SetFont('Arial','',9);
	$this->Cell(200,10,'FORMULARIO DE SOLICITUD DE COMPENSACION DE DEUDAS TRIBUTARIAS',0,0,'C'); $this->Ln(5);
	 $this->SetFont('','');
    // Salto de línea
    $this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

public function sanitizarFecha($fecha)
{
    //$date = date_create_from_format('d-m-Y', $fecha);
    $date = date_create($fecha);
    return date_format($date,'Y-m-d');
}
}


// Creación del objeto de la clase heredada
//$pdf = new PDF();//hoja vertical
$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();

//cabecera de tabla
$pdf->SetFont('Times','',6);
//$pdf->Cell(15,8,'Fecha Reclamo',1,0,'C');
$pdf->Cell(25,8,'Proveedor',1,0,'C');
$pdf->Cell(60,8,'Sujeto Pasivo',1,0,'C');
$pdf->Cell(60,8,'Tributo',1,0,'C');
$pdf->Cell(20,8,'Importe $',1,0,'C');
$pdf->Cell(60,8,'Documento',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla

$consulta = mysqli_query($conexion,"SELECT * FROM acreenciacompensacion where (provcom='".$id."') and(imprimio='NO') ORDER BY idacompensa ASC;");
$tmontof=0.00;$tcont=0;
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(25,8,$fila['provcom'],1,0,'C');
    $pdf->Cell(60,8,utf8_decode($fila['sujetop']),1,0,'C');
    $pdf->Cell(60,8,$fila['tributop'],1,0,'C');
    $pdf->Cell(20,8,number_format($fila['importep'],2,",","."),1,0,'C');
    $pdf->Cell(60,8,utf8_decode($fila['documento']),1,0,'C');
    $pdf->Ln(8);
    $tmontof=$tmontof+$fila['importep'];$tcont++;
}

//TOTALES
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);

$pdf->Cell(75,8,'Proveedor:',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,utf8_decode($razon),0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Cantidad de Documentos:',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,$tcont,0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Monto Solicitado a Compensar $:',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tmontof,2,",","."),0,1,'C');

	
$pdf->Output('Listado de Documentos Reclamadas','I');


?>