<?php
session_start();
$_SESSION["apynom"];$_SESSION["secretaria"];
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
$prueba=14;
 //$query="select sum(a.montofactura) as mf,sum(a.pagosparciales) as pp,sum(a.totaldeuda) as td, a.nroproveedor, ac.razonsocial, ac.apellido from acreenciasingestion a, acreedoreconomia ac where (a.nroproveedor=ac.nroprov) and a.nroproveedor <>'".$prueba."' and  (a.nroproveedor not in (select r.nroprov from resumensg r)) group by a.nroproveedor order by td desc ;";
if($flag==0){
   $sql="select sum(a.montofactura) as mf,sum(a.pagosparciales) as pp,
   sum(a.totaldeuda) as td, a.nroproveedor, ac.razonsocial, ac.apellido,
    a.fechacarga, ac.tel1, ac.email from acreenciasingestion a,
     acreedoreconomia ac where (a.nroproveedor=ac.nroprov)
      and a.nroproveedor <>'".$prueba."' and  
      (a.nroproveedor not in (select r.nroprov from resumensg r))
       group by a.nroproveedor order by td desc ;";
  }else{
  if($bsprod!=""){
    $sql=" select sum(a.montofactura) as mf,sum(a.pagosparciales) as pp,
   sum(a.totaldeuda) as td, a.nroproveedor, ac.razonsocial, ac.apellido,
    a.fechacarga, ac.tel1, ac.email from acreenciasingestion a,
     acreedoreconomia ac
    where (ac.razonsocial like '%$bsprod%') and
    (a.fechacarga between '".$bddesde."'and'".$bdhasta."')and
    (a.nroproveedor between '".$nroprovd."'and '".$nroprovh."')
    and (a.nroproveedor=ac.nroprov)
      and (a.nroproveedor <>'".$prueba."') and
      (a.nroproveedor not in (select r.nroprov from resumensg r))
   group by a.nroproveedor order by td desc ;";
  }else {
    $sql="select sum(a.montofactura) as mf,sum(a.pagosparciales) as pp,
   sum(a.totaldeuda) as td, a.nroproveedor, ac.razonsocial, ac.apellido,
    a.fechacarga, ac.tel1, ac.email from acreenciasingestion a,
     acreedoreconomia ac
    where (a.fechacarga between '".$bddesde."'and'".$bdhasta."')and
    (a.nroproveedor between '".$nroprovd."'and '".$nroprovh."')
    and (a.nroproveedor=ac.nroprov) and (a.nroproveedor <>'".$prueba."') and
      (a.nroproveedor not in (select r.nroprov from resumensg r))
     group by a.nroproveedor order by td desc ;";
  }}
$consulta=mysqli_query($conexion,$sql);
//$fil=mysqli_fetch_array($consulta);
//$razon=$fil['razonsocial'];


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
    $this->Image('../images/logoprint.jpg',10,8,45,20);
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
    $this->Cell(100,10,'Lista de Montos por Proveedor a ser  Presentadas ',0,0,'C'); $this->Ln(10);
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
//$pdf->Cell(15,8,'Fecha Reclamo',1,0,'C');
$pdf->Cell(25,8,'Proveedor',1,0,'C');
$pdf->Cell(30,8,'Razon Social',1,0,'C');
$pdf->Cell(23,8,'Monto $',1,0,'C');
$pdf->Cell(20,8,'Pagos $',1,0,'C');
$pdf->Cell(20,8,'Total Deuda',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla

$tmontof=0.00;$tpagp=0.00;$tmontot=0.00;$conteo=0;	
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(25,8,$fila['nroproveedor'],1,0,'C');
    if($fila['razonsocial']!=""){
    $pdf->Cell(30,8,utf8_decode($fila['razonsocial']),1,0,'C');}
     else{
        $pdf->Cell(30,8,utf8_decode($fila['apellido']),1,0,'C');
     }
    $pdf->Cell(23,8,number_format($fila['mf'],2,",","."),1,0,'R');
    $pdf->Cell(20,8,number_format($fila['pp'],2,",","."),1,0,'R');
    $pdf->Cell(20,8,number_format($fila['td'],2,",","."),1,0,'R');

    $pdf->Ln(8);$conteo++;
    $tmontof=$tmontof+$fila['mf'];$tpagp=$tpagp+$fila['pp'];
	$tmontot=$tmontot+$fila['td'];
}

//TOTALES
$pdf->Ln(10);

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Cantidad de Proveedores:',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,$conteo,0,1,'R');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Monto de Documentos Reclamadas $',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tmontof,2,",","."),0,1,'R');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Monto Pagos Parciales $',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tpagp ,2,",","."),0,1,'R');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Total Deuda Reclamada $',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tmontot ,2,",","."),0,1,'R');

	
$pdf->Output('Listado de Documentos Reclamadas','I');


?>