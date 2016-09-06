<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Modificar Formularios Presentados</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/myjava4.js"></script>
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

</header>
<!---------------------------------------------->

<body>

    <div class="registros" id="agrega-registros">
        <table class="table table-striped table-condensed table-hover">
         <tr>
          <th width="80">AÑO</th> 
          <th width="80">FORMULARIO</th>
          <th width="200">NRO.PROVEEDOR</th>
          <th width="150">RAZON SOCIAL</th>
          <th width="500">MONTO RECLAMADO</th>
          <th width="80">PAGOS RECIBIDOS</th>
          <th width="80">TOTAL DEUDA</th>
          <th width="150">OBSERVACIONES</th>
          <th width="20">Opcion</th>
         </tr>
          <?php
            include "../Conexion/Conexion.php";
            $conexion=Conectarse();
            $queryu="SELECT * FROM resumensg ORDER BY anioform desc, nroform desc";
            $registro = mysqli_query($conexion,$queryu); 
            while($registro2 = mysqli_fetch_array($registro)){
                echo '<tr>
                        <td>'.$registro2['anioform'].'</td>
                        <td>'.$registro2['nroform'].'</td>
                        <td>'.$registro2['nroprov'].'</td>
                        <td>'.$registro2['razonsocial'].'</td>
                        <td>'.$registro2['montoreclamado'].'</td>
                        <td>'.$registro2['pagosrecibidos'].'</td>
						<td>'.$registro2['totaldeuda'].'</td>
                        <td>'.$registro2['observaciones'].'</td>
                        <td><a href="javascript:editarFSG('.$registro2['idresumensg'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a
						href="javascript:eliminarFSG('.$registro2['idresumensg'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>

                    </tr>';       
            }
        ?>
       </table>
    </div>
    <br>
    <!-- MODAL PARA EL REGISTRO DE REUNIONES-->
<div class="modal fade" id="registra-reunion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><b>Modificar Formularios Presentados</b></h4>
   </div>
   <form id="formulario" class="formulario" onsubmit="return agregaRegistro();">
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
     <td>MONTO RECLAMADO $: </td>
     <td><input type="text" required="required" name="montor" id="montor"/></td>
     </tr>
	 <tr>
     <td>PAGOS PARCIALES RECIBIDOS $: </td>
     <td><input type="text" required="required" name="pr" id="pr"/></td>
     </tr>
	 <tr>
     <td>TOTAL DEUDA $: </td>
     <td><input type="text" required="required" name="td" id="td"/></td>
     </tr>
	 <tr>
     <td>OBSERVACIONES: </td>
     <td><input type="text" required="required" name="obs" id="obs"/></td>
     </tr>
     <tr>
     <td colspan="2">
      <div id="mensaje"></div>
     </td>
     </tr>
 </table>
</div>
<div class="modal-footer">
 <input type="submit" value="Confirmar" class="btn btn-warning"  id="edi"/>
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
