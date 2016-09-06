<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
$idsol=$_SESSION['secretaria'];
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
//$secretaria=obtenerOfi($idsol);
$np=obtenerPed($idsol);

$queryS="select * from secretarias a where a.sec='".$idsol."';"; 
$querySS="select * from subsecretarias where isec='".$idsol."' ;";

$queryCabecera="select a.nropedido,a.aniopedido,a.estado,a.totalped,a.totalletra, a.idsolicitante,a.destinomat,a.cuenta from pedidomateriales a where (a.idsolicitante='".$idsol."') and (a.nropedido='".$np."');";
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

    $this->Image('../images/FHhead.jpg',10,2,275,27);
    // Logo
 //   $this->Image('../images/pp.png',10,8,10,10);
    // Arial bold 15
    $this->SetFont('Arial','',7);
    // Movernos a la derecha
    //$this->Cell(80);
   	
//    $this->Cell(45);
  	 $this->Ln(15);
}
// Pie de página
function Footer()
{  // Posición: a 1,5 cm del final
    $this->Image('../images/FHfooter.jpg',10,200,275,10);
    // Arial italic 8
//    $this->SetFont('Arial','I',8);
    // Número de página
  //  $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}


// Creación del objeto de la clase heredada
//$pdf = new PDF();//hoja vertical
$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(5);
$pdf->SetFont('Arial','IUB',14);
$pdf->Cell(220,8,utf8_decode('CERTIFICACION DE HORAS EXTRAS PRESTADAS'),0,0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',14);
$pdf->Cell(220,8,utf8_decode('MEMORANDUM NRO°:'),0,0,'R');
//$pdf->Cell(40,8,'Pedido de Secretaria:',0,'T','C');
$pdf->Cell(10,8,$idsol,0,'T','L');
$pdf->Cell(10,8,$nump,0,'T','R');
$pdf->Cell(5,8,'-',0,'T','C');
$pdf->Cell(10,8,$anp,0,'T','C');
$pdf->SetFont('Arial','',8);
$pdf->Ln(8);
$pdf->Cell(0,8,utf8_decode(' Por medio de la presente se certifica que los agentes dependientes de este área realizaron las Horas Extras Autorizadas en el período certificado, según el siguiente detalle.'),0,1,'L');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,5,'Oficina Solicitante ',1,'T','L');
$pdf->Cell(15,5,'Secretaria: ',1,'T','L');
 $pdf->Cell(35,5,utf8_decode($secretaria),1,'T','L');
 $pdf->Cell(25,5,'Sub-Secretaria: ',1,'T','L');
$pdf->Cell(175,5,utf8_decode($ssecretaria),1,'T','C'); $pdf->Ln(5);
$pdf->Cell(25,5,'Dccion.Gral: ',1,'T','L');
$pdf->Cell(250,5,utf8_decode($dgral),1,'T','C');$pdf->Ln(5);
 $pdf->Cell(25,5,utf8_decode('Dirección: '),1,'T','L');
$pdf->Cell(250,5,'wcnwjckawcjd',1,'T','C'); $pdf->Ln(5);
$pdf->Cell(25,5,utf8_decode('Departamento: '),1,'T','L');
$pdf->Cell(250,5,'bcsakljcbkabjcsl',1,'T','C');$pdf->Ln(5);

$pdf->SetFont('Arial','',6);
$pdf->Cell(10,5,'GRUPO',1,'T','C');$pdf->Cell(10,5,'COBRO',1,'T','C');
$pdf->Cell(20,5,'D.N.I',1,'T','C');$pdf->Cell(20,5,'C.U.I.L',1,'T','C');
$pdf->Cell(60,5,'APELLIDOS Y NOMBRES',1,'T','C');
$pdf->Cell(20,5,'PER.ANTERIOR',1,'T','C');
$pdf->Cell(10,5,'HS.S.',1,'T','C');$pdf->Cell(10,5,'HS.D.',1,'T','C');
$pdf->Cell(20,5,'TOT.ANTERIOR',1,'T','C');
$pdf->Cell(20,5,'PER.CERTIFICADO',1,'T','C');
$pdf->Cell(10,5,'HS.S.',1,'T','C');$pdf->Cell(10,5,'HS.D',1,'T','C');
$pdf->Cell(20,5,'TOT.CERTIFICADO',1,'T','C');
$pdf->Cell(35,5,'MOTIVO ',1,'T','C');
 $pdf->Ln(5);
$consulta=mysqli_query($conexion,$queryDetalle);
$fila=mysqli_fetch_array($conprov);
$conteo=1;$tmontof=0;
/*while($fila = mysqli_fetch_array($consulta)){
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
}*/
$pdf->Cell(10,5,'0',0,'T','C');
$pdf->Cell(10,5,'18999',0,'T','C');
$pdf->Cell(20,5,'99888777',0,'T','C');
$pdf->Cell(20,5,'20998887770',0,'T','C');
$pdf->Cell(60,5,'NAPOLEON BONAPARTE',0,'T','C');
$pdf->Cell(20,5,'NOVIEMBRE',0,'T','C');
$pdf->Cell(10,5,'50',0,'T','C');
$pdf->Cell(10,5,'10',0,'T','C');$pdf->Cell(20,5,'70',0,'T','C');
$pdf->Cell(20,5,'DICIEMBRE',0,'T','C');
$pdf->Cell(10,5,'30',0,'T','C');
$pdf->Cell(10,5,'20',0,'T','C');
$pdf->Cell(20,5,'70',0,'T','C');
$pdf->Cell(35,5,'ESTACIONALIDAD ',0,'T','C');
 $pdf->Ln(5);
 

if($conteo<10){
	for($i=$conteo;$i<10;$i++){
		$pdf->Cell(10,5,'',0,'T','R');
	$pdf->Cell(25,5,'',0,'T','C');
	$pdf->Cell(120,5,'',0,'T','L');
    $pdf->Cell(35,5,'',0,'T','R');
    $pdf->Ln(5);
	}
}
$pdf->Cell(55,5,'',0,'T','C');
$pdf->Cell(55,5,'',0,'T','C');
$pdf->Cell(35,5,utf8_decode('HS.Período Anterior:'),0,'T','C');
//$pdf->Cell(105,5,'',0,'T','L');//$pdf->Cell(145,5,utf8_decode($totalletra),0,'T','L');
$pdf->Cell(10,5,'50',0,'T','R');//$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');
$pdf->Cell(10,5,'10',0,'T','R');//$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');


$pdf->Cell(35,5,utf8_decode('HS.Período Actual:'),0,'T','C');
//$pdf->Cell(105,5,'',0,'T','L');//$pdf->Cell(145,5,utf8_decode($totalletra),0,'T','L');
$pdf->Cell(10,5,'30',0,'T','R');//$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');
$pdf->Cell(10,5,'20',0,'T','R');//$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');

$pdf->ln(5);
$pdf->Cell(55,5,'',0,'T','C');
$pdf->Cell(55,5,'',0,'T','C');
$pdf->Cell(35,5,'Total Horas Per.Anterior:',0,'T','C');
//$pdf->Cell(105,5,'',0,'T','L');//$pdf->Cell(145,5,utf8_decode($totalletra),0,'T','L');
$pdf->Cell(20,5,'70',0,'T','R');//$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');
$pdf->Cell(35,5,'Total Horas Per.Certificado:',0,'T','C');
//$pdf->Cell(105,5,'',0,'T','L');//$pdf->Cell(145,5,utf8_decode($totalletra),0,'T','L');
$pdf->Cell(20,5,'70',0,'T','R');//$pdf->Cell(35,5,chr(36).' '.number_format($tmontof,2,",","."),0,'T','C');
$pdf->Ln(5);


$pdf->Cell(275,5,'AUTORIZACIONES',1,'T','C');$pdf->Ln(5);
$pdf->Cell(55,5,'DEPARTAMENTO.',1,'T','C');
$pdf->Cell(55,5,'DIRECCION.',1,'T','C');
$pdf->Cell(55,5,'DIRECCION GRAL.',1,'T','C');
$pdf->Cell(55,5,'SUBSECRETARIA',1,'T','C');
$pdf->Cell(55,5,'SECRETARIA',1,'T','C');
 $pdf->Ln(5);
$pdf->Cell(55,10,'',1,'T','C');
$pdf->Cell(55,10,'',1,'T','C');
$pdf->Cell(55,10,'',1,'T','C');
$pdf->Cell(55,10,'',1,'T','C');
$pdf->Cell(55,10,'',1,'T','C');
 $pdf->Ln(10);
$pdf->Cell(150,15,'AUTORIZACION SECRETARIA DE ECONOMIA',1,'T','C');
$pdf->Cell(125,15,'',1,'T','C');




$pdf->Output('Formulario de Solicitud de Horas Extras','I');

 function obtenerPed($idsol){
	$query2 = "SELECT nropedido,aniopedido FROM pedidomateriales where idsolicitante='".$idsol."' ORDER BY aniopedido desc, nropedido desc LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs2 =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs2);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs2);
		$np = $row['nropedido'];
		  }else{$np=0;}
		mysqli_free_result($rs2);	 mysqli_close($conexion2);
	 return $np;
 }
////////////////////


?>