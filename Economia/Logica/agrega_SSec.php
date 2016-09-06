<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$idsubsec = $_POST['idsubsec'];
$proceso = $_POST['pro'];
$numssec= $_POST['numsubsec'];
$numsec= $_POST['numsec'];
$detsubsec =strtoupper($_POST['detsubsec']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO subsecretarias (idsubsec, subsec, detsubsec, isec) 
		VALUES('".$id."','".$numssec."','".$detsubsec."','".$numsec."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idsubsec=$_POST['idf'];
	    $queryE="UPDATE subsecretarias 
	    SET subsec='".$numssec."', detsubsec='".$detsubsec."', isec='".$numsec."' WHERE idsubsec = '".$idsubsec."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM subsecretarias ORDER BY isec asc, subsec asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			 <th width="100">idsubsec</th> 
             <th width="100">subsec</th>
             <th width="500">detsubsec</th>
             <th width="100">isec</th>
             <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
        echo '<tr>
               <td>'.$registro2['idsubsec'].'</td>
               <td>'.$registro2['subsec'].'</td>
               <td>'.$registro2['detsubsec'].'</td>
               <td>'.$registro2['isec'].'</td>
               <td><a href="javascript:editarSSec('.$registro2['idsubsec'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
               <a href="javascript:eliminarSSec('.$registro2['idsubsec'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
               </td>
             </tr>';       
            }
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idsubsec FROM subsecretarias ORDER BY idsubsec DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idsubsec']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>