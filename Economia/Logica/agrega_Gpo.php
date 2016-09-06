<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
//$id=0;
$id = $_POST['id'];
$proceso = $_POST['pro'];
$idgrupo= $_POST['idgrupo'];
$descrigpo =strtoupper($_POST['descrigpo']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO gruposcobros (id, idgrupo, descrigpo) 
		VALUES('".$id."','".$idgrupo."','".$descrigpo."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $id=$_POST['idf'];
	    $queryE="UPDATE gruposcobros 
	    SET idgrupo='".$idgrupo."', descrigpo='".$descrigpo."' WHERE id = '".$id."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM gruposcobros ORDER BY idgrupo ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			   <th width="100">id</th> 
          <th width="100">idgrupo</th>
          <th width="500">descrigpo</th>
          <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['id'].'</td>
				<td>'.$registro2['idgrupo'].'</td>
				<td>'.$registro2['descrigpo'].'</td>
				<td><a href="javascript:editarGpo('.$registro2['id'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarGpo('.$registro2['id'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
	}
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT id FROM gruposcobros ORDER BY id DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['id']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>