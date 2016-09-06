<?php 
if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}

if($_GET['action'] == 'listar')
{
	// valores recibidos por POST
	$vcuit   = $_POST['cuit'];
	
	//query para q traiga todos
	$sql = "SELECT * FROM proveedores";
	
	// Vericamos si hay algun filtro
	$sql .= ($vcuit != '')      ? " WHERE cuit LIKE '%$vcuit%'" : "";
	
	// Ordenar por
	//if ($_POST['orderby']){
	//$vorder = $_POST['orderby'];
	//}else{
	//	$vorder = 'nroProv';
	//}
	//if($vorder != ''){
	//	$sql .= " ORDER BY ".$vorder;
	//}
	$conexion=Conectarse();
	$query = mysqli_query($conexion,$sql);
	$data = array();

	while($row = mysqli_fetch_array($query))
	{
		$data[] = array(
			'nroProv'     	=> $row['nroProv'],
			'cuit'        	=> $row['cuit'],
            'conv_multi'  	=> $row['conv_multi'],
			'email'       	=> $row['email'],
			'nombres'	  	=> $row['nombres'],
			'domicilio'		=> $row['domicilio'],
			'localidad'		=> $row['localidad'],
			'tel'			=> $row['tel'],
			'cp'			=> $row['cp'],
			'entidad'		=> $row['entidad'],
			'dtos_filiat'	=> $row['dtos_filiat'],
			'ap_pat'		=> $row['ap_pat'],
			'ap_mat'		=> $row['ap_mat'],
			'ap_interesado'	=> $row['ap_interesado'],
			'nom_interesado'=> $row['nom_interesado'],
			'dni_int'		=> $row['dni_int'],
			'est_civil_int'	=> $row['est_civil_int'],
			'domicilio_int'	=> $row['domicilio_int'],
			'localidad_int'	=> $row['localidad_int'],
			'provincia_int'	=> $row['provincia_int'],
			'cp_int'		=> $row['cp_int'],
			'tel_int'		=> $row['tel_int'],
			'cel_int'		=> $row['cel_int'],
			'ap_cony'		=> $row['ap_cony'],
			'nom_cony'		=> $row['nom_cony'],
			'dni_cony'		=> $row['dni_cony'],
			'ap_aut'		=> $row['ap_aut'],
			'nom_aut'		=> $row['nom_aut'],
			'cargo_aut'		=> $row['cargo_aut'],
			'documento_aut'	=> $row['documento_aut'],
			'validado'		=> $row['validado']
		);
	}
	// convertimos el array de datos a formato json
	echo json_encode($data);
	//mysqli_close($conexion);
}

?>