<?php
if(!isset($_SESSION)) 
{ 
        session_start(); 
}
$idsol=$_SESSION['secretaria'];
include "../Conexion/Conexion.php";
$np=obtenerPed($idsol);

$queryS="select * from secretarias a where a.sec='".$idsol."';"; 
$querySS="select * from subsecretarias where isec='".$idsol."' ;";

$queryCabecera="select a.nropedido,a.aniopedido,a.estado,a.totalped,a.totalletra, a.idsolicitante,a.destinomat,a.cuenta from pedidomateriales a where (a.idsolicitante='".$idsol."') and (a.nropedido='".$np."');";
$queryDetalle="select b.cantidad,b.importedetalle,b.detallepedido,b.idpedido,b.idrubro,b.idsubr
from detallepedidomateriales b where (b.idsol='".$idsol."') and (b.idpedido='".$np."') ;";

$conexion=Conectarse();
/////////////////traigo las dependencias
$conprov=mysqli_query($conexion,$queryS);
$fil=@mysqli_fetch_array($conprov);
$secretaria=$fil['detsec'];//mysqli_free_result($fil);
$conprov=mysqli_query($conexion,$querySS);
$fil=@mysqli_fetch_array($conprov);
$ssecretaria=$fil['detsubsec'];$subs=$fil['subsec'];//mysqli_free_result($fil);
$queryDG="select * from dirgenerales where issec='".$subs."';";
$conprov=mysqli_query($conexion,$queryDG);
$fil=@mysqli_fetch_array($conprov);
$dgral=$fil['dirdetalle'];//mysqli_free_result($fil);
$conprov=mysqli_query($conexion,$queryCabecera);
$fil=@mysqli_fetch_array($conprov);
$destino=$fil['destinomat'];$totalletra=$fil['totalletra'];
$cuenta=$fil['cuenta'];$nump=$fil['nropedido'];$anp=$fil['aniopedido'];


$resu=mysqli_query($conexion,$queryDetalle);
$row=mysqli_num_rows($resu);
if($row>0)
  { ?>
    <style type="text/css" media="print">
.nover {display:none}
</style> 
<?php
  echo "<table width='85%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='0' align='center'>";
  echo "<tr>";
  echo "<td align='center'><input type='button' class='nover' name='imprimir' value='IMPRIMIR'  onClick='window.print()'  ;/></td>";
  echo "<td align='center'><input type='button' class='nover' align='center' name='salir' value='Salir' onClick='history.back()' ;/></td>";
  echo "</tr>";
  echo "</table>";
   echo "<br></br>"; 
//	echo "<input type='button' name='imprimir' value='IMPRIMIR'  onClick='window.print()' style='margin:0px auto; display:block';/>";
  //echo "<br></br>";
 // echo "<input type='button' align='center' name='salir' value='Salir' onClick='history.back()' style='margin:0px auto; display:block';/>";
	//echo "<br></br>";
  echo "<table width='85%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='0' align='center'>";
  echo "<tr>";
  echo "<td colspan='6' align='center'><img src='../images/FVhead2.jpg'/></td>";
  echo "</tr>";
  echo "</table>";

  echo "<table width='85%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='0' align='center'>";
  echo "<tr>";
  echo "<strong><td align='center' colspan='6' style='font-size:30px'><b>SOLICITUD DE PEDIDOS DE MATERIALES</b></td></strong>";
  echo "</tr>";
  echo "</table>";
	echo "<table width='85%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='1' align='center'>";
	echo "<tr>";
  echo "<strong><td align='center' colspan='4' style='font-size:20px'>INTERVENCION DE COMPRAS</td><td align='center' colspan='2' style='font-size:20px'>NUMERO:................................    |    FECHA:........./........./.........</td>
  </strong>";echo "</tr>";
  echo "</table>";

  echo "<table width='85%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='1' align='center'>";
  
  echo "<tr>"; 
  echo "<td align='center'><b>Oficina Solicitante</b></td>";
  echo "<td align='center'><b>Secretaria:</b></td>";
  echo "<td align='center' ><b>".utf8_decode($secretaria)."</b></td>";
  echo "<td align='center'><b>Sub-Secretaria:</b></td>";
  echo "<td align='center' colspan='2'><b>".utf8_decode($ssecretaria)."</b></td>";
  echo "</tr>";
  echo "<tr>"; 
  echo "<td align='center'><b>Dccion Gral:</b></td>";
  echo "<td align='center' colspan='5'><b>".utf8_decode($dgral)."</b></td>";
  echo "</tr>";
  echo "<tr>"; 
  echo "<td align='center' colspan='2'><b>Destino de los Materiales:</b></td>";
  echo "<td align='center' colspan='4'><b>".utf8_decode($destino)."</b></td>";
  echo "</tr>";
  echo "<tr>"; 
  echo "<td align='center' colspan='2'><b>Cuenta Destino:</b></td>";
  echo "<td align='center' colspan='4'><b>".utf8_decode($cuenta)."</b></td>";
  echo "</tr>";
  echo "<tr>"; 
  echo "<td align='center'><b>IMPUTACION/CODIGO DE OFIC.</b></td>";
  echo "<td align='center'></td>";
  echo "<td align='center' width='10'><b>PARTIDA/PRESUPUESTO</b></td>";
  echo "<td align='center'></td>";
  echo "<td align='center'><b>INTERVENCION/PRESUPUESTO</b></td>";
  echo "<td align='center'  width='40'></td>";
  echo "</tr>";
echo "</table>";
echo "<table width='85%'  cellspacing='0' cellpadding='0' style='font-size:12px; page-break-before: auto;' bgcolor='FDFEFE' border='1' align='center'>";
  
  
  echo "<tr bgcolor='#CCCCCC'>";
  echo "<td align='center'><b>Nro.</b></td>";
  echo "<td align='center'><b>Rubro</b></td>";
  echo "<td align='center'><b>Sub.Rubro</b></td>";
	echo "<td align='center'><b>Cantidad</b></td>";
	echo "<td align='center'><b>Descripcion de Bienes/Servicios</b></td>";
	echo "<td align='center'><b>Importe Estimado $</b></td>";
	echo "</tr>";
  //echo "</table>";
  //echo "<table width='80%'  cellspacing='0' cellpadding='0' style='font-size:10px' bgcolor='FDFEFE' border='1' align='center'>";
  
   $conteo=1;$tmontof=0;
    while ($row = mysqli_fetch_array($resu)){
      echo "<tr>";
      echo "<td align='right' >".number_format($conteo,0,",",".")."</td>";
      echo "<td align='right' >".number_format($row['idrubro'],0,",",".")."</td>";
      echo "<td align='right'>".number_format($row['idsubr'],0,",",".")."</td>";
	    echo "<td align='right' >".number_format($row['cantidad'],0,",",".")."</td>";
      echo "<td align='justify' width='750'>".utf8_decode($row['detallepedido'])."</td>";
	    echo "<td align='right'>".chr(36).' '.number_format($row['importedetalle'],0,",",".")."</td>";
	    echo "</tr>";
      $conteo++;
    $tmontof=$tmontof+$row['importedetalle'];
	// aca colocar el tema del salto de pagina
       }
	  
     //echo "</table>";

     //echo "<table width='80%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='0' align='center'>";
     echo "<tr>";
     echo "<td align='center'>Total:</td>";
     echo "<td align='center' colspan='4'>".utf8_decode($totalletra)."</td>";
     echo "<td align='right' colspan='1'>".chr(36).' '.number_format($tmontof,0,",",".")."</td>";
     echo "</tr>";//echo "</table>";

     //echo "<table width='20%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='0' align='center'>";
     echo "<tr>";
     echo "<td align='left' colspan='2'>Pedido de Secretaria Nro:</td>";
     echo "<td align='center' colspan='2'>".number_format($nump,0,",",".")."</td>";
     echo "<td align='center' colspan='2'>".number_format($anp,0,",",".")."</td>";
     echo "</tr>";//echo "</table>";
     //echo "<table width='80%'  cellspacing='0' cellpadding='0' style='font-size:15px' bgcolor='FDFEFE' border='1' align='center'>";
     echo "<tr>"; 
    echo "<td align='center' colspan='6' height='35'><b>AUTORIZACIONES</b></td>"; echo "</tr>";
    echo "<tr>"; 
    echo "<td align='center' colspan='2' height='35'><b>DIRECCION GENERAL</b></td>";
    echo "<td align='center' colspan='2'><b>SUBSECRETARIA</b></td>";
    echo "<td align='center' colspan='2'><b>SECRETARIA</b></td>";echo "</tr>";
    echo "<tr>"; 
    echo "<td align='center' colspan='2' height='35'></td>";
    echo "<td align='center' colspan='2'></td>";
    echo "<td align='center' colspan='2'></td>";echo "</tr>";
    echo "<tr>"; 
    echo "<td align='center' colspan='6' height='35'><b>INTERVENCION DIRECCION GRAL DE ADMINISTRACION-CORRESPONDE</b></td>"; echo "</tr>";
    echo "<tr>"; 
  echo "<td align='center' height='35'><b>COMPRA DIRECTA</b></td>";
  echo "<td align='center' width='150'></td>";
  echo "<td align='center'><b>CONCURSO PREVIO</b></td>";
  echo "<td align='center' width='150'></td>";
  echo "<td align='center'><b>LICITACION PRIVADA</b></td>";
  echo "<td align='center' width='150'></td>";
  echo "</tr>";
   echo "<tr>"; 
  echo "<td align='center' colspan='3' height='40'><b>AUTORIZACION SECRETARIA DE ECONOMIA</b></td>";
  echo "<td align='center' colspan='3'></td>";
  
  echo "</tr>";echo "</table>";
    



     
	
   $respuesta="";
} else{
    $respuesta="NO HAY PEDIDOS EFECTUADOS";
    echo "<table width='100%'  cellspacing='0' cellpadding='0' style='font-size:20px' bgcolor='FDFEFE' border='1' align='center'>";
    echo "<caption>DATOS DEL PEDIDO</caption>";
    echo "<tr bgcolor='#CCCCCC'>";
    echo "<td align='center'><b>Respuesta del Sistema</b></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>&nbsp;</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center'>".$respuesta."</td>";
    echo "</tr>";  echo "</table>";
    echo "<br></br>";
    echo "<div align='center'><input class='btn btn-primary' type='button' value='Salir' onclick='history.back()'/></div>";
} 


function obtenerPed($idsol){
  $query2 = "SELECT nropedido,aniopedido FROM pedidomateriales where idsolicitante='".$idsol."' ORDER BY aniopedido desc, nropedido desc LIMIT 1"; 
  $conexion2=Conectarse();$tot=0;
  $rs2 =mysqli_query($conexion2,$query2);
  $tot=mysqli_num_rows($rs2);
   if ($tot!=0) {
    $row=@mysqli_fetch_array($rs2);
    $np = $row['nropedido'];
      }else{$np=0;}
    mysqli_free_result($rs2);  mysqli_close($conexion2);
   return $np;
 }
////////////////////

 ?>