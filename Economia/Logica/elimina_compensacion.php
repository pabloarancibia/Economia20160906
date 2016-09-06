<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$np=buscarProv($id);
$conexion=Conectarse();

$queryBaja="DELETE FROM acreenciacompensacion WHERE idacompensa = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM acreenciacompensacion where (provcom='".$np."') and (imprimio='NO') ORDER BY idacompensa ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="80">PROVEEDOR</th>
                <th width="150">SUJETO</th>
                <th width="150">TRIBUTO</th>
                <th width="150">IMPORTE $</th>
                <th width="150">DOCUMENTO</th>
                <th width="50">Opciones</th>
            </tr>';
$tmontof=0;$tcont=0;
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['provcom'].'</td>
				<td>'.$registro2['sujetop'].'</td>
				<td>'.$registro2['tributop'].'</td>
				<td>'.$registro2['importep'].'</td>
				<td>'.$registro2['documento'].'</td>
				<td><a href="javascript:editarCompensacion('.$registro2['idacompensa'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarCompensacion('.$registro2['idacompensa'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
				$tmontof=$tmontof+$registro2['importep'];$tcont++;
					}
echo '</table>';
echo '<table class="table table-striped table-condensed table-hover">
        	<tr> 
			<td><h4>CANTIDAD DE DOCUMENTOS:</h4></td><td align="center"><h4>'.$tcont.'</h4></td>
			<td><h4> TOTAL $:</h4></td><td align="center"><h4>'.$tmontof.'</h4></td>
			</tr>';

function buscarProv($id){
 $query2 = "SELECT provcom FROM acreenciacompensacion where idacompensa='".$id."'"; 
 $conexion=Conectarse();$tot=0;
 $rs =mysqli_query($conexion,$query2);
 $tot=mysqli_num_rows($rs);
  if ($tot!=0) {
   $row=@mysqli_fetch_array($rs);
	$nro = $row['provcom'];
		  }else{$nro=0;}
		mysqli_free_result($rs);	 mysqli_close($conexion);
	 return $nro;
 }



?>