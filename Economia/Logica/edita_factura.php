<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM acreenciasingestion WHERE idacreenciasingestion ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['nroproveedor'],	1 => $valores2['intrumento'], 
				2 => $valores2['ordencompra'], 	3 => $valores2['tipofactura'], 
				4 => $valores2['nrofactura'],
				5 => utf8_encode($valores2['montofactura']), 
				6 => utf8_encode($valores2['pagosparciales']),
				7 => utf8_encode($valores2['totaldeuda'])				
				);
echo json_encode($datos);
?>