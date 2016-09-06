<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM detallepedidomateriales WHERE iddetallepm ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['cantidad'],	1 => $valores2['idrubro'], 
				2 => $valores2['idsubr'], 	3 => $valores2['detallepedido'], 
				4 => utf8_encode($valores2['importedetalle'])				
				);
echo json_encode($datos);
?>