<?php
//session_start();
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
include "../Conexion/Conexion.php";
$nrof=$_SESSION['nroform'];$anio=$_SESSION['anioform'];
$montoa=$_POST['montoa'];$ordenp=$_POST['ordenp'];$montoop=$_POST['montoop'];
$saldop=$_POST['saldop'];
$conexion=Conectarse();
$query = "update rescompensa set  montoautorizado='".$montoa."', ordenpago='".$ordenp."', montoop='".$montoop."', saldoprov='".$saldop."' where  (nroform='".$nrof."') and (anioform='".$anio."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmModiFormCompensa.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
mysqli_close($conexion);?>
<script>
alert('FORMULARIO GRABADO CORRECTAMENTE');
window.location.href='../views/frmModiFormCompensa.php';
</script>	
<?php
//header("Location: /Economia/views/frmGenerarFormulario.php?respuesta=$respuesta");
//include("../views/frmGenerarFormulario.php");
//$flag=false;

?>