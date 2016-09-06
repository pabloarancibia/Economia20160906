<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$respuesta = ""; $queryID="";
$nroprov =$_POST['nroprov'];$rs=null;$tot=0;
$razons =""; $fechaTurno="";$horaTurno="";
$razons2 =""; $fechaTurno2="";$horaTurno2="";

if($nroprov==""){
	 $respuesta="DEBE COMPLETAR EL CAMPO NRO.PROVEEDOR";
	 include("../views/frmVerTurnoeco.php");
}
else{

  $queryID = "SELECT * FROM turnoeco WHERE nroprov='".$nroprov."' ORDER BY idTurno DESC LIMIT 1";
  $rs=mysqli_query($conexion,$queryID);
  $tot=mysqli_num_rows($rs);
  if($tot!=0){ 
    $dni=$nroprov;
	$row=@mysqli_fetch_array($rs); 
	$razons =$row['razons'];
	$fechaTurno =$row['fechaTurno'];
	$pp=explode('/',$fechaTurno);$fechaTurno=$pp[2]."-".$pp[1]."-".$pp[0];
	$horaTurno=$row['horaTurno'];
	$fechasaco=$row['fechasaco'];
	$fechaactual = date("Y-m-d");
	
	if( $fechaactual < $fechaTurno) 
	{
	 $respuesta = "ULTIMO TURNO SOLICITADO-.";	
	 include("../views/respuestaturnoeco.php");
		} else {
 	$respuesta = "ULTIMOS TURNOS SOLICITADOS-.";
	include("../views/respuestaturnoeco2.php");  }		
	
   }
   else{
	 $respuesta = "NO HA SOLICITADO TURNO PARA SU ATENCION";
	 include("../views/frmVerTurnoeco.php"); 
		}
			
  }
	mysqli_free_result($rs);	 mysqli_close($conexion);



?>

