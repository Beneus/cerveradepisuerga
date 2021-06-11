	$(document).ready(function(){
	
			/* insertar enlace de imprimir cuando haya js */
			$('.imprimir').html( '<a href="#" title="Imprimir p�gina, alt + X" accesskey="X">Imprimir&nbsp;&nbsp;<img src="images/imprimir.gif" alt="Imrimir" hspace="3" /></a>')
			$('.imprimir a').click(function(){ window.print(); return false })
			// Tama�o del texto
			$("#FuenteMas").click(function(){AumentarFuente();})
			$("#FuenteMas").mouseover(function(){
				this.style.cursor='pointer';
				if(this.src.indexOf("ac-") > -1){
						this.src='images/ac-fuentemas-on.png';
					}else{
						this.src='images/fuentemas-on.png';
					} 				
				})
			$("#FuenteMas").mouseout(function(){
				if(this.src.indexOf("ac-")> -1){
						this.src='images/ac-fuentemas.png';
					}else{
						this.src='images/fuentemas.png';
					}
				})
			$("#FuenteMenos").click(function(){DisminuirFuente();})
			$("#FuenteMenos").mouseover(function(){
				this.style.cursor='pointer';
				if(this.src.indexOf("ac-") > -1){
						this.src='images/ac-fuentemenos-on.png';
					}else{
						this.src='images/fuentemenos-on.png';
					} 
				})
			$("#FuenteMenos").mouseout(function(){
				if(this.src.indexOf("ac-") > -1){
						this.src='images/ac-fuentemenos.png';
					}else{
						this.src='images/fuentemenos.png';
					}
				})
			// formulario del planificador de rutas
			$("#Submit2").click(function(){setDirections(document.form.to.value, document.form.fromAddress.value, document.form.locale.value); return false;})
			
			//hojas de estilo CSS
			$('#CSS').click(function()
				{
					var estilo = $('#CSS').attr('rel');
					switchStylestyle(estilo);
					
					if(estilo == "contraste"){
						// cambiar las imagenes
						 $("img[name=etiqueta]").each(function(i)
						 	{
						 		if(this.src.indexOf("ac-")>-1){
						 			this.src = replace(this.src,"/ac-","/");
						 		}else{
						 			this.src = replace(this.src,"images/","images/ac-");
						 		}
							}
						);
						$('#CSS').attr('rel','normal');
						//this.rel = "normal";
					}else{
						// cambiar las imagenes
						 $("img[name=etiqueta]").each(function(i)
						 	{
						 		if(this.src.indexOf("ac-")>-1){
						 			this.src = replace(this.src,"/ac-","/");
						 		}else{
						 			this.src = replace(this.src,"images/","images/ac-");
						 		}
							}
						);
						//this.rel = "contraste";
						$('#CSS').attr('rel','contraste');
					}
					return false;
				});
				var c = readCookie('style');
				if (c) switchStylestyle(c);
			
			var T = readCookie('TamanoFuente');
			if(T) document.body.style.fontSize = T;

			// control de teclas
			$(document).keypress(function(e)
				{
					
					switch(e.which)
					{
						// tecla "+"
						case 43:	AumentarFuente();
									break;	
						// tecla "-"
						case 45:	DisminuirFuente();
									break;	
						default:
									var T = readCookie('TamanoFuente');
									document.body.style.fontSize = T;
									break;
					}
				});
	
// funcionalidad de la agenda
			//$(".cerrar_todo").hide();
			//$(".EventosLista .EventoContenido").hide();
			//hide message_body after the first one
			//$(".DiaMes .EventosLista").show();  
			$(".DiaNombre")
				.mouseover(function(){
				//$(this).css('background-image','url(images/agenda-dia-over.gif)');
			})
				.mouseout(function(){
				//$(this).css('background-image','url(images/agenda-dia-out.gif)');
			});
			$(".CeldaCalendario")
				.mouseover(function(){
				//$(this).css('background-image','url(images/agenda-anual-fondo-celda.gif)');
			})
				.mouseout(function(){
				//$(this).css('background-image','');
			});
			//toggle message_body
			$(".Evento")
				.mouseover(function(){
				//$(this).css('background-image','url(images/agenda-evento-over.gif)');
			})
				.mouseout(function(){
				///$(this).css('background-image','url(images/agenda-evento-out.gif)');
			});
			//toggle message_list
			$(".DiaNombre").click(function(){
				//$(this).next(".EventosLista").slideToggle(500)
				//$(this).next(".EventosLista").show()
				return false;
			});
			//toggle message_body
			$(".Evento").click(function(){
				//$(this).next(".EventoContenido").slideToggle(500)
				return false;
			});
			//cerrar todo
			$(".cerrar_todo").click(function(){
				//$(this).hide()
				//$(".mostrar_todo").show()
				//$(".EventoContenido").slideUp()
				return false;
			});
			//abrir todo
			$(".mostrar_todo").click(function(){
				//$(this).hide()
				//$(".cerrar_todo").show()
				//$(".EventoContenido").slideDown()
				return false;
			});

// Jquery
		}
	);
	
	
function AumentarFuente(){
	if (document.body.style.fontSize==""){
		document.body.style.fontSize = "110%";
	}else{
		if (document.body.style.fontSize != "180%"){
			document.body.style.fontSize = (parseInt(document.body.style.fontSize) + 10)+"%";
		}
	}
	createCookie('TamanoFuente', document.body.style.fontSize , 365);
}
function DisminuirFuente(){
	if (document.body.style.fontSize==""){
		document.body.style.fontSize = "90%";
	}else{
		if (document.body.style.fontSize != "50%"){
			document.body.style.fontSize = (parseInt(document.body.style.fontSize) - 10)+"%";
		}
	}
	createCookie('TamanoFuente', document.body.style.fontSize , 365);
}

function switchStylestyle(styleName)
	{
		$('link[rel*=style][title]').each(function(i) 
		{
			this.disabled = true;
			if (this.getAttribute('title') == styleName) this.disabled = false;
		});
		
		createCookie('style', styleName, 365);
	}

function createCookie(name,value,days)
{
	if (days)
	{
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name)
{
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++)
	{
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function eraseCookie(name)
{
	createCookie(name,"",-1);
}

function printWebPart(tagid){
    if (tagid) {
        //build html for print page
        var html = "<html>\n<head>\n"+
           replace($("head").html(),'hide','show')+
            "\n</head>\n<body>\n"+
            $("#"+tagid).html()+
            "\n</body>\n</html>";
        //open new window
        var printWP = window.open("","printWebPart");
        printWP.document.open();
        //insert content
        printWP.document.write(html);
        printWP.document.close();
        //open print dialog
        printWP.print();
    }
}

function replace(texto,s1,s2){
	return texto.split(s1).join(s2);
}
