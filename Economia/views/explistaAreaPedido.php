<?php
//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header("content-disposition: attachment;filename=areaPedido.xls" );
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>
<?php
/*$sql="select a.sec,a.detsec as sec,b.subsec,b.detsubsec as ssec,c.dirgral ,c.dirdetalle as dir,d.nropedido as np,
  d.aniopedido as ap,d.isecre,d.isubsecre,d.idg 
  from secretarias a, subsecretarias b, dirgenerales c, pedidomateriales d
  where
  a.sec=d.isecre and b.subsec=d.isubsecre and c.dirgral=d.idg 
  order by isecre asc,aniopedido asc,nropedido asc ;";  
*/
  $sql="select a.sec,a.detsec as secre,b.subsec,b.detsubsec as ssec,d.nropedido as np,
  d.aniopedido as ap,d.isecre,d.isubsecre,d.idg 
  from secretarias a, subsecretarias b, pedidomateriales d
  where
  a.sec=d.isecre and b.subsec=d.isubsecre 
  order by d.isecre asc,d.aniopedido asc,d.nropedido asc ;";  
require("../Conexion/Conexion.php");
$conexion=Conectarse();
//$sql = "SELECT nroprov,razonsocial FROM acreedoreconomia where (razonsocial <> '') ORDER BY razonsocial ASC;";
//$sql="select * from resumensg where fechapresenta between '$desde' AND '$hasta' order by totaldeuda desc ;";
$resultado = mysqli_query ($conexion,$sql);

?>

<TABLE BORDER=1 align="center" CELLPADDING=1 CELLSPACING=1>
<TR>
<TD>SECRETARIA</TD>
<TD>SUB-SECRETARIA</TD>
<!--TD>DCCION.GRAL</TD-->
<TD>NRO.PEDIDO</TD>
<TD>AÑO PEDIDO</TD>
</TR>
<?php
while($row = mysqli_fetch_array($resultado)) {
printf("<tr>
<td>&nbsp;%s&nbsp;</td>
<td>&nbsp;%s&nbsp;</td>

<td>%d</td>
<td>%d</td>
</tr>", $row["secre"],$row["ssec"],
$row["np"],$row["ap"]);
}
mysqli_free_result($resultado);
mysqli_close($conexion); //Cierras la Conexión
?>
</table>
</body>
</html>