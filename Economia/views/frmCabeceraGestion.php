<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}
$_SESSION["apynom"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Cabecera Seguimiento</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/cabegest.js"></script>
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
<div class="container" 
style="background-color:#E6E6E6;border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
border: 10px solid #ffffff;">
<body>
<section>
  <table border="0" align="center">
   <tr>
    <td width="150"><button id="nueva-factura" class="btn btn-primary">NUEVA CABECERA-GESTION</button></td>
<!--td width="150"><a href="../views/expCabPedMat.php" class="btn btn-danger">EXCEL</a></td-->
   </tr>
  </table>
 </section>
    <div class="registros" id="agrega-registros">
        <table class="table table-striped table-condensed table-hover">
         <tr>
          <th width="50" style="font-family:verdana;font-size:60%;">idgc</th><th width="100" style="font-family:verdana;font-size:60%;">aleatorio</th>
          <th width="100" style="font-family:verdana;font-size:60%;">secretaria</th><th width="50" style="font-family:verdana;font-size:60%;">aniop</th>
          <th width="50" style="font-family:verdana;font-size:60%;">nrop</th><th width="100" style="font-family:verdana;font-size:60%;">estimado</th>
          <th width="50" style="font-family:verdana;font-size:60%;">pedmat</th><th width="50" style="font-family:verdana;font-size:60%;">aniooc</th>
          <th width="50" style="font-family:verdana;font-size:60%;">nrooc</th><th width="50" style="font-family:verdana;font-size:60%;">asignado</th><th width="50" style="font-family:verdana;font-size:60%;">fecoc</th><th width="50" style="font-family:verdana;font-size:60%;">proveedor</th><th width="50" style="font-family:verdana;font-size:60%;">actuacions</th>
          <th width="50" style="font-family:verdana;font-size:60%;">fecas</th><th width="50" style="font-family:verdana;font-size:60%;">nropv</th>
          <th width="50" style="font-family:verdana;font-size:60%;">Opciones</th>
         </tr>
          <?php
            include "../Conexion/Conexion.php";
            $conexion=Conectarse();
            $queryu="SELECT * FROM gestioncompra ORDER BY idgc asc;";
            $registro = mysqli_query($conexion,$queryu); 
            while($registro2 = mysqli_fetch_array($registro)){
              echo '<tr style="font-family:Verdana;font-size:Small;">
                    <td>'.$registro2['idgc'].'</td>
                    <td>'.$registro2['aleatorio'].'</td>
                    <td>'.$registro2['secretaria'].'</td>
                    <td>'.$registro2['aniop'].'</td>
                    <td>'.$registro2['nrop'].'</td>
                    <td>'.$registro2['estimado'].'</td>
                    <td>'.$registro2['pedmat'].'</td>
                    <td>'.$registro2['aniooc'].'</td>
                    <td>'.$registro2['nrooc'].'</td>
                    <td>'.$registro2['asignado'].'</td>
                    <td>'.$registro2['fecoc'].'</td>
                    <td>'.$registro2['proveedor'].'</td>
                    <td>'.$registro2['actuacions'].'</td>
                    <td>'.$registro2['fecas'].'</td>
                    <td>'.$registro2['nropv'].'</td>
                    
                    <td><a href="javascript:editarPCMExGest('.$registro2['idgc'].');" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-pencil"></i></a> 
                        <a href="javascript:eliminarPCMExGest('.$registro2['idgc'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                    </tr>';       
            }
        ?>
       </table>
    </div>
    <br>
    <!-- MODAL PARA CONFIGURAR SECRETARIAS-->
<div class="modal fade" id="registra-factura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><b>Configurar Cabeceras de Gestion</b></h4>
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
     <td>Idgc: </td>
     <td><input type="text" required="required" name="idgc" id="idgc" maxlength="11" readonly="readonly" /></td>
     <td>Aleatorio:</td>
     <td>
     <input type="text" required="required" name="aleatorio" id="aleatorio" maxlength="11" />
     </td>
     </tr>
     <tr>
   	 <td>Secretaria:</td>
     <td><input type="text" required="required" name="secretaria" id="secretaria" maxlength="5" /></td>
     <td>aniop: </td>
     <td><input type="text" required="required" name="aniop" id="aniop" maxlength="11" /></td>
     </tr>
     <tr>
     <td>nrop:</td>
     <td>
     <input type="text" required="required" name="nrop" id="nrop" maxlength="12" />
     </td>
     <td>estimado:</td>
     <td><input type="text" required="required" name="estimado" id="estimado" /></td>
     </tr>
     <tr>
     <td>pedmat: </td>
     <td><input type="text" required="required" name="pedmat" id="pedmat" maxlength="100"/></td>
    <td>aniooc:</td>
     <td>
     <input type="text" required="required" name="aniooc" id="aniooc" maxlength="11" />
     </td>
     </tr>
     <tr>
     <td>nrooc:</td>
     <td><input type="text" required="required" name="nrooc" id="nrooc" maxlength="11" /></td>
    <td>asignado: </td>
     <td><input type="text" required="required" name="asignado" id="asignado" maxlength="11" /></td>
     </tr>
     <tr>
     <td>fecoc:</td>
     <td>
     <input type="text" required="required" name="fecoc" id="fecoc" maxlength="11" />
     </td>
     <td>proveedor:</td>
     <td><input type="text" required="required" name="proveedor" id="proveedor" maxlength="90" /></td>
     </tr>
     <tr>
     <td>actuacions: </td>
     <td><input type="text" required="required" name="actuacions" id="actuacions" maxlength="45" /></td>
     <td>fecas:</td>
     <td>
     <input type="text" required="required" name="fecas" id="fecas" maxlength="50" />
     </td>
     </tr>
     <tr>
     <td>nropv:</td>
     <td><input type="text" required="required" name="nropv" id="nropv" maxlength="45" /></td>
     </tr>
     <tr>
     <td colspan="2">
      <div id="mensaje"></div>
     </td>
     </tr>
 </table>
</div>
<div class="modal-footer">
 <input type="submit" value="Agregar" class="btn btn-success" id="reg"/>
 <input type="submit" value="Modificar" class="btn btn-warning"  id="edi"/>
</div>
</form>
</div>
</div>
</div>
<br><br>      
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
</div>
</html>