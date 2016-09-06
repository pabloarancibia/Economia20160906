<?php
//session_start();
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
include "../Conexion/Conexion.php";
$estad=$_POST['estad'];
switch($estad)
 {
  case "1": $estad = "NO"; break;
  case "2": $estad = "SI"; break;
 }
$nroprov=$_SESSION['np'];
$conexion=Conectarse();
$query = "UPDATE acreenciasingestion set imprimio='".$estad."' where nroproveedor='".$nroprov."';";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmCambiaEstado.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
//actualizar nro de formulario
//actualInterv = "UPDATE nroform SET numero='" + nroform + "', anio='" + anio + "'"; 		
mysqli_close($conexion);
?>
<script>
alert('CAMBIO GRABADO CORRECTAMENTE');
window.location.href='/Economia/views/frmModiEstadoFacturas.php';
</script>	
<?php
//header("Location: /Economia/views/frmGenerarFormulario.php?respuesta=$respuesta");
//include("../views/frmGenerarFormulario.php");
//$flag=false;

	

?>