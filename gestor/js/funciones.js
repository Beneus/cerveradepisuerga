//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Inicio
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaInicio(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosinicio.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosinicio.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Enlace
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaEnlace(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosenlace.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosenlace.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de Banner
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaBanner(x,tipo){
	var cad = ""; 
	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value.replace(/&/gi,"_38_");
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value.replace(/&/gi,"_38_");	
		}
	}
	
	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosbanner.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosebanner.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Localizacion
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaLocalizacion(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}
	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatoslocalizacion.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatoslocalizacion.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Como Llegar
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaComoLlegar(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatoscomo-llegar.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatoscomo-llegar.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Directorio
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaDirectorio(x,tipo){

	var cad = ""; 
	var subservicios = "";
	
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

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
				cad = x[i].name + "=" + x[i].value;
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
		FAjax('entradadatos.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatos.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Museos
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaMuseo(x,tipo){


	var cad = ""; 
	var subservicios = "";
	
	var content = tinyMCE.getContent(tinyMCE.getWindowArg('editor_id'));
	content = content.replace(/\+/g, "&#43");
	content = content.replace(/\\/g, "&#92");
	content = escape(content);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = content;
		x.DESCRIPCION.value = content;
	}else{

		x.DESCRIPCION.value = content;	
		x.DESCRIPCION.innerHTML = content;
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
		FAjax('entradadatosmuseo.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosmuseo.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Monumentos
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function EnviarEntradaMonumento(x,tipo){


	var cad = ""; 
	var subservicios = "";
	
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;
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
		FAjax('entradadatosmonumento.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosmonumento.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Rutas
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaRuta(x,tipo){

	var cad = ""; 
	var subservicios = "";

	//var content = tinyMCE.getContent(tinyMCE.getWindowArg('editor_id'));
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	var contentFlora = tinyMCE.getContent('FLORA');
	var contentFauna = tinyMCE.getContent('FAUNA');

	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);
	contentFlora = contentFlora.replace(/\+/g, "&#43");
	contentFlora = contentFlora.replace(/\\/g, "&#92");
	contentFlora = escape(contentFlora);
	contentFauna = contentFauna.replace(/\+/g, "&#43");
	contentFauna = contentFauna.replace(/\\/g, "&#92");
	contentFauna = escape(contentFauna);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
		x.FLORA.innerHTML = contentFlora
		x.FLORA.value = contentFlora;
		x.FAUNA.innerHTML = contentFauna;
		x.FAUNA.value = contentFauna;
	}else{
		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.FLORA.value = contentFlora;	
		x.FLORA.innerHTML = contentFlora;
		x.FAUNA.value = contentFauna;	
		x.FAUNA.innerHTML = contentFauna;
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
		FAjax('entradadatosruta.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosruta.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Deportes
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaDeportes(x,tipo){

	var cad = ""; 
	var subservicios = "";
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');

	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);
	

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
	
	}else{
		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

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
		FAjax('entradadatosdeportes.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosdeportes.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Escudos introducci�n
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaEscudosIntroduccion(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosescudosintroduccion.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosescudosintroduccion.php','espere',cad,'post',x,false);
	}
	
}


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Escudos
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaEscudo(x,tipo){

	var cad = ""; 
	var subservicios = "";
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');

	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);
	

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
	
	}else{
		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

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
		FAjax('entradadatosescudos.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosescudo.php','espere',cad,'post',x,false);
	}
	
}



//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Fauna
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaFauna(x,tipo){

	var cad = ""; 
	var subservicios = "";
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	var contentHabitat = tinyMCE.getContent('HABITAT');

	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);
	
	contentHabitat = contentHabitat.replace(/\+/g, "&#43");
	contentHabitat = contentHabitat.replace(/\\/g, "&#92");
	contentHabitat = escape(contentHabitat);
	


	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
		x.HABITAT.innerHTML = contentHabitat;
		x.HABITAT.value = contentHabitat;

	}else{
		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.HABITAT.value = contentHabitat;	
		x.HABITAT.innerHTML = contentHabitat;

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
		FAjax('entradadatosfauna.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosfauna.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Flora
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaFlora(x,tipo){

	var cad = ""; 
	var subservicios = "";
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	var contentHabitat = tinyMCE.getContent('HABITAT');
	var contentUsos = tinyMCE.getContent('USOS');
	
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);
	
	contentHabitat = contentHabitat.replace(/\+/g, "&#43");
	contentHabitat = contentHabitat.replace(/\\/g, "&#92");
	contentHabitat = escape(contentHabitat);
	
	contentUsos = contentUsos.replace(/\+/g, "&#43");
	contentUsos = contentUsos.replace(/\\/g, "&#92");
	contentUsos = escape(contentUsos);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
		x.HABITAT.innerHTML = contentHabitat;
		x.HABITAT.value = contentHabitat;
		x.USOS.innerHTML = contentUsos;
		x.USOS.value = contentUsos;
	}else{
		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.HABITAT.value = contentHabitat;	
		x.HABITAT.innerHTML = contentHabitat;
		x.USOS.value = contentUsos;	
		x.USOS.innerHTML = contentUsos;
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
		FAjax('entradadatosflora.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosflora.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Setas introducci�n
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaSetasIntroduccion(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentComentarios = tinyMCE.getContent('COMENTARIOS');
	contentComentarios = contentComentarios.replace(/\+/g, "&#43");
	contentComentarios = contentComentarios.replace(/\\/g, "&#92");
	contentComentarios = escape(contentComentarios);

	if(navigator.userAgent == "Explorer"){
		x.COMENTARIOS.innerHTML = contentComentarios;
		x.COMENTARIOS.value = contentComentarios;
	}else{

		x.COMENTARIOS.value = contentComentarios;	
		x.COMENTARIOS.innerHTML = contentComentarios;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatossetasintroduccion.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatossetasintroduccion.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Setas
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaSetas(x,tipo){
	
	var cad = ""; 
	var subservicios = "";
	var contentSombrero = tinyMCE.getContent('SOMBRERO');
	var contentPie = tinyMCE.getContent('PIE');
	var contentCuerpo = tinyMCE.getContent('CUERPO');
	var contentLaminas = tinyMCE.getContent('LAMINAS');
	var contentHimenio = tinyMCE.getContent('HIMENIO');
	var contentExporada = tinyMCE.getContent('EXPORADA');
	var contentCarne = tinyMCE.getContent('CARNE');
	var contentEpocaHabitat = tinyMCE.getContent('EPOCAHABITAT');
	var contentComestibilidad = tinyMCE.getContent('COMESTIBILIDAD');
	var contentComentarios = tinyMCE.getContent('COMENTARIOS');

	contentSombrero = contentSombrero.replace(/\+/g, "&#43");
	contentSombrero = contentSombrero.replace(/\\/g, "&#92");
	contentSombrero = escape(contentSombrero);
	
	contentPie = contentPie.replace(/\+/g, "&#43");
	contentPie = contentPie.replace(/\\/g, "&#92");
	contentPie = escape(contentPie);
	
	contentCuerpo = contentCuerpo.replace(/\+/g, "&#43");
	contentCuerpo = contentCuerpo.replace(/\\/g, "&#92");
	contentCuerpo = escape(contentCuerpo);
	
	contentLaminas = contentLaminas.replace(/\+/g, "&#43");
	contentLaminas = contentLaminas.replace(/\\/g, "&#92");
	contentLaminas = escape(contentLaminas);
	
	contentHimenio = contentHimenio.replace(/\+/g, "&#43");
	contentHimenio = contentHimenio.replace(/\\/g, "&#92");
	contentHimenio = escape(contentHimenio);
	
	contentExporada = contentExporada.replace(/\+/g, "&#43");
	contentExporada = contentExporada.replace(/\\/g, "&#92");
	contentExporada = escape(contentExporada);
	
	contentCarne = contentCarne.replace(/\+/g, "&#43");
	contentCarne = contentCarne.replace(/\\/g, "&#92");
	contentCarne = escape(contentCarne);
	
	contentEpocaHabitat = contentEpocaHabitat.replace(/\+/g, "&#43");
	contentEpocaHabitat = contentEpocaHabitat.replace(/\\/g, "&#92");
	contentEpocaHabitat = escape(contentEpocaHabitat);
	
	contentComestibilidad = contentComestibilidad.replace(/\+/g, "&#43");
	contentComestibilidad = contentComestibilidad.replace(/\\/g, "&#92");
	contentComestibilidad = escape(contentComestibilidad);
	
	contentComentarios = contentComentarios.replace(/\+/g, "&#43");
	contentComentarios = contentComentarios.replace(/\\/g, "&#92");
	contentComentarios = escape(contentComentarios);
	
	if(navigator.userAgent == "Explorer"){
		x.SOMBRERO.innerHTML = contentSombrero;
		x.SOMBRERO.value = contentSombrero;
		x.PIE.innerHTML = contentPie;
		x.PIE.value = contentPie;
		x.CUERPO.innerHTML = contentCuerpo;
		x.CUERPO.value = contentCuerpo;
		x.LAMINAS.innerHTML = contentLaminas;
		x.LAMINAS.value = contentLaminas;
		x.HIMENIO.value = contentHimenio;	
		x.HIMENIO.innerHTML = contentHimenio;
		x.EXPORADA.value = contentExporada;	
		x.EXPORADA.innerHTML = contentExporada;
		x.CARNE.value = contentCarne;	
		x.CARNE.innerHTML = contentCarne;
		x.EPOCAHABITAT.value = contentEpocaHabitat;	
		x.EPOCAHABITAT.innerHTML = contentEpocaHabitat;
		x.COMESTIBILIDAD.value = contentComestibilidad;	
		x.COMESTIBILIDAD.innerHTML = contentComestibilidad;
		x.COMENTARIOS.value = contentComentarios;	
		x.COMENTARIOS.innerHTML = contentComentarios;
	}else{
		x.SOMBRERO.value = contentSombrero;	
		x.SOMBRERO.innerHTML = contentSombrero;
		x.PIE.value = contentPie;	
		x.PIE.innerHTML = contentPie;
		x.CUERPO.value = contentCuerpo;
		x.CUERPO.innerHTML = contentCuerpo;
		x.LAMINAS.value = contentLaminas;	
		x.LAMINAS.innerHTML = contentLaminas;
		x.HIMENIO.value = contentHimenio;	
		x.HIMENIO.innerHTML = contentHimenio;
		x.EXPORADA.value = contentExporada;	
		x.EXPORADA.innerHTML = contentExporada;
		x.CARNE.value = contentCarne;	
		x.CARNE.innerHTML = contentCarne;
		x.EPOCAHABITAT.value = contentEpocaHabitat;	
		x.EPOCAHABITAT.innerHTML = contentEpocaHabitat;
		x.COMESTIBILIDAD.value = contentComestibilidad;	
		x.COMESTIBILIDAD.innerHTML = contentComestibilidad;
		x.COMENTARIOS.value = contentComentarios;	
		x.COMENTARIOS.innerHTML = contentComentarios;
		

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
		FAjax('entradadatossetas.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatossetas.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Caza
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaCaza(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatoscaza.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatoscaza.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Religion
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaReligion(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosreligion.php','espere',cad,'post',x,true);
	}else{
		FAjax('entradadatosreligion.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Pesca introducci�n
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaPescaIntroduccion(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatospescaintroduccion.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatospescaintroduccion.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Pesca 
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaPesca(x,tipo){

	var cad = ""; 
	var diashabiles = "";


	for (i=0; i < x.length; i++ ){
		
		if(x[i].type == "select-multiple"){
			if(x[i].selectedIndex < 0){
				document.getElementById("error").style.display = "";
				document.getElementById("errormsn").innerHTML = "Debes de seleccionar un d�a habil.";
				return false;
			}else{
				
				for(j=0; j < x[i].length;j++){
						if(x[i].options[j].selected){
							if(diashabiles == ""){
								diashabiles = x[i].options[j].value;
							}else{
								diashabiles = diashabiles + "-" + x[i].options[j].value;
							}
						}
					}
			}		
		}
		
		if (cad == ""){
			if(x[i].type == "select-multiple"){
				cad = x[i].name + "=" + diashabiles;
			}else{
				cad =  x[i].name + "=" + x[i].value;
			}
		}else{
			if(x[i].type == "select-multiple"){
				cad = cad + "&" + x[i].name + "=" + diashabiles;	
			}else{
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
			}
		}
	}
	
	
	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatospesca.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatospesca.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datios de Nucleo Urbano localidades
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaNucleoUrbano(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	var contentHistoria = tinyMCE.getContent('HISTORIA');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);
	contentHistoria = contentHistoria.replace(/\+/g, "&#43");
	contentHistoria = contentHistoria.replace(/\\/g, "&#92");
	contentHistoria = escape(contentHistoria);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
		x.HISTORIA.innerHTML = contentHistoria;
		x.HISTORIA.value = contentHistoria;

	}else{
		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.HISTORIA.value = contentHistoria;	
		x.HISTORIA.innerHTML = contentHistoria;

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
		FAjax('entradadatosnucleo.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosnucleo.php','espere',cad,'post',x,false);
	}
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Noticias
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaNoticias(x,tipo){

	var cad = ""; 
	var subservicios = "";

	var contentCuerpo = tinyMCE.getContent('CUERPO');
	contentCuerpo = contentCuerpo.replace(/\+/g, "&#43");
	contentCuerpo = contentCuerpo.replace(/\\/g, "&#92");
	contentCuerpo = escape(contentCuerpo);

	if(navigator.userAgent == "Explorer"){
		x.CUERPO.innerHTML = contentCuerpo;
		x.CUERPO.value = contentCuerpo;
	
	}else{
		x.CUERPO.value = contentCuerpo;	
		x.CUERPO.innerHTML = contentCuerpo;

	}

	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('entradadatosnoticia.php','espere',cad,'post',x,true);
	}else{
		FAjax('editardatosnoticia.php','espere',cad,'post',x,false);
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Agenda
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaAgenda(x,tipo){

	var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
	contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
	contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
	contentDescripcion = escape(contentDescripcion);

	if(navigator.userAgent == "Explorer"){
		x.DESCRIPCION.innerHTML = contentDescripcion;
		x.DESCRIPCION.value = contentDescripcion;
	}else{

		x.DESCRIPCION.value = contentDescripcion;	
		x.DESCRIPCION.innerHTML = contentDescripcion;
	}
	
	//disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	x.submit();
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Entrada de datos de Usuario
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function EnviarEntradaAdminUser(x,tipo){
	var cad = "";
	for (i=0; i < x.length; i++ ){
		if (cad == ""){
				cad =  x[i].name + "=" + x[i].value;
		}else{			
				cad = cad + "&" + x[i].name + "=" + x[i].value;	
		}
	}

	disDiv("contenido",true); 
	document.getElementById("espere").style.display = "block";
	if (tipo == "nuevo"){
		FAjax('admin-nuevo-user.php','espere',cad,'post',x,true);
	}else{
		FAjax('admin-editar-user.php','espere',cad,'post',x,false);
	}
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Funciones generales
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function IniciarForm(x){
	for (i=0;i < x.length ;i++){
		if((x[i].type == "text") || (x[i].type == "textarea") || (x[i].type == "password")){
			x[i].value = "";	
			if(x[i].type == "textarea"){
				tinyMCE.execInstanceCommand(x[i].name, 'mceSetContent', false, '');
			}
		}
	}
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

function FAjax (url,capa,valores,metodo,x,limpiar)
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
													if (limpiar)IniciarForm(x);
													
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