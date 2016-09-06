window.addEventListener('load', inicio, false);
//document.getElementById('optDifSi').style.display='block';
function foptDif(valor) {
  //var optDif = document.getElementById('optDif');//.addEventListener('click', presion, false);
  var optDifSi = document.getElementById('idoptDifSi');
  var optDifSiB = document.getElementById('optDifSiB');
  var optDifNo = document.getElementById('optDifNo');
  var optDifNoSi = document.getElementById('optDifNoSi');
  if (valor=='si'){
    //oculto y restablesco lo de No;
    optDifNo.style.display='none';
    optDifNoSi.style.display='none';
    //res
    var necDif=document.getElementsByName('necDif');
    for(var i=0;i<necDif.length;i++)
    {necDif[i].checked = false;}
    var freqNecDif=document.getElementsByName('freqNecDif');
    for(var i=0;i<freqNecDif.length;i++)
    {freqNecDif[i].checked = false;}
    //muestro lo de SI
    optDifSi.style.display='';
    optDifSiB.style.display='';
  }else{
    //oculto lo de si y lo restablesco
    optDifSi.style.display='none';
    optDifSiB.style.display='none';
    //oc y res tercero por si estaba abierto
    var ter=document.getElementById('optDifSiTercero');
    ter.style.display='none';
    var optDifSiName=document.getElementsByName('optDifSi');
    for(var i=0;i<optDifSiName.length;i++)
    {optDifSiName[i].checked = false;}
    //
    var optDifSiBName=document.getElementsByName('optDifSiB');
    for(var i=0;i<optDifSiBName.length;i++)
    {optDifSiBName[i].checked = false;}
    //res freqDif y cubreDif
    var freqDif=document.getElementsByName('freqDif');
    for(var i=0;i<freqDif.length;i++)
    {freqDif[i].checked = false;}
    var cubreDif=document.getElementsByName('cubreDif');
    for(var i=0;i<cubreDif.length;i++)
    {cubreDif[i].checked = false;}
    //muestro lo de NO
    optDifNo.style.display='';
    //optDifNoSi.style.display='';
  }
}
function foptDifSiTercero(valor){
  var optDifSiTercero = document.getElementById('optDifSiTercero');
  if (valor=='ter'){
    //optDifSi();
    optDifSiTercero.style.display='';
  }else{
    //optDifNo();
    optDifSiTercero.style.display='none';
  }
}
function foptDifNo(valor){
  var optDifNoSi = document.getElementById('optDifNoSi');
  if (valor=='si'){
    //optDifSi();
    optDifNoSi.style.display='';
  }else{
    //optDifNo();
    optDifNoSi.style.display='none';
    //limpio 6a51a
    var freqNecDif=document.getElementsByName('freqNecDif');
    for(var i=0;i<freqNecDif.length;i++)
    {freqNecDif[i].checked = false;}
  }
}  //window.addEventListener('load', inicio, false);
function flbltxtOtros(valor){
  var lbltxtOtros = document.getElementById('lbltxtOtros');
  if (valor=='otros'){
    //optDifSi();
    lbltxtOtros.style.display='';
  }else{
    //optDifNo();
    lbltxtOtros.style.display='none';
  }
}
function fcubreDif(valor){
  var optDifNo = document.getElementById('optDifNo');
  if (valor=='no'){
    //optDifSi();
    optDifNo.style.display='';
    //foptDifNo('no');
  }else{
    //optDifNo();
    optDifNo.style.display='none';
    foptDifNo('no');
    //limpio por si estaba cheq 6a51 y 6a51a
    var necDif=document.getElementsByName('necDif');
    for(var i=0;i<necDif.length;i++)
    {necDif[i].checked = false;}
    var freqNecDif=document.getElementsByName('freqNecDif');
    for(var i=0;i<freqNecDif.length;i++)
    {freqNecDif[i].checked = false;}
  }
}
function inicio() {
        document.getElementById('idoptDifSi').style.display='none';
        document.getElementById('optDifSiB').style.display='none';
        document.getElementById('optDifSiTercero').style.display='none';
        document.getElementById('optDifNo').style.display='none';
        document.getElementById('optDifNoSi').style.display='none';
        document.getElementById('lbltxtOtros').style.display='none';


    }
