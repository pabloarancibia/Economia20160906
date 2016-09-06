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
      $respuesta="PROVEEDOR NO EXISTE-VERIFICAR";
      include("../views/frmMenu.php");
}else{
	      $conexion=Conectarse();
	      $query="SELECT clave FROM usuarios WHERE nroprov = '".$np."'";
          $result =mysqli_query($conexion,$query); 
          if($row = mysqli_fetch_array($result)){
			  if($row["clave"] == md5($pass_old)){
			          $clave=md5($pass_new);	mysqli_free_result($result);
                      $query2="UPDATE usuarios set clave='".$clave."' where nroprov='".$np."'"; 
                      $result =mysqli_query($conexion,$query2);
                      $query3="UPDATE acreedoreconomia set clave='".$clave."' where nroprov='".$np."'";
					  $result =mysqli_query($conexion,$query3);
                   include("../views/frmModiProveedor.php"); 					 
					  
			  }else{
				  $respuesta="CLAVE ACTUAL ERRONEA";
				  include("../views/frmMenu.php");
				  
			  }
			  
		  }
           
		   
 
}



mysqli_close($conexion);


 function consultaUsuario($np) {
        $respu = "";
        $rs = null;
		$query = "SELECT nroprov FROM usuarios where nroprov='".$np."'";
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
