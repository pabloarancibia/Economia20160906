<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$rubro=strtoupper($_POST['rubro']);$periodopre=strtoupper($_POST['peri']);
$montor=$_POST['montor'];$ultfp=strtoupper($_POST['ufp']);
$estado=strtoupper($_POST['estado']);$opera=strtoupper($_POST['opera']);
$respuesta=strtoupper($_POST['fecha']);$observaciones=strtoupper($_POST['observa']);
$presenta=date('Y-m-d');
$idTurno=$_POST['idf'];
$queryE="UPDATE turnoeco SET rubro='".$rubro."', periodopre='".$periodopre."', montor='".$montor."', ultfp='".$ultfp."', estado='".$estado."', opera='".$opera."', respuesta='".$respuesta."', observaciones='".$observaciones."', presenta='".$presenta."'
WHERE idTurno = '".$idTurno."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM turnoeco where presenta='' order by fechaTurno asc, horaTurno asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
<tr>
<th width="80">FECHA</th> 
<th width="80">PROVEEDOR</th>
<th width="200">RAZON SOCIAL</th>
<th width="500">MOTIVO</th>
<th width="400">ESTADO</th>
<th width="20">Opcion</th>
</tr>';
  while($registro2 = mysqli_fetch_array($registro)){
   echo '<tr>
   <td>'.$registro2['fechaTurno'].'</td>
   <td>'.$registro2['nroprov'].'</td>
   <td>'.$registro2['razons'].'</td>
   <td>'.$registro2['motivor'].'</td>
   <td>'.$registro2['estado'].'</td>
   <td><a href="javascript:editarTA('.$registro2['idTurno'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> </td>
                    </tr>'; 			
	}
echo '</table>';
mysqli_close($conexion);




?>