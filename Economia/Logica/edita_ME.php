<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM mesaentrada WHERE idme ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['nrome'],	1 => $valores2['aniome'], 
				2 => $valores2['funcionario'], 	3 => $valores2['tipotramite'], 
				4 => $valores2['detalle'],
				5 => $valores2['estado'], 
				6 => $valores2['fecsalida'],
				7 => $valores2['destino']				
				);
echo json_encode($datos);
?>