$
function agregaRegistro(){
	var url = '../Logica/agrega_TA.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Edicion'){
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			return false;
			}
		}
	});
	return false;
}

function editarTA(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_TA.php';
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
	$('#rubro').val(datos[0]);
	$('#peri').val(datos[1]);
	$('#montor').val(datos[2]);
	$('#ufp').val(datos[3]);
	$('#estado').val(datos[4]);
	$('#opera').val(datos[5]);
	$('#fecha').val(datos[6]);
	$('#observa').val(datos[7]);
	$('#registra-reunion').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}

