//verificamos los options que tienen q estar chek segun chek realizados
//verificamos el tema del porcentaje
//verificamos los valos agregados a la tabla de dias
function verifOpt(){
  /////////////////////
  ///*  PRUEBA DE FUEGO ---- BootStrap MENSAJE DE ALERTA  *////
  /////////////////////
	/*	$(function() {
			(function (BootStrap, $, undefined) {

				var Utils = (function () {
					function Utils() {
						//ctor
					}

					Utils.prototype.createAlert = function (title, message, alertType, targetElement) {
						var html = '<div class="alert alert-block ' + alertType + '">' +
										'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
										'<h4>' + title + '</h4>' + message  +
									'</div>'
						$(targetElement).prepend(html);
					}

					return Utils;

				})();

				BootStrap.Utils = Utils;

			})(window.BootStrap || (window.BootStrap = {}),jQuery);

            //new BootStrap.Utils().createAlert("Titulo de la alerta", "Mensaje de alerta", "alert-danger", "body");
		});
*/
  //// FIN PRUEBA BootStrap//////
  //////////////////////////////
  //////////////////////////////
  //parte porcentaje
var pcart =document.getElementById('pcartones');
var pplast =document.getElementById('pplasticos');
var porga =document.getElementById('porganicos');
var potros = document.getElementById('potros');
//VALIDACION AL FINAL
//parte tabla dias
var mtsLun = document.getElementsByName('mtsLun');
var mtsMar = document.getElementsByName('mtsMar');
var mtsMier = document.getElementsByName('mtsMier');
var mtsJuev = document.getElementsByName('mtsJuev');
var mtsVier = document.getElementsByName('mtsVier');
var mtsSab = document.getElementsByName('mtsSab');
var mtsDom = document.getElementsByName('mtsDom');

var kgLun = document.getElementsByName('kgLun');
var kgMar = document.getElementsByName('kgMar');
var kgMier = document.getElementsByName('kgMier');
var kgJuev = document.getElementsByName('kgJuev');
var kgVier = document.getElementsByName('kgVier');
var kgSab = document.getElementsByName('kgSab');
var kgDom = document.getElementsByName('kgDom');

var bolLun = document.getElementsByName('bolLun');
var bolMar = document.getElementsByName('bolMar');
var bolMier = document.getElementsByName('bolMier');
var bolJuev = document.getElementsByName('bolJuev');
var bolVier = document.getElementsByName('bolVier');
var bolSab = document.getElementsByName('bolSab');
var bolDom = document.getElementsByName('bolDom');

//al FINAL de este documento las validaciones con IF

//parte options
var a5 = document.getElementsByName("optDif");//a5
var mtt = document.getElementsByName("optDifSi");//muni tercero tas
var a5b1 = document.getElementsByName("DifSiTercero").value;//selec tercero a5b1
var a5b2 = document.getElementsByName("freqDif");
var a5c = document.getElementsByName("cubreDif");
var a51 = document.getElementsByName("necDif");//a51
var a51a = document.getElementsByName("freqNecDif");//a51a
var a6 = document.getElementsByName("depBasura");
var txtOtros = document.getElementById("txtOtros").value;
var a7 = document.getElementsByName("hrRec");

var va5 = 'nc';//nc: no corresponde
var vmtt = 'nc';
var va5b1 = 'nc';
var va5b2 = 'nc';
var va5c = 'nc';
var va51 = 'nc';
var va51a = 'nc';
var va6 = 'nc';
var vtxtOtros = 'nc';
var va7 = 'nc';

var vla5 = 'nc';//nc: no corresponde
var vlmtt = 'nc';
var vla5b1 = 'nc';
var vla5b2 = 'nc';
var vla5c = 'nc';
var vla51 = 'nc';
var vla51a = 'nc';
var vla6 = 'nc';
var vltxtOtros = 'nc';
var vla7 = 'nc';

//funcion verif a5
var va5='nop';
for(var i=0; i<a5.length; i++) {//a5
  //entro al for por lo tanto significa q verifique(a5 verifica si o si), le doy nop
  if(a5[i].checked) {//a5
    // si fue seleccionado entonces verifico su valor para los siguientes options
    va5='ok';
    vla5=a5[i].value;//entro al true por ende hay alguna seleccionada, le doy el valor y salgo con break
  break;}}//cierro el if y el for

//funcion chek a5
  //si selecciono si --> verifico que 6a5a especificar tercero este checked
  if (va5=='ok' && vla5=='si'){//si tiene ok a5 y el valor es si
    vmtt='nop'; //entonces vmtt es por defecto nop hasta q se demuestre lo contrario
    for(var i=0; i<mtt.length; i++) {//mtt
      if(mtt[i].checked) {//mtt
        vmtt='ok';
        vlmtt=mtt[i].value;
        break;}}//cierro if for
      }//cierro if va5 vla5

  //ahora verifico si vmtt esta como ok y si val es tercero
  if (vmtt=='ok' && vlmtt=='tercero'){
    if( a5b1 == null || a5b1.length == 0 || /^\s+$/.test(a5b1) ){//verifico si a5b1 esta vacio
      va5b1='nop';//si esta vacio le asigno q no
    }else{va5b1='ok';}//no esta vacio le asigno ok
  }//si no cumple la condicion es q a5b1 no requiere chekeo qdara en nc
  //verifico a5b2, se tiene q dar q a5 sea ok y si
  if (va5=='ok' && vla5=='si'){//si tiene ok a5 y el valor es si
    va5b2='nop'; //entonces v es por defecto nop hasta q se demuestre lo contrario
    for(var i=0; i<a5b2.length; i++) {//
      if(a5b2[i].checked) {//
        va5b2='ok';
        vla5b2=a5b2[i].value;
        break;}}//cierro if for
      }//cierro if va5 vla5
//a5c
    if (va5=='ok' && vla5=='si'){
      va5c='nop';
      for (var i=0;i<a5c.length;i++){
        if(a5c[i].checked) {//
          va5c='ok';
          vla5c=a5c[i].value;
          break;}}//cierro if for
        }
//a5c no
//a51
        if (va5c=='ok' && vla5c=='no'){
            va51='nop';
            for (var i=0;i<a51.length;i++){
                if(a51[i].checked) {//
                  va51='ok';
                  vla51=a51[i].value;
                  break;}}//cierro if for
          }
//a51 si
//a51a
          if (va51=='ok' && vla51=='si'){
              va51a='nop';
              for (var i=0;i<a51a.length;i++){
                  if(a51a[i].checked) {//
                    va51a='ok';
                    vla51a=a51a[i].value;
                    break;}}//cierro if for
            }
//a5 no
if (va5=='ok' && vla5=='no'){//si tiene ok a5 y el valor es si
  va51='nop'; //entonces  es por defecto nop hasta q se demuestre lo contrario
  for(var i=0; i<a51.length; i++) {//
    if(a51[i].checked) {//
      va51='ok';
      vla51=a51[i].value;
      break;}}//cierro if for
    }
    //a51 si //a51a
    //ya esta arriba...
    if (va51=='ok' && vla51=='si'){
        va51a='nop';
        for (var i=0;i<a51a.length;i++){
            if(a51a[i].checked) {//
              va51a='ok';
              vla51a=a51a[i].value;
              break;}}//cierro if for
      }
//a6
va6='nop';
    for(var i=0; i<a6.length; i++) {//
      if(a6[i].checked) {//
        va6='ok';
        vla6=a6[i].value;
        break;}}//cierro if for
    //si a6 es otros txtotros
    if(va6=='ok'&&vla6=='otros'){
      if( txtOtros == null || txtOtros.length == 0 || /^\s+$/.test(txtOtros) ){//verifico si  esta vacio
        vtxtOtros='nop';//si esta vacio le asigno q no
      }else{vtxtOtros='ok';}
    }
//a7
va7='nop';
      for(var i=0; i<a7.length; i++) {//
        if(a7[i].checked) {//
          va7='ok';
          vla7=a7[i].value;
        break;}}//cierro if for
////////////////////////////////////////////////////////////////////////////////////
        if(va5=='nop'){
          //alert("debe completar el campo 6-A 5");
          var html = '<div class="mensaje-error">' +
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  'debe completar el campo 6-A 5'  +
                '</div>'
          $('#a5MsgErr').prepend(html);
          setTimeout(function(){document.getElementById('a5Foco').focus();}, 1);
          return false;
        }else if (va6=='nop') {
          //alert("debe completar 6-A.6");
          var html = '<div class="mensaje-error">' +
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  'debe completar el campo 6-A 6'  +
                '</div>'
          $('#6a6').prepend(html);
          setTimeout(function(){document.getElementById('6a6Focus').focus();}, 1);
          return false;
        }
        return true;
    }
