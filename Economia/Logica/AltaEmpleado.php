<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$nrocob=$_POST['nrocob'];$existe=FALSE;
// hay que sacar que existe xq en teoria 
//esta ya en la base de datos,controlar si no existe
$existe=buscarProv($nrocob);
//buscar el proveedor y el dni primero
if($existe==TRUE)
	{
 //$respuesta = "YA EXISTE ESTE EMPLEADO-VERIFIQUE ";
 //header ("Location: ../views/frmAltaEmpleado.php");
   
  ?>
<script>
alert('YA EXISTE ESTE EMPLEADO-VERIFIQUE');
window.location.href='../views/frmAltaEmpleado.php';
</script> 
<?php
  exit;
          }
  else { ///no existe el empleado
    $tdn=$_POST['tdn'];
    if($tdn==1){$tdni="DU"; }if($tdn==2){$tdni="LC"; }
    if($tdn==3){$tdni="LE"; }if($tdn==4){$tdni="PS"; }
    $dni=$_POST['nd'];
    $precuil=$_POST['pre-cuil'];$ccuil=$_POST['cuil'];$postcuil=$_POST['pos-cuil'];
    if($precuil==1){$pre="20";}if($precuil==2){$pre="23";}if($precuil==3){$pre="24";}if($precuil==4){$pre="27";}if($precuil==5){$pre="30";}if($precuil==6){$pre="33";}
    if($postcuil==1){$pos="0";}if($postcuil==2){$pos="1";}
    if($postcuil==3){$pos="2";}if($postcuil==4){$pos="3";}
    if($postcuil==5){$pos="4";}if($postcuil==6){$pos="5";}
    if($postcuil==7){$pos="6";}if($postcuil==8){$pos="7";}
    if($postcuil==9){$pos="8";}if($postcuil==10){$pos="9";}
    //$cuil=$pre."-".$ccuil."-".$pos;
    $cuil=$pre.$ccuil.$pos;
    $apellido=strtoupper($_POST['apel']);$nombre=strtoupper($_POST['nomb']);
    $direccion=strtoupper($_POST['domcalle']);
    $localidad=strtoupper($_POST['domlocal']);
    $provincia=strtoupper($_POST['domprovincia']);
    $telefono=$_POST['tel'];
    $dianac=$_POST['dianac'];$mn=$_POST['mesnac'];$mesnac=devuelveFecha($mn);$anionac=$_POST['anionac'];
    $fecnac=$anionac."-".$mesnac."-".$dianac;
    $diain=$_POST['diain'];$min=$_POST['mesin'];$mesin=devuelveFecha($min);$anioin=$_POST['anioin'];
    $fecing=$anioin."-".$mesin."-".$diain;
    $feceg="9999-12-31";
    $sex=$_POST['sexo'];if($sex==1){$sexo="M";}if($sex==2){$sexo="F";}
    $ec=$_POST['estadocivil'];
    if($ec==1){$estadocivil="SOLTERO/A";}if($ec==2){$estadocivil="CASADO/A";}if($ec==3){$estadocivil="VIUDO/A";}if($ec==4){$estadocivil="SEPARADO/A";}if($ec==5){$estadocivil="CONCUBINADO/A";}
    if($ec==6){$estadocivil="OTRO";}
    if($ec==7){$estadocivil="DIVORCIADO/A";}$estado="A";
    $catemp=$_POST['catego'];$grupo=$_POST['grupoco'];
    $secre=$_POST['secret'];$ssecre=$_POST['subsecret'];
    $dg=$_POST['dciogral'];
    $id=buscarID();
	 	$conexion=Conectarse();
	  $query = "INSERT INTO legajos (
	   id, legcobro, tdni, dni, cuil, apellido, nombre, direccion, localidad, provincia, telefono, fecnac, fecing, feceg, sexo, escivil, estado, catid, grupcob, nsec, nssec, ndg) VALUES
    	 ('".$id."','".$nrocob."','".$tdni."','".$dni."','".$cuil."','".$apellido."','".$nombre."','".$direccion."','".$localidad."','".$provincia."','".$telefono."','".$fecnac."','".$fecing."','".$feceg."','".$sexo."','".$estadocivil."','".$estado."','".$catemp."','".$grupo."','".$secre."','".$ssecre."','".$dg."');";
     $rs=mysqli_query($conexion,$query);		
		//$respuesta = "ALTA DE DATOS DE EMPLEADO CORRECTA";
    //header("Location: ../views/frmAltaEmpleado.php");
		 mysqli_close($conexion);?>
<script>
alert('ALTA DE DATOS DE EMPLEADO CORRECTA');
window.location.href='../views/frmAltaEmpleado.php';
</script> 
<?php
    	 }		

/////////////////////////////////////////////
function buscarProv($nrocob) {
 $respu = "";//$rs = null;
 $query = "SELECT legcobro FROM legajos where legcobro='".$nrocob."'";
 $conexion2=Conectarse();
 $rs =mysqli_query($conexion2,$query);
 $tot=mysqli_num_rows($rs);
 if ($tot!=0) {	$respu =TRUE;mysqli_free_result($rs);}
 else{$respu=FALSE;}
 return $respu;
		mysqli_free_result($rs);
		mysqli_close($conexion2);	
    }
/////////////////////////////////////////
function devuelveFecha($mes){
  switch($mes)
 {
  case "Enero": $mes = "01"; break;
  case "Febrero": $mes = "02"; break;
  case "Marzo": $mes = "03"; break;
  case "Abril": $mes = "04"; break;
  case "Mayo": $mes = "05"; break;
  case "Junio": $mes = "06"; break;
  case "Julio": $mes = "07"; break;
  case "Agosto": $mes = "08"; break;
  case "Septiembre": $mes = "09"; break;
  case "Octubre": $mes = "10"; break;
  case "Noviembre": $mes = "11"; break;
  case "Diciembre": $mes = "12"; break;     
 }
 return $mes;
} 
/////////////////////////////////////////
function buscarID(){
	$queryID = "SELECT id FROM legajos ORDER BY id DESC LIMIT 1"; 
	$conexion2=Conectarse();
	$rs =mysqli_query($conexion2,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['id']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion2);
	
}
?>