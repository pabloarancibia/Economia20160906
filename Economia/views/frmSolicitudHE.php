<?php 
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];$_SESSION["secretaria"];

$nsec=$_SESSION["secretaria"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Solicitud de Horas Extras</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/solhe.js"  type="text/javascript"></script>
 <script src="../js/jquery-migrate-1.2.1.min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
        <![endif]-->
</head>
<body class="body" style=" background-image: url(../images/bgcity.jpg);
  background-attachment: fixed;">
   <!--========header==========================-->
<header>
<table width="100%" height="10" border="0" >
<tr>
<td><div align="left" style="color:#ffffff;" ><p><h4>SECRETARIA DE ECONOMIA</h4></p>
 </div></td><td><div align="left" style="color:#ffffff;" ><p><h4>USUARIO:<?php echo $_SESSION["apynom"]?></h4></p>
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
 </nav>
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

 </header>
<!----------------------------------------------------------- -->
<div class="col-md-12" align="center"><button id="nueva-factura" class="btn btn-primary">AGREGAR PERSONA</button></div>
<br>
<div class="registros" id="agrega-registros">
 <table class="table table-striped table-condensed table-hover">
 <tr>
  <th width="80" align="center">GRUPO</th>
  <th width="100" align="center">COBRO</th>
  <th width="100" align="center">D.N.I</th>
  <th width="500" align="center">APELLIDO Y NOMBRE</th>
  <th width="150" align="center">PERIODO</th>
  <th width="80" align="center">HS.SOLICITADAS</th>
  <th width="200" align="center">MOTIVO</th>
  <th width="50" align="center">Opciones</th>
 </tr>
 <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
         <td><a href="" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> <a href="" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a></td>
         </tr>
        </table>

        <table class="table table-striped table-condensed table-hover">
         <tr>
          <td><h4>TOTAL HS.SOLICITADAS:</h4></td><td></td>
		  
         </tr>
        </table>
    </div>
    <br>
<!--==============================content================================-->

<form rol="form" id="form1" name="form1" method="post" action="../Logica/agrega_heCab.php">
<!--==============================content================================-->

<div class="container-fluid" align="center" style="background-color:#D8D8D8;">
<br>
<div class="row">

<?php
    include "../Conexion/Conexion.php";
   $conexion=Conectarse();   
   $usec=$_SESSION["secretaria"];
    $sql="select * from secretarias where sec='".$usec."'order by sec asc";
    $res=mysqli_query($conexion,$sql);
    ?>
<strong><div class="col-md-1" align="left" style="width:5%">(*)SECRETARIA:</div>
<div class="col-md-2" required="required">
<select name="secret" size=1 id="" >
 <option value="0">Seleccione</option>
  <?php while ($fila=mysqli_fetch_array($res)){ 
    ?>
 <option value="<?php echo $fila['sec']?>"><?php echo $fila['detsec']?></option>
  <?php }?>
</select> 
</div></strong>
<strong><div class="col-md-1" align="left" style="width:8%">(*)SUB-SECRETARIA:</div>
<div class="col-md-4" required="required">
<select name="subsecret" size=1 id="">
 <option value="0">Seleccione</option>
  <?php 
 $sql="select * from subsecretarias ss, secretarias s where (ss.isec=s.sec)and(s.sec='".$usec."') order by ss.subsec asc";
    $res=mysqli_query($conexion,$sql);
  while ($fila=mysqli_fetch_array($res)){ 
    ?>
 <option value="<?php echo $fila['subsec']?>"><?php echo $fila['detsubsec']?></option>
  <?php }?>
</select> 
</div></strong>

<strong><div class="col-md-1" align="left" style="width:10%" >(*)DCCION.GRAL:</div>
<div class="col-md-2" required="required">
<select name="dirgral" size=1 id="">
 <option value="0">Seleccione</option>
  <?php 
 $sql="select * from dirgenerales dg, subsecretarias ss, secretarias s where (s.sec='".$usec."')and (s.sec=ss.isec) and (ss.subsec=dg.issec) order by dg.dirgral asc";
    $res=mysqli_query($conexion,$sql);
  while ($fila=mysqli_fetch_array($res)){ 
    ?>
 <option value="<?php echo $fila['dirgral']?>"><?php echo $fila['dirdetalle']?></option>
  <?php }?>
</select> 
</div></strong>
</div>
<br>

 <div class="col-md-12" align="center"><input id="b1" type="submit" class="btn btn-primary" value="GRABAR PEDIDO" />
    </div>
<br><br><br>
</form>

<!-- MODAL PARA EL REGISTRO DE HE-->
<div class="modal fade" id="registra-factura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita una Solicitud</b></h4>
   </div>
   <form id="formulario" class="formulario" onsubmit="return agregaRegistro();">
   <div class="modal-body">
    <table border="0" width="100%">
    <tr>
    <td colspan="2">
    <input type="text" required="required" readonly="readonly" name="idf" id="idf" style="visibility:hidden; height:5px;"/></td></tr>
     <tr> <td width="150">Proceso: </td>
      <td><input type="text" required="required" readonly="readonly" id="pro" name="pro"/></td>
     </tr>
     <tr><td>Grupo: </td>
     <td><strong>
    <select name="grupo" size=1 id="grupo" required="required"  >
    <option value="0">Seleccione</option>
	<option value='1'>0</option><option value='2'>1</option><option value='3'>2</option>
	<option value='4'>3</option><option value='5'>4</option><option value='6'>5</option>
	<option value='7'>6</option><option value='8'>7</option><option value='9'>8</option>
	<option value='10'>9</option><option value='11'>10</option><option value='12'>11</option>
	<option value='13'>12</option><option value='14'>13</option><option value='15'>14</option>
	<option value='16'>15</option><option value='17'>16</option><option value='18'>17</option>
	<option value='19'>18</option><option value='20'>19</option><option value='21'>20</option><option value='60'>60</option><option value='61'>61</option>
	<option value='62'>62</option><option value='63'>63</option><option value='64'>64</option>
	<option value='65'>65</option><option value='66'>66</option><option value='67'>67</option>
	<option value='68'>68</option>
     </select></strong></td>
	 </tr>
      <tr><td>Cobro: </td>
     <td><strong><input type="text"  name="cobro" id="cobro"  required="required" onkeypress="return numeros(event)"  />
    </strong></td>
     </tr>
	  <tr><td>D.N.I:</td>
     <td><strong><input type="text"  name="dni" id="dni"  required="required" onkeypress="return numeros(event)"> </strong> </td></tr>
	 <tr><td>Apellido y Nombre:</td>
   <td><strong><input type="text"  name="ayn" id="ayn"  required="required" onkeyup="javascript:this.value=this.value.toUpperCase();" > </strong>
   </td></tr>
   <tr><td>Período: </td><td><strong>
    <select name="perhe" size=1 id="perhe" required="required"  >
    <option value="0">Seleccione</option>
	<option value='1'>ENERO</option><option value='2'>FEBRERO</option><option value='3'>MARZO</option>
	<option value='4'>ABRIL</option><option value='5'>MAYO</option><option value='6'>JUNIO</option>
	<option value='7'>JULIO</option><option value='8'>AGOSTO</option><option value='9'>SEPTIEMBRE</option>
	<option value='10'>OCTUBRE</option><option value='11'>NOVIEMBRE</option><option value='12'>DICIEMBRE</option></select></strong>
     </td> </tr>
	 <tr><td>H.E Solicitadas: </td>
     <td><input type="text"  name="hesol" id="hesol" required="required" onkeypress="return numeros(event)" /> </td></tr>
	 <tr> <td>Motivo: </td>
     <td><strong>
    <select name="mothe" size=1 id="mothe" required="required"  >
    <option value="0">Seleccione</option>
	<option value='1'>VACACIONES</option><option value='2'>LICENCIAS</option><option value='3'>ESTACIONALIDAD</option></select></strong>
     </td>
     </tr>
     <tr>
     <td colspan="2">
      <div id="mensaje"></div>
     </td>
     </tr>
 </table>
</div>
<div class="modal-footer">
 <input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
 <input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
</div>


<!----------------------------------------------------------- -->
<br><br>
  <br>
 </div>  
</div>
</div>

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