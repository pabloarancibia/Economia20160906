<?php
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
//require('conexion.php');
$conexion=Conectarse();
$id=$_POST['bsprov'];
$dni=$_POST['nrodni'];
$con="select a.dnidem, a.ayn, b.tipo, b.aynabo, b.honorabo from acreenciacongestion a, honorabogados b where (a.dnidem='".$dni."') and b.dnidem='".$dni."' ;";
$consulta=mysqli_query($conexion,$con);
//$fila=mysqli_fetch_array($conprov);
//$razon=$fil['razonsocial'];


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
    $this->Image('../images/logoprint.jpg',10,8,33,20);
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
	$this->Cell(100,10,'ANEXO III ',0,0,'C'); $this->Ln(10);$this->SetFont('Arial','',9);
	$this->Cell(200,10,'PLANILLA DETALLE DE HONORARIOS REGULADOS',0,0,'C'); $this->Ln(5);
	
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
$pdf = new PDF();//hoja vertical
//$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();

//cabecera de tabla
$pdf->SetFont('Times','',6);
$pdf->Cell(30,8,utf8_decode('Representación'),1,0,'C');
$pdf->Cell(100,8,'Apellido y Nombre',1,0,'C');
$pdf->Cell(30,8,'Honorarios $',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla

$thonorabom=0.00;$thonorabod=0.00;$tmontot=0.00;$conteo=0;
while($fila = mysqli_fetch_array($consulta)){
    $razon=$fila['ayn'];
	$pdf->Cell(30,8,utf8_decode($fila['tipo']),1,0,'C');
    $pdf->Cell(100,8,utf8_decode($fila['aynabo']),1,0,'C');
    $pdf->Cell(30,8,chr(36).''.number_format($fila['honorabo'],2,",","."),1,0,'C');
    $pdf->Ln(8);$conteo++;
    if($fila['tipo']=="MUNICIPALIDAD"){
        $thonorabom=$thonorabom+$fila['honorabo'];
    }else{
        $thonorabod=$thonorabod+$fila['honorabo'];
    }
    $tmontot=$tmontot+$fila['honorabo'];
   }

//TOTALES
$pdf->ln(8);   
$pdf->SetFont('Times','B',9);
$pdf->Cell(30,8,'Demandante:',0,0);
$pdf->Cell(25,8,$dni,0,0,'R');
$pdf->Cell(80,8,utf8_decode($razon),0,0,'R');
$pdf->Ln(8);

$pdf->Cell(45,8,'Cantidad de Profesionales:',0,0);
$pdf->Cell(20,8,$conteo,0,0,'C');
$pdf->Ln(8);

$pdf->Cell(60,8,'Total Honorarios Municipio $:',0,0);
$pdf->Cell(20,8,chr(36).''.number_format($thonorabom,2,",","."),0,0,'C');
$pdf->Ln(8);

$pdf->Cell(60,8,'Total Honorarios Demandante $:',0,0);
$pdf->Cell(20,8,chr(36).''.number_format($thonorabod,2,",","."),0,0,'C');
$pdf->Ln(8);

$pdf->Cell(60,8,'Total Honorarios Regulados $:',0,0);
$pdf->Cell(20,8,chr(36).''.number_format($tmontot,2,",","."),0,0,'C');

	
$pdf->Output('Listado de Documentos Reclamadas','I');

?>