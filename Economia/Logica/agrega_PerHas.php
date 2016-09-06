<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
//$id=0;
$id = $_POST['id'];
$proceso = $_POST['pro'];
$aniohs= $_POST['aniohs'];
$me=$_POST['meshs'];$descriper="oo";
if($me==1){$meshs=1;$descriper="ENE-".$aniohs;}
if($me==2){$meshs=2;$descriper="FEB-".$aniohs;}
if($me==3){$meshs=3;$descriper="MAR-".$aniohs;}
if($me==4){$meshs=4;$descriper="ABR-".$aniohs;}
if($me==5){$meshs=5;$descriper="MAY-".$aniohs;}
if($me==6){$meshs=6;$descriper="JUN-".$aniohs;}
if($me==7){$meshs=7;$descriper="JUL-".$aniohs;}
if($me==8){$meshs=8;$descriper="AGO-".$aniohs;}
if($me==9){$meshs=9;$descriper="SEP-".$aniohs;}
if($me==10){$meshs=10;$descriper="OCT-".$aniohs;}
if($me==11){$meshs=11;$descriper="NOV-".$aniohs;}
if($me==12){$meshs=12;$descriper="DIC-".$aniohs;}

//$descriper =strtoupper($_POST['descriper']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO periodohoras (id, aniohs, meshs, descriper) 
		VALUES('".$id."','".$aniohs."','".$meshs."','".$descriper."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $id=$_POST['idf'];
	    $queryE="UPDATE periodohoras 
	    SET aniohs='".$aniohs."', meshs='".$meshs."', descriper='".$descriper."' WHERE id = '".$id."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM periodohoras ORDER BY aniohs desc, meshs desc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			   <th width="100">id</th> 
          <th width="100">aniohs</th>
          <th width="100">meshs</th>
          <th width="100">descriper</th>
          <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		          <td>'.$registro2['id'].'</td>
                   <td>'.$registro2['aniohs'].'</td>
                   <td>'.$registro2['meshs'].'</td>
                   <td>'.$registro2['descriper'].'</td>
                   <td><a href="javascript:editarPerHas('.$registro2['id'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                  <a href="javascript:eliminarPerHas('.$registro2['id'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
				</tr>';
	}
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT id FROM periodohoras ORDER BY id DESC LIMIT 1"; 
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