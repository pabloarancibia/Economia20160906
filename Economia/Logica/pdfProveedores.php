<?php
//ver tema acentos y n
//hacer una validacion en el formulario del cuit si existe o no
//hacer las validaciones js en el formulario
//PDF en mail
/*
require('../fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Numero de Proveedor: '.$nroProv);
$pdf->Output();
*/
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();
$txt_activ = $_POST['txt_activ'];
$query="SELECT * FROM proveedores WHERE txt_activ = '$txt_activ'";
$resultado=mysqli_query($conexion,$query) or die (mysql_error());
//echo $txt_activ;
//echo "antes if";
if (mysqli_num_rows($resultado)!=0){
  // TOMAR LOS datos //
  //echo "entra al if";
  while ($registro = mysqli_fetch_array($resultado)) {
  $nroProv  = $registro['nroProv'];
  $cuit  = $registro['cuit'];
  $conv_multi  = $registro['conv_multi'];
  $email  = $registro['email'];
  $nombres  = $registro['nombres'];
  $domicilio = $registro['domicilio'];
  $localidad = $registro['localidad'];
  $tel =  $registro['tel'];
  $cp =  $registro['cp'];
  $entidad = strtoupper( $registro['entidad']);
  $dtos_filiat = strtoupper( $registro['dtos_filiat']);
  $ap_pat = strtoupper( $registro['ap_pat']);
  $ap_mat =  $registro['ap_mat'];
  $ap_interesado =  $registro['ap_interesado'];
  $nom_interesado =  $registro['nom_interesado'];
  $dni_int =  $registro['dni_int'];
  $est_civil_int =  $registro['est_civil_int'];

  $dom_int=strtoupper( $registro['domicilio_int']);

  $localidad_int =  $registro['localidad_int'];
  $provincia_int =  $registro['provincia_int'];
  $cp_int =  $registro['cp_int'];
  $tel_int =  $registro['tel_int'];
  $cel_int =  $registro['cel_int'];
  $ap_cony =  $registro['ap_cony'];
  $nom_cony =  $registro['nom_cony'];
  $dni_cony =  $registro['dni_cony'];

  $ap_aut =  $registro['ap_aut'];
  $nom_aut =  $registro['nom_aut'];
  $cargo_aut =  $registro['cargo_aut'];
  $tipo_doc_aut =  $registro['tipo_doc_aut'];
  $documento_aut =  $registro['documento_aut'];

  if(empty( $registro['ap_aut2'])){$ap_aut2='';}else{$ap_aut2 =  $registro['ap_aut2'];}
  $nom_aut2 =  $registro['nom_aut2'];
  $cargo_aut2 =  $registro['cargo_aut2'];
  $tipo_doc_aut2 =  $registro['tipo_doc_aut2'];
  $documento_aut2 =  $registro['documento_aut2'];

  $ap_aut3 =  $registro['ap_aut3'];
  $nom_aut3 =  $registro['nom_aut3'];
  $cargo_aut3 =  $registro['cargo_aut3'];
  $tipo_doc_aut3 =  $registro['tipo_doc_aut3'];
  $documento_aut3 =  $registro['documento_aut3'];

  $ap_aut4 =  $registro['ap_aut4'];
  $nom_aut4 =  $registro['nom_aut4'];
  $cargo_aut4 =  $registro['cargo_aut4'];
  $tipo_doc_aut4 =  $registro['tipo_doc_aut4'];
  $documento_aut4 =  $registro['documento_aut4'];
  $txt_nro_solicitud = $registro['txt_nro_solicitud'];
  }//fin while
	if ($nroProv == $dni_int) 
		{$nroProvParaMostrar="--";}
	else
		{$nroProvParaMostrar=$nroProv;}
}//fin if




if(isset($_POST['id'])){
define('FPDF_FONTPATH','../fpdf/font/');
require('../fpdf/fpdf.php');

/*********** Clase PDF_JAVASCRIPT basandose en FPDF ***********/
class PDF_JavaScript extends FPDF {
var $javascript;
var $n_js;
function IncludeJS($script) {
$this->javascript=$script;
}
function _putjavascript() {
$this->_newobj();
$this->n_js=$this->n;
$this->_out('<<');
$this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
$this->_out('>>');
$this->_out('endobj');
$this->_newobj();
$this->_out('<<');
$this->_out('/S /JavaScript');
$this->_out('/JS '.$this->_textstring($this->javascript));
$this->_out('>>');
$this->_out('endobj');
}
function _putresources() {
parent::_putresources();
if (!empty($this->javascript)) {
$this->_putjavascript();
}
}
function _putcatalog() {
parent::_putcatalog();
if (!empty($this->javascript)) {
$this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
}
}
}
/****************************************************************/

/*************** Clase PDF_AutoPrint basandose en PDF_JavaScript *************/
class PDF_AutoPrint extends PDF_JavaScript{
function AutoPrint($dialog=false){
$param = ($dialog ? 'true' : 'false');
$script = "print($param);";
$this->IncludeJS($script);
}

function AutoPrintToPrinter($server,$printer,$dialog=false){
$script = "var pp = getPrintParams();";
if($dialog)
$script .= "pp.interactive = pp.constants.interactionLevel.full;";
else
$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
$script .= "print(pp);";
$this->IncludeJS($script);
}
//Cabecera de página
   function Header()
   {

       //$this->Image('logo.png',10,8,33);
       $this->Image('../images/FVhead.jpg' , 10 ,10, 180 , 20,'JPG', 'http://www.mr.gov.ar');

      $this->SetFont('Arial','B',12);

      //$this->Cell(30,10,'Title',1,0,'C');
      $this->Ln(22);

   }
   //Pie de página
function Footer()
{
  $this->Image('../images/FVfooter.jpg' , 10 ,280, 180 , 20,'JPG', 'http://www.mr.gov.ar');

//$this->SetY(-10);

$this->SetFont('Arial','I',8);

//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }
}
/****************************************************************************/

/* Creamos un nuevo objeto PDFAutoPrint que nos da la funcionalidad de imprimir y tambien las basicas de FPDF */
/*************** Construimos el form ************************/
//http://www.desarrolloweb.com/articulos/pie-cabecera-fpdf.html
$pdf = new PDF_AutoPrint();
$pdf->SetFont('courier','B',18);
$pdf->AddPage();
//$pdf->Image('../images/FVhead.jpg' , 10 ,10, 180 , 20,'JPG', 'http://www.mr.gov.ar');
//$pdf->Ln(22);
$pdf->Cell(40,10,"Solicitud de Inscripcion - Formulario No 01",0,1);
$pdf->SetFont('courier','',10);
$pdf->Cell(10,10,'Nro: ',0);
$pdf->Cell(120,10,$txt_nro_solicitud,0,1);
$pdf->Cell(60,10,'Numero de Proveedor: ',1);
$pdf->Cell(120,10,$nroProvParaMostrar,1,1);
$pdf->Cell(30,10,'Cuit: ',1);
$pdf->Cell(50,10,$cuit,1);
//$pdf->Cell(40,10);
$pdf->Cell(40,10,'Convenio No: ',1);
$pdf->Cell(60,10,$conv_multi,1,1);
$pdf->Cell(30,10,'Email: ',1);
$pdf->Cell(150,10,$email,1,1);
$pdf->Cell(40,10,'DATOS DE LA RAZON SOCIAL: ',0,1);
$pdf->Cell(30,10,'Nombres: ',1);
$pdf->Cell(150,10,$nombres,1,1);
$pdf->Cell(30,10,'Domicilio: ',1);
$pdf->Cell(150,10,$domicilio,1,1);
$pdf->Cell(30,10,'Localidad: ',1);
$pdf->Cell(150,10,$localidad,1,1);
$pdf->Cell(30,10,'Telefono: ',1);
$pdf->Cell(50,10,$tel,1);
$pdf->Cell(40,10,'Codigo Postal: ',1);
$pdf->Cell(60,10,$cp,1,1);
$pdf->Cell(30,10,'Entidad: ',1);
$pdf->Cell(50,10,$entidad,1);
$pdf->Cell(50,10,'Datos Filiatorios: ',1);
$pdf->Cell(50,10,$dtos_filiat,1,1);
$pdf->Ln(1);
$pdf->Cell(40,10,'DATOS DEL INTERESADO: ',0,1);
$pdf->Cell(40,10,'Apellido Paterno: ',1);
$pdf->Cell(50,10,$ap_pat,1);
$pdf->Cell(40,10,'Apellido Materno: ',1);
$pdf->Cell(50,10,$ap_mat,1,1);
$pdf->SetFont('courier','',9);
$pdf->Cell(40,10,'Apellido: ',1);
$pdf->SetFont('courier','',10);
$pdf->Cell(50,10,$ap_interesado,1);
$pdf->Cell(40,10,'Nombre: ',1);
$pdf->Cell(50,10,$nom_interesado,1,1);
$pdf->Cell(40,10,'Dni: ',1);
$pdf->Cell(50,10,$dni_int,1);
$pdf->Cell(40,10,'Estado Civil: ',1);
$pdf->Cell(50,10,$est_civil_int,1,1);
$pdf->Cell(30,10,'Domicilio: ',1);
$pdf->Cell(150,10,$dom_int,1,1);
$pdf->Cell(30,10,'Localidad: ',1);
$pdf->Cell(150,10,$localidad_int,1,1);
$pdf->Cell(30,10,'Provincia: ',1);
$pdf->Cell(150,10,$provincia_int,1,1);
$pdf->Cell(30,10,'Telefono: ',1);
$pdf->Cell(50,10,$tel_int,1);
$pdf->Cell(40,10,'Codigo Postal: ',1);
$pdf->Cell(60,10,$cp_int,1,1);
$pdf->Cell(30,10,'Celular: ',1);
$pdf->Cell(150,10,$cel_int,1,1);

$pdf->Cell(40,10,'Apellido Conyugue: ',1);
$pdf->Cell(50,10,$ap_cony,1);
$pdf->Cell(40,10,'Nombre Conyugue: ',1);
$pdf->Cell(50,10,$nom_cony,1,1);
$pdf->Cell(30,10,'Dni Conyugue: ',1);
$pdf->Cell(150,10,$dni_cony,1,1);
$pdf->Ln(1);
if (!empty($ap_aut)&&!empty($ap_aut)){
$pdf->Cell(40,10,'DATOS DE AUTORIZADOS: ',0,1);
$pdf->Cell(40,10,'Apellido: ',1);
$pdf->Cell(50,10,$ap_aut,1);
$pdf->Cell(40,10,'Nombre: ',1);
$pdf->Cell(50,10,$nom_aut,1,1);
$pdf->Cell(40,10,'Cargo: ',1);
$pdf->Cell(50,10,$cargo_aut,1);
$pdf->Cell(40,10,'Dni: ',1);
$pdf->Cell(50,10,$documento_aut,1,1);
}
if (!empty($ap_aut2)&&!empty($ap_aut2)){
  $pdf->Cell(40,10,'Apellido: ',1);
  $pdf->Cell(50,10,$ap_aut2,1);
  $pdf->Cell(40,10,'Nombre: ',1);
  $pdf->Cell(50,10,$nom_aut2,1,1);
  $pdf->Cell(40,10,'Cargo: ',1);
  $pdf->Cell(50,10,$cargo_aut2,1);
  $pdf->Cell(40,10,'Dni: ',1);
  $pdf->Cell(50,10,$documento_aut2,1,1);
}
if (!empty($ap_aut3)&&!empty($ap_aut3)){
$pdf->Cell(40,10,'Apellido: ',1);
$pdf->Cell(50,10,$ap_aut3,1);
$pdf->Cell(40,10,'Nombre: ',1);
$pdf->Cell(50,10,$nom_aut3,1,1);
$pdf->Cell(40,10,'Cargo: ',1);
$pdf->Cell(50,10,$cargo_aut3,1);
$pdf->Cell(40,10,'Dni: ',1);
$pdf->Cell(50,10,$documento_aut3,1,1);
}
if (!empty($ap_aut4)&&!empty($ap_aut4)){
$pdf->Cell(40,10,'Apellido: ',1);
$pdf->Cell(50,10,$ap_aut4,1);
$pdf->Cell(40,10,'Nombre: ',1);
$pdf->Cell(50,10,$nom_aut4,1,1);
$pdf->Cell(40,10,'Cargo: ',1);
$pdf->Cell(50,10,$cargo_aut4,1);
$pdf->Cell(40,10,'Dni: ',1);
$pdf->Cell(50,10,$documento_aut4,1,1);
}

/*parte rubros/subrubros */
$pdf->Cell(40,10,'RUBROS - SUBRUBROS: ',0,1);
$query2="SELECT * FROM rel_prov_rubros_sub WHERE id_proveedor = '$nroProv'";

$resultado2=mysqli_query($conexion,$query2) or die (mysql_error());

if (mysqli_num_rows($resultado2)!=0){
  while ($registro2 = mysqli_fetch_array($resultado2)) {
    $id_rub=$registro2['id_rubro'];
    $id_subrub=$registro2['id_subrubro'];
      $query3="SELECT * FROM rubros WHERE rubro = '$id_rub'";
      $resultado3=mysqli_query($conexion,$query3) or die (mysql_error());
      $row3= @mysqli_fetch_array($resultado3);
      $rubrodesc=$row3['rubrodesc'];
    $pdf->Cell(40,10,'Rubro: ',1);
    $pdf->Cell(150,10,$rubrodesc,1,1);
      $query4="SELECT * FROM subrubros WHERE subrubro = '$id_subrub'";
      $resultado4=mysqli_query($conexion,$query4) or die (mysql_error());
      $row4= @mysqli_fetch_array($resultado4);
      $subrubrodesc=$row4['subrubdesc'];
    $pdf->Cell(40,10,'Subrubro: ',1);
    $pdf->Cell(150,10,$subrubrodesc,1,1);
  }//fin while
}//fin if


/***

**/

/****************************************************************/

/*********** Segun la accion elegida presentamos en formato vista, descarga o impresion *******************/
$action = $_POST['accion'];
switch($action){
case "ver":
$pdf->Output("datosProveedor.pdf","I");
break;
case "descargar":
$pdf->Output("datosProveedor.pdf","D");
break;
case "imprimir":
$pdf->AutoPrint(true);
$pdf->Output();
break;
}
/****************************************************/

}
?>
