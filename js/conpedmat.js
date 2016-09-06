$
function agregaRegistro(){
	var url = '../Logica/auto_pm.php';
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

function editarAuPM(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_AutoPM.php';
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
	$('#bsprov').val(datos[0]);
	$('#anio').val(datos[1]);
	$('#funcio').val(datos[2]);
	$('#tram').val(datos[3]);
	$('#estado').val(datos[4]);
	$('#registra-reunion').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}

