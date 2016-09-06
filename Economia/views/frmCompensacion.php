<?php session_start();
if (!isset($_SESSION["usuario"])){
    header("Location:../views/index.php?nologin=false");}
$_SESSION["usuario"];
$_SESSION["razonsocial"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Carga de Documentos Con Gestion Judicial</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/myjava2.js"></script>

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
<td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["usuario"]?>-PROVEEDOR:<?php echo $_SESSION["razonsocial"]?></h4></p>
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
    <li><a href="../views/frmMenu.php">Menu</a></li>
   </ul>
 </li>
 </ul>
 </div>
 </div>
 </nav>

</header>
<!---------------------------------------------->
<script>
function numeros(e){
     key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
 if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
}
</script>   
<body>
 <section>
  <table border="0" align="center">
   <tr>
    <td width="100"><button id="nueva-compensacion" class="btn btn-primary">CARGAR DOCUMENTO</button></td>
   </tr>
  </table>
 </section>

    <div class="registros" id="agrega-compensacion">
        <table class="table table-striped table-condensed table-hover" >
         <tr>
         <th width="80">PROVEEDOR</th>
          <th width="150">SUJETO</th> 
          <th width="150">TRIBUTO</th>
          <th width="150">IMPORTE $</th>
          <th width="150">DOCUMENTO</th>
          <th width="50">Opc.</th>
         </tr>
         <tr>
          <td></td><td></td><td></td><td></td>
         <td></td>
         <td><a href="" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
         </tr>
        </table>

        <table class="table table-striped table-condensed table-hover">
         <tr>
          <td><h4>CANTIDAD DE DOCUMENTOS :</h4></td><td></td>
          <td><h4>TOTAL $:</h4></td><td></td>
         </tr>
        </table>
    </div>
    <br>
<section>
  <table border="0" align="center">
   <tr>
    <td width="100">
    <a href="../views/frmlistaFormCompensa.php" 
    class="btn btn-primary" target="_blank" role="button"
    >FINALIZA Y ENVIA</a>
    </td>
   </tr>
  </table>
 </section>

    
    <!-- MODAL PARA EL REGISTRO DE FACTURAS-->
<div class="modal fade" id="registra-compensacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita un Documento</b></h4>
   </div>
   <form id="formulario" class="formulario" onsubmit="return agregaCompensacion();">
   <div class="modal-body">
    <table border="0" width="100%">
    <tr>
    <td colspan="2">
    <input type="text" required="required" readonly="readonly" name="idf" id="idf" readonly="readonly" style="visibility:hidden; height:5px;"/>
    </td>
    </tr>
     <tr>
      <td width="150">Proceso: </td>
      <td><input type="text" required="required" readonly="readonly" id="pro" name="pro"/></td>
     </tr>
     <tr>
     <td>Proveedor: </td>
     <td><input type="text" required="required" name="bsprov" id="bsprov" maxlength="10" onkeypress="return numeros(event)"/></td>
     </tr>
     <tr>
     <td>Sujeto Pasivo: </td>
     <td><input type="text" required="required" name="bssujeto" id="bssujeto" maxlength="60"/></td>
     </tr>
     
     <tr>
     <td>Tributo: </td>
         <td><select required="required" name="tributo" id="tributo" maxlenght="23">
       <option value="1">PATENTE AUTOMOTOR</option>
       <option value="2">TASAS RETRIBUTIVAS DE SERVICIOS</option>
       <option value="3">IMPUESTO INMOBILIARIO</option>
       <option value="4">TASA DE REGISTRO, INSPECCION Y SERVICIOS CONTRALOR</option>
	   <option value="5">IMPUESTO A LA PUBLICIDAD Y PROPAGANDA</option>
	   <option value="6">IMPUESTO AL MAYOR VALOR DEL BIEN LIBRE DE MEJORAS</option>
	   <option value="7">TASA DE INSPECCION PARA HABILITACION DE LOCALES</option>
	   <option value="8">VENDEDORES EN VIA  Y ESPACIO PUBLICO</option>
	   <option value="9">TASA POR HABILITACION Y CONTROL DE ESPECTACULOS PUBLICOS</option>
	   <option value="10">DERECHO OCUPACION ESPACIO PUBLICO O PRIVADO MUNICIPAL</option>
	   <option value="11">DERECHO DE OFICINA</option>
	   <option value="12">DERECHO DE ABASTO, FERIAS Y/O MERCADOS</option>
	   <option value="13">SERVICIOS DE PROTECCION A LA SALUD</option>
	   <option value="14">DERECHOS DE CEMENTERIOS Y SERVICIOS FUNEBRES</option>
	   <option value="15">DERECHOS RELATIVOS A LA CONSTRUCCION Y EDIFICACION</option>
	   <option value="16">DERECHO POR FRACCIONAMIENTO DE TIERRAS,MENSURA,CATASTRO</option>
	   <option value="17">DERECHOS POR INSTALACIONES ELECTRICAS(VVDAS,ELECTROMECANICAS)</option>
	   <option value="18">LICENCIA DE CONDUCIR</option>
	   <option value="19">T.PUBLICO,REMOCION,ESTADIA,HABILITACION DE VEHICULOS</option>
	   <option value="20">RENTAS DIVERSAS</option>
	   <option value="21">CONTRIBUCION DE MEJORAS</option>
	   
		 
	       </select>
     </tr>
     <tr>
     <td>Importe $: </td>
     <td><input type="text" required="required" name="monto" id="monto" onkeypress="return numeros(event)" />
     </td></tr>
     <tr>
     <td>Documento: </td>
     <td><input type="text"  required="required" name="dcto" id="dcto" maxlength="40" />
     </td>
     </tr>
     <tr>
     <td colspan="2">
      <div id="mensaje"></div>
     </td>
     </tr>
 </table>
</div>
            
<div class="modal-footer">
 <input type="submit" value="Registrar" class="btn btn-success" id="regc"/>
 <input type="submit" value="Editar" class="btn btn-warning"  id="edic"/>
</div>
</form>
</div>
</div>
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
