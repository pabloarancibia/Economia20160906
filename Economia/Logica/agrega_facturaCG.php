<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$dnidem=$_POST['dnidem'];
$encontro=buscarDni($dnidem);
if($encontro!=TRUE){
$ayn=strtoupper($_POST['ayn']);
$domreal=strtoupper($_POST['domreal']);
$domesp=strtoupper($_POST['domesp']);
$ec=$_POST['estadocivil'];
if($ec==1){$estadocivil="SOLTERO/A";}if($ec==2){$estadocivil="CASADO/A";}if($ec==3){$estadocivil="VIUDO/A";}if($ec==4){$estadocivil="SEPARADO/A";}if($ec==5){$estadocivil="CONCUBINADO/A";}if($ec==6){$estadocivil="OTRO";} 
if($ec==7){$estadocivil="DIVORCIADO/A";} 
$conyuge=strtoupper($_POST['conyuge']);
$caratula=strtoupper($_POST['caratula']);
$expediente=$_POST['expdte'];
$juzgado=strtoupper($_POST['jzgdo']);
$causa=strtoupper($_POST['causa']);
$monto=$_POST['monto'];
$costas=$_POST['costas'];
$totaldeuda=$_POST['tdeuda'];
$fechareclamo=date("Y-m-d");
$imprimio="NO";
$diasen=$_POST['diasen'];$me=$_POST['messen'];$mesen=devuelveFecha($me);$aniosen=$_POST['aniosen'];
$fecsen=$aniosen."-".$mesen."-".$diasen;
$fojapi=$_POST['fojapi'];
$diaapel=$_POST['diaapel'];$me2=$_POST['mesapel'];$mesapel=devuelveFecha($me2);$anioapel=$_POST['anioapel'];
$fecapel=$anioapel."-".$mesapel."-".$diaapel;
$fojapel=$_POST['fojapel'];
$diaalza=$_POST['diaalza'];$me3=$_POST['mesalza'];$mesalza=devuelveFecha($me3);$anioalza=$_POST['anioalza'];
$fecalza=$anioalza."-".$mesalza."-".$diaalza;
$fojaalza=$_POST['fojaalza'];
$diarecu=$_POST['diarecu'];$me4=$_POST['mesrecu'];$mesrecu=devuelveFecha($me4);$aniorecu=$_POST['aniorecu'];
$fecrecu=$aniorecu."-".$mesrecu."-".$diarecu;
$fojarecu=$_POST['fojarecu'];
$estado=strtoupper($_POST['estado']);
$a5=$_POST['art505'];
if($a5==1){$art505="NO";}else{$art505="SI";}
$l28=$_POST['ley2868'];
if($l28==1){$ley2868="NO";}else{$ley2868="SI";}
$dia4474=$_POST['dia4474'];$me5=$_POST['mes4474'];$mes4474=devuelveFecha($me5);$anio4474=$_POST['anio4474'];
$fec4474=$anio4474."-".$mes4474."-".$dia4474;
$fojaintima=strtoupper($_POST['fojaintima']);
$privilegio="NO";
//buscar nro idacreenciacongestion
$idcg=buscarNR();
$conexion=Conectarse();
$query = "INSERT INTO acreenciacongestion (
 idcg, dnidem, ayn, domreal, domesp, estadocivil, conyuge, caratula, expediente, juzgado, causa, monto, costas, totaldeuda, fechareclamo, imprimio, fecsen,
 fojapi, fecapel, fojapel, fecalza, fojaalza, fecrecu, fojarecu, estado, art505, ley2868, fec4474, fojaintima, privilegio) VALUES
 ('".$idcg."','".$dnidem."','".$ayn."','".$domreal."','".$domesp."','".$estadocivil."','".$conyuge."','".$caratula."','".$expediente."','".$juzgado."','".$causa."','".$monto."',
  '".$costas."','".$totaldeuda."','".$fechareclamo."','".$imprimio."','".$fecsen."','".$fojapi."','".$fecapel."','".$fojapel."','".$fecalza."','".$fojaalza."','".$fecrecu."','".$fojarecu."',
  '".$estado."','".$art505."','".$ley2868."','".$fec4474."','".$fojaintima."','".$privilegio."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmFacturasCG.php"));		
$respuesta = "CARGA DE DATOS CORRECTA";
mysqli_close($conexion);
//aca tengo que leer los abogados 
//y grabarlos en otra tabla
$am=$_POST['npfm'];
$hm=$_POST['hnpfm'];
//con los array values reordeno los indices
$abogadosm=array_values($am);$honorm=array_values($hm);
$ad=$_POST['npfd'];
$hd=$_POST['hnpfd'];
$abogadosd=array_values($ad);$honord=array_values($hd);
//cargarAbogados($dnidem,$abogadosm,$honorm,$abogadosd,$honord);
$conexionAb=Conectarse();
$i=0;
$tipo="MUNICIPALIDAD";
foreach ($abogadosm as $ayn) {
  echo $abogadosm[$i];
   echo "--";
   echo $honorm[$i];
$con="insert into honorabogados (tipo, aynabo, honorabo,dnidem)
 values ('".$tipo."','".$ayn."','".$honorm[$i]."',$dnidem);";
 mysqli_query($conexionAb,$con);
$i++;
}
$tipo="DEMANDANTE";
$j=0;
foreach ($abogadosd as $aynd) {
$con="insert into honorabogados (tipo, aynabo, honorabo,dnidem)
 values ('".$tipo."','".$aynd."','".$honord[$j]."',$dnidem);";
 mysqli_query($conexionAb,$con);
$j++;
}

mysqli_close($conexionAb);
////////////
?>
<script>
alert('FORMULARIO GRABADO CORRECTAMENTE');
window.location.href='../views/frmFacturasCG.php';
</script>	
<?php
}else{?>
<script>
alert('YA SE CARGO UNA DEMANDA PARA ESTE DNI');
window.location.href='../views/frmFacturasCG.php';
</script> 
<?php

}	

///////////////FUNCIONES//////////////////////////////
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
//////////////////////////////////////////////////////
function buscarDni($dnidem){
   $encontro=FALSE;
   $queryNF="SELECT dnidem FROM acreenciacongestion where dnidem='".$dnidem."' order by dnidem asc limit 1";
   $conexionnf=Conectarse();
   $rsnf=mysqli_query($conexionnf,$queryNF);
   $tot=mysqli_num_rows($rsnf);
   if ($tot!=0) {
      $encontro=TRUE;
      }else{$encontro=FALSE;}
  return $encontro;
  mysqli_free_result($rsnf);
   mysqli_close($conexionnf);
  

}         
/////////////////////////////////////////////

function buscarNR(){
   $nr=0;
   $queryNR="SELECT idcg FROM acreenciacongestion order by idcg desc limit 1";
   $conexionnr=Conectarse();
   $rsnr=mysqli_query($conexionnr,$queryNR);
   $tot=mysqli_num_rows($rsnr);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnr);
        $id = $row['idcg']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnr); mysqli_close($conexionnr);
  }         
///////////////////////////////////////////// 
  function buscarIDAB(){
   $nr=0;
   $queryNR="SELECT idh FROM honorabogados order by idh desc limit 1";
   $conexionnr=Conectarse();
   $rsnr=mysqli_query($conexionnr,$queryNR);
   $tot=mysqli_num_rows($rsnr);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnr);
        $id = $row['idh']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnr); mysqli_close($conexionnr);
  }        
/////////////////////////////////////////  
function cargarAbogados($dnidem, $abogadosm,$honorm,$abogadosd,$honord){
//$idh=buscarIDAB();  
$conexionAb=Conectarse();
//$queryAb="insert into honorabogados (idh, tipo, aynabo, honorabo, denidem) VALUES ();";
//$i=0;
$tipo="MUNICIPALIDAD";
for ($i=0;$i<count($abogadosm);$i++) {
mysqli_query($conexionAb,"insert into honorabogados
 (idh, tipo, aynabo, honorabo, dnidem) VALUES 
 ('','".$tipo."','".$abogadosm[$i]."','".$honorm[$i]."','".$dnidem."');");  
//$idh=buscarIDAB(); $conexionAb=Conectarse(); 
}
$tipo="DEMANDANTE";
for ($j=0;$j<count($abogadosd);$j++) {
mysqli_query($conexionAb,"insert into honorabogados
 (idh, tipo, aynabo, honorabo, denidem) VALUES 
 ('','".$tipo."','".$abogadosd[$j]."','".$honord[$j]."','".$dnidem."');");
}

}

?>