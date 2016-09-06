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
	  
      //buscar ultimo numero de prov +1
      $num_prov = BuscarNumProvInscrip();
      $query = "UPDATE proveedores SET nroProv='$num_prov' WHERE cuit = '$cuit'";
	  $query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '$num_prov' WHERE id_proveedor = '$nroProvIns'";
        if(mysqli_query($Conexion,$query)){
          pre_enviar_correo($emailIns,$num_prov);
          mysqli_close($Conexion);
          echo "El Numero de Proveedor Generado es = ".$num_prov."<br />
          Enviado a ".$emailIns."<br />
          <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
          ";
        }else {
          echo "Error en la carga de numero de proveedor<br />
          <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
          ";
        }
    }
}elseif (!empty($_POST["sinHab"])) {
//codigo generar numero prov no inscripto
    if (!empty($_POST["cuitNoIns"])) {
      $cuit = $_POST["cuitNoIns"];
      $emailNoIns = $_POST["emailNoIns"];
	  //num prov anterior, el que va ser modificado
	  $nroProvNoIns=$_POST["nroProvNoIns"];
      //buscar ultimo numero de prov +1
      $num_prov = BuscarNumProvNoInscrip();
      $query = "UPDATE proveedores SET nroProv='$num_prov' WHERE cuit = '$cuit'";
	  $query_rel = "UPDATE rel_prov_rubros_sub SET id_proveedor = '$num_prov' WHERE id_proveedor = '$nroProvNoIns'";
        if(mysqli_query($Conexion,$query)){
          pre_enviar_correo($emailNoIns,$num_prov);
          mysqli_close($Conexion);
          echo "El Numero de Proveedor Generado es = ".$num_prov."<br />
          Enviado a ".$emailNoIns."<br />
          <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
          ";
        }else {
          echo "Error en la carga de numero de proveedor<br />
          <a href='http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedorDefinitivo.php'>Volver</a>
          ";
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
$queryID = "SELECT nroProv FROM proveedores WHERE nroProv >= 2000 AND nroProv < 6000 ORDER BY nroProv DESC LIMIT 1";
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
$queryID = "SELECT nroProv FROM proveedores WHERE nroProv >=6000 ORDER BY nroProv DESC LIMIT 1";
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
