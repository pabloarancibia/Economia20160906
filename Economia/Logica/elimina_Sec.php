<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM secretarias WHERE idsec = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM secretarias ORDER BY sec ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
       <tr>
		<th width="100">idsec</th> 
        <th width="100">sec</th>
        <th width="500">detsec</th>
        <th width="20">Opcion</th>
       </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['idsec'].'</td>
				<td>'.$registro2['sec'].'</td>
				<td>'.$registro2['detsec'].'</td>
				<td><a href="javascript:editarSec('.$registro2['idsec'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarSec('.$registro2['idsec'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
	}
echo '</table>';
?>