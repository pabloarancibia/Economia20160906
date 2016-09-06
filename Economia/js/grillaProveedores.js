// JavaScript Document
var ordenar = '';
$(document).ready(function(){
	
	// Llamando a la funcion de busqueda al
	// cargar la pagina
	//filtrar()
	
		// filtrar al darle click al boton
	$("#btnfiltrar").click(function(){ filtrar() });
	
	// boton cancelar
	$("#btncancel").click(function(){ 
		$(".filtro input").val('')
		filtrar() 
	});
	
	//ordenar (cuando hace click en los encabezados)
	/*$("#data th span").click(function(){
		var orden = '';
		if($(this).hasClass("desc"))
		{
			$("#data th span").removeClass("desc").removeClass("asc")
			$(this).addClass("asc");
			ordenar = "&orderby="+$(this).attr("title")+" asc"		
		}else
		{
			$("#data th span").removeClass("desc").removeClass("asc")
			$(this).addClass("desc");
			ordenar = "&orderby="+$(this).attr("title")+" desc"
		}
		filtrar()
	});*/
});//fin document ready
function filtrar()
{
	
$.ajax({
	data:$("#frm_filtro").serialize(),//+ordenar,
	type:"POST",
	dataType:"json",
	url:"../Logica/ajaxGrillaProv.php?action=listar",
	success: function(data){
		var html = '';
		if (data.length>0){
			$.each(data, function(i,item){//agregar todos los campos//
				html += '<tr>'
					html += '<td>'+item.nroProv+'</td>'
					html += '<td>'+item.cuit+'</td>'					
					html += '<td>'+item.conv_multi+'</td>'
			html += '<td>'+item.email+'</td>'
			html += '<td>'+item.nombres+'</td>'
			html += '<td>'+item.domicilio+'</td>'
			html += '<td>'+item.localidad+'</td>'
			html += '<td>'+item.tel+'</td>'
			html += '<td>'+item.cp+'</td>'
			html += '<td>'+item.entidad+'</td>'
			html += '<td>'+item.dtos_filiat+'</td>'
			html += '<td>'+item.ap_pat+'</td>'
			html += '<td>'+item.ap_mat+'</td>'
			html += '<td>'+item.ap_interesado+'</td>'
			html += '<td>'+item.nom_interesado+'</td>'
			html += '<td>'+item.dni_int+'</td>'
			html += '<td>'+item.est_civil_int+'</td>'
			html += '<td>'+item.domicilio_int+'</td>'
			html += '<td>'+item.localidad_int+'</td>'
			html += '<td>'+item.provincia_int+'</td>'
			html += '<td>'+item.cp_int+'</td>'
			html += '<td>'+item.tel_int+'</td>'
			html += '<td>'+item.cel_int+'</td>'
			html += '<td>'+item.ap_cony+'</td>'
			html += '<td>'+item.nom_cony+'</td>'
			html += '<td>'+item.dni_cony+'</td>'
			html += '<td>'+item.ap_aut+'</td>'
			html += '<td>'+item.nom_aut+'</td>'
			html += '<td>'+item.cargo_aut+'</td>'
			html += '<td>'+item.documento_aut+'</td>'
			html += '<td>'+item.validado+'</td>'
				html += '</tr>';
			});
		}
		if(html == '') html = '<tr><td colspan="4" align="center">No se encontraron registros..</td></tr>'
		$("#data tbody").html(html);
		//$("#tbody").html(html);
	}
	
});//fin ajax
}//fin funcion filtrar