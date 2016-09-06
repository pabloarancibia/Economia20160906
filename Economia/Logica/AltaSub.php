<?php
include "../Conexion/Conexion.php";
$dni=$_POST['dni'];
$clave=$_POST['clave'];
//$existe=FALSE;
//$existe=buscarUser($dni);
$conexion=Conectarse();
 $query = "UPDATE subrubros SET idrubro='".$clave."' where subrubro='".$dni."';";
        $rs=mysqli_query($conexion,$query)or die(include("../views/frmLoginUs.php"));		
		$respuesta = "MODIFICACION CORRECTA";
        include("../views/frmAltasubr.php");
		 //$flag=false;
		 mysqli_close($conexion);
    	 		

/////////////////////////////////////////////
function buscarUser($dni) {
        $respu = "";
        //$rs = null;
		$query = "SELECT subrubro FROM subrubros where subrubro='".$dni."'";
	   $conexion2=Conectarse();
       $rs =mysqli_query($conexion2,$query);
	   $tot=mysqli_num_rows($rs);
        if ($tot!=0) {
			$respu =TRUE;
			mysqli_free_result($rs);
         }else{$respu=FALSE;}
        return $respu;
		mysqli_free_result($rs);
		mysqli_close($conexion2);	
    }
 
?>