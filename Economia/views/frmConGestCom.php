<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];$_SESSION["secretaria"];
 if((!empty($_SESSION["razon"]))||(!empty($_SESSION["bddesde"]))
  ||(!empty($_SESSION["bdhasta"]))||(!empty($_SESSION["aleatoriod"]))
  ||(!empty($_SESSION["aleatorioh"]))||(!empty($_SESSION["nroprovd"]))
  ||(!empty($_SESSION["nroprovh"]))
  ||(!empty($_SESSION["nocd"]))
  ||(!empty($_SESSION["noch"]))
  ||(!empty($_SESSION["npmd"]))
  ||(!empty($_SESSION["npmh"]))
  ) 
  { unset($_SESSION["razon"]); unset($_SESSION["bddesde"]);
    unset($_SESSION["bdhasta"]);unset($_SESSION["aleatoriod"]);
    unset($_SESSION["aleatorioh"]);unset($_SESSION["nroprovd"]);
    unset($_SESSION["nroprovh"]);
    unset($_SESSION["nocd"]);unset($_SESSION["noch"]);
    unset($_SESSION["npmd"]);unset($_SESSION["npmh"]);
  // session_destroy();
    }
include "../Conexion/Conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Seguimiento de Pedido de Materiales</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.jpg' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--script src="../js/gestion.js"></script-->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
        <![endif]-->
</head>
<!---------------------------------------------->
<body class="body" style=" background-image: url(../images/bgcity.jpg);
  background-attachment: fixed;">
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
</h5></p>
 </div></td>

</tr>

</table>
<nav class="navbar navbar-default">
<div class="container-fluid">

<div class="collapse navbar-collapse" id="navbar-1">
 <ul class="nav navbar-nav">
 <li class="dropdown">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">INICIO<span class="caret"></span></a>
    <ul class="dropdown-menu">
    <li><a href="../views/frmMenuUsuarios.php">Menú</a>
    </li>
   </ul>
 </li>
 </ul>
 </div>
 </div>
 </nav>
<script> 
function criterios(){ 
    if(document.form1.bp.checked == true){ 
        document.form1.bsprod.disabled = false; 
    } 
    else{ 
        document.form1.bsprod.disabled = true; 
    } 
    if(document.form1.bf.checked == true){ 
        document.form1.bddesde.disabled = false;
        document.form1.bdhasta.disabled = false; 
    } 
    else{ 
        document.form1.bddesde.disabled = true; 
        document.form1.bdhasta.disabled = true;
    } 
     if(document.form1.bfp.checked == true){ 
        document.form1.aleatoriod.disabled = false; 
        document.form1.aleatorioh.disabled = false;
    } 
    else{ 
        document.form1.aleatoriod.disabled = true; 
        document.form1.aleatorioh.disabled = true; 
    } 
    if(document.form1.bpr.checked == true){ 
        document.form1.nroprovd.disabled = false;
        document.form1.nroprovh.disabled = false; 
    } 
    else{ 
        document.form1.nroprovd.disabled = true; 
        document.form1.nroprovh.disabled = true;
    } 

    if(document.form1.bOC.checked == true){ 
        document.form1.nocd.disabled = false;
        document.form1.noch.disabled = false; 
    } 
    else{ 
        document.form1.nocd.disabled = true; 
        document.form1.noch.disabled = true;
    } 
    if(document.form1.bPM.checked == true){ 
        document.form1.npmd.disabled = false;
        document.form1.npmh.disabled = false; 
    } 
    else{ 
        document.form1.npmd.disabled = true; 
        document.form1.npmh.disabled = true;
    } 

} 
</script> 
<script>
function numeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8){
        return true;
    }
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
   return patron.test(tecla_final);
}
</script>   
</header>
<!---------------------------------------------->
<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 10px solid #ffffff;"><br>
<form  id="form1" name="form1" method="post" action="../Logica/ProcesarConGestCom.php">
 <strong><div class="col-md-10" align="center">Seleccione Criterio de Consulta</div></strong>
 <br><br>
 <div class="row">
 <strong><div class="col-md-3">Por Nombre de Proveedor</div></strong>
 <div class="col-md-1"><input type="checkbox" name="bp" onclick="criterios()"></div>
 <div class="col-md-7"><strong><input type="text" placeholder="Ingrese Nombre Proveedor" id="bsprod" name="bsprod" disabled="true" style="width:75%" /></strong>
 </div></div>
 <br>
 <div class="row">
  <strong><div class="col-md-3">Por Fecha de Pedido Electrónico</div> </strong>
  <div class="col-md-1"><input type="checkbox" name="bf" onclick="criterios()"></div>
  <div class="col-md-3"><input type="date" id="bddesde" name="bddesde" disabled="true" />&nbsp&nbsp&nbspHasta</div>
  <div class="col-md-3"><input type="date" id="bdhasta" name="bdhasta" disabled="true"/></div><br><br>
  </div><br>
 <div class="row">
  <strong><div class="col-md-3">Por Pedido Electrónico Efectuado</div> </strong>
  <div class="col-md-1"><input type="checkbox" name="bfp" onclick="criterios()"></div>
  <div class="col-md-3"><input type="text" placeholder="Id.Aleatorio del Pedido" id="aleatoriod" name="aleatoriod" disabled="true" style="width:70%" onkeypress="return numeros(event)"/>&nbsp&nbsp&nbspHasta</div>
  <div class="col-md-3"><input type="text" placeholder="Id.Aleatorio del Pedido" id="aleatorioh" name="aleatorioh" disabled="true" style="width:70%" onkeypress="return numeros(event)"/></div>
  
  </div><br>
 <div class="row">
  <strong><div class="col-md-3">Por Nro.de Proveedor</div> </strong>
  <div class="col-md-1"><input type="checkbox" name="bpr" onclick="criterios()"></div>
   <div class="col-md-3"><input type="text" placeholder="Ingrese Nro.de Proveedor" id="nroprovd" name="nroprovd" disabled="true" style="width:75%" onkeypress="return numeros(event)"/>&nbsp&nbsp&nbspHasta</div>
   <div class="col-md-3"><input type="text" placeholder="Ingrese Nro.de Proveedor" id="nroprovh" name="nroprovh" disabled="true" style="width:75%" onkeypress="return numeros(event)"/></div>
 </div>
<br>
 <div class="row">
  <strong><div class="col-md-3">Por Nro.de O.C(Dpto.Compras)</div> </strong>
  <div class="col-md-1"><input type="checkbox" name="bOC" onclick="criterios()"></div>
   <div class="col-md-3"><input type="text" placeholder="Ingrese Nro.de O.C" id="nocd" name="nocd" disabled="true" style="width:75%" onkeypress="return numeros(event)"/>&nbsp&nbsp&nbspHasta</div>
   <div class="col-md-3"><input type="text" placeholder="Ingrese Nro.de O.C" id="noch" name="noch" disabled="true" style="width:75%" onkeypress="return numeros(event)"/></div>
 </div><br>
 <div class="row">
  <strong><div class="col-md-3">Por Nro.de Pedido de Material(Dpto.Compras)</div> </strong>
  <div class="col-md-1"><input type="checkbox" name="bPM" onclick="criterios()"></div>
   <div class="col-md-3"><input type="text" placeholder="Ingrese Nro.de Pedido" id="npmd" name="npmd" disabled="true" style="width:75%" onkeypress="return numeros(event)"/>&nbsp&nbsp&nbspHasta</div>
   <div class="col-md-3"><input type="text" placeholder="Ingrese Nro.de Pedido" id="npmh" name="npmh" disabled="true" style="width:75%" onkeypress="return numeros(event)"/></div>
 </div>
 
 <br>
 <div class="row">
 <div class="col-md-4"></div>
 <div class="col-md-2"><input type="submit" name="Submit" value="CONSULTAR" /></div>
 <div class="col-md-2"><input type="reset" /></div>
 </div>
 
</form>
    <br>

</div>
  
<br><br>      
<small> 
<div class="row" style="height:120px; background-color:#151515;color:#ffffff; font-family:Arial;font-size:8pt;">
<div class="col-md-12" align="center">
    <p>Municipalidad de Resistencia<br />
    Av. Italia Nº 150<br />
    Telefono de Informes: (362) 4458201</p>
    <p>Todos los derechos reservados &copy; 2016<br />
      Se permite la reproduccion del contenido<br />
      citando la fuente
    </p>
  </div>
</div>
</small>
</body>
</html>
