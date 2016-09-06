<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM periodohoras WHERE id = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM periodohoras ORDER BY aniohs desc, meshs desc;";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
       <tr><th width="100">id</th> 
          <th width="100">aniohs</th>
          <th width="100">meshs</th>
          <th width="100">descriper</th>
          <th width="20">Opcion</th>
       </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		       <td>'.$registro2['id'].'</td>
                   <td>'.$registro2['aniohs'].'</td>
                   <td>'.$registro2['meshs'].'</td>
                   <td>'.$registro2['descriper'].'</td>
                   <td><a href="javascript:editarPerHas('.$registro2['id'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                  <a href="javascript:eliminarPerHas('.$registro2['id'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
				</tr>';
	}
echo '</table>';
?>