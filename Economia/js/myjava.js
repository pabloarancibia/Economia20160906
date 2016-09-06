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

	$('#nueva-factura2').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi2').hide();
		$('#reg2').show();
		$('#registra-factura2').modal({
			show:true,
			backdrop:'static'
		});
	});


	
/*	
	$('#verificar-factura').on('click',function(){
		var dato = $('#prov').val();
		var url = '../Logica/busca_acreedor.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});*/

});
function agregaRegistro(){
	var url = '../Logica/agrega_factura.php';
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

function eliminarFactura(id){
	var url = '../Logica/elimina_factura.php';
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

function editarFactura(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_factura.php';
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
	$('#bsprov').val(datos[0]);
	$('#instrumento').val(datos[1]);
	$('#orden').val(datos[2]);
	$('#tipo').val(datos[3]);
	$('#nrof').val(datos[4]);
	$('#montof').val(datos[5]);
	$('#montop').val(datos[6]);
	$('#totalf').val(datos[7]);
	$('#registra-factura').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}
//////////////facturas con gestion
function agregaRegistro2(){
	var url = '../Logica/agrega_factura2.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros2').html(registro);
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros2').html(registro);
			return false;
			}
		}
	});
	return false;
}

function eliminarFactura2(id){
	var url = '../Logica/elimina_factura2.php';
	var pregunta = confirm('¿Esta seguro de borrar este Documento?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-registros2').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

function editarFactura2(id){
$('#formulario')[0].reset();
var url = '../Logica/edita_factura2.php';
$.ajax({
 type:'POST',
 url:url,
 data:'id='+id,
 success: function(valores){
	var datos = eval(valores);
	$('#reg2').hide();
	$('#edi2').show();
	$('#pro').val('Edicion');
    $('#idf').val(id);
    $('#bsprov').val(datos[0])
	$('#bscaratula').val(datos[1]);
	$('#expdte').val(datos[2]);
	$('#jzgado').val(datos[3]);
	$('#monto').val(datos[4]);
	$('#causa').val(datos[5]);
	$('#profmuni').val(datos[6]);
	$('#profac').val(datos[7]);
	$('#honora').val(datos[8]);
	$('#costas').val(datos[9]);
	$('#totald').val(datos[10]);
	$('#registra-factura2').modal({
	show:true,
	backdrop:'static'
		});
	return false;
	}
	});
	return false;
}
