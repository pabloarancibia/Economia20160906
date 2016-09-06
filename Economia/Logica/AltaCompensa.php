<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$provcompe=$_POST['nroprov'];$existe=FALSE;
$existe=buscarProv($provcompe);
  if($existe==TRUE)
  {
     $respuesta = "YA EXISTE PROVEEDOR";
         include("../views/frmProvCompensa.php"); 
         exit;
          }
  else { 
        $cp=strtoupper($_POST['cp']);
        $aperepresenta="";$cuitrepre="";$domrepre="";$cprepre="";
        $telrepre="";$celrepre="";$emailrepre="";
        $idaccom=buscarID();
        $conexion=Conectarse();
       $query = "INSERT INTO acreedorcompensacion (
       idaccom, provcompe, codpostal, aperepresenta, cuitrepre, domrepre, cprepre,
       telrepre, celrepre, emailrepre) VALUES
       ('".$idaccom."','".$provcompe."','".$cp."','".$aperepresenta."','".$cuitrepre."','".$domrepre."','".$cprepre."','".$telrepre."','".$celrepre."','".$emailrepre."');";
        mysqli_query($conexion,$query);
        $respuesta = "CARGA DE DATOS CORRECTA";
         //aca actualiza el estado P de usuarios    
        include("../views/frmProvCompensa.php");
     //$flag=false;
     mysqli_close($conexion);
       }    

/////////////////////////////////////////////
function buscarProv($provcompe) {
        $respu = "";
        //$rs = null;
    $query = "SELECT provcompe FROM acreedorcompensacion where provcompe='".$provcompe."'";
     $conexion2=Conectarse();
       $rs =mysqli_query($conexion2,$query);
     $tot=mysqli_num_rows($rs);
        if ($tot!=0) {
      $respu =TRUE;
      mysqli_free_result($rs);
         }else{$respu=FALSE;}
        return $respu;
    mysqli_free_result($rs);
    mysqli_close($conexion2); 
    }
 
/////////////////////////////////////////
function buscarID(){
  $queryID = "SELECT idaccom FROM acreedorcompensacion ORDER BY idaccom DESC LIMIT 1"; 
  $conexion=Conectarse();
  $rs =mysqli_query($conexion,$queryID);
  $tot=mysqli_num_rows($rs);
    if ($tot!=0) {
      $row=@mysqli_fetch_array($rs);
        $id = $row['idaccom']+ 1;
     }else{$id=1;}
  return $id;
  mysqli_free_result($rs);
   mysqli_close($conexion);
  
}
?>