<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$np=buscarProv($id);
$conexion=Conectarse();

$queryBaja="DELETE FROM resumensg WHERE idresumensg = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM resumensg ORDER BY anioform desc, nroform desc;";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="80">AÑO</th> 
          <th width="80">FORMULARIO</th>
          <th width="200">NRO.PROVEEDOR</th>
          <th width="150">RAZON SOCIAL</th>
          <th width="500">MONTO RECLAMADO</th>
          <th width="80">PAGOS RECIBIDOS</th>
          <th width="80">TOTAL DEUDA</th>
          <th width="150">OBSERVACIONES</th>
          <th width="20">Opcion</th>
            </tr>';		
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		   <td>'.$registro2['anioform'].'</td>
          <td>'.$registro2['nroform'].'</td>
          <td>'.$registro2['nroprov'].'</td>
          <td>'.$registro2['razonsocial'].'</td>
          <td>'.$registro2['montoreclamado'].'</td>
          <td>'.$registro2['pagosrecibidos'].'</td>
				  <td>'.$registro2['totaldeuda'].'</td>
          <td>'.$registro2['observaciones'].'</td>
          <td><a href="javascript:editarFSG('.$registro2['idresumensg'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
           <a href="javascript:eliminarFSG('.$registro2['idresumensg'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a> </td>
				</tr>';
				
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