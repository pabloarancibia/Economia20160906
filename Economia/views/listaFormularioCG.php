<?php
require("../fpdf/fpdf.php");
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$id=$_POST['bsprov'];
$dni=$_POST['nrodni'];
$tot=0;
$query="select * from acreenciacongestion where dnidem='".$dni."';";
$result=mysqli_query($conexion,$query);
$tot=mysqli_num_rows($result);
if($tot!=0){
    $row=mysqli_fetch_array($result);
    $ayn=$row['ayn'];
    $domreal=$row['domreal'];$domesp=$row['domesp'];
    $estadocivil=$row['estadocivil'];
    $conyuge=$row['conyuge'];$caratula=$row['caratula'];
    $expediente=$row['expediente'];
    $juzgado=$row['juzgado'];
    $causa=$row['causa'];
    $monto=$row['monto'];$costas=$row['costas'];
    $totaldeuda=$row['totaldeuda'];
    $fecsen=$row['fecsen'];
    $fsen=explode("-", $fecsen);
    $fecsen=$fsen[2]."-".$fsen[1]."-".$fsen[0];
    $fojapi=$row['fojapi'];
    $fecapel=$row['fecapel'];
    $fap=explode("-",$fecapel);
    $fecapel=$fap[2]."-".$fap[1]."-".$fap[0];
    $fojapel=$row['fojapel'];
    $fecalza=$row['fecalza'];
    $fal=explode("-",$fecalza);
    $fecalza=$fal[2]."-".$fal[1]."-".$fal[0];
    $fojaalza=$row['fojaalza'];
    $fecrecu=$row['fecrecu'];
    $fr=explode("-",$fecrecu);
    $fecrecu=$fr[2]."-".$fr[1]."-".$fr[0];
    $fojarecu=$row['fojarecu'];$estado=$row['estado'];
    $art505=$row['art505'];$ley2868=$row['ley2868'];
    $fec4474=$row['fec4474'];
    $f4=explode("-",$fec4474);
    $fec4474=$f4[2]."-".$f4[1]."-".$f4[0];
    $fojaintima=$row['fojaintima'];
    $privilegio=$row['privilegio'];
}

$queryM="select * from honorabogados where dnidem='".$dni."';";
$montoh=0.00;
$result2=mysqli_query($conexion,$queryM);
while($row2=mysqli_fetch_array($result2)){
	$montoh=$montoh+$row2['honorabo'];
}
mysqli_free_result($result2);
			
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
	$this->Image('../images/minilogo2.jpg',15,2,180,60);
  // Salto de línea
    $this->Ln(60);
	$this->Cell(95);
    $this->SetFont('Arial','B',10);
    $this->Cell(50,10,utf8_decode('(*) FORMULARIO N°:...................... '),0);
    $this->Ln(10);
}
// Pie de página
function Footer()
{  // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
public function sanitizarFecha($fecha)
{
    //$date = date_create_from_format('d-m-Y', $fecha);
    $date = date_create($fecha);
    return date_format($date,'d-m-Y');
}

}

// Creación del objeto de la clase heredada
$pdf = new PDF();//hoja vertical
//$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,8,'1.-Nombre:','',0,'L');
$pdf->Cell(80,8,utf8_decode($ayn),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'2.-Domicilio Real:','',0,'L');
$pdf->Cell(80,8,utf8_decode($domreal),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'3.-Domicilio Especial:','',0,'L');
$pdf->Cell(80,8,utf8_decode($domesp),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'4.-Estado Civil:','',0,'L');
$pdf->Cell(80,8,utf8_decode($estadocivil),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('5.-Cónyuge:'),'',0,'L');
$pdf->Cell(80,8,utf8_decode($conyuge),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'6.-D.N.I:','',0,'L');
$pdf->Cell(80,8,$dni,'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'7.-Monto $:','',0,'L');
$pdf->Cell(80,8,chr(36).''.number_format($monto),2,",",".",'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,' .-Causa y Privilegio:','',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(150,8,utf8_decode($causa),'',0,'L');$pdf->ln(8);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,8,utf8_decode('8.-Carátula:'),'',0,'L');
$pdf->SetFont('Arial','',6);
$pdf->Cell(150,8,utf8_decode($caratula),'',0,'L');$pdf->ln(8);
$pdf->SetFont('Arial','',9);
$pdf->Cell(40,8,' .-Expediente:','',0,'L');
$pdf->Cell(80,8,utf8_decode($expediente),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'9.-Juzgado:','',0,'L');
$pdf->Cell(80,8,utf8_decode($juzgado),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('10.-Sentencia 1º Instancia:'),'',0,'L');
$pdf->Cell(25,8,$fecsen,'',0,'L');
$pdf->Cell(40,8,'.-Foja:','',0,'L');
$pdf->Cell(40,8,$fojapi,'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('11.-Apelación:'),'',0,'L');
$pdf->Cell(25,8,$fecapel,'',0,'L');
$pdf->Cell(40,8,'.-Foja:','',0,'L');
$pdf->Cell(40,8,$fojapel,'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('12.-Sentencia alzada:'),'',0,'L');
if($fojaalza!="" and $fojaalza!=0){
$pdf->Cell(25,8,$fecalza,'',0,'L');
$pdf->Cell(40,8,'.-Foja:','',0,'L');
$pdf->Cell(40,8,$fojaalza,'',0,'L');}$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('13.-Recurso Extraordinario:'),'',0,'L');
if($fojarecu!="" and $fojarecu!=0){
$pdf->Cell(25,8,$fecrecu,'',0,'L');
$pdf->Cell(40,8,'.-Foja:','',0,'L');
$pdf->Cell(40,8,$fojarecu,'',0,'L');}$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('14.-Estado:'),'',0,'L');
$pdf->Cell(60,8,utf8_decode($estado),'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,utf8_decode('15.-Profesional Municipio:'),'',1,'L');
$queryAM="select * from honorabogados where dnidem='".$dni."' and tipo='MUNICIPALIDAD';";
$result2=mysqli_query($conexion,$queryAM);
while($row2=mysqli_fetch_array($result2)){
    $pdf->Cell(60,8,$row2['aynabo'],'',0,'L');$pdf->ln(8);
}
mysqli_free_result($result2);
$pdf->Cell(40,8,utf8_decode('16.-Profesional Demandante:'),'',1,'L');
$queryAM="select * from honorabogados where dnidem='".$dni."' and tipo='DEMANDANTE';";
$result2=mysqli_query($conexion,$queryAM);
while($row2=mysqli_fetch_array($result2)){
    $pdf->Cell(60,8,$row2['aynabo'],'',0,'L');$pdf->ln(8);
}
mysqli_free_result($result2);
$pdf->Cell(40,8,'17.-Honorarios Regulados:','',0,'L');
$pdf->Cell(80,8,chr(36).''.number_format($montoh),2,",",".",'',0,'L');$pdf->ln(8);
$pdf->Cell(40,8,'18.-Costas Reguladas:','',0,'L');
$pdf->Cell(80,8,chr(36).''.number_format($costas),2,",",".",'',0,'L');$pdf->ln(8);
$pdf->Cell(60,8,utf8_decode('19.-Aplicacion art.505(actual 730) CCC:'),'',0,'L');
$pdf->Cell(25,8,$art505,'',0,'L');
$pdf->Cell(50,8,'.-Aplicacion Ley 2868:','',0,'L');
$pdf->Cell(25,8,utf8_decode($ley2868),'',0,'L');$pdf->ln(8);
$pdf->Cell(60,8,utf8_decode('20.-Requisitos Ley 4474:'),'',0,'L');
if($fojaintima!="" and $fojaintima!=0){
$pdf->Cell(25,8,$fec4474,'',0,'L');
$pdf->Cell(50,8,'.-Foja:','',0,'L');
$pdf->Cell(25,8,utf8_decode($fojaintima),'',0,'L');}$pdf->ln(8);
//$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,utf8_decode('21.-Documentación acompañada (detallar) (acompañar 2 juegos), la firma del pedido debe estar certificada:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,8,utf8_decode('               Extracto de la Ordenanza: "..cada una de las personas que se presente  debera acompañar el formulario respectivo y dos(2)'),0,1,'L');
$pdf->Cell(0,8,utf8_decode('               fotocopias de la sentencia y cédula de la notificación, certificadas por el juzgado que ha dictado la misma, fijandodomicilio'),0,1,'L');
$pdf->Cell(0,8,utf8_decode('               legal a los fines  del presente  e indicando monto,causa y privilegio,con firma certificada del formulario...'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,8,utf8_decode('22.-Se ha fijado como límite máximo para la presentación el día 20 de agosto de 2016. '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('23.-Por medio del presente pedido de verificación de acreencia judicializada el peticionante acepta y presta'),0,1,'L');
$pdf->Cell(0,8,utf8_decode(' conformidad a los términos y condiciones de la ordenanza 11732 del 22 de diciembre de 2015 dictada por el '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('Concejo Deliberante del Municipio de esta ciudad,particularmente a sus arts. 9 y 10 del instrumento legal mencionado.- '),0,1,'L');
$pdf->ln(10);

$pdf->Cell(0,8,utf8_decode('         Resistencia _____ de _________ de 2016.- '),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,8,utf8_decode('         (*) Cada formulario deberá estar numerado y el retiro del mismo deberá ser documentado y firmado por quien lo retira.-  '),0,1,'L');
//$pdf->Cell(0,8,utf8_decode('          '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         (**) Cada formulario deberá ser completado íntegramente conforme lo indicado. '),0,1,'L');

$pdf->Output('Formulario de Documentación Reclamada','I');

?>