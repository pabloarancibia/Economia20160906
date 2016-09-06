$(function(){
		$('#nueva-factura').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-factura').modal({
			show:true,
			backdrop:'static'
		});
	});

});
function agregaRegistro(){
	var url = '../Logica/agrega_PCMEx.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			return false;
			}
		}
	});
	return false;
}

function editarPCMEx(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_PCMEx.php';
$.ajax({
 type:'POST',
 url:url,
 data:'id='+id,
 success: function(valores){
	var datos = eval(valores);
//	$('#reg').hide();
	$('#edi').show();
	$('#pro').val('Edicion');
    $('#idf').val(id);
	$('#idpm').val(datos[0]);
	$('#np').val(datos[1]);
	$('#ap').val(datos[2]);
	$('#fp').val(datos[3]);
	$('#ep').val(datos[4]);
	$('#tp').val(datos[5]);
	$('#tl').val(datos[6]);
	$('#idsol').val(datos[7]);
	$('#idp').val(datos[8]);
	$('#idsec').val(datos[9]);
	$('#idssec').val(datos[10]);
	$('#iddg').val(datos[11]);
	$('#dm').val(datos[12]);
	$('#cd').val(datos[13]);
	$('#act').val(datos[14]);
	$('#registra-factura').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}

function eliminarPCMEx(id){
	var url = '../Logica/elimina_PCMEx.php';
	var pregunta = confirm('¿Esta seguro de borrar este Documento?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-registros').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}
