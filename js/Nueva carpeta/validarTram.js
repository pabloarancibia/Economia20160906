function validME(formulario) {
    	if(formulario.numeroMe.value=="")   
    {
        alert("complete el campo del formulario"); 
        formulario.numeroMe.focus(); 
        return (false); 
    }
	else {
		//----------------
		var checkOK = "0123456789"; 
        var checkStr = formulario.numeroMe.value; 
        var allValid = true; 
        var decPoints = 0; 
        var allNum = ""; 
        for (i = 0; i < checkStr.length; i++) { 
            ch = checkStr.charAt(i); 
            for (j = 0; j < checkOK.length; j++) {
                if (ch == checkOK.charAt(j)) 
                    break; 
            if (j == checkOK.length) { 
                allValid = false; 
                break; 
            } 
            allNum += ch; }
        } 
        if (!allValid) { 
            alert("Escriba solo digitos en el campo dni"); 
            formulario.numeroMe.focus(); 
            return (false); 
        }
		//----
 }
}