<!-- 
var expiracion=new Date(); //
		expiracion.setDate(expiracion.getDate()+1);//1 dias de expiracion 

function ajax(metodo,dir,conexion,destino){ 
	
	var b = document.getElementById(destino);
	this.Crear = function() {
		
		var xmlhttp = false; 
		var respuesta = "";
	  try { 
	   // Creación del objeto ajax para navegadores diferentes a Explorer 
	   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
	  } catch (e) { 
	   // o bien 
	   try { 
	     // Creación del objet ajax para Explorer 
	     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { 
	     xmlhttp = false; 
	   } 
	  } 
	  if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
	   xmlhttp = new XMLHttpRequest(); 
	  } 
		
		xmlhttp.onreadystatechange = function(){
				if (xmlhttp.readyState == 4) { 				
	        if (xmlhttp.status == 200) {        		
						  respuesta = xmlhttp.responseText;				  
						  if (destino != null){
						  	estado++;
						  	b.innerHTML = respuesta;
						  	b.style.display = "";
					  	}
					  	else{
					  		a.style.display = "none";
								a.innerHTML = "";
					  		return respuesta;
					  	}
					  	
	        } else { 
	            alert("Error recibiendo datos XML:\n" + 
	                xmlhttp.statusText); 
	        } 
	    } 	
		}
		
	  xmlhttp.open(metodo,dir,conexion);
	  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xmlhttp.setRequestHeader("Content-type","text/html;iso-8859-1");
		xmlhttp.send(null);
		
		
	}//Crear
	
	this.Comenzar = function (){

		b.innerHTML = "<img src=\"images/loading_data.gif\" />";
		window.setTimeout(this.Crear,20);
	}//Comenzar
} //Objeto ajax
// -->