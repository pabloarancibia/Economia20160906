<?php 
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];
include "../Conexion/Conexion.php";
$conexion=Conectarse();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Alta de Acreedores</title>
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
    <li><a href="../views/frmMenuUsuarios.php">Página Principal</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>
<form id="form1" name="form1" method="post" action="../Logica/AltaEmpleado.php" onsubmit="return chkBC(this)">
<h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php 
       if(isset($respuesta))
      echo $respuesta;?></strong></h4>    
<!--==============================content================================-->
<script>
function numeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8){
        return true;
    }
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
   return patron.test(tecla_final);
}
</script>   

<div class="container-fluid" align="center" style="background-color:#D8D8D8;">
<br>
<div class="row">
<strong><div class="col-md-2" align="right" style="width:15%">(*)NRO.COBRO:</div></strong>
<div class="col-md-1" align="left">
<input name="nrocob" id="nrocob" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:70%' onkeypress="return numeros(event)" required="required" />
</div>
<strong><div class="col-md-1" align="right" style="width:15%">(*)TIPO DOCUMENTO:</div></strong>
<div class="col-md-1" align="right"  style="width:8%" required="required">
  <p><select name="tdn">
   <option value='1'>DU</option>
   <option value='2'>LC</option>
   <option value='3'>LE</option>
   <option value='4'>PS</option>
 </select></p></div>
<strong><div class="col-md-1" align="right" style="width:15%">(*)NRO.DOCUMENTO:</div></strong>
<div class="col-md-1"><input name="nd" type="text" id="nd" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeypress="return numeros(event)" maxlength="10" required="required"/>
</div>
<strong><div class="col-md-1" align="right" style="width:5%">(*)C.U.I.L:</div></strong>
 <div class="col-md-1" align="right"  style="width:8%" required="required">
  <p><select name="pre-cuil">
   <option value='1'>20</option>
   <option value='2'>23</option>
   <option value='3'>24</option>
   <option value='4'>27</option>
   <option value='5'>30</option>
   <option value='6'>33</option>
   </select></p></div>
   <div class="col-md-1" align="center" style="width:8%">
   <input name="cuil" id="cuil" type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:110%;' onkeypress="return numeros(event)" required="required"/></div>
   <div class="col-md-1" align="left"  style="width:8%">
   <p><select name="pos-cuil" required="required">
    <option value='1'>0</option>    <option value='2'>1</option>
    <option value='3'>2</option>    <option value='4'>3</option>
    <option value='5'>4</option>    <option value='6'>5</option>
    <option value='7'>6</option>    <option value='8'>7</option>
    <option value='9'>8</option>    <option value='10'>9</option>
   </select></p></div>
</div>
<br>
<div class="row">
 <strong><div class="col-md-2" align="right" style="width:15%;">(*)APELLIDOS:</div></strong>
<div class="col-md-2"><input name="apel" type="text" id="apel" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:110%;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="55"  required="required"/></div>
<strong><div class="col-md-1" align="left" style="width:8%;">(*)NOMBRES:</div></strong>
<div class="col-md-2"><input name="nomb" type="text" id="nomb" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:110%;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="55" required="required"/></div>
<strong><div class="col-md-1" align="left" style="width:10%" >(*)DOMICILIO:</div></strong>
<div class="col-md-3"><input name="domcalle" type="text" id="domcalle" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:140%;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="100" required="required"/></div></div><br> 
<div class="row">
<strong><div class="col-md-2" align="right" style="width:15%;">(*)LOCALIDAD:</div></strong>
<div class="col-md-2"><input name="domlocal" type="text" id="domlocal" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="40" required="required"/></div>
<strong><div class="col-md-1" align="left" >(*)PROVINCIA:</div></strong>
   <div class="col-md-2"><input name="domprovincia" type="text" id="domprovincia" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="40" required="required"/></div>
<strong>
 <div class="col-md-1" align="left" style="width:8%;">(*)TELEFONO:</div></strong>
<div class="col-md-2"><input name="tel" type="text" id="tel" style="color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:92%;" onkeypress="return numeros(event)" maxlength="12" required="required"/></div>
<div class="col-md-2" align="left" style="width:10%;">Números 0-9</div>
</div><br> 
<div class="row">
<strong><div class="col-md-2" align="right" style="width:15%">(*)FECHA NACIMIENTO:</div></strong>
<div class="col-md-3" align="center">
<p><select name="dianac"><?php
 for($d=1;$d<=31;$d++){if($d<10) $dd = "0" . $d;
      else $dd = $d;echo "<option value='$dd'>$dd</option>";}?>
</select>
<select name="mesnac"><?php
 for($m = 1; $m<=12; $m++){if($m<10)$me = "0" . $m;
  else $me = $m;
  switch($me)
  { case "01": $mes = "Enero"; break;case "02": $mes = "Febrero"; break;
    case "03": $mes = "Marzo"; break;case "04": $mes = "Abril"; break;
    case "05": $mes = "Mayo"; break;case "06": $mes = "Junio"; break;
    case "07": $mes = "Julio"; break;case "08": $mes = "Agosto"; break;
    case "09": $mes = "Septiembre"; break;case "10": $mes = "Octubre"; break;
    case "11": $mes = "Noviembre"; break;case "12": $mes = "Diciembre"; break;     
    } echo "<option value='$me'>$mes</option>"; }?>
</select> <select name="anionac">
  <?php  $tope = date("Y"); $edad_max = 82; $edad_min = 17;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p></div>
<strong><div class="col-md-2" align="right" style="width:15%">(*)FECHA INGRESO:</div></strong>
<div class="col-md-3">
<p><select name="diain"><?php
 for($d=1;$d<=31;$d++){if($d<10) $dd = "0" . $d;
      else $dd = $d;echo "<option value='$dd'>$dd</option>";}?>
</select>
<select name="mesin"><?php
 for($m = 1; $m<=12; $m++){if($m<10)$me = "0" . $m;
  else $me = $m;
  switch($me)
  { case "01": $mes = "Enero"; break;case "02": $mes = "Febrero"; break;
    case "03": $mes = "Marzo"; break;case "04": $mes = "Abril"; break;
    case "05": $mes = "Mayo"; break;case "06": $mes = "Junio"; break;
    case "07": $mes = "Julio"; break;case "08": $mes = "Agosto"; break;
    case "09": $mes = "Septiembre"; break;case "10": $mes = "Octubre"; break;
    case "11": $mes = "Noviembre"; break;case "12": $mes = "Diciembre"; break;     
    } echo "<option value='$me'>$mes</option>"; }?>
</select> <select name="anioin">
  <?php  $tope = date("Y"); $edad_max = 46; $edad_min = 0;
    for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p></div>
<strong>
  <div class="col-md-1" align="right" style="width:8%;">(*)SEXO:</div></strong>
  <div class="col-md-1">
  <select name="sexo" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>M</option>
    <option value='2'>F</option>
  </select>
  </div>
</div><br> 
<div class="row">

<strong>
  <div class="col-md-2" align="right" style="width:15%;">(*)ESTADO CIVIL:</div></strong>
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
  </div>
<strong>
  <div class="col-md-2" align="right" style="width:15%;">(*)CATEGORIA:</div></strong>
  <div class="col-md-1">
  <select name="catego" size=1 style="text-align:center;font-style:bold" required="required">
    <option value="0">Seleccione</option>
    <?php $consu="select * from categoriaempleados order by id;";
     $res=mysqli_query($conexion,$consu);
     while ($fila=mysqli_fetch_array($res)){?>
    <option value="<?php echo $fila['id'] ; ?>"><?php 
      echo utf8_decode($fila['descricat']);?></option><?php }?>
   </select>
  </div>
  <strong>
  <div class="col-md-3" align="right" style="width:20%;">(*)GRUPO COBRO:</div></strong>
  <div class="col-md-1">
  <select name="grupoco" size=1 style="text-align:center;font-style:bold" required="required">
    <option value="0">Seleccione</option>
    <?php $consgr="select * from gruposcobros order by id ;";
    $resgr=mysqli_query($conexion,$consgr);
    while($filagr=mysqli_fetch_array($resgr)){?>
  <option value="<?php echo $filagr['idgrupo'] ?>"><?php 
  echo utf8_decode($filagr['descrigpo']); ?></option><?php }
  ?>
  </select></div></div><br> 
 <div class="row"><strong>
  <div class="col-md-2" align="right" style="width:15%;">(*)SECRETARIA:</div></strong>
  <div class="col-md-1">
  <select name="secret" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='0'>Seleccione</option>
  <?php $consec=" select * from secretarias order by idsec;";
  $resec=mysqli_query($conexion,$consec);
  while ($filasec=mysqli_fetch_array($resec)){?>
   <option value="<?php echo $filasec['sec']; ?>"><?php 
   echo utf8_decode($filasec['detsec']) ;?></option><?php } ?> 
  </select></div><br><br>
  <strong>
  <div class="col-md-2" align="right" style="width:15%;">(*)SUBSECRETARIA:</div></strong>
  <div class="col-md-1">
  <select name="subsecret" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='0'>Seleccione</option>
  <?php $consec=" select * from subsecretarias order by isec;";
  $resec=mysqli_query($conexion,$consec);
  while ($filasec=mysqli_fetch_array($resec)){?>
   <option value="<?php echo $filasec['subsec']; ?>"><?php 
   echo utf8_decode($filasec['detsubsec']) ;?></option><?php } ?>  
    
  </select>
  </div><br><br>
  <strong>
  <div class="col-md-2" align="right" style="width:15%;">(*)DCCION GRAL:</div></strong>
  <div class="col-md-1">
  <select name="dciogral" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='0'>Seleccione</option>
    <?php $consdg="select * from dirgenerales order by issec;"; 
  $resdg=mysqli_query($conexion,$consdg);
  while ($filadg=mysqli_fetch_array($resdg)) {?>
   <option value="<?php echo $filadg['dirgral']; ?>"><?php 
  echo utf8_decode($filadg['dirdetalle']);?></option><?php }?>
 </select>
  </div>
 </div><br>
  </div><br>

 </div>
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