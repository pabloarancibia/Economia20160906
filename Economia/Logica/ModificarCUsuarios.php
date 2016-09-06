<?php 
include "../Conexion/Conexion.php";
//$conexion=Conectarse();

$np=$_POST['nroprov'];$clave="";
$pass_old=$_POST['pass_old'];
$pass_new=$_POST['pass_new'];
$respuesta="";
$respu="";
$respu=consultaUsuario($np);

if($respu=='NO'){
      $respuesta="USUARIO NO EXISTE-VERIFICAR";
      include("../views/frmModiCUsuario.php");
}else{
	      $conexion=Conectarse();
	      $query="SELECT clave FROM usersistema WHERE dni = '".$np."'";
          $result =mysqli_query($conexion,$query); 
          if($row = mysqli_fetch_array($result)){
			  if($row["clave"] == md5($pass_old)){
			          $clave=md5($pass_new);	mysqli_free_result($result);
                      $query2="UPDATE usersistema set clave='".$clave."' where dni='".$np."'"; 
                      $result =mysqli_query($conexion,$query2);
                      include("../views/frmModiCUsuario.php"); 					 
					  
			  }else{
				  $respuesta="CLAVE ACTUAL ERRONEA";
				  include("../views/frmModiCUsuario.php");
				  
			  }
			  
		  }
           
		   
 
}



mysqli_close($conexion);


 function consultaUsuario($np) {
        $respu = "";
        $rs = null;
		$query = "SELECT dni FROM usersistema where dni='".$np."'";
		 $conexion=Conectarse();
       $rs =mysqli_query($conexion,$query);
	   $tot=mysqli_num_rows($rs);
        
        if ($tot!=0) {
         $respu = "SI";
         }else{
                $respu = "NO";
            }
        return $respu;
		mysqli_free_result($rs);
	mysqli_close($conexion);	
    }

?>
