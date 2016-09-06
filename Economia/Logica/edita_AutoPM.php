<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM pedidomateriales WHERE idpedidomateriales='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['nropedido'],	1 => $valores2['aniopedido'], 
				2 => $valores2['destinomat'], 	3 => $valores2['totalped'], 
				4 => $valores2['estado']				
				);
echo json_encode($datos);
?>