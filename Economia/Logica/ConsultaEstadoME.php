<?php
//session_start();
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
include "../Conexion/Conexion.php";
$id = $_POST['nroME']; $ame=$_POST['ame'];
$conexion=Conectarse();
$queryC="SELECT * FROM mesaentrada where nrome='".$id."') and(aniome='".$ame."') ORDER BY idacreenciasingestion ASC limit 1;";
$rs =mysqli_query($conexion,$queryC);
$tot=mysqli_num_rows($rs);
 if ($tot!=0) {
 	$row=@mysqli_fetch_array($rs);
 	$fen=$row['fecha'];$func=$row['funcionario'];$tt=$row['tipotramite'];$lt=$row['letra'];$det=$row['detalle'];
 
 }
$_SESSION["me"]=$id;$_SESSION["am"]=$ame;$_SESSION["fen"]=$fen;$_SESSION["func"]=$func;$_SESSION["tt"]=$tt;$_SESSION["lt"]=$lt;$_SESSION["det"]=$det;

//include("../views/frmCambiaEstado.php");
header("Location: ../views/frmCambiaME.php");
mysqli_free_result($rs);
mysqli_close($conexion);


?>