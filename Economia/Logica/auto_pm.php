<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

include "../Conexion/Conexion.php";
$conexion=Conectarse();
$idsol=$_SESSION['secretaria'];
$tt=$_POST['estad'];
$nivel=$_SESSION['nivel'];
$actuacion=date("Y-m-d");
//VERIFICAMOS EL PROCESO
switch($tt){
	case 1:
	    if($nivel==11){$estado="VISADO";}
		if($nivel==5){$estado="INGRESADO";}
		if($nivel==12||$nivel==6||$nivel==10){$estado="AUTORIZADO";}
	    if($nivel==99){$estado="VISADO";}
		$idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."', actuacion='".$actuacion."'  WHERE idpedidomateriales = '".$idpm."'  ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 2:
	    if($nivel==12||$nivel==6||$nivel==10)
	     {$estado="CARGADO";}//else{$estado="CARGADO";}
	    if($nivel==99){$estado="INGRESADO";}
	    $idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."', actuacion='".$actuacion."'  WHERE idpedidomateriales = '".$idpm."' ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 3:
	if($nivel==99){$estado="AUTORIZADO";}
		$idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."' , actuacion='".$actuacion."'  WHERE idpedidomateriales = '".$idpm."' ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 4:
	if($nivel==99){$estado="CARGADO";}
		$idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."' , actuacion='".$actuacion."' WHERE idpedidomateriales = '".$idpm."' ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
if($nivel==11){
$estado="CARGADO";	
$queryC="SELECT * FROM pedidomateriales  where idsolicitante='".$idsol."' and  estado like'%".$estado."%''  ORDER BY idpedidomateriales desc;";}
if($nivel==5){
$estado="VISADO";
$queryC="SELECT * FROM pedidomateriales  where estado like '%".$estado."%'  ORDER BY idpedidomateriales desc;";}
if(($nivel==12)||($nivel==6)||($nivel==10)){
$estado="INGRESADO";	
$queryC="SELECT * FROM pedidomateriales  where estado like'%".$estado."%' ORDER BY idpedidomateriales desc;";}
if($nivel==99){
$queryC="SELECT * FROM pedidomateriales  ORDER BY idpedidomateriales desc;";	
}
$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
           <tr>
		    <th width="80" align="center">NRO.</th> 
            <th width="80" align="center">AÑO</th>
            <th width="500" align="center">DESCRIPCION DE BIENES/SERVICIOS</th>
            <th width="90" align="center">IMPORTE ESTIMADO $</th>
		    <th width="90" align="center">ESTADO</th>
		    <th width="50" align="center">Opciones</th>
         </tr>';
	    while($registro2 = mysqli_fetch_array($registro)){
                echo '<tr>
                        <td>'.$registro2['nropedido'].'</td>
                        <td>'.$registro2['aniopedido'].'</td>
                        <td>'.$registro2['destinomat'].'</td>
                        <td>'.$registro2['totalped'].'</td>
                        <td>'.$registro2['estado'].'</td>
                        <td><a href="javascript:editarAuPM('.$registro2['idpedidomateriales'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> </td>
                    </tr>'; 			
	}
echo '</table>';
mysqli_close($conexion);



/*
case 1:
	    if($idsol>1 and $idsol<10){
		$estado="VISADO";	
		}
		if($idsol==1)
		{$estado="INGRESADO";}
	    if($idsol==0 and $nivel==99){$estado="VISADO";}
		$idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."'  WHERE idpedidomateriales = '".$idpm."'  ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 2:
	if($idsol>1 and $idsol<10){
		$estado="CARGADO";	
		}//else{$estado="CARGADO";}
		if($idsol=0 and $nivel==99){$estado="INGRESADO";}
	    $idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."'  WHERE idpedidomateriales = '".$idpm."' and idsolicitante='".$idsol."' ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
	case 3:
	if($idsol==0 and $nivel==99){
		$estado="AUTORIZADO";	
		$idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."'  WHERE idpedidomateriales = '".$idpm."' and idsolicitante='".$idsol."' ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);}
	break;
	case 4:
	if($idsol==0 and $nivel==99){
		$estado="CARGADO";	
		$idpm=$_POST['idf'];
	    $queryE="UPDATE pedidomateriales 
	    SET estado='".$estado."'  WHERE idpedidomateriales = '".$idpm."' and idsolicitante='".$idsol."' ";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);}
	break;
*/
?>