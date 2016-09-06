<?php
session_start();
if (!isset($_SESSION["apynom"])){
    header("Location:../views/frmMenuUsuarios.php?nologin=false");}

$_SESSION["apynom"];$_SESSION["secretaria"];
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
if (isset ($_SESSION["nroformd"]) )
{   $nroformd=$_SESSION['nroformd'];$flag=1;}
else{$nroformd=0;}
if (isset ($_SESSION["nroformh"]) )
{  $nroformh=$_SESSION['nroformh'];$flag=1;}
else{$nroformh=99999;}
if (isset ($_SESSION["nroprovd"]) )
{   $nroprovd=$_SESSION['nroprovd'];$flag=1;}
else{$nroprovd=0;}
if (isset ($_SESSION["nroprovh"]) )
{   $nroprovh=$_SESSION['nroprovh'];$flag=1;}
else{$nroprovh=99999;}


//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=Compensaciones.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
require("../Conexion/Conexion.php");
$conexion=Conectarse();
//$sql = "SELECT nroprov,razonsocial FROM acreedoreconomia where (razonsocial <> '') ORDER BY razonsocial ASC;";
//$sql="select * from rescompensa order by nroform asc ;";
if($flag==0){
   $sql="select * from rescompensa order by fechapresenta desc ;";
  }else{
  if($bsprod!=""){
    $sql="select * from rescompensa
    where (razonsocial like '%$bsprod%') and
    (fechapresenta between '".$bddesde."'and'".$bdhasta."')and
    (nroprov between '".$nroprovd."'and '".$nroprovh."')
    and (nroform between '".$nroformd."'and '".$nroformh."')
     order by fechapresenta desc ;";
  }else {
    $sql="select * from rescompensa
    where (fechapresenta between '".$bddesde."'and'".$bdhasta."')and
    (nroprov between '".$nroprovd."'and '".$nroprovh."')
    and (nroform between '".$nroformd."'and '".$nroformh."')
     order by fechapresenta desc ;";
  }}
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>PROVEEDOR</TD>
<TD>RAZON SOCIAL</TD>
<TD>FECHA PRESENTACION</TD>
<TD>NRO.FORMULARIO</TD>
<TD>AÑO FORMULARIO</TD>
<TD>MONTO SOLICITADO</TD>
<TD>MONTO AUTORIZADO</TD>
<TD>ORDEN DE PAGO</TD>
<TD>MONTO O.P</TD>
<TD>SALDO PROVEEDOR</TD>


</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>%d</td><td>%d</td><td>%01.2f</td><td>%01.2f</td>
<td>&nbsp;%s&nbsp;</td><td>%01.2f</td><td>%01.2f</td>
</tr>", $row["nroprov"],$row["razonsocial"],$row["fechapresenta"],
$row["nroform"],$row["anioform"],$row["montoreclamado"],$row["montoautorizado"],$row["ordenpago"]
,$row["montoop"],$row["saldoprov"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>