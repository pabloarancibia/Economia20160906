<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
//$id=0;
$id = $_POST['id'];
$proceso = $_POST['pro'];
$codcat= strtoupper($_POST['codcat']);
$descricat =strtoupper($_POST['descricat']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO categoriaempleados (id, codcat, descricat) 
		VALUES('".$id."','".$codcat."','".$descricat."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $id=$_POST['idf'];
	    $queryE="UPDATE categoriaempleados 
	    SET codcat='".$codcat."', descricat='".$descricat."' WHERE id = '".$id."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM categoriaempleados ORDER BY codcat ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			   <th width="100">id</th> 
          <th width="100">codcat</th>
          <th width="500">descricat</th>
          <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['id'].'</td>
                    <td>'.$registro2['codcat'].'</td>
                    <td>'.$registro2['descricat'].'</td>
                    <td><a href="javascript:editarCatEmp('.$registro2['id'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarCatEmp('.$registro2['id'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
				</tr>';
	}
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT id FROM categoriaempleados ORDER BY id DESC LIMIT 1"; 
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