<?php
include "../Conexion/Conexion.php";

$conexion=Conectarse();
$dni=$_POST['adminp'];
//$usuario = $_POST["admin"];   
$password = $_POST["password_usuario"];
$query="SELECT apynom,dni,clave,nivel,estado,secretaria FROM usersistema WHERE dni = '".$dni."' and estado='A'";
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
  $_SESSION['apynom'] = $row['apynom'];  
  $_SESSION['nivel']=$row["nivel"];
//  $_SESSION['estado']=$row['estado'];
  $_SESSION['dni']=$row['dni'];$_SESSION['secretaria']=$row['secretaria'];

header("Location: ../views/frmMenuUsuarios.php");
 
 } 
 else
 {
  //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
  ?>
   <script languaje="javascript">
    alert("Password Incorrecto");
    location.href = " ../views/frmLoginUs.php";
   </script>
  <?php
            
 }
}

else{//En caso que la user no exista enviamos un msj y redireccionamos a login.php
?>
   <script languaje="javascript">
    alert("Usuario Incorrecto");
    location.href = " ../views/frmLoginUs.php";
   </script>
  <?php
            
}
mysqli_free_result($result);
mysqli_close($conexion);
?>