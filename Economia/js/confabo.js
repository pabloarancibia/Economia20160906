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
	var url = '../Logica/agrega_Abo.php';
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

function editarAbo(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_Abo.php';
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
	$('#idr').val(datos[0]);
	$('#numr').val(datos[1]);
	$('#detr').val(datos[2]);
	$('#registra-factura').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}

function eliminarAbo(id){
	var url = '../Logica/elimina_Abo.php';
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
