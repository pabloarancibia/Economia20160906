<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];$_SESSION["secretaria"];
$flag=0;
include "../Conexion/Conexion.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Areas con Pedido Realizados</title>
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
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">MENU ANTERIOR<span class="caret"></span></a>
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



<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 10px solid #ffffff;">
 <section>
  <table border="0" align="center">
   <tr><td>&nbsp;</td></tr>
   <tr>
   <strong><td width="350">Seleccione el formato de la información</td></strong>
   <!--td width="150"><a target="_blank" href="javascript:reporteExcel();" class="btn btn-primary">EXCEL</a></td-->
   <td width="150"><a href="../views/explistaAreapedido.php" class="btn btn-primary">EXCEL</a></td>
   <td width="150"><a target="_blank" href="../views/listaAreaPedido.php" class="btn btn-danger">PDF</a></td>
   <!--td width="150"><a target="_blank" href="javascript:reportePDF();" class="btn btn-danger">PDF</a></td-->

   
   </tr>
  
  </table>
 </section>
 <div class="registros" id="agrega-registros">
 <table class="table table-striped table-condensed table-hover">
  <tr>
  <th width="200">SECRETARIA</th> 
  <th width="300">SUB-SECRETARIA</th>
  <!--th width="200">DCCION.GRAL</th-->
  <th width="100">PEDIDO</th>
  <th width="100">AÑO</th>
  <!--th width="50">Opciones</th-->
 </tr>
 <?php
  $conexion=Conectarse();
    $sql="select a.sec,a.detsec as secre,b.subsec,b.detsubsec as ssec,d.nropedido as np,
  d.aniopedido as ap,d.isecre,d.isubsecre
  from secretarias a, subsecretarias b, pedidomateriales d
  where
  (a.sec=d.isecre) and (b.subsec=d.isubsecre) 
  order by d.isecre asc,d.aniopedido asc,d.nropedido asc ;";  
  //    
  $resultado = mysqli_query ($conexion,$sql);
  $tmontof=0.00;$tpagp=0.00;$tmontot=0.00;$conteo=0;
  while($row = mysqli_fetch_array($resultado)) {
   echo'<tr>
  <td>'.$row['secre'].'</td>
  <td>'.$row['ssec'].'</td>
  
  <td>'.$row['np'].'</td>
  <td>'.$row['ap'].'</td>
  </tr>';
  $conteo++;
  }
  ?>
 <!--tr>
  <td></td><td></td><td></td>
 <td></td><td></td><td></td><td></td>
 <td></td>
 <!--td><a href="" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
 </tr-->
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
