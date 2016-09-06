<?php
 //    $dbh = mysql_connect("localhost", $user, $pass);
   // $db = mysql_select_db($bbdd);
	 include "../Conexion/Conexion.php";
    $conexion=Conectarse();
    $consulta = "SELECT * from subrubros WHERE idrubro = '".$_GET['id']."';";
    $query = mysqli_query($conexion,$consulta);
    while ($fila = mysqli_fetch_array($query)) {
        echo '<option value="'.$fila['subrubro'].'">'.$fila['subrubdesc'].'</option>';
    };
?>