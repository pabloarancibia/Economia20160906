<?php
include "../Conexion/Conexion.php";
$conexion=Conectarse();
//$idgc=0;//$id = $_POST['bsprov']; 
$proceso = $_POST['pro'];//$secretaria=$_POST['nsec'];$aniopedido=$_POST['anp'];
//$nropedido=$_POST['nrop'];$estimado=$_POST['estima'];
$pedmatcom=$_POST['pedmatcom'];$aniooc=$_POST['anoc'];
if($aniooc==1){$anoc=2016;}
$nrooc= $_POST['noc'];$asignado = $_POST['asigna'];
$diasen=$_POST['diaoc'];$me=$_POST['messoc'];$mesen=devuelveFecha($me);$aniosen=$_POST['aniooc'];
$fecoc=$aniosen."-".$mesen."-".$diasen;
$proveedor=strtoupper($_POST['proveer']);
$proven=$_POST['provee'];
$actuacions=strtoupper($_POST['actuacions']);
$diaas=$_POST['diaas'];$mesacs=$_POST['mesas'];$mesas=devuelveFecha($mesacs);$aniosas=$_POST['anioas'];
$fecas=$aniosas."-".$mesas."-".$diaas;


//VERIFICAMOS EL PROCESO
switch($proceso){
	/// para esto tengo que grabar al generar el pedido
	case 'Edicion':
	    $idgc=$_POST['idf'];
	    $queryE="UPDATE gestioncompra 
	    SET pedmat='".$pedmatcom."',aniooc='".$anoc."',nrooc='".$nrooc."',asignado='".$asignado."',fecoc='".$fecoc."',
        proveedor='".$proveedor."',actuacions='".$actuacions."',fecas='".$fecas."', nropv='".$proven."'
	     WHERE aleatorio = '".$idgc."'";
		mysqli_query($conexion,$queryE);mysqli_close($conexion);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$conexion=Conectarse();
$queryC="select a.idpedidomateriales, a.isecre, a.aniopedido, a.nropedido, a.totalped, b.pedmat, b.aniooc, b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, b.fecas, b.nropv from pedidomateriales a, gestioncompra b where a.idpedidomateriales=b.aleatorio order by a.idpedidomateriales desc limit 15;";

$registro = mysqli_query($conexion,$queryC);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
echo '<table class="table table-striped table-condensed table-hover">
       <tr>
        <th width="100" style="font-family:verdana;font-size:60%;">ALEATORIO</th> 
        <th width="100" style="font-family:verdana;font-size:60%;">SECRETARIA</th>
        <th width="50" style="font-family:verdana;font-size:60%;">AÑO</th>
        <th width="50" style="font-family:verdana;font-size:60%;">PEDIDO</th>
        <th width="100" style="font-family:verdana;font-size:60%;">ESTIMADO$</th>
        <th width="50" style="font-family:verdana;font-size:60%;">PED.MAT</th>
        <th width="50" style="font-family:verdana;font-size:60%;">AÑO OC</th>
        <th width="50" style="font-family:verdana;font-size:60%;">NRO.O.C</th>
        <th width="50" style="font-family:verdana;font-size:60%;">MONTO ASIG.$</th>
        <th width="50" style="font-family:verdana;font-size:60%;">FECHA O.C</th>
        <th width="50" style="font-family:verdana;font-size:60%;">NRO.PROV.</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PROVEEDOR</th>
        <th width="50" style="font-family:verdana;font-size:60%;">ACT.SIMPLE</th>
        <th width="50" style="font-family:verdana;font-size:60%;">FECHA A.S</th>
        <th width="50" style="font-family:verdana;font-size:60%;">Opciones</th>
        </tr>';
	while ($registro2=mysqli_fetch_array($registro)) {
         echo '<tr>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['idpedidomateriales'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['isecre'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['aniopedido'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['nropedido'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['totalped'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['pedmat'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['aniooc'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['nrooc'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['asignado'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['fecoc'].'</td><td style="font-family:verdana;font-size:80%;">'.$registro2['nropv'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['proveedor'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['actuacions'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['fecas'].'</td>
         <td style="font-family:verdana;font-size:80%;">
         <a href="JavaScript:editarGC('.$registro2['idpedidomateriales'].')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a></td>
         </tr>';
         }
echo '</table>';
mysqli_close($conexion);

function devuelveFecha($mes){
	switch($mes)
 {
  case "Enero": $mes = "01"; break;
  case "Febrero": $mes = "02"; break;
  case "Marzo": $mes = "03"; break;
  case "Abril": $mes = "04"; break;
  case "Mayo": $mes = "05"; break;
  case "Junio": $mes = "06"; break;
  case "Julio": $mes = "07"; break;
  case "Agosto": $mes = "08"; break;
  case "Septiembre": $mes = "09"; break;
  case "Octubre": $mes = "10"; break;
  case "Noviembre": $mes = "11"; break;
  case "Diciembre": $mes = "12"; break;     
 }
 return $mes;
}

 function buscarId(){
	$query2 = "SELECT idacreenciasingestion FROM acreenciasingestion ORDER BY idacreenciasingestion DESC LIMIT 1"; 
	$conexion2=Conectarse();$tot=0;
	$rs =mysqli_query($conexion2,$query2);
	$tot=mysqli_num_rows($rs);
	 if ($tot!=0) {
	  $row=@mysqli_fetch_array($rs);
		$idacreenciasingestion = $row['idacreenciasingestion']+ 1;
		  }else{$idacreenciasingestion=1;}
		mysqli_free_result($rs);	 mysqli_close($conexion2);
	 return $idacreenciasingestion;
 }



?>