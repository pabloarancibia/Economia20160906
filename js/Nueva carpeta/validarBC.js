function valBC(formu) { 
    if((formu.fturno.value=="")||(formu.apellido.value=="")||(formu.nombre.value=="")||(formu.tel.value=="")||(formu.nombrepa.value=="")||(formu.nombrema.value=="")||
(formu.dni.value=="")||(formu.domicilio.value=="")||(formu.ocupacion.value=="")||(formu.estadocivil.value=="")||(formu.presenta.value=""))   
    {
        alert("FALTAN COMPLETAR CAMPOS DEL FORMULARIO"); 
        formu.fturno.focus(); 
        //formu.apellido.focus(); 
        return (false); 
    }else{
       // +++++++++++++++++CONTROL de FECHA de PEDIDO de TURNO+++++++++++++++++
      /*  var fecActual=new Date();
        var f2=formu.fturno.value;
        if((Date.parse(fecActual))>(Date.parse(f2))){
            alert("Seleccione una fecha a partir de mañana");
            formu.fturno.focus();
            return (false);            
        }
		if (f2.length > 10){
			alert("Puede utilizar cualquier navegador si no se muestra la fecha en forma correcta");
            formu.fturno.focus();
            return (false);
		}
        */
        //++++++++++++++ CONTROL APELLIDO++++++++++++++++++++++++++++++++
        if (formu.apellido.value.length < 2) { 
            alert("El apellido no tiene el formato correcto"); 
            formu.apellido.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formu.apellido.value; 
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
            formu.apellido.focus(); 
            return (false); 
        } 
         //++++++++++++++ CONTROL NOMBRE++++++++++++++++++++++++++++++++
        
         var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formu.nombre.value; 
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
            formu.nombre.focus(); 
            return (false); 
        } 
         //++++++++++++++ CONTROL DNI++++++++++++++++++++++++++++++++
        var checkOK = "0123456789"; 
        var checkStr = formu.dni.value; 
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
            formu.dni.focus(); 
            return (false); 
        } 
         //++++++++++++++ CONTROL TELEFONO++++++++++++++++++++++++++++++++
        var checkOK = "0123456789"; 
        var checkStr = formu.tel.value; 
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
            formu.tel.focus(); 
            return (false); 
        } 
 //++++++++++++++ CONTROL Datos Padre++++++++++++++++++++++++++++++++
        if (formu.nombrepa.value.length < 2) { 
            alert("El apellido del padre no tiene el formato correcto"); 
            formu.nombrepa.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formu.nombrepa.value; 
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
            formu.nombrepa.focus(); 
            return (false); 
        } 

 //++++++++++++++ CONTROL Datos Madre++++++++++++++++++++++++++++++++
        if (formu.nombrema.value.length < 2) { 
            alert("El apellido de la madre no tiene el formato correcto"); 
            formu.nombrema.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formu.nombrema.value; 
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
            formu.nombrema.focus(); 
            return (false); 
        } 
 //++++++++++++++ CONTROL Estado civil++++++++++++++++++++++++++++++++
        if (formu.estadocivil.value.length < 2) { 
            alert("El estado civil no tiene el formato correcto"); 
            formu.estadocivil.focus(); 
            return (false); 
        } 
        var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ"+"abcdefghijklmnñopqrstuvwxyzáéíóú"+" "; 
        var checkStr = formu.estadocivil.value; 
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
            formu.estadocivil.focus(); 
            return (false); 
        } 


    }


}









