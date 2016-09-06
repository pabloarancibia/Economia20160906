<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=PresentadosJudic.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
require("../Conexion/Conexion.php");
$conexion=Conectarse();
//$sql = "SELECT nroprov,razonsocial FROM acreedoreconomia where (razonsocial <> '') ORDER BY razonsocial ASC;";
$sql="select * from resumencg order by totaldeuda desc ;";
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>DNI</TD>
<TD>DEMANDANTE</TD>
<TD>FECHA PRESENTACION</TD>
<TD>NRO.FORMULARIO</TD>
<TD>AÑO FORMULARIO</TD>
<TD>MONTO</TD>
<TD>HONORARIOS</TD>
<TD>COSTAS</TD>
<TD>TOTAL</TD>
<TD>OBSERVACIONES</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
<td>%d</td><td>%d</td>
<td>%01.2f</td><td>%01.2f</td>
<td>%01.2f</td><td>%01.2f</td><td>&nbsp;%s&nbsp;</td>
</tr>", $row["nroprov"],$row["razonsocial"],
$row["fechapresenta"],$row["nroform"],$row["anioform"],
$row["monto"],$row["honorarios"],$row['costas'],$row["totaldeuda"],
$row['observaciones']);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>