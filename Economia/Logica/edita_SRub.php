<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM subrubros WHERE idsubrubro ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['idsubrubro'],1 => $valores2['subrubro'], 
				2 => $valores2['subrubdesc'],3 => $valores2['irubro']);
echo json_encode($datos);
?>