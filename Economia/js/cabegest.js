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
	var url = '../Logica/agrega_PCMExGest.php';
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

function editarPCMExGest(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_PCMExGest.php';
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
	$('#idgc').val(datos[0]);
	$('#aleatorio').val(datos[1]);
	$('#secretaria').val(datos[2]);
	$('#aniop').val(datos[3]);
	$('#nrop').val(datos[4]);
	$('#estimado').val(datos[5]);
	$('#pedmat').val(datos[6]);
	$('#aniooc').val(datos[7]);
	$('#nrooc').val(datos[8]);
	$('#asignado').val(datos[9]);
	$('#fecoc').val(datos[10]);
	$('#proveedor').val(datos[11]);
	$('#actuacions').val(datos[12]);
	$('#fecas').val(datos[13]);
	$('#nropv').val(datos[14]);
	$('#registra-factura').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}

function eliminarPCMExGest(id){
	var url = '../Logica/elimina_PCMExGest.php';
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
