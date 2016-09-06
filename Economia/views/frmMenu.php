<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header("Location:../views/index.php?nologin=false");}
$_SESSION["usuario"];
$_SESSION["razonsocial"];$_SESSION["nroprov"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Municipalidad de Resistencia</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<!--link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen"-->
<link rel="stylesheet" type="text/css" href="../css/nav-menu.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/device.min.js" type="text/javascript"></script>

<script src="../js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="../js/custom.js" type="text/javascript"></script>
<link href='../images/icono.jpg' rel='shortcut icon' type='image/jpg'/>
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
 <link href="../css/estilos-formularios.css" rel="stylesheet">
<!---------------------------------------------------------------------------------------------  <!--   <script src="js/validarCampos.js" type="text/javascript"></script> -->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
![endif]-->
</head>
<body >
<main class="text-center">    
    <section class="well1">
      <div class="margin-header container">
   <!--========header==========================-->
<header class="text-center" data-url="../images/2-2.jpg" data-mobile="true" data-color="#dee7eb" data-speed="3">
<!------------------------------------------>
 <div id=" container" class="stuck_container">
   <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12">                  
    <nav class="navbar navbar-default"> <br>
<h1 class="col-md-12 logo">
<a href="/index.php"><img class="img-float img-responsive" src="../images/logo-municipio.png" alt="logo" /><!--texto--></a>
<div class="separador"><img class="img-float" src="../images/separador-logos.png" alt="logo"/></div>
<img class="img-float img-responsive logo-economia" src="../images/logo-economia.png" alt="logo" />


<div class="fecha" style="color:#ffffff;">
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
</script></h5></p></div></h1>
<!--div align="right" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["usuario"]?>-PROVEEDOR:<?php echo $_SESSION["razonsocial"]?></h4></p>
 </div-->
<div class="nav-margin nav-shadow"></div></nav></div></div></div>   
<div id="navigation">
 <ul>
  <li class="active float-left"><a class="active" href="../views/frmLogin.php">inicio</a>  
  </li>
 </ul>
 <ul>
  <li class="float-left"><a href="#">Instructivos</a>
  <ul class="dropdown-content">
    <li><a href="../images/InstructivoEmergencia.pdf"  target="new">Emergencia Económica</a></li>
	<li><a href="../images/InstructivoCompensacion.pdf"  target="new">Solicitud de Compensaciones</a></li>
  </ul>
  </li>
 </ul>

<ul>
  <li class="float-left"><a href="#">PREINSCRIPCION</a>
  <ul class="dropdown-content">
    <li><a href="../views/frmProveedoresInscrip.php">Pre</a></li>
  
  </ul>
  </li>
 </ul>





 <ul>
 <li class="float-left"><a href="#">Datos Personales</a>
  <ul class="dropdown-content">
    <li><a href="../views/frmAltaProveedor.php">Alta de Datos Personales de Acreedores</a></li>
    <li><a href="../views/frmModiProveedor.php">Modificacion de Clave de Usuario</a></li>
    <li><?php include "../Conexion/Conexion.php";$np=$_SESSION["nroprov"];
         $conexion=Conectarse();$query="SELECT estado FROM usuarios WHERE nroprov = '".$np."'";
         $result =mysqli_query($conexion,$query);
         if($row = mysqli_fetch_array($result))
           {if($row["estado"] == 'P')  
             {echo "COMPLETAR SUS DATOS PERSONALES PARA COMPENSACIONES";
         ?>
         <?php } 
         else{?><a href="../views/frmProvCompensa.php">Alta de Datos para Compensación</a><?php } } ?></li>
    <li><?php
           $query="SELECT estado FROM usuarios WHERE nroprov = '".$np."'";
           $result =mysqli_query($conexion,$query);
             if($row = mysqli_fetch_array($result))
                {if($row["estado"] == 'P')  
                  {
                  echo "NO PUEDE MODIFICAR DATOS NO CARGADOS";
                ?>
            <?php } 
             else{?><a href="../views/frmModDatosProveedor.php">Modificacion de Datos de Proveedores</a><?php } } ?></li>
  </ul>
 </li>
 </ul>
 <ul>
  <li class="float-left"><a href="#">Trámites</a>
   <ul class="dropdown-content">
    <li><li><?php
           $query="SELECT estado FROM usuarios WHERE nroprov = '".$np."'";
           $result =mysqli_query($conexion,$query);
             if($row = mysqli_fetch_array($result))
                {if($row["estado"] == 'P')  
                  {
                  echo "DEBE COMPLETAR SUS DATOS PERSONALES PRIMERO";
                ?>
            <?php } 
             else{?>
             <a href="../views/frmFacturasSG.php">Sin Sentencia Firme</a>
           <?php } } ?></li>
    <li><?php $np=$_SESSION["nroprov"];
           $query="SELECT estado FROM usuarios WHERE nroprov = '".$np."'";
           $result =mysqli_query($conexion,$query);
             if($row = mysqli_fetch_array($result))
                {     
                  if($row["estado"] == 'P')  
               {
             echo "COMPLETAR DATOS PARA COMPENSACIONES";
               ?>
            <?php } 
             else{?>
             <a href="../views/frmCompensacion.php">Pedido de Compensación de Deuda</a>
           <?php } } ?></li>                    
   </ul>
  </li>
  </ul>
 <ul>
  <li class="float-left"><a href="#">Listados</a>
   <ul class="dropdown-content">
     <li><?php
           $np=$_SESSION["nroprov"];
           $query="SELECT estado FROM usuarios WHERE nroprov = '".$np."'";
           $result =mysqli_query($conexion,$query);
             if($row = mysqli_fetch_array($result))
                {     
                if($row["estado"] == 'P')  
               {
             echo "DEBE COMPLETAR SUS DATOS PERSONALES PRIMERO";
               ?>
            <?php } 
             else{?>
             <a href="../views/frmListFacturasSG.php">Listar Comprobante de Reclamo Sin Sentencia Firme</a>
           <?php } } ?></li>
     <li><?php
           $np=$_SESSION["nroprov"];
           $query="SELECT estado FROM usuarios WHERE nroprov = '".$np."'";
           $result =mysqli_query($conexion,$query);
             if($row = mysqli_fetch_array($result))
                {     
                if($row["estado"] == 'P')  
               {
             echo "DEBE COMPLETAR SUS DATOS PERSONALES PRIMERO";
               ?>
            <?php } 
             else{?>
             <a href="../views/frmListDocCompensa.php">Listar Comprobante de Pedido de Compensaciones</a>
           <?php } } ?></li>
   </ul>
  </li>
 </ul>
 </div></header>
<!--CONTENIDO-->
<div class="row">
 <h3 class="col-md-7 col-sm-10 col-md-offset-3">
 <img class="img-responsive" src="../images/horarios.png" height="318px">
 </h3>
</div><!--FIN CONTENIDO-->
<!--=============content===========-->
 </div>

    </section>

  </main>

  <!--==========footer=================================-->
 <footer>  
    
    <section>      
      <div class="container-footer">
        <div class="row">
                
                <!-- Dirección y Núm -->
                <div class="col-md-4">
                    <div class="footer-headline"><h4>Dirección y Número de Contacto</h4></div>
                    <p>Municipalidad de Resistencia Av. Italia Nº 150 <br> Teléfono de Informes: (362) 4458201.</p>
                    <img src="../images/logo-municipio-verde.png" class="client-logo-footer">
                </div>

                

                <!-- Donde Estamos? -->
                <div class="col-md-5">
                    <div class="footer-headline"><h4>Como Llegar?</h4></div>
                    <div id="mapa">
                    <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1770.2446438431818!2d-58.981944791755865!3d-27.4540227949245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94450cf1aba11591%3A0x14f9437cf41fbd30!2sAv.+Italia+150%2C+H3500CJO+Resistencia%2C+Chaco!5e0!3m2!1ses!2sar!4v1460757666099"
                     width="100%" height="" frameborder="0" style="border:0" allowfullscreen>
                    </iframe>
                    </div>
                </div>

        </div>
      
      </div> 
    </section> 

  </footer>
            <div id="container-footer" class="container" style="background: #111;">
              <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom">
                        Todos los derechos reservados. © 2016 Se permite la reproducción del contenido citando la fuente.<a href="#"></a>

                            <div id="scroll-top-top"><a href="#" title="Volver al inicio"></a></div>
                        </div>
                    </div>
                </div>
            </div>

  </div>

  <script src="../js/bootstrap.min.js"></script>
    <script src="../js/tm-scripts.js"></script>    
 


  </body>
</html>