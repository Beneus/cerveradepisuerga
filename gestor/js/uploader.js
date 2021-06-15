function init()
{
   fileUploadEvents();
}


function fileUploadEvents()
{
  var links = document.getElementsByTagName("a");
  if (links)
  { 
    for (var x=0; x<links.length; ++x)
    {
     if (links[x].className == "uploadfile")
      links[x].onclick = uploadFile;
   
    }

  }
}

function uploadFile(tipo)
{
  var uploadForm = document.getElementById("uploadform");
  uploadForm.TITULOS.value = "";
  if (uploadForm.TITULO.length > 1){
	  for(i=0;i < uploadForm.TITULO.length;i++){
	  	if (uploadForm.TITULOS.value == ""){
		  	uploadForm.TITULOS.value = uploadForm.TITULO[i].value;
		  }else{
		  	uploadForm.TITULOS.value = uploadForm.TITULOS.value + ';' + uploadForm.TITULO[i].value;
		  }
	  }
	}else{
		uploadForm.TITULOS.value = uploadForm.TITULO.value;
	}

  uploadForm.PIES.value = "";
  
  if (uploadForm.PIE.length > 1){
	  for(i=0;i < uploadForm.PIE.length;i++){
	  	if (uploadForm.PIES.value == ""){
		  	uploadForm.PIES.value = uploadForm.PIE[i].value;
		  }else{
		  	uploadForm.PIES.value = uploadForm.PIES.value + ';' + uploadForm.PIE[i].value;
		  }
		}
	 }else{
	  	uploadForm.PIES.value = uploadForm.PIE.value;
	 }
  if (uploadForm)
  {
	   uploadForm.target="fileframe";
	   if (tipo =="Img"){ 
	   uploadForm.action="upimage.php";
	  	}else{
			if(tipo =="Doc"){ 
	  			uploadForm.action="updoc.php";
			}else{
				uploadForm.action="upBan.php";
			}
	  	}
  }
  uploadForm.submit();
}

function uploadBanner(tipo)
{
  var uploadForm = document.getElementById("uploadform");
  uploadForm.TEXTOBANNERS.value = "";
  if (uploadForm.TEXTOBANNER.length > 1){
	  for(i=0;i < uploadForm.TEXTOBANNER.length;i++){
	  	if (uploadForm.TEXTOBANNERS.value == ""){
		  	uploadForm.TEXTOBANNERS.value = uploadForm.TEXTOBANNER[i].value;
		  }else{
		  	uploadForm.TEXTOBANNERS.value = uploadForm.TEXTOBANNERS.value + ';' + uploadForm.TEXTOBANNER[i].value;
		  }
	  }
	}else{
		uploadForm.TEXTOBANNERS.value = uploadForm.TEXTOBANNER.value;
	}

  uploadForm.URLBANNERS.value = "";
  
  if (uploadForm.URLBANNER.length > 1){
	  for(i=0;i < uploadForm.URLBANNER.length;i++){
	  	if (uploadForm.URLBANNERS.value == ""){
		  	uploadForm.URLBANNERS.value = uploadForm.URLBANNER[i].value;
		  }else{
		  	uploadForm.URLBANNERS.value = uploadForm.URLBANNERS.value + ';' + uploadForm.URLBANNER[i].value;
		  }
		}
	 }else{
	  	uploadForm.URLBANNERS.value = uploadForm.URLBANNER.value;
	 }
  if (uploadForm)
  {
	  uploadForm.target="fileframe";
	  uploadForm.action="upBan.php";

  }
  uploadForm.submit();
}

//var upload_number = 2;
function addFileInput2(nombre) {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
	var titulo = document.createElement("input");
	var pie = document.createElement("input");
	var saltolinea = document.createElement("br");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", nombre);
	titulo.setAttribute("type", "text");
 	titulo.setAttribute("name", "TITULO");
 	titulo.setAttribute("size", "50");
	pie.setAttribute("type", "text");
 	pie.setAttribute("name", "PIE");
 	pie.setAttribute("size", "50");
 	d.appendChild(file);
	d.appendChild(titulo);
	d.appendChild(pie);
 	document.getElementById("moreUploads").appendChild(d);
 	//upload_number++;
}




function addFileInput() 
{
	var div = CreateElement('div');
	SetAttribute(div,'class','row clearfix');
	div.appendChild(Getcolhalf());
	div.appendChild(Getcolhalf2());
	document.getElementById("moreUploads").appendChild(div);
	var div = CreateElement('div');
	SetAttribute(div,'class','row clearfix');
	div.appendChild(Getcolhalf3());
	div.appendChild(Getcolhalf4());
	document.getElementById("moreUploads").appendChild(div);
}


function CreateElement(element){
	return document.createElement(element);
}

function SetAttribute(element, attribute, value){
	return element.setAttribute(attribute, value);
}


function Getcolhalf(){

	var div = CreateElement('div');
	SetAttribute(div,'class','col_half');
	var label = CreateElement('label');
	label.innerHTML = '';
	var span = CreateElement('span');
	var i = CreateElement('i');
	SetAttribute(i,'aria-hidden','true');
	SetAttribute(i,'class','fa fa-file-o');
	var div2 = CreateElement('div');
	SetAttribute(div2,'class','input_field');
	var input = CreateElement('input');
	SetAttribute(input,'type','file');
	SetAttribute(input,'name','foto[]');

	span.appendChild(i);
	div2.appendChild(span);
	div2.appendChild(input);
	div.appendChild(label);
	div.appendChild(div2);

	return div;
	
	
}

function Getcolhalf2(){

	var div = CreateElement('div');
	SetAttribute(div,'class','col_half');
	var label = CreateElement('label');
	label.innerHTML = 'Titulo';
	var span = CreateElement('span');
	var i = CreateElement('i');
	SetAttribute(i,'aria-hidden','true');
	SetAttribute(i,'class','fa fa-file-text');
	var div2 = CreateElement('div');
	SetAttribute(div2,'class','input_field');
	var input = CreateElement('input');
	SetAttribute(input,'type','text');
	SetAttribute(input,'name','TITULO');

	span.appendChild(i);
	div2.appendChild(span);
	div2.appendChild(input);
	div.appendChild(label);
	div.appendChild(div2);

	return div;
}

function Getcolhalf3(){

	var div = CreateElement('div');
	SetAttribute(div,'class','col_half');
	var label = CreateElement('label');
	label.innerHTML = '';
	div.appendChild(label);
	return div;

}

function Getcolhalf4(){

	var div = CreateElement('div');
	SetAttribute(div,'class','col_half');
	var label = CreateElement('label');
	label.innerHTML = 'Pie';
	var span = CreateElement('span');
	var i = CreateElement('i');
	SetAttribute(i,'aria-hidden','true');
	SetAttribute(i,'class','fa fa-file-text ');
	var div2 = CreateElement('div');
	SetAttribute(div2,'class','input_field');
	var input = CreateElement('input');
	SetAttribute(input,'type','text');
	SetAttribute(input,'name','PIE');

	span.appendChild(i);
	div2.appendChild(span);
	div2.appendChild(input);
	div.appendChild(label);
	div.appendChild(div2);

	return div;
}


//var upload_number = 2;
function addBannerInput(nombre) {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
	var titulo = document.createElement("input");
	var pie = document.createElement("input");
	var saltolinea = document.createElement("br");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", nombre);
	titulo.setAttribute("type", "text");
 	titulo.setAttribute("name", "TEXTOBANNER");
 	titulo.setAttribute("size", "50");
	pie.setAttribute("type", "text");
 	pie.setAttribute("name", "URLBANNER");
 	pie.setAttribute("size", "50");
 	d.appendChild(file);
	d.appendChild(titulo);
	d.appendChild(pie);
 	document.getElementById("moreUploads").appendChild(d);
 	//upload_number++;
}


function startUpload(){
      document.getElementById('barracargando').style.visibility = 'visible';
      document.getElementById('FormImage').style.visibility = 'hidden';
      return true;
}

var TextoModificado = false;

function Editar(idspan,idImg){
	var objSpan = eval("document.getElementById('"+idspan+idImg+"')");
	var objForm = eval("document.formImagen"+ idImg+"."+idspan);
	objSpan.style.display='none';
	objForm.style.display = "";
	objForm.value = objSpan.innerHTML;
	objForm.disabled = false;
	objForm.focus();
}
function GuardarDatos(idspan,idImg){
	var objSpan = eval("document.getElementById('"+idspan+idImg+"')");
	var objForm = eval("document.formImagen"+ idImg+"."+idspan);
	if (TextoModificado){
		// enviar datos al servidior;
		document.getElementById("espere").style.display = "block";
		cad = "IDIMAGEN=" + idImg + "&CAMPO=" + idspan + "&"+ idspan.toUpperCase() + "=" + objForm.value;
		FAjax('editarimagen.php','espere',cad,'post');
			
		objSpan.innerHTML = objForm.value;
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
		TextoModificado = false;
	}else{
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
	}
}

function GuardarDatosDoc(idspan,idDoc){
	var objSpan = eval("document.getElementById('"+idspan+idDoc+"')");
	var objForm = eval("document.formImagen"+ idDoc+"."+idspan);
	if (TextoModificado){
		// enviar datos al servidior;
		document.getElementById("espere").style.display = "block";
		cad = "IDDOC=" + idDoc + "&CAMPO=" + idspan + "&"+ idspan.toUpperCase() + "=" + objForm.value;
		FAjax('editardocumento.php','espere',cad,'post');
			
		objSpan.innerHTML = objForm.value;
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
		TextoModificado = false;
	}else{
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
	}
}

function EditarBanner(idspan,idBan){
	var objSpan = eval("document.getElementById('"+idspan+idBan+"')");
	var objForm = eval("document.formBanner"+ idBan+"."+idspan);
	objSpan.style.display='none';
	objForm.style.display = "";
	objForm.value = objSpan.innerHTML;
	objForm.disabled = false;
	objForm.focus();
}
function GuardarDatosBanner(idspan,idBan){
	var objSpan = eval("document.getElementById('"+idspan+idBan+"')");
	var objForm = eval("document.formBanner"+ idBan+"."+idspan);
	if (TextoModificado){
		// enviar datos al servidior;
		document.getElementById("espere").style.display = "block";
		cad = "IDBANNER=" + idBan + "&CAMPO=" + idspan + "&"+ idspan.toUpperCase() + "=" + objForm.value.replace(/&/gi,"_38_");
		FAjax('editarbanner.php','espere',cad,'post');
			
		objSpan.innerHTML = objForm.value;
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
		TextoModificado = false;
	}else{
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
	}
}

function GuardarDatosBannerGestion(idspan,idBan){
	var objSpan = eval("document.getElementById('"+idspan+idBan+"')");
	var objForm = eval("document.formBanner"+ idBan+"."+idspan);
	if (TextoModificado){
		// enviar datos al servidior;
		document.getElementById("espere").style.display = "block";
		cad = "IDBANNER=" + idBan + "&CAMPO=" + idspan + "&"+ idspan.toUpperCase() + "=" + objForm.value.replace(/&/gi,"_38_");
		FAjax('editarbannergestion.php','espere',cad,'post');
			
		objSpan.innerHTML = objForm.value;
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
		TextoModificado = false;
	}else{
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
	}
}


function EliminarBanner(idBan){
	var cad = "eliminarbanner.php?idBanner=" + idBan;
	window.open(cad,'','width=100px,height=100px');
	
}
function EliminarBannersGestion(idBan){
	var cad = "eliminarbannersgestion.php?idBannersGestion=" + idBan;
	window.open(cad,'','width=100px,height=100px');
	
}
function EliminarImagen(idImg){
	var cad = "eliminarimagen.php?idImagen=" + idImg;
	window.open(cad,'','width=100px,height=100px');
	
}
function EliminarDoc(idDoc){
	var cad = "eliminardoc.php?idDoc=" + idDoc;
	window.open(cad,'','width=100px,height=100px');
	
}
function Publicar(idImg,x){
	document.getElementById("espere").style.display = "block";
	var cad = "" ;
	if(x.checked){
		cad = "PUBLICAR=1&IDIMAGEN=" + idImg ;
		FAjax('publicarimagen.php','espere',cad,'post');
	}else{
		cad = "PUBLICAR=0&IDIMAGEN=" + idImg ;
		FAjax('publicarimagen.php','espere',cad,'post');
	}
}

function PublicarDoc(idDoc,x){
	document.getElementById("espere").style.display = "block";
	var cad = "" ;
	if(x.checked){
		cad = "PUBLICAR=1&IDDOC=" + idDoc ;
		FAjax('publicardoc.php','espere',cad,'post');
	}else{
		cad = "PUBLICAR=0&IDDOC=" + idDoc ;
		FAjax('publicardoc.php','espere',cad,'post');
	}
}

function PublicarBanner(idBan,x){
	document.getElementById("espere").style.display = "block";
	var cad = "" ;
	if(x.checked){
		cad = "PUBLICAR=1&IDBAN=" + idBan ;
		FAjax('publicarbanner.php','espere',cad,'post');
	}else{
		cad = "PUBLICAR=0&IDBAN=" + idBan ;
		FAjax('publicarbanner.php','espere',cad,'post');
	}
}

function AsociarImagen(asociacion,idImg,tabla,x,campo,campovalor){
	//document.getElementById("espere").style.display = "block";
	var cad = "" ;
	if(x.checked){
		cad = "ASOCIACION="+ asociacion + "&IDIMAGEN=" + idImg + "&TABLA=" + tabla + "&CAMPO=" + campo + "&CAMPOVALOR=" + campovalor;
		FAjax('asociarimagen.php','espere',cad,'post');
		eval("document.formImagen" + idImg + ".PUBLICAR.checked = true");
	}else{
		cad = "ASOCIACION="+ asociacion + "&IDIMAGEN=" + idImg + "&TABLA=" + tabla + "&CAMPO=" + campo + "&CAMPOVALOR=" + campovalor;
		FAjax('desasociarimagen.php','espere',cad,'post');
		eval("document.formImagen" + idImg + ".PUBLICAR.checked = true");
	}
}
function IntercambiarImagen(x){
	var objImg = document.getElementsByName("POSICION");
	var numSel = 0;
	var SelA = "";
	var SelB = "";
	var objImgA;
	if (x.checked){
		for(i = 0;i < objImg.length; i++){
			if(objImg[i].checked){
				numSel ++;
				objImgA = eval('document.getElementById("Img' + objImg[i].value +'")');
				objImgA.style.backgroundColor = "#fda";
				if(SelA == ""){SelA = objImg[i].value;}
				else{
					if(SelB == ""){SelB = objImg[i].value;}
				}
			}
			if(numSel == 2){
				// LLamar a la funcion Ajax;
				FAjax('IntercambiarImagen.php','espere','SELA=' +SelA +'&SELB='+ SelB,'post');
				Intercambiar("Img",SelA,SelB);
			}
		}	
	}else{
		x.checked = false;
		objImgA = eval('document.getElementById("Img' + x.value +'")');
		objImgA.style.backgroundColor = "#fff";
		
	}
}

function IntercambiarDoc(x){
	var objImg = document.getElementsByName("POSICION");
	var numSel = 0;
	var SelA = "";
	var SelB = "";
	var objImgA;
	if (x.checked){
		for(i = 0;i < objImg.length; i++){
			if(objImg[i].checked){
				numSel ++;
				objImgA = eval('document.getElementById("Doc' + objImg[i].value +'")');
				objImgA.style.backgroundColor = "#fda";
				if(SelA == ""){SelA = objImg[i].value;}
				else{
					if(SelB == ""){SelB = objImg[i].value;}
				}
			}
			if(numSel == 2){
				// LLamar a la funcion Ajax;
				FAjax('IntercambiarDoc.php','espere','SELA=' +SelA +'&SELB='+ SelB,'post');
				Intercambiar("Doc",SelA,SelB);
			}
		}	
	}else{
		x.checked = false;
		objImgA = eval('document.getElementById("Doc' + x.value +'")');
		objImgA.style.backgroundColor = "#fff";
		
	}
}

function IntercambiarBanner(x){
	var objImg = document.getElementsByName("POSICION");
	var numSel = 0;
	var SelA = "";
	var SelB = "";
	var objImgA;
	if (x.checked){
		for(i = 0;i < objImg.length; i++){
			if(objImg[i].checked){
				numSel ++;
				objImgA = eval('document.getElementById("Ban' + objImg[i].value +'")');
				objImgA.style.backgroundColor = "#fda";
				if(SelA == ""){SelA = objImg[i].value;}
				else{
					if(SelB == ""){SelB = objImg[i].value;}
				}
			}
			if(numSel == 2){
				// LLamar a la funcion Ajax;
				FAjax('IntercambiarBanner.php','espere','SELA=' +SelA +'&SELB='+ SelB,'post');
				Intercambiar("Ban",SelA,SelB);
			}
		}	
	}else{
		x.checked = false;
		objImgA = eval('document.getElementById("Ban' + x.value +'")');
		objImgA.style.backgroundColor = "#fff";
		
	}
}

function IntercambiarBannersGestion(x){
	var objImg = document.getElementsByName("POSICION");
	var numSel = 0;
	var SelA = "";
	var SelB = "";
	var objImgA;
	if (x.checked){
		for(i = 0;i < objImg.length; i++){
			if(objImg[i].checked){
				numSel ++;
				objImgA = eval('document.getElementById("Ban' + objImg[i].value +'")');
				objImgA.style.backgroundColor = "#fda";
				if(SelA == ""){SelA = objImg[i].value;}
				else{
					if(SelB == ""){SelB = objImg[i].value;}
				}
			}
			if(numSel == 2){
				// LLamar a la funcion Ajax;
				FAjax('IntercambiarBannersGestion.php','espere','SELA=' +SelA +'&SELB='+ SelB,'post');
				Intercambiar("Ban",SelA,SelB);
			}
		}	
	}else{
		x.checked = false;
		objImgA = eval('document.getElementById("Ban' + x.value +'")');
		objImgA.style.backgroundColor = "#fff";
		
	}
}

function Intercambiar(tipo,x,y){

	var objImgA = eval('document.getElementById("'+tipo + x +'")');
	var objImgB = eval('document.getElementById("'+tipo + y +'")');
	var objAux = "";
	
	objAux = objImgA.innerHTML;
	objImgA.innerHTML = objImgB.innerHTML;
	objImgB.innerHTML = objAux;
	
	objAux = "";
	objAux = objImgB.id;
	objImgB.id = objImgA.id;
	objImgA.style.backgroundColor = "#fff";
	objImgB.style.backgroundColor = "#fff";
	objImgA.id = objAux;
	
	LimpiarIntercambio();
	
}
function LimpiarIntercambio(){
	var objImg = document.getElementsByName("POSICION");
	for(i = 0;i < objImg.length; i++){
		objImg[i].checked = false;
	}	
}