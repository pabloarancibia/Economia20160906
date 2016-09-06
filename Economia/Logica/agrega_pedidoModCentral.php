<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}

include "../Conexion/Conexion.php";
$conexion=Conectarse();
$idsol=$_SESSION['secreped'];$iddetallepm=0;
$fechacarga=date("Y-m-d"); $proceso = $_POST['pro'];
$cantidad = $_POST['montof'];$bienes=$_POST['bienes'];
$rubro=$_POST['rubro'];$subr=$_POST['subrubro'];
$importet=$_POST['totalf'];$idpedido=$_POST['bsprov'];
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $iddetallepm=buscarId();
		$queryR="INSERT INTO detallepedidomateriales (iddetallepm, cantidad, importedetalle, idrubro, idsubr, detallepedido,idpedido,idsol) 
		VALUES('".$iddetallepm."','".$cantidad."','".$importet."','".$rubro."','".$subr."','".$bienes."','".$idpedido."','".$idsol."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $iddetallepm=$_POST['idf'];
	    $queryE="UPDATE detallepedidomateriales
	    SET cantidad='".$cantidad."', importedetalle='".$importet."', idrubro='".$rubro."', idsubr='".$subr."', detallepedido='".$bienes."',idpedido='".$idpedido."',idsol='".$idsol."' WHERE iddetallepm = '".$iddetallepm."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);

	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM detallepedidomateriales where (idpedido='".$idpedido."')and (idsol='".$idsol."')  ORDER BY iddetallepm ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
       <tr>
		<th width="100" align="center">CANTIDAD</th>
        <th width="500" align="center">DESCRIPCION DE BIENES/SERVICIOS</th>
        <th width="300" align="center">IMPORTE ESTIMADO $</th>
        <th width="50" align="center">Opciones</th>
        </tr>';
	$tmontot=0;		
	while($registro2 = mysqli_fetch_array($registro)){
	 echo '<tr>
	       <td>'.$registro2['cantidad'].'</td>
	       <td>'.$registro2['detallepedido'].'</td>
		   <td>'.$registro2['importedetalle'].'</td>
		   <td><a href="javascript:editarPedidoModCentral('.$registro2['iddetallepm'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarPedidoModCentral('.$registro2['iddetallepm'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
			</tr>';
				$tmontot=$tmontot+$registro2['importedetalle'];
				
	}
echo '</table>';
echo '<table class="table table-striped table-condensed table-hover">
        	<tr> 
			<td><h4>TOTAL $:</h4></td><td align="center"><h4>'.$tmontot.'</h4></td>
			</tr>';
mysqli_close($conexion);
//---------------------------------------------------------------------------------------------
 function buscarId(){
	$query2 = "SELECT iddetallepm FROM detallepedidomateriales ORDER BY iddetallepm DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$iddpm = $row['iddetallepm']+ 1;
		  }else{$iddpm=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $iddpm;
 }



?>