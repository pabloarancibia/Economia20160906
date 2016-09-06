<?php
if(!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["apynom"])){
    //header("Location:../views/frmMenuUsuarios.php?nologin=false");
	$_SESSION["apynom"]="test";
	}
$_SESSION["apynom"];
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Listado Proveedores</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<!--<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">-->
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/grillaProveedores.js"  type="text/javascript"></script>
<!--script src="../js/ajaxpedmat.js" type="text/javascript"></script-->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
        <![endif]-->
</head>
<body class="body" style=" background-image: url(../images/bgcity.jpg);
  background-attachment: fixed;"><!-- -->
   <!--========header==========================-->
<header>
<table width="100%" height="120" border="0" background="../images/header2015.jpg">
<tr><td width="40%"></td>
<td><div align="left" style="color:#ffffff;" ><p><h2>SECRETARIA DE ECONOMIA</h2></p>
 </div></td>
</tr>
<tr><td width="40%"></td>
<td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["apynom"]?></h4></p>
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
 </nav>
 </header>
 
<!-----------------------------------------------------------  -->
<div class="container" style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 20px solid #ffffff;" 
>
<div class="filtro">
<form id="frm_filtro" method="post" action="">
				<ul>
                   <li><label>CUIT:</label> <input type="text" name="cuit" size="25" /></li>
                    <li>
                    	<button type="button" id="btnfiltrar">Filtrar</button>
                    </li>                
                    <li>
                    	<a href="javascript:;" id="btncancel">Todos</a>
                    </li>
                </ul>
</form>
</div><!-- fin div filtro table-striped table-condensed  table-condensed table-hover table-b -->

<div class="table-responsive">
<!--    class="table table-condensed table-hover table-bordered"  cellspacing="0" width="auto"-->
 <table id="data" class="table table-condensed table-hover table-bordered">
        	<thead>
            	<tr>
                    <th>Nº PROV</th>
                    <th>CUIT</th>
					<th>CONVENIO Nro</th>  
					<th>EMAIL</th>
					<th>NOMBRES</th>
					<th>DOMICILIO</th>
					<th>LOCALIDAD</th>
					<th>TEL</th>
	<th>CP</th>
	<th>ENTIDAD</th>
	<th>DATOS FILIATORIOS</th>
	<th>AP PATERNO</th>
	<th>AP MATERNO</th>
	<th>APELLIDO</th>
	<th>NOMBRE</th>
	<th>DNI</th>
	<th>ESTADO CIVIL</th>
	<th>DOMICILIO</th>
	<th>LOCALIDAD</th>
	<th>PROVINCIA</th>
	<th>CODIGO POSTAL</th>
	<th>TELEFONO</th>
	<th>CELULAR</th>
	<th>AP CONYUGUE</th>
	<th>NOM CONYUGUE</th>
	<th>DNI CONYUGUE</th>
	<th>AP AUT</th>
	<th>NOM AUT</th>
	<th>CARGO AUT</th>
	<th>DNI AUT</th>
	<th>VALIDADO POR EMAIL</th>
                </tr>
            </thead>
            <tbody>
            	
            </tbody>
        </table>
</div> <!--fin div table-responsive -->
</div><!-- fin div container -->
<!--==============================footer=================================-->
<small> 
<div class="col-md-12" align="center" style="background-color:#151515;color:#ffffff; font-family:Arial;font-size:8pt;"><!---->
    <p>Municipalidad de Resistencia-Av. Italia Nº 150<br />
    Telefono de Informes: (362) 4458201</p>
    <p>Todos los derechos reservados &copy; 2016-Se permite la reproduccion del contenido citando la fuente
    </p>
  </div>
</small>
</body>  
</html>