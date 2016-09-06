<?php
include "../Conexion/Conexion.php";

$conexion=Conectarse();
$proveedor=$_POST['adminp'];
if($proveedor==987){
  header("Location: ../views/frmMenuJ.php");
}else{
$usuario = $_POST["admin"];   
$password = $_POST["password_usuario"];
$query="SELECT usuario,clave,nroprov,razonsocial,estado FROM usuarios WHERE nroprov = '".$proveedor."'";
$result =mysqli_query($conexion,$query); 

//Validamos el nombre del usuario en la base de datos 
if($row = mysqli_fetch_array($result))
{     
//Si el usuario es correcto ahora validamos su contraseña
 if($row["clave"] == md5($password)) // con clave cifrada
 //if($row["clave"] == $password) // con clave publica para prueba
  //if($password=="admin")
 {
 //Creamos sesión
  
session_start();  
  //Almacenamos el nombre de usuario en una variable de sesión usuario
  $_SESSION['usuario'] = $usuario;  
  $_SESSION['razonsocial']=$row["razonsocial"];
  $_SESSION['estado']=$row['estado'];
  $_SESSION['nroprov']=$row['nroprov'];
  //si es P debe cargar sus datos y no puede operar
  // cuando carga todo pasa a A
  //Redireccionamos a la pagina segun el nivel del usuario
/*switch($row["nivel"]){
	case "0":
	              header("Location:/Economia/views/frmMenu.php");
				  break;
	case "1":
	header("Location:");
				  break;
	case "2":
	header("Location:");
				  break;
	
} */ 
header("Location: ../views/frmMenu.php");
 
 } 
 else
 {
  //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
  ?>
   <script languaje="javascript">
    alert("Password Incorrecto");
    location.href = " ../views/frmLogin.php";
   </script>
  <?php
            
 }
}

else{//En caso que la user no exista enviamos un msj y redireccionamos a login.php
?>
   <script languaje="javascript">
    alert("Usuario Incorrecto");
    location.href = " ../views/frmLogin.php";
   </script>
  <?php
            
}
mysqli_free_result($result);
mysqli_close($conexion);
}
?>