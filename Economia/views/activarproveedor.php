<?php
/*
if(!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["usuario"])){
    header("Location:../views/frmMenu.php?nologin=false");}
$_SESSION["usuario"];
$_SESSION["razonsocial"];
*/
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>SOLICITUD DE PRE-INSCRIPCION</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<link rel="stylesheet" href="../css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
        <![endif]-->
</head>
<body class="body" style=" background-image: url(../images/bgcity.jpg);
  background-attachment: fixed;">
   <!--========header==========================-->
<header>
<table width="100%" height="120" border="0" background="../images/header2015.jpg">
<tr><td width="40%"></td>
<td><div align="left" style="color:#ffffff;" ><p><h4>SECRETARIA DE ECONOMIA</h4></p>
 </div></td>
</tr>
<tr><td width="40%"></td>
<!--
<td>
<div align="left" style="color:#ffffff;" >
<p>
<h4>USUARIO:
<?php //if (!empty($_SESSION["usuario"])){echo $_SESSION["usuario"];}else{echo ("ERROR");}?>
-
<?php //if (!empty($_SESSION["razonsocial"])){echo $_SESSION["razonsocial"];}else{echo ("ERROR");}?>
</h4>
</p>
 </div></td>
 -->
 <td><div align="left" style="color:#ffffff;" >
<p><h5>
 <script languaje="JavaScript">
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var dayarray=new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado")
var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
document.write("<small>  <font color='FFFFFF' face='Arial'>"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font></small>")
</script>
</h5></p></div></td>
</tr></table>
 <nav class="navbar navbar-default">
<div class="container-fluid">
<div class="collapse navbar-collapse" id="navbar-1">
 <ul class="nav navbar-nav">
 <li class="dropdown">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">INICIO<span class="caret"></span></a>
    <ul class="dropdown-menu">
    <!--<li><a href="../views/frmMenu.php">Página Principal</a></li>-->
   </ul></li></ul>
 </div></div>
 </nav></header>
<!-- script para formulario proveedores
<script "text/javascript" src="../js/ProveedoresInscrip.js"></script>
<link rel="stylesheet" type="text/css" href="../css/ProveedoresInscrip.css" media="screen" />
-->
<!--==============================content================================-->
<!--  -->
<!--<div class="container-fluid" align="center" style="background-color:#D8D8D8;">-->

<div id='container-fluid' class="container-fluid" style="margin-right:20px;margin-left:50px">

<?php
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
if (!empty($_GET['id'])){
$txtActivacion = $_GET['id'];
//echo $txtActivacion;
$query="SELECT * FROM proveedores WHERE txt_activ = '$txtActivacion'";
$resultado=mysqli_query($conexion,$query) or die ("ERROR");

if (mysqli_num_rows($resultado)!=0){
  // TOMAR LOS datos //
  while ($registro = mysqli_fetch_array($resultado)) {
  $nroProv  = $registro['nroProv'];
  $cuit  = $registro['cuit'];
  }//fin while

  //HACER ACA EL UPDATE DE VALIDADO = SI
  $queryVal = "UPDATE proveedores SET validado='SI' WHERE nroProv=$nroProv and cuit=$cuit";
  mysqli_query($conexion,$queryVal) or die ("ERROR");
?>
<style>
.panel-transparent {
	background: none;
	border-color:green;
}

.panel-transparent .panel-heading{
    background: rgba(0, 255, 0, 0.2)!important;
	border-color:green;
}

.panel-transparent .panel-body{
    background: rgba(46, 51, 56, 0.3)!important;
}
</style>
<div class="panel panel-primary panel-transparent">
  <div class="panel-heading">
    <h3 class="panel-title">MUCHAS GRACIAS</h3>
  </div>
  <div class="panel-body">
    LOS DATOS FUERON CONFIRMADOS<BR>
	DESCARGUE EL FORMULARIO Y LOS REQUISITOS
  </div>
</div>
 <?php
  //echo "<h2 id='title'>MUCHAS GRACIAS, LOS DATOS FUERON REGISTRADOS CORRECTAMENTE, AHORA PUEDE IMPRIMIR SU FORMULARIO</h2>";

  
  //FPDF
///////////////////////////////////////////////////////////////////////////////////////////////
}else {
  # code...
  echo "ERROR EN LA ACTIVACION DE LA CUENTA";
}



/*
function tomarDatos(){

}
function generarPdf(){
  require('../fpdf.php');
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(40,10,'Numero de Proveedor: '.$nroProv);
  $pdf->Output();
}
*/
mysqli_close($conexion);

 ?>
 <style media="screen">
#forms{
   float:left;
   margin: 20px;
   width: 220px;
 }
 </style>
 <h3>
Formulario:
</h3>
 <div id="forms">
 <form action="../Logica/pdfProveedores.php" method="post" target="_blank">
   <input type="hidden" name="id" value="datosProveedor" />
   <input type="hidden" name="txt_activ" value='<?php echo $_GET['id']; ?>' />
   <input type="hidden" name="accion" value="ver" />
   <button type="submit" style="width:220px;" class="btn btn-success">Ver</button>
 </form>
 </div>
  <div id="forms">
 <form action="../Logica/pdfProveedores.php" method="post" target="_blank">
   <input type="hidden" name="id" value="datosProveedor" />
   <input type="hidden" name="txt_activ" value='<?php echo $_GET['id']; ?>' />
   <input type="hidden" name="accion" value="descargar" />
   <button type="submit" style="width:220px;" class="btn btn-success">Descargar</button>
 </form>
 </div>
  <div id="forms">
 <form action="../Logica/pdfProveedores.php" method="post" target="_blank">
   <input type="hidden" name="id" value="datosProveedor" />
   <input type="hidden" name="txt_activ" value='<?php echo $_GET['id']; ?>' />
   <input type="hidden" name="accion" value="imprimir" />
   <button type="submit" style="width:220px;" class="btn btn-success">Imprimir</button>
 </form>
</div>
<style>
a{
	color:#000;
	text-decoration: none;
}
</style>
<br><br><br><br>
<h3>
Requisitos:
</h3>
<div class="" style="float:left">
<a href="../archivos/RequisitosProveedores.pdf" download="RequisitosProveedores.pdf" >
<label>Descargar Requisitos Proveedores</label>
</a>
<br>
<a href="../archivos/RequisitosProveedores.pdf" download="DeclaracionJurada.pdf">
<label>Descargar Declaracion Jurada</label>
</a>
<br>
<a href="../archivos/RequisitosProveedores.pdf" download="ClasificacionRubros.pdf">
<label>Descargar Clasificación de Rubros</label>
</a>
</div>
<?php
}//fin if empty get
else{
	echo("ERROR, CODIGO DE ACTIVACION INCORRECTO.");
}
?>
</div><!-- cierre div class="container-fluid"-->
<br>
<!--==============================footer=================================-->
<small>
<div class="col-md-12" align="center" style="background-color:#151515;color:#ffffff; font-family:Arial;font-size:8pt;">
    <p>Municipalidad de Resistencia-Av. Italia Nº 150<br />
    Telefono de Informes: (362) 4458201</p>
    <p>Todos los derechos reservados &copy; 2016-Se permite la reproduccion del contenido citando la fuente
    </p>
  </div>
</small>
</body>
</html>
