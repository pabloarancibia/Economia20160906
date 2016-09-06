<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=Anexo.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$sql="select a.nroproveedor,a.intrumento,a.ordencompra,a.tipofactura,a.nrofactura,a.montofactura, a.pagosparciales,a.totaldeuda,a.imprimio,ae.nroprov,ae.razonsocial from acreenciasingestion a , acreedoreconomia ae where (a.nroproveedor=ae.nroprov) and (a.imprimio='SI') order by a.nroproveedor asc ;";
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>PROVEEDOR</TD>
<TD>RAZON SOCIAL</TD>
<TD>INSTRUMENTO</TD>
<TD>O.C</TD>
<TD>T.FACTURA</TD>
<TD>N.FACTURA</TD>
<TD>FACTURA $</TD>
<TD>PAGOS $</TD>
<TD>TOTAL DEUDA $</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
<td>%01.2f</td>
<td>%01.2f</td>
<td>%01.2f</td>
</tr>", $row["nroproveedor"],$row["razonsocial"],$row["intrumento"],$row["ordencompra"],$row["tipofactura"],$row["nrofactura"],$row["montofactura"],$row["pagosparciales"],$row["totaldeuda"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>