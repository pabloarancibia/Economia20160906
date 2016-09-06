<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
$idsol=$_SESSION['secretaria'];
$nivel=$_POST['nivel'];
if($nivel==1){$sec=1;}if($nivel==2){$sec=2;}
if($nivel==3){$sec=3;}if($nivel==4){$sec=4;}
if($nivel==5){$sec=5;}if($nivel==6){$sec=6;}
if($nivel==7){$sec=7;}if($nivel==8){$sec=8;}
if($nivel==9){$sec=9;}

$anioped=$_POST['anioped'];
require('../fpdf/fpdf.php');
require("../Conexion/Conexion.php");
//$secretaria=obtenerOfi($idsol);
$np=$_POST['nroped'];

$queryS="select * from secretarias a where a.sec='".$sec."';"; 

$queryCabecera="select  a.idpedidomateriales,a.nropedido,a.aniopedido,a.estado,a.totalped,a.totalletra, a.idsolicitante, a.destinomat,a.cuenta ,a.isubsecre,a.idg  
from pedidomateriales a where (a.isecre='".$sec."') and (a.nropedido='".$np."')and(a.aniopedido='".$anioped."');";
$queryDetalle="select b.cantidad,b.importedetalle,b.detallepedido,b.idpedido,b.idsol,b.idrubro,b.idsubr
 from detallepedidomateriales b where (b.idpedido='".$np."') and
(b.idsol='".$sec."');";

$conexion=Conectarse();

/////////////////traigo las dependencias
$conprov=mysqli_query($conexion,$queryS);
$fil=@mysqli_fetch_array($conprov);
$secretaria=$fil['detsec'];//mysqli_free_result($fil);
$conprov=mysqli_query($conexion,$queryCabecera);
$fil=@mysqli_fetch_array($conprov);
$destino=$fil['destinomat'];$totalletra=$fil['totalletra'];
$cuenta=$fil['cuenta'];$nump=$fil['nropedido'];$anp=$fil['aniopedido'];
$nroid=$fil['idpedidomateriales'];$isubsecre=$fil['isubsecre'];$idg=$fil['idg'];
$dni=$fil['idsolicitante'];
$querySS="select * from subsecretarias where isec='".$nivel."' and subsec='".$isubsecre."';";
$conprov=mysqli_query($conexion,$querySS);
$fil=@mysqli_fetch_array($conprov);
$ssecretaria=$fil['detsubsec'];$subs=$fil['subsec'];//mysqli_free_result($fil);
$queryDG="select * from dirgenerales where issec='".$subs."'  and dirgral='".$idg."';";
$conprov=mysqli_query($conexion,$queryDG);
$fil=@mysqli_fetch_array($conprov);
$dgral=$fil['dirdetalle'];//mysqli_free_result($fil);

$queryusuario="select * from usersistema where dni='".$dni."';";
$conprov=mysqli_query($conexion,$queryusuario);
$fil=@mysqli_fetch_array($conprov);
$apynom=$fil['apynom'];




class PDF extends FPDF
{
// Cabecera de página
function Header()
{
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
$pdf->Cell(25,7,'Oficina Solicitante ',1,'T','L');
$pdf->Cell(15,7,'Secretaria: ',1,'T','L');if ($nivel==1||$nivel==3||$nivel==4||$nivel==7) {
	$pdf->SetFont('Arial','B',9);}else{$pdf->SetFont('Arial','B',4);}
 $pdf->Cell(35,7,utf8_decode($secretaria),1,'T','L');$pdf->SetFont('Arial','B',7);
 $pdf->Cell(25,7,'Sub-Secretaria: ',1,'T','L');$pdf->SetFont('Arial','B',4);
$pdf->Cell(90,7,utf8_decode($ssecretaria),1,'T','C'); $pdf->Ln(7);$pdf->SetFont('Arial','B',7);
$pdf->Cell(25,7,'Dccion.Gral: ',1,'T','L');$pdf->SetFont('Arial','B',4);
$pdf->Cell(165,7,utf8_decode($dgral),1,'T','C');$pdf->Ln(7);$pdf->SetFont('Arial','B',7);
$pdf->Cell(35,5,'Destino de los Materiales:',1,'T','L');$pdf->SetFont('Arial','',4); 
$pdf->Cell(155,5,utf8_decode($destino),1,'T','C');$pdf->Ln(5);$pdf->SetFont('Arial','',7);
$pdf->Cell(35,5,'Cuenta Destino:',1,'T','L');$pdf->SetFont('Arial','',4); 
$pdf->Cell(155,5,utf8_decode($cuenta),1,'T','C');
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
//$fila=mysqli_fetch_array($conprov);
$conteo=1;$tmontof=0;$conteo2=1;
while($fila = mysqli_fetch_array($consulta)){
	$pdf->Cell(10,5,number_format($conteo2,0,",","."),0,'L','R');
	$pdf->Cell(10,5,number_format($fila['idrubro'],0,",","."),0,'T','C');
    $pdf->Cell(10,5,number_format($fila['idsubr'],0,",","."),0,'T','C');
	$pdf->Cell(15,5,number_format($fila['cantidad'],2,",","."),0,'T','C');
	$y = $pdf->GetY();
    $acotado =utf8_decode($fila['detallepedido']);
	$tamanio=strlen($acotado);
    $linea=$tamanio/90;
    if($linea<=1){
    	$linea=7;$conteo++;
    }else{$linea=$linea*7;$conteo=$conteo+($conteo+1);
    }
    $pdf->MultiCell(110,5,$acotado,0,'J'); $pdf->SetXY(155,$y);
	//$pdf->Cell(120,5,utf8_decode($fila['detallepedido']),1,'T','L');
    $pdf->Cell(35,5,chr(36).' '.number_format($fila['importedetalle'],2,",","."),0,'R','R');
    $pdf->Ln($linea);$conteo2++;
    $tmontof=$tmontof+$fila['importedetalle'];
	if($conteo>=90){
	$pdf->Cell(10,5,'Nro.',1,'T','C');
	$pdf->Cell(10,5,'Rubro',1,'T','C');
	$pdf->Cell(10,5,'Sub.Rub',1,'T','C');
	$pdf->Cell(15,5,'Cant.',1,'T','C');
	$pdf->Cell(110,5,'DESCRIPCION DE BIENES/SERVICIOS ',1,'T','C');
	$pdf->Cell(35,5,'IMPORTE-ESTIMADO $ ',1,'T','C');
    $pdf->Ln(5);$conteo=1;
}	
}
if($conteo<24){
	for($i=$conteo;$i<24;$i++){
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
$pdf->Cell(35,5,'Pedido de Secretaria Nro:',0,'T','C');
$pdf->Cell(10,5,$nump,0,'T','L');
$pdf->Cell(5,5,'-',0,'T','C');
$pdf->Cell(10,5,$anp,0,'T','C');
$pdf->Cell(25,5,'Cargado por:',0,'T','R');
$pdf->Cell(40,5,$apynom,0,'T','R');
$pdf->Cell(40,5,'Id-Aleatorio:',0,'T','C');$pdf->Cell(10,5,$nroid,0,'T','L');
$pdf->Ln(5);

 $pdf->Cell(190,5,'AUTORIZACIONES',1,'T','C');$pdf->Ln(5);
$pdf->Cell(70,5,'DIRECCION GRAL.',1,'T','C');
$pdf->Cell(60,5,'SUBSECRETARIA',1,'T','C');
$pdf->Cell(60,5,'SECRETARIA',1,'T','C');
 $pdf->Ln(5);

 $pdf->Cell(70,5,'',1,'T','C');
$pdf->Cell(60,5,'',1,'T','C');
$pdf->Cell(60,5,'',1,'T','C');
 $pdf->Ln(5);

 $pdf->Cell(190,5,'INTERVENCION DIRECCION GRAL DE ADMINISTRACION-CORRESPONDE',1,'T','C');$pdf->Ln(5);
$pdf->Cell(40,5,'COMPRA DIRECTA',1,'T','C');$pdf->Cell(30,5,'',1,'T','C');
$pdf->Cell(40,5,'CONCURSO PRECIO',1,'T','C');$pdf->Cell(20,5,'',1,'T','C');
$pdf->Cell(40,5,'LICITACION PRIVADA',1,'T','C');$pdf->Cell(20,5,'',1,'T','C');
 $pdf->Ln(5);
$pdf->Cell(100,5,'AUTORIZACION SECRETARIA DE ECONOMIA',1,'T','C');
$pdf->Cell(90,5,'',1,'T','C');




$pdf->Output('Formulario de Pedido de Materiales','I');

 
////////////////////


?>