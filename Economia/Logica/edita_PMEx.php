<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM detallepedidomateriales WHERE iddetallepm ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['iddetallepm'],1 => $valores2['cantidad'], 
2 => $valores2['importedetalle'],3 => $valores2['idrubro'],
4 => $valores2['idsubr'],5 => $valores2['detallepedido'],
6 => $valores2['idpedido'],7 => $valores2['idsol']);
echo json_encode($datos);
?>