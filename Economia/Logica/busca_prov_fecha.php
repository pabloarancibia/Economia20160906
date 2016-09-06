<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$consu="select * from resumensg WHERE fechapresenta BETWEEN '$desde' AND '$hasta' ORDER BY totaldeuda desc;";
$registro = mysqli_query($conexion,$consu);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			  <th width="200">PROVEEDOR</th> 
			  <th width="300">RAZON SOCIAL</th>
			  <th width="200">PRESENTACION</th>
			  <th width="100">FORMULARIO</th>
			  <th width="100">AÑO</th>
			  <th width="200">RECLAMADO $</th>
			  <th width="200">PAGOS PARCIALES $</th>
			  <th width="300">TOTAL DEUDA $</th>
			  <!--th width="50">Opciones</th-->
			 </tr>';
if(mysqli_num_rows($registro)>0){
	$tmontof=0.00;$tpagp=0.00;$tmontot=0.00;$conteo=0;
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				  <td>'.$registro2['nroprov'].'</td>
				  <td>'.$registro2['razonsocial'].'</td>
				  <td>'.$registro2['fechapresenta'].'</td>
				  <td align=right>'.$registro2['nroform'].'</td>
				  <td align=right>'.$registro2['anioform'].'</td>
				  <td align=right>'.$registro2['montoreclamado'].'</td>
				  <td align=right>'.$registro2['pagosrecibidos'].'</td>
				  <td align=right>'.$registro2['totaldeuda'].'</td>
				  </tr>';
				  $conteo++;
      $tmontof=$tmontof+$registro2['montoreclamado'];$tpagp=$tpagp+$registro2['pagosrecibidos'];
    $tmontot=$tmontot+$registro2['totaldeuda'];
	}
	echo'
	<table class="table table-striped table-condensed table-hover">
   <tr>
    <td><h4>DOCUMENTOS $:</h4></td><td>'.$tmontof.'</td>
    <td><h4>PAGOS PARCIALES $:</h4></td><td>'.$tpagp.'</td>
    <td><h4>DEUDA TOTAL $:</h4></td><td>'.$tmontot.'</td>
   </tr>
  </table>';
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>