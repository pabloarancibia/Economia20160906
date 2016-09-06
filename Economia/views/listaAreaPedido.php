<?php
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();/*
$sql="select a.sec,a.detsec as sec,b.subsec,b.detsubsec as ssec,c.dirgral ,c.dirdetalle as dir,d.nropedido as np,
  d.aniopedido as ap,d.isecre,d.isubsecre,d.idg 
  from secretarias a, subsecretarias b, dirgenerales c, pedidomateriales d
  where
  a.sec=d.isecre and b.subsec=d.isubsecre and c.dirgral=d.idg 
  order by isecre asc,aniopedido asc,nropedido asc ;";*/  
$sql="select a.sec,a.detsec as secre,b.subsec,b.detsubsec as ssec,d.nropedido as np,
  d.aniopedido as ap,d.isecre,d.isubsecre,d.idg 
  from secretarias a, subsecretarias b, pedidomateriales d
  where
  a.sec=d.isecre and b.subsec=d.isubsecre 
  order by d.isecre asc,d.aniopedido asc,d.nropedido asc ;";  
$consulta=mysqli_query($conexion,$sql);
//$fila=mysqli_fetch_array($consulta);
//$razon=$fil['razonsocial'];


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
	
    // Logo
   // $this->Image('../images/logoprint.jpg',10,8,45,20);
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
    $this->Cell(100,10,'Areas que realizaron Pedidos de Materiales ',0,0,'C'); 
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
$pdf = new PDF();//hoja vertical
//$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();
 //$pdf->Cell(290, 8, 'Desde: '.$verDesde.' hasta: '.$verHasta, 0,0,'C');
 $pdf->Ln(8);
//cabecera de tabla
$pdf->SetFont('Times','',6);
//$pdf->Cell(15,8,'Fecha Reclamo',1,0,'C');
$pdf->Cell(60,8,'Secretaria',1,0,'C');
$pdf->Cell(70,8,'Sub-Secretaria',1,0,'C');
//$pdf->Cell(120,8,'Dccion.Gral $',1,0,'C');
$pdf->Cell(20,8,'Nro.Pedido',1,0,'C');
$pdf->Cell(20,8,utf8_decode('Año Pedido'),1,0,'C');

$pdf->Ln(8);
//fin cabecera de tabla

$tmontof=0.00;$tpagp=0.00;$tmontot=0.00;$conteo=0;	
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(60,8,utf8_decode($fila['secre']),1,0,'C');
    $pdf->Cell(70,8,utf8_decode($fila['ssec']),1,0,'C');
   // $pdf->Cell(120,8,utf8_decode($fila['dir']),1,0,'R');
    $pdf->Cell(20,8,utf8_decode($fila['np']),1,0,'R');
    $pdf->Cell(20,8,utf8_decode($fila['ap']),1,0,'R');
    $pdf->Ln(8);$conteo++;
    }

//TOTALES
$pdf->Ln(10);

	
$pdf->Output('Listado de Documentos Reclamadas','I');


?>