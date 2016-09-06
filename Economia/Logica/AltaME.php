<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
 	$fen=date("Y-m-d");	
	$tt=$_POST['ttram'];
	if($tt==1){$tramite="PEDIDO CERTIFICACION";}if($tt==2){$tramite="PEDIDO MATERIALES";}
	if($tt==3){$tramite="PEDIDO LIQUIDACION";}if($tt==4){$tramite="PEDIDO DE AUDIENCIA";}
  if($tt==5){$tramite="ENVIO DOCUMENTOS";}
	$lt=$_POST['letra'];
	if($lt==1){$letra="P";}if($lt==2){$letra="M";}if($lt==3){$letra="R";}if($lt==4){$letra="C";}
	if($lt==5){$letra="S";}if($lt==6){$letra="SL";}
	$an=$_POST['aniot'];
	if($an==1){$anio="2016";}if($an==2){$anio="2015";}if($an==3){$anio="2014";}
	$detalle=strtoupper($_POST['detalle']);
	$sec=$_POST['sec'];
	if($sec==1){$funcionario="SEC.ECONOMIA";}if($sec==2){$funcionario="SUB.HACIENDA Y PRESUPUESTO";}
	if($sec==3){$funcionario="SUB.FINANZA E ING.PUBLICOS";}
  if($sec==4){$funcionario="COORDINACION TRIBUTARIA";}
	$est=$_POST['esta'];
	if($est==1){$esta="INGRESADO";}//if($est==2){$esta="ATENDIDO";}if($est==3){$esta="REMITIDO";}	
  $fsal="1900-01-01";$dest="";
//buscarID tramite
$ni=buscarNI();
//buscarNro tramite
$nt=buscarNT();
$conexion=Conectarse();
$query = "INSERT INTO mesaentrada (
 idme, fecha, nrome, aniome, funcionario, tipotramite, letra, detalle, estado, fecsalida, destino) VALUES
 ('".$ni."','".$fen."','".$nt."','".$anio."','".$funcionario."','".$tramite."','".$letra."','".$detalle."','".$esta."','".$fsal."','".$dest."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmAltaME.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
mysqli_close($conexion);
?>
<script>
alert('FORMULARIO GRABADO CORRECTAMENTE');
window.location.href='../views/frmAltaME.php';
</script>	
<?php
//header("Location: /Economia/views/frmAltaME.php");
//include("../views/frmGenerarFormulario.php");
//$flag=false;

	

///////////////FUNCIONES//////////////////////////////
///////////////////////////////////////////// 
function buscarNI(){
   $nf=0;
   $queryNF="SELECT idme FROM mesaentrada order by idme desc limit 1";
   $conexionnf=Conectarse();
   $rsnf=mysqli_query($conexionnf,$queryNF);
   $tot=mysqli_num_rows($rsnf);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnf);
        $id = $row['idme']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnf);
   mysqli_close($conexionnf);
  

}         

function buscarNT(){
   $nf=0;
   $queryNF="SELECT nrome FROM mesaentrada order by nrome desc limit 1";
   $conexionnf=Conectarse();
   $rsnf=mysqli_query($conexionnf,$queryNF);
   $tot=mysqli_num_rows($rsnf);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnf);
        $id = $row['nrome']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnf);
   mysqli_close($conexionnf);
  

}         
?>