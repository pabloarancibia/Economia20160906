<?php

//al finalizar borrar lineas q muestra errores
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
//Post Param
if(empty($_POST['nroProv'])){
/////////queda obsoleto por ahora.....traigo ultimo num_prov y le asigno +1

// $nroProv = BuscarNumProv();
//SI ESTA VACIO NROPROV LE ASIGNO el numero de dni PARA SABER Q ES UN PROV NO INSCRIPTO
//Y LUEGO DEBEREMOS VERIFICAR SI TIENE HABILITACION MUNICIPAL O NO
$nroProv=$_POST['dni_int'];
}else {
  //si no esta vacio es porque el usuario tiene num prov y lo ingreso
  $nroProv = $_POST['nroProv'];
}

//require_once('../PHPMailer/class.phpmailer.php');
require_once('../PHPMailer/PHPMailerAutoload.php');
include("../PHPMailer/class.smtp.php");

$precuit=$_POST['cuit1'];
$ccuit=$_POST['cuit2'];
$postcuit=$_POST['cuit3'];
/*if($precuit==1){$pre="20";}if($precuit==2){$pre="23";}
if($precuit==3){$pre="24";}if($precuit==4){$pre="27";}
if($precuit==5){$pre="30";}if($precuit==6){$pre="33";}
if($postcuit==1){$pos="0";}if($postcuit==2){$pos="1";}
if($postcuit==3){$pos="2";}if($postcuit==4){$pos="3";}
if($postcuit==5){$pos="4";}if($postcuit==6){$pos="5";}
if($postcuit==7){$pos="6";}if($postcuit==8){$pos="7";}
if($postcuit==9){$pos="8";}if($postcuit==10){$pos="9";}*/
//$cuit=$precuit."-".$ccuit."-".$postcuit;
$cuit=$precuit;
$cuit.=$ccuit;
$cuit.=$postcuit;
//$cuit = $_POST['cuit'];
if(!empty($_POST['conv_multi'])){
$conv_multi = $_POST['conv_multi'];
}else{
  $conv_multi = '0000';
}
$email = strtoupper($_POST['email']);
$nombres = strtoupper($_POST['nombres']);
$calle=strtoupper($_POST['domicilio']);$altura=$_POST['altura'];$piso=$_POST['piso'];$dpto=$_POST['dpto'];
$domicilio = "Calle: ".$calle." Altura: ".$altura." Piso: ".$piso." Dpto: ".$dpto;
$localidad = strtoupper($_POST['localidad']);
$tel = $_POST['tel'];
$cp = $_POST['cp'];
$entidad = strtoupper($_POST['entidad']);
$dtos_filiat = strtoupper($_POST['dtos_filiat']);
$ap_pat = strtoupper($_POST['ap_pat']);
$ap_mat = $_POST['ap_mat'];
//$apynom_interesado = $_POST['apynom_interesado'];
$ap_interesado = $_POST['ap_interesado'];//agregar mysql y query
$nom_interesado = $_POST['nom_interesado'];//agregar mysql y query

$dni_int = $_POST['dni_int'];
$est_civil_int = $_POST['est_civil_int'];
$calle_int=strtoupper($_POST['domicilio_int']);$altura_int=$_POST['altura_int'];$piso_int=$_POST['piso_int'];$dpto_int=$_POST['dpto_int'];
$domicilio_int = "Calle: ".$calle_int." Altura: ".$altura_int." Piso: ".$piso_int." Dpto: ".$dpto_int;
$localidad_int = $_POST['localidad_int'];
$provincia_int = $_POST['provincia_int'];
$cp_int = $_POST['cp_int'];
$tel_int = $_POST['tel_int'];
$cel_int = $_POST['cel_int'];
//$apynom_cony = $_POST['apynom_cony'];
$ap_cony = $_POST['ap_cony'];//agregar mysql y query
$nom_cony = $_POST['nom_cony'];//agregar mysql y query

if (empty($_POST['dni_cony'])){$dni_cony = 0;}else{$dni_cony = $_POST['dni_cony'];}

//$apynom_aut = $_POST['apynom_aut'];
$ap_aut = $_POST['ap_aut'];///////////agregar mysql y query
$nom_aut = $_POST['nom_aut'];
$cargo_aut = $_POST['cargo_aut'];
$tipo_doc_aut = $_POST['tipo_doc_aut'];

if (empty($_POST['documento_aut'])){$documento_aut = 0;}else{$documento_aut = $_POST['documento_aut'];}
//$documento_aut = $_POST['documento_aut'];

/*if(empty($_POST['ap_aut2'])){$ap_aut2='';}else{$ap_aut2 = $_POST['ap_aut2'];}
*/
$ap_aut2 = $_POST['ap_aut2'];
$nom_aut2 = $_POST['nom_aut2'];
$cargo_aut2 = $_POST['cargo_aut2'];
$tipo_doc_aut2 = $_POST['tipo_doc_aut2'];
if (empty($_POST['documento_aut2'])){$documento_aut2 = 0;}else{$documento_aut2 = $_POST['documento_aut2'];}

$ap_aut3 = $_POST['ap_aut3'];
$nom_aut3 = $_POST['nom_aut3'];
$cargo_aut3 = $_POST['cargo_aut3'];
$tipo_doc_aut3 = $_POST['tipo_doc_aut3'];
if (empty($_POST['documento_aut3'])){$documento_aut3 = 0;}else{$documento_aut3 = $_POST['documento_aut3'];}

$ap_aut4 = $_POST['ap_aut4'];
$nom_aut4 = $_POST['nom_aut4'];
$cargo_aut4 = $_POST['cargo_aut4'];
$tipo_doc_aut4 = $_POST['tipo_doc_aut4'];
if (empty($_POST['documento_aut4'])){$documento_aut4 = 0;}else{$documento_aut4 = $_POST['documento_aut4'];}

//$n_rubro = $_POST['n_rubro'];
//$descripcion_rubro = $_POST['descripcion_rubro'];
//$rubro = $_POST['rubro'];
//$descripcion2_rubro = $_POST['descripcion2_rubro'];

//GENERAMOS EL NUMERO DE SOLICITUD AL AZAR
//si es una modificacion el campo nrosol no estara vacio y le asignamos el mismo numero
if (empty($_POST["NroSol"])){
$txtSolicitud = generar_txtSolicitud(12);
}else{
$txtSolicitud=$_POST["NroSol"];
}
///

///GENERAMOS LA CLAVE PARA validar
$clave = generar_txtAct(30);//,'false');
//echo $clave;
$validado='no';
global $url;
$url = "http://www.mr.gov.ar/v2/sitio/hacienda/Economia/views/activarproveedor.php?id=".$clave;
//
//limpio rel_prov_rubros_sub
$conexion = Conectarse();
$qlimpiar = "DELETE FROM rel_prov_rubros_sub WHERE id_proveedor = $nroProv";
mysqli_query($conexion,$qlimpiar)or die(mysqli_error($conexion));
mysqli_close($conexion)or die(mysqli_error($conexion));;;
// QUERY GUARDAR RUBRO y SUB EN TABLA
if (!empty($_POST['txtRubro1'])){
   $i=0;
  $txtRubro1=$_POST['txtRubro1'];
  $txtSubRubro1=$_POST['txtSubRubro1'];
  $conexion = Conectarse();
  //echo $_POST['txtRubro1'];
  foreach ($txtRubro1 as $rr) {
      //  $guardoRubro ="INSERT INTO rel_prov_rubros_sub (id_proveedor, id_rubro, id_subrubro)
      //  VALUES('$nroProv','$rr','$lblSubRubro[$i]')";
      $guardoRubro ="INSERT INTO rel_prov_rubros_sub (id_proveedor, id_rubro,id_subrubro)
      VALUES('$nroProv','$rr',$txtSubRubro1[$i])";
        mysqli_query($conexion,$guardoRubro)or die(mysqli_error($conexion));
$i++;
  }
mysqli_close($conexion)or die(mysqli_error($conexion));;
}else{
  echo "problema rub".$_POST['txtRubro1'];
}
 //Query
 //INSERT o UPDATE
 // domicilio='".$domicilio."',
 if (empty($_POST["NroSol"])){

 $queryGuardar = " INSERT INTO proveedores ( nroProv,cuit, conv_multi, email, nombres, domicilio, localidad, tel, cp,
   entidad, dtos_filiat, ap_pat, ap_mat, ap_interesado,nom_interesado ,dni_int, est_civil_int, domicilio_int,
   localidad_int, provincia_int, cp_int, tel_int, cel_int, ap_cony,nom_cony, dni_cony,ap_aut,nom_aut, cargo_aut,
   tipo_doc_aut, documento_aut,
   ap_aut2,nom_aut2, cargo_aut2,
   tipo_doc_aut2, documento_aut2,

   ap_aut3,nom_aut3, cargo_aut3,
   tipo_doc_aut3, documento_aut3,

   ap_aut4,nom_aut4, cargo_aut4,
   tipo_doc_aut4, documento_aut4,


   txt_nro_solicitud,txt_activ,validado )
 VALUES ( '$nroProv','$cuit', '$conv_multi', '$email', '$nombres', '$domicilio', '$localidad', '$tel', '$cp',
   '$entidad', '$dtos_filiat', '$ap_pat', '$ap_mat', '$ap_interesado','$nom_interesado', '$dni_int','$est_civil_int', '$domicilio_int',
   '$localidad_int', '$provincia_int', '$cp_int',
  '$tel_int', '$cel_int', '$ap_cony','$nom_cony','$dni_cony','$ap_aut','$nom_aut', '$cargo_aut',
  '$tipo_doc_aut', '$documento_aut',

'$ap_aut2','$nom_aut2', '$cargo_aut2',
  '$tipo_doc_aut2', '$documento_aut2',

  '$ap_aut3','$nom_aut3', '$cargo_aut3',
  '$tipo_doc_aut3', '$documento_aut3',

 '$ap_aut4','$nom_aut4', '$cargo_aut4',
  '$tipo_doc_aut4', '$documento_aut4',

  '$txtSolicitud','$clave','$validado') ";
}else{
	$queryGuardar = "UPDATE proveedores SET
	 nroProv='".$nroProv."',
	 cuit='".$cuit."',
	 conv_multi='".$conv_multi."',
	 email='".$email."',
	 nombres='".$nombres."',
	 domicilio='".$domicilio."',
	 localidad='".$localidad."',
	 tel='".$tel."',
	 cp='".$cp."',
   entidad='".$entidad."',
   dtos_filiat='".$dtos_filiat."',
   ap_pat='".$ap_pat."',
   ap_mat='".$ap_mat."',
   ap_interesado='".$ap_interesado."',
   nom_interesado='".$nom_interesado."',
   dni_int='".$dni_int."',
   est_civil_int='".$est_civil_int."',
   domicilio_int='".$domicilio_int."',
   localidad_int='".$localidad_int."',
   provincia_int='".$provincia_int."',
   cp_int='".$cp_int."',
   tel_int='".$tel_int."',
   cel_int='".$cel_int."',
   ap_cony='".$ap_cony."',
   nom_cony='".$nom_cony."',
   dni_cony='".$dni_cony."',
   ap_aut='".$ap_aut."',
   nom_aut='".$nom_aut."',
   cargo_aut='".$cargo_aut."',
   tipo_doc_aut='".$tipo_doc_aut."',
   documento_aut='".$documento_aut."',


   ap_aut2='".$ap_aut2."',
   nom_aut2='".$nom_aut2."',
   cargo_aut2='".$cargo_aut2."',
   tipo_doc_aut2='".$tipo_doc_aut2."',
   documento_aut2='".$documento_aut2."',

  
   ap_aut3='".$ap_aut3."',
   nom_aut3='".$nom_aut3."',
   cargo_aut3='".$cargo_aut3."',
   tipo_doc_aut3='".$tipo_doc_aut3."',
   documento_aut3='".$documento_aut3."',

  
   ap_aut4='".$ap_aut4."',
   nom_aut4='".$nom_aut4."',
   cargo_aut4='".$cargo_aut4."',
   tipo_doc_aut4='".$tipo_doc_aut4."',
   documento_aut4='".$documento_aut4."',


   txt_nro_solicitud='".$txtSolicitud."',
   txt_activ='".$clave."',
   validado='".$validado."'
   WHERE txt_nro_solicitud = $txtSolicitud ";
}
///////////////////////////////////////////////////////////
  //llamo a queryGuardar
$conexion = Conectarse();
if (mysqli_query($conexion,$queryGuardar)){
  $us=$nom_interesado.' '.$ap_interesado;
  //mailActivacion($email,$us);

  $destinatarios=$email;
  $mail_asunto="Registro de Proveedor, Municipalidad de Resistencia";
  $mail_contendio="Gracias por Inscribirse. Para completar el registro debe confirmar que ha recibido este email haciendo click en el siguiente enlace: ".$url;//
  $from="noreply.mrgovar@gmail.com";
  $from_name="Municipalidad de Resistencia";
  //$archivos_adjuntos_ruta="";
  //$archivos_adjuntos_temp="";
  enviar_correo($destinatarios, $mail_asunto, $mail_contendio, $from, $from_name);


  $respuesta = "SE ENVIARON LOS DATOS A ".$destinatarios.", REVISE SU CUENTA DE MAIL PARA VALIDAR";
}else{
  $respuesta="ERROR EN LA CARGA DE DATOS".mysqli_error($conexion);
  //.mysqli_error($conexion)

}
include("../views/frmProveedoresInscrip.php");
mysqli_close($conexion);

//.........FUNCIONES.................//
///////////////////////
function BuscarNumProv(){
$queryID = "SELECT nroProv FROM proveedores ORDER BY nroProv DESC LIMIT 1";
$conexion=Conectarse();
$pr =mysqli_query($conexion,$queryID);
$tot=mysqli_num_rows($pr);
  if ($tot!=0) {
  	$row=@mysqli_fetch_array($pr);
      $nro = $row['nroProv']+ 1;
   }else{$nro=1;}
return $nro;
mysqli_free_result($pr);
 mysqli_close($conexion);
}

//generamos la clave para validar!!!
function generar_txtAct($longitud){
// Array con los valores a escoger
$semilla = array();
$semilla[] = array('a','e','i','o','u');
$semilla[] = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','y','z');
$semilla[] = array('0','1','2','3','4','5','6','7','8','9');
$semilla[] = array('A','E','I','O','U');
$semilla[] = array('B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z');
$semilla[] = array('0','1','2','3','4','5','6','7','8','9');


// creamos la clave con la longitud indicada
for ($bucle=0; $bucle <$longitud; $bucle++)
{
// seleccionamos un subarray al azar
$valor = mt_rand(0, count($semilla)-1);
// selecccionamos una posición al azar dentro del subarray
$posicion = mt_rand(0,count($semilla[$valor])-1);
// cogemos el carácter y lo agregamos a la clave
if (empty($clave)){
  $clave=$semilla[$valor][$posicion];
}else{
$clave .= $semilla[$valor][$posicion];
}
}
// devolvemos la clave
return $clave;
}//fin funcion generar_txtAct

function generar_txtSolicitud($longitud){
// Array con los valores a escoger
$semilla = array();
//$semilla[] = array('a','e','i','o','u');
//$semilla[] = array('b','c','d','f','g','h','j','k','l','m','n','p','q','r','s','t','v','w','x','y','z');
$semilla[] = array('0','1','2','3','4','5','6','7','8','9');
//$semilla[] = array('A','E','I','O','U');
//$semilla[] = array('B','C','D','F','G','H','J','K','L','M','N','P','Q','R','S','T','V','W','X','Y','Z');
$semilla[] = array('0','1','2','3','4','5','6','7','8','9');


// creamos la clave con la longitud indicada
for ($bucle=0; $bucle <$longitud; $bucle++)
{
// seleccionamos un subarray al azar
$valor = mt_rand(0, count($semilla)-1);
// selecccionamos una posición al azar dentro del subarray
$posicion = mt_rand(0,count($semilla[$valor])-1);
// cogemos el carácter y lo agregamos a la clave
if (empty($clave)){
  $clave=$semilla[$valor][$posicion];
}else{
$clave .= $semilla[$valor][$posicion];
}
}
// devolvemos la clave
return $clave;
}//fin funcion generar txt_solicitud

function enviar_correo($destinatarios, $mail_asunto, $mail_contendio, $from, $from_name){

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
