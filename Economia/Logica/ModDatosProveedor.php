<?php
//session_start();
/*if(!isset($_SESSION)) 
{ 
        session_start(); 
}*/
include "../Conexion/Conexion.php";
$nroprov=$_POST['nroprov'];$existe=FALSE;
// hay que sacar que existe xq en teoria 
//esta ya en la base de datos,controlar si no existe
//$existe=buscarProv($nroprov);
//buscar el proveedor y el dni primero
/*
  if($existe==TRUE)
	{
		 $respuesta = "YA EXISTE PROVEEDOR-VERIFIQUE SUS DATOS EN MODIFICACION DE DATOS";
         include("../views/frmAltaProveedor.php"); 
         // $flag=false;
         exit;
          }
  else { *///no existe el proveedor
        $razonsocial=strtoupper($_POST['razonsocial']);


        $precuit=$_POST['pre-cuit'];$ccuit=$_POST['cuit'];$postcuit=$_POST['pos-cuit'];
        if($precuit==1){$pre="20";}if($precuit==2){$pre="23";}if($precuit==3){$pre="24";}if($precuit==4){$pre="27";}if($precuit==5){$pre="30";}if($precuit==6){$pre="33";}
        if($postcuit==1){$pos="0";}if($postcuit==2){$pos="1";}
        if($postcuit==3){$pos="2";}if($postcuit==4){$pos="3";}
        if($postcuit==5){$pos="4";}if($postcuit==6){$pos="5";}
        if($postcuit==7){$pos="6";}if($postcuit==8){$pos="7";}
        if($postcuit==9){$pos="8";}if($postcuit==10){$pos="9";}
        $cuit=$pre."-".$ccuit."-".$pos;
        $apellido=strtoupper($_POST['apellido']);
        $nombre=strtoupper($_POST['nombre']);
        $ec=$_POST['estadocivil'];
        if($ec==1){$estadocivil="SOLTERO/A";}if($ec==2){$estadocivil="CASADO/A";}if($ec==3){$estadocivil="VIUDO/A";}if($ec==4){$estadocivil="SEPARADO/A";}if($ec==5){$estadocivil="CONCUBINADO/A";}
        if($ec==6){$estadocivil="OTRO";}
        if($ec==7){$estadocivil="DIVORCIADO/A";}

         $dni=$_POST['dni'];
        $domicilio=strtoupper($_POST['domcalle'])."-".$_POST['domnro']."-".strtoupper($_POST['dompiso'])."-".strtoupper($_POST['dombarrio']);
        $localidad=strtoupper($_POST['domlocal']);
        $provincia=strtoupper($_POST['domprovincia']);
        $tel1=$_POST['tel'];$tel2=$_POST['telalt'];$email=$_POST['mail'];
        $email2=$_POST['mailalt'];
        $conyuge=strtoupper($_POST['conyuge']);
        $causa="-";$privilegio="-";
        ////$causa=strtoupper($_POST['causa']);
        ////$privilegio=strtoupper($_POST['privilegio']);
        //$idacreedoreconomia=buscarID();
	     	$conexion=Conectarse();
	     /*$query = "INSERT INTO acreedoreconomia (
	     idacreedoreconomia, nroprov, razonsocial, cuit, apellido, nombre, dni, domicilio, localidad, provincia, tel1, tel2, email, email2) VALUES
    	 ('".$idacreedoreconomia."','".$nroprov."','".$razonsocial."','".$cuit."','".$apellido."','".$nombre."','".$dni."','".$domicilio."','".$localidad."','".$provincia."','".$tel1."','".$tel2."','".$email."','".$email2."');";*/
		   $query = "UPDATE acreedoreconomia SET razonsocial='".$razonsocial."', cuit='".$cuit."', dni='".$dni."',apellido='".$apellido."', nombre='".$nombre."', estadocivil='".$estadocivil."', domicilio='".$domicilio."', localidad='".$localidad."', provincia='".$provincia."', tel1='".$tel1."', tel2='".$tel2."', email='".$email."', 
        email2='".$email2."', conyuge='".$conyuge."', estado='A', causa='".$causa."', privilegio='".$privilegio."' where nroprov='".$nroprov."';";
        $rs=mysqli_query($conexion,$query)or die(include("../views/frmModDatosProveedor.php"));		
		    $respuesta = "MODIFICACION DE DATOS CORRECTA";
        mysqli_close($conexion);?>
        <script>
        alert('FORMULARIO GRABADO CORRECTAMENTE');
         window.location.href='../views/frmMenu.php';
         </script> <?php
        //include("../views/frmAltaProveedor.php");
		 //$flag=false;
		 
    	 //}		

         
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
?>