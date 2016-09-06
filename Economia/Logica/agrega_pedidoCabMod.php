<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}

include "../Conexion/Conexion.php";
$conexion=Conectarse();
//$idpedidomateriales=buscarIDPM();//buscar el correlativo
$nropedido=$_SESSION['nropedido'];//buscarIDDPM($idsolicitante);//buscar el nro;
$idpedido=$nropedido;
$estado="CARGADO";
$actuacion=date("Y-m-d");
$idsolicitante=$_SESSION['secretaria'];
$totalped=buscarTP($nropedido,$idsolicitante);//traer el total;

$cta=$_POST['cuenta'];
if($cta==1){$cuenta="CAJA CHICA";}
if($cta==2){$cuenta="CUENTA GENERAL";}
if($cta==3){$cuenta="FDO.REPARACION MANTENIMIENTO Y CONTROL CALLES";}
if($cta==4){$cuenta="FDOS.DE TERCEROS Y OTROS EN GARANTIA";}
if($cta==5){$cuenta="FDOS.REPAROS EN GENERAL";}
if($cta==6){$cuenta="GAS.IND.UTIL.OF.PAR.MOTOC";}
if($cta==7){$cuenta="FDO.ESP.OBRAS INFRAESTRUCTURA";}
if($cta==8){$cuenta="LOTERIA CHAQUEÑA";}
if($cta==9){$cuenta="CUENTA ESPECIAL APORTE FINANCI";}
if($cta==10){$cuenta="PRESIDENCIA CONSEJO";}
if($cta==11){$cuenta="PRODISM";}
if($cta==12){$cuenta="PROGRAMA COMEDORES INFANTILES";}
if($cta==13){$cuenta="FONDO FEDERAL SOLIDARIO";}
if($cta==14){$cuenta="CTA.ESP.SUBASTA PUBLICA";}
if($cta==15){$cuenta="FONDO DE DESARROLLO LOCAL";}
if($cta==16){$cuenta="OTROS";}
//$idsecre=$_POST['secretaria'];// traer secretaria
$idsecre=$idsolicitante;
$idssecre=$_POST['subsecret'];//traer subsecretaria
$iddg=$_POST['dirgral'];//traer direccion general
$destmat=strtoupper($_POST['usomat']);//traer el destino
$totalletra=strtoupper($_POST['modtot']);//traer escrito
//GRABAR EL PEDIDO

$queryR="UPDATE pedidomateriales 
 set estado='".$estado."', totalped='".$totalped."', totalletra='".$totalletra."', isubsecre='".$idssecre."',
idg='".$iddg."', destinomat='".$destmat."',cuenta='".$cuenta."',actuacion='".$actuacion."' where idpedido='".$idpedido."' and isecre='".$idsecre."'
;";
$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
// aca va el redireccionamiento
?>
<script>
alert('PEDIDO DE MATERIALES CORREGIDO  CORRECTAMENTE');
window.location.href='../views/frmModificarPedMat.php';
</script>	
<?php

//--------------------------------------------------------------------
//id del pedido de materiales
 function buscarIDPM(){
	$query2 = "SELECT idpedidomateriales FROM pedidomateriales ORDER BY idpedidomateriales DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$idpedidomateriales = $row['idpedidomateriales']+ 1;
		  }else{$idpedidomateriales=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $idpedidomateriales;
 }

// id del detalle de pedido
 function buscarIDDPM($idsolicitante){
	$query2 = "SELECT idpedido FROM detallepedidomateriales where idsol='".$idsolicitante."' ORDER BY idpedido DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idpedido'];
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }
 
// totalizar el pedido
 function buscarTP($nropedido,$idsolicitante){
	$query2 = "SELECT sum(importedetalle) as total FROM detallepedidomateriales where idpedido='".$nropedido."'and idsol='".$idsolicitante."' ;"; 
	$conexion2=Conectarse();$tot=0.0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$totped = $row['total'];
		  }else{$totped=0;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $totped;
 } 



?>