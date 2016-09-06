<?php
session_start();
$_SESSION["apynom"];$_SESSION["secretaria"];$_SESSION["nivel"];
$flag=0;
if (isset ($_SESSION["razon"]) )
{ $bsprod=$_SESSION['razon'];$flag=1;}
else{$bsprod="";}
if (isset ($_SESSION["bddesde"]) )
{  $bddesde=$_SESSION['bddesde'];$flag=1;}
else{$bddesde="1900-01-01";}
if (isset ($_SESSION["bdhasta"]) )
{   $bdhasta=$_SESSION['bdhasta'];$flag=1;}
else{$bdhasta="9999-12-31";}
if (isset ($_SESSION["nroprovd"]) )
{   $nroprovd=$_SESSION['nroprovd'];$flag=1;}
else{$nroprovd=0;}
if (isset ($_SESSION["nroprovh"]) )
{   $nroprovh=$_SESSION['nroprovh'];$flag=1;}
else{$nroprovh=99999;}
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();
//$query="select * from resumensg  where fechapresenta between '$desde' AND '$hasta' order by totaldeuda desc ;";
////////////////
if($flag==0){
 $sql="select * from turnoeco 
  where estado <>'' order by fechaTurno asc, horaTurno asc;";
  }else{
  if($bsprod!=""){
   $sql="select * from turnoeco where (razons like '%$bsprod%') and
    (presenta between '".$bddesde."'and'".$bdhasta."')and
    (nroprov between '".$nroprovd."'and '".$nroprovh."')
    order by fechaTurno asc, horaTurno asc;";
  }else {
   $sql="select * from turnoeco where (presenta between '".$bddesde."'and'".$bdhasta."')and (nroprov between '".$nroprovd."'and '".$nroprovh."')
    order by fechaTurno asc, horaTurno asc;";  
  }} 
      
//////////////////
$consulta=mysqli_query($conexion,$sql);
//$fila=mysqli_fetch_array($consulta);
//$razon=$fil['razonsocial'];


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
    $this->Cell(150);
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
    $this->Cell(200,10,'Seguimiento de Turnos de Atencion de Proveedores ',0,0,'C'); 
   //   $this->Ln(10);
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
 //$pdf->Cell(290, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0,0,'C');
 //$pdf->Ln(8);
//cabecera de tabla
$pdf->SetFont('Times','',6);
$pdf->Cell(10,5,'Fecha Turno',1,0,'C');$pdf->Cell(10,5,'Nro.Prov',1,0,'C');
$pdf->Cell(50,5,'Razon Social',1,0,'C');$pdf->Cell(20,5,'Rubro',1,0,'C');
$pdf->Cell(60,5,'Motivo Reclamo',1,0,'C');$pdf->Cell(20,5,'Periodo Prestacion',1,0,'C');
$pdf->Cell(20,5,'Monto Reclamado',1,0,'C');$pdf->Cell(25,5,'Ultima Fact.Paga',1,0,'C');
$pdf->Cell(30,5,'Estado',1,0,'C');$pdf->Cell(30,5,'Opera',1,0,'C');
/*$pdf->Cell(20,5,'Respuesta',1,0,'C');$pdf->Cell(10,5,'Observaciones',1,0,'C');
$pdf->Cell(50,5,'Fecha Atencion',1,0,'C');*/
$pdf->Ln(5);
//fin cabecera de tabla
$pdf->SetFont('Times','',4);
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(10,4,$fila['fechaTurno'],1,0,'C');
    $pdf->Cell(10,4,$fila['nroprov'],1,0,'C');
    $pdf->Cell(50,4,utf8_decode($fila['razons']),1,0,'R');
    $pdf->Cell(20,4,utf8_decode($fila['rubro']),1,0,'R');
    $pdf->Cell(60,4,utf8_decode($fila['motivor']),1,0,'R');
    $pdf->Cell(20,4,utf8_decode($fila['periodopre']),1,0,'R');
    $pdf->Cell(20,4,chr(36).''.number_format($fila['montor'],2,",","."),1,0,'R');
    $pdf->Cell(25,4,utf8_decode($fila['ultfp']),1,0,'R');
    $pdf->Cell(30,4,utf8_decode($fila['estado']),1,0,'R');
    $pdf->Cell(30,4,utf8_decode($fila['opera']),1,0,'R');$pdf->Ln(4);
    $pdf->Cell(140,4,'',0,0,'C');$pdf->SetFont('Times','',6);
    $pdf->Cell(40,5,'Respuesta',1,0,'C');$pdf->Cell(80,5,'Observaciones',1,0,'C');$pdf->Cell(15,5,'Fecha Atencion',1,0,'C');$pdf->Ln(5);
    $pdf->SetFont('Times','',4);
    $pdf->Cell(140,4,'',0,0,'C');
    $pdf->Cell(40,4,utf8_decode($fila['respuesta']),1,0,'R');
    $pdf->Cell(80,4,utf8_decode($fila['observaciones']),1,0,'R');
    $pdf->Cell(15,4,$fila['presenta'],1,0,'R');
    $pdf->Ln(4);$pdf->Cell(275,3,'-',0,0,'C');$pdf->Ln(2);
}
$pdf->Output('Listado de Seguimiento de Turnos de Atencion','I');


?>