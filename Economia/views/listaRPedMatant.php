<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
$idsol=$_SESSION['secretaria'];
//$anioped=$_POST['anioped'];
$anioped=2016;
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
//$secretaria=obtenerOfi($idsol);
//$np=$_POST['nroped'];
$np=3;
$queryS="select * from secretarias a where a.sec='".$idsol."';"; 
$querySS="select * from subsecretarias where isec='".$idsol."' ;";

$queryCabecera="select a.nropedido,a.aniopedido,a.estado,a.totalped,a.totalletra, a.idsolicitante,a.destinomat,a.cuenta 
from pedidomateriales a where (a.idsolicitante='".$idsol."') and (a.nropedido='".$np."')and(a.aniopedido='".$anioped."');";
$queryDetalle="select b.cantidad,b.importedetalle,b.detallepedido,b.idpedido,b.idrubro,b.idsubr
from detallepedidomateriales b where (b.idsol='".$idsol."') and (b.idpedido='".$np."') ;";

$conexion=Conectarse();
/////////////////traigo las dependencias
$conprov=mysqli_query($conexion,$queryS);
$fil=@mysqli_fetch_array($conprov);
$secretaria=$fil['detsec'];//mysqli_free_result($fil);
$conprov=mysqli_query($conexion,$querySS);
$fil=@mysqli_fetch_array($conprov);
$ssecretaria=$fil['detsubsec'];$subs=$fil['subsec'];//mysqli_free_result($fil);
$queryDG="select * from dirgenerales where issec='".$subs."';";
$conprov=mysqli_query($conexion,$queryDG);
$fil=@mysqli_fetch_array($conprov);
$dgral=$fil['dirdetalle'];//mysqli_free_result($fil);
$conprov=mysqli_query($conexion,$queryCabecera);
$fil=@mysqli_fetch_array($conprov);
$destino=$fil['destinomat'];$totalletra=$fil['totalletra'];
$cuenta=$fil['cuenta'];$nump=$fil['nropedido'];$anp=$fil['aniopedido'];


class PDF extends FPDF
{
// Cabecera de página
function Header()
{

//$this->Image('../images/solmat.jpg',10,2,190,40);
$this->Image('../images/FVhead.jpg',10,2,190,25);
    // Logo
 //   $this->Image('../images/pp.png',10,8,10,10);
    // Arial bold 15
    $this->SetFont('Arial','',7);
    // Movernos a la derecha
    //$this->Cell(80);
   	
//    $this->Cell(45);
  	 $this->Ln(15);
}
}


// Creación del objeto de la clase heredada
$pdf = new PDF();//hoja vertical
//$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'SOLICITUD DE PEDIDO DE MATERIALES',0,'T','C');
$pdf->SetFont('Arial','',7);$pdf->Ln(10);
$pdf->Cell(100,8,'INTERVENCION DE COMPRAS',1,'T','C');
$pdf->Cell(25,8,'................',1,'B','C');$pdf->Cell(20,8,'NUMERO',1,'B','C');
$pdf->Cell(25,8,'........./........./...........',1,'T','C');$pdf->Cell(20,8,'FECHA',1,'T','C'); $pdf->Ln(8);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,10,'Oficina Solicitante ',1,'T','L');
$pdf->Cell(15,10,'Secretaria: ',0,'T','L');
 $pdf->Cell(35,10,utf8_decode($secretaria),1,'T','L');
 $pdf->Cell(25,10,'Sub-Secretaria: ',0,'T','L');
$pdf->Cell(90,10,utf8_decode($ssecretaria),1,'T','C'); $pdf->Ln(10);
$pdf->Cell(25,10,'Dccion.Gral: ',1,'T','L');
$pdf->Cell(165,10,utf8_decode($dgral),1,'T','C');$pdf->Ln(10);
$pdf->Cell(35,5,'Destino de los Materiales:',1,'T','L'); $pdf->Cell(155,5,utf8_decode($destino),1,'T','C');
$pdf->Ln(5);
$pdf->Cell(35,5,'Cuenta Destino:',1,'T','L'); $pdf->Cell(155,5,utf8_decode($cuenta),1,'T','C');
$pdf->Ln(5);



$pdf->SetFont('Arial','',7);
$pdf->Cell(40,5,'IMPUTACION/CODIGO DE OFIC.',1,'T','C');
$pdf->Cell(25,5,'',1,'B','C');
$pdf->Cell(40,5,'PARTIDA/PRESUPUESTO',1,'T','C');
$pdf->Cell(25,5,'',1,'B','C');
$pdf->Cell(40,5,'INTERVENCION/PRESUPUESTO',1,'T','C');
$pdf->Cell(20,5,'',1,'B','C');
$pdf->Ln(5);
$pdf->Cell(10,5,'Nro.',1,'T','C');
$pdf->Cell(10,5,'Rubro',1,'T','C');
$pdf->Cell(10,5,'Sub.Rub',1,'T','C');
$pdf->Cell(15,5,'Cant.',1,'T','C');
$pdf->Cell(110,5,'DESCRIPCION DE BIENES/SERVICIOS ',1,'T','C');
$pdf->Cell(35,5,'IMPORTE-ESTIMADO $ ',1,'T','C');
 $pdf->Ln(5);
$consulta=mysqli_query($conexion,$queryDetalle);
$fila=mysqli_fetch_array($conprov);
$conteo=1;$tmontof=0;
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(10,5,number_format($conteo,0,",","."),0,'L','R');
	$pdf->Cell(10,5,number_format($fila['idrubro'],0,",","."),0,'T','C');
    $pdf->Cell(10,5,number_format($fila['idsubr'],0,",","."),0,'T','C');
	$pdf->Cell(15,5,number_format($fila['cantidad'],2,",","."),0,'T','C');
	$y = $pdf->GetY();
    $acotado =utf8_decode($fila['detallepedido']);
    $pdf->MultiCell(110,5,$acotado,0,'L'); $pdf->SetXY(165,$y);
	//$pdf->Cell(120,5,utf8_decode($fila['detallepedido']),1,'T','L');
    $pdf->Cell(35,5,chr(36).' '.number_format($fila['importedetalle'],2,",","."),0,'R','R');
    $pdf->Ln(5);$conteo++;
    $tmontof=$tmontof+$fila['importedetalle'];
}
if($conteo<24){
	for($i=$conteo;$i<26;$i++){
		$pdf->Cell(10,5,'',0,'T','R');
	$pdf->Cell(25,5,'',0,'T','C');
	$pdf->Cell(120,5,'',0,'T','L');
    $pdf->Cell(35,5,'',0,'T','R');
    $pdf->Ln(5);
	}
}
$pdf->Cell(10,5,'Total:',0,'T','C');
$pdf->Cell(145,5,utf8_decode($totalletra),0,'T','L');
$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');
$pdf->Ln(5);
$pdf->Cell(40,5,'Pedido de Secretaria Nro:',0,'T','C');
$pdf->Cell(10,5,$nump,0,'T','L');
$pdf->Cell(5,5,'-',0,'T','C');
$pdf->Cell(10,5,$anp,0,'T','C');
$pdf->Cell(40,5,utf8_decode('Re-Impresión'),0,'T','C');

$pdf->Ln(5);

 $pdf->Cell(190,5,'AUTORIZACIONES',1,'T','C');$pdf->Ln(5);
$pdf->Cell(70,5,'DIRECCION GRAL.',1,'T','C');
$pdf->Cell(60,5,'SUBSECRETARIA',1,'T','C');
$pdf->Cell(60,5,'SECRETARIA',1,'T','C');
 $pdf->Ln(5);

 $pdf->Cell(70,10,'',1,'T','C');
$pdf->Cell(60,10,'',1,'T','C');
$pdf->Cell(60,10,'',1,'T','C');
 $pdf->Ln(10);

 $pdf->Cell(190,5,'INTERVENCION DIRECCION GRAL DE ADMINISTRACION-CORRESPONDE',1,'T','C');$pdf->Ln(5);
$pdf->Cell(40,5,'COMPRA DIRECTA',1,'T','C');$pdf->Cell(30,5,'',1,'T','C');
$pdf->Cell(40,5,'CONCURSO PREVIO',1,'T','C');$pdf->Cell(20,5,'',1,'T','C');
$pdf->Cell(40,5,'LICITACION PRIVADA',1,'T','C');$pdf->Cell(20,5,'',1,'T','C');
 $pdf->Ln(5);
$pdf->Cell(100,15,'AUTORIZACION SECRETARIA DE ECONOMIA',1,'T','C');
$pdf->Cell(90,15,'',1,'T','C');




$pdf->Output('Formulario de Pedido de Materiales','I');

 
////////////////////


?>