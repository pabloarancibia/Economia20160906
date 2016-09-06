<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM acreenciacongestion WHERE idacreenciacongestion ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['nroproveedor'],	
	            1 => $valores2['caratula'], 
				2 => $valores2['expediente'],
				3 => $valores2['juzgado'], 
				4 => utf8_encode($valores2['monto']),
				5 => $valores2['causa'], 
				6 => $valores2['profesional1'],
				7 => $valores2['profesional2'],
				8 => utf8_encode($valores2['honorarios']), 
				9 => utf8_encode($valores2['costas']),
				10 => utf8_encode($valores2['totaldeuda'])					
				);
echo json_encode($datos);
?>