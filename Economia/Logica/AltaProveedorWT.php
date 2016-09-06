<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$nroprov=$_POST['nroprov'];$existe=FALSE;
$existe=buscarProv($nroprov);
if($existe==TRUE)
{ /*$respuesta = "YA EXISTE PROVEEDOR";
  include("../views/frmAltaProveedorEx.php"); // $flag=false;
  exit;*/
  $razonsocial=strtoupper($_POST['razonsocial']);$usuario="USER-".$nroprov; $clave=md5($nroprov);$estate="P";
  $queryS = "update acreedoreconomia set usuario='".$usuario."', clave='".$clave."',  razonsocial='".$razonsocial."', estado='".$estate."' where nroprov='".$nroprov."' ;"; $conexion=Conectarse();
  $rs=mysqli_query($conexion,$queryS)or die(include("../views/frmAltaProveedorEx.php"));		
  $respuesta = "CARGA DE DATOS CORRECTA";
  $queryu2="update usuarios set usuario='".$usuario."',clave='".$clave."',razonsocial='".$razonsocial."',estado='".$estate."' where nroprov='".$nroprov."' ;";
         //aca actualiza el estado P de usuarios 		
	     $rs2=mysqli_query($conexion,$queryu2);
        include("../views/frmAltaProveedorEx.php");
		 //$flag=false;
		 mysqli_close($conexion);  	 
          }
  else { //no existe el proveedor
        $razonsocial=strtoupper($_POST['razonsocial']);$cuit="";$apellido="";$nombre="";$ec="";$dni=0;
        $domicilio="";$domicilio2="";$localidad="";$provincia="";$tel1="";$tel2="";$email="";$email2="";
        $conyuge="";$causa="-";$privilegio="-";$idacreedoreconomia=buscarID();
	    $conexion=Conectarse();$usuario="USER-".$nroprov;
        $clave=md5($nroprov);$estate="P";
	     $query = "INSERT INTO acreedoreconomia (
	     idacreedoreconomia, usuario, clave, nroprov, razonsocial, cuit, dni, apellido, nombre, estadocivil, domicilio, domicilio2, localidad, provincia, tel1, tel2, email, email2, conyuge, estado, causa, privilegio) VALUES
    	 ('".$idacreedoreconomia."','".$usuario."','".$clave."','".$nroprov."','".$razonsocial."','".$cuit."','".$dni."','".$apellido."','".$nombre."','".$ec."','".$domicilio."','".$domicilio2."','".$localidad."','".$provincia."','".$tel1."','".$tel2."','".$email."','".$email2."','".$conyuge."','".$estate."','".$causa."','".$privilegio."');";
		/*   $query = "UPDATE acreedoreconomia SET razonsocial='".$razonsocial."', cuit='".$cuit."', dni='".$dni."',apellido='".$apellido."', nombre='".$nombre."', estadocivil='".$estadocivil."', domicilio='".$domicilio."', localidad='".$localidad."', provincia='".$provincia."', tel1='".$tel1."', tel2='".$tel2."', email='".$email."', 
        email2='".$email2."', conyuge='".$conyuge."', estado='A', causa='".$causa."', privilegio='".$privilegio."' where nroprov='".$nroprov."';";*/
        $rs=mysqli_query($conexion,$query)or die(include("../views/frmAltaProveedorEx.php"));		
	    $respuesta = "CARGA DE DATOS CORRECTA";
		$idusuarios=buscarIDusuario();$conexion=Conectarse();
		$queryu="insert into usuarios(idusuarios,usuario,clave,nroprov,razonsocial,estado) 
		values ('".$idusuarios."','".$usuario."','".$clave."','".$nroprov."','".$razonsocial."','P')";
         //aca actualiza el estado P de usuarios 		
	     $rs2=mysqli_query($conexion,$queryu);
        include("../views/frmAltaProveedorEx.php");
		 //$flag=false;
		 mysqli_close($conexion);
    	 }		
/////////////////////////////////////////////
/////////////////////////////////////////////	
function buscarProv($nroprov) {
        $respu = "";
        //$rs = null;
		$query = "SELECT nroprov FROM acreedoreconomia where nroprov='".$nroprov."'";
	   $conexion=Conectarse();
       $rs =mysqli_query($conexion,$query);
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
	$queryID = "SELECT idacreedoreconomia FROM acreedoreconomia ORDER BY idacreedoreconomia DESC LIMIT 1"; 
	$conexion=Conectarse();
	$rs =mysqli_query($conexion,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['idacreedoreconomia']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion);
	
}
/////////////////////////////////////////
function buscarIDusuario(){
	$queryID = "SELECT idusuarios FROM usuarios ORDER BY idusuarios DESC LIMIT 1"; 
	$conexion=Conectarse();
	$rs =mysqli_query($conexion,$queryID);
	$tot=mysqli_num_rows($rs);
    if ($tot!=0) {
    	$row=@mysqli_fetch_array($rs);
        $id = $row['idusuarios']+ 1;
	   }else{$id=1;}
	return $id;
	mysqli_free_result($rs);
	 mysqli_close($conexion);
	
}
?>