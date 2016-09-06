$
function agregaRegistro(){
	var url = '../Logica/agrega_FSG.php';
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

function editarFSG(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_FSG.php';
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
	$('#montor').val(datos[0]);
	$('#pr').val(datos[1]);
	$('#td').val(datos[2]);
	$('#obs').val(datos[3]);
	$('#registra-reunion').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}

