<?php
//session_start();
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
include "../Conexion/Conexion.php";
$id = $_POST['nroprov']; 
$conexion=Conectarse();
//$queryC="SELECT a.nroproveedor,a.imprimio,b.razonsocial FROM acreenciasingestion a, usuarios b where (a.nroproveedor='".$id."') and(a.imprimio='NO') and(b.nroprov='".$id."') ORDER BY idacreenciasingestion ASC limit 1;";
$queryC="SELECT a.nroproveedor,a.imprimio,b.razonsocial FROM acreenciasingestion a, usuarios b where (a.nroproveedor='".$id."') and(b.nroprov='".$id."') ORDER BY idacreenciasingestion ASC limit 1;";
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
//include("../views/frmCambiaEstado.php");
header("Location: ../views/frmCambiaEstado.php");
mysqli_free_result($rs);
mysqli_close($conexion);


?>