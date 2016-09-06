<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
include "../Conexion/Conexion.php";
//session_start();
//primero controlo si existe o no

$razonsocial=strtoupper($_POST['razonsocial']);
$precuit=$_POST['cuit1'];$ccuit=$_POST['cuit'];$postcuit=$_POST['cuit3'];
if($precuit==1){$pre="20";}if($precuit==2){$pre="23";}
if($precuit==3){$pre="24";}if($precuit==4){$pre="27";}
if($precuit==5){$pre="30";}if($precuit==6){$pre="33";}
if($postcuit==1){$pos="0";}if($postcuit==2){$pos="1";}
if($postcuit==3){$pos="2";}if($postcuit==4){$pos="3";}
if($postcuit==5){$pos="4";}if($postcuit==6){$pos="5";}
if($postcuit==7){$pos="6";}if($postcuit==8){$pos="7";}
if($postcuit==9){$pos="8";}if($postcuit==10){$pos="9";}
//$cuit=$pre."-".$ccuit."-".$pos;
$cuit=$ccuit;

$calle=strtoupper($_POST['calle']);$altura=$_POST['altura'];$piso=$_POST['piso'];$dpto=$_POST['dpto'];
//$domicilio="Calle: ".$calle." Altura: ".$altura." Piso: ".$piso." Dpto: ".$dpto;
$domicilio="C:".$calle."A:".$altura."P:".$piso."D:".$dpto;
$codActMuni=$_POST['cgoActividadMuni'];
$codActAtp=$_POST['cgoActividadAtp'];
//if isset variable de sesion o algo q indique q hizo click en agregar sucursal
////   y despues cuando cargue el pruebaResiduos tengo q verificar si existen las variables de session
////   de rs entonces las cargo en los txt correspondientes...
//true guardar datos de rs en variables de session
//false elimino lo q pueda haber en las variables session
//true:
//if ($_POST['botPress']=='otraSuc'){
//echo($_POST['botPress']);
$_SESSION['sRS']=$razonsocial;
$_SESSION['$sPrecuit']=$precuit;
$_SESSION['$sCuit']=$ccuit;
$_SESSION['$sPostcuit']=$postcuit;
$_SESSION['$sCalle']=$calle;
$_SESSION['$sAltura']=$altura;
$_SESSION['$sPiso']=$piso;
$_SESSION['$sDpto']=$dpto;
$_SESSION['$sCodActMuni']=$codActMuni;
$_SESSION['$sCodActAtp']=$codActAtp;
//
//echo($_SESSION['sRS']);
//
//}elseif ($_POST['botPress']=='guardar'){
//  echo($_POST['botPress']);
//limpio variables de session asi cuando devuelve la pagina no carga nada en los inputs rs
/*
$_SESSION['sRS']='';
$_SESSION['$sPrecuit']='';
$_SESSION['$sCuit']='';
$_SESSION['$sPostcuit']='';
$_SESSION['$sCalle']='';
$_SESSION['$sAltura']='';
$_SESSION['$sDpto']='';
$_SESSION['$sCodActMuni']='';
$_SESSION['$sCodActAtp']='';
*/
/*unset($_SESSION['sRS']);unset($_SESSION['$sPrecuit']);unset($_SESSION['$sCuit']);
unset($_SESSION['$sPostcuit']);unset($_SESSION['$sCalle']);unset($_SESSION['$sAltura']);
unset($_SESSION['$sPiso']);unset($_SESSION['$sDpto']);unset($_SESSION['$sCodActMuni']);
unset($_SESSION['$sCodActAtp']);*/
//}fin elseif
//sucursal
$calle1=strtoupper($_POST['calle1']);$altura1=$_POST['altura1'];$piso1=$_POST['Piso1'];$dpto1=$_POST['dpto1'];
//$domicilio1="Calle: ".$calle1." Altura: ".$altura1." Piso: ".$piso1." Dpto: ".$dpto1;
$domicilio1=$calle1."-".$altura1."-".$piso1."-".$dpto1;
$dimensiones=$_POST['dimensiones'];
$mtsLun=$_POST['mtsLun'];$mtsMar=$_POST['mtsMar'];$mtsMier=$_POST['mtsMier'];$mtsJuev=$_POST['mtsJuev'];
$mtsVier=$_POST['mtsVier'];$mtsSab=$_POST['mtsSab'];$mtsDom=$_POST['mtsDom'];
$kgLun=$_POST['kgLun'];$kgMar=$_POST['kgMar'];$kgMier=$_POST['kgMier'];$kgJuev=$_POST['kgJuev'];
$kgVier=$_POST['kgVier'];$kgSab=$_POST['kgSab'];$kgDom=$_POST['kgDom'];
$bolLun=$_POST['bolLun'];$bolMar=$_POST['bolMar'];$bolMier=$_POST['bolMier'];$bolJuev=$_POST['bolJuev'];
$bolVier=$_POST['bolVier'];$bolSab=$_POST['bolSab'];$bolDom=$_POST['bolDom'];
//
$cartones=$_POST['cartones'];$plasticos=$_POST['plasticos'];$organicos=$_POST['organicos'];
$tipoOtros=$_POST['tipoOtros'];$otros=$_POST['otros'];
$optDif=$_POST['optDif'];//6a5
//si optDif si
if(empty($_POST['optDifSi'])){//6a5 mtt
$optDifSi='00';
}else{$optDifSi=$_POST['optDifSi'];}
$difSiTercero=$_POST['DifSiTercero'];//6a5b1 txt
if(empty($_POST['freqDif'])){//6a5b2
  $freqDif='00';
}else{$freqDif=$_POST['freqDif'];}
if (empty($_POST['cubreDif'])) {
  $cubreDif='00';//6a5c
}else{$cubreDif=$_POST['cubreDif'];}
//si optDif no
if (empty($_POST['necDif'])){
$necDif='00';//6a51
}else{$necDif=$_POST['necDif'];}
if (empty($_POST['freqNecDif'])){
$freqNecDif='00';//6a51a
}else{$freqNecDif=$_POST['freqNecDif'];}
if(empty($_POST['depBasura'])){
  $depBasura='00';//6a6
}else {
  $depBasura=$_POST['depBasura'];
}
///si dep basura es oros
$txtOtros=$_POST['txtOtros'];//6a6 txt
//
if(empty($_POST['hrRec'])){
  $hrRec='00';//6a7
}else{$hrRec=$_POST['hrRec'];}
///SUCURSAL 2
///
$opinionRec=$_POST['opinionRec'];

//traigo los id
$idrz=buscarRZ();
$idsuc=buscarSU();
$iddsuc=buscarDSU();

$conexion=Conectarse();

$queryGuardarRS = "INSERT INTO razonsocial (id,razonsocial,cuit,domicilio,codActMuni,codActAtp)
VALUES ('".$idrz."','".$razonsocial."','".$cuit."','".$domicilio."','".$codActMuni."','".$codActAtp."')";

//compruebo si existe la rs -- num cuit
$idRz_query=mysqli_query($conexion,"SELECT id FROM razonsocial WHERE cuit = '".$cuit."'");//traigo el idRazonSocial para guardarlo en tabla sucursales
if (!$idRz_query->num_rows){
//guardo rs
mysqli_query($conexion,$queryGuardarRS) or die(include("../views/pruebaResiduos.php"));
}
//busco idrs (ya sea el q haya cuardado nuevo o el q ya estaba)
$idRz_query=mysqli_query($conexion,"SELECT id FROM razonsocial WHERE cuit = '".$cuit."'");//traigo el idRazonSocial para guardarlo en tabla sucursales
$idRz_array=mysqli_fetch_assoc($idRz_query);
//$idRz=$idRz_array['idRazonSocial'];
$idRz=$idRz_array['id'];
//query p/guardo suc
$queryGuardarSuc="INSERT INTO sucursales (idSucursal,idRazonSocial,domicilio,dimensiones)
VALUES('".$idsuc."','".$idRz."','".$domicilio1."','".$dimensiones."')";
//compruebo sino existe sucursal la guardo si existe no
$queryCompSuc=mysqli_query($conexion,"SELECT idSucursal FROM sucursales WHERE domicilio = '".$domicilio1."'
AND idRazonSocial = '".$idRz."'");
if (!$queryCompSuc->num_rows) {
  //guardo sucursal
  mysqli_query($conexion,$queryGuardarSuc) or die(include("../views/pruebaResiduos.php"));
}
//busco idSucursal (ya sea el q haya cuardado nuevo o el q ya estaba)
$idSuc_query=mysqli_query($conexion,"SELECT idSucursal FROM sucursales WHERE domicilio = '".$domicilio1."'
AND idRazonSocial = '".$idRz."'");//traigo el idRazonSocial para guardarlo en tabla datosResiduos
$idSuc_array=mysqli_fetch_assoc($idSuc_query);
$idSuc=$idSuc_array['idSucursal'];
//guardo los datos en la table residuos
$queryGuardarDatosResiduos="INSERT INTO datosresiduos
(idDatosResiduos,
mtsLun,
mtsMar,
mtsMierc,
mtsJuev,
mtsVier,
mtsSab,
mtsDom,
kgLun,
kgMar,
kgMier,
kgJuev,
kgVier,
kgSab,
kgDom,
bolsasLun,
bolsasMar,
bolsasMier,
bolsasJuev,
bolsasVier,
bolsasSab,
bolsasDom,
porCartonesPapeles,
porPlasticosVidrios,
porOrganicos,
tipoOtros,
porOtros,
optDifSiNo,
optDifTipo,
nombreSrvDifTercero,
freqDiferencial,
optCubreDif,
optNecDif,
optFreqNecDif,
optDepBasura,
depBasuraOtros,
optHrRec,
opinionRec,idSucursal
)VALUES('".$iddsuc."',
'".$mtsLun."',
'".$mtsMar."',
'".$mtsMier."',
'".$mtsJuev."',
'".$mtsVier."',
'".$mtsSab."',
'".$mtsDom."',
'".$kgLun."',
'".$kgMar."',
'".$kgMier."',
'".$kgJuev."',
'".$kgVier."',
'".$kgSab."',
'".$kgDom."',
'".$bolLun."',
'".$bolMar."',
'".$bolMier."',
'".$bolJuev."',
'".$bolVier."',
'".$bolSab."',
'".$bolDom."',
'".$cartones."',
'".$plasticos."',
'".$organicos."',
'".$tipoOtros."',
'".$otros."',
'".$optDif."',
'".$optDifSi."',
'".$difSiTercero."',
'".$freqDif."',
'".$cubreDif."',
'".$necDif."',
'".$freqNecDif."',
'".$depBasura."',
'".$txtOtros."',
'".$hrRec."',
'".$opinionRec."','".$idSuc."'
)";
//guardo datos residuos
if (!mysqli_query($conexion,$queryGuardarDatosResiduos))
  {
  $respuesta = "CARGA DE DATOS INCORRECTA";
  //echo("Error en la carga de datos...");// . mysqli_error($conexion));
}else {
  $respuesta = "CARGA DE DATOS CORRECTA";
}
include("../views/pruebaResiduos.php");
//mysqli_query($conexion,$queryGuardarDatosResiduos) or die("error");;
//cierro la conexion
mysqli_close($conexion);

///////////////////////////////////////////////
function buscarRZ(){
	$queryID = "SELECT id FROM razonsocial ORDER BY id DESC LIMIT 1"; 
	$conexion=Conectarse();
	$rs =mysqli_query($conexion,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['id']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion);
	
}

function buscarSU(){
	$queryID = "SELECT idSucursal FROM sucursales ORDER BY idsucursal DESC LIMIT 1"; 
	$conexion=Conectarse();
	$rs =mysqli_query($conexion,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['idSucursal']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion);
	
}
function buscarDSU(){
	$queryID = "SELECT idDatosResiduos FROM datosresiduos ORDER BY idDatosResiduos DESC LIMIT 1"; 
	$conexion=Conectarse();
	$rs =mysqli_query($conexion,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['idDatosResiduos']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion);
	
}

?>
