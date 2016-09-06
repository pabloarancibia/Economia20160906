
<?php
if(!isset($_SESSION))
{
    session_start();
}
/*if (!isset($_SESSION["usuario"])){
    header("Location:../views/frmMenu.php?nologin=false");}
$_SESSION["usuario"];
$_SESSION["razonsocial"];*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>GENERADORES de Basura</title>
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
<td><div align="left" style="color:#ffffff;" ><p><h4>SECRETARIA DE PLANIFICACION ESTRATEGICA</h4></p>
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
    <li><a href="../views/frmMenu.php">Página Principal</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>
 <script>
 function numeros(e){
     tecla = (document.all) ? e.keyCode : e.which;
     if (tecla==8 || tecla==46){
         return true;
     }
     patron =/[0-9]/;
     tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
 }
 </script>
<!-- script para formulario residuos -->

<script "text/javascript" src="../js/jsResiduos.js"></script>
<script "text/javascript" src="../js/jsResiduosVerifOptB.js"></script>
<!-- FUNCION SOLO NUMEROS JQUERY
<script>
        $(document).ready(function (){
          $('.solo-numero').keyup(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
          });
        });
    </script>-->
<!-- estilo para formulario residuos -->
      <style type="text/css">
        #tablaResiduos tr td{
          /*margin: 20px;*/
        padding: 15px;
      }
        #tablaResiduos tr td input{
        width: 70px;
      }
        .a6 input{
        width: 50px;
      }
      .a6 .tipoOtros{
      width: 140px;
    }
    .mensaje-error{
      background-color: #F8FC06;
      padding: 10px;
      width: 30%;
      border-radius: 7px;
      -webkit-border-radius: 5px 10px;  /* Safari  */
      -moz-border-radius: 5px 10px;     /* Firefox */
    }
      </style>
<!--==============================content================================-->
<!--  -->
<!--<div class="container-fluid" align="center" style="background-color:#D8D8D8;">-->

<div id='container-fluid' style="margin-right:20px;margin-left:50px">
<form action="../Logica/registrarResiduos.php" method="post" onsubmit="return verifOpt()">
  <h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php
         if(isset($respuesta))
        echo $respuesta;?></strong></h4>
  <h1 align="center" class="letra" style="background-color:#7FFF00;">Formulario WEB de registro de <br>GRANDES GENERADORES DE RESIDUOS SOLIDOS URBANOS</h1><br><br>
  <h2>DATOS DEL CONTRIBUYENTE</h2>
    <label>Razon Social: </label> <input type="text" id="txtRS" name="razonsocial" maxlength="50"/>
    <label>CUIT: </label><!--<input type="text" name="cuit1" maxlength="2" size="1" />-->
    <select name="cuit1" id="cuit1">
     <option value='1'>20</option>
     <option value='2'>23</option>
     <option value='3'>24</option>
     <option value='4'>27</option>
     <option value='5'>30</option>
     <option value='6'>33</option>
     </select>
    <label>-</label>
    <!--<input type="text" name="cuit2" maxlength="8" size="9" />-->
    <label>-</label>
    <input name="cuit" id="cuit" type='text' style='color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;' onkeypress="return numeros(event)" required="required"/>
    <select name="cuit3" id="cuit3" required="required">
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
   </select><br><br>
  <!--<input type="text" name="cuit3" maxlength="2" size="1" />-->
    <label>Domicilio: Calle:</label><input type="text" id="calle" name="calle" maxlength="50"   />
    <label>Altura:</label><input type="text" id="altura" name="altura" value ="0" maxlength="20" size="4"   onkeypress="return numeros(event)"  /><label>Piso:</label><input type="text" id="piso"  name="piso" maxlength="2" size="1" />
    <label>Dpto:</label><input type="text" id="dpto" name="dpto" maxlength="4" size="1" /><br /><br />
      <label>Email:</label><input type="text" id="email" name="email" maxlength="100"/>
      <label>Celular</label><input type="text" id="cel" name="cel" maxlength="100" onkeypress="return numeros(event)"/>
<br /><br />
    <label>Código de actividad según Municipio de Resistencia<br /> (aquella actividad que genera la mayor cantidad de residuos):</label>
    <input type="text" id="cgoActividadMuni"  name="cgoActividadMuni" maxlength="15"/><br /><br />
    <label>Código de actividad según ATP <br>(aquella actividad que genera la mayor cantidad de residuos):</label>
    <input type="text" id="cgoActividadAtp" name="cgoActividadAtp" maxlength="15"/><br /><br />
  <div id='sucursalA'>
  <h2>6)A .DATOS DE SUCURSAL:</h2>
    <label>6)A.1. Domicilio: Calle:</label><input type="text" name="calle1" maxlength="50"  required="required"/>
    <label>Altura:</label><input type="text" name="altura1" maxlength="20" size="4"  required="required" onkeypress="return numeros(event)" /><label>Piso:</label><input type="text" name="Piso1" maxlength="2" size="1" />
    <label>Dpto:</label><input type="text" name="dpto1" maxlength="4" size="1" /><br /><br />
    <label>6)A.2. Dimensiones del local:</label>
    <input type="text" name="dimensiones" maxlength="20" onkeypress="return numeros(event)" /><label> metros cuadrados -completar con números-</label><br /><br />
    <label>6)A.3. Kilogramos o metros cúbicos de basura generada por día (calculo estimativo)</label><br/>
    <label>-completar con números- -debe completar al menos una de las variables-</label><br/><br/>
<div id='a3Tabla' class="a3Tabla" >
    <table id="tablaResiduos" border="1" style="border-collapse: collapse">
<tr>
  <td><strong></strong></td>
  <td><strong>Lunes</strong></td>
  <td><strong>Martes</strong></td>
  <td><strong>Miercoles</strong></td>
  <td><strong>Jueves</strong></td>
  <td><strong>Viernes</strong></td>
  <td><strong>Sabado</strong></td>
  <td><strong>Domingo</strong></td>
</tr>
<tr>
  <td><strong>Mts. Cubicos</strong></td>
  <td><input type="text" id="mtsLunFocus" name="mtsLun" maxlength="20" onkeypress="return numeros(event)" /></td>
  <td><input type="text" id="mstMarFocus" name="mtsMar" maxlength="20" onkeypress="return numeros(event)" /></td>
  <td><input type="text" id="mstMierFocus" name="mtsMier" maxlength="20" onkeypress="return numeros(event)" /></td>
  <td><input type="text" id="mstJuevFocus" name="mtsJuev" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" id="mstVierFocus" name="mtsVier" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" id="mstSabFocus" name="mtsSab" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" id="mstDomFocus" name="mtsDom" maxlength="20" onkeypress="return numeros(event)"/></td>
</tr>
<tr>
  <td><strong>Kg.</strong></td>
  <td><input type="text" name="kgLun" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="kgMar" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="kgMier" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="kgJuev" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="kgVier" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="kgSab" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="kgDom" maxlength="20" onkeypress="return numeros(event)"/></td>
</tr>
<tr>
  <td><strong>Cantidad de bolsas<br> tipo consorcio</strong></td>
  <td><input type="text" name="bolLun" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="bolMar" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="bolMier" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="bolJuev" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="bolVier" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="bolSab" maxlength="20" onkeypress="return numeros(event)"/></td>
  <td><input type="text" name="bolDom" maxlength="20" onkeypress="return numeros(event)"/></td>
</tr>
</table>
</div>
<br><br>
<div id='a6' class="a6">
<h3>6) A.4. Tipo de Basura (calculo estimativo):</h3><h4>-completar con números- -debe sumar 100%-</h4><br/>
<label>Cartones y papeles: </label><input type="text" id="pcartones" name="cartones" maxlength="10"  onkeypress="return numeros(event)"/><label>%</label><br />
<label>Plásticos y vidrios:</label><input type="text" id="pplasticos" name="plasticos" maxlength="10"    onkeypress="return numeros(event)"/><label>%</label><br />
<label>Organicos: </label><input type="text" id="porganicos" name="organicos" maxlength="10"    onkeypress="return numeros(event)"/><label>%</label><br />
<label>Otros residuos con tratamiento especial<br>(Especificar: químicos	peligrosos, patológicos entre otros):</label>
<input type="text" name="tipoOtros" class="tipoOtros" maxlength="50"   /><label>-</label>
<input type="text" id="potros" name="otros" maxlength="10"    onkeypress="return numeros(event)"/><label>%</label><br />
</div>
<div id='a5MsgErr' style="margin-top:40px;"></div>
<h3>6) A.5. ¿En la actualidad recibe un servicio diferencial de recolección de residuos?</h3>
<h4>-Tildar la que corresponde-</h4>
<input type="radio" id="a5Foco" name="optDif" value="si" onchange="foptDif('si')">SI<br>
<input type="radio" name="optDif" value="no" onchange="foptDif('no')">NO<br><br>
<!--DESPLEGAR SI optDifSi es SI-->
<div id='idoptDifSi'>
<input type="radio" id="optDifSiFoco"name="optDifSi" onchange="foptDifSiTercero('muni')" value="muni">6) A.5.a Prestado por el municipio<br>
<input type="radio" name="optDifSi" onchange="foptDifSiTercero('ter')" value="tercero">6) A.5.b Prestado por un tercero<br>
<input type="radio" name="optDifSi" onchange="foptDifSiTercero('tas')" value="tas">6) A.5.c Prestado por un tercero TAS (tracción a sangre)<br><br>
<!--DESPLEGAR SI optDifSi es tercero-->
</div>
<div id='optDifSiTercero'>
<label>6) A.5.b1 Especificar el tercero que empresa/organización le presta el servicio:</label><br />
<input type="text" name="DifSiTercero"/><br><br>
</div>
<div id='optDifSiB'>
<div id="a5b2MsgErr">
<label>6) A.5.b2 Frecuencia del servicio diferencial:</label><br/>
<input type="radio" id="optDifSiBFoco" name="freqDif" value="6">6 veces por semana<br>
<input type="radio" name="freqDif" value="12">12 veces por semana<br>
<input type="radio" name="freqDif" value="18">18 veces por semana<br>
<input type="radio" name="freqDif" value="24">24 veces por semana<br>
<input type="radio" name="freqDif" value="mas24">más de 24 veces por semana<br><br>
</div>
<div id="a5c">
<label>6) A.5.c ¿El servicio diferencial actual cubre sus necesidades?</label><br/>
<label>-Tildar la que corresponde-</label><br/>
<input type="radio" id="a5cFoco" name="cubreDif" onChange="fcubreDif('si')" value="si">SI<br>
<input type="radio" name="cubreDif" onChange="fcubreDif('no')" value="no">NO<br><br>
</div></div><!-- fin div -->
<!--DESPLEGAR SI optDif es NO-->
<div id="optDifNo">
<label>6) A.5.1 ¿Considera que necesita un servicio diferencial de recolección de residuos?</label><br/>
<label>-Tildar la que corresponde-</label><br/>
<input type="radio" id="optDifNoFocus" name="necDif" onChange="foptDifNo('si')" value="si">SI<br>
<input type="radio" name="necDif" onChange="foptDifNo('no')" value="no">NO<br><br>
</div>
<!--DESPLEGAR SI necDifNo es SI-->
<div id="optDifNoSi">
<label>6) A.5.1 A ¿Con qué frecuencia semanal necesitaría el servicio diferencial?</label><br/>
<input type="radio" id="a51aFoco" name="freqNecDif" value="6">6 veces por semana<br>
<input type="radio" name="freqNecDif" value="12">12 veces por semana<br>
<input type="radio" name="freqNecDif" value="18">18 veces por semana<br>
<input type="radio" name="freqNecDif" value="24">24 veces por semana<br>
<input type="radio" name="freqNecDif" value="mas24">más de 24 veces por semana<br><br>
</div>
<div id="6a6">
<h3>6) A.6. ¿En qué lugar deposita la basura?</h3>
<h4>-Tildar la que corresponde-</h4>
<input type="radio" id="6a6Focus" name="depBasura" value="cestos" onchange="flbltxtOtros('cestos')">cestos estándar<br>
<input type="radio" name="depBasura" value="contenedores" onchange="flbltxtOtros('cont')">contenedores<br>
<input type="radio" name="depBasura" value="otros" onchange="flbltxtOtros('otros')">otros<br>
<div id='lbltxtOtros'><label>(especificar cual es)</label><input type="text" id="txtOtros" name="txtOtros"/></div><br><br>
</div>
<div id="6a7">
<h3>6) A.7.¿En qué horario pasa el recolector por su local?</h3>
<h4>-Tildar la que corresponde-</h4>
<input type="radio" id="6a7Focus" name="hrRec" value="mat">Matutino<br>
<input type="radio" name="hrRec" value="ves">Vespertino<br>
<input type="radio" name="hrRec" value="noc">Nocturno<br><br>
</div>
</div><!-- cierre div sucursalA-->
<h3>7) ¿Qué sugerencia aportaría para mejorar su servicio de recolección?</h3><br/><br/>
<textarea name="opinionRec" rows="10" cols="40"></textarea><br><br>
<!--AGRAGAR SUCURSAL B-->
<!--<div class="col-md-2" style="margin-right:30px">
<input type="button" name="agregarSuc" value="Guardar y Agregar Otra Sucursal"></div>-->
<div class="col-md-2"><input type="submit" name="Submit" value="GUARDAR" /></div>

<!--
<input type="hidden" name="botPress">
<div class="col-md-2" style="margin-right:30px">
<input type="button" name="Submit" value="Guardar y Agregar Otra Sucursal" onclick="Nom(this.form,'otraSuc')">
</div>
<div class="col-md-2" style="margin-right:30px">
<input type="button" name="Submit" value="GUARDAR y FINALIZAR" onclick="Nom(this.form,'guardar')">
</div>-->
<div class="col-md-2"><input type="reset" /></div><br><br>
</form>
<label>Nota: Se guardará la sucursal actual<br>Permanecerán los datos ingresados de su Razon Social<br>
Si luego desea agregar otra sucursal simplemente llene el formulario con los datos de su otra sucursal<br>
</label><br/>
</div><!-- cierre div class="container-fluid"-->
<br>
<!--<SCRIPT LANGUAGE="JavaScript">
        function Nom(form,valboton){
            form.botPress.value = valboton;
            form.submit();
        }
</script>-->
<?php
if (isset($_SESSION['sRS'])){
  $varSRS=$_SESSION['sRS'];
  $varSPrecuit=$_SESSION['$sPrecuit'];
  $varSCuit=$_SESSION['$sCuit'];
  $varSPostcuit=$_SESSION['$sPostcuit'];
  $varSCalle=$_SESSION['$sCalle'];
  $varSAltura=$_SESSION['$sAltura'];
  $varSPiso=$_SESSION['$sPiso'];
  $varSDpto=$_SESSION['$sDpto'];
  $varSCodActMuni=$_SESSION['$sCodActMuni'];
  $varSCodActAtp=$_SESSION['$sCodActAtp'];
  //cargo las variables de session en los input
  echo "<script>document.getElementById('txtRS').value='$varSRS'
  document.getElementById('cuit1').value='$varSPrecuit'
  document.getElementById('cuit').value='$varSCuit'
  document.getElementById('cuit3').value='$varSPostcuit'
  document.getElementById('calle').value='$varSCalle'
  document.getElementById('altura').value='$varSAltura'
  document.getElementById('piso').value='$varSPiso'
  document.getElementById('dpto').value='$varSDpto'
  document.getElementById('cgoActividadMuni').value='$varSCodActMuni'
  document.getElementById('cgoActividadAtp').value='$varSCodActAtp';</script>";
  /*
  echo "<script>document.getElementById('txtRS').value='$varSRS'";
  echo "<script>document.getElementById('cuit1').value='$varSPrecuit'";
  echo "<script>document.getElementById('cuit').value='$varSCuit'";
  echo "<script>document.getElementById('cuit3').value='$varSPostcuit'";
  echo "<script>document.getElementById('calle').value='$varSCalle'";
  echo "<script>document.getElementById('altura').value='$varSAltura'";
  echo "<script>document.getElementById('piso').value='$varSPiso'";
  echo "<script>document.getElementById('dpto').value='$varSDpto'";
  echo "<script>document.getElementById('cgoActividadMuni').value='$varSCodActMuni'";
  echo "<script>document.getElementById('cgoActividadMuni').value='$varSCodActAtp'";
  echo ";</script>";
  //
  $_SESSION['sRS']=$razonsocial;
  $_SESSION['$sPrecuit']=$precuit;
  $_SESSION['$sCuit']=$ccuit;
  $_SESSION['$sPostcuit']=$postcuit;
  $_SESSION['$sCalle']=$calle;
  $_SESSION['$sAltura']=$altura;
  $_SESSION['$sPiso']=$piso;
  $_SESSION['$sDpto']=$dpto;
  $_SESSION['$sCodActMuni']=$codActMuni;
  $_SESSION['$sCodActAtp']=$codActAtp;
  */
}//else{
//  echo('SE PERDIERON LAS VAR DE SESS' );
  //echo($_SESSION['sRS']);
//}
?>
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
