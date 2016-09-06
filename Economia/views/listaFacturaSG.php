<?php
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$id=$_POST['bsprov'];
$dni=$_POST['nrodni'];
$prueba=14;
$conprov=mysqli_query($conexion,"select razonsocial from acreedoreconomia where nroprov='".$id."' AND nroprov<>'".$prueba."' ;");
$fil=mysqli_fetch_array($conprov);
$razon=$fil['razonsocial'];


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
    //$this->Cell(100,10,'Lista de Facturas sin Gestion Judicial ',0,0,'C'); $this->Ln(10);
	$this->Cell(100,10,'ANEXO I ',0,0,'C'); $this->Ln(10);$this->SetFont('Arial','',9);
	$this->Cell(200,10,'FORMULARIO DE VERIFICACION DE ACREENCIA AL 09-12-15 POR DEUDAS QUE ESTAN EN GESTION ',0,0,'C'); $this->Ln(5);
	$this->Cell(200,10,'JUDICIAL Y SIN SENTENCIA FIRME Y PARA DEUDAS QUE NO SE ENCUENTREN EN GESTION JUDICIAL ',0,0,'C'); 
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
$pdf->Cell(30,8,'Instrumento',1,0,'C');
$pdf->Cell(15,8,utf8_decode('Número'),1,0,'C');
$pdf->Cell(20,8,'Tipo',1,0,'C');
$pdf->Cell(27,8,'Factura',1,0,'C');
$pdf->Cell(23,8,'Monto $',1,0,'C');
$pdf->Cell(20,8,'Pagos $',1,0,'C');
$pdf->Cell(20,8,'Total Deuda',1,0,'C');
$pdf->Ln(8);
//fin cabecera de tabla

$consulta = mysqli_query($conexion,"SELECT * FROM acreenciasingestion where (nroproveedor='".$id."') and(imprimio='NO') ORDER BY idacreenciasingestion ASC;");
$tmontof=0.00;$tpagp=0.00;$tmontot=0.00;$conteo=0;	
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(25,8,$fila['nroproveedor'],1,0,'C');
    $pdf->Cell(30,8,$fila['intrumento'],1,0,'C');
    $pdf->Cell(15,8,$fila['ordencompra'],1,0,'C');
    $pdf->Cell(20,8,$fila['tipofactura'],1,0,'C');
    $pdf->Cell(27,8,$fila['nrofactura'],1,0,'C');
    $pdf->Cell(23,8,number_format($fila['montofactura'],2,",","."),1,0,'C');
    $pdf->Cell(20,8,number_format($fila['pagosparciales'],2,",","."),1,0,'C');
    $pdf->Cell(20,8,number_format($fila['totaldeuda'],2,",","."),1,0,'C');
    $pdf->Ln(8);$conteo++;
    $tmontof=$tmontof+$fila['montofactura'];$tpagp=$tpagp+$fila['pagosparciales'];
	$tmontot=$tmontot+$fila['totaldeuda'];
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
$pdf->Cell(20,8,$conteo,0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Monto de Documentos Reclamadas $',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tmontof,2,",","."),0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Monto Pagos Parciales $',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tpagp,2,",","."),0,1,'C');

$pdf->SetFont('Times','B',10);
$pdf->Cell(75,8,'Total Deuda Reclamada $',0,0);
$pdf->SetFont('Times','',10);
$pdf->Cell(20,8,number_format($tmontot,2,",","."),0,1,'C');

	
$pdf->Output('Listado de Documentos Reclamadas','I');


?>