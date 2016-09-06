<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$iddg = $_POST['iddg'];
$proceso = $_POST['pro'];
$numdg= $_POST['numdg'];
$numssec= $_POST['numssec'];
$detdg =strtoupper($_POST['detdg']);
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
		$queryR="INSERT INTO dirgenerales (iddir, dirgral, dirdetalle, issec) 
		VALUES('".$id."','".$numdg."','".$detdg."','".$numssec."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $iddg=$_POST['idf'];
	    $queryE="UPDATE dirgenerales 
	    SET dirgral='".$numdg."', dirdetalle='".$detdg."', issec='".$numssec."' WHERE iddir = '".$iddg."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM dirgenerales ORDER BY issec asc, dirgral asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			 <th width="100">iddir</th> 
             <th width="100">dirgral</th>
             <th width="500">dirdetalle</th>
             <th width="100">issec</th>
             <th width="20">Opcion</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
        echo '<tr>
               <td>'.$registro2['iddir'].'</td>
               <td>'.$registro2['dirgral'].'</td>
               <td>'.$registro2['dirdetalle'].'</td>
               <td>'.$registro2['issec'].'</td>
               <td><a href="javascript:editarDg('.$registro2['iddir'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
               <a href="javascript:eliminarDg('.$registro2['iddir'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
               </td>
             </tr>';       
            }
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT iddir FROM dirgenerales ORDER BY iddir DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['iddir']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>