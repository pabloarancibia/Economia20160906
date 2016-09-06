<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
//select * from resumensg order by totaldeuda desc ;
$consu="select a.idpedidomateriales, a.isecre, a.aniopedido, a.nropedido, a.totalped, b.pedmat, b.aniooc, b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, b.fecas, b.nropv from pedidomateriales a, gestioncompra b where (a.idpedidomateriales ='".$dato."') and (a.idpedidomateriales=b.aleatorio) order by a.idpedidomateriales desc limit 15;  ";
$registro = mysqli_query($conexion,$consu);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
          <th width="100" style="font-family:verdana;font-size:60%;">ALEATORIO</th> 
          <th width="100" style="font-family:verdana;font-size:60%;">SECRETARIA</th>
          <th width="50" style="font-family:verdana;font-size:60%;">AÑO</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PEDIDO</th>
          <th width="100" style="font-family:verdana;font-size:60%;">ESTIMADO$</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PED.MAT</th>
          <th width="50" style="font-family:verdana;font-size:60%;">AÑO OC</th>
          <th width="50" style="font-family:verdana;font-size:60%;">NRO.O.C</th>
          <th width="50" style="font-family:verdana;font-size:60%;">MONTO ASIG.$</th>
          <th width="50" style="font-family:verdana;font-size:60%;">FECHA O.C</th>
          <th width="50" style="font-family:verdana;font-size:60%;">NRO.PROV.</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PROVEEDOR</th>
          <th width="50" style="font-family:verdana;font-size:60%;">ACT.SIMPLE</th>
          <th width="50" style="font-family:verdana;font-size:60%;">FECHA A.S</th>
          <th width="50" style="font-family:verdana;font-size:60%;">Opciones</th>
         </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
	 echo '<tr>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['idpedidomateriales'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['isecre'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['aniopedido'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['nropedido'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['totalped'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['pedmat'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['aniooc'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['nrooc'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['asignado'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['fecoc'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['nropv'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['proveedor'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['actuacions'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['fecas'].'</td>
         <td style="font-family:verdana;font-size:80%;">
         <a href="JavaScript:editarGC('.$registro2['idpedidomateriales'].')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a></td>
         </tr>';
				  
	}
	
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>