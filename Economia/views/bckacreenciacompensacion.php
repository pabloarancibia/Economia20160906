<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=acreenciacompensacion.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
$sql="select * from acreenciacompensacion order by idacompensa ;";
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);
?>
<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>idacompensa</TD><TD>provcom</TD>
<TD>sujetop</TD><TD>tributop</TD>
<TD>importep</TD><TD>fechacarga</TD>
<TD>imprimio</TD><TD>documento</TD>
<TD>nroform</TD><TD>anioform</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>%d</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>%01.2f</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>%d</td><td>%d</td>
</tr>",
 $row["idacompensa"],$row["provcom"],$row["sujetop"],$row["tributop"],
 $row["importep"],$row["fechacarga"],$row["imprimio"],$row["documento"],$row["nroform"],$row["anioform"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>