<?php 
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Mesa de Entradas Secretaria</title>
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
</h5></p></div></td>
</tr></table>
 <nav class="navbar navbar-default">
<div class="container-fluid">
<div class="collapse navbar-collapse" id="navbar-1">
 <ul class="nav navbar-nav">
 <li class="dropdown">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">INICIO<span class="caret"></span></a>
    <ul class="dropdown-menu">
    <li><a href="../views/frmMenuUsuarios.php">MENU</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>
<form id="form1" name="form1" method="post" action="../Logica/AltaME.php" onsubmit="return chkBC(this)">
<h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php 
       if(isset($respuesta))
      echo $respuesta;?></strong></h4>    
<!--==============================content================================-->
<script>
function numeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==46){
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
<strong><div class="col-md-2" align="left" >(*)NRO.TRAMITE:</div></strong>
<div class="col-md-1" align="left">
<?php include "../Conexion/Conexion.php";
      $nrof=0; $tot=0;$conexion=Conectarse();
      $query="SELECT nrome FROM mesaentrada order by nrome desc limit 1;";
      $result =mysqli_query($conexion,$query);
      $tot=mysqli_num_rows($result);
      if($tot!=0){
       $row = @mysqli_fetch_array($result);
       $nrof=$row['nrome']+1;
       }else{$nrof=1;}
    
	  mysqli_free_result($result);mysqli_close($conexion);
 echo "<input type='text' style='color:Red;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100% ' readonly='readonly' value='".$nrof."'>";
?>
</div></div><br>
<div class="row"><div class="col-md-1"></div>
<strong><div class="col-md-2" align="left" >(*)TIPO DE TRAMITE:</div></strong>
<div class="col-md-1" align="left" style="width:5%;">:</div></strong>
  <div class="col-md-2">
  <select name="ttram" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>PEDIDO CERTIFICACION</option>
    <option value='2'>PEDIDO MATERIALES</option>
    <option value='3'>PEDIDO LIQUIDACION</option>
	<option value='4'>PEDIDO DE AUDIENCIA</option>
  <option value='5'>ENVIO DOCUMENTOS</option>
  </select>
</div><div class="col-md-1" align="left" style="width:10%;">:</div></strong>
<strong><div class="col-md-1" align="left" >(*)LETRA:</div></strong>
  <div class="col-md-1">
  <select name="letra" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>P</option>
    <option value='2'>M</option>
    <option value='3'>R</option>
	<option value='4'>C</option>
	<option value='5'>S</option>
	<option value='6'>Sin Letra</option>
  </select>
</div>
<div class="col-md-1" align="left" style="width:10%;">:</div></strong>
<strong><div class="col-md-1" align="left" >(*)AÑO:</div></strong>
  <div class="col-md-1">
  <select name="aniot" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>2016</option>
    <option value='2'>2015</option>
    <option value='3'>2014</option>
	 </select>
</div></div><br>
<div class="row">
   <div class="col-md-1"></div>
   <strong><div class="col-md-1" align="left" >(*)DETALLE:</div></strong>
   <div class="col-md-7"><input name="detalle" type="text" id="detalle" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:110%" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" required="required"/></div>
</div><br>
<div class="row">
<div class="col-md-1"></div>
	<strong>
  <div class="col-md-1" align="left" >(*)DESTINATARIO:</div></strong>
  <div class="col-md-1" align="left" style="width:5%;">:</div></strong>
  <div class="col-md-4">
  <select name="sec" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>SECRETARIO ECONOMIA</option>
    <option value='2'>SUB.HACIENDA Y PRESUPUESTO</option>
    <option value='3'>SUB.FINANZAS E INGRESOS PUBLICOS</option>
    <option value='4'>COORDINACION TRIBUTARIA</option>
  </select>
  </div>
   </div>
  <br> 
  <div class="row">
<div class="col-md-1">	</div>
  
	<strong>
  <div class="col-md-1" align="left" >(*)ESTADO:</div></strong>
  <div class="col-md-1" align="left" style="width:5%;">:</div></strong>
  <div class="col-md-4">
  <select name="esta" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>INGRESADO</option>
   </select>
  </div>
  </div>
    <br>
 <br><br>
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