<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$id=0;
$proceso = $_POST['pro'];
$aleatorio=$_POST['aleatorio'];$secretaria=$_POST['secretaria'];$aniop=$_POST['aniop'];$nrop=$_POST['nrop'];$estimado=$_POST['estimado'];
$pedmat=$_POST['pedmat'];$aniooc=$_POST['aniooc'];
$nrooc= $_POST['nrooc'];$asignado = $_POST['asignado'];
$fecoc=$_POST['fecoc'];$proveedor=strtoupper($_POST['proveedor']);
$actuacions=strtoupper($_POST['actuacions']);$fecas=$_POST['fecas'];
$nropv=$_POST['nropv'];

//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $idgc=buscarId();
	    $queryR="INSERT INTO gestioncompra(idgc, aleatorio, secretaria, aniop, nrop, estimado, pedmat, aniooc, nrooc, asignado, fecoc, proveedor, actuacions, fecas,nropv) 
     VALUES('".$idgc."','".$aleatorio."','".$secretaria."','".$aniop."','".$nrop."','".$estimado."','".$pedmat."','".$aniooc."','".$nrooc."','".$asignado."','".$fecoc."','".$proveedor."','".$actuacions."','".$fecas."','".$nropv."');";
        $rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	/*
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
	break;*/
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM gestioncompra ORDER BY idgc asc;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
      	<tr>
    	  <th width="50" style="font-family:verdana;font-size:60%;">idgc</th><th width="100" style="font-family:verdana;font-size:60%;">aleatorio</th>
          <th width="100" style="font-family:verdana;font-size:60%;">secretaria</th><th width="50" style="font-family:verdana;font-size:60%;">aniop</th>
          <th width="50" style="font-family:verdana;font-size:60%;">nrop</th><th width="100" style="font-family:verdana;font-size:60%;">estimado</th>
          <th width="50" style="font-family:verdana;font-size:60%;">pedmat</th><th width="50" style="font-family:verdana;font-size:60%;">aniooc</th>
          <th width="50" style="font-family:verdana;font-size:60%;">nrooc</th><th width="50" style="font-family:verdana;font-size:60%;">asignado</th><th width="50" style="font-family:verdana;font-size:60%;">fecoc</th><th width="50" style="font-family:verdana;font-size:60%;">proveedor</th><th width="50" style="font-family:verdana;font-size:60%;">actuacions</th>
          <th width="50" style="font-family:verdana;font-size:60%;">fecas</th><th width="50" style="font-family:verdana;font-size:60%;">nropv</th>
          <th width="50" style="font-family:verdana;font-size:60%;">Opciones</th>
        </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
       echo '<tr style="font-family:Verdana;font-size:Small;">
                    <td>'.$registro2['idgc'].'</td>
                    <td>'.$registro2['aleatorio'].'</td>
                    <td>'.$registro2['secretaria'].'</td>
                    <td>'.$registro2['aniop'].'</td>
                    <td>'.$registro2['nrop'].'</td>
                    <td>'.$registro2['estimado'].'</td>
                    <td>'.$registro2['pedmat'].'</td>
                    <td>'.$registro2['aniooc'].'</td>
                    <td>'.$registro2['nrooc'].'</td>
                    <td>'.$registro2['asignado'].'</td>
                    <td>'.$registro2['fecoc'].'</td>
                    <td>'.$registro2['proveedor'].'</td>
                    <td>'.$registro2['actuacions'].'</td>
                    <td>'.$registro2['fecas'].'</td>
                    <td>'.$registro2['nropv'].'</td>
                    
                    <td><a href="javascript:editarPCMExGest('.$registro2['idgc'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarPCMExGest('.$registro2['idgc'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                    </tr>';      
            }
echo '</table>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idgc FROM gestioncompra ORDER BY idgc DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$id = $row['idgc']+ 1;
		  }else{$id=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $id;
 }



?>