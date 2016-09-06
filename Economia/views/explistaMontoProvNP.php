<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=NoPresentados.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
require("../Conexion/Conexion.php");
$conexion=Conectarse();
//$sql = "SELECT nroprov,razonsocial FROM acreedoreconomia where (razonsocial <> '') ORDER BY razonsocial ASC;";
$prueba=14;
$sql="select sum(a.montofactura) as mf,sum(a.pagosparciales) as pp,sum(a.totaldeuda) as td, a.nroproveedor, ac.razonsocial, ac.apellido, a.fechacarga, ac.tel1, ac.email from acreenciasingestion a, acreedoreconomia ac where (a.nroproveedor=ac.nroprov) and a.nroproveedor <>'".$prueba."' and  (a.nroproveedor not in (select r.nroprov from resumensg r)) group by a.nroproveedor order by td desc ;";
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>PROVEEDOR</TD>
<TD>RAZON SOCIAL</TD>
<TD>MONTO</TD>
<TD>PAGOS</TD>
<TD>TOTAL</TD>
<TD>FECHA DE CARGA</TD>
<TD>CONTACTO</TD>
<TD>EMAIL</TD>


</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td>
<td>&nbsp;%s&nbsp;</td>
<td>%01.2f</td>
<td>%01.2f</td>
<td>%01.2f</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
</tr>", $row["nroproveedor"],$row["razonsocial"],$row["mf"],$row["pp"],$row["td"],$row["fechacarga"],$row["tel1"],$row["email"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>