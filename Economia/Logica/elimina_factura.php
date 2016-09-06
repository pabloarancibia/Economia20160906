<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$np=buscarProv($id);
$conexion=Conectarse();

$queryBaja="DELETE FROM acreenciasingestion WHERE idacreenciasingestion = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM acreenciasingestion where nroproveedor='".$np."' ORDER BY idacreenciasingestion ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="200">PROVEEDOR</th>
                <th width="300">INTRUMENTO LEGAL</th>
                <th width="200">NUMERO O.C</th>
                <th width="150">TIPO FACTURA</th>
                <th width="500">NUMERO</th>
                <th width="150">IMPORTE $</th>
                <th width="150">PAGOS PARCIALES $</th>
                <th width="150">TOTAL DEUDA $</th>
                <th width="50">Opciones</th>
            </tr>';
$tmontof=0;$tpagp=0;$tmontot=0;		
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['nroproveedor'].'</td>
				<td>'.$registro2['intrumento'].'</td>
				<td>'.$registro2['ordencompra'].'</td>
				<td>'.$registro2['tipofactura'].'</td>
				<td>'.$registro2['nrofactura'].'</td>
				<td>'.$registro2['montofactura'].'</td>
				<td>'.$registro2['pagosparciales'].'</td>
				<td>'.$registro2['totaldeuda'].'</td>
				<td><a href="javascript:editarFactura('.$registro2['idacreenciasingestion'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarFactura('.$registro2['idacreenciasingestion'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
				$tmontof=$tmontof+$registro2['montofactura'];
				$tpagp=$tpagp+$registro2['pagosparciales'];
				$tmontot=$tmontot+$registro2['totaldeuda'];
				
	}
echo '</table>';
echo '<table class="table table-striped table-condensed table-hover">
        	<tr> 
			<td><h4>FACTURAS $:</h4></td><td align="center"><h4>'.$tmontof.'</h4></td>
			<td><h4>PAGOS PARCIALES $:</h4></td><td align="center"><h4>'.$tpagp.'</h4></td>
			<td><h4>DEUDA TOTAL $:</h4></td><td align="center"><h4>'.$tmontot.'</h4></td>
			</tr>';

function buscarProv($id){
 $query2 = "SELECT nroproveedor FROM acreenciasingestion where idacreenciasingestion='".$id."'"; 
 $conexion=Conectarse();$tot=0;
 $rs =mysqli_query($conexion,$query2);
 $tot=mysqli_num_rows($rs);
  if ($tot!=0) {
   $row=@mysqli_fetch_array($rs);
	$nro = $row['nroproveedor'];
		  }else{$nro=0;}
		mysqli_free_result($rs);	 mysqli_close($conexion);
	 return $nro;
 }



?>