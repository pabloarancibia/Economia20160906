<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM acreenciacompensacion WHERE idacompensa ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['provcom'],	1 => $valores2['sujetop'], 
				2 => $valores2['tributop'], 	3 => utf8_encode($valores2['importep']), 
				4 => $valores2['documento']);
echo json_encode($datos);
?>