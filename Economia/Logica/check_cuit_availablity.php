<?php
sleep(1);
include('../Conexion/Conexion.php');
$conexion=Conectarse();
if($_REQUEST)
{
	$cuit 	= $_REQUEST['cuit'];
	$query = "SELECT * FROM proveedores WHERE cuit = '$cuit'";
	$results = mysqli_query($conexion,$query) or die(mysql_error());

	if(mysqli_num_rows(@$results) > 0) // not available
	{
		echo '<div id="Error">El Cuit ya existe en nuestra Base de Datos</div>';
	}
	else
	{
		echo '<div id="Success">OK</div>';
	}

}?>
