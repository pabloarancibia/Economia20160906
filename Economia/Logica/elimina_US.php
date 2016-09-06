<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM usersistema WHERE idusersistema = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM usersistema ORDER BY idusersistema ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
       <tr>
		<th width="100">idusersistema</th> 
          <th width="100">apynom</th>
          <th width="100">dni</th>
          <th width="100">nivel</th> 
          <th width="100">estado</th>
          <th width="100">secretaria</th>
          <th width="20">Opcion</th>
       </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['idusersistema'].'</td>
                    <td>'.$registro2['apynom'].'</td>
                    <td>'.$registro2['dni'].'</td>
                    <td>'.$registro2['nivel'].'</td>
                    <td>'.$registro2['estado'].'</td>
                    <td>'.$registro2['secretaria'].'</td>
                    <td><a href="javascript:eliminarUS('.$registro2['idusersistema'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
				</tr>';
	}
echo '</table>';
?>