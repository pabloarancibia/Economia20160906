<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM gestioncompra WHERE idgc ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['idgc'],1 => $valores2['aleatorio'], 
2 => $valores2['secretaria'],3 => $valores2['aniop'],
4 => $valores2['nrop'],5 => $valores2['estimado'],
6 => $valores2['pedmat'],7 => $valores2['aniooc']
,8 => $valores2['nrooc'], 
9 => $valores2['asignado'],10 => $valores2['fecoc'],
11 => $valores2['proveedor'],12 => $valores2['actuacions'],
13 => $valores2['fecas'],14 => $valores2['nropv']);
echo json_encode($datos);
?>