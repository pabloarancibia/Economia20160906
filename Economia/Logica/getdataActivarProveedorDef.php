<?php
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();

$cuit=$_POST["txtCuit"];
//echo $cuit;
//echo json_encode(array("nombres"=>$cuit, "domicilio"=>"dom"));

$query = "SELECT * FROM proveedores WHERE cuit = '$cuit'";
$datosProv = mysqli_query($conexion, $query) or die(mysql_error());

if (mysqli_num_rows($datosProv)!=0){
  while ($registro = mysqli_fetch_array($datosProv)) {
    $nombres = $registro['nombres'];
    $domicilio = $registro['domicilio'];
    $cuit = $registro['cuit'];
    $email = $registro['email'];
	$nroProv = $registro['nroProv'];
  //echo json_encode(array("nombres"=>$nombres, "domicilio"=>$domicilio));
  }
  echo json_encode(array("nombres"=>$nombres, "domicilio"=>$domicilio,"cuit"=>$cuit,"email"=>$email,"nroProv"=>$nroProv));
}else {
  echo json_encode(array("nombres"=>"no hay datos", "domicilio"=>"no hay datos","cuit"=>"no hay datos","email"=>"no hay datos"));
}

/*
if($cuit=="10")
{
	echo json_encode(array("nombre"=>"juan", "apellidos"=>"martinez exposito"));
}else{
	echo json_encode(array("nombre"=>"", "apellidos"=>""));
}
*/
/*
//Query of facebook database
//$facebook = mysql_query('SELECT * FROM facebook')
$cuit = $_POST['nroCuit'];
$query = "SELECT * FROM proveedores WHERE cuit = '$cuit'";
$datosProv = mysqli_query($conexion, $query)
or die(mysql_error());

//Output results
if(!$datosProv)
{
    mysql_close();
    echo json_encode('Hubo un error ejecutando el QUERY: ' . mysql_error());
}
elseif(!mysql_num_rows($datosProv))
{
    mysql_close();
    echo json_encode('No hay datos disponibles.');
}
else
{
    $header = false;
	$output_string = '';
    $output_string .=  '<table border='1'>\n';
    while($row = mysql_fetch_assoc($datosProv))
    {
        if(!$header)
        {
            $output_string .= '<tr>\n';
            foreach($row as $header => $value)
            {
                $output_string .= '<th>{$header}</th>\n';
            }
            $output_string .= '</tr>\n';
        }
        $output_string .= '<tr>\n';
        foreach($row as $value)
        {
            $output_string .= '<th>{$value}</th>\n';
        }
        $output_string .= '</tr>\n';
    }
    $output_string .= '</table>\n';
}

mysql_close();
// El siguiente echo es para devolver el resultado
echo json_encode($output_string);
*/
?>
