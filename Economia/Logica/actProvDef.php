<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<?php
if (!function_exists('Conectarse')){
  include "../Conexion/Conexion.php";
}
$Conexion = Conectarse();

if(!empty($_POST["conHab"])){
  //codigo generar numero prov inscripto
    if (!empty($_POST["cuitIns"])) {
      $cuit = $_POST["cuitIns"];
      $emailIns = $_POST["emailIns"];
	  //num prov anterior, el que va ser modificado (igual a dni_int)
	  $nroProvIns=$_POST["nroProvIns"];
	  $nroSolIns=$_POST["nroSolIns"];
      //buscar ultimo numero de prov +1
      $num_prov = BuscarNumProvInscrip();
	  
	  //aca en vez de update deberia ser un insert select * donde nrosol y cuit sea igual
	  //esos datos los insertamos en la tabla prov-def
      //$query = "UPDATE proveedores SET nroProv='$num_prov' WHERE cuit = '$cuit'";
	  ///$qselec = "SELECT * FROM proveedores WHERE cuit = '$cuit' AND txt_nro_solicitud = '$nroSolIns'";
	  $queryInsert = "INSERT INTO proveedoresactivos (SELECT * FROM proveedores WHERE txt_nro_solicitud = '".$nroSolIns."' AND cuit = '".$cuit."')";
	  $queryActualizacionNumProv = "UPDATE proveedoresactivos SET nroProv='".$num_prov."' WHERE cuit = '".$cuit."' AND txt_nro_solicitud = '".$nroSolIns."'";
	  /* tabla relacion Rubros*/
	  $query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '".$num_prov."' WHERE id_proveedor = '".$nroProvIns."'";
        
		/* Insertamos*/
		//if(mysqli_query($Conexion,$query)){
			//mysqli_query($Conexion,$queryInsert)or die(mysqli_error($Conexion));
		if(mysqli_query($Conexion,$queryInsert)){
			//actualizamos numero de proveedor
			mysqli_query($Conexion,$queryActualizacionNumProv);
			//aactualizamos rubros
			mysqli_query($Conexion,$query_rel);
			//enviamos correo
          pre_enviar_correo($emailIns,$num_prov);
		  
          mysqli_close($Conexion);
          echo "<h3><span class='label label-success'>El Numero de Proveedor Generado es = ".$num_prov."</span></h3><br />
          <h3><span class='label label-success'>Enviado a ".$emailIns."</span></h3><br />
          <h3><span class='label label-success'><a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php' >Volver</a></span></h3>
          ";
        }else {
          echo "<h3><span class='label label-danger'>ERROR EN LA CARGA DE NUMERO DE PROVEEDOR</span></h3>
		  <br />
          <h2><span class='label label-danger'>
		  <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
		  </span>
		  </h2>
		  <br />
		  <br /><br /><br />
          ";
		  echo mysqli_error($Conexion);
		 //mysqli_query($Conexion,$queryInsert) or die(mysql_error()); 
        }
    }
}elseif (!empty($_POST["sinHab"])) {
//codigo generar numero prov no inscripto
    if (!empty($_POST["cuitNoIns"])) {
      $cuit = $_POST["cuitNoIns"];
      $emailNoIns = $_POST["emailNoIns"];
	  //num prov anterior, el que va ser modificado
	  $nroProvNoIns=$_POST["nroProvNoIns"];
	  $nroSolNoIns=$_POST["nroSolNoIns"];
      //buscar ultimo numero de prov +1
      $num_prov = BuscarNumProvNoInscrip();
	  
	  /*copiar aca*/
      //$query = "UPDATE proveedores SET nroProv='$num_prov' WHERE cuit = '$cuit'";
	  $queryInsert = "INSERT INTO proveedoresactivos (SELECT * FROM proveedores WHERE txt_nro_solicitud = '".$nroSolNoIns."' AND cuit = '".$cuit."')";
	  $queryActualizacionNumProv = "UPDATE proveedoresactivos SET nroProv='".$num_prov."' WHERE cuit = '".$cuit."' AND txt_nro_solicitud = '".$nroSolNoIns."'";
	  /* tabla relacion Rubros*/
	  $query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '".$num_prov."' WHERE id_proveedor = '".$nroProvNoIns."'";
      	  
	  /*tabla relacion rubros*/
	  //$query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '$num_prov' WHERE id_proveedor = '$nroProvNoIns'";
        if(mysqli_query($Conexion,$queryInsert)){
			//actualizamos numero de proveedor
			mysqli_query($Conexion,$queryActualizacionNumProv);
			//aactualizamos rubros
			mysqli_query($Conexion,$query_rel);
			//enviamos correo
          pre_enviar_correo($emailNoIns,$num_prov);
		
		//if(mysqli_query($Conexion,$query)){
          //pre_enviar_correo($emailNoIns,$num_prov);
		  
		  mysqli_close($Conexion);
          echo "<h3><span class='label label-success'>El Numero de Proveedor Generado es = ".$num_prov."</span></h3><br />
          <h3><span class='label label-success'>Enviado a ".$emailNoIns."</span></h3><br />
          <h3><span class='label label-success'><a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php' >Volver</a></span></h3>
          ";
        }else {
          echo "<h3><span class='label label-danger'>ERROR EN LA CARGA DE NUMERO DE PROVEEDOR</span></h3>
		  <br />
          <h2><span class='label label-danger'>
		  <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
		  </span>
		  </h2>
		  <br />
		  <br /><br /><br />
          ";
		  echo mysqli_error($Conexion);
		 //mysqli_query($Conexion,$queryInsert) or die(mysql_error()); 
        }
		  
		  
          /*mysqli_close($Conexion);
          echo "El Numero de Proveedor Generado es = ".$num_prov."<br />
          Enviado a ".$emailNoIns."<br />
          <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
          ";
        }else {
          echo "Error en la carga de numero de proveedor<br />
          <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
          ";
        }*/
    }
}elseif(!empty($_POST["ProvConNum"])){
	/* SECCION para proveedores con numero definitivo
	el numero no debe cambiar...(los que estan en emergencia)*/
	
	if (!empty($_POST["cuitProvConNum"])) {
      $cuit = $_POST["cuitProvConNum"];
      $email = $_POST["emailProvConNum"];
	  //num prov anterior, el que va ser modificado
	  //$nroProvNoIns=$_POST["nroProvNoIns"];
	  $nroSol=$_POST["nroSolProvConNum"];
      //buscar ultimo numero de prov +1
      $num_prov = $_POST["nroProvConNum"]; //BuscarNumProvNoInscrip();
	  
	  /*copiar aca*/
      //$query = "UPDATE proveedores SET nroProv='$num_prov' WHERE cuit = '$cuit'";
	  $queryInsert = "INSERT INTO proveedoresactivos (SELECT * FROM proveedores WHERE txt_nro_solicitud = '".$nroSol."' AND cuit = '".$cuit."')";
	  //$queryActualizacionNumProv = "UPDATE proveedoresactivos SET nroProv='".$num_prov."' WHERE cuit = '".$cuit."' AND txt_nro_solicitud = '".$nroSol."'";
	  /* tabla relacion Rubros*/
	  //$query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '".$num_prov."' WHERE id_proveedor = '".$nroProvNoIns."'";
      	  
	  /*tabla relacion rubros*/
	  //$query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '$num_prov' WHERE id_proveedor = '$nroProvNoIns'";
        if(mysqli_query($Conexion,$queryInsert)){
			//actualizamos numero de proveedor
			//mysqli_query($Conexion,$queryActualizacionNumProv);
			//aactualizamos rubros
			//mysqli_query($Conexion,$query_rel);
			//enviamos correo
          pre_enviar_correo($email,$num_prov);
		
		//if(mysqli_query($Conexion,$query)){
          //pre_enviar_correo($emailNoIns,$num_prov);
		  
		  mysqli_close($Conexion);
          echo "<h3><span class='label label-success'>El Numero de Proveedor Generado es = ".$num_prov."</span></h3><br />
          <h3><span class='label label-success'>Enviado a ".$email."</span></h3><br />
          <h3><span class='label label-success'><a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php' >Volver</a></span></h3>
          ";
        }else {
          echo "<h3><span class='label label-danger'>ERROR EN LA CARGA DE NUMERO DE PROVEEDOR</span></h3>
		  <br />
          <h2><span class='label label-danger'>
		  <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
		  </span>
		  </h2>
		  <br />
		  <br /><br /><br />
          ";
		  echo mysqli_error($Conexion);
		}
	
	
	}
}
function pre_enviar_correo($direcEmail,$num_prov){
  $destinatarios=$direcEmail;
  $mail_asunto="Registro de Proveedor, Municipalidad de Resistencia";
  $mail_contendio="Su registro a sido exitoso, su numero de proveedor es ".$num_prov;//
  $from="noreply.mrgovar@gmail.com";
  $from_name="Municipalidad de Resistencia";
  //$archivos_adjuntos_ruta="";
  //$archivos_adjuntos_temp="";
  enviar_correo($destinatarios, $mail_asunto, $mail_contendio, $from, $from_name);


  //$respuesta = "SE ENVIARON LOS DATOS A ".$destinatarios.", REVISE SU CUENTA DE MAIL PARA VALIDAR";
}

function BuscarNumProvInscrip(){
$queryID = "SELECT nroProv FROM proveedoresactivos WHERE nroProv >= 2000 AND nroProv < 6000 ORDER BY nroProv DESC LIMIT 1";
$conexion=Conectarse();
$pr =mysqli_query($conexion,$queryID);
$tot=mysqli_num_rows($pr);
  if ($tot!=0) {
  	$row=@mysqli_fetch_array($pr);
      $nro = $row['nroProv']+ 1;
   }else{$nro=2000;}
return $nro;
mysqli_free_result($pr);
 mysqli_close($conexion);
}

function BuscarNumProvNoInscrip(){
$queryID = "SELECT nroProv FROM proveedoresactivos WHERE nroProv >=6000 ORDER BY nroProv DESC LIMIT 1";
$conexion=Conectarse();
$pr =mysqli_query($conexion,$queryID);
$tot=mysqli_num_rows($pr);
  if ($tot!=0) {
  	$row=@mysqli_fetch_array($pr);
      $nro = $row['nroProv']+ 1;
   }else{$nro=6000;}
return $nro;
mysqli_free_result($pr);
 mysqli_close($conexion);
}

function enviar_correo($destinatarios, $mail_asunto, $mail_contendio, $from, $from_name){
  require_once('../PHPMailer/PHPMailerAutoload.php');
  include("../PHPMailer/class.smtp.php");
$mail= new PHPMailer(); // defaults to using php "mail()"
$mail->CharSet = 'UTF-8';
$body= $mail_contendio;
$mail->IsSMTP(); // telling the protocol to use SMTP
$mail->Host = "smtp.gmail.com"; // SMTP server

//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;

//$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
///$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
//$mail->Port       = 587;

$mail->From = $from;
$mail->FromName = $from_name;

$mail->Username   = "noreply.mrgovar@gmail.com";  // GMAIL username
$mail->Password   = "/879/546";            // GMAIL password

$mail->Subject = $mail_asunto;

$mail->MsgHTML($body);
$destinatarios=explode(",", $destinatarios);
if(!empty($destinatarios)){
foreach($destinatarios as $un_destinatario){
$mail->AddAddress($un_destinatario); //destinatarios
}
}else{
return false;
}
$mail->Timeout = 20;
if($mail->Send()) {
return array(true);
}else {
return array(false,"Mailer Error: ".$mail->ErrorInfo);
}
}

 ?>
