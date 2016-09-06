<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
       $existe=FALSE;
        $nroprov=$_POST['nroprov'];$clu=$_POST['clu'];$usern=$_POST['usern'];$estado="P";
    	$conexion=Conectarse();
       $clave=md5($nroprov);
	    $queryU= "UPDATE usuarios SET usuario='".$usern."', clave='".$clave."',estado='".$estado."'  where nroprov='".$nroprov."';";
        $rs=mysqli_query($conexion,$queryU)or die(include("../views/frmAltaEx.php"));		
	   $query = "UPDATE acreedoreconomia SET usuario='".$usern."', clave='".$clave."'  where nroprov='".$nroprov."';";
        $rs=mysqli_query($conexion,$query)or die(include("../views/frmAltaEx.php"));		
		    $respuesta = "CARGA DE DATOS CORRECTA";
         //aca actualiza el estado P de usuarios 		
	     
        include("../views/frmAltaEx.php");
		 //$flag=false;
		 mysqli_close($conexion);
 
/////////////////////////////////////////
function buscarID(){
	$queryID = "SELECT idacreedoreconomia FROM acreedoreconomia ORDER BY idacreedoreconomia DESC LIMIT 1"; 
	$conexion=Conectarse();
	$rs =mysqli_query($conexion,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['idacreedoreconomia']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion);
	
}
?>