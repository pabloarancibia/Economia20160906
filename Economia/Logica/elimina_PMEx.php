<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM detallepedidomateriales WHERE iddetallepm = '".$id."';";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM detallepedidomateriales ORDER BY idsol asc, idpedido asc;";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="100">iddetallepm</th> 
          <th width="100">cantidad</th>
          <th width="100">importedetalle</th>
          <th width="80">idrubro</th>
          <th width="80">idsubr</th>
          <th width="500">detallepedido</th>
          <th width="80">idpedido</th>
          <th width="80">idsol</th>
          <th width="20">Opcion</th>  </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
      echo '<tr>
              <td>'.$registro2['iddetallepm'].'</td>
                    <td>'.$registro2['cantidad'].'</td>
                    <td>'.$registro2['importedetalle'].'</td>
                    <td>'.$registro2['idrubro'].'</td>
                    <td>'.$registro2['idsubr'].'</td>
                    <td>'.$registro2['detallepedido'].'</td>
                    <td>'.$registro2['idpedido'].'</td>
                    <td>'.$registro2['idsol'].'</td>
                    <td><a href="javascript:editarPMEx('.$registro2['iddetallepm'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarPMEx('.$registro2['iddetallepm'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
            </tr>';       
            }
echo '</table>';
?>