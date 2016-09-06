<?php 
session_start();
if (!isset($_SESSION["usuario"])){
    header("Location:../views/index.php?nologin=false");}
$_SESSION["usuario"];
$_SESSION["razonsocial"];$_SESSION["nroprov"];
$np=$_SESSION["nroprov"];
include "../Conexion/Conexion.php";
$conn=Conectarse();
$queryd="select * from acreedoreconomia where nroprov='".$np."';";
$rs=mysqli_query($conn,$queryd);
$row=@mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Modificacion de Datos de Acreedores</title>
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
<td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["usuario"]?>-<?php echo $_SESSION["razonsocial"]?></h4></p>
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
    <li><a href="../views/frmMenu.php">Página Principal</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>
<form id="form1" name="form1" method="post" action="../Logica/ModDatosProveedor.php" onsubmit="return chkBC(this)">
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

<script type="text/javascript">
function validateMail(idMail)
{
  object=document.getElementById(idMail);
  valueForm=object.value;
 var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
  if(valueForm.search(patron)==0)
  {
    object.style.color="#000";
   return;
  }
  object.style.color="#f00";
}
</script>
<div class="container-fluid" align="center" style="background-color:#D8D8D8;">
<br>
<div class="row">
<strong><div class="col-md-2" align="right" style="width:15%">(*)PROV.:</div></strong>
<div class="col-md-1" align="left">
<?php 
   echo "<input name='nroprov' id='nroprov' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:90% ' readonly='readonly' value='".$_SESSION["nroprov"]."'>";
    ?></div>
<strong><div class="col-md-1" align="left" style="width:15%">(*)RAZON SOCIAL:</div></strong>
<div class="col-md-3">
<?php 
   echo "<input name='razonsocial' id='razonsocial' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:90% ' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='55' required='required' value='".$_SESSION["razonsocial"]."'>";
    ?></div>
<strong><div class="col-md-1" align="right" style="width:5%">(*)C.U.I.T:</div></strong>
 <div class="col-md-1" align="right"  style="width:8%" required="required">
  <p><select name="pre-cuit">
   <option value='1'>20</option>
   <option value='2'>23</option>
   <option value='3'>24</option>
   <option value='4'>27</option>
   <option value='5'>30</option>
   <option value='6'>33</option>
   </select></p></div>
   <div class="col-md-1" align="center" style="width:10%">
   <input name="cuit" id="cuit" type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:110%;' onkeypress="return numeros(event)" required="required"/></div>
   <div class="col-md-1" align="left"  style="width:8%">
   <p><select name="pos-cuit" required="required">
    <option value='1'>0</option>
    <option value='2'>1</option>
    <option value='3'>2</option>
    <option value='4'>3</option>
    <option value='5'>4</option>
    <option value='6'>5</option>
    <option value='7'>6</option>
    <option value='8'>7</option>
    <option value='9'>8</option>
    <option value='10'>9</option>
   </select></p></div>
</div>
<br>
<div class="row">
   <div class="col-md-1"></div>
   <strong><div class="col-md-1" align="left" style="width:8%;">(*)APELLIDO:</div></strong>
   <div class="col-md-2">
<?php 
 echo "<input name='apellido' id='apellido' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:90% ' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='55' required='required' value='".$row['apellido']."'>";   
    ?>
</div>
   <strong><div class="col-md-1" align="left" style="width:8%;">(*)NOMBRES:</div></strong>
   <div class="col-md-2"><?php 
     echo "<input name='nombre' id='nombre' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:90% ' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='55' required='required' value='".$row['nombre']."'>";   
   ?></div> 
   <strong><div class="col-md-1" align="left" style="width:8%;">(*)CONYUGE:</div></strong>
   <div class="col-md-2">
     <?php 
     echo "<input name='conyuge' id='conyuge' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:90% ' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='55' required='required' value='".$row['nombre']."'>";   
   ?>
   </div>
   <strong>
  <div class="col-md-1" align="left" style="width:5%;">(*)E.C:</div></strong>
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
   </div>
  <br> 
  <div class="row">
<div class="col-md-1"></div>
   <strong><div class="col-md-1" align="right">(*)DOCUMENTO:</div></strong>
   <div class="col-md-1" align="center" style="width:10%">
   <input name="dni" id="dni" type="text" style="color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%" onkeypress="return numeros(event)" required="required"/>
   </div>
   
<strong><div class="col-md-2" align="left" style="width:12%" >(*)DOMICILIO(CALLE):</div></strong>
   <div class="col-md-2"><input name="domcalle" type="text" id="domcalle" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="30" required="required"/></div>
 <strong><div class="col-md-1" align="left" style="width:5%">(*)NUMERO:</div></strong>
   <div class="col-md-1" ><input name="domnro" type="text" id="domnro" style="color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:60%;" onkeypress="return numeros(event)" maxlength="5" required="required" /></div> 
 <strong><div class="col-md-1" align="left" style="width:5%">PISO/DPTO:</div></strong>
   <div class="col-md-1"><input name="dompiso" type="text" id="dompiso" style="color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:60%;" maxlength="10" /></div>
   </div>
 <br> 
<div class="row">
<div class="col-md-1"></div>
<strong><div class="col-md-1" align="left" style="width:7%">(*)BARRIO:</div></strong>
   <div class="col-md-2"><input name="dombarrio" type="text" id="dombarrio" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="35" required="required"/></div>

<strong><div class="col-md-1" align="left">(*)LOCALIDAD:</div></strong>
   <div class="col-md-2">
   <?php 
     echo "<input name='domlocal' id='domlocal' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:90% ' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='40' required='required' value='".$row['localidad']."'>";   
   ?></div>
<strong><div class="col-md-1" align="left" >(*)PROVINCIA:</div></strong>
   <div class="col-md-2"></div>
   <?php 
     echo "<input name='domprovincia' id='domprovincia' type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:20% ' onkeyup='javascript:this.value=this.value.toUpperCase();' maxlength='40' required='required' value='".$row['provincia']."'>";   
   ?>
  </div> <br>
<div class="row">
<div class="col-md-1"></div>
  <strong>
 <div class="col-md-1" align="left" style="width:8%;">(*)TELEFONO:</div></strong>
   <div class="col-md-2"><?php
  echo
   "<input name='tel' type='text' id='tel' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:92%;' onkeypress='return numeros(event)' maxlength='12' required='required' value='".$row['tel1']."' />"?></div>
   <div class="col-md-2" align="left" style="width:10%;">Números 0-9</div>
 <strong>
 <div class="col-md-2" align="right" style="width:20%;">TELEFONO ALTERNATIVO:</div></strong>
   <div class="col-md-2"><input name="telalt" type="text" id="telalt" style="color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:92%;" onkeypress="return numeros(event)" maxlength="12" /></div>
   <div class="col-md-2" align="left" style="width:10%;">Números 0-9</div>
 
 </div>
 <br>
 <div class="row">
<div class="col-md-1"></div>
  <strong>
 <div class="col-md-1" align="left" style="width:8%;">E-MAIL:</div></strong>
   <div class="col-md-2"><?php
  echo "<input type='text' id='id_mail' name='mail'  class='' value='".$row['email']."' size='30' maxlength='100' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:92%;' onKeyUp='javascript:validateMail('id_mail')'/>";?></div>
   <strong>
 <div class="col-md-2" align="right" style="width:20%;">E-MAIL ALTERNATIVO:
 </div></strong>
   <div class="col-md-2">
   <input type="text" id="id_mailalt" name="mailalt"  class="" value="" size="30" maxlength="100" style="color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:92%;" onKeyUp="javascript:validateMail('id_mailalt')"/>
   </div>
 </div><br><br><br>
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