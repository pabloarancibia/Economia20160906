<?php

if (!function_exists('Conectarse')) {
include "../Conexion/Conexion.php";
}
$conexion=Conectarse();

if (!empty($_POST["NroSol"])){
$NroSol=$_POST["NroSol"];
}

//echo json_encode(array("nombres"=>$cuit, "domicilio"=>"dom"));

$query = "SELECT * FROM proveedores WHERE txt_nro_solicitud = '".$NroSol."';";
$datosProv = mysqli_query($conexion, $query) or die(mysql_error());

if (mysqli_num_rows($datosProv)!=0){
  while ($registro = mysqli_fetch_array($datosProv)) {
	$nroProv = $registro['nroProv'];
    $nombres = $registro['nombres'];
    $domicilio = $registro['domicilio'];
    $conv_multi = $registro['conv_multi'];
    $email = $registro['email'];
    $localidad = strtoupper($registro['localidad']);
    $tel = $registro['tel'];
    $cp = $registro['cp'];
    $entidad = strtoupper($registro['entidad']);
    $dtos_filiat = strtoupper($registro['dtos_filiat']);
    $ap_pat = strtoupper($registro['ap_pat']);
    $ap_mat = $registro['ap_mat'];
    $ap_interesado = $registro['ap_interesado'];//
    $nom_interesado = $registro['nom_interesado'];//
    $dni_int = $registro['dni_int'];
    $est_civil_int = $registro['est_civil_int'];
    $domicilio_int = strtoupper($registro['domicilio_int']);
    $localidad_int = $registro['localidad_int'];
    $provincia_int = $registro['provincia_int'];
    $cp_int = $registro['cp_int'];
    $tel_int = $registro['tel_int'];
    $cel_int = $registro['cel_int'];
    $ap_cony = $registro['ap_cony'];//
    $nom_cony = $registro['nom_cony'];//
    $dni_cony = $registro['dni_cony'];
    $ap_aut = $registro['ap_aut'];////////
    $nom_aut = $registro['nom_aut'];
    $cargo_aut = $registro['cargo_aut'];
    $tipo_doc_aut = $registro['tipo_doc_aut'];
    $documento_aut = $registro['documento_aut'];
    $ap_aut2 = $registro['ap_aut2'];
    $nom_aut2 = $registro['nom_aut2'];
    $cargo_aut2 = $registro['cargo_aut2'];
    $tipo_doc_aut2 = $registro['tipo_doc_aut2'];
    $documento_aut2 = $registro['documento_aut2'];
    $ap_aut3 = $registro['ap_aut3'];
    $nom_aut3 = $registro['nom_aut3'];
    $cargo_aut3 = $registro['cargo_aut3'];
    $tipo_doc_aut3 = $registro['tipo_doc_aut3'];
    $documento_aut3 = $registro['documento_aut3'];
    $ap_aut4 = $registro['ap_aut4'];
    $nom_aut4 = $registro['nom_aut4'];
    $cargo_aut4 = $registro['cargo_aut4'];
    $tipo_doc_aut4 = $registro['tipo_doc_aut4'];
    $documento_aut4 = $registro['documento_aut4'];
 }//fin while
 $queryRubros="SELECT * FROM rel_prov_rubros_sub WHERE id_proveedor = '$nroProv'";
 $datosRubros = mysqli_query($conexion, $queryRubros) or die(mysql_error());
 if (mysqli_num_rows($datosRubros)!=0){
  while ($reg = mysqli_fetch_array($datosRubros)) {
	$id_rubro = $reg['id_rubro'];//
	$id_subrubro = $reg['id_subrubro'];//

  $queryDescripRub="SELECT * FROM rubros WHERE rubro = '$id_rubro'";
  $qdescRubros = mysqli_query($conexion, $queryDescripRub) or die(mysql_error());
  if (mysqli_num_rows($qdescRubros)!=0){
     $descRubros = mysqli_fetch_array($qdescRubros);//
   }//fin if

   $queryDescripsubRub="SELECT * FROM subrubros WHERE subrubro = '$id_subrubro'";
   $qdescsubRubros = mysqli_query($conexion, $queryDescripsubRub) or die(mysql_error());
   if (mysqli_num_rows($qdescsubRubros)!=0){
     $descsubRubros['subrubdesc'] = mysqli_fetch_array($qdescsubRubros);//
   }//fin if
/*
   /////////////////IMPRIMIR RUBROS
   //ESTE DIV DEBO CREARLO EN EL LUGAR Q CORRESPONDA
   var container = $(document.createElement('div'));

   //RECORRER UN ARRAY Q CON LOS DATOS DE LA TABLA (PHP)
   var  valRubro = data.id_rubro; //$('#rr').val();
   var textRubro = data.descRubros; //$( "#rr option:selected" ).text();
   var  valSubRubro = data.id_subrubro; //$('#srr').val();
   var textSubRubro = data.descsubRubros; // $( "#srr option:selected" ).text();

    for (i in valRubro){
    $(container).append('<input type="hidden" class="txtRubros" name="txtRubro1[]" id=txtRubro1'+' ' +
    'value="'+valRubro[i]+'"><label class="lblRubros">Rubro: '+textRubro[i]+'</label>');
    $(container).append('<input type="hidden" class="txtSubRubros" name="txtSubRubro1[]" id=txtSubRubro1' + ' ' +
    'value="'+valSubRubro[i]+'"><label class="lblSubRubros">Sub-Rubro: '+textSubRubro[i]+'</label><br /><br />');
    }//fin for
*/
/*
echo '<input type="hidden" class="txtRubros" name="txtRubro1[]" id=txtRubro1'.' ' .
'value="'.$id_rubro[0].'"><label class="lblRubros">Rubro: '.$descRubros[2].'</label>';
echo '<input type="hidden" class="txtSubRubros" name="txtSubRubro1[]" id=txtSubRubro1' . ' ' .
'value="'.$id_subrubro[0].'"><label class="lblSubRubros">Sub-Rubro: '.$descsubRubros['subrubdesc'][2].'</label><br /><br />';
*/
   ///////////////////FIN IMPRIMIR RUBROS

	}//fin while

    /*
    //ahora query para traer el nombre del rubro y sub segun su id
		foreach ($id_rubro as $id_rubroActual){
			$queryDescripRub="SELECT * FROM rubros WHERE rubro = '$id_rubroActual'";
			$qdescRubros = mysqli_query($conexion, $queryDescripRub) or die(mysql_error());
			if (mysqli_num_rows($qdescRubros)!=0){
				while ($reg = mysqli_fetch_array($qdescRubros)) {
				$descRubros = $reg['rubrodesc'];//
				}//fin while
			}

		}//fin foreach

		foreach ($id_subrubro as $id_subrubroActual){
			$queryDescripsubRub="SELECT * FROM subrubros WHERE subrubro = '$id_subrubroActual'";
			$qdescsubRubros = mysqli_query($conexion, $queryDescripsubRub) or die(mysql_error());
			if (mysqli_num_rows($qdescsubRubros)!=0){
				while ($reg = mysqli_fetch_array($qdescsubRubros)) {
				$descsubRubros = $reg['subrubdesc'];//
				}//fin while
			}

		}// fin foreach
    */
	}//fin if


  echo json_encode(array(
    "nombres"=>$nombres,
    "domicilio"=>$domicilio,
    "email"=>$email,
    "conv_multi"=>$conv_multi,
    "localidad"=>$localidad,
    "tel"=>$tel,
    "cp"=>$cp,
    "entidad"=>$entidad,
    "dtos_filiat"=>$dtos_filiat,
    "ap_pat"=>$ap_pat,
    "ap_mat"=>$ap_mat,
    "ap_interesado"=>$ap_interesado,
    "nom_interesado"=>$nom_interesado,
    "dni_int"=>$dni_int,
    "est_civil_int"=>$est_civil_int,
    "domicilio_int"=>$domicilio_int,
    "localidad_int"=>$localidad_int,
    "provincia_int"=>$provincia_int,
    "cp_int"=>$cp_int,
    "tel_int"=>$tel_int,
    "cel_int"=>$cel_int,
    "ap_cony"=>$ap_cony,
    "nom_cony"=>$nom_cony,
    "dni_cony"=>$dni_cony,
    "ap_aut"=>$ap_aut,
    "nom_aut"=>$nom_aut,
    "cargo_aut"=>$cargo_aut,
    "tipo_doc_aut"=>$tipo_doc_aut,
    "documento_aut"=>$documento_aut,
    "ap_aut2"=>$ap_aut2,
    "nom_aut2"=>$nom_aut2,
    "cargo_aut2"=>$cargo_aut2,
    "tipo_doc_aut2"=>$tipo_doc_aut2,
    "documento_aut2"=>$documento_aut2,
    "ap_aut3"=>$ap_aut3,
    "nom_aut3"=>$nom_aut3,
    "cargo_aut3"=>$cargo_aut3,
    "tipo_doc_aut3"=>$tipo_doc_aut3,
    "documento_aut3"=>$documento_aut3,
    "ap_aut4"=>$ap_aut4,
    "nom_aut4"=>$nom_aut4,
    "cargo_aut4"=>$cargo_aut4,
    "tipo_doc_aut4"=>$tipo_doc_aut4,
    "documento_aut4"=>$documento_aut4,
	//"id_rubro"=>$id_rubro,//en teoria paso el array
	//"id_subrubro"=>$id_subrubro,//en teoria paso el array
	//"descRubros"=>$descRubros,//en teoria paso el array
	//"descsubRubros"=>$descsubRubros//en teoria paso el array
    ));//fin array json

}else {
  echo json_encode(array(
  "nombres"=>"no hay datos",
  "domicilio"=>"no hay datos"//,
  //"cuit"=>"no hay datos",
  //"email"=>"no hay datos"
)
);
}
mysqli_close($conexion);
?>
