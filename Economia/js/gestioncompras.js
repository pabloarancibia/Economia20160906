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
	
	$('#verifica-factura').on('click',function(){
		var dato = $('#idal').val();
		var url = '../Logica/busca_aleatorio.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});

});
function agregaRegistro(){
	var url = '../Logica/agrega_aleatorio.php';
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

function editarGC(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_aleatorio.php';
$.ajax({
 type:'POST',
 url:url,
 data:'id='+id,
 success: function(valores){
	var datos = eval(valores);
	$('#reg').hide();
	$('#edi').show();
	$('#pro').val('Edicion');
    $('#idf').val(id);
	$('#nsec').val(datos[0]);
	$('#anp').val(datos[1]);
	$('#nrop').val(datos[2]);
	$('#estima').val(datos[3]);
	
	$('#registra-factura').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}
