$(document).ready(function(){
  $("#txtCuit").val("");
  $("#datosProv").hide();
  $("#cuitIns").hide();
  $("#cuitNoIns").hide();
  $("#emailIns").hide();
  $("#emailNoIns").hide();
  $("#nroProvIns").hide();
  $("#nroProvNoIns").hide();


  $("#getdata").click(function(){

  			// enviamos una petición al servidor mediante AJAX enviando el id
  			// introducido por el usuario mediante POST
  			$.post("../Logica/getdataActivarProveedorDef.php", {"txtCuit":$("#txtCuit").val()}, function(data){
  				// Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          //aparte si devuelve nombre cargamos los hidden para los botones
  				if(data.nombres){
  					$("#nombres").val(data.nombres);
            $("#cuitIns").val(data.cuit);
            $("#cuitNoIns").val(data.cuit);
            $("#emailIns").val(data.email);
            $("#emailNoIns").val(data.email);
			$("#nroProvIns").val(data.nroProv);
			$("#nroProvNoIns").val(data.nroProv);
  				}else{
  					$("#nombres").val("error");
          }
  				// Si devuelve un apellido lo mostramos, si no, vaciamos la casilla
  				if(data.domicilio){
  					$("#domicilio").val(data.domicilio);
  				}else{
  					$("#domicilio").val("error");

  			}},"json");

        $("#datosProv").show('slow');
      });
/*  $('#getdata').click(function(){
    var post_data = {nroCuit: $('#txtCuit').val()};
	$.ajax({
			url: '../Logica/getdataActivarProveedorDef.php',
			type:'POST',
			dataType: 'json',
      data: post_data,
			success: function(output_string){
					$('#datosProv').append(output_string);
				} // Fin de success
			}); // Fin de la llamada al ajax

});*/
});
