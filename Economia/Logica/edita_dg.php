<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO
$queryEdita="SELECT * FROM dirgenerales WHERE iddir ='".$id."'";
$valores = mysqli_query($conexion,$queryEdita);
$valores2 = mysqli_fetch_array($valores);
$datos = array( 0 => $valores2['iddir'],1 => $valores2['dirgral'], 
				2 => $valores2['dirdetalle'],3 => $valores2['issec']);
echo json_encode($datos);
?>