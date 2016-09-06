<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";

//para la cabecera
$aniopedido=2016;
$fechapedido=date("Y-m-d");
$estado="CARGADO";
$isecre=$_POST['secsol'];$isubsecre=$_POST['subsol'];$idg=$_POST['dirsol'];
$destmat=strtoupper($_POST['destmat']);
//cuando termina de cargar actualiza
$totalped=0; 
// cuando termina de cargar actualiza
$totalletra="cero";
$idsolicitante=222;
//buscar nro de pedido
$nropedido=buscarNP();$idpedido=0;
//buscar nro correlativo
$idpedidomateriales=buscarID();
$conexion=Conectarse();
$query = "INSERT INTO pedidomateriales (
 idpedidomateriales, nropedido, aniopedido, fechapedido, estado, totalped, totalletra, idsolicitante, idpedido, isecre, isubsecre, idg,destinomat) VALUES
 ('".$idpedidomateriales."','".$nropedido."','".$aniopedido."','".$fechapedido."','".$estado."','".$totalped."','".$totalletra."','".$idsolicitante."','".$idpedido."','".$isecre."','".$isubsecre."','".$idg."','".$destmat."');";
$rs=mysqli_query($conexion,$query)or die(include("../views/frmPedidosMateriales.php"));		
//$respuesta = "CARGA DE DATOS CORRECTA";
//actualizar nro de formulario
//actualInterv = "UPDATE nroform SET numero='" + nroform + "', anio='" + anio + "'"; 		
mysqli_close($conexion);
//actualizarNF($nf);?>
<script>
alert('PUEDE PROCEDER A CARGAR EL PEDIDO');
window.location.href='../views/frmPedidosMaterialesB.php';
</script>	
<?php
//header("Location: /Economia/views/frmGenerarFormulario.php?respuesta=$respuesta");
//include("../views/frmGenerarFormulario.php");
//$flag=false;

	

///////////////FUNCIONES//////////////////////////////
function buscarNP(){
   $nf=0;
   $queryNF="SELECT nropedido FROM pedidomateriales order by nropedido desc limit 1";
   $conexionnf=Conectarse();
   $rsnf=mysqli_query($conexionnf,$queryNF);
   $tot=mysqli_num_rows($rsnf);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnf);
        $id = $row['nropedido']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnf);
   mysqli_close($conexionnf);
  

}         
///////////////////////////////////////////// 
function buscarID(){
   $nr=0;
   $queryNR="SELECT idpedidomateriales FROM pedidomateriales order by idpedidomateriales desc limit 1";
   $conexionnr=Conectarse();
   $rsnr=mysqli_query($conexionnr,$queryNR);
   $tot=mysqli_num_rows($rsnr);
   if ($tot!=0) {
      $row=@mysqli_fetch_array($rsnr);
        $id = $row['idpedidomateriales']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rsnr);
   mysqli_close($conexionnr);
  

}         
///////////////////////////////////////////// 

function actualizarNF($nf){
 $n=$nf; 
 $queryAc="UPDATE nroform SET numero='".$n."';";
 $conexion2=Conectarse();
 $rs2=mysqli_query($conexion2,$queryAc);
 mysqli_close($conexion2);
}         
/////////////////////////////////////////////	
?>