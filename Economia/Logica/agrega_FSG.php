<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$montor=$_POST['montor'];
$pr=$_POST['pr'];$td=$_POST['td'];
$obs=strtoupper($_POST['obs']);
//VERIFICAMOS EL PROCESO
$idme=$_POST['idf'];
$queryE="UPDATE resumensg 
	    SET montoreclamado='".$montor."', pagosrecibidos='".$pr."', totaldeuda='".$td."', observaciones='".$obs."' WHERE idresumensg = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM resumensg ORDER BY anioform desc, nroform desc;";

$registro = mysqli_query($conexion,$queryC);
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
          <td><a href="javascript:editarFSG('.$registro2['idresumensg'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> </td>
                    </tr>'; 			
	}
echo '</table>';
mysqli_close($conexion);




?>