<?php
session_start(); 
include "../Conexion/Conexion.php";
$sec=$_POST['secre'];
switch ($sec) {
  case '1':{$secretaria=1;}break;
  case '2':{$secretaria=2;}break;
  case '3':{$secretaria=3;}break;
  case '4':{$secretaria=4;}break;
  case '5':{$secretaria=5;}break;
  case '6':{$secretaria=6;}break;
  case '7':{$secretaria=7;}break;
  case '8':{$secretaria=8;}break;
  case '9':{$secretaria=9;}break;
   }
// aca busco el nro de pedido que sigue para esa secretaria
 $query2 = "Select nropedido, aniopedido from pedidomateriales where isecre='".$secretaria."' order by aniopedido desc, nropedido desc limit 1;"; 
 $conexion2=Conectarse();$tot=0;
 $rs =mysqli_query($conexion2,$query2);
 $tot=mysqli_num_rows($rs);
 if ($tot!=0) {
  $row=@mysqli_fetch_array($rs);
  $nropedido = $row['nropedido']+ 1;
  }else{$nropedido=1;}
  $aniopedido=$row['aniopedido'];
 mysqli_free_result($rs);   mysqli_close($conexion2);
   
 $_SESSION['nropedido']=$nropedido;
 $_SESSION['aniopedido']=$aniopedido;
 $_SESSION['secreped']=$secretaria;
 

header("Location: ../views/frmPedidosMaterialesCentral.php");

 
?>