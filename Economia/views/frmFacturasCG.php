<!DOCTYPE html>
<html lang="es">
<head>
<title>Carga de Documentos con Gestion judicial</title>
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
<script type="text/javascript" language="javascript">
var posicionCampo=1;
function agregarpfM() {
nuevaFila=document.getElementById("profM").insertRow(-1);
nuevaFila.id=posicionCampo;
nuevaCelda=nuevaFila.insertCell(-1);
nuevaCelda.innerHTML="<td><input type='text' size='20' name='npfm["+posicionCampo+"]' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='55'></td>";
nuevaCelda=nuevaFila.insertCell(-1);
nuevaCelda.innerHTML="<td><input type='text' size='20' name='hnpfm["+posicionCampo+"]' onkeypress='return numeros(event)'></td>";
nuevaCelda=nuevaFila.insertCell(-1);
nuevaCelda.innerHTML="<td><input type='button' value='Eliminar' onclick='eliminarpfM(this)'></td>";
posicionCampo++;}
function eliminarpfM(obj) {
  var oTr=obj;
  while(oTr.nodeName.toLowerCase()!='tr'){
   oTr=oTr.parentNode;}
   var root=oTr.parentNode;
   root.removeChild(oTr);}</script>

<script type="text/javascript" language="javascript">
var posicionCampo=1;
function agregarpfD() {
nuevaFila=document.getElementById("profD").insertRow(-1);
nuevaFila.id=posicionCampo;
nuevaCelda=nuevaFila.insertCell(-1);
nuevaCelda.innerHTML="<td><input type='text' size='20' name='npfd["+posicionCampo+"]' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='55'></td>";
nuevaCelda=nuevaFila.insertCell(-1);
nuevaCelda.innerHTML="<td><input type='text' size='20' name='hnpfd["+posicionCampo+"]' onkeypress='return numeros(event)'></td>";
nuevaCelda=nuevaFila.insertCell(-1);
nuevaCelda.innerHTML="<td><input type='button' value='Eliminar' onclick='eliminarpfD(this)'></td>";
posicionCampo++;}
function eliminarpfD(obj) {
  var oTr=obj;
  while(oTr.nodeName.toLowerCase()!='tr'){
   oTr=oTr.parentNode;}
   var root=oTr.parentNode;
   root.removeChild(oTr);}</script>   
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
    <li><a href="../views/frmMenuJ.php">Página Principal</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>
<form id="form1" name="form1" method="post" action="../Logica/agrega_facturaCG.php" onsubmit="return chkBC(this)">
<h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php 
       if(isset($respuesta))
      echo $respuesta;?></strong></h4>    
<!--==============================content================================-->
<script>
function numeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 ||tecla==46){
        return true;
    }
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
   return patron.test(tecla_final);
}
</script>   

<div class="container" align="center" style="background-color:#D8D8D8;">
 <h3 align="left">DATOS DEL DEMANDANTE</h3>
<div class="row">
<strong><div class="col-md-2" align="right" style="width:20%">(*)DNI Demandante:</div></strong>
<div class="col-md-1" align="left">
<input name="dnidem" id="dnidem" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%' onkeypress="return numeros(event)" required="required" />
</div><label>Ingrese solo números</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Apellido y Nombre/Razon Social:</div></strong>
<div class="col-md-4"><input name="ayn" type="text" id="ayn" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="55" required="required"/>
</div><label>Según la demanda presentada</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Domicilio Real:</div></strong>
<div class="col-md-4"><input name="domreal" type="text" id="domreal" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/>
</div><label>Según la demanda presentada</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Domicilio Especial:</div></strong>
<div class="col-md-4"><input name="domesp" type="text" id="domesp" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/>
</div><label>Según la demanda presentada</label></div>
<div class="row"><strong>
  <div class="col-md-2" align="left" style="width:20%;">(*)Estado Civil:</div></strong>
  <div class="col-md-1">
  <select name="estadocivil" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>SOLTERO/A </option>
    <option value='2'>CASADO/A</option>
    <option value='3'>VIUDO/A</option>
    <option value='4'>SEPARADO/A</option>
    <option value='5'>CONCUBINADO/A</option>
    <option value='6'>OTRO</option>
    <option value='7'>DIVORCIADO/A</option>
  </select>
  </div><label>Según Dni y demanda presentada</label>
</div>
<div class="row">
  <strong><div class="col-md-2" align="left" style="width:20%;">(*)Apellido y Nombre Cónyuge:</div></strong>
   <div class="col-md-4"><input name="conyuge" type="text" id="conyuge" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></div>
   <strong><label>En caso de no poseer colocar NO</label>
</div>
 <h3 align="left">DATOS DE LA DEMANDA</h3>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Carátula del Expediente :</div></strong>
<div class="col-md-4"><input name="caratula" type="text" id="caratula" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="200" required="required"/>
</div><label>Según la demanda presentada</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Número de Expediente:</div></strong>
<div class="col-md-2"><input name="expdte" type="text" id="expdte" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50" required="required"/>
</div><label>Según la demanda presentada</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%;">(*)Juzgado:</div></strong>
 <div class="col-md-4"><input name="jzgdo" type="text" id="jzgdo" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
 onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50"  required="required"/></div>
<label>Juzgado donde se tramitó la demanda</label></div>

<div class="row">
   <strong><div class="col-md-2" align="left" style="width:10%;">(*)Causa y Privilegio:</div></strong>
   <div class="col-md-4">
   <textarea class="form-control" rows="4" cols="200" name="causa" type="text" id="causa" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:130%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="150" required="required" ></textarea> </div>
  <label>Motivos que originaron la demanda y privilegio dictado por el Juez</label></div>

<div class="row">
<h3 align="left">PROFESIONALES ACTUANTES POR EL MUNICIPIO</h3>
<label>Presionar Agregar Profesional para cargar los datos y honorarios,presionar Eliminar para quitar.</label>
<table id="profM" width="600px" border="1" align="left" >
<tr><th>Nombre</th><th>Honorario Regulado $</th><th><td><input type="button" value="Agregar Profesional" onclick="agregarpfM('profM');" />
</td></th></tr></table></div><br>
 <div class="row">
<h3 align="left">PROFESIONALES ACTUANTES POR EL DEMANDANTE</h3>
<label>Presionar Agregar Profesional para cargar los datos y honorarios,presionar Eliminar para quitar.</label>
<table id="profD" width="600px" border="1" align="left" >
<tr><th>Nombre</th><th>Honorario Regulado $</th><th><td><input type="button" value="Agregar Profesional" onclick="agregarpfD('profD');" />
 </td></th></tr></table></div><br>
<div class="row">
<h3 align="left">MONTOS EN $ DE LA DEMANDA</h3>
 <strong><div class="col-md-3" align="left" style="width:32%;">(*)Monto Original de la Demanda $:</div></strong>
   <div class="col-md-2" align="left"><input name="monto" id="monto" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:75%' onkeypress="return numeros(event)" required="required" />
</div><label>Según la demanda presentada</label></div>
<div class="row">
 <strong><div class="col-md-3" align="left" style="width:30%">(*)Costas Reguladas $:</div></strong>
   <div class="col-md-2"><input name="costas" id="costas" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:75%' onkeypress="return numeros(event)" required="required" />
</div> <label>Costas Reguladas en el Expediente</label></div>
<div class="row">
 <strong><div class="col-md-3" align="left" style="width:30%">(*)Deuda Total Reclamada $:</div></strong>
  <div class="col-md-2"><input name="tdeuda" id="tdeuda" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:75%' onkeypress="return numeros(event)" required="required" />
</div> <label>Incluye Monto Original,Honorarios y Costas Reguladas</label></div>
<div class="row">
<h3 align="left">DATOS DE LA SENTENCIA</h3>
<strong><div class="col-md-2" align="left" style="width:20%">(*)Sentencia de 1° Instancia:</div></strong>
 <div class="col-md-3">
     <p><select name="diasen">
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
<select name="messen">
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
</select> <select name="aniosen">
  <?php
    $tope = date("Y");
    $edad_max = 26;
    $edad_min = 1;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p></div>
   <label>Fecha de la Sentencia de Primera Instancia</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Foja:</div></strong>
   <div class="col-md-2"><input name="fojapi" type="text" id="fojapi" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" required="required"/></div>
<label>Número de foja de la Sentencia de Primera Instancia</label></div>
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%" >(*)Apelación:</div></strong>
 <div class="col-md-3">
     <p><select name="diaapel">
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
<select name="mesapel">
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
</select> <select name="anioapel">
  <?php
    $tope = date("Y");
    $edad_max = 26;
    $edad_min = 1;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p></div><label>Fecha de la Apelación de la Sentencia</label></div>
 <div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">(*)Foja:</div></strong>
   <div class="col-md-2"><input name="fojapel" type="text" id="fojapel" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" required="required"/></div>
<label>Número de foja de la Apelación</label></div>   
<div class="row">
<strong><div class="col-md-2" align="left" style="width:20%" >Sentencia de Alzada:</div></strong>
 <div class="col-md-3">
     <p><select name="diaalza">
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
<select name="mesalza">
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
</select> <select name="anioalza">
  <?php
    $tope = date("Y");
    $edad_max = 26;
    $edad_min = 1;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p>

   </div>  
    <label>Fecha de la Sentencia de Alzada</label></div>
 <div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">Foja:</div></strong>
   <div class="col-md-2"><input name="fojaalza" type="text" id="fojaalza" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" value="0" /></div>
<label>Número de foja de la Sentencia de Alzada</label></div>   
 <div class="row">
<strong><div class="col-md-2" align="left" style="width:20%" >Recurso Extraordinario:</div></strong>
 <div class="col-md-3">
     <p><select name="diarecu">
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
<select name="mesrecu">
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
</select> <select name="aniorecu">
  <?php
    $tope = date("Y");
    $edad_max = 26;
    $edad_min = 1;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p>

   </div>  
    <label>Fecha de la Interposición del Recurso Extraordinario</label></div>  
   <div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">Foja:</div></strong>
   <div class="col-md-2"><input name="fojarecu" type="text" id="fojarecu" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" value="0" /></div>
<label>Número de foja del Recurso Extraordinario</label></div>  
 <div class="row">
  <strong>
 <div class="col-md-3" align="left" style="width:30%;">(*)Estado Actual del Expediente:</div></strong>
   <div class="col-md-3"><input name="estado" type="text" id="estado" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:120%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="30" required="required"/></div>
<label>Ultimo estado del Expediente</label></div>  
 <div class="row">
   <strong>
 <div class="col-md-2" align="left" style="width:20%;">Aplicación Art.505 CC:
 </div></strong>
  <div class="col-md-1">
  <select name="art505" size=1 style="text-align:center;font-style:bold">
    <option value='1'>NO</option>
    <option value='2'>SI</option>
  </select>
  </div> 
   <label>Aplicación del Artículo 505 CC actual 730 del CCC</label></div> 

 <div class="row">
   <strong>
 <div class="col-md-2" align="left" style="width:20%;">Aplicación Ley 2868:
 </div></strong>
  <div class="col-md-1">
  <select name="ley2868" size=1 style="text-align:center;font-style:bold" >
    <option value='1'>NO</option>
    <option value='2'>SI</option>
  </select>
  </div> 
   <label>Aplicación de la Ley 2868</label></div> 
 <div class="row">
<strong><div class="col-md-2" align="left" style="width:20%" >Requisitos Ley 4474:</div></strong>
 <div class="col-md-3">
     <p><select name="dia4474">
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
<select name="mes4474">
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
</select> <select name="anio4474">
  <?php
    $tope = date("Y");
    $edad_max = 26;
    $edad_min = 1;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p>

   </div>  
    <label>Fecha de la intimación</label></div> 
 <div class="row">
<strong><div class="col-md-2" align="left" style="width:20%">Foja:</div></strong>
   <div class="col-md-2"><input name="fojaintima" type="text" id="fojaintima" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" value="0" /></div>
<label>Número de foja de la intimación</label></div>  <br><br>
<strong><h3 align="center" style="color:red;width:80%;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;">CONTROLAR LOS DATOS ANTES DE PROCEDER A GUARDAR</h3></strong>
 <br>
 <div class="row">
 <div class="col-md-1"></div>
 <div class="col-md-3"><strong><h5 align="center" style="color:red;width:90%;"><strong>(*)CAMPOS OBLIGATORIOS</strong></h5>   
   </div>
 <div class="col-md-2"><input type="submit" name="Submit" value="GUARDAR" /></div>
 <div class="col-md-2"><input type="reset" /></div>
 </div>
 </div>  
</div>
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