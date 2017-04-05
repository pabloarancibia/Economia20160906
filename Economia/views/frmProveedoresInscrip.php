<?php
/*
if(!isset($_SESSION))
{
    session_start();
}
if (!isset($_SESSION["usuario"])){
    header("Location:../views/frmMenu.php?nologin=false");}
$_SESSION["usuario"];
$_SESSION["razonsocial"];*/
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();

?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>SOLICITUD DE PRE-INSCRIPCION</title>
<? header("text/html; charset=iso-8859-1");
//header("text/html; charset=utf-8"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<!--<link rel="stylesheet" href="../css/reset.css" type="text/css" media="screen">-->
<!--<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">-->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-select.css" media="screen" title="no title" charset="utf-8">
<!--<link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">-->

<!--<link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui.css">-->

<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-select.js" type="text/javascript"></script>
<!--
<script src="../js/jquery-ui.js" type="text/javascript"></script>
<script src="../js/jquery.validate.min.js" type="text/javascript"></script> -->


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
<td><div align="left" style="color:#ffffff;" ><p><h4>SECRETARIA DE ECONOMIA</h4></p>
 </div></td>
</tr>
<tr><td width="40%"></td>
<!--<td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:
<?php 
//echo $_SESSION["usuario"]
?>
- 
<?php 
//echo $_SESSION["razonsocial"]
?>
</h4></p>
 </div></td>-->
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
    <li><a href="../views/frmMenu.php">Principal</a></li>
   </ul></li></ul>
 </div></div>
 </nav></header>

<!-- script para formulario proveedores -->

<script "text/javascript" src="../js/ProveedoresInscrip.js"></script>
<link rel="stylesheet" type="text/css" href="../css/ProveedoresInscrip.css" media="screen" />

<!--==============================content================================-->
<!--  -->
<!--<div class="container-fluid" align="center" style="background-color:#D8D8D8;">-->

<div id='container-fluid' style="margin-right:20px;margin-left:50px">

<!-- FORMULARIO -->
<div id="divform">
	
<form id="form1" name="form1" method="post" action="../Logica/ProveedoresIncrip.php" onsubmit="return verificar()">
  <h4 align="center" class="letra" style="background-color:#7FFF00; color:red;"><strong> <?php
         if(isset($respuesta))
        echo $respuesta;?></strong></h4>
<div id="title_1">REGISTRO DE PROVEEDORES</div>
<br />
<div id='consultaProv'>
<?php
	if (!empty($_GET['tipo'])){
		if($_GET['tipo']== 'PRE290290'){

echo ("<input type='button' id='consultaProvNo' value='PRE-INSCRIPCION'/><label for=''>Si es la Primera vez que ingresa</label><br /><br />");

		}elseif ($_GET['tipo']== 'PROV280280'){
echo ("<input type='button' id='consultaProvSi' value='ACTUALIZACION'/><label for=''>Si Ya tiene número de Proveedor</label><br />");
		}
	} 
?>
<!--
  <input type="button" id="consultaProvNo" value="PRE-INSCRIPCION"/><label for="">Si es la Primera vez que ingresa</label><br /><br />
  <input type="button" id="consultaProvSi" value="ACTUALIZACION"/><label for="">Si Ya tiene número de Proveedor</label><br />
  -->
  <!--<input type="button" id="consultaProvModif" value="MODIFICAR DATOS" /><label for="">Si Ingresó mal los datos de la Pre-Inscripción</label>-->
</div>
<div id="divNumSolicitud">
  <label for="NroSol" id="lblNroSol" name='lblNroSol'>INGRESE EL NÚMERO DE SOLICITUD DE PRE INSCRIPCIÓN</label>
  <input type="text" id="NroSol" name="NroSol" class="solo-numero" placeholder="Nro SOLICITUD"/><label id="obligatorio" style="margin-left:5px;">*</label>
  <br />
  <input type="button" id="btnSigModif" value="SIGUIENTE"/>
<br />
</div>
<div id="datos">
  <!--<label>LA RE-INSCRIPCION ES PARA PROVEEDORES QUE YA RECIBIERON NUMERO</label><br />-->
  <label for="nrNroProv" id="lblNroProv" name='lblNroProv'>INGRESE SU NUMERO DE PROVEEDOR</label>
  <!-- <input type="radio" name="rdNroProv" value="si">Si<br /> -->
  <!-- <input type="radio" name="rdNroProv" value="no">No<br /><br />-->
  <input type="text" id="nroProv" name="nroProv" class="solo-numero" placeholder="Nro PROVEEDOR"/><label id="prov-obligatorio" style="margin-left:5px;">*</label>
  <br />
  <div id="title">DATOS DE LA EMPRESA</div>
  <div id="datos_1">
    <br class="clear" />
    <label for="entidad">CONDICION ANTE AFIP:  </label>
      <select name="entidad" id="entidad" class="selectpicker" required="required" ><!--class="selectpicker"-->
    <option value="MONOTRIBUTISTA">MONOTRIBUTISTA</option>
    <option value="RESTPONSABLE INSCRIPTO">RESPONSABLE INSCRIPTO</option>
    </select>
    <br class="clear" />
    <br class="clear" />
<input type="text" class="solo-numero" name="cuit1" id="cuit1" required="required" placeholder="00" />
<input type="text" class="solo-numero" name="cuit2" id="cuit2" required="required" placeholder="CUIT" />
<input type="text" class="solo-numero" name="cuit3" id="cuit3" required="required" placeholder="0" /><label id="obligatorio" style="margin-left:5px;">*</label>
<br class="clear" />
<div id="Info"></div>
<br class="clear" />
<input type="text" class="solo-numero" name="conv_multi" id="conv_multi" placeholder="CONV. MULTILATERAL Nº"/>
<br class="clear" />
</div><!-- fin datos 1 -->
<div id="datos_2">
<input type="text" name="nombres" id="nombres" placeholder="DENOMINACION O RAZON SOCIAL" required="required" style="width:400px"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="email" name="email" id="email" required  placeholder="EMAIL" style="width:300px"/><label id="obligatorio" style="margin-left:5px;">*</label><br />
<input type="text" name="domicilio" id="domicilio" placeholder="DOMICILIO: Calle" required="required" style="width:300px"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="altura" id="altura" class="altura solo-numero" placeholder="Altura" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="piso" id="piso" class="piso" placeholder="Piso"/>
<input type="text" name="dpto" id="dpto" class="dpto" placeholder="Dpto"/>
<br class="clear" />
<input type="text" name="localidad" id="localidad" placeholder="LOCALIDAD" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="tel" id="tel" class="solo-numero" placeholder="TELEFONO" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="cp" id="cp" class="solo-numero" placeholder="CODIGO POSTAL" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<br class="clear" />

<br class="clear" />
</div> <!-- datos 2 -->
<div id="datos_4">
<div id="title">DATOS DEL INTERESADO</div>
<br class="clear" />
<label for="dtos_filiat">EN CARACTER DE: </label>
<select name="dtos_filiat" id="dtos_filiat" class="selectpicker" required="required">
<option value="TITULAR">TITULAR</option>
<option value="GERENTES">GERENTE</option>
<option value="APODERADOS">APODERADO</option>
<option value="PRESIDENTES">PRESIDENTE</option>
<option value="OTRO">OTRO</option>
</select>
<br />
<input type="text" name="ap_interesado" id="ap_interesado" placeholder="APELLIDO" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="nom_interesado" id="nom_interesado" placeholder="NOMBRE" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="dni_int" id="dni_int" placeholder="DOCUMENTO" class="solo-numero" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="est_civil_int" id="est_civil_int" placeholder="ESTADO CIVIL" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<br class="clear" />
<input type="text" name="domicilio_int" id="domicilio_int" placeholder="DOMICILIO: Calle" required="required" style="width:300px"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="altura_int" id="altura_int" class="altura solo-numero" placeholder="Altura" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="piso_int" id="piso_int" class="piso" placeholder="Piso"/>
<input type="text" name="dpto_int" id="dpto_int" class="dpto" placeholder="Dpto"/>
<br class="clear" />
<input type="text" name="localidad_int" id="localidad_int" placeholder="LOCALIDAD" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="provincia_int" id="provincia_int" placeholder="PROVINCIA" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="cp_int" id="cp_int" class="solo-numero" placeholder="CODIGO POSTAL" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<br class="clear" />
<input type="text" name="tel_int" id="tel_int" class="solo-numero" placeholder="TELEFONO" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="cel_int" id="cel_int" class="solo-numero" placeholder="CELULAR" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<br class="clear" />
<div id="datos_3">
<input type="text" name="ap_pat" id="ap_pat" placeholder="APELLIDO PATERNO" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<input type="text" name="ap_mat" id="ap_mat" placeholder="APELLIDO MATERNO" required="required"/><label id="obligatorio" style="margin-left:5px;">*</label>
<br class="clear" />
</div> <!-- fin datos 3 -->
</div><!-- fin datos 4 -->
<div id="datos_5">
  <div id="title">DATOS DEL CONYUGUE</div>
<input type="text" name="ap_cony" placeholder="APELLIDO" id="ap_cony" />
<input type="text" name="nom_cony" placeholder="NOMBRE" id="nom_cony" />
<input type="text" name="dni_cony" id="dni_cony" class="solo-numero" placeholder="DNI" />
<br class="clear" />
</div> <!-- fin datos 5 -->
<div id="datos_6">
<div id="title">AUTORIDADES (SOCIOS - GERENTES - APODERADOS - PRESIDENTE ASOC. COOP. ETC.)</div>
<input type="text" name="ap_aut" id="ap_aut" placeholder="APELLIDO" />
<input type="text" name="nom_aut" id="nom_aut" placeholder="NOMBRE" />
<input type="text" name="cargo_aut" id="cargo_aut" placeholder="CARGO" />
<input type="text" name="tipo_doc_aut" id="tipo_doc_aut" class="tipoDoc" placeholder="TIPO" />
<input type="text" name="documento_aut" id="documento_aut" class="solo-numero" placeholder="DOCUMENTO NUMERO" />
<br class="clear" />
<input type="text" name="ap_aut2" id="ap_aut2" placeholder="APELLIDO" />
<input type="text" name="nom_aut2" id="nom_aut2" placeholder="NOMBRE" />
<input type="text" name="cargo_aut2" id="cargo_aut2" placeholder="CARGO" />
<input type="text" name="tipo_doc_aut2" id="tipo_doc_aut2" class="tipoDoc" placeholder="TIPO" />
<input type="text" name="documento_aut2" id="documento_aut2" class="solo-numero" placeholder="DOCUMENTO NUMERO" />
<br class="clear" />
<input type="text" name="ap_aut3" id="ap_aut3" placeholder="APELLIDO" />
<input type="text" name="nom_aut3" id="nom_aut3" placeholder="NOMBRE" />
<input type="text" name="cargo_aut3" id="cargo_aut3" placeholder="CARGO" />
<input type="text" name="tipo_doc_aut3" id="tipo_doc_aut3" class="tipoDoc" placeholder="TIPO" />
<input type="text" name="documento_aut3" id="documento_aut3" class="solo-numero" placeholder="DOCUMENTO NUMERO" />
<br class="clear" />
<input type="text" name="ap_aut4" id="ap_aut4" placeholder="APELLIDO" />
<input type="text" name="nom_aut4" id="nom_aut4" placeholder="NOMBRE" />
<input type="text" name="cargo_aut4" id="cargo_aut4" placeholder="CARGO" />
<input type="text" name="tipo_doc_aut4" id="tipo_doc_aut4" class="tipoDoc" placeholder="TIPO" />
<input type="text" name="documento_aut4" id="documento_aut4" class="solo-numero" placeholder="DOCUMENTO NUMERO" />
<br class="clear" />
<!--<fieldset>
<input type="button" id="btAddAut" value="AGREGAR AUTORIZADO" />
</fieldset>
<div id="aut">
</div>
<br />
<input type="button" id="btRemoveAut" value="ELIMINAR AUTORIZADO" />
<input type="button" id="btRemoveAllAut" value="ELIMINAR TODOS" />-->
</div><!-- fin div datos 6 -->
<div id="datos_7">
  <div id="title">RUBRO</div>
  <!-- fin div datos 6
<input type="text" name="n_rubro" id="n_rubro" placeholder="N RUBRO" />
<textarea name="descripcion_rubro" id="descripcion_rubro"  rows="3" cols="40" placeholder="DESCRIPCION" /></textarea>
<br class="clear" />
<input type="text" name="rubro" id="rubro" placeholder="RUBRO" />
<textarea name="descripcion2_rubro" id="descripcion2_rubro" rows="3" cols="40" placeholder="DESCRIPCION" /></textarea>
-->
<br class="clear" />
<!--</div> --><!-- fin div datos 7 -->
<!--<br class="clear" /> -->
<!--<div id="datos_8">-->
<!-- div datos 8 -->
<!-- div datos 8 -->
<!-- div datos 8 -->
<!--
<div class="modal fade" id="registra-factura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita un Pedido</b></h4>
   </div>--><!-- fin modal-header -->
<table>
<td><label for="rubro">Rubro:</label> </td>
<td>
<?php
$sql="select * from rubros order by rubro asc";
$res=mysqli_query($conexion,$sql);
?>
<strong>
<select name="rubro" size=1 id="rr" class="selectpicker" onchange="cargarsub(id)">
<option value="0">Seleccione</option>
<?php while ($fila=mysqli_fetch_array($res)){
?>
<option value="<?php echo $fila['rubro']?>"><?php echo utf8_decode($fila['rubrodesc']);?></option>
<?php }?>
</select></strong></td>
</tr>
 <?php
 $sql="select * from subrubros order by subrubro asc";
  $res2=mysqli_query($conexion,$sql);
?>

<tr>
<td><label for="subrubro">Sub-Rubro: </label></td>
<td>
<strong>
<select name="subrubro" size=1 id="srr" disabled ><!--class="selectpicker"-->
<option value="0">Seleccione</option>

<?php while ($fila=mysqli_fetch_array($res2)){  ?>
<option id="<?php echo $fila['irubro']?>" value="<?php echo $fila['subrubro']?>"><?php echo utf8_decode($fila['subrubdesc']);?></option>
<?php }?>
</select></strong>
<script type="text/javascript">
function cargarsub(idrubro){
var select = document.getElementById(idrubro);
var seleccionado = select.options[select.selectedIndex].value;
var selectEst = document.getElementById("srr");
selectEst.disabled=false;
selectEst.value=0;
for (var i = 0; i < selectEst.length; i++) {
  var opt = selectEst[i];
   if (seleccionado == opt.id)
{
 document.getElementById("srr").options[i].style.display ="";
 }else{

document.getElementById("srr").options[i].style.display ="none";

}
}
}  </script>
</td></tr>
</table>
<!--<input type="submit" id="agregarRubro" name="agregarRubro" value="AGREGAR RUBRO"/>-->



  <fieldset>
     <input type="button" id="btAdd" value="AGREGAR RUBRO" />
  </fieldset>
  <div id="main">
  </div>

<!--</div>--><!-- fin modal-content -->
<!--</div>--><!-- fin modal-dialog -->
<!--</div>--> <!-- fin div modal fade -->
<br />
<input type="button" id="btRemove" value="ELIMINAR RUBRO" />
<input type="button" id="btRemoveAll" value="ELIMINAR TODOS" />
<!-- fin div datos 8 -->
<!-- fin div datos 8 -->
<!-- fin div datos 8 -->
</div>
<div id="dialogoFormulario" title="Atención" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
	</span>¿Realmente desea enviar el contenido de este formulario?</p>
</div>
<div id="title">GUARDAR</div>
<br />
<label>Los campos marcados con * son obligatorios</label><br /><br />

<!-- ZONA CAPTCHA -->

<div class="row">
 <div class="col-md-3"></div>
  <div class="col-md-1">
  <p><img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" /></p>
   </div>
 </div>
 <!-- <div class="row"> -->
 <div>
   <div class="col-md-3"></div>
   <div class="col-md-2">Copie el codigo de seguridad:</div>
   <div class="col-md-5"><input type="text" name="captcha_code" size="60" maxlength="6" />
          <a href="#" onClick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">[ Elegir otra imagen]</a></div>
  <div class="col-md-3">
  <strong><style="background-color:#7FFF00; color:red; width: 428px; height: 45px;"><?php 
      if(isset($respuesta))
      echo $respuesta;?></style></strong> 
</div>
 </div>
<!-- FIN ZONA CAPTCHA -->
<input type="submit" name="Submit" value="GUARDAR" />
<input type="reset" />
</div><!-- fin div datos -->
</form>
</div><!-- fin div form -->
</div><!-- cierre div class="container-fluid"-->
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
