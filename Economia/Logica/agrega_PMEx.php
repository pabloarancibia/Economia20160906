<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$proceso = $_POST['pro'];
$iddetallepm = $_POST['idd'];
$cantidad= $_POST['ct'];
$importedetalle= $_POST['imp'];
$idrubro=$_POST['rub'];
$idsubr=$_POST['srub'];
$detallepedido =strtoupper($_POST['detp']);
$idpedido=$_POST['idped'];;
$idsol=$_POST['idsol'];;
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO detallepedidomateriales
		 (iddetallepm, cantidad, importedetalle, idrubro, idsubr, detallepedido,
		 	idpedido, idsol) 
		VALUES('".$id."','".$cantidad."','".$importedetalle."','".$idrubro."',
			'".$idsubr."','".$detallepedido."','".$idpedido."','".$idsol."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $iddetallepm=$_POST['idf'];
	    $queryE="UPDATE detallepedidomateriales 
	    SET cantidad='".$cantidad."', importedetalle='".$importedetalle."', idrubro='".$idrubro."',
        idsubr='".$idsubr."', detallepedido='".$detallepedido."', idpedido='".$idpedido."',
        idsol ='".$idsol."'
	     WHERE iddetallepm = '".$iddetallepm."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM detallepedidomateriales ORDER BY idsol asc, idpedido asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			  <th width="100">iddetallepm</th> 
	          <th width="100">cantidad</th>
	          <th width="100">importedetalle</th>
	          <th width="80">idrubro</th>
	          <th width="80">idsubr</th>
	          <th width="500">detallepedido</th>
	          <th width="80">idpedido</th>
	          <th width="80">idsol</th>
	          <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
        echo '<tr>
               <td>'.$registro2['iddetallepm'].'</td>
               <td>'.$registro2['cantidad'].'</td>
               <td>'.$registro2['importedetalle'].'</td>
               <td>'.$registro2['idrubro'].'</td>
               <td>'.$registro2['idsubr'].'</td>
               <td>'.$registro2['detallepedido'].'</td>
               <td>'.$registro2['idpedido'].'</td>
               <td>'.$registro2['idsol'].'</td>
               <td><a href="javascript:editarPMEx('.$registro2['iddetallepm'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
               <a href="javascript:eliminarPMEx('.$registro2['iddetallepm'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
               </td>
             </tr>';       
            }
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT iddetallepm FROM detallepedidomateriales ORDER BY iddetallepm DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['iddetallepm']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>