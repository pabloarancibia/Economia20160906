<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM pedidomateriales WHERE idpedidomateriales = '".$id."';";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM pedidomateriales ORDER BY idsolicitante asc,aniopedido asc, nropedido asc;";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="30">np</th><th width="30">ap</th>
          <th width="30">fped</th><th width="50">tp</th>
          <th width="80">tl</th><th width="100">dm</th>
          <th width="100">cta</th><th width="20">Opcion</th>  </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
      echo '<tr style="font-family:Verdana;font-size:Small;">
                    <td>'.$registro2['nropedido'].'</td>
                    <td>'.$registro2['aniopedido'].'</td>
                    <td>'.$registro2['fechapedido'].'</td>
                    <td>'.$registro2['totalped'].'</td>
                    <td>'.$registro2['totalletra'].'</td>
                    <td>'.$registro2['destinomat'].'</td>
                    <td>'.$registro2['cuenta'].'</td>
                    <td><a href="javascript:editarPCMEx('.$registro2['idpedidomateriales'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarPCMEx('.$registro2['idpedidomateriales'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                    </tr>';       
            }
echo '</table>';
?>