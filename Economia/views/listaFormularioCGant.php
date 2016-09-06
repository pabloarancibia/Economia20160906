<?php
require("../fpdf/fpdf.php");
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$id=$_POST['bsprov'];
$dni=$_POST['nrodni'];
//$con="select a.dnidem, a.ayn, b.tipo, b.aynabo, b.honorabo from acreenciacongestion a, honorabogados b where (a.dnidem='".$dni."') and b.dnidem='".$dni."' ;";
//$consulta=mysqli_query($conexion,$con);

$query="select * from acreenciacongestion where dnidem='".$dni."' ;";
$result=mysqli_query($conexion,$query);
$valores=array();
if(mysqli_num_rows($result)!=0){
while($row = mysqli_fetch_assoc($result))
            {
                //Se agrega cada valor en el array
                array_push($valores, $row);
            }
$datosPersona=$valores;
mysqli_free_result($result);
			}
else{
	echo'<script type="text/javascript">
              alert("Ningun registro");
			   window.location="../views/frmlistaFormularioCG.php"
                    </script>';
}			

$queryM="select * from honorabogados where dnidem='".$dni."';";
$monto=0.00;
$result2=mysqli_query($conexion,$queryM);
while($row2=mysqli_fetch_array($result2)){
	$monto=$monto+$row2['honorabo'];
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
{
	
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}

     function cabecera($cabecera){
        
		$this->SetXY(20,85);
        $this->SetFont('Arial','',12);
        foreach($cabecera as $columna)
        {
            $this->Cell(40,7,$columna,0, 2 , 'L' ) ;
        }
    }
     function datos($datos){
 
        $this->SetXY(60,85);
        $this->SetFont('Arial','',12);
        foreach ($datos as $columna)
        {
            $this->Cell(85,7,utf8_decode($columna['dnidem']),'',2,'L' );
    		$this->Cell(85,7,utf8_decode($columna['ayn']),'',2,'L' );
			$this->Cell(85,7,utf8_decode($columna['estadocivil']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['domreal']),'',2,'L' );
			$this->Cell(85,7,utf8_decode($columna['domesp']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['conyuge']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['causa']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['privilegio']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['caratula']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['expediente']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['juzgado']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fecsen']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fojapi']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fecapel']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fojapel']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fecalza']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fojaalza']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fecrecu']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fojarecu']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['estado']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['art505']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['ley2868']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fec4474']),'',2,'L' );
            $this->Cell(85,7,utf8_decode($columna['fojaintima']),'',2,'L' );
        }
    }
    //El método tabla integra a los métodos cabecera y datos
    function tabla($cabecera,$datos){
        $this->cabecera ($cabecera) ;
        $this->datos($datos);
    }}
// Creación del objeto de la clase heredada
$pdf = new PDF();//hoja vertical
//$pdf=new PDF('L','mm','A4');//hoja horizontal
$pdf->AliasNbPages();
$pdf->AddPage();
   //Array de cadenas para la cabecera
$cabecera = array("1.-D.N.I:","2.-Demandante:","3.-Estado Civil:", "4.-Domicilio Real:","5.-Domicilio Especial:", "6.-Conyuge:","7.-Causa:",
"8.-Privilegio:","9.-Caratula:","10.-Expediente:","11.-Juzgado:","12.-Sentencia:",
"13.-Foja:","14.-Apelacion:","15.-Foja:","16.-Alzada:","17.-Foja:",
"18.-Recurso:","19.-Foja:","20.-Estado:","21.-Art.505:","22.-Ley 2868:",
"23.-Ley 4474:","24.-Notificacion:",);
$pdf->tabla($cabecera,$datosPersona); //Método que integra a cabecera y datos
$pdf->ln(1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(10);
$pdf->Cell(50,8,utf8_decode('25.-Monto Original $:'),0,0);
$pdf->Cell(10,8,number_format($monto,2,",","."),0,1,'L');

$pdf->ln(2);	
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,utf8_decode('         12.-Documentación acompañada (detallar) (acompañar 2 juegos), la firma del pedido debe  '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         estar certificada:'),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,8,utf8_decode('               Extracto de la Ordenanza: "Dos (2) fotocopias firmadas por el titular de la acreencia donde esté instrumentada la deuda que se'),0,1,'L');
$pdf->Cell(0,8,utf8_decode('               reclama.Como mínimo el título donde el peticionante reclame su acreencia debe estar respaldado suficientemente, con antecedentes '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('               de los tramites y decisiones municipales por el correspondiente reclamo y su consecuente factura. Tanto el remito, de ser aplicable,  '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('               como la demás documentación, como la factura deberán cumplir todas las disposiciones vigentes en cuanto a las formalidades im- '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('               puestas por la AFIP y/o ATP el organismo encargado de su control"  '),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,8,utf8_decode('         13.-Se ha fijado como límite máximo para la presentación el día 22 de abril de 2016. '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         14.-Por medio del presente pedido de verificación de acreencia no judicializada el peticio- '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         nante acepta y presta conformidad a los términos y condiciones de la ordenanza 11732 del '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         22 de diciembre de 2015 dictada por el Concejo Deliberante del Municipio de esta ciudad,   '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         particularmente a sus arts. 9 y 10 del instrumento legal mencionado.- '),0,1,'L');$pdf->ln(10);

$pdf->Cell(0,8,utf8_decode('         Resistencia _____ de _________ de 2016.- '),0,1,'L');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,8,utf8_decode('         (*) Cada formulario deberá estar numerado y el retiro del mismo deberá ser documentado y firmado por quien lo retira.-  '),0,1,'L');
//$pdf->Cell(0,8,utf8_decode('          '),0,1,'L');
$pdf->Cell(0,8,utf8_decode('         (**) Cada formulario deberá ser completado íntegramente conforme lo indicado. '),0,1,'L');

$pdf->Output('Formulario de Documentación Reclamada','I');

?>