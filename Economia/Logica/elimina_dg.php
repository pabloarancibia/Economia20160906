<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM dirgenerales WHERE iddir = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM dirgenerales ORDER BY issec asc, dirgral asc";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="100">iddir</th> 
          <th width="100">dirgral</th>
          <th width="500">dirdetalle</th>
          <th width="100">issec</th>
          <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
      echo '<tr>
              <td>'.$registro2['iddir'].'</td>
              <td>'.$registro2['dirgral'].'</td>
              <td>'.$registro2['dirdetalle'].'</td>
              <td>'.$registro2['issec'].'</td>
              <td><a href="javascript:editarDg('.$registro2['iddir'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
              <a href="javascript:eliminarDg('.$registro2['iddir'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
              </td>
            </tr>';       
            }
echo '</table>';
?>