<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM rubros WHERE idrubro = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM rubros ORDER BY rubro ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
       <tr>
		<th width="100">idrubro</th> 
        <th width="100">rubro</th>
        <th width="500">rubrodesc</th>
        <th width="20">Opcion</th>
        </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
	 echo '<tr>
	        <td>'.$registro2['idrubro'].'</td>
            <td>'.$registro2['rubro'].'</td>
            <td>'.$registro2['rubrodesc'].'</td>
            <td><a href="javascript:editarRub('.$registro2['idrubro'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
            <a href="javascript:eliminarRub('.$registro2['idrubro'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
            </td></tr>';
	}
echo '</table>';
?>