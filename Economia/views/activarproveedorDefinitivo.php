<?php
if(!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenu.php?nologin=false");}
$_SESSION["apynom"];
//$_SESSION["razonsocial"];
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>ALTA PROVEEDOR DEFINITIVA</title>
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
<td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:
<?php
echo $_SESSION["apynom"]?>-<?php //echo $_SESSION["razonsocial"]
?></h4></p>
</div></td>
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
    <li><a href="../views/frmMenuUsuarios.php">Página Principal</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>
<script "text/javascript" src="../js/ProveedoresInscrip.js"></script>
<script "text/javascript" src="../js/activarProveedorAjax.js"></script>
<style media="screen">
#consultaHab{
  width: 50%;
  margin: 0 auto;
}

#consultaHab input[type=button]{
  /*width: 300px;*/
  height: 46px;
  color: #508530;
  font: bold 16px/23px "Lucida Grande", "Trebuchet MS", Arial, Helvetica, sans-serif;
  padding-top: 5px;
  /*background: transparent url("../images/bg_legend.gif") no-repeat;*/
  background-color: #35FC71;
  border-radius: 7px;
  -webkit-border-radius: 5px 10px;  /* Safari  */
  -moz-border-radius: 5px 10px;     /* Firefox */
  /*text-transform: uppercase;*/
  letter-spacing: 2px;
  text-align: center;
}
#consultaHab input[type=button]:hover{
 box-shadow: 0 5px 5px #508530, 0 9px 0 #508530, 0px 9px 10px rgba(0,0,0,0.4), inset 0px 2px 15px rgba(255,255,255,0.4), inset 0 -2px 9px rgba(0,0,0,0.2)
}
#txtCuit, #txtNroSol{
  background-color: #fff;
	/*width: 20%;*/
  height: 45px;
  font: 15px/18px "Lucida Grande", "Trebuchet MS", Arial, Helvetica, sans-serif;
	color: #5A698B;
	/*margin: 8px 0 10px 16px;*/
	/*padding: 1px;*/
  padding-top: 5px;
  border: 1px solid #8595B2;
	border-radius: 7px;
	-webkit-border-radius: 5px 10px;  /* Safari  */
	-moz-border-radius: 5px 10px;     /* Firefox */
	text-transform: uppercase;
	letter-spacing: 2px;
	text-align: center;
}
#nombres, #domicilio, #dniInt, #nroSol{
  width: 80%;
  height: 45px;
  margin: 10px;
  
   padding-top: 5px;
  border: 1px solid #8595B2;
	border-radius: 7px;
	-webkit-border-radius: 5px 10px;  /* Safari  */
	-moz-border-radius: 5px 10px;     /* Firefox */
	text-transform: uppercase;
	letter-spacing: 2px;
	text-align: center;
}
</style>

<div id='container-fluid' style="margin-right:20px;margin-left:50px">
<!-- pregunto si tiene habilitacion municipal -->
  <div id='consultaHab'>
    <input type="text" id="txtCuit" name="txtCuit" class="solo-numero" placeholder="NUMERO DE CUIT" required="required">
	<input type="text" id="txtNroSol" name="txtNroSol" class="solo-numero" placeholder="NUMERO DE SOLICITUD" required="required">
    <input type="button" id="getdata" name="getdata" value="Traer Datos"/><br /><br />
    <div id="datosProv" name="datosProv">
	<h3><span class="label label-success">Nombres</span></h3>
      <input type="text" id="nombres" name="nombres" value="" disabled ><br />
	  <h3><span class="label label-success">Domicilio</span></h3>
      <input type="text" id="domicilio" name="domicilio" value=""disabled><br />
	  <h3><span class="label label-success">Dni</span></h3>
	  <input type="text" id="dniInt" name="dniInt" value=""disabled><br />
	  <h3><span class="label label-success">Nº Solicitud</span></h3>
	  <input type="text" id="nroSol" name="nroSol" value=""disabled><br />
    </div>
      <form id="frmInscrip" name="frmInscrip" method="post" action="../Logica/actProvDef.php">
        <input type="text" id="cuitIns" name="cuitIns" value="">
        <input type="text" id="emailIns" name="emailIns" value="">
		<input type="text" id="nroProvIns" name="nroProvIns" value="">
		<input type="text" id="nroSolIns" name="nroSolIns" value="">
	<h3><span class="label label-success">GENERAR NUMERO DE PROVEEDOR </span></h3>
    <input type="submit" id="conHab" name="conHab" class="btn btn-warning" value="CON HABILITACION MUNICIPAL - Inscripto"/><br /><br />
  </form>
  <form id="frmNoInscrip" name="frmNoInscrip" method="post" action="../Logica/actProvDef.php">
    <input type="text" id="cuitNoIns" name="cuitNoIns" value="">
    <input type="text" id="emailNoIns" name="emailNoIns" value="">
	<input type="text" id="nroProvNoIns" name="nroProvNoIns" value="">
	<input type="text" id="nroSolNoIns" name="nroSolNoIns" value="">
    <input type="submit" id="sinHab" name="sinHab" class="btn btn-warning" value="SIN HABILITACION MUNICIPAL - No Inscripto"/>
  </form><br /><br />
  <form id="frmProvConNum" name="frmProvConNum" method="post" action="../Logica/actProvDef.php">
    <input type="text" id="cuitProvConNum" name="cuitProvConNum" value="">
    <input type="text" id="emailProvConNum" name="emailProvConNum" value="">
	<input type="text" id="nroProvConNum" name="nroProvConNum" value="">
	<input type="text" id="nroSolProvConNum" name="nroSolProvConNum" value="">
    <input type="submit" id="ProvConNum" name="ProvConNum" class="btn btn-warning" value="PROVEEDOR CON NUMERO"/>
  </form>
  </div>

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
