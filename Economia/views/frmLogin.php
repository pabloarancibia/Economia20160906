<?php 
  session_start();
   if (! empty($_SESSION["usuario"])) 
    {
      unset($_SESSION["usuario"]); 
  unset($_SESSION["razonsocial"]);
  unset($_SESSION["nroprov"]);
  session_destroy();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Acceso al Sistema</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="icon" href="../images/favicon.png" type="image/x-icon">
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="../css/estilos-formularios.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.js" type="text/javascript"></script>		
<!---------------------------------------------------------------------------------------------  <!--   <script src="js/validarCampos.js" type="text/javascript"></script> -->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
 <![endif]-->
</head>
<body>
<div class="page">
<main class="text-center">
<section class="well1">
<div class="margin-header container">
   <!--========header==========================-->
<header class="text-center" data-url="../images/2-2.jpg" data-mobile="true" data-color="#dee7eb" data-speed="3">
<section class="">
<div id=" container" class="stuck_container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<nav class="navbar navbar-default"><br>
<h1 class="col-md-6 logo"><img class="img-float img-responsive" src="../images/logo-municipio.png" alt="logo"/>
<div class="separador"><img class="img-float" src="../images/separador-logos.png" alt="logo"/> </div>
<img class="img-responsive logo-economia" src="../images/logo-economia.png" alt="logo"/></h1>
<div class="margintop1 nav-shadow"></div>
<div align="right" style="color:#000000;">
<p><h4>
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
document.write("<small>  <font color='000000' face='Arial'>"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font></small>") 
</script> 
</h4></p></div></nav></div></div></div></section>
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
</script> </header>  
<section class="margintop">
<div class="row"><h3 class="col-md-10 col-sm-10 col-md-offset-1">
<b> ACCESO DE PROVEEDORES </b></h3></div></section>
 <div class="row" align="center"><div class="col-md-1"></div>
 <div class="col-md-6 col-sm-10 col-md-offset-3" align="center">
  <div class="col-md-6">
 <form class="form-horizontal" action="../Logica/Validar_usuario.php" method="post">
<!--============content================================-->
<div class="form-group" align="center">
<label  data-add-placeholder>
<input name="adminp" class="form-control " id="adminp" placeholder="Ingrese Nro. de Proveedor" type="text" onkeypress="return numeros(event)" required="required">
</label>
</div>
<div class="form-group" align="center">
<label data-add-placeholder>
<input name="admin" type="text" class="form-control" id="admin" placeholder="Ingrese Usuario" required="required">
</label>
</div>
<div class="form-group" align="center">
<label data-add-placeholder>
<input name="password_usuario" type="password" class="form-control" id="password_usuario" placeholder="Ingrese Clave" required="required">
</label>
</div></div></div></div>
<div class="row"><div class="col-md-1"></div>
 <div class="col-md-6 col-sm-6 col-md-offset-3">
 <div class="col-md-1"></div>
  <div class="col-md-6 col-sm-6" >
   <div class="margintop btn-float">
    <button class="btn btn-primary" type="submit">Iniciar sesion</button>
   </div>
   <div class="margintop btn-float" style="margin-left: 11px;">
   <button class="btn btn-primary" type="Button" value="Salir" onclick="history.back()">Salir</button></div>
  </div>
 </div></div>
</form></section><br><br><br><br><br><br></div>
</main></div></body>
<small> 
<div  align="center" style="width:100%; height:120px; background-color:#151515;color:#ffffff; font-family:Arial;font-size:8pt;">
    <p>Municipalidad de Resistencia<br />
    Av. Italia Nº 150<br />
    Telefono de Informes: (362) 4458201</p>
    <p>Todos los derechos reservados &copy; 2016<br />
      Se permite la reproduccion del contenido<br />
      citando la fuente
    </p>
  </div>
</small>

</html>
