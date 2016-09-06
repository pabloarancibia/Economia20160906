function validadorR(formulario) { 
    if((formulario.fturno.value=="")||(formulario.apellido.value=="")||(formulario.nombre.value=="")||(formulario.tel.value=="")||(formulario.dni.value=="")||(formulario.domicilio.value==""))   
    {
        alert("DEBE COMPLETAR TODOS LOS CAMPOS DEL FORMULARIO"); 
        formulario.fturno.focus(); 
        //formulario.apellido.focus(); 
        return (false); 
    }else{
      //  +++++++++++++++++CONTROL de FECHA de PEDIDO de TURNO+++++++++++++++++
     /*   var fecActual=new Date();
        var f2=formulario.fturno.value;
        if((Date.parse(fecActual))>(Date.parse(f2))){
            alert("Seleccione una fecha a partir de mañana");
            formulario.fturno.focus();
           return (false);            
                }
		if (f2.length > 10){
			alert("Puede utilizar cualquier navegador si no se muestra la fecha en forma correcta");
            formulario.fturno.focus();
            return (false);
		}
       */ 
        //++++++++++++++ CONTROL APELLIDO++++++++++++++++++++++++++++++++
        if (formulario.apellido.value.length < 2) { 
            alert("El apellido no tiene el formato correcto"); 
            formulario.apellido.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formulario.apellido.value; 
        var allValid = true; 
        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
        } 
        if (!allValid) { 
            alert("El Apellido no tiene el formato correcto"); 
            formulario.apellido.focus(); 
            return (false); 
        } 
         //++++++++++++++ CONTROL NOMBRE++++++++++++++++++++++++++++++++
        
         var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formulario.nombre.value; 
        var allValid = true; 
        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
        } 
        if (!allValid) { 
            alert("el Nombre no tiene el formato correcto"); 
            formulario.nombre.focus(); 
            return (false); 
        } 
         //++++++++++++++ CONTROL DNI++++++++++++++++++++++++++++++++
        var checkOK = "0123456789"; 
        var checkStr = formulario.dni.value; 
        var allValid = true; 
        var decPoints = 0; 
        var allNum = ""; 


        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
            allNum += ch; 
        } 
        if (!allValid) { 
            alert("Escriba solo digitos en el campo dni"); 
            formulario.dni.focus(); 
            return (false); 
        } 
         //++++++++++++++ CONTROL TELEFONO++++++++++++++++++++++++++++++++
        var checkOK = "0123456789"; 
        var checkStr = formulario.tel.value; 
        var allValid = true; 
        var decPoints = 0; 
        var allNum = ""; 


        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
            allNum += ch; 
        } 
        if (!allValid) { 
            alert("Escriba solo digitos en el campo telefono"); 
            formulario.tel.focus(); 
            return (false); 
        } 
 //++++++++++++++ CONTROL Datos Padre++++++++++++++++++++++++++++++++
        if (formulario.nombrepa.value.length < 2) { 
            alert("El apellido del padre no tiene el formato correcto"); 
            formulario.nombrepa.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formulario.nombrepa.value; 
        var allValid = true; 
        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
        } 
        if (!allValid) { 
            alert("El Apellido no tiene el formato correcto"); 
            formulario.nombrepa.focus(); 
            return (false); 
        } 

 //++++++++++++++ CONTROL Datos Madre++++++++++++++++++++++++++++++++
        if (formulario.nombrema.value.length < 2) { 
            alert("El apellido de la madre no tiene el formato correcto"); 
            formulario.nombrema.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formulario.nombrema.value; 
        var allValid = true; 
        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
        } 
        if (!allValid) { 
            alert("El Apellido no tiene el formato correcto"); 
            formulario.nombrema.focus(); 
            return (false); 
        } 
 //++++++++++++++ CONTROL Estado civil++++++++++++++++++++++++++++++++
        if (formulario.estadocivil.value.length < 2) { 
            alert("El estado civil no tiene el formato correcto"); 
            formulario.estadocivil.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formulario.estadocivil.value; 
        var allValid = true; 
        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) 
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
        } 
        if (!allValid) { 
            alert("El estado civil no tiene el formato correcto"); 
            formulario.estadocivil.focus(); 
            return (false); 
        } 


    }


}












