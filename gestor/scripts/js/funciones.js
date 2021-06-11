function EnviarEntradaDirectorio(x,tipo){

	var cad = ""; 
	var subservicios = "";
	
	var content = tinyMCE.getContent(tinyMCE.getWindowArg('editor_id'));
	content = content.replace(/\+/g, "&#43");
	content = content.replace(/\\/g, "&#92");
	content = escape(content);

	if(navigator.userAgent == "Explorer"){
		x.TEXTO.innerHTML = content;
		x.TEXTO.value = content;
	}else{

		x.TEXTO.value = content;	
		x.TEXTO.innerHTML = content;

	}
	
	for (i=0; i < x.length; i++ ){
		
		if(x[i].type == "select-multiple"){
			if(x[i].selectedIndex < 0){
				document.getElementById("error").style.display = "";
				document.getElementById("errormsn").innerHTML = "Debes de seleccionar un tipo de servicio";
				return false;
			}else{
				
				for(j=0; j < x[i].length;j++){
						if(x[i].options[j].selected){
							if(subservicios == ""){
								subservicios = x[i].options[j].value;
							}else{
								subservicios = subservicios + "-" + x[i].options[j].value;
							}
						}
					}
			}		
		}
		
		if (cad == ""){
			if(x[i].type == "select-multiple"){
				cad = x[i].name + "=" + subservicios;
			}else{
				cad =  x[i].name + "=" + x[i].value;
			}
		}else{
			if(x[i].type == "select-multiple"){
				cad = cad + "&" + x[i].name + "=" + subservicios;	
			}else{
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
			}
		}
	}
	
	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatos.php','espere',cad,'post');
		IniciarForm(x);
	}else{
		FAjax('editardatos.php','espere',cad,'post')
	}
	
}

function EnviarEntradaMuseo(x,tipo){

	var cad = ""; 
	var subservicios = "";
	
	var content = tinyMCE.getContent(tinyMCE.getWindowArg('editor_id'));
	content = content.replace(/\+/g, "&#43");
	content = content.replace(/\\/g, "&#92");
	content = escape(content);

	if(navigator.userAgent == "Explorer"){
		x.TEXTO.innerHTML = content;
		x.TEXTO.value = content;
	}else{

		x.TEXTO.value = content;	
		x.TEXTO.innerHTML = content;
	}
	
	for (i=0; i < x.length; i++ ){
		
		if (cad == ""){
			if(x[i].type == "select-multiple"){
				cad = x[i].name + "=" + subservicios;
			}else{
				cad =  x[i].name + "=" + x[i].value;
			}
		}else{
			if(x[i].type == "select-multiple"){
				cad = cad + "&" + x[i].name + "=" + subservicios;	
			}else{
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
			}
		}
	}
	
	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosmuseo.php','espere',cad,'post');
		IniciarForm(x);
	}else{
		FAjax('editardatosmuseo.php','espere',cad,'post')
	}
	
}

function EnviarEntradaRuta(x,tipo){

	var cad = ""; 
	var subservicios = "";
	
	var content = tinyMCE.getContent(tinyMCE.getWindowArg('editor_id'));
	content = content.replace(/\+/g, "&#43");
	content = content.replace(/\\/g, "&#92");
	content = escape(content);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = content;
		x.DESCRIPCION.value = content;
		x.FLORA.innerHTML = content;
		x.FLORA.value = content;
		x.FAUNA.innerHTML = content;
		x.FAUNA.value = content;
	}else{
		x.DESCRIPCION.value = content;	
		x.DESCRIPCION.innerHTML = content;
		x.FLORA.value = content;	
		x.FLORA.innerHTML = content;
		x.FAUNA.value = content;	
		x.FAUNA.innerHTML = content;
	}
	
	for (i=0; i < x.length; i++ ){
		
		if (cad == ""){
			if(x[i].type == "select-multiple"){
				cad = x[i].name + "=" + subservicios;
			}else{
				cad =  x[i].name + "=" + x[i].value;
			}
		}else{
			if(x[i].type == "select-multiple"){
				cad = cad + "&" + x[i].name + "=" + subservicios;	
			}else{
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
			}
		}
	}
	
	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosruta.php','espere',cad,'post');
	}else{
		FAjax('editardatosruta.php','espere',cad,'post')
	}
	
}

function IniciarForm(x){
	for (i=0;i < x.length ;i++){
		if((x[i].type == "text") || (x[i].type == "textarea")){
			x[i].value = "";	
		}
	}
	tinyMCE.execInstanceCommand('mce_editor_0', 'mceSetContent', false, ' ');
}


function disDiv(id,dis) {
    var theDiv = document.getElementById(id)
    var theFields = theDiv.getElementsByTagName('input');
    for (var i=0; i < theFields.length;i++) theFields[i].disabled=dis;
    theDiv.disabled=dis
	var theFields = theDiv.getElementsByTagName('select');
    for (var i=0; i < theFields.length;i++) theFields[i].disabled=dis;
    theDiv.disabled=dis
	var theFields = theDiv.getElementsByTagName('textarea');
    for (var i=0; i < theFields.length;i++) theFields[i].disabled=dis;
    theDiv.disabled=dis
  }
  
  
function creaAjax(){
       var objetoAjax=false;
       try {
        /*Para navegadores distintos a internet explorer*/
        objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
       } catch (e) {
        try {
                 /*Para explorer*/
                 objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
                 }
                 catch (E) {
                 objetoAjax = false;
        }
       }

       if (!objetoAjax && typeof XMLHttpRequest!='undefined') {
        objetoAjax = new XMLHttpRequest();
       }
       return objetoAjax;
}

function FAjax (url,capa,valores,metodo)
{
          var ajax=creaAjax();
          var capaContenedora = document.getElementById(capa);

/*Creamos y ejecutamos la instancia si el metodo elegido es POST*/
if(metodo.toUpperCase()=='POST'){
         ajax.open ('POST', url, true);
         ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
                          capaContenedora.style.display = "";
                         
         }
         else if (ajax.readyState==4){
                   if(ajax.status==200)
                   {                      
                        respuesta = ajax.responseText;
												if (respuesta == ""){	
													disDiv("contenido",false); 
													capaContenedora.style.display = "none";
													
												}
												else{
													capaContenedora.style.display = "none";	
													document.getElementById("error").style.display = "";
													document.getElementById("errormsn").innerHTML = respuesta;
												}
                   }
                   else if(ajax.status==404)
                                             {

                            capaContenedora.style.display = "none";	
                            document.getElementById("error").style.display = "";
														document.getElementById("errormsn").innerHTML = "La direccion no existe";
                                             }
                           else
                              
                                           {
                            capaContenedora.style.display = "none";	
                            document.getElementById("error").style.display = "";
														document.getElementById("errormsn").innerHTML = "Error: " + ajax.status;
                                             }
                                    }
                  }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         ajax.send(valores);
         return;
}
/*Creamos y ejecutamos la instancia si el metodo elegido es GET*/
if (metodo.toUpperCase()=='GET'){

         ajax.open ('GET', url, true);
         ajax.onreadystatechange = function() {
         if (ajax.readyState==1) {
             capaContenedora.innerHTML="Cargando.......";
         }
         else if (ajax.readyState==4){
                   if(ajax.status==200){
                   document.getElementById(capa).innerHTML=ajax.responseText;
                   }
                   else if(ajax.status==404)
                                             {

                            capaContenedora.innerHTML = "La direccion no existe";
                                             }
                                             else
                                             {
                            capaContenedora.innerHTML = "Error: " + ajax.status;
                                             }
                                    }
                  }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         ajax.send(null);
         return
}
} 