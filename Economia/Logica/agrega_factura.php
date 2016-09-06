<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$idacreenciasingestion=0;
$id = $_POST['bsprov']; $fechacarga=date("Y-m-d"); //$fechacarga=$_POST['fecrec'];
$proceso = $_POST['pro'];
$inst= $_POST['instrumento'];
if($inst==1){$instrumento="ORDEN DE COMPRA";}
if($inst==2){$instrumento="DISPOSICION";}
if($inst==3){$instrumento="RESOLUCION";}
if($inst==4){$instrumento="CONTRATOS";}
$orden = $_POST['orden'];
$tpo = $_POST['tipo'];
if($tpo==1){$tipo="NO";}if($tpo==2){$tipo="B";}if($tpo==3){$tipo="C";}
$numero = $_POST['nrof'];
$importe=$_POST['montof'];$importep=$_POST['montop'];
$importet=$_POST['totalf'];
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $idacreenciasingestion=buscarId();
		$queryR="INSERT INTO acreenciasingestion (idacreenciasingestion,intrumento, ordencompra, tipofactura, nrofactura, montofactura,pagosparciales,totaldeuda,nroproveedor,fechacarga,imprimio) 
		VALUES('".$idacreenciasingestion."','".$instrumento."','".$orden."','".$tipo."','".$numero."','".$importe."','".$importep."','".$importet."','".$id."','".$fechacarga."','NO');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idacreenciasingestion=$_POST['idf'];
	    $queryE="UPDATE acreenciasingestion 
	    SET intrumento='".$instrumento."', ordencompra='".$orden."', tipofactura='".$tipo."', nrofactura='".$numero."', montofactura='".$importe."',pagosparciales='".$importep."',totaldeuda='".$importet."',nroproveedor='".$id."',fechacarga='".$fechacarga."' WHERE idacreenciasingestion = '".$idacreenciasingestion."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM acreenciasingestion where (nroproveedor='".$id."') and(imprimio='NO') ORDER BY idacreenciasingestion ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="200">PROVEEDOR</th>
                <th width="300">INSTRUMENTO LEGAL</th>
                <th width="200">NUMERO O.C</th>
                <th width="150">TIPO DOCUMENTO</th>
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
			<td><h4>DOCUMENTOS $:</h4></td><td align="center"><h4>'.$tmontof.'</h4></td>
			<td><h4>PAGOS PARCIALES $:</h4></td><td align="center"><h4>'.$tpagp.'</h4></td>
			<td><h4>DEUDA TOTAL $:</h4></td><td align="center"><h4>'.$tmontot.'</h4></td>
			</tr>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idacreenciasingestion FROM acreenciasingestion ORDER BY idacreenciasingestion DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$idacreenciasingestion = $row['idacreenciasingestion']+ 1;
		  }else{$idacreenciasingestion=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $idacreenciasingestion;
 }



?>