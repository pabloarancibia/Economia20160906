<?php
//session_start();
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
include "../Conexion/Conexion.php";
$id = $_POST['nroped'];
$anio=$_POST['anioped']; 
$idsol=$_SESSION['secretaria'];
$conexion=Conectarse();
$estado="CARGADO";

$queryC="SELECT * FROM pedidomateriales  where (nropedido='".$id."')and(aniopedido='".$anio."') and (isecre='".$idsol."') and (estado like '%".$estado."%') ORDER BY idpedidomateriales asc limit 1;";
$rs =mysqli_query($conexion,$queryC);
$tot=mysqli_num_rows($rs);
 if ($tot!=0) {
 	$row=@mysqli_fetch_array($rs);
	//secretaria no se va a modificar el resto de los datos si
	$uso=$row['destinomat'];$cta=$row['cuenta'];$tletra=$row['totalletra'];
    $ss=$row['isubsecre'];$dg=$row['idg'];
	$subsecre=buscarSS($ss);$dirgral=buscarDG($dg);
	$_SESSION["nroped"]=$id;$_SESSION["anioped"]=$anio;
    $_SESSION["secretaria"]=$idsol;$_SESSION["subsecre"]=$subsecre;
    $_SESSION["dgral"]=$dirgral;$_SESSION["uso"]=$uso;
    $_SESSION["cuenta"]=$cta;$_SESSION["tletra"]=$tletra;
	
    header("Location: ../views/frmPedMatMod.php");mysqli_free_result($rs);
mysqli_close($conexion);
}
else{
?>
<script>
alert('NO EXISTE PEDIDO o NO SE PUEDE EDITAR-REVEER DATOS');
window.location.href='../views/frmModificarPedMat.php';
</script>	
<?php	
}
/////////////////////////////////////
function buscarSS($ss){
  $query="select detsubsec from subsecretarias where subsec='".$ss."';";
 $conexion=Conectarse();
 $rs =mysqli_query($conexion,$query);
 $tot=mysqli_num_rows($rs);
 if ($tot!=0) {
  $row=@mysqli_fetch_array($rs);
  $ss = $row['detsubsec'];
	   }
    return $ss;
    mysqli_free_result($rs);
	 mysqli_close($conexion);
}
function buscarDG($dg){
  $query="select dirdetalle from dirgenerales where dirgral='".$dg."';";
 $conexion=Conectarse();
 $rs =mysqli_query($conexion,$query);
 $tot=mysqli_num_rows($rs);
 if ($tot!=0) {
  $row=@mysqli_fetch_array($rs);
  $dg = $row['dirdetalle'];
	   }
    return $dg;
    mysqli_free_result($rs);
	 mysqli_close($conexion);
}


?>