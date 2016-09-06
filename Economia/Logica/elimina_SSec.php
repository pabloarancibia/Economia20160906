<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM subsecretarias WHERE idsubsec = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM subsecretarias ORDER BY isec asc, subsec asc";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			 <th width="100">idsubsec</th> 
             <th width="100">subsec</th>
             <th width="500">detsubsec</th>
             <th width="100">isec</th>
             <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
        echo '<tr>
               <td>'.$registro2['idsubsec'].'</td>
               <td>'.$registro2['subsec'].'</td>
               <td>'.$registro2['detsubsec'].'</td>
               <td>'.$registro2['isec'].'</td>
               <td><a href="javascript:editarSSec('.$registro2['idsubsec'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
               <a href="javascript:eliminarSSec('.$registro2['idsubsec'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
               </td>
             </tr>';       
            }
echo '</table>';
?>