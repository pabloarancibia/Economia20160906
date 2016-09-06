<?php
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
    $this->Image('../images/logoprint.jpg',10,8,40,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    //$this->Cell(30,10,'Title',1,0,'C');
    $this->Cell(70);
    $this->SetFont('Arial','',9);
    $this->Cell(50,10,'Fecha: '.date('d-m-Y').'',0);
    $this->Ln(5);
	$this->Ln(10);
    $this->Cell(45);
    //setea fuente de titulo
    $this->SetFont('Arial','B',15);
    $this->SetFont('','U');
    //$this->Cell(100,10,'Lista de Facturas sin Gestion Judicial ',0,0,'C'); $this->Ln(10);
	$this->Cell(100,10,'Usuarios ',0,0,'C'); $this->Ln(10); $this->SetFont('','');
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
$pdf->Cell(60,8,'Apynom',1,0,'C');
$pdf->Cell(20,8,'Dni',1,0,'C');
$pdf->Cell(15,8,'Nivel',1,0,'C');
$pdf->Cell(30,8,'Estado',1,0,'C');
$pdf->Cell(30,8,'Secretaria',1,0,'C');

$pdf->Ln(8);
//fin cabecera de tabla
$conexion=Conectarse();
$query="SELECT * FROM usersistema  ORDER BY  idusersistema ASC;";
$consulta = mysqli_query($conexion,$query);

while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(60,8,$fila['apynom'],1,0,'C');
    $pdf->Cell(20,8,utf8_decode($fila['dni']),1,0,'C');
    $pdf->Cell(15,8,$fila['nivel'],1,0,'C');
    $pdf->Cell(30,8,utf8_decode($fila['estado']),1,0,'C');
    $pdf->Cell(30,8,utf8_decode($fila['secretaria']),1,0,'C'); 
    $pdf->Ln(8);
}

//TOTALES
$pdf->Ln(10);

	
$pdf->Output('Listado de Usuarios','I');


?>