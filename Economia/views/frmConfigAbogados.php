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
<title>Configuración de Abogados</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.png' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../js/confabo.js"></script>
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
    </table>
 </section>
    <div class="registros" id="agrega-registros">
        <table class="table table-striped table-condensed table-hover">
         <tr>
          <th width="50">idh</th> 
          <th width="50">tipo</th>
          <th width="50">aynabo</th>
          <th width="50">honorabo</th> 
          <th width="50">dnidem</th>
          <th width="20">Opcion</th>
         </tr>
          <?php
            include "../Conexion/Conexion.php";
            $conexion=Conectarse();
            $queryu="SELECT * FROM honorabogados ORDER BY dnidem asc";
            $registro = mysqli_query($conexion,$queryu); 
            while($registro2 = mysqli_fetch_array($registro)){
              echo '<tr>
                    <td>'.$registro2['idh'].'</td>
                    <td>'.$registro2['tipo'].'</td>
                    <td>'.$registro2['aynabo'].'</td>
                    <td>'.$registro2['honorabo'].'</td>
                    <td>'.$registro2['dnidem'].'</td>
                    <td><a href="javascript:eliminarAbo('.$registro2['dnidem'].');" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
    <h4 class="modal-title" id="myModalLabel"><b>Configurar demandas</b></h4>
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
     <td>IdDem: </td>
     <td><input type="text" required="required" name="idcg" id="idcg" maxlength="11" readonly="readonly" /></td>
      </tr><tr>
     <td>dni:</td>
     <td>
     <input name="dnidem" id="dnidem" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%' onkeypress="return numeros(event)" required="required" />
     </td>
     </tr>
     <tr>
   	 <td>AyN:</td>
     <td><input name="ayn" type="text" id="ayn" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="55" required="required"/></td>
     </tr>
     <tr>
     <td>domreal:</td>
     <td><input name="domreal" type="text" id="domreal" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>domesp:</td>
     <td><input name="domesp" type="text" id="domesp" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>estado:</td>
     <td>
       <select name="estadocivil" size=1 style="text-align:center;font-style:bold" required="required">
    <option value='1'>SOLTERO/A </option>
    <option value='2'>CASADO/A</option>
    <option value='3'>VIUDO/A</option>
    <option value='4'>SEPARADO/A</option>
    <option value='5'>CONCUBINADO/A</option>
    <option value='6'>OTRO</option>
    <option value='7'>DIVORCIADO/A</option>
  </select>
     </td>
     </tr>
     <tr>
     <td>conyuge:</td>
     <td><input name="domesp" type="text" id="domesp" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
  <tr>
     <td>caratula:</td>
     <td><input name="caratula" type="text" id="caratula" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="200" required="required"/></td>
     </tr>
<tr>
     <td>expediente:</td>
     <td><input name="expdte" type="text" id="expdte" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50" required="required"/></td>
     </tr>
     <tr>
     <td>juzgado:</td>
     <td><input name="jzgdo" type="text" id="jzgdo" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
 onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="50"  required="required"/></td>
     </tr>
    <tr>
     <td>causa:</td>
     <td><textarea class="form-control" rows="4" cols="80" name="causa" type="text" id="causa" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="150" required="required" ></textarea></td>
     </tr>
     <tr>
     <td>monto:</td>
     <td><input name="monto" id="monto" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:75%' onkeypress="return numeros(event)" required="required" /></td>
     </tr>
<tr>
     <td>costas:</td>
     <td><input name="costas" id="costas" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:75%' onkeypress="return numeros(event)" required="required" /></td>
     </tr>
<tr>
     <td>totaldeuda:</td>
     <td><input name="tdeuda" id="tdeuda" type='text'  style='color:black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:75%' onkeypress="return numeros(event)" required="required" /></td>
     </tr>
<tr>
     <td>fechareclamo:</td>
     <td>
       
     </td>
     </tr>
<tr>
     <td>imprimio:</td>
     <td><input name="imprimio" type="text" id="imprimio" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="2" required="required"/></td>
     </tr>
<tr>
     <td>fecsen:</td>
     <td><input name="fecsen" type="text" id="fecsen" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
<tr>
     <td>fojapi:</td>
     <td><input name="fojapi" type="text" id="fojapi" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" required="required"/></td>
     </tr>
<tr>
     <td>fecapel:</td>
     <td><input name="fecapel" type="text" id="fecapel" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>fojapel:</td>
     <td><input name="fojapel" type="text" id="fojapel" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" required="required"/></td>
     </tr>
     <tr>
     <td>fecal:</td>
     <td><input name="fecal" type="text" id="fecal" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>fojaalza:</td>
     <td><input name="fojaalza" type="text" id="fojaalza" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" value="0" /></td>
     </tr>
     <tr>
     <td>fecrecu:</td>
     <td><input name="fecrecu" type="text" id="fecrecu" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>fojarecu:</td>
     <td><input name="fojarecu" type="text" id="fojarecu" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" value="0" /></td>
     </tr>
     <tr>
     <td>estado:</td>
     <td><input name="estado" type="text" id="estado" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="30" required="required"/></td>
     </tr>
     <tr>
     <td>art505:</td>
     <td><input name="art505" type="text" id="art505" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>ley2868:</td>
     <td><input name="l2868" type="text" id="l2868" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>fec4474:</td>
     <td><input name="f4474" type="text" id="f4474" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
     </tr>
     <tr>
     <td>fojaintima:</td>
     <td><input name="fojaintima" type="text" id="fojaintima" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" value="0" /></td>
     </tr>
     <tr>
     <td>privilegio:</td>
     <td><input name="privilegio" type="text" id="privilegio" style="text-transform:uppercase;color:Black;background-color:WhiteSmoke;border-color:LightSkyBlue;border-width:1px;border-style:Solid;font-family:Verdana;font-size:Small;font-weight:bold;width:100%;" 
    onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="60" required="required"/></td>
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
