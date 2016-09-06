<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM subsecretarias WHERE idsubsec ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['idsubsec'],1 => $valores2['subsec'], 
				2 => $valores2['detsubsec'],3 => $valores2['isec']);
echo json_encode($datos);
?>