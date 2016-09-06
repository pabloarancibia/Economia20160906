<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$dni=$_POST['dni'];$existe=FALSE;
$existe=buscarUser($dni);
//buscar el dni primero

  if($existe==FALSE)
	{
		 $respuesta = "NO EXISTE USUARIO-VERIFIQUE LOS DATOS INGRESADOS";
         include("../views/frmAltaUser2.php"); 
         // $flag=false;
         exit;
          }
  else { 
        $level=$_POST['nivel'];$sec1=$_POST['secre'];
        switch ($level) {
          case '0':
            {$nivel=0;}
            break;
          case '1':
            {$nivel=1;}
            break;
          case '2':
          case '3':
          case '4':
          case '5':
          case '6':
          case '7':
          case '8':
          case '9':
		  case '13':
            {$nivel=2;}
            break;
          case '10':
            {$nivel=10;}
            break;
          case '11':
            {$nivel=11;}
            break;
          case '12':
            {$nivel=12;} 
            break;
		 case '14':
            {$nivel=4;} 
            break;
		 case '15':
            {$nivel=5;} 
            break;
		 case '16':
            {$nivel=6;} 
            break;
          
            /* 
          case '99':
            {$nivel=99;$secretaria=0;}
            break;
            */
            }

          switch ($sec1) {
          case '0':
            {$secretaria=0;}
            break;
          case '1':
            {$secretaria=1;}
            break;
          case '2':
            {$secretaria=2;}
            break;
          case '3':
            {$secretaria=3;}
            break;
          case '4':
            {$secretaria=4;}
            break;
          case '5':
            {$secretaria=5;}
            break;
          case '6':
            {$secretaria=6;}
            break;
          case '7':
            {$secretaria=7;}
            break;
          case '8':
            {$secretaria=8;}
            break;
          case '9':
            {$secretaria=9;}
            break;
          case '10':
            {$secretaria=1;}
            break;
          case '11':
            {$secretaria=20;}
            break;  
           /* 
          case '99':
            {$nivel=99;$secretaria=0;}
            break;
            */
            }  
        $conexion=Conectarse();
	    $query = "UPDATE usersistema SET nivel='".$nivel."',secretaria='".$secretaria."' where dni='".$dni."';";
        $rs=mysqli_query($conexion,$query)or die(include("../views/frmAltaUser2.php"));		
		$respuesta = "MODIFICACION CORRECTA";
        include("../views/frmAltaUser2.php");
		 //$flag=false;
		 mysqli_close($conexion);
    	 }		

/////////////////////////////////////////////
function buscarUser($dni) {
        $respu = "";
        //$rs = null;
		$query = "SELECT dni FROM usersistema where dni='".$dni."'";
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