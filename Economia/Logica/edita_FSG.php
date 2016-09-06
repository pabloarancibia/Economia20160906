<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM resumensg WHERE idresumensg ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['montoreclamado'],	1 => $valores2['pagosrecibidos'], 
				2 => $valores2['totaldeuda'], 	3 => $valores2['observaciones']);
echo json_encode($datos);
?>