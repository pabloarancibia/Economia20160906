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
$query = "UPDATE acreenciacompensacion set imprimio='".$estad."' where provcom='".$nroprov."';";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmCambiaEstadoCompensa.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
//actualizar nro de formulario
//actualInterv = "UPDATE nroform SET numero='" + nroform + "', anio='" + anio + "'"; 		
mysqli_close($conexion);
?>
<script>
alert('CAMBIO GRABADO CORRECTAMENTE');
window.location.href='../views/frmModiEstadoCompensa.php';
</script>	
<?php

?>