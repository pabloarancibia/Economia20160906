<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM turnoeco WHERE idTurno ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['rubro'],	
	            1 => $valores2['periodopre'], 
				2 => $valores2['montor'], 	
				3 => $valores2['ultfp'], 
				4 => $valores2['estado'],
				5 => $valores2['opera'], 
				6 => $valores2['respuesta'],
				7 => $valores2['observaciones']				
				);
echo json_encode($datos);
?>