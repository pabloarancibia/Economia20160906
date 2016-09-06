<?php 
/*session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Alta de Usuarios del Sistema</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<link rel="stylesheet" href="../css/estilo.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
        <![endif]-->
</head>
<body class="body" style="background-image: url(../images/bgcity.jpg);
  background-attachment: fixed;">
   <!--========header==========================-->
<header>
<table width="100%" height="120" border="0" background="../images/header2015.jpg">
<tr><td width="40%"></td>
<td><div align="left" style="color:#ffffff;" ><p><h2>SECRETARIA DE ECONOMIA</h2></p>
 </div></td>
</tr>
<tr><td width="40%"></td>
<!--td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["apynom"]?></h4></p>
 </div></td-->
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
    <li><a href="../views/frmMenuUsuarios.php">Página Principal</a></li>
   </ul>
 </li>
 </ul>
 </div>
 </div>
 </nav>
</header>
<form id="form1" name="form1" method="post" action="../Logica/AltaUser2.php" onsubmit="return chkBC(this)">
<h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php 
       if(isset($respuesta))
      echo $respuesta;?></strong></h4>    
 
 <!--==============================content================================-->
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

<div class="container-fluid" align="center" style="background-color:#D8D8D8;">
<br>
<div class="row">
<div class="col-md-1"></div>
<strong><div class="col-md-1" align="left" >(*)D.N.I:</div></strong>
<div class="col-md-1" align="left">
<input name="dni" id="dni" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%' onkeypress="return numeros(event)" required="required" />
</div><div class="col-md-1"></div>

</div>
<br>
<div class="row">
   <div class="col-md-1"></div>
   <strong>
  <div class="col-md-1" align="left" style="width:10%;">(*)Nivel:</div></strong>
  <div class="col-md-1">
  <select name="nivel" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='0'>OPERADOR MESA DE ENTRADA</option>
    <option value='1'>OPERADOR PRIVADA</option>
    <option value='2'>PEDIDOS PLANIFICACION</option>
    <option value='3'>PEDIDOS DESARROLLO</option>
    <option value='4'>PEDIDOS AMBIENTE</option>
    <option value='5'>PEDIDOS OBRAS PUBLICAS</option>
    <option value='6'>PEDIDOS SECRETARIA GRAL.</option>
    <option value='7'>PEDIDOS GOBIERNO</option>
    <option value='8'>PEDIDOS CULTURA</option>
    <option value='9'>PEDIDOS CONSEJO</option>
    <option value='10'>SEGUIMIENTO ECONOMIA</option>
    <option value='11'>SECRETARIO MUNICIPAL</option>
    <option value='12'>MAIA</option>
	<option value='13'>PEDIDOS ECONOMIA</option>
    <option value='14'>USUARIO HS.EX</option>
	<option value='15'>RECEPCION ECONOMIA</option>
	<option value='16'>SEC-SUBSECRETARIA</option>
    <!--option value='99'>A</option-->
    
    </select>
  </div>
    <div class="col-md-1"></div>
   <strong>
  <div class="col-md-1" align="left" style="width:10%;">(*)Secretaria:</div></strong>
  <div class="col-md-3">
  <select name="secre" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='0'>MESA DE ENTRADA</option>
    <option value='1'>PRIVADA ECONOMIA</option>
    <option value='2'>SEC.PLANIFICACION</option>
    <option value='3'>SEC.DESARROLLO</option>
    <option value='4'>SEC.AMBIENTE</option>
    <option value='5'>SEC.ESP.PUBLICO</option>
    <option value='6'>SEC.GRAL.</option>
    <option value='7'>SEC. GOBIERNO</option>
    <option value='8'>SEC. CULTURA</option>
    <option value='9'>SEC. CONSEJO</option>
    <option value='10'>SEC.ECONOMIA</option>
    <option value='11'>DPTO.COMPRAS</option>
   </select>
  </div>  
   </div>
  <br> 
   <br> 
 <br>
  
 </div>
 <br>
  
</div>
 <div class="row">
 <div class="col-md-1"></div>
 <div class="col-md-3"><strong><h5 align="center" style="color:red;width:90%;"><strong>(*)CAMPOS OBLIGATORIOS</strong></h5>   
   </div>

 <div class="col-md-2"><input type="submit" name="Submit" value="GUARDAR" /></div>
 <div class="col-md-2"><input type="reset" /></div>
   
 </div>
 </div>  
</div>
</div>

</form>

<br><br><br><br><br><br><br><br><br><br>
<!--==============================footer=================================-->
<footer>
<small> 
<div id="footer" class="col-md-12" align="center" style="background-color:#151515;color:#ffffff; font-family:Arial;font-size:8pt;">
    <p>Municipalidad de Resistencia-Av. Italia Nº 150<br />
    Telefono de Informes: (362) 4458201</p>
    <p>Todos los derechos reservados &copy; 2016-Se permite la reproduccion del contenido citando la fuente
    </p>
  </div>
</small></footer>
</body>  
</html>