<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];$_SESSION["secretaria"];
include "../Conexion/Conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Montos Presentados por Proveedor</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.jpg' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/gestion.js"></script>
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

<script>
function fncSumar(){
caja=document.forms["formulario"].elements;
var numero1 = Number(caja["montof"].value);
var numero2 = Number(caja["montop"].value);
resultado=numero1+numero2;
if(!isNaN(resultado)){
caja["totalf"].value=numero1-numero2;
}
}
</script>

<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 10px solid #ffffff;">
 <section>
  <table border="0" align="center">
   <tr>
   <td width="335"><input type="text" placeholder="Busca un Proveedor por: Nombre" id="bs-prod"/></td>
   <td width="170"><a target="_blank" href="javascript:reporteExcelN();" class="btn btn-info">EXCEL por Nombre</a></td>
   <td width="170"><a target="_blank" href="javascript:reportePDFN();" class="btn btn-warning">PDF por Nombre</a></td>
   <strong><td width="180">Presione F5 para ver todos.</td></strong>
   </tr>
   
  </table>
   <table border="0" align="center">
   <tr><td>&nbsp;</td></tr>
   <tr>
   <td width="120"><input type="date" id="bd-desde"/></td>
   <td width="50">Hasta</td>
   <td width="120"><input type="date" id="bd-hasta"/></td>
   <td width="150"><a target="_blank" href="javascript:reporteExcel();" class="btn btn-primary">EXCEL por Fecha</a></td>
   <td width="150"><a target="_blank" href="javascript:reportePDF();" class="btn btn-danger">PDF por Fecha</a></td>
   <strong><td width="180">Presione F5 para ver todos.</td></strong>
   </tr>
  
  </table>
 </section>
 <div class="registros" id="agrega-registros">
 <table class="table table-striped table-condensed table-hover">
  <tr>
  <th width="200">PROVEEDOR</th> 
  <th width="300">RAZON SOCIAL</th>
  <th width="200">PRESENTACION</th>
  <th width="100">FORMULARIO</th>
  <th width="100">AÑO</th>
  <th width="200">RECLAMADO $</th>
  <th width="200">PAGOS PARCIALES $</th>
  <th width="300">TOTAL DEUDA $</th>
  <!--th width="50">Opciones</th-->
 </tr>
 <?php
  $conexion=Conectarse();
  //$sql = "SELECT nroprov,razonsocial FROM acreedoreconomia where (razonsocial <> '') ORDER BY razonsocial ASC;";
  $sql="select * from resumensg order by totaldeuda desc ;";
  $resultado = mysqli_query ($conexion,$sql);
  $tmontof=0.00;$tpagp=0.00;$tmontot=0.00;$conteo=0;
  while($row = mysqli_fetch_array($resultado)) {
   echo'<tr>
  <td>'.$row['nroprov'].'</td>
  <td>'.$row['razonsocial'].'</td>
  <td>'.$row['fechapresenta'].'</td>
  <td align=right>'.$row['nroform'].'</td>
  <td align=right>'.$row['anioform'].'</td>
  <td align=right>'.$row['montoreclamado'].'</td>
  <td align=right>'.$row['pagosrecibidos'].'</td>
  <td align=right>'.$row['totaldeuda'].'</td>
  </tr>';
  $conteo++;
      $tmontof=$tmontof+$row['montoreclamado'];$tpagp=$tpagp+$row['pagosrecibidos'];
    $tmontot=$tmontot+$row['totaldeuda'];
  }
  ?>
 <!--tr>
  <td></td><td></td><td></td>
 <td></td><td></td><td></td><td></td>
 <td></td>
 <!--td><a href="" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
 </tr-->
</table>

  <table class="table table-striped table-condensed table-hover">
   <tr>
    <td><h4>DOCUMENTOS $:</h4></td><td><?php echo $tmontof;?></td>
    <td><h4>PAGOS PARCIALES $:</h4></td><td><?php echo $tpagp;?></td>
    <td><h4>DEUDA TOTAL $:</h4></td><td><?php echo $tmontot;?></td>
   </tr>
  </table>
    </div>
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
