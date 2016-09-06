<?php
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();

$anio=$_POST['anio'];$mes=$_POST['mes'];$dia=$_POST['dia'];
switch($mes)
 {
  case "Enero": $mes = "01"; break;
  case "Febrero": $mes = "02"; break;
  case "Marzo": $mes = "03"; break;
  case "Abril": $mes = "04"; break;
  case "Mayo": $mes = "05"; break;
  case "Junio": $mes = "06"; break;
  case "Julio": $mes = "07"; break;
  case "Agosto": $mes = "08"; break;
  case "Septiembre": $mes = "09"; break;
  case "Octubre": $mes = "10"; break;
  case "Noviembre": $mes = "11"; break;
  case "Diciembre": $mes = "12"; break;     
 }
$fec=$anio."-".$mes."-".$dia;
$sec=$_POST['sec'];
if($sec==1){$funcionario="SEC.ECONOMIA";}if($sec==2){$funcionario="SUB.HACIENDA Y PRESUPUESTO";}if($sec==3){$funcionario="SUB.FINANZA E ING.PUBLICOS";}
if($sec==4){$funcionario="COORDINACION TRIBUTARIA";}


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
   $this->Image('../images/logo2.jpg',10,8,45,20);
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
    $this->Cell(100,10,'SECRETARIA DE ECONOMIA ',0,0,'C'); $this->Ln(10);$this->SetFont('Arial','',9);
	$this->Cell(200,10,'DETALLE DE MOVIMIENTOS DE MESA DE ENTRADAS DE SECRETARIA',0,0,'C'); $this->Ln(5);
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
$pdf->Cell(10,8,utf8_decode('Número'),1,0,'C');
$pdf->Cell(10,8,utf8_decode('Año'),1,0,'C');
$pdf->Cell(35,8,'Area',1,0,'C');
$pdf->Cell(40,8,utf8_decode('Trámite'),1,0,'C');
$pdf->Cell(90,8,utf8_decode('Detalle'),1,0,'C');
$pdf->Cell(23,8,'Estado',1,0,'C');
$pdf->Cell(15,8,'Entrada',1,0,'C');
$pdf->Cell(15,8,'Salida',1,0,'C');
$pdf->Cell(20,8,'Firma',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla
//$fun="SUB.HACIENDA Y PRESUPUESTO";
//$fec="2016-03-10";
$consulta = mysqli_query($conexion,"SELECT * FROM mesaentrada where (funcionario='".$funcionario."') and(fecha='".$fec."') ORDER BY idme asc;");
$conteo=0;	
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(10,8,$fila['nrome'],1,0,'C');
    $pdf->Cell(10,8,$fila['aniome'],1,0,'C');
    $pdf->Cell(35,8,utf8_decode($fila['funcionario']),1,0,'C');
    $pdf->Cell(40,8,utf8_decode($fila['tipotramite']),1,0,'C');
    $pdf->Cell(90,8,utf8_decode($fila['detalle']),1,0,'C');
    $pdf->Cell(23,8,$fila['estado'],1,0,'C');
    $pdf->Cell(15,8,$fila['fecha'],1,0,'C');
    $pdf->Cell(15,8,$fila['fecsalida'],1,0,'C');
	$pdf->Cell(20,8,'',1,0,'C');
    $pdf->Ln(8);$conteo++;
    
}

//TOTALES
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Cantidad de tramites:',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,$conteo,0,1,'C');

$pdf->Output('Listado de Tramites por funcionario','I');


?>