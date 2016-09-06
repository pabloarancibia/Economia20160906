<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM gestioncompra WHERE idgc = '".$id."';";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM ggestioncompra ORDER BY idgc asc;";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="50" style="font-family:verdana;font-size:60%;">idgc</th><th width="100" style="font-family:verdana;font-size:60%;">aleatorio</th>
          <th width="100" style="font-family:verdana;font-size:60%;">secretaria</th><th width="50" style="font-family:verdana;font-size:60%;">aniop</th>
          <th width="50" style="font-family:verdana;font-size:60%;">nrop</th><th width="100" style="font-family:verdana;font-size:60%;">estimado</th>
          <th width="50" style="font-family:verdana;font-size:60%;">pedmat</th><th width="50" style="font-family:verdana;font-size:60%;">aniooc</th>
          <th width="50" style="font-family:verdana;font-size:60%;">nrooc</th><th width="50" style="font-family:verdana;font-size:60%;">asignado</th><th width="50" style="font-family:verdana;font-size:60%;">fecoc</th><th width="50" style="font-family:verdana;font-size:60%;">proveedor</th><th width="50" style="font-family:verdana;font-size:60%;">actuacions</th>
          <th width="50" style="font-family:verdana;font-size:60%;">fecas</th><th width="50" style="font-family:verdana;font-size:60%;">nropv</th>
          <th width="50" style="font-family:verdana;font-size:60%;">Opciones</th>  </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
      echo '<tr style="font-family:Verdana;font-size:Small;">
                    <td>'.$registro2['idgc'].'</td>
                    <td>'.$registro2['aleatorio'].'</td>
                    <td>'.$registro2['secretaria'].'</td>
                    <td>'.$registro2['aniop'].'</td>
                    <td>'.$registro2['nrop'].'</td>
                    <td>'.$registro2['estimado'].'</td>
                    <td>'.$registro2['pedmat'].'</td>
                    <td>'.$registro2['aniooc'].'</td>
                    <td>'.$registro2['nrooc'].'</td>
                    <td>'.$registro2['asignado'].'</td>
                    <td>'.$registro2['fecoc'].'</td>
                    <td>'.$registro2['proveedor'].'</td>
                    <td>'.$registro2['actuacions'].'</td>
                    <td>'.$registro2['fecas'].'</td>
                    <td>'.$registro2['nropv'].'</td>
                    
                    <td><a href="javascript:editarPCMExGest('.$registro2['idgc'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarPCMExGest('.$registro2['idgc'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                    </tr>';             
            }
echo '</table>';
?>