<?php 
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Atencion de Proveedores</title>
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
<form id="form1" name="form1" method="post" action="../views/listaTurnoPr.php"  target="_blank">
<h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php 
       if(isset($respuesta))
      echo $respuesta;?></strong></h4>    
<!--==============================content================================-->

<div class="container-fluid" align="center" style="background-color:#D8D8D8;">
  <br> 
  <div class="row" ><div class="col-md-1"></div>
  <strong><div class="col-md-2" align="right" style="width:5%">FECHA:</div></strong>
  <div class="col-md-1" align="left" style="width:5%;"></div></strong>
<div class="col-md-3">
     <p><select name="dia">
  <?php
    for($d=1;$d<=31;$d++)
    {
      if($d<10)
        $dd = "0" . $d;
      else
        $dd = $d;
      echo "<option value='$dd'>$dd</option>";
    }
  ?>
</select>
<select name="mes">
<?php
  for($m = 1; $m<=12; $m++)
  {
    if($m<10)
      $me = "0" . $m;
    else
      $me = $m;
    switch($me)
    {
      case "01": $mes = "Enero"; break;
      case "02": $mes = "Febrero"; break;
      case "03": $mes = "Marzo"; break;
      case "04": $mes = "Abril"; break;
      case "05": $mes = "Mayo"; break;
      case "06": $mes = "Junio"; break;
      case "07": $mes = "Julio"; break;
      case "08": $mes = "Agosto"; break;
      case "09": $mes = "Septiembre"; break;
      case "10": $mes = "Octubre"; break;
      case "11": $mes = "Noviembre"; break;
      case "12": $mes = "Diciembre"; break;     
    }
    echo "<option value='$me'>$mes</option>";
  }
?>
</select> <select name="anio">
  <?php
    $tope = date("Y");
   // $edad_max = 3;
    //$edad_min = 1;
    for($a= $tope ; $a<=$tope; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p>
   </div>

  
  
  </div>
    <br>
 <br><br>
 <div class="row">
 <div class="col-md-1"></div>
 <div class="col-md-3"><strong><h5 align="center" style="color:red;width:90%;"><strong></strong></h5>   
   </div>
 <div class="col-md-2"><button id="nueva-factura" class="btn btn-primary" >GENERAR LISTADO</button></div> </div><br><br>
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