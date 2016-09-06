<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id = $_POST['id'];
$conexion=Conectarse();

$queryBaja="DELETE FROM acreenciacongestion WHERE idcg = '".$id."'";
mysqli_query($conexion,$queryBaja);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$queryReload="SELECT * FROM acreenciacongestion ORDER BY idcg ASC";
$registro = mysqli_query($conexion,$queryReload);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
       <tr><th width="50">idcg</th> 
          <th width="50">dnidem</th>
          <th width="50">ayn</th>
          <th width="50">domreal</th> 
          <th width="50">domesp</th>
          <th width="50">estadocivil</th>
          <th width="50">conyuge</th> 
          <th width="50">caratula</th>
          <th width="50">expediente</th>
          <th width="50">juzgado</th> 
          <th width="50">causa</th>
          <th width="50">monto</th>
          <th width="50">costas</th> 
          <th width="50">totaldeuda</th>
          <th width="50">fechareclamo</th>
          <th width="50">imprimio</th> 
          <th width="50">fecsen</th>
          <th width="50">fojapi</th>
          <th width="50">fecapel</th> 
          <th width="50">fojapel</th>
          <th width="50">fecal</th>
          <th width="50">fojaalza</th> 
          <th width="50">fecrecu</th>
          <th width="50">fojarecu</th>
          <th width="50">estado</th> 
          <th width="50">art505</th>
          <th width="50">ley2868</th>
          <th width="50">fec4474</th> 
          <th width="50">fojaintima</th>
          <th width="50">privilegio</th>
          <th width="20">Opcion</th>
       </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr><td>'.$registro2['idcg'].'</td>
                    <td>'.$registro2['dnidem'].'</td>
                    <td>'.$registro2['ayn'].'</td>
                    <td>'.$registro2['domreal'].'</td>
                    <td>'.$registro2['domesp'].'</td>
                    <td>'.$registro2['estadocivil'].'</td>
                    <td>'.$registro2['conyuge'].'</td>
                    <td>'.$registro2['caratula'].'</td>
                    <td>'.$registro2['expediente'].'</td>
                    <td>'.$registro2['juzgado'].'</td>
                    <td>'.$registro2['causa'].'</td>
                    <td>'.$registro2['monto'].'</td>
                    <td>'.$registro2['costas'].'</td>
                    <td>'.$registro2['totaldeuda'].'</td>
                    <td>'.$registro2['fechareclamo'].'</td>
                    <td>'.$registro2['imprimio'].'</td>
                    <td>'.$registro2['fecsen'].'</td>
                    <td>'.$registro2['fojapi'].'</td>
                    <td>'.$registro2['fecapel'].'</td>
                    <td>'.$registro2['fojapel'].'</td>
                    <td>'.$registro2['fecalza'].'</td>
                    <td>'.$registro2['fojaalza'].'</td>
                    <td>'.$registro2['fecrecu'].'</td>
                    <td>'.$registro2['fojarecu'].'</td>
                    <td>'.$registro2['estado'].'</td>
                    <td>'.$registro2['art505'].'</td>
                    <td>'.$registro2['ley2868'].'</td>
                    <td>'.$registro2['fec4474'].'</td>
                    <td>'.$registro2['fojaintima'].'</td>
                    <td>'.$registro2['privilegio'].'</td>
                    <td><a href="javascript:eliminarDem('.$registro2['idcg'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
				</tr>';
	}
echo '</table>';
?>