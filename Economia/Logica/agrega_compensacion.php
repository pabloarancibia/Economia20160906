<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
$idacompensa=0;
$id = $_POST['bsprov']; $fechacarga=date("Y-m-d"); 
$proceso = $_POST['pro'];
$sujetop= $_POST['bssujeto'];
$tr = $_POST['tributo'];
/*
"1">PATENTE AUTOMOTOR"2">TASAS RETRIBUTIVAS DE SERVICIOS"3">IMPUESTO INMOBILIARIO
"4">TASA DE REGISTRO, INSPECCION Y SERVICIOS CONTRALOR"5">IMPUESTO A LA PUBLICIDAD Y PROPAGANDA
"6">IMPUESTO AL MAYOR VALOR DEL BIEN LIBRE DE MEJORAS"7">TASA DE INSPECCION PARA HABILITACION DE LOCALES"8">VENDEDORES EN VIA  Y ESPACIO PUBLICO
"9">TASA POR HABILITACION Y CONTROL DE ESPECTACULOS PUBLICOS
"10">DERECHO OCUPACION ESPACIO PUBLICO O PRIVADO MUNICIPAL"11">DERECHO DE OFICINA
"12">DERECHO DE ABASTO, FERIAS Y/O MERCADOS"13">SERVICIOS DE PROTECCION A LA SALUD
"14">DERECHOS DE CEMENTERIOS Y SERVICIOS FUNEBRES
"15">DERECHOS RELATIVOS A LA CONSTRUCCION Y EDIFICACION
"16">DERECHO POR FRACCIONAMIENTO DE TIERRAS,MENSURA,CATASTRO
"17">DERECHOS POR INSTALACIONES ELECTRICAS(VVDAS,ELECTROMECANICAS)
"18">LICENCIA DE CONDUCIR"19">T.PUBLICO,REMOCION,ESTADIA,HABILITACION DE VEHICULOS
"20">RENTAS DIVERSAS"21">CONTRIBUCION DE MEJORAS
*/
if($tr==1){$tributo="PATENTE AUTOMOTOR";}
if($tr==2){$tributo="TASAS RETRIBUTIVAS SERVICIOS";}
if($tr==3){$tributo="IMPUESTO INMOBILIARIO";}
if($tr==4){$tributo="T.REGISTRO,INSP.,CONTRALOR";}
if($tr==5){$tributo="IMP.PUBLICIDAD Y PROPAGANDA";}
if($tr==6){$tributo="IMP.+VALOR BIEN SIN MEJORAS";}
if($tr==7){$tributo="T.INSPEC.HABILITACION LOCALES";}
if($tr==8){$tributo="VENDEDOR VIA/ESPACIO PUBLICO";}
if($tr==9){$tributo="T.HAB.CONTROL ESP.PUBLICOS";}
if($tr==10){$tributo="DCHO OCUP.ESP.PUB/PRI.MCPAL";}
if($tr==11){$tributo="DERECHO DE OFICINA";}
if($tr==12){$tributo="DCHO ABASTO,FERIAS,MERCADOS";}
if($tr==13){$tributo="SERV.PROTECCION A LA SALUD";}
if($tr==14){$tributo="DCHOS CEMENT./SERV.FUNEBRES";}
if($tr==15){$tributo="DCHOS CONSTR/EDIFICACION";}
if($tr==16){$tributo="DCHO.FRACC.TIERRAS,MENS.CAT.";}
if($tr==17){$tributo="DCHO.INS.ELEC.(VVDAS,ELECMEC)";}
if($tr==18){$tributo="LICENCIA DE CONDUCIR";}
if($tr==19){$tributo="T.PUB,REM,EST,HAB.VEHICULOS";}
if($tr==20){$tributo="RENTAS DIVERSAS";}
if($tr==21){$tributo="CONTRIBUCION DE MEJORAS";}

$nroform=0;$anioform=0;
$importe=$_POST['monto'];$documento=$_POST['dcto'];
//VERIFICAMOS EL PROCESO
switch($proceso){
	case 'Registro':
	    $idacompensa=buscarId();
		$queryR="INSERT INTO acreenciacompensacion (idacompensa, provcom, sujetop, tributop, importep, fechacarga,imprimio,documento,nroform,anioform) 
		VALUES('".$idacompensa."','".$id."','".$sujetop."','".$tributo."','".$importe."','".$fechacarga."','NO','".$documento."','".$nroform."','".$anioform."');";
		$rr=mysqli_query($conexion,$queryR);mysqli_close($conexion);
	break;
	
	case 'Edicion':
	    $idacompensa=$_POST['idf'];
	    $queryE="UPDATE acreenciacompensacion 
	    SET sujetop='".$sujetop."', tributop='".$tributo."', importep='".$importe."', fechacarga='".$fechacarga."', documento='".$documento."' WHERE idacompensa = '".$idacompensa."' ;";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="SELECT * FROM acreenciacompensacion where (provcom='".$id."') and(imprimio='NO') and (nroform=0) ORDER BY idacompensa ASC;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			    <th width="80">PROVEEDOR</th>
                <th width="150">SUJETO</th>
                <th width="150">TRIBUTO</th>
                <th width="150">IMPORTE $</th>
                <th width="150">DOCUMENTO</th>
                <th width="50">Opciones</th>
            </tr>';
	$tmontof=0;$tcont=0;
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
		        <td>'.$registro2['provcom'].'</td>
				<td>'.$registro2['sujetop'].'</td>
				<td>'.$registro2['tributop'].'</td>
				<td>'.$registro2['importep'].'</td>
				<td>'.$registro2['documento'].'</td>
				<td><a href="javascript:editarCompensacion('.$registro2['idacompensa'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="javascript:eliminarCompensacion('.$registro2['idacompensa'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>';
				$tmontof=$tmontof+$registro2['importep'];
				$tcont++;
				
	}
echo '</table>';
echo '<table class="table table-striped table-condensed table-hover">
        	<tr> 
			<td><h4>CANTIDAD DE DOCUMENTOS :</h4></td><td align="center"><h4>'.$tcont.'</h4></td>
			<td><h4> TOTAL $:</h4></td><td align="center"><h4>'.$tmontof.'</h4></td>
			</tr>';
mysqli_close($conexion);

 function buscarId(){
	$query2 = "SELECT idacompensa FROM acreenciacompensacion ORDER BY idacompensa DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$idacompensa = $row['idacompensa']+ 1;
		  }else{$idacompensa=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $idacompensa;
 }



?>