<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$anio=date("Y");
$fecrec=date("Y-m-d");
$dnidem=$_POST['dnidem'];
$ayn=strtoupper($_POST['ayn']);
$monto=$_POST['montor'];$honorarios=$_POST['hr'];
$costas=$_POST['cr'];$totald=$_POST['totald'];
$observa=strtoupper($_POST['observa']);
//buscar nro formulario
$nf=buscarNF();
//buscar nro resumensg
$nr=buscarNR();
//$idacreedoreconomia=buscarID();
$conexion=Conectarse();
$query = "INSERT INTO resumencg (
 idresumencg, nroform, anioform, nroprov, razonsocial, fechapresenta, monto, honorarios, costas, totaldeuda, observaciones) VALUES
 ('".$nr."','".$nf."','".$anio."','".$dnidem."','".$ayn."','".$fecrec."','".$monto."','".$honorarios."','".$costas."','".$totald."','".$observa."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmGenerarFormularioCG.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
//actualizar nro de formulario
mysqli_close($conexion);
actualizarNF($nf);
inhabilitarcomprobantes($dnidem);
?>
<script>
alert('FORMULARIO GRABADO CORRECTAMENTE');
window.location.href='../views/frmGenerarFormularioCG.php';
</script>	
<?php

///////////////FUNCIONES//////////////////////////////
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
//////////////////////////////////////////////////////
function buscarNF(){
   $nf=0;
   $queryNF="SELECT numero FROM nroformcg order by numero desc limit 1";
   $conexionnf=Conectarse();
   $rsnf=mysqli_query($conexionnf,$queryNF);
   $tot=mysqli_num_rows($rsnf);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnf);
        $id = $row['numero']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnf);
   mysqli_close($conexionnf);
  

}         
///////////////////////////////////////////// 
function buscarNR(){
   $nr=0;
   $queryNR="SELECT idresumencg FROM resumencg order by idresumencg desc limit 1";
   $conexionnr=Conectarse();
   $rsnr=mysqli_query($conexionnr,$queryNR);
   $tot=mysqli_num_rows($rsnr);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnr);
        $id = $row['idresumencg']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnr);
   mysqli_close($conexionnr);
  

}         
///////////////////////////////////////////// 

function actualizarNF($nf){
 $n=$nf; 
 $queryAc="UPDATE nroformcg SET numero='".$n."';";
 $conexion2=Conectarse();
 $rs2=mysqli_query($conexion2,$queryAc);
 mysqli_close($conexion2);
}         
/////////////////////////////////////////////	
function inhabilitarcomprobantes($dnidem){
 $n=$dnidem;$estad="SI"; 
$query = "UPDATE acreenciacongestion set imprimio='".$estad."' where dnidem='".$n."';";
$conexion2=Conectarse();
$rs=mysqli_query($conexion2,$query);    
mysqli_close($conexion2);
}         

?>