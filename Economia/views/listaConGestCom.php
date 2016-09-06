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
if (isset ($_SESSION["aleatoriod"]) )
{   $aleatoriod=$_SESSION['aleatoriod'];$flag=1;}
else{$aleatoriod=0;}
if (isset ($_SESSION["aleatorioh"]) )
{  $aleatorioh=$_SESSION['aleatorioh'];$flag=1;}
else{$aleatorioh=999999;}
if (isset ($_SESSION["nroprovd"]) )
{   $nroprovd=$_SESSION['nroprovd'];$flag=1;}
else{$nroprovd=0;}
if (isset ($_SESSION["nroprovh"]) )
{   $nroprovh=$_SESSION['nroprovh'];$flag=1;}
else{$nroprovh=99999;}
if (isset ($_SESSION["nocd"]) )
{   $nocd=$_SESSION['nocd'];$flag=1;}
else{$nocd=0;}
if (isset ($_SESSION["noch"]) )
{   $noch=$_SESSION['noch'];$flag=1;}
else{$noch=99999;}
if (isset ($_SESSION["npmd"]) )
{   $npmd=$_SESSION['npmd'];$flag=1;}
else{$npmd=0;}
if (isset ($_SESSION["npmh"]) )
{   $npmh=$_SESSION['npmh'];$flag=1;}
else{$npmh=99999;}
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();
//$query="select * from resumensg  where fechapresenta between '$desde' AND '$hasta' order by totaldeuda desc ;";
////////////////
$permiso=$_SESSION['nivel'];$usecre=$_SESSION['secretaria'];
  if($permiso==10||$permiso==12||$permiso==3||$permiso==99)
  {
   if($flag==0){
   //$sql="select * from resumensg order by totaldeuda desc ;";
    $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.fechapedido,a.totalped, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (a.idpedidomateriales=b.aleatorio) 
  order by a.idpedidomateriales;";
  }else{
  if($bsprod!=""){
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (b.proveedor like '%$bsprod%') and
    (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."')and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."') 
    and (a.idpedidomateriales=b.aleatorio)
  order by a.idpedidomateriales;";
  }else {
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (a.idpedidomateriales=b.aleatorio) and 
   (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."') 
  order by a.idpedidomateriales;";  
  }}   
  }
  else{
    if($flag==0){
     $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.fechapedido,a.totalped, b.pedmat, b.aniooc, b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, b.fecas, b.nropv from pedidomateriales a, gestioncompra b where (a.idpedidomateriales=b.aleatorio) and (a.isecre='".$usecre."') 
  order by a.idpedidomateriales;";
  }else{
  if($bsprod!=""){
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (b.proveedor like '%$bsprod%') and
    (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."') 
    and (a.idpedidomateriales=b.aleatorio) and (a.isecre='".$usecre."') order by a.idpedidomateriales;";
  }else {
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (a.idpedidomateriales=b.aleatorio) and 
   (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."') and (a.isecre='".$usecre."') 
  order by a.idpedidomateriales;";  
  }}
  }
      
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
    $this->Cell(200,10,'Seguimiento de Pedidos de Materiales ',0,0,'C'); 
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
$pdf->SetFont('Times','',5);
$pdf->Cell(20,8,'Aleatorio',1,0,'C');$pdf->Cell(20,8,'Secretaria',1,0,'C');
$pdf->Cell(10,8,utf8_decode('Año'),1,0,'C');$pdf->Cell(20,8,'Pedido Electronico',1,0,'C');
$pdf->Cell(10,8,'Fecha Pedido',1,0,'C');$pdf->Cell(20,8,'Monto Estimado $',1,0,'C');
$pdf->Cell(20,8,'Pedido Material',1,0,'C');$pdf->Cell(10,8,utf8_decode('Año O.C'),1,0,'C');
$pdf->Cell(10,8,'Nro.O.C',1,0,'C');$pdf->Cell(20,8,'Monto Asignado',1,0,'C');
$pdf->Cell(20,8,'Fecha O.C',1,0,'C');$pdf->Cell(10,8,'Nro.Prov.',1,0,'C');
$pdf->Cell(50,8,'Razon Social',1,0,'C');
$pdf->Cell(25,8,'Tipo de Contratacion',1,0,'C');$pdf->Cell(10,8,'Fecha',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla

while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(20,8,$fila['idpedidomateriales'],1,0,'C');
    $pdf->Cell(20,8,$fila['isecre'],1,0,'C');
    $pdf->Cell(10,8,$fila['aniopedido'],1,0,'R');
    $pdf->Cell(20,8,$fila['nropedido'],1,0,'R');
    $pdf->Cell(10,8,$fila['fechapedido'],1,0,'R');
    $pdf->Cell(20,8,chr(36).''.number_format($fila['totalped'],2,",","."),1,0,'R');
    $pdf->Cell(20,8,$fila['pedmat'],1,0,'R');
    $pdf->Cell(10,8,$fila['aniooc'],1,0,'R');
    $pdf->Cell(10,8,$fila['nrooc'],1,0,'R');
    $pdf->Cell(20,8,chr(36).''.number_format($fila['asignado'],2,",","."),1,0,'R');
    $pdf->Cell(20,8,$fila['fecoc'],1,0,'R');
    $pdf->Cell(10,8,$fila['nropv'],1,0,'R');
    $pdf->Cell(50,8,utf8_decode($fila['proveedor']),1,0,'R');
    $pdf->Cell(25,8,utf8_decode($fila['actuacions']),1,0,'R');
    $pdf->Cell(10,8,$fila['fecas'],1,0,'R');
    $pdf->Ln(8);}
$pdf->Output('Listado de Seguimiento de Pedidos de Materiales','I');


?>