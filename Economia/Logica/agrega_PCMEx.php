<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$proceso = $_POST['pro'];
///////////////////////////////
$nropedido=$_POST['np'];$aniopedido=$_POST['ap'];
$fechapedido=$_POST['fp'];$estado=$_POST['ep'];
$totalped=$_POST['tp'];$totalletra=strtoupper($_POST['tl']);
$idsolicitante=$_POST['idsol'];$idpedido=$_POST['idp'];
$idsecre=$_POST['idsec'];$idssecre=$_POST['idssec'];
$iddg=$_POST['iddg'];$destmat=strtoupper($_POST['dm']);
$cuenta=$_POST['cd'];
$actuacion="";

//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $id=buscarId();
	    $queryR="INSERT INTO pedidomateriales (idpedidomateriales, nropedido, aniopedido, fechapedido, estado, totalped, totalletra, idsolicitante, idpedido, isecre, isubsecre, idg, destinomat,cuenta,actuacion) 
        VALUES('".$id."','".$nropedido."','".$aniopedido."','".$fechapedido."','".$estado."','".$totalped."','".$totalletra."','".$idsolicitante."','".$idpedido."','".$idsecre."','".$idssecre."','".$iddg."','".$destmat."','".$cuenta."','".$actuacion."');";
        $rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idpedidomateriales=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales set 
	    nropedido='".$nropedido."',aniopedido='".$aniopedido."',
        fechapedido='".$fechapedido."',estado='".$estado."',
        totalped='".$totalped."', totalletra='".$totalletra."', 
        idsolicitante='".$idsolicitante."',idpedido='".$idpedido."',
        isecre='".$idsecre."',isubsecre='".$idssecre."',idg='".$iddg."',
        destinomat='".$destmat."',
        cuenta='".$cuenta."',actuacion='".$actuacion."' 
        where idpedidomateriales='".$idpedidomateriales."' ;";
mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM pedidomateriales ORDER BY idsolicitante asc,aniopedido asc, nropedido asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
      	<tr><th width="30">sec</th>
    	  <th width="30">np</th><th width="30">ap</th>
          <th width="30">fped</th><th width="50">tp</th>
          <th width="80">tl</th><th width="100">dm</th>
          <th width="100">cta</th><th width="20">Opcion</th>
        </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
        echo '<tr style="font-family:Verdana;font-size:Small;">
          <td>'.$registro2['isecre'].'</td>
          <td>'.$registro2['nropedido'].'</td>
          <td>'.$registro2['aniopedido'].'</td>
          <td>'.$registro2['fechapedido'].'</td>
          <td>'.$registro2['totalped'].'</td>
          <td>'.$registro2['totalletra'].'</td>
          <td>'.$registro2['destinomat'].'</td>
          <td>'.$registro2['cuenta'].'</td>
          <td><a href="javascript:editarPCMEx('.$registro2['idpedidomateriales'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarPCMEx('.$registro2['idpedidomateriales'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                   </tr>';       
            }
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idpedidomateriales FROM pedidomateriales ORDER BY idpedidomateriales DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idpedidomateriales']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>