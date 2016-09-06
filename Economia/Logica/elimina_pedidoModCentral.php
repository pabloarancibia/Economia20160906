<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$idsol=$_SESSION['secreped'];$idpedido=$_SESSION['nropedido'];
$id = $_POST['id'];
//$np=buscarProv($id);
$conexion=Conectarse();

$queryBaja="DELETE FROM detallepedidomateriales WHERE iddetallepm = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM detallepedidomateriales where (idsol='".$idsol."') and (idpedido='".$idpedido."') ORDER BY iddetallepm ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="300" align="center">CANTIDAD</th>
               <th width="500" align="center">DESCRIPCION DE BIENES/SERVICIOS</th>
              <th width="150" align="center">IMPORTE ESTIMADO $</th>
              <th width="50" align="center">Opciones</th>
            </tr>';
$tmontot=0;		
	while($registro2 = mysqli_fetch_array($registro)){
	 echo '<tr>
	       <td>'.$registro2['cantidad'].'</td>
	       <td>'.$registro2['detallepedido'].'</td>
		   <td>'.$registro2['importedetalle'].'</td>
		   <td><a href="javascript:editarPedidoModCentral('.$registro2['iddetallepm'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarPedidoModCentral('.$registro2['iddetallepm'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
			</tr>';
				$tmontot=$tmontot+$registro2['importedetalle'];
				
	}
echo '</table>';
echo '<table class="table table-striped table-condensed table-hover">
        	<tr> 
			<td><h4>TOTAL $:</h4></td><td align="center"><h4>'.$tmontot.'</h4></td>
			</tr>';
mysqli_close($conexion);

///////////////////			
?>