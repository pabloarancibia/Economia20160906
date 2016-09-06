<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}

$_SESSION["apynom"];$_SESSION["secretaria"];$_SESSION["nivel"];
$flag=0;
if (isset ($_SESSION["razon"]) )
{ $bsprod=$_SESSION['razon'];$flag=1;}
else{$bsprod="";}
if (isset ($_SESSION["bddesde"]) )
{  $bddesde=$_SESSION['bddesde'];$flag=1;}
else{$bddesde="1900-01-01";}
if (isset ($_SESSION["bdhasta"]) )
{   $bdhasta=$_SESSION['bdhasta'];$flag=1;}
else{$bdhasta="9999-12-31";}
if (isset ($_SESSION["aleatoriod"]) )
{   $aleatoriod=$_SESSION['aleatoriod'];$flag=1;}
else{$aleatoriod=0;}
if (isset ($_SESSION["aleatorioh"]) )
{  $aleatorioh=$_SESSION['aleatorioh'];$flag=1;}
else{$aleatorioh=999999;}
if (isset ($_SESSION["nroprovd"]) )
{   $nroprovd=$_SESSION['nroprovd'];$flag=1;}
else{$nroprovd=0;}
if (isset ($_SESSION["nroprovh"]) )
{   $nroprovh=$_SESSION['nroprovh'];$flag=1;}
else{$nroprovh=99999;}
if (isset ($_SESSION["nocd"]) )
{   $nocd=$_SESSION['nocd'];$flag=1;}
else{$nocd=0;}
if (isset ($_SESSION["noch"]) )
{   $noch=$_SESSION['noch'];$flag=1;}
else{$noch=99999;}
if (isset ($_SESSION["npmd"]) )
{   $npmd=$_SESSION['npmd'];$flag=1;}
else{$npmd=0;}
if (isset ($_SESSION["npmh"]) )
{   $npmh=$_SESSION['npmh'];$flag=1;}
else{$npmh=99999;}


include "../Conexion/Conexion.php";
echo "Nombre:".$bsprod;
echo "Desde:".$bddesde;
echo "Hasta:".$bdhasta;
echo "alead:".$aleatoriod;
echo "aleah:".$aleatorioh;
echo "ProvD:".$nroprovd;
echo "provH:".$nroprovh;
echo "Ocd:".$nocd;
echo "Och:".$noch;
echo "PmD:".$npmd;
echo "PmH:".$npmh;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
<title>Seguimiento de Pedido de Materiales</title>
<link rel="stylesheet" type="text/css" href="../css/estilo.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css">
<link href='../images/icono.jpg' rel='shortcut icon' type='image/jpg'/>
<script src="../js/jquery-latest.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">VOLVER A SELECCIONAR CRITERIOS<span class="caret"></span></a>
    <ul class="dropdown-menu">
    <li><a href="../views/frmConGestCom.php">Menú</a>
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
 <section>
  <table border="0" align="center">
   <tr><td>&nbsp;</td></tr>
   <tr>
   <strong><td width="350">Seleccione el formato de la información</td></strong>
   <td width="150"><a href="../views/explistaConGestCom.php" class="btn btn-primary">EXCEL</a></td>
   <td width="150"><a target="_blank" href="../views/listaConGestCom.php" class="btn btn-danger">PDF</a></td>
   

   
   </tr>
  
  </table>
 </section>
 <div class="registros" id="agrega-registros">
 <table class="table table-striped table-condensed table-hover">
  <tr>
  <th width="100" style="font-family:verdana;font-size:60%;">ALEATORIO</th> 
  <th width="100" style="font-family:verdana;font-size:60%;">SECRETARIA</th>
  <th width="50" style="font-family:verdana;font-size:60%;">AÑO</th>
  <th width="50" style="font-family:verdana;font-size:60%;">PEDIDO</th>
  <th width="50" style="font-family:verdana;font-size:60%;">FECHA PEDIDO</th>
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
  </tr>
  <?php
  $conexion=Conectarse();
  $permiso=$_SESSION['nivel'];$usecre=$_SESSION['secretaria'];
  if($permiso==10||$permiso==12||$permiso==3||$permiso==99)
  {
   if($flag==0){
   //$sql="select * from resumensg order by totaldeuda desc ;";
    $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.fechapedido,a.totalped, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (a.idpedidomateriales=b.aleatorio) 
  order by a.idpedidomateriales;";
  }else{
  if($bsprod!=""){
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (b.proveedor like '%$bsprod%') and
    (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."')and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."') 
    and (a.idpedidomateriales=b.aleatorio)
  order by a.idpedidomateriales;";
  }else {
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (a.idpedidomateriales=b.aleatorio) and 
   (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."') 
  order by a.idpedidomateriales;";  
  }}   
  }
  else{
    if($flag==0){
     $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.fechapedido,a.totalped, b.pedmat, b.aniooc, b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, b.fecas, b.nropv from pedidomateriales a, gestioncompra b where (a.idpedidomateriales=b.aleatorio) and (a.isecre='".$usecre."') 
  order by a.idpedidomateriales;";
  }else{
  if($bsprod!=""){
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (b.proveedor like '%$bsprod%') and
    (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."') 
    and (a.idpedidomateriales=b.aleatorio) and (a.isecre='".$usecre."') order by a.idpedidomateriales;";
  }else {
   $sql="select a.idpedidomateriales, a.isecre, 
  a.aniopedido, a.nropedido, a.totalped, a.fechapedido, b.pedmat, b.aniooc, 
  b.nrooc, b.asignado, b.fecoc, b.proveedor, b.actuacions, 
  b.fecas, b.nropv from pedidomateriales a, gestioncompra b 
  where (a.idpedidomateriales=b.aleatorio) and 
   (a.fechapedido between '".$bddesde."'and'".$bdhasta."')and
    (b.nropv between '".$nroprovd."'and '".$nroprovh."')
    and(b.pedmat between '".$npmd."' and '".$npmh."')
    and(b.nrooc between '".$nocd."' and '".$noch."')
    and (b.aleatorio between '".$aleatoriod."'and '".$aleatorioh."') and (a.isecre='".$usecre."') 
  order by a.idpedidomateriales;";  
  }}
  }
  
  $resultado = mysqli_query ($conexion,$sql);
  if(mysqli_num_rows($resultado)>0){
  while($registro2 = mysqli_fetch_array($resultado)) {
   echo'<tr>
  <td style="font-family:verdana;font-size:60%;">'.$registro2['idpedidomateriales'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['isecre'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['aniopedido'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['nropedido'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['fechapedido'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['totalped'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['pedmat'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['aniooc'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['nrooc'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['asignado'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['fecoc'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['nropv'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['proveedor'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['actuacions'].'</td>
          <td style="font-family:verdana;font-size:60%;">'.$registro2['fecas'].'</td>
  </tr>';
  }
}else{
  echo '<tr>
        <td colspan="6">No se encontraron resultados</td>
      </tr>';
}
  ?>
 </table>
 </table>
    </div>
    <br>

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
</html>
