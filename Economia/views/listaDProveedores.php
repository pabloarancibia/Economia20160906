<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}

$_SESSION["apynom"];$_SESSION["secretaria"];
$flag=0;
if (isset ($_SESSION["razon"]) )
{ $bsprod=$_SESSION['razon'];$flag=1;}
else{$bsprod="";}
if (isset ($_SESSION["nroprovd"]) )
{   $nroprovd=$_SESSION['nroprovd'];$flag=1;}
else{$nroprovd=0;}
if (isset ($_SESSION["nroprovh"]) )
{   $nroprovh=$_SESSION['nroprovh'];$flag=1;}
else{$nroprovh=99999;}
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
	$this->Cell(100,10,'Proveedores ',0,0,'C'); $this->Ln(10); $this->SetFont('','');
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
$pdf->Cell(15,8,'Proveedor',1,0,'C');
$pdf->Cell(60,8,'Razon Social',1,0,'C');
$pdf->Cell(15,8,'C.U.I.T',1,0,'C');
$pdf->Cell(30,8,'Apellido',1,0,'C');
$pdf->Cell(30,8,'Nombre',1,0,'C');
$pdf->Cell(60,8,'Domicilio',1,0,'C');
$pdf->Cell(15,8,'Localidad',1,0,'C');
$pdf->Cell(15,8,'Provincia',1,0,'C');
$pdf->Cell(15,8,'Tel.1',1,0,'C');
$pdf->Cell(30,8,'Email',1,0,'C');


$pdf->Ln(8);
//fin cabecera de tabla
$conexion=Conectarse();
//$query="SELECT * FROM acreedoreconomia where (razonsocial <> '') || (apellido <> '') ORDER BY  razonsocial ASC;";
 if($flag==0){
   $sql="SELECT * FROM acreedoreconomia where (razonsocial <> '') || (apellido <> '') ORDER BY  razonsocial ASC;";
  }else{
  if($bsprod!=""){
    $sql="select * from acreedoreconomia
    where (razonsocial like '%$bsprod%')
     ORDER BY  razonsocial ASC ;";
  }else {
    $sql="select * from acreedoreconomia
    where (nroprov between '".$nroprovd."'and '".$nroprovh."') and
    (apellido <> '')  ORDER BY  razonsocial ASC ;";
  }}
$consulta = mysqli_query($conexion,$sql);

while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(15,8,$fila['nroprov'],1,0,'C');
    $pdf->Cell(60,8,utf8_decode($fila['razonsocial']),1,0,'C');
    $pdf->Cell(15,8,$fila['cuit'],1,0,'C');
    $pdf->Cell(30,8,utf8_decode($fila['apellido']),1,0,'C');
    $pdf->Cell(30,8,utf8_decode($fila['nombre']),1,0,'C');
    $pdf->Cell(60,8,utf8_decode($fila['domicilio']),1,0,'C');
    $pdf->Cell(15,8,$fila['localidad'],1,0,'C');
    $pdf->Cell(15,8,$fila['provincia'],1,0,'C');
    $pdf->Cell(15,8,$fila['tel1'],1,0,'C');
    $pdf->Cell(30,8,$fila['email'],1,0,'C');

 
    $pdf->Ln(8);
}

//TOTALES
$pdf->Ln(10);

	
$pdf->Output('Listado de Proveedores','I');


?>