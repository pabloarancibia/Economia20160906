<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Respuesta de Turnos de Atencion</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>


<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/jquery.qrcode.min.js" type="text/javascript" ></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
<![endif]-->
</head>
<body class="body" style=" background-image: url(../images/bgcity.jpg);
  background-attachment: fixed;">

<!--==============================header=================================-->
<header>
 <table width="100%" height="120" border="0" background="../images/header2015.jpg">
<tr><td width="40%"></td>
<td><div align="left" style="color:#ffffff;" ><p><h2>SECRETARIA DE ECONOMIA</h2></p>
 </div></td>
</tr>
<tr><td width="40%"></td>
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
    <li><a href="../views/frmMenueco.php">Página Principal</a></li>
   </ul>
 </li>
 </ul>
 </div>
 </div>
 </nav>
</header>
<form id="form1" name="form1" method="post" action="">
<!--==============================content================================-->
<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 20px solid #ffffff;">
<br>
<div class="row">
<div class="sm-col-12" align="center">
 <?php if(isset($respuesta))
      echo $respuesta;?>
 </div>
 <br>
<div class="sm-col-12" align="center">
 <?php if(isset($respuesta2))
      echo $respuesta2;?>
 </div>
 </div>
<br>
<div class="row" align="center">
<div class="col-md-1"> </div>
 <strong><div class="col-md-2" align="center">NRO.PROVEEDOR:</div></strong>
<div class="col-md-2"><?php echo "<input type='text' style='border:none; background-color:transparent; ' readonly='readonly' value='".$nroprov."'>"; ?></div>
</div><br>
<div class="row" align="center">
<div class="col-md-1"> </div>
<strong><div class="col-md-2" align="center">RAZON SOCIAL:</div></strong>
<div class="col-md-2"><?php echo "<input type='text' style='border:none; background-color:transparent; '  readonly='readonly' value='".$razons."'>"; ?></div>
</div>

<div class="row" align="center">
<div class="col-md-1"> </div>
 <strong><div class="col-md-2" align="center">Fecha Turno:</div></strong>
<div class="col-md-2"><?php echo "<input type='text' style='border:none; background-color:transparent; ' readonly='readonly' value='".$fechaTurno."'>";?></div>
</div>
<div class="row" align="center">
<div class="col-md-1"> </div>
 <strong><div class="col-md-2" align="center">Hora Turno:</div></strong>
<div class="col-md-2"><?php echo "<input type='text' style='border:none; background-color:transparent; ' readonly='readonly' value='".$horaTurno."'>"; ?></div>
</div></div>
<br>
<div id="qrcode" align="center" style="">
 <script>
 jQuery(function(){
   var npr ='<?php echo $nroprov;?>';
   var rzs ='<?php echo $razons;?>';
   var fecha ='<?php echo $fechaTurno;?>';
   var ht='<?php echo $horaTurno;?>';
   jQuery('#qrcode').qrcode(npr+"\n"+rzs+"\n"+fecha+"\n"+ht);})
  </script>
</div>
<br>


<div class="sm-col-12" align="center">
 <style type="text/css" media="print">.nover {display:none}</style>
<script>
if (window.print) {document.write('<form><td height="34" colspan="2" style="text-align: center"><input type="button" class="nover calendar" id="Imprimelo" value="IMPRIMIR" onClick="javascript:window.print()"></td></form>');}
</script>
 </div>


</form>
<!--==========footer=================================-->

</body>  
</html>