<?php
//session_start();
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
include "../Conexion/Conexion.php";
$id = $_POST['nroprov'];
$conexion=Conectarse();
$queryC="SELECT a.provcom,a.imprimio,b.razonsocial FROM acreenciacompensacion a, acreedoreconomia b where (a.provcom='".$id."') and(a.provcom=b.nroprov)
ORDER BY idacompensa ASC limit 1;";
$rs =mysqli_query($conexion,$queryC);
$tot=mysqli_num_rows($rs);
 if ($tot!=0) {
 	$row=@mysqli_fetch_array($rs);
 	$est=$row['imprimio'];
 	$rz=$row['razonsocial'];
 }
$_SESSION["est"]=$est;
$_SESSION["rz"]=$rz;
$_SESSION['np']=$id;

header("Location: ../views/frmCambiaEstadoCompensa.php");
mysqli_free_result($rs);
mysqli_close($conexion);

?>