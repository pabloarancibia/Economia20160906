<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM pedidomateriales WHERE idpedidomateriales ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['idpedidomateriales'],1 => $valores2['nropedido'], 
2 => $valores2['aniopedido'],3 => $valores2['fechapedido'],
4 => $valores2['estado'],5 => $valores2['totalped'],
6 => $valores2['totalletra'],7 => $valores2['idsolicitante']
,8 => $valores2['idpedido'], 
9 => $valores2['isecre'],10 => $valores2['isubsecre'],
11 => $valores2['idg'],12 => $valores2['destinomat'],
13 => $valores2['cuenta'],14 => $valores2['actuacion']);
echo json_encode($datos);
?>