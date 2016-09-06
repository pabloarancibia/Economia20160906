<?php 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Solicitud de Turnos de Atencion</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<link  href= "../js/glDatePicker.default.css"  rel= "stylesheet"  type= "text/css" >
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--script src="../js/checkReincidencia.js" type="text/javascript"></script-->
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
 <form id="form1" name="form1" method="post" action="../Logica/AltaTurnoEco.php" onsubmit="return chckR(this)">

<!--==============================content================================-->
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
<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 20px solid #ffffff;">

<div class="row">
<div class="col-md-1"></div><strong>
<div class="col-md-2" align="right">Seleccione Fecha:</div></strong> 
<div class="col-md-8"><input name="fturno" type="text"  id="fturno" value="CLICK AQUI PARA MOSTRAR FECHAS DE ATENCION" readonly="readonly"  style="color:red; width:400px;height : 20px ;" required="required"/></div>
  <div class="col-md-1"></div>
<script src= "//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script> 
<script src= "../js/glDatePicker.min.js" ></script>
  <script type= "text/javascript" > 
  $ ( window ). load ( function () 
   { 
  var mount=new Date();var year=new Date(); var dia=new Date();
  $ ( '#fturno' ).glDatePicker ({
  //selectableYears:[year.getFullYear()],
  selectableYears:[year.getFullYear(),year.getFullYear()+1],
  selectableMonths:[mount.getMonth(), (mount.getMonth()+1), (mount.getMonth()+2), (mount.getMonth()+2)],
  selectableDOW:[2, 4],
  dowOffset:1,
  selectableDateRange:[{
  //from:new Date(year.getFullYear(),mount.getMonth(),dia.getDate()+1),
   from:new Date(2016, 7,16), to:new Date(2016, 11,29)},],
   onClick: function(target, cell, date, data) {
  target.val(date.getDate() + '/' + (date.getMonth()+1) + '/' +
  date.getFullYear());
   if(data != null) {alert(data.message + '\n' + date);
        }
    }} );}); 
    </script> </div>
<br><div class="row">
<div class="col-md-1"></div>
 <strong><div class="col-md-2" align="right">NRO.PROVEEDOR:</div></strong>
<div class="col-md-1"><input name="np" type="text" id="np" style="color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:95%;" onkeypress="return numeros(event)"  required="required"  maxlength="6" /></div>
   </div><br>
<div class="row">
<div class="col-md-1"></div>
 <strong><div class="col-md-2" align="right">RAZON SOCIAL:</div></strong>
 <div class="col-md-2"><input name="rz" type="text" id="rz" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" required="required"/></div>
 </div><br>
 <div class="row">
<div class="col-md-1"></div>
<strong><div class="col-md-2" align="right">MOTIVO DE CONSULTA:</div></strong>
   <div class="col-md-5">
   <textarea
     name="motivo" id="motivo" class="form-control" rows="5" cols="400" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" required="required" maxlength="150" >
   </textarea>
   </div>
   <strong><div class="col-md-3">HASTA 150 CARACTERES</div></strong>
 </div>
<br> 
<div class="row">
 <div class="col-md-3"></div>
  <div class="col-md-1">
  <p><img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" /></p>
   </div>
 </div>
 <div class="row">
   <div class="col-md-3"></div>
   <div class="col-md-1">Copie el codigo de seguridad:</div>
   <div class="col-md-5"><input type="text" name="captcha_code" size="30" maxlength="6" />
          <a href="#" onClick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">[ Elegir otra imagen]</a></div>
  <div class="col-md-3">
  <strong><style="background-color:#7FFF00; color:red; width: 428px; height: 45px;"><?php 
      if(isset($respuesta))
      echo $respuesta;?></style></strong> 
</div>
 </div>
<br>
 <div class="row">
 <div class="col-md-4"></div>
 <div class="col-md-2"><input type="submit" name="Submit" value="Reservar" /></div>
 
   
 </div>  
<!---------------------------------------------->
</form>
</div>
<!--==========footer=================================-->
 

</body>  
</html>