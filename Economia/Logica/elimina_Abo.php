<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM honorabogados WHERE dnidem = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM honorabogados ORDER BY dnidem ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
       <tr><th width="50">idh</th> 
          <th width="50">tipo</th>
          <th width="50">aynabo</th>
          <th width="50">honorabo</th> 
          <th width="50">dnidem</th>
          <th width="20">Opcion</th>
       </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr><td>'.$registro2['idh'].'</td>
                    <td>'.$registro2['tipo'].'</td>
                    <td>'.$registro2['aynabo'].'</td>
                    <td>'.$registro2['honorabo'].'</td>
                    <td>'.$registro2['dnidem'].'</td>
                    <td><a href="javascript:eliminarAbo('.$registro2['dnidem'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
				</tr>';
	}
echo '</table>';
?>