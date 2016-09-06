<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$id = $_POST['id'];
$proceso = $_POST['pro'];


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
$imprimio="NO";$fecsen=$_POST['fecsen'];
$fojapi=$_POST['fojapi'];$fecapel=$_POST['fecapel'];
$fojapel=$_POST['fojapel'];$fecalza=$_POST['fecalza'];
$fojaalza=$_POST['fojaalza'];$fecrecu=$_POST['fecrecu'];
$fojarecu=$_POST['fojarecu'];$estado=strtoupper($_POST['estado']);
$art505=$_POST['art505'];$ley2868=$_POST['ley2868'];
$fec4474=$_POST['dia4474'];
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
mysqli_close($conexion);}

////////////

///////////////FUNCIONES//////////////////////////////
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