<?php
session_start();
include "../Conexion/Conexion.php";

$TURNOS_POR_DIA = 16;$idTurnoNuevo = 0;
$respuesta = "";$horaTurno = null;
$id=0;$idTurnoViejo = 0;$yasaco=0;$flag=false;
include_once $_SERVER['DOCUMENT_ROOT'].'/Economia/securimage/securimage.php';
$securimage = new Securimage();
if($securimage->check($_POST['captcha_code'])== TRUE){
///// captcha correcto//////
// fecha de turno y nro de proveedor para ver si o si ya saco
$fturno =$_POST['fturno'];$tmp=explode('/',$fturno);
if($tmp[0]<10){$fturno="0".$tmp[0]."/".$tmp[1]."/".$tmp[2];}
$tmp=explode('/',$fturno);
if($tmp[1]<10){$fturno=$tmp[0]."/0".$tmp[1]."/".$tmp[2];}

$nroprov =$_POST['np'];
// voy a verificar si no se vencio su turno todavia
$queryID = "SELECT * FROM turnoeco WHERE nroprov='".$nroprov."' ORDER BY idTurno DESC LIMIT 1";$conexion=Conectarse();
  $rs=mysqli_query($conexion,$queryID);
  $tot=mysqli_num_rows($rs);
  if($tot!=0){ 
    $row=@mysqli_fetch_array($rs); 
    $fechaTurno =$row['fechaTurno'];
    $pp=explode('/',$fechaTurno);$fechaTurno=$pp[2]."-".$pp[1]."-".$pp[0];
    $fechaactual = date("Y-m-d"); echo $fechaTurno; echo $fechaactual;
    if( $fechaactual < $fechaTurno) {
     // $flag=true;
       $respuesta = "TURNO PENDIENTE DE ATENCION ";
  include("../views/frmTurnoeco.php"); 
    }
   }
   else{ 
$query2 = "SELECT * FROM turnoeco ORDER BY idTurno DESC LIMIT 1"; 

 //////////////////////////////////////////////////////////////////
 ////   verifico si hay en esa fecha                        //////
 $query5="SELECT * FROM turnoeco WHERE fechaturno='".$fturno."'";
 
 $rs2=mysqli_query($conexion,$query5);
 if($rs2!=null){
  if(mysqli_num_rows($rs2)>0){
   while($row=mysqli_fetch_array($rs2)){
	 $yasaco=$row['nroprov'];
	 if($nroprov==$yasaco){
       $flag=true;
    $respuesta = "Ya saco TURNO ESTE DIA ";
  include("../views/frmTurnoeco.php"); 
  $flag=false;
     }
   }
  }
 mysqli_free_result($rs2);
}
////////////////////////////////////////////////////
////   no hay mas turnos o ya saco ese dia       ///
 $query = "SELECT * FROM turnoeco WHERE fechaturno='".$fturno."' ORDER BY turno DESC LIMIT 1";
$rs= mysqli_query($conexion,$query);
if ($rs!=null) {
 $row=@mysqli_fetch_array($rs); 
 $idTurnoViejo=$row['turno'];
 mysqli_free_result($rs);
 } else {
   $idTurnoNuevo = $idTurnoViejo + 1;
     }

if (($flag==true) || ($idTurnoViejo==$TURNOS_POR_DIA)){// mostrar un mensaje de que no hay mas turnos ese dia
  if($idTurnoViejo==$TURNOS_POR_DIA){
   $respuesta = "No hay mas turnos en la fecha solicitada";
	include("../views/frmTurnoeco.php");
	} else {
	$respuesta = "Ya saco TURNO ESTE DIA o aun no se vencio su turno Anterior";
	include("../views/frmTurnoeco.php"); 
	$flag=false;//mysqli_free_result($rs);
			}
} else {
    $razons =utf8_encode(strtoupper($_POST['rz']));
    $motivor = utf8_encode(strtoupper($_POST['motivo']));
    $fechaTurno = $fturno;
    $idTurnoNuevo = $idTurnoViejo + 1;
    $query = "SELECT * FROM horaturnoseco WHERE idHT='".$idTurnoNuevo."'";
	  $rs =mysqli_query($conexion,$query);	 
    $tot=mysqli_num_rows($rs);
    if ($tot!=0) {
	 $row=@mysqli_fetch_array($rs);
     $horaTurno =$row['HoraTurno'];
	 mysqli_free_result($rs);
    }
	 $rs =mysqli_query($conexion,$query2);
	$tot=mysqli_num_rows($rs);	 
    
    if ($tot!=0) {
      $row=@mysqli_fetch_array($rs);
      $id =$row['idTurno']+ 1;
	  mysqli_free_result($rs);
    }else{$id=1;}$respuesta="";
    $rubro="";$periodopre="";$montor=0;$ultfp="";$estado="";$opera="";
    $observaciones="";$presenta=""; $fechasaco = date("Y-m-d");       
    $query = "INSERT INTO turnoeco (idTurno, fechaTurno, horaTurno, turno, nroprov, razons, rubro, motivor, periodopre, montor,ultfp, estado,opera,respuesta,observaciones,presenta,fechasaco) VALUES ('".$id."','".$fechaTurno."','".$horaTurno."','".$idTurnoNuevo."','".$nroprov."','".$razons."','".$rubro."','".$motivor."','".$periodopre."','".$montor."','".$ultfp."','".$estado."','".$opera."','".$respuesta."','".$observaciones."','".$presenta."','".$fechasaco."');";
    $rs=mysqli_query($conexion,$query)or die(include("../views/frmTurnoeco.php"));		
    $yasaco="";$flag=false;	
	$respuesta="Turno Grabado Correctamente";
	include("../views/respuestaturnoeco.php");
	//mysql_free_result($rs);
	mysqli_close($conexion);		
    }
            
  
 }
 }
 ////// captcha incorrecto///////////////
 else{
  $respuesta = "CODIGO DE SEGURIDAD INCORRECTO REINGRESE LOS DATOS";
  include("../views/frmTurnoeco.php"); 
  $flag=false;
  exit;
 }
 ?>