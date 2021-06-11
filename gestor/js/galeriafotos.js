//var upload_number = 2;
function addFileInputOld() {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
	var titulo = document.createElement("input");
	var pie = document.createElement("input");
	var saltolinea = document.createElement("br");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", "foto[]");
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
	Getcolhalf();
	//upload_number++;
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
	label.innerHTML = 'Evento';
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

	document.getElementById("moreUploads").appendChild(div);
	
}

function startUpload(){
      document.getElementById('barracargando').style.visibility = 'visible';
      document.getElementById('FormImage').style.visibility = 'hidden';
      return true;
}

function stopUpload(){
      document.getElementById('barracargando').style.visibility = 'hidden';
      document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="galeria-fotografica.php?Ambito=<?php echo $Ambito;?>&idAmbito=<?php echo $idAmbito;?>&Campo=<?php echo $Campo;?>&NCampo=<?php echo $NCampo;?>&Referer=<?php echo $Referer;?>";
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

function EliminarImagen(idImg){
	var cad = "eliminarimagen.php?idImagen=" + idImg;
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

function AsociarImagen(asociacion,idImg,tabla,x,campo,campovalor){
	// document.getElementById("espere").style.display = "block";
	alert("checked");
	var cad = "" ;
	if(x.checked){
		
		cad = "ASOCIACION="+ asociacion + "&IDIMAGEN=" + idImg + "&TABLA=" + tabla + "&CAMPO=" + campo + "&CAMPOVALOR=" + campovalor;
		FAjax('asociarimagen.php','espere',cad,'post');
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
				alert('SelA=' +SelA +'&SelB='+ SelB);
				FAjax('IntercambiarImagen.php','espere','SelA=' +SelA +'&SelB='+ SelB,'post');
				Intercambiar(SelA,SelB);
			}
		}	
	}else{
		x.checked = false;
		objImgA = eval('document.getElementById("Img' + x.value +'")');
		objImgA.style.backgroundColor = "#fff";
		
	}
}

function Intercambiar(x,y){

	var objImgA = eval('document.getElementById("Img' + x +'")');
	var objImgB = eval('document.getElementById("Img' + y +'")');
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