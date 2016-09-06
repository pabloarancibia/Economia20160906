<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=DetalleCompensacion.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
require("../Conexion/Conexion.php");
$conexion=Conectarse();
$query="select b.provcom, b.sujetop, b.tributop, b.importep, b.fechacarga, b.documento, ac.razonsocial from acreenciacompensacion b, acreedoreconomia ac where (b.provcom=ac.nroprov)  order by provcom asc ;";
$resultado=mysqli_query($conexion,$query);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>PROVEEDOR</TD><TD>RAZON SOCIAL</TD>
<TD>SUJETO PASIVO</TD><TD>TRIBUTO</TD>
<TD>IMPORTE</TD><TD>FECHA CARGA</TD><TD>DOCUMENTO</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>%d</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td><td>&nbsp;%s&nbsp;</td>
<td>%01.2f</td><td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>

</tr>", $row["provcom"],$row["razonsocial"],$row["sujetop"],$row["tributop"],$row["importep"],$row["fechacarga"],$row["documento"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>



	$pdf->Cell(25,8,$fila['provcom'],1,0,'C');
    $pdf->Cell(90,8,utf8_decode($fila['razonsocial']),1,0,'C');
    $pdf->Cell(40,8,number_format($fila['mf'],2,",","."),1,0,'R');
    
    $pdf->Ln(8);$conteo++;
    $tmontof=$tmontof+$fila['mf'];
}
