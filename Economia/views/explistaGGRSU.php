<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=GGRSU.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$consulta=" select * from razonsocial, sucursales, datosresiduos 
where razonsocial.idRazonSocial=sucursales.idRazonSocial and sucursales.idSucursal=
datosresiduos.idsucursal order by razonsocial.idRazonSocial asc ;";
$resultado = mysqli_query ($conexion,$consulta);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>CUIT</TD><TD>RAZON SOCIAL</TD><TD>DOMICILIO RAZONSOCIAL</TD><TD>DOMICILIO SUCURSAL</TD>
<TD>DIMENSION</TD><TD>MLUN</TD><TD>MMAR</TD><TD>MMIE</TD><TD>MJUE</TD><TD>MVIE</TD><TD>MSAB</TD><TD>MDOM</TD><TD>KLUN</TD><TD>KMAR</TD><TD>KMIE</TD><TD>KJUE</TD><TD>KVIE</TD><TD>KSAB</TD><TD>KDOM</TD><TD>BLUN</TD><TD>BMAR</TD><TD>BMIE</TD><TD>BJUE</TD><TD>BVIE</TD><TD>BSAB</TD><TD>BDOM</TD><TD>CARTONES</TD><TD>PLASTICOS</TD><TD>ORGANICOS</TD><TD>TIPO OTROS</TD><TD>VALOR OTROS</TD><TD>DIFERENCIAL</TD><TD>TIPO DIFERENCIAL</TD><TD>NOMBRE DIFERENCIAL</TD><TD>FRECUENCIA DIFERENCIAL</TD><TD>CUBRE DIFERENCIAL</TD><TD>NECESIDAD DIFERENCIAL</TD><TD>FREC.NECES.DIFERENCIAL</TD><TD>DEP.BASURA</TD><TD>DEP.BASURA OTROS</TD><TD>HORARIO RECOLECCION</TD><TD>OPINION</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>%d</td>
<td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td>
<td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td>
<td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td><td>%d</td>
<td>%d</td><td>%d</td><td>%d</td><td>&nbsp;%s&nbsp;</td><td>%d</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
</tr>", $row["cuit"],$row["razonsocial"],$row["domicilio"],$row["domicilio"],$row["domicilio"],$row["mtsLun"],$row["mtsMar"],$row["mtsMierc"],$row["mtsJuev"],$row["mtsVier"],$row["mtsSab"],$row["mtsDom"],$row["kgLun"],$row["kgMar"],$row["kgMier"],$row["kgJuev"],$row["kgVier"],$row["kgSab"],$row["kgDom"],$row["bolsasLun"],$row["bolsasMar"],$row["bolsasMier"],$row["bolsasJuev"],$row["bolsasVier"],$row["bolsasSab"],$row["bolsasDom"],$row["porCartonesPapeles"],$row["porPlasticosVidrios"],$row["porOrganicos"],
$row["tipoOtros"],$row["porOtros"],$row["optDifSiNo"],$row["optDifTipo"],$row["nombreSrvDifTercero"],$row["freqDiferencial"],$row["optCubreDif"],$row["optNecDif"],$row["optFreqNecDif"],$row["optDepBasura"],$row["depBasuraOtros"],$row["optHrRec"],
$row["opinionRec"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>