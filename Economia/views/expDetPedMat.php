<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=DetallePedMat.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
$sql="select * from detallepedidomateriales order by iddetallepm ;";
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>iddetallepm</TD><TD>cantidad</TD>
<TD>importedetalle</TD><TD>idrubro</TD>
<TD>idsubr</TD><TD>detallepedido</TD>
<TD>idpedido</TD><TD>idsol</TD></TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>%01.2f</td>
<td>%01.2f</td><td>%d</td>
<td>%d</td><td>&nbsp;%s&nbsp;</td>
<td>%d</td><td>%d</td>
</tr>", $row["iddetallepm"],$row["cantidad"],
$row["importedetalle"],$row["idrubro"],$row["idsubr"],
$row["detallepedido"],$row["idpedido"],$row["idsol"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>