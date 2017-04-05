$(document).ready(function(){
  //limpio
  $("#txtCuit").val("");
  $("#txtNroSol").val("");
  //oculto todos los datos q estan en el formulario//
  $("#datosProv").hide();
  $("#cuitIns").hide();
  $("#cuitNoIns").hide();
  $("#cuitProvConNum").hide();
  $("#emailIns").hide();
  $("#emailNoIns").hide();
  $("#emailProvConNum").hide();
  $("#nroProvIns").hide();
  $("#nroProvNoIns").hide();
  $("#nroProvConNum").hide();
  $("#nroSolIns").hide();
  $("#nroSolNoIns").hide();
  $("#nroSolProvConNum").hide();

  $("#getdata").click(function(){

  			// enviamos una petición al servidor mediante AJAX enviando el id
  			// introducido por el usuario mediante POST
  			$.post("../Logica/getdataActivarProveedorDef.php", 
			{
				"txtCuit":$("#txtCuit").val(),
				"txtNroSol":$("#txtNroSol").val()
			}, 
			function(data){
  				// Si devuelve un nombre lo mostramos, si no, vaciamos la casilla
          //aparte si devuelve nombre cargamos los hidden para los botones
  				if(data.nombres){
  					$("#nombres").val(data.nombres);
            $("#cuitIns").val(data.cuit);
            $("#cuitNoIns").val(data.cuit);
            $("#cuitProvConNum").val(data.cuit);
			$("#emailIns").val(data.email);
            $("#emailNoIns").val(data.email);
			$("#emailProvConNum").val(data.email);
			$("#nroProvIns").val(data.nroProv);
			$("#nroProvNoIns").val(data.nroProv);
			$("#nroProvConNum").val(data.nroProv);
			$("#nroSolIns").val(data.numSol);
			$("#nroSolNoIns").val(data.numSol);
			 $("#nroSolProvConNum").val(data.numSol);
  				}else{
  					$("#nombres").val("error");
          }
  				// Si devuelve un domicilio lo mostramos, si no, vaciamos la casilla
  				if(data.domicilio){
  					$("#domicilio").val(data.domicilio);
  				}else{
  					$("#domicilio").val("error");

  			}
			// Si devuelve un numero de solicitud lo mostramos, si no, vaciamos la casilla
  				if(data.numSol){
  					$("#nroSol").val(data.numSol);
  				}else{
  					$("#nroSol").val("error");

  			}
			// Si devuelve un numero de dni de interesado lo mostramos, si no, vaciamos la casilla
  				if(data.dniInt){
  					$("#dniInt").val(data.dniInt);
  				}else{
  					$("#dniInt").val("error");

  			}
			},"json");

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
