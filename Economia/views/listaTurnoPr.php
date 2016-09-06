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
//$fec=$anio."-".$mes."-".$dia;

 $fec=$dia."/".$mes."/".$anio;
/*$sec=$_POST['sec'];
if($sec==1){$funcionario="SEC.ECONOMIA";}if($sec==2){$funcionario="SUB.HACIENDA Y PRESUPUESTO";}if($sec==3){$funcionario="SUB.FINANZA E ING.PUBLICOS";}
if($sec==4){$funcionario="COORDINACION TRIBUTARIA";}
*/

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
   $this->Image('../images/FVhead.jpg',10,2,190,25);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    //$this->Cell(30,10,'Title',1,0,'C');
   // $this->Cell(90);
    $this->SetFont('Arial','',9);
	$this->Ln(10);

    $this->Cell(50,10,'Fecha: '.date('d-m-Y').'',0);
    //setea fuente de titulo
    $this->SetFont('Arial','B',15);global $fec;
    $this->SetFont('','U');
    $this->Ln(10);$this->SetFont('Arial','',9);
	$this->Cell(150,10,'DETALLE DE TURNOS DE ATENCION DE PROVEEDORES PARA EL DIA:',0,0,'C'); $this->Cell(20,10,$fec,0,1,'C');$this->Ln(5);
	 $this->SetFont('','');
    // Salto de línea
  
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
$pdf->Cell(10,8,utf8_decode('Turno'),1,0,'C');
$pdf->Cell(10,8,utf8_decode('Nro.Prov'),1,0,'C');
$pdf->Cell(60,8,utf8_decode('Razon Social'),1,0,'C');
$pdf->Cell(100,8,utf8_decode('Motivo'),1,0,'C');
$pdf->Ln(8);
$query="SELECT * FROM turnoeco where (fechaTurno='".$fec."') ORDER BY turno asc;";
$consulta = mysqli_query($conexion,$query);
$conteo=0;	
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(10,8,$fila['turno'],1,0,'C');
  $pdf->Cell(10,8,$fila['nroprov'],1,0,'C');
  $pdf->Cell(60,8,utf8_decode($fila['razons']),1,0,'C');
  $pdf->Cell(100,8,utf8_decode($fila['motivor']),1,0,'C');
  $pdf->Ln(8);$conteo++;
    
}

//TOTALES
$pdf->Ln(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Cantidad de Entrevistas:',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,$conteo,0,1,'C');

$pdf->Output('Listado de Entrevistas','I');


?>