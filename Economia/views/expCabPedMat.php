<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=CabeceraPedMat.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
$sql="select * from pedidomateriales order by idpedidomateriales ;";
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>idpedidomateriales</TD><TD>nropedido</TD>
<TD>aniopedido</TD><TD>fechapedido</TD>
<TD>estado</TD><TD>totalped</TD>
<TD>totalletra</TD><TD>idsolicitante</TD>
<TD>idpedido</TD><TD>isecre</TD>
<TD>isubsecre</TD><TD>idg</TD>
<TD>destinomat</TD><TD>cuenta</TD>
<TD>actuacion</TD></TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>%d</td>
<td>%d</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>%01.2f</td>
<td>&nbsp;%s&nbsp;</td><td>%d</td>
<td>%d</td><td>%d</td>
<td>%d</td><td>%d</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>
</tr>", $row["idpedidomateriales"],$row["nropedido"],
$row["aniopedido"],$row["fechapedido"],$row["estado"],
$row["totalped"],$row["totalletra"],$row["idsolicitante"],
$row["idpedido"],$row["isecre"],$row["isubsecre"],$row["idg"],
$row["destinomat"],$row["cuenta"],$row["actuacion"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>