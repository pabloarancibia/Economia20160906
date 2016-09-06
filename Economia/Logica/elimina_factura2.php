<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$np=buscarProv($id);
//ELIMINAMOS EL PRODUCTO
$conexion=Conectarse();

$queryBaja="DELETE FROM acreenciacongestion WHERE idacreenciacongestion = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM acreenciacongestion where nroproveedor='".$np."' ORDER BY idacreenciacongestion ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
 //<th width="300">FECHA</th>
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			  <th width="80">PROV.</th>
               <th width="150">CARATULA</th> 
               <th width="150">EXPDTE</th>
               <th width="150">JUZGADO</th>
               <th width="150">MONTO $</th>
               <th width="150">CAUSA</th>
               <th width="150">PROF.(1)</th>
               <th width="150">PROF.(2)</th>
               <th width="120">HONOR.$</th>
               <th width="120">COSTAS $</th>
               <th width="150">TOTAL $</th>
               <th width="50">Opc.</th>
            </tr>';
$tmontof=0;$thono=0;$tcost=0;;$tmontot=0;		
	while($registro2 = mysqli_fetch_array($registro)){
		
		echo '<tr>
		        <td>'.$registro2['nroproveedor'].'</td>
		        <td>'.$registro2['caratula'].'</td>
		        <td>'.$registro2['expediente'].'</td>
		        <td>'.$registro2['juzgado'].'</td>
				<td>'.$registro2['monto'].'</td>
				<td>'.$registro2['causa'].'</td>
				<td>'.$registro2['profesional1'].'</td>
				<td>'.$registro2['profesional2'].'</td>
				<td>'.$registro2['honorarios'].'</td>
				<td>'.$registro2['costas'].'</td>
				<td>'.$registro2['totaldeuda'].'</td>
				<td><a href="javascript:editarFactura2('.$registro2['idacreenciacongestion'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarFactura2('.$registro2['idacreenciacongestion'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
				$tmontof=$tmontof+$registro2['monto'];
				$thono=$thono+$registro2['honorarios'];
				$tcost=$tcost+$registro2['costas'];
				$tmontot=$tmontot+$registro2['totaldeuda'];
				
	}echo '</table>';
echo '<table class="table table-striped table-condensed table-hover">
        	<tr> 
			<td><h4>DOCUMENTOS $:</h4></td><td align="center"><h4>'.$tmontof.'</h4></td>
          <td><h4>HONORARIOS $:</h4></td><td align="center"><h4>'.$thono.'</h4></td>
          <td><h4>COSTAS $:</h4></td><td align="center"><h4>'.$tcost.'</h4></td>
          <td><h4>TOTAL $:</h4></td><td align="center"><h4>'.$tmontot.'</h4></td>
			</tr>';

function buscarProv($id){
 $query2 = "SELECT nroproveedor FROM acreenciacongestion where idacreenciacongestion='".$id."'"; 
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