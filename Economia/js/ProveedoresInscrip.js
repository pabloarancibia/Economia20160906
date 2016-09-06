
$(document).ready(function() {


////////PARTE MODAL CONFIRMACION ENVIO FORMULARIO////////////
/*
// Damos formato a la Ventana de Diálogo
$('#dialogoFormulario').dialog({
	// Indica si la ventana se abre de forma automática
	autoOpen: false,
	// Indica si la ventana es modal
	modal: true,
	// Largo
	width: 350,
	// Alto
	height: 'auto',
	buttons: {
		Continuar: function() {
			// Serializamos el formulario
			str = $("#form1").serialize();

			//Vaciamos los campos del formulario
			//$('#datosContacto &gt; input[type=text]').val('');

			//Mostramos un alert con los datos del formulario
			alert(str);

			// Cerramos el diálogo
			$( this ).dialog( "close" );
		},
		Cancelar: function() {
			// Cerramos el diálogo
			$( this ).dialog( "close" );
		}
	}
});

// Validamos el formulario
$('#form1').validate({
	submitHandler: function(){

	  // Abrimos el diàlogo de confirmación
		$('#dialogoFormulario').dialog('open');

		// Evitamos que se envíe el formulario
		return false;

	},
	errorPlacement: function(error, element) {
		error.appendTo(element.prev("span").append());
	}
});
*/
////////////////////////FIN PARTE MODAL CONFIRMACION ENVIO FORMULARIO////////////////////////////////////


//////////////////PARTE VALIDAR FORMULARIO/////////////////
function verificar(){
//verifico q el cuit alla dado ok
//if($('#Error'))
//{
	return false;
//}else if ($('#Success'))
//{
	//	return true;
//}
}//fin verificar
///////////////////////////////////////////////////////////
//para acentos y n
$.ajaxSetup({'beforeSend' : function(xhr) {
 if (xhr.overrideMimeType) {
 //Para Google Chrome y Firefox
 xhr.overrideMimeType('text/html; charset=utf-8');
 } else {
 //Para IE8
 xhr.setRequestHeader('Content-type', 'text/html; charset=utf-8');
 }
 } });

 $('.solo-numero').keyup(function (){
   this.value = (this.value + '').replace(/[^0-9]/g, '');
 });

//Parte nro proveedor
//$('#nroProv').disabled = true;//.attr('disabled', 'disabled');

/*$('#nroProv').hide();
$('input[type=radio][name=rdNroProv]').change(function() {
        if (this.value == 'si') {
            $('#nroProv').show("slow");
        }
        else if (this.value == 'no') {
            $('#nroProv').val("")
            $('#nroProv').hide("slow");
        }
    });*/
$('#datos').hide();
$('#nroProv').hide();
$('#lblNroProv').hide();
$('#prov-obligatorio').hide();

$('#divNumSolicitud').hide();

//PARTE SELECCIONAR OPERACION: PRE INSCRIPCION - RE INSCRIPCION - MODIFICACION
$('#consultaProvSi').click(function(){
  $('#consultaProv').hide('slow');
  $('#datos').show('slow');
  $('#nroProv').show('slow');
  $('#lblNroProv').show('slow');
	$('#prov-obligatorio').show('slow');
	
});
$('#consultaProvNo').click(function(){
  $('#consultaProv').hide('slow');
  $('#datos').show('slow');
  ///////////////////////////// PARTE VERIFICAR CUIT NO REPETIDO ////////////////////////////

	$('#cuit3').blur(function(){

		$('#Info').html('<img src="../images/loading.gif" alt="loading" width="32px" height="32px" />').fadeOut(1000);

		var cuit = $('#cuit1').val()+$('#cuit2').val()+$('#cuit3').val();
		var dataString = 'cuit='+cuit;

		$.ajax({
					type: "POST",
					url: "../Logica/check_cuit_availablity.php",
					data: dataString,
					success: function(data) {
			$('#Info').fadeIn(1000).html(data);
			//alert(data);
					}
			});
	});
	//////////////////////////////////////////////////////////////////////////////////////////
});
$('#consultaProvModif').click(function(){
  $('#consultaProv').hide('slow');
  $('#divNumSolicitud').show('slow');
});
//Parte Rubros
var iCnt = 0;
// Crear un elemento div añadiendo estilos CSS
var container = $(document.createElement('div'));
/*.css({
padding: '5px', margin: '20px', width: '170px', border: '1px dashed',
borderTopColor: '#999', borderBottomColor: '#999',
borderLeftColor: '#999', borderRightColor: '#999'
});*/
$('#btAdd').click(function() {
if (iCnt <= 19) {

iCnt = iCnt + 1;

//tomo var rubro
var  valRubro = $('#rr').val();
var textRubro = $( "#rr option:selected" ).text();
var  valSubRubro = $('#srr').val();
var textSubRubro = $( "#srr option:selected" ).text();
// Añadir caja de label.
//$(container).append('<input type=text class="input" id=tb' + iCnt + ' ' +
//'value="Elemento de Texto ' + iCnt + '" />')
$(container).append('<input type="hidden" class="txtRubros" name="txtRubro1[]" id=txtRubro1'+' ' +
'value="'+valRubro+'"><label class="lblRubros">Rubro: '+textRubro+'</label>');
$(container).append('<input type="hidden" class="txtSubRubros" name="txtSubRubro1[]" id=txtSubRubro1' + ' ' +
'value="'+valSubRubro+'"><label class="lblSubRubros">Sub-Rubro: '+textSubRubro+'</label><br /><br />');
/*if (iCnt == 1) {

var divSubmit = $(document.createElement('div'));
$(divSubmit).append('<input type=button class="bt" onclick="GetTextValue()"' +
'id=btSubmit value=Enviar />');

}*/

//$('#main').after(container, divSubmit);
$('#main').after(container);
}
else { //se establece un limite para añadir elementos, 20 es el limite

$(container).append('<label>Limite Alcanzado</label>');
$('#btAdd').attr('class', 'bt-disable');
$('#btAdd').attr('disabled', 'disabled');

}
});

$('#btRemove').click(function() { // Elimina un elemento por click
if (iCnt != 0) {
  $('#lblRubro1' + iCnt).remove();
  $('#lblSubRubros' + iCnt).remove();
  iCnt = iCnt - 1; }

if (iCnt == 0) { $(container).empty();

$(container).remove();
//$('#btSubmit').remove();
$('#btAdd').removeAttr('disabled');
$('#btAdd').attr('class', 'bt')

}
});

$('#btRemoveAll').click(function() { // Elimina todos los elementos del contenedor

$(container).empty();
$(container).remove();
//$('#btSubmit').remove();
iCnt = 0;
$('#btAdd').removeAttr('disabled');
$('#btAdd').attr('class', 'bt');

});
/////////////////////////////////////////////////////////////////////////////////////////
//
////////////////////////PARTE AJAX MODIFICAR DATOS /////////////////////////////
//
/////////////////////////////////////////////////////////////////////////////////////////
$('#btnSigModif').click(function(){
$.ajax({
url: "../Logica/getdataCargarDatosPreIns.php",
type: "POST",
dataType: "json",
data: { NroSol: $("#NroSol").val() },
success: function(data){
if (data.nombres){
alert("Por serguridad, deberá volver a ingresar CUIT, DOMICILIOS y RUBROS");
					$("#nombres").val(data.nombres);
					$("#email").val(data.email);
					$("#conv_multi").val(data.conv_multi);
					$("#localidad").val(data.localidad);
					$("#tel").val(data.tel);
					$("#cp").val(data.cp);
					$("#entidad").val(data.entidad);
					$("#dtos_filiat").val(data.dtos_filiat);
					$("#ap_pat").val(data.ap_pat);
					$("#ap_mat").val(data.ap_mat);
					$("#ap_interesado").val(data.ap_interesado);
					$("#nom_interesado").val(data.nom_interesado);
					$("#dni_int").val(data.dni_int);
					$("#est_civil_int").val(data.est_civil_int);
					$("#localidad_int").val(data.localidad_int);
					$("#provincia_int").val(data.provincia_int);
					$("#cp_int").val(data.cp_int);
					$("#tel_int").val(data.tel_int);
					$("#cel_int").val(data.cel_int);
					$("#ap_cony").val(data.ap_cony);
					$("#nom_cony").val(data.nom_cony);
					$("#dni_cony").val(data.dni_cony);
					$("#ap_aut").val(data.ap_aut);
					$("#nom_aut").val(data.nom_aut);
					$("#cargo_aut").val(data.cargo_aut);
					$("#tipo_doc_aut").val(data.tipo_doc_aut);
					$("#documento_aut").val(data.documento_aut);
					$("#ap_aut2").val(data.ap_aut2);
					$("#nom_aut2").val(data.nom_aut2);
					$("#cargo_aut2").val(data.cargo_aut2);
					$("#tipo_doc_aut2").val(data.tipo_doc_aut2);
					$("#documento_aut2").val(data.documento_aut2);
					$("#ap_aut3").val(data.ap_aut3);
					$("#nom_aut3").val(data.nom_aut3);
					$("#cargo_aut3").val(data.cargo_aut3);
					$("#tipo_doc_aut3").val(data.tipo_doc_aut3);
					$("#documento_aut3").val(data.documento_aut3);
					$("#ap_aut4").val(data.ap_aut4);
					$("#nom_aut4").val(data.nom_aut4);
					$("#cargo_aut4").val(data.cargo_aut4);
					$("#tipo_doc_aut4").val(data.tipo_doc_aut4);
					$("#documento_aut4").val(data.documento_aut4);

					//$("#pruebaRubros").html(data);
}else{
$("#nombres").val("error");
}
}
});

$("#datos").show('slow');
});
/*
$("#btnSigModif").click(function(){

			// enviamos una petición al servidor mediante AJAX enviando el id
			// introducido por el usuario mediante POST
			$.post("../Logica/getdataCargarDatosPreIns.php", {"NroSol":$("#NroSol").val()}, function(data){

				// Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
				//aparte si devuelve nombre cargamos los hidden para los botones

				if(data.nombres){

					$("#nombres").val(data.nombres);
					$("#domicilio").val(data.domicilio);
					$("#email").val(data.email);
					$("#conv_multi").val(data.conv_multi);
					$("#localidad").val(data.localidad);
					$("#tel").val(data.tel);
					$("#cp").val(data.cp);
					$("#entidad").val(data.entidad);
					$("#dtos_filiat").val(data.dtos_filiat);
					$("#ap_pat").val(data.ap_pat);
					$("#ap_mat").val(data.ap_mat);
					$("#ap_interesado").val(data.ap_interesado);
					$("#nom_interesado").val(data.nom_interesado);
					$("#dni_int").val(data.dni_int);
					$("#est_civil_int").val(data.est_civil_int);
					$("#domicilio_int").val(data.domicilio_int);
					$("#localidad_int").val(data.localidad_int);
					$("#provincia_int").val(data.provincia_int);
					$("#cp_int").val(data.cp_int);
					$("#tel_int").val(data.tel_int);
					$("#cel_int").val(data.cel_int);
					$("#ap_cony").val(data.ap_cony);
					$("#nom_cony").val(data.nom_cony);
					$("#dni_cony").val(data.dni_cony);
					$("#ap_aut").val(data.ap_aut);
					$("#nom_aut").val(data.nom_aut);
					$("#cargo_aut").val(data.cargo_aut);
					$("#tipo_doc_aut").val(data.tipo_doc_aut);
					$("#documento_aut").val(data.documento_aut);
					$("#ap_aut2").val(data.ap_aut2);
					$("#nom_aut2").val(data.nom_aut2);
					$("#cargo_aut2").val(data.cargo_aut2);
					$("#tipo_doc_aut2").val(data.tipo_doc_aut2);
					$("#documento_aut2").val(data.documento_aut2);
					$("#ap_aut3").val(data.ap_aut3);
					$("#nom_aut3").val(data.nom_aut3);
					$("#cargo_aut3").val(data.cargo_aut3);
					$("#tipo_doc_aut3").val(data.tipo_doc_aut3);
					$("#documento_aut3").val(data.documento_aut3);
					$("#ap_aut4").val(data.ap_aut4);
					$("#nom_aut4").val(data.nom_aut4);
					$("#cargo_aut4").val(data.cargo_aut4);
					$("#tipo_doc_aut4").val(data.tipo_doc_aut4);
					$("#documento_aut4").val(data.documento_aut4);
				}else{
					$("#nombres").val("error");
				}

		},"json");

			$("#datos").show('slow');
		});*/

});//fin document.ready

// Obtiene los valores
var divValue, values = '';

function GetTextValue() {

$(divValue).empty();
$(divValue).remove(); values = '';

$('.input').each(function() {
divValue = $(document.createElement('div')).css({
padding:'5px', width:'200px'
});
values += this.value + '<br />'
});

$(divValue).append('<p><b>Tus valores añadidos</b></p>' + values);
$('body').append(divValue);
////////////////////////////////////////////////////////////////////////////////
//
//PARTE AUTORIZADOS
//
///////////////////////////////////////////////////////////////////////////////
//Parte Rubros

}
