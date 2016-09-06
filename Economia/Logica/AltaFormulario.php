<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
/*$anio=$_POST['anio'];$mes=$_POST['mes'];$dia=$_POST['dia'];
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
*/
$anio=2016; 
$fecrec=date("Y-m-d"); 
//$fecrec=$anio."-".$mes."-".$dia;
$nroprov=$_POST['nroprov'];
$razonsocial=strtoupper($_POST['razonsocial']);
$montor=$_POST['montor'];$pagosp=$_POST['pagosp'];
$totald=$_POST['totald'];$observa=$_POST['observa'];        
//buscar nro formulario
$nf=buscarNF();
//buscar nro resumensg
$nr=buscarNR();
//$idacreedoreconomia=buscarID();
$conexion=Conectarse();
$query = "INSERT INTO resumensg (
 idresumensg, nroform, anioform, nroprov, razonsocial, fechapresenta, montoreclamado, pagosrecibidos, totaldeuda, observaciones) VALUES
 ('".$nr."','".$nf."','".$anio."','".$nroprov."','".$razonsocial."','".$fecrec."','".$montor."','".$pagosp."','".$totald."','".$observa."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmGenerarFormulario.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
//actualizar nro de formulario
mysqli_close($conexion);
actualizarNF($nf);//actualizar el estado de las facturas
inhabilitarcomprobantes($nroprov);
?>
<script>
alert('FORMULARIO GRABADO CORRECTAMENTE-FACTURAS INHABILITADAS CORRECTAMENTE');
window.location.href='../views/frmGenerarFormulario.php';
</script> 
<?php
//header("Location: /Economia/views/frmGenerarFormulario.php?respuesta=$respuesta");
//include("../views/frmGenerarFormulario.php");
//$flag=false;

	

///////////////FUNCIONES//////////////////////////////
function buscarNF(){
   $nf=0;
   $queryNF="SELECT numero FROM nroform order by numero desc limit 1";
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
   $queryNR="SELECT idresumensg FROM resumensg order by idresumensg desc limit 1";
   $conexionnr=Conectarse();
   $rsnr=mysqli_query($conexionnr,$queryNR);
   $tot=mysqli_num_rows($rsnr);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnr);
        $id = $row['idresumensg']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnr);
   mysqli_close($conexionnr);
  

}         
///////////////////////////////////////////// 

function actualizarNF($nf){
 $n=$nf; 
 $queryAc="UPDATE nroform SET numero='".$n."';";
 $conexion2=Conectarse();
 $rs2=mysqli_query($conexion2,$queryAc);
 mysqli_close($conexion2);
}         
/////////////////////////////////////////////	
function inhabilitarcomprobantes($nroprov){
 $n=$nroprov;$estad="SI"; 
$query = "UPDATE acreenciasingestion set imprimio='".$estad."' where nroproveedor='".$n."';";
$conexion2=Conectarse();
$rs=mysqli_query($conexion2,$query);    
mysqli_close($conexion2);
}         
?>