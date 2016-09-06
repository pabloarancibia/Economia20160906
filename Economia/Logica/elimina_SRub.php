<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM subrubros WHERE idsubrubro = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM subrubros ORDER BY irubro asc, subrubro asc";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
     	<tr>
		  	<th width="100">idsubrubro</th> 
        <th width="100">subrubro</th>
        <th width="500">subrubdesc</th>
        <th width="100">irubro</th>
        <th width="20">Opcion</th>
        </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
      echo '<tr>
            <td>'.$registro2['idsubrubro'].'</td>
            <td>'.$registro2['subrubro'].'</td>
            <td>'.$registro2['subrubdesc'].'</td>
            <td>'.$registro2['irubro'].'</td>
            <td><a href="javascript:editarSRub('.$registro2['idsubrubro'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
            <a href="javascript:eliminarSRub('.$registro2['idsubrubro'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
            </tr>';       
            }
echo '</table>';
?>