<?php
session_start();
include "../Conexion/Conexion.php";
$respuesta = "";
$id=0;
include_once $_SERVER['DOCUMENT_ROOT'].'/Economia/securimage/securimage.php';
$securimage = new Securimage();
if($securimage->check($_POST['captcha_code'])== TRUE){
///// captcha correcto//////
$nroprov =$_POST['np'];$fechaactual = date("Y-m-d");
$razons =utf8_encode(strtoupper($_POST['rz']));
 $motivor = utf8_encode(strtoupper($_POST['motivo']));
 $observaciones=""; 
$query2 = "SELECT id FROM consueco ORDER BY id DESC LIMIT 1;"; 
$rs= mysqli_query($conexion,$query2);
if ($rs!=null) {
 $row=@mysqli_fetch_array($rs); 
 $id=$row['id']+1;
 mysqli_free_result($rs);
 } else {
   $id= 1;
     }
 $query = "INSERT INTO consueco (id, fechaconsu, nroprov, razons, observaciones,presenta,fechasaco) VALUES ('".$id."','".$fechaTurno."','".$horaTurno."','".$idTurnoNuevo."','".$nroprov."','".$razons."','".$rubro."','".$motivor."','".$periodopre."','".$montor."','".$ultfp."','".$estado."','".$opera."','".$respuesta."','".$observaciones."','".$presenta."','".$fechasaco."');";
    $rs=mysqli_query($conexion,$query)or die(include("../views/frmTurnoeco.php"));		
    $yasaco="";$flag=false;	
	$respuesta="Consulta Enviada Correctamente-Nos Contactaremos a la brvedad";
	include("../views/respuestaturnoeco.php");
	//mysql_free_result($rs);
	mysqli_close($conexion);		
    }
            
  
 
 }
 ////// captcha incorrecto///////////////
 else{
  $respuesta = "CODIGO DE SEGURIDAD INCORRECTO REINGRESE LOS DATOS";
  include("../views/frmConsueco.php"); 
  $flag=false;
  exit;
 }
 ?>