<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$anio=$_POST['anio'];$mes=$_POST['mes'];$dia=$_POST['dia'];
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
$fecrec=$anio."-".$mes."-".$dia;
//$fecrec=date("Y-m-d");
$nroprov=$_POST['nroprov'];
$razonsocial=strtoupper($_POST['razonsocial']);
$montor=$_POST['montor'];$montoa=$_POST['montoa'];
$ordenp=$_POST['ordenp'];$montoop=$_POST['montoop'];
$saldop=$_POST['saldop'];
//buscar nro formulario de compensacion
$nf=buscarNF();
//buscar nro resumen de compensacion
$nr=buscarNR();
//$idacreedoreconomia=buscarID();
$conexion=Conectarse();
$query = "INSERT INTO rescompensa (
 idres, nroform, anioform, nroprov, razonsocial, fechapresenta, montoreclamado, montoautorizado, ordenpago, montoop, saldoprov) VALUES
 ('".$nr."','".$nf."','".$anio."','".$nroprov."','".$razonsocial."','".$fecrec."','".$montor."','".$montoa."','".$ordenp."','".$montoop."','".$saldop."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmGenerarFormulario.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
//actualizar nro de formulario
mysqli_close($conexion);
actualizarNF($nf);?>
<script>
alert('FORMULARIO GRABADO CORRECTAMENTE');
window.location.href='../views/frmGenFormCompensa.php';
</script>	
<?php
//header("Location: /Economia/views/frmGenerarFormulario.php?respuesta=$respuesta");
//include("../views/frmGenerarFormulario.php");
//$flag=false;

	

///////////////FUNCIONES//////////////////////////////
function buscarNF(){
   $nf=0;
   $queryNF="SELECT numero FROM nroformcompensa order by numero desc limit 1";
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
   $queryNR="SELECT idres FROM rescompensa order by idres desc limit 1";
   $conexionnr=Conectarse();
   $rsnr=mysqli_query($conexionnr,$queryNR);
   $tot=mysqli_num_rows($rsnr);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnr);
        $id = $row['idres']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnr);
   mysqli_close($conexionnr);
  

}         
///////////////////////////////////////////// 

function actualizarNF($nf){
 $n=$nf; 
 $queryAc="UPDATE nroformcompensa SET numero='".$n."';";
 //despues se puede agregar actualizar el año
 $conexion2=Conectarse();
 $rs2=mysqli_query($conexion2,$queryAc);
 mysqli_close($conexion2);
}         
/////////////////////////////////////////////	
?>