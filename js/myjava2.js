$(function(){
		$('#nueva-compensacion').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edic').hide();
		$('#regc').show();
		$('#registra-compensacion').modal({
			show:true,
			backdrop:'static'
		});
	});

});
function agregaCompensacion(){
	var url = '../Logica/agrega_compensacion.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-compensacion').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-compensacion').html(registro);
			return false;
			}
		}
	});
	return false;
}

function eliminarCompensacion(id){
	var url = '../Logica/elimina_compensacion.php';
	var pregunta = confirm('¿Esta seguro de borrar este Documento?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-compensacion').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

function editarCompensacion(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_compensacion.php';
$.ajax({
 type:'POST',
 url:url,
 data:'id='+id,
 success: function(valores){
	var datos = eval(valores);
	$('#regc').hide();
	$('#edic').show();
	$('#pro').val('Edicion');
    $('#idf').val(id);
	$('#bsprov').val(datos[0]);
	$('#bssujeto').val(datos[1]);
	$('#tributo').val(datos[2]);
	$('#monto').val(datos[3]);
	$('#dcto').val(datos[4]);
	$('#registra-compensacion').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}


