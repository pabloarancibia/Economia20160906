<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$tt=$_POST['estado'];
$destino=$_POST['destino'];$fsal=$_POST['fecha'];
//VERIFICAMOS EL PROCESO

switch($tt){
	case 1:
	    $idme=$_POST['idf'];$estado="ATENDIDO";
	    $queryE="UPDATE mesaentrada 
	    SET estado='".$estado."', fecsalida='".$fsal."', destino='".$destino."' WHERE idme = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 2:
	    $idme=$_POST['idf'];$estado="AUTORIZADO";
	    $queryE="UPDATE mesaentrada 
	    SET estado='".$estado."', fecsalida='".$fsal."', destino='".$destino."' WHERE idme = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 3:
	    $idme=$_POST['idf'];$estado="REMITIDO A M.E.GRAL";
	    $queryE="UPDATE mesaentrada 
	    SET estado='".$estado."', fecsalida='".$fsal."', destino='".$destino."' WHERE idme = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 4:
	    $idme=$_POST['idf'];$estado="RECIBIDO DE M.E.GRAL";
	    $queryE="UPDATE mesaentrada 
	    SET estado='".$estado."', fecsalida='".$fsal."', destino='".$destino."' WHERE idme = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 5:
	    $idme=$_POST['idf'];$estado="VISTO FUNCIONARIO";
	    $queryE="UPDATE mesaentrada 
	    SET estado='".$estado."', fecsalida='".$fsal."', destino='".$destino."' WHERE idme = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 6:
	    $idme=$_POST['idf'];$estado="REMITIDO-COMPRAS";
	    $queryE="UPDATE mesaentrada 
	    SET estado='".$estado."', fecsalida='".$fsal."', destino='".$destino."' WHERE idme = '".$idme."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM mesaentrada ORDER BY idme desc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
          <th width="80">NUMERO</th> 
          <th width="80">AÑO</th>
          <th width="200">FUNCIONARIO</th>
          <th width="150">TRAMITE</th>
          <th width="500">DETALLE</th>
          <th width="80">ESTADO</th>
          <th width="80">FECHA SALIDA</th>
          <th width="150">DESTINO</th>
          <th width="20">Opcion</th>
         </tr>';
	    while($registro2 = mysqli_fetch_array($registro)){
                echo '<tr>
                        <td>'.$registro2['nrome'].'</td>
                        <td>'.$registro2['aniome'].'</td>
                        <td>'.$registro2['funcionario'].'</td>
                        <td>'.$registro2['tipotramite'].'</td>
                        <td>'.$registro2['detalle'].'</td>
                        <td>'.$registro2['estado'].'</td>
                        <td>'.$registro2['fecsalida'].'</td>
                        <td>'.$registro2['destino'].'</td>
                        <td><a href="javascript:editarME('.$registro2['idme'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> </td>
                    </tr>'; 			
	}
echo '</table>';
mysqli_close($conexion);




?>