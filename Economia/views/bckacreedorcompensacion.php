<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=acreedorcompensacion.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
$sql="select * from acreedorcompensacion order by idaccom ;";
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);
?>
<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>idaccom</TD><TD>provcompe</TD>
<TD>codpostal</TD><TD>aperepresenta</TD>
<TD>cuitrepre</TD><TD>domrepre</TD>
<TD>cprepre</TD><TD>telrepre</TD>
<TD>celrepre</TD><TD>emailrepre</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>%d</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
</tr>",
 $row["idaccom"],$row["provcompe"],$row["codpostal"],$row["aperepresenta"],
 $row["cuitrepre"],$row["domrepre"],$row["cprepre"],$row["telrepre"],$row["celrepre"],
$row["emailrepre"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>