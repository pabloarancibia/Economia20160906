<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$idsec = $_POST['idsec'];
$proceso = $_POST['pro'];
$numsec= $_POST['numsec'];
$detsec =strtoupper($_POST['detsec']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO secretarias (idsec, sec, detsec) 
		VALUES('".$id."','".$numsec."','".$detsec."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idsec=$_POST['idf'];
	    $queryE="UPDATE secretarias 
	    SET sec='".$numsec."', detsec='".$detsec."' WHERE idsec = '".$idsec."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM secretarias ORDER BY sec ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="100">idsec</th> 
          <th width="100">sec</th>
          <th width="500">detsec</th>
          <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['idsec'].'</td>
				<td>'.$registro2['sec'].'</td>
				<td>'.$registro2['detsec'].'</td>
				<td><a href="javascript:editarSec('.$registro2['idsec'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarSec('.$registro2['idsec'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
	}
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idsec FROM secretarias ORDER BY idsec DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idsec']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>