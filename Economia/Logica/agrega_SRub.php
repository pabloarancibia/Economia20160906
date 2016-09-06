<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$idsubrubro = $_POST['idsr'];
$proceso = $_POST['pro'];
$subrubro= $_POST['numsubr'];
$irubro= $_POST['numsr'];
$subrubdesc =strtoupper($_POST['detsr']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO subrubros (idsubrubro, subrubro, subrubdesc, irubro) 
		VALUES('".$id."','".$subrubro."','".$subrubdesc."','".$irubro."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idsubrubro=$_POST['idf'];
	    $queryE="UPDATE subrubros 
	    SET subrubro='".$subrubro."', subrubdesc='".$subrubdesc."', irubro='".$irubro."' WHERE idsubrubro = '".$idsubrubro."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM subrubros ORDER BY irubro asc, subrubro asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
      	<tr>
    	 <th width="100">idsubrubro</th> 
         <th width="100">subrubro</th>
         <th width="500">subrubdesc</th>
         <th width="100">irubro</th>
         <th width="20">Opcion</th>
        </tr>';
 while($registro2 = mysqli_fetch_array($registro)){
  echo '<tr>
         <td>'.$registro2['idsubrubro'].'</td>
         <td>'.$registro2['subrubro'].'</td>
         <td>'.$registro2['subrubdesc'].'</td>
         <td>'.$registro2['irubro'].'</td>
         <td><a href="javascript:editarSRub('.$registro2['idsubrubro'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
         <a href="javascript:eliminarSRub('.$registro2['idsubrubro'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
         </td>
        </tr>';       
      }
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idsubrubro FROM subrubros ORDER BY idsubrubro DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idsubrubro']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>