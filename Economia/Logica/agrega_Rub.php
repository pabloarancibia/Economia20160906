<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$idrubro = $_POST['idr'];
$proceso = $_POST['pro'];
$rubro= $_POST['numr'];
$rubrodesc =strtoupper($_POST['detr']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO rubros (idrubro, rubro, rubrodesc) 
		VALUES('".$id."','".$rubro."','".$rubrodesc."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idrubro=$_POST['idf'];
	    $queryE="UPDATE rubros 
	    SET rubro='".$rubro."', rubrodesc='".$rubrodesc."' WHERE idrubro = '".$idrubro."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM rubros ORDER BY rubro ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
       <tr>
		<th width="100">idrubro</th> 
        <th width="100">rubro</th>
        <th width="500">rubrodesc</th>
        <th width="20">Opcion</th>
       </tr>';
 while($registro2 = mysqli_fetch_array($registro)){
 echo '<tr>
        <td>'.$registro2['idrubro'].'</td>
        <td>'.$registro2['rubro'].'</td>
        <td>'.$registro2['rubrodesc'].'</td>
        <td><a href="javascript:editarRub('.$registro2['idrubro'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
        <a href="javascript:eliminarRub('.$registro2['idrubro'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
        </td></tr>';
	}
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idrubro FROM rubros ORDER BY idrubro DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idrubro']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>