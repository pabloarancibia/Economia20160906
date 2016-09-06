<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=Seguimiento.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
session_start();
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
else{$aleatorioh=99999;}
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
  

require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>ALEATORIO</TD>
<TD>SECRETARIA</TD>
<TD>AÑO</TD>
<TD>PEDIDO ELECTRONICO</TD>
<TD>FECHA PEDIDO</TD>
<TD>MONTO ESTIMADO</TD>
<TD>PEDIDO MATERIAL</TD>
<TD>AÑO OC</TD>
<TD>NRO. OC</TD>
<TD>MONTO ASIGNADO</TD>
<TD>FECHA O.C</TD>
<TD>NRO.PROVEEDOR</TD>
<TD>RAZON SOCIAL</TD>
<TD>TIPO CONTRATACION</TD>
<TD>FECHA CONTRATACION</TD></TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>&nbsp;%s&nbsp;</td>
<td>%01.2f</td><td>%d</td><td>%d</td><td>%d</td><td>%01.2f</td>
<td>&nbsp;%s&nbsp;</td><td>%d</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
</tr>", $row["idpedidomateriales"],$row["isecre"],
$row["aniopedido"],$row["nropedido"],$row["fechapedido"],
$row["totalped"],$row["pedmat"],$row["aniooc"],$row["nrooc"],$row["asignado"],$row["fecoc"],$row["nropv"],$row["proveedor"],$row["actuacions"],$row["fecas"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>