(function($){
$.fn.calendario= function(options) {
var element = $(this);
var hoy = new Date();
var diaActual = hoy.getDate();
var mesActual = hoy.getMonth();
var anyoActual = hoy.getFullYear();

var defaults = {
anyo: anyoActual,
mes: mesActual,
dia: diaActual,
form:options.form
};
var options = $.extend(defaults, options);
var D = new Date(options.anyo,options.mes,options.dia);

var DiasdeMes = function (mes,anyo)
	{
	var ultimodia;
	switch (mes)
		{
		case 0:case 2:case 4:case 6:case 7:case 9:case 11: ultimodia = 31;break;
		case 3:case 5:case 8:case 10: ultimodia = 30;break;
		case 1: if (bisiesto(anyo) ){ultimodia = 29}else{ultimodia = 28;};break;
		default:alert("error");
		}
	return ultimodia;
	}
var NombreMes = function (fecha)
	{
	var salida
	switch (fecha)
		{
		case 0: salida = "Ene.";break;
		case 1: salida = "Feb.";break;
		case 2: salida = "Mar.";break;
		case 3: salida = "Abr.";break;
		case 4: salida = "May.";break;
		case 5: salida = "Jun.";break;
		case 6: salida = "Jul.";break;
		case 7: salida = "Ago.";break;
		case 8: salida = "Sep.";break;
		case 9: salida = "Oct.";break;
		case 10: salida = "Nov.";break;
		case 11: salida = "Dic.";break;
		default: break;
		}
	return salida;
	}
var Num_Dia_Comienzo = function (x){
	if (x == 0){return 6;}else{return (x-1);}
	}
var bisiesto = function(yr) 
	{
	    if (((yr % 4 == 0) && yr % 100 != 0) || yr % 400 == 0) return true;
	    else return false;
	}

var Poner_Mes = function (f){
	inicio(diaActual,parseInt(f.mes.value),parseInt(f.anyo.value),form);
	}
var DescontarMes = function(){
	if (mesActual == 0)
	{mesActual = 11;anyoActual--;}
	else
	{mesActual--;}
	inicio(diaActual,parseInt(mesActual),parseInt(anyoActual),form);
	}	
var AumentarMes = function(){
	if (mesActual == 11)
	{mesActual = 0;anyoActual++;}
	else
	{mesActual++;}
	inicio(diaActual,parseInt(mesActual),parseInt(anyoActual),form);
	}	
var CambiarMes = function(mes,form){
	inicio(parseInt(anyoActual),parseInt(mes),diaActual,form);
	}		
var DescontarAnyo = function(form){
	anyoActual--;
	inicio(parseInt(anyoActual),parseInt(mesActual),diaActual,form);
	}	
var AumentarAnyo = function(form)
	{
	anyoActual++;
	inicio(parseInt(anyoActual),parseInt(mesActual),diaActual,form);
	}	
var Sel = function(a,m,d,form){
	dia = d;
	mes = m;
	agno = a;
	if(dia < 10)dia = "0" + dia;
	if(mes < 10)mes = "0" + mes;
	$(form).val(dia + "/" + mes + "/" +agno);
	$(element).hide();	
	$(form).next("input").focus;
	}
var centerThis = function(div) {
	var winH = $(window).height();
	var winW = $(window).width();
	var centerDiv = $(div);
	centerDiv.css('top', winH/2-centerDiv.height()/2);
	centerDiv.css('left', winW/2-centerDiv.width()/2);
}


var htmlcal = function(){
element.html("<div id=\"ano\"><div id=\"ano1\"></div><div id=\"ano2\"></div><div id=\"ano3\"></div></div>"
+"<div id=\"dias\">"
+"<div id=\"nd1\" class=\"nomdia\">L</div>"
+"<div id=\"nd2\" class=\"nomdia\">M</div>"
+"<div id=\"nd3\" class=\"nomdia\">X</div>"
+"<div id=\"nd4\" class=\"nomdia\">J</div>"
+"<div id=\"nd5\" class=\"nomdia\">V</div>"
+"<div id=\"nd6\" class=\"nomdia\">S</div>"
+"<div id=\"nd0\" class=\"nomdia\">D</div>"
+"</div>"
+"<div id=\"sem1\">"
+"<div id=\"md0\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md1\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md2\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md3\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md4\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md5\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md6\" class=\"numdia\">&nbsp;</div>"
+"</div>"
+"<div id=\"sem2\">"
+"<div id=\"md7\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md8\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md9\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md10\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md11\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md12\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md13\" class=\"numdia\">&nbsp;</div>"
+"</div>"
+"<div id=\"sem3\">"
+"<div id=\"md14\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md15\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md16\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md17\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md18\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md19\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md20\" class=\"numdia\">&nbsp;</div>"
+"</div>"
+"<div id=\"sem4\">"
+"<div id=\"md21\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md22\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md23\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md24\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md25\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md26\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md27\" class=\"numdia\">&nbsp;</div>"
+"</div>"
+"<div id=\"sem5\">"
+"<div id=\"md28\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md29\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md30\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md31\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md32\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md33\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md34\" class=\"numdia\">&nbsp;</div>"
+"</div>"
+"<div id=\"sem6\">"
+"<div id=\"md35\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md36\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md37\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md38\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md39\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md40\" class=\"numdia\">&nbsp;</div>"
+"<div id=\"md41\" class=\"numdia\">&nbsp;</div>"
+"</div>"
+"<div id=\"mes1\">"
+"<div id=\"m0\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m1\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m2\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m3\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m4\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m5\" class=\"nommes\">&nbsp;</div>"
+"</div>"
+"<div id=\"mes2\">"
+"<div id=\"m6\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m7\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m8\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m9\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m10\" class=\"nommes\">&nbsp;</div>"
+"<div id=\"m11\" class=\"nommes\">&nbsp;</div>"
+"</div>");

}


var inicio = function(anyo,mes,dia,form) {

	var D = new Date(anyo, mes, 1);
	var PrimerDia = D.getDay();
	var UltimoDia = DiasdeMes(mes,anyo)
	var contador = 0;
	var contadorb = 0;
	mesActual = mes;

	for( i=0;i<42;i++)
		{
		var obj = eval("document.getElementById(\"md" + i + "\")");
		if ((Num_Dia_Comienzo(PrimerDia) > i) || (i > UltimoDia + Num_Dia_Comienzo(PrimerDia)-1)){
			obj.innerHTML = "&nbsp;"; 
			}else{
				
						obj.innerHTML = "<a href=\"#\" alt=\"mes\" dia=\""+(i - Num_Dia_Comienzo(PrimerDia) + 1)+"\" mes=\""+ (mes + 1) +"\" anyo=\"" + anyo + "\" >" +  (i - Num_Dia_Comienzo(PrimerDia) + 1) + "</a>";

			}
// es el dia del mes elegido y lo ponemos en con el fondo diferenciado
						if((i - Num_Dia_Comienzo(PrimerDia) + 1) == dia)
				{obj.style.fontWeight="bold";obj.style.color="#ffffff";obj.style.backgroundColor="#dddddd";}
				else{obj.style.fontWeight="";obj.style.color="#000000";obj.style.backgroundColor="#ffffff";}

		}
// Meses  
	
	for(i=0;i<12;i++){
		var obj_mes = eval("$(\"#m" + i + "\")");
	if (((anyo == hoy.getFullYear()) && (i >= hoy.getMonth())) || (anyo > hoy.getFullYear())){
		obj_mes.html("<a href=\"#\" mes=\""+i+"\">" + NombreMes(i)+ "</a>");
	}
	else{
		obj_mes.html(NombreMes(i));
	}
	if (i == mes){obj_mes.attr("style","fontWeight='bold'");}
	else{obj_mes.attr("style","fontWeight=''");}
	}

// Años

	if (anyo == hoy.getFullYear()){
		$("#ano1").html("&nbsp;");
	}else{
		$("#ano1").html("<a href=\"#\" id=\"anosmenos\" class=\"anos\" >" + (anyo - 1) + "</a>");
	}
	$("#ano2").html(NombreMes(mes) + " " + anyo);
	$("#ano3").html("<a href=\"#\" id=\"anosmas\" class=\"anos\" >" + (anyo + 1) + "</a>");
	$("#anosmenos").click(function(evento){
			DescontarAnyo();
			evento.preventDefault();
			evento.stopPropagation();
		});
	$("#anosmas").click(function(){
			AumentarAnyo();
		});
	$(".nommes a").click(function(){
			CambiarMes($(this).attr("mes"),options.form);
	});
	$(".numdia a").click(function(evento){
			Sel($(this).attr("anyo"),$(this).attr("mes"),$(this).attr("dia"),options.form);
			evento.preventDefault();
			evento.stopPropagation();
	});
	}
	
	
	return this.each(function() {
		$(element).hide();
		$(element).css({
			"position":"absolute",
			"width":"280px",
			"height":"180px",
			"z-index": "1",
			"background-color": "#FFF"
		});
		centerThis(element); 
  		$(window).resize(function() { centerThis(element);  });

		$("input").each(function(){
		  	 $(this).bind (
			 "focus",
			 function(e){
				 if("#" + $(this).attr("id") == options.form){
					htmlcal();
					inicio(options.anyo,options.mes,options.dia,options.form);
					$(element).show("slow");
					e.preventDefault();
					e.stopPropagation();
				 }else{
					 $(element).hide();	
				 }
			 })
		}); 

		$(options.form).click(function(){
			htmlcal();
			inicio(options.anyo,options.mes,options.dia,options.form);
			$(element).show("slow");			
		});
	
	});
};
})(jQuery);