<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/index.php?nologin=false");}
$_SESSION["nivel"];$_SESSION['secretaria'];
$_SESSION["dni"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Municipalidad de Resistencia</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/nav-menu.css">
<link rel="stylesheet" type="text/css" href="../css/nav-lg.css">
<!--link href="../css/bootstrap.css" rel="stylesheet"-->
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href="../css/estilos-formularios.css" rel="stylesheet">
<script src="../js/jquery.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/custom.js"></script>
<link href='../images/icono.jpg' rel='shortcut icon' type='image/jpg'/>
<script src="../js/device.min.js"></script>
<!---------------------------------------------------------------------------------------------  <!--   <script src="js/validarCampos.js" type="text/javascript"></script> -->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
![endif]-->
</head>
<body>
<main class="text-center">    
    <section class="well1">
      <div class="margin-header container">

   <!--========header==========================-->
<header class="text-center" data-url="../images/2-2.jpg" data-mobile="true" data-color="#dee7eb" data-speed="3">
<!------------------------------------------>
<!--div align="left" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["apynom"]?></h4></p>
 </div-->
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
<div class="nav-margin nav-shadow"></div></nav></div></div></div>
<div id="navigation">
<ul><li class="active float-left"><a class="active" href="../views/frmLoginUs.php">inicio</a></li></ul>
<ul><li class="float-left"><a href="#">INSTRUCTIVOS</a>
  <ul class="dropdown-content">
    <li><a href="../images/InstructivoPedidoMateriales.pdf"  target="new">Pedido de Materiales</a></li>
   </ul>
  </li></ul>
<?php $level=$_SESSION['nivel'];
   if($level==0||$level==10||$level==99){?>
<ul>
 <li class="float-left">
   <a href="#">MESA DE ENTRADAS</a>
 <ul class="dropdown-content">
  <li><a href="../views/frmAltaEx.php">Alta de Clave Proveedores</a></li>
  <li><a href="../views/frmGenerarFormulario.php">Generar Formulario Acreedores Sin Gestión Judicial</a></li>
  <li><a href="../views/frmModificarFormulario.php">Modificar Formulario Acreedores Sin Gestión Judicial</a></li>
  <li><a href="../views/frmGenFormCompensa.php">Generar Formulario para Compensacion de Deuda</a></li>
  <li><a href="../views/frmModiEstadoCompensa.php">Modificar Estado de Compensacion de Deuda</a></li>
  <li><a href="../views/frmGenerarFormularioCG.php">Generar Formulario Acreedores Con Gestión Judicial</a></li>
 </ul>
 <?php }?></li>
</ul>
<ul>
 <li class="float-left"><a href="#">PEDIDO DE MATERIALES</a>
 <ul class="dropdown-content">
 <?php $level=$_SESSION['nivel'];
       if($level==1||$level==2||$level==10||$level==99){?>
      <li><a href="../views/frmPedidosMateriales.php">Carga de Pedido de Materiales</a>
      </li>
      <li><a href="../views/frmModificarPedMat.php">Modificar Pedido de Materiales efectuado</a>
      </li> <?php }?>
      <?php $level=$_SESSION['nivel'];
       if(($level!=0)&&($level!=3)){?>
      <li><a href="../views/frmConsultaPedMat.php">Consulta de Estado de Pedido de Materiales</a>
      </li><?php }?>
       <?php $level=$_SESSION['nivel'];
       if($level>2){?>
      <li><a href="../views/frmConGestCom.php">Seguimiento de Pedido de Materiales</a>
      </li>
    <?php }?>
    <?php $level=$_SESSION['nivel'];
       if($level==10||$level==12||$level==11||$level==99){?>
        <li><a href="../views/frmAutorizaPedMat.php">Autorización de Pedido de Materiales</a>
         </li>
      <?php }?>
      <li><?php $level=$_SESSION['nivel'];
        if($level==1||$level==2||$level==10||$level==11||$level==99){?>
          <a href="../views/listaPedidosMateriales.php" target="blank" >Listar Ultimo Pedido de Materiales Cargado</a>
        </li>
      <li><a href="../views/frmReimpresionPedMat.php">Reimpresion de Pedidos de Materiales</a>
         <?php }?></li> 
         <li><?php $level=$_SESSION['nivel'];
         if($level==10||$level==12||$level==99){?>
         <a href="../views/frmR2PedMat.php">Reimpresion de Pedidos de Materiales por Secretaria </a>
         <?php }?></li>
       <li><?php $level=$_SESSION['nivel'];
         if($level==10||$level==12||$level==99){?>
         <a href="../views/frmAreaPedido.php">Areas con Pedidos</a>
         <?php }?></li>
         <li><?php $level=$_SESSION['nivel'];
         if($level==3||$level==99){?>
         <a href="../views/frmGestionCompras.php">Gestión Compras</a>
         <?php }?></li>


    <?php $level=$_SESSION['nivel'];
       if($level==99){?>
      <li><a href="../views/frmElimCabecera.php">Eliminar Cabecera de Pedido de Materiales</a>
      </li>
      <li><a href="../views/frmElimDetalle.php">Eliminar Detalle Pedido de Materiales</a>
      </li>
      <li><a href="../views/frmCabeceraGestion.php">Excepcion Gestion Compra</a>
      </li>
       <?php }?>
    </ul>
 </li>
</ul>
<ul>
<li class="float-left"><a href="#">HORAS EXTRAS</a>
 <ul class="dropdown-content">
  <?php $level=$_SESSION['nivel'];
   if($level==10||$level==99){?>
   <li><a href="../views/frmConfigGrupoCobro.php">Configurar Grupos de Cobro</a></li>
   <li><a href="../views/frmConfigCatEmp.php">Configurar Categorias de Empleados</a></li>
   <li><a href="../views/frmConfigMotHas.php">Configurar Motivos de Horas Extras</a></li>
   <li><a href="../views/frmConfigPerHas.php">Configurar Periodos de Horas Extras</a></li>
   <li><a href="../views/frmAltaLegajos.php">Alta de Legajos de Personal</a></li>
   <?php 
   }
       if($level==1||$level==2||$level==10||$level==99){?>
      <!--li><a href="../views/frmSolicitudHE.php">Solicitud de Horas Extras</a></li>
      <li><a href="../views/frmModificarPedMat.php">Modificar Solicitud de HS.EX.</a>
      </li> <?php }?>
      <?php $level=$_SESSION['nivel'];
       if($level!=0){?>
      <li><a href="">Consulta de Estado de Solicitud de HS.EX.</a>
      </li>
    <?php }?>
    <?php $level=$_SESSION['nivel'];
       if($level==10||$level==12||$level==11||$level==99){?>
        <li><a href="">Autorización HS.EX.</a>
         </li-->

      <?php }?></ul>
</li>
</ul>

<ul>
<li class="float-left"><?php $level=$_SESSION['nivel'];
   if($level==1||$level==10||$level==99){?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">PRIVADA
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="../views/frmAltaME.php">Ingreso de Trámites</a></li>
      <li><a href="../views/frmModME.php">Modificación de Estado de Trámite</a></li>
     <li><a href="../views/frmListaME.php">Listado Diario de Trámites por Area</a>
        </li>
    </ul><?php }?>
</li>
</ul>
<ul>
 <li class="float-left"><a href="#">USUARIOS</a>
  <ul class="dropdown-content">
  <li><?php $level=$_SESSION['nivel'];
         if($level==10||$level==99){?>
     <a href="../views/frmAltaUser.php">Alta de Usuarios del Sistema
     </a>
     <?php }?>
     </li>
     <li><?php $level=$_SESSION['nivel'];
         if($level==10||$level==99){?>
     <a href="../views/frmAltaUser2.php">Modificación de Permisos de Usuarios del Sistema
     </a>
     <?php }?>
     </li>
      <li><a href="../views/frmModiCUsuario.php">Cambio de Clave Usuarios del Sistema</a></li>
     <!--li><?php $level=$_SESSION['nivel'];
         if($level==10||$level==99){?>
     <a href="">Baja de Usuarios del Sistema</a>
     <?php }?>
     </li--> </ul>
 </li>
</ul>
<ul>
 <li class="float-left"><?php $level=$_SESSION['nivel'];
  if($level==10||$level==12||$level==99){?>
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">REPORTES<span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="../views/frmBDP.php">Datos Proveedores</a></li>
   <li><a href="../views/frmMoPrPr.php">Montos Adeudados por Proveedor Presentados</a></li>
   <li><a href="../views/frmMoPrNPr.php">Montos Adeudados por Proveedor No Presentados</a></li>
   <li><a href="../views/frmMoComp.php">Montos Solicitados por Proveedor para Compensar</a></li>
   <li><a href="../views/expdetalleMontoCompensa.php">Detalle de Pedidos de Compensacion</a></li>
   <li><a href="../views/explistaDetalle.php">Detalle de Anexo I</a></li>
   <li><a href="../views/explistaMontoJudic.php">Demandas Presentadas</a></li>
</ul><?php }?>
</li>
</ul>
<ul>
 <li class="float-left"><?php $level=$_SESSION['nivel'];
  if($level==99){?>
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">CONFIGURACION<span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="../views/frmConfigSec.php">Configurar Secretarias</a></li>
   <li><a href="../views/frmConfigSSec.php">Configurar Sub-Secretarias</a></li>
   <li><a href="../views/frmConfigDg.php">Configurar Dcciones Grales</a></li>
   <li><a href="../views/frmConfigRubros.php">Configurar Rubros</a></li>
   <li><a href="../views/frmConfigSRubros.php">Configurar Subrubros</a></li>
   <li><a href="../views/frmConfigDemandas.php">Configurar demandas</a></li>
   <li><a href="../views/frmConfigAbogados.php">Configurar abogados</a></li>
   </ul><?php }?>
</li>
</ul>


</div>
</header>
  <!--CONTENIDO-->
<div class="row">
<h3 class="col-md-7 col-sm-10 col-md-offset-3">
<img class="img-responsive" src="../images/horarios.png" height="318px">
</h3>
</div>
<!--FIN CONTENIDO-->
</div>
</section>
</main>

  <!--========================================================
                            FOOTER
  =========================================================-->

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

