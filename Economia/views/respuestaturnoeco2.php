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
 <?php 
//include "../Conexion/Conexion.php";
//$conexion=Conectarse();
$queryID = "SELECT * FROM turnoeco WHERE nroprov='".$nroprov."' ORDER BY idTurno DESC LIMIT 3";
?>
<table class="table table-striped table-condensed table-hover">
 <tr><th width="200">NRO.PROVEEDOR</th> 
     <th width="300">RAZON SOCIAL</th>
     <th width="200">FECHA TURNO</th>
     <th width="150">HORA TURNO</th>
 </tr>
 <?php
  $rs=mysqli_query($conexion,$queryID);
  $tot=mysqli_num_rows($rs);
  if($tot!=0){ // $dni=$nroprov;
  while ($row=mysqli_fetch_array($rs)) {
   echo '<tr>
         <td style="font-family:verdana;font-size:80%;">'.$row['nroprov'].'</td> 
         <td style="font-family:verdana;font-size:80%;">'.$row['razons'].'</td> 
         <td style="font-family:verdana;font-size:80%;">'.$row['fechaTurno'].'</td> 
         <td style="font-family:verdana;font-size:80%;">'.$row['horaTurno'].'</td> </tr>'; 
    }
     } 
     else{ 
     $respuesta="NO HAY TURNOS SOLICITADOS PARA ESTE PROVEEDOR";
    echo "<table width='100%'  cellspacing='0' cellpadding='0' style='font-size:20px' bgcolor='FDFEFE' border='1' align='center'>";
    echo "<caption>DATOS DEL PEDIDO</caption>";
    echo "<tr bgcolor='#CCCCCC'>";
    echo "<td align='center'><b>Respuesta del Sistema</b></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>&nbsp;</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td align='center'>".$respuesta."</td>";
    echo "</tr>";  echo "</table>";
    echo "<br></br>";
    echo "<div align='center'><input class='btn btn-primary' type='button' value='Salir' onclick='history.back()'/></div>";
}  
   ?>    
        </table>

 </div>
 </div>
<br>
</form>
<!--==========footer=================================-->

</body>  
</html>