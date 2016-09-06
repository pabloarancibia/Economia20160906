<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=TurnosAtendidos.xls" );
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
if (isset ($_SESSION["nroprovd"]) )
{   $nroprovd=$_SESSION['nroprovd'];$flag=1;}
else{$nroprovd=0;}
if (isset ($_SESSION["nroprovh"]) )
{   $nroprovh=$_SESSION['nroprovh'];$flag=1;}
else{$nroprovh=99999;}
if($flag==0){
 $sql="select * from turnoeco 
  where estado <>'' order by fechaTurno asc, horaTurno asc;";
  }else{
  if($bsprod!=""){
   $sql="select * from turnoeco where (razons like '%$bsprod%') and
    (presenta between '".$bddesde."'and'".$bdhasta."')and
    (nroprov between '".$nroprovd."'and '".$nroprovh."')
    order by fechaTurno asc, horaTurno asc;";
  }else {
   $sql="select * from turnoeco where (presenta between '".$bddesde."'and'".$bdhasta."')and (nroprov between '".$nroprovd."'and '".$nroprovh."')
    order by fechaTurno asc, horaTurno asc;";  
  }} 

require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>FECHA TURNO</TD><TD>NRO.PROV</TD>
<TD>RAZON SOCIAL</TD><TD>RUBRO</TD>
<TD>MOTIVO RECLAMO</TD><TD>PERIODO ENTREGA-PRESTACION</TD>
<TD>MONTO RECLAMADO</TD><TD>ULTIMA FACTURA PAGA</TD>
<TD>ESTADO</TD><TD>OPERA</TD>
<TD>RESPUESTA</TD><TD>OBSERVACIONES</TD>
<TD>FECHA ATENCION</TD></TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>&nbsp;%s&nbsp;</td><td>%d</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>%01.2f</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
</tr>", $row["fechaTurno"],$row["nroprov"],
utf8_decode($row["razons"]),utf8_decode($row["rubro"]),utf8_decode($row["motivor"]),utf8_decode($row["periodopre"]),$row["montor"],utf8_decode($row["ultfp"]),utf8_decode($row["estado"]),utf8_decode($row["opera"]),utf8_decode($row["respuesta"]),utf8_decode($row["observaciones"]),$row["presenta"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>