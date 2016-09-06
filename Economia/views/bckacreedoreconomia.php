<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=acreedoreconomia.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
$sql="select * from acreedoreconomia order by idacreedoreconomia ;";
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$resultado = mysqli_query ($conexion,$sql);
?>
<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>idacreedoreconomia</TD><TD>usuario</TD><TD>nroprov</TD><TD>razonsocial</TD><TD>cuit</TD><TD>dni</TD><TD>apellido</TD><TD>nombre</TD><TD>estadocivil</TD><TD>domicilio</TD><TD>domicilio2</TD><TD>localidad</TD><TD>provincia</TD><TD>tel1</TD><TD>tel2</TD><TD>email</TD><TD>email2</TD><TD>conyuge</TD><TD>estado</TD><TD>causa</TD><TD>privilegio</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>&nbsp;%s&nbsp;</td><td>%d</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>%d</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td></tr>",
 $row["idacreedoreconomia"],$row["usuario"],$row["nroprov"],$row["razonsocial"],$row["cuit"],$row["dni"],$row["apellido"],$row["nombre"],$row["estadocivil"],$row["domicilio"],
 $row["domicilio2"],$row["localidad"],$row["provincia"],$row["tel1"],$row["tel2"],$row["email"],$row["email2"],$row["conyuge"],$row["estado"],$row["causa"],$row["privilegio"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>