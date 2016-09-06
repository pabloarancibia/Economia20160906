jQuery(function() {
    // Indicador de carga
    var loader = jQuery('<div id="loader">Enviando . . .</div>')
        .css({position: "relative", bottom: "0px", left: "center", color: "#690D1A", padding: "5px"})
        .appendTo("#mensaje")
        .hide();
 
    jQuery("#form1").ajaxStart(function() {
        loader.show();
    }).ajaxStop(function() {
        loader.hide();
    }).ajaxError(function(a, b, e) {
        throw e;
    });
 
    var v = jQuery("#form1").validate({
        submitHandler: function(form1) {
            jQuery(form1).ajaxSubmit({
                target: "#resultado",
                success: function(responseText, statusText) {
                }
            });
        }
    });
});