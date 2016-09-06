<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];
include "../Conexion/Conexion.php";
$conexion=Conectarse();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Carga Informacion complemetaria de Pedidos de Materiales</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/gestioncompras.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
        <![endif]-->
</head>
<!---------------------------------------------->
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
</h5></p>
 </div></td>

</tr>

</table>
<nav class="navbar navbar-default">
<div class="container-fluid">

<div class="collapse navbar-collapse" id="navbar-1">
 <ul class="nav navbar-nav">
 <li class="dropdown">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">INICIO<span class="caret"></span></a>
    <ul class="dropdown-menu">
    <li><a href="../views/frmMenuUsuarios.php">Menú</a>
    </li>
   </ul>
 </li>
 </ul>
 </div>
 </div>
 </nav>

</header>
<!---------------------------------------------->
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
<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 20px solid #ffffff;">
 <section>
  <table border="0" align="center">
   <tr>
   <td width="380"><input type="text" placeholder="Ingrese N�mero Id aleatorio del Pedido de Materiales" id="idal" onkeypress="return numeros(event)" ><a href="JavaScript:verifica-factura('.$registro2['idpedidomateriales'].')"/a></td>
   <td width="100"><button id="verifica-factura" class="btn btn-primary">Buscar</button></td>
   </tr>
  </table>
 </section>
 <?php
  $query="select a.idpedidomateriales, a.isecre, a.aniopedido, a.nropedido, a.totalped, b.pedmat, b.aniooc, b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, b.fecas, b.nropv from pedidomateriales a, gestioncompra b where a.idpedidomateriales=b.aleatorio order by a.idpedidomateriales desc limit 15;";
  
 ?>

    <div class="registros" id="agrega-registros">
        <table class="table table-striped table-condensed table-hover">
         <tr>
          <th width="100" style="font-family:verdana;font-size:60%;">ALEATORIO</th> 
          <th width="100" style="font-family:verdana;font-size:60%;">SECRETARIA</th>
          <th width="50" style="font-family:verdana;font-size:60%;">AÑO</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PEDIDO</th>
          <th width="100" style="font-family:verdana;font-size:60%;">ESTIMADO$</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PED.MAT</th>
          <th width="50" style="font-family:verdana;font-size:60%;">AÑO OC</th>
          <th width="50" style="font-family:verdana;font-size:60%;">NRO.O.C</th>
          <th width="50" style="font-family:verdana;font-size:60%;">MONTO ASIG.$</th>
          <th width="50" style="font-family:verdana;font-size:60%;">FECHA O.C</th>
          <th width="50" style="font-family:verdana;font-size:60%;">NRO.PROV.</th>
          <th width="50" style="font-family:verdana;font-size:60%;">PROVEEDOR</th>
          <th width="50" style="font-family:verdana;font-size:60%;">TIPO CONTRATACION</th>
          <th width="50" style="font-family:verdana;font-size:60%;">FECHA CONTRATACION</th>
          <th width="50" style="font-family:verdana;font-size:60%;">Opciones</th>
         </tr>
         <?php 
         $registro=mysqli_query($conexion,$query);
         while ($registro2=mysqli_fetch_array($registro)) {
         echo '<tr>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['idpedidomateriales'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['isecre'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['aniopedido'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['nropedido'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['totalped'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['pedmat'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['aniooc'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['nrooc'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['asignado'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['fecoc'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['nropv'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['proveedor'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['actuacions'].'</td>
          <td style="font-family:verdana;font-size:80%;">'.$registro2['fecas'].'</td>
         <td style="font-family:verdana;font-size:80%;">
         <a href="JavaScript:editarGC('.$registro2['idpedidomateriales'].')" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a></td>
         </tr>';
         }?>
         </table>
  </div>
    <br>

    <!-- MODAL PARA EL REGISTRO DE FACTURAS-->
<div class="modal fade" id="registra-factura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><b>Completar Pedido Materiales</b></h4>
   </div>
   <form id="formulario" class="formulario" onsubmit="return agregaRegistro();">
   <div class="modal-body">
    <table border="0" width="100%">
    <tr>
    <td colspan="2">
    <input type="text" required="required" readonly="readonly" name="idf" id="idf" readonly="readonly" style="visibility:hidden; height:5px;"/>
    
    </td>
    </tr>
     <tr>
      <td width="150">Proceso: </td>
      <td><input type="text" required="required" readonly="readonly" id="pro" name="pro"/></td>
     </tr>
     <tr>
     <td>Secretaria: </td>
     <td><input type="text" required="required" name="nsec" id="nsec" maxlength="11" readonly="readonly" /></td>
     </tr>
     <tr>
     <td>Año Pedido:</td>
     <td><input type="text" required="required" name="anp" id="anp" maxlength="11" readonly="readonly" /></td>
     </td>
     <!--/tr>
     <tr-->
   	 <td>Numero Pedido:</td>
     <td><input type="text" required="required" name="nrop" id="nrop" maxlength="15" readonly="readonly" /></td>
     </tr>
     <tr>
     <td>Estimado $: </td>
     <td><input type="text" required="required" name="estima" id="estima" maxlength="15" readonly="readonly" /></td>
     </td>
     <td>Pedido Material:(Dpto.Compras): </td>
     <td><input type="text" required="required" name="pedmatcom" id="pedmatcom" onkeypress="return numeros(event)"/></td>
     </td>
     </tr>
     <tr>
     <td>Año O.C:(Dpto.Compras) </td>
     <td>
      <select required="required" name="anoc" id="anoc" maxlenght="23"><option value='1'>2016</option>
        </select>
     </td>
     <!--/tr>
     <tr-->
     <td>Número O.C:(Dpto.Compras) </td>
     <td><input type="text"  required="required" name="noc" id="noc" maxlength="13" onkeypress="return numeros(event)" />
     </td>
    
     </tr>
     <tr>
     <td>Monto Asignado $: </td>
     <td><input type="text"  required="required" name="asigna" id="asigna" onkeypress="return numeros(event)" />
     </td>
     <!--/tr>
     <tr-->
     <td>Fecha O.C: </td>
     <td><p><select name="diaoc">
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
<select name="messoc">
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
</select> <select name="aniooc">
  <?php
    $tope = date("Y");
   // $edad_max = 3;
    //$edad_min = 1;
    for($a= $tope ; $a<=$tope; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p>
  

     </td>
    
     </tr>
     <tr>
     <td>Proveedor(Nro): </td>
     <td><input type="text"  name="provee" id="provee" required="required" maxlength="10"  onkeypress="return numeros(event)"/>
     </td>
     <td>Proveedor(Razón Social): </td>
     <td><input type="text"  name="proveer" id="proveer" required="required" maxlength="85" />
     </td>
     </tr>
     <tr>
     <td>Tipo Contratación: </td>
     <td>
     <select required="required" name="actuacions" id="actuacions" maxlenght="40" style="font-family:verdana;font-size:80%;">
     <option value='1'>COMPRA DIRECTA</option>
     <option value='2'>CONTRATACION DIRECTA</option>
     <option value='3'>CONCURSO DE PRECIOS</option>
     <option value='4'>LICITACION PRIVADA</option>
     <option value='5'>LICITACION PUBLICA</option>
        </select>
     </td>
     <!--/tr>
     <tr-->
     <td>Fecha Contratación: </td>
     <td><p><select name="diaas">
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
<select name="mesas">
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
</select> <select name="anioas">
  <?php
    $tope = date("Y");
   // $edad_max = 3;
    //$edad_min = 1;
    for($a= $tope ; $a<=$tope; $a++)
      echo "<option value='$a'>$a</option>"; 
  ?>
</select></p>
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
</form>
</div>
</div>
</div>
<br><br> </div>     
<small> 
<div class="row" style="height:120px; background-color:#151515;color:#ffffff; font-family:Arial;font-size:8pt;">
<div class="col-md-12" align="center">
    <p>Municipalidad de Resistencia<br />
    Av. Italia Nº 150<br />
    Telefono de Informes: (362) 4458201</p>
    <p>Todos los derechos reservados &copy; 2016<br />
      Se permite la reproduccion del contenido<br />
      citando la fuente
    </p>
  </div>
</div>
</small>
</body>
</html>
