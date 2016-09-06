<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM periodohoras WHERE id ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['id'],1 => $valores2['aniohs'],2 => $valores2['meshs'],3 => $valores2['descriper']);
echo json_encode($datos);
?>