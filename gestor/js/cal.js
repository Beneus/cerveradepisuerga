var hoy = new Date();
var diaActual = hoy.getDate();
var mesActual = hoy.getMonth();
var anyoActual = hoy.getFullYear();
function NombreDia(fecha)
	{
	var salida
	switch (fecha.getDay())
		{
		case 0: salida = "Domingo";break;
		case 1: salida = "Lunes";break;
		case 2: salida = "Martes";break;
		case 3: salida = "Miercoles";break;
		case 4: salida = "Jueves";break;
		case 5: salida = "Viernes";break;
		case 6: salida = "sabado";break;
		default: break;
		}
	return salida;
	}
function CabDia(fecha)
	{
	var salida
	switch (fecha)
		{
		case 0: salida = "D";break;
		case 1: salida = "L";break;
		case 2: salida = "M";break;
		case 3: salida = "M";break;
		case 4: salida = "J";break;
		case 5: salida = "V";break;
		case 6: salida = "S";break;
		default: break;
		}
	return salida;
	}
function DiasdeMes(mes,anyo)
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
function NombreMes(fecha)
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

function Num_Dia_Comienzo(x){
if (x == 0){return 6;}else{return (x-1);}
}
function inicio(dia,mes,anyo,form)
	{
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
				/*
				if ( ((i%7) == 6)||((i%7) == 5)){
					obj.innerHTML =  (i - Num_Dia_Comienzo(PrimerDia) + 1) 
				}else{			
					/*
					tres condiciones:
					Si ((año menor que el actual)
					OR (año igual al actual y mes menor)
					OR (año igual al actual y mes igual al mes actual y dia menor que el actual))
					*/	
		/*
					if ((anyo > hoy.getFullYear()) || ((anyo == hoy.getFullYear()) && (mes < hoy.getMonth())) || ((anyo == hoy.getFullYear()) && (mes == hoy.getMonth()) && ((i - Num_Dia_Comienzo(PrimerDia) + 1) <= hoy.getDate())) ){*/
						obj.innerHTML = "<a href=\"#\" alt=\"mes\" onClick=\"sel(" + (i - Num_Dia_Comienzo(PrimerDia) + 1) + "," + (mes + 1) + "," + anyo + ",'" + form +"');\">" +  (i - Num_Dia_Comienzo(PrimerDia) + 1) + "</a>";
					/*
					}else{
						obj.innerHTML = (i - Num_Dia_Comienzo(PrimerDia) + 1);
					}
				}*/
			}
// es el dia del mes elegido y lo ponemos en con el fondo diferenciado
						if((i - Num_Dia_Comienzo(PrimerDia) + 1) == dia)
				{obj.style.fontWeight="bold";obj.style.color="#ffffff";obj.style.backgroundColor="#dddddd";}
				else{obj.style.fontWeight="";obj.style.color="#000000";obj.style.backgroundColor="#ffffff";}

		}
// Meses
	for(i=0;i<12;i++){
		var obj_mes = eval("document.getElementById(\"m" + i + "\")");
	if (((anyo == hoy.getFullYear()) && (i >= hoy.getMonth())) || (anyo > hoy.getFullYear())){
		obj_mes.innerHTML = "<a href=\"#\" onClick=\"inicio(parseInt(diaActual),"+ i +",parseInt(anyoActual),'" + form + "');\">" + NombreMes(i)+ "</a>";
	}
	else{
		obj_mes.innerHTML = NombreMes(i);
	}
	if (i == mes){obj_mes.style.fontWeight="bold";}
	else{obj_mes.style.fontWeight="";}
	}
// Años
	
	if (anyo == hoy.getFullYear()){
		document.getElementById("ano1").innerHTML = "&nbsp;";
	}else{
		document.getElementById("ano1").innerHTML = "<a href=\"#\" class=\"anos\" onClick=\"DescontarAnyo('" + form + "');\">" + (anyo - 1) + "</a>";
	}
	document.getElementById("ano2").innerHTML = NombreMes(mes) + " " + anyo;
	document.getElementById("ano3").innerHTML = "<a href=\"#\" class=\"anos\" onClick=\"AumentarAnyo('" + form + "');\">" + (anyo + 1) + "</a>";
	
	
	}
function bisiesto(yr) 
{
    if (((yr % 4 == 0) && yr % 100 != 0) || yr % 400 == 0) return true;
    else return false;
}

function Poner_Mes(f)
	{
	inicio(diaActual,parseInt(f.mes.value),parseInt(f.anyo.value),form);
	}
function DescontarMes()
	{
	if (mesActual == 0)
	{mesActual = 11;anyoActual--;}
	else
	{mesActual--;}
	inicio(diaActual,parseInt(mesActual),parseInt(anyoActual),form);
	}	
function AumentarMes()
	{
	if (mesActual == 11)
	{mesActual = 0;anyoActual++;}
	else
	{mesActual++;}
	inicio(diaActual,parseInt(mesActual),parseInt(anyoActual),form);
	}	
function DescontarAnyo(form)
	{
	anyoActual--;
	inicio(diaActual,parseInt(mesActual),parseInt(anyoActual),form);
	}	
function AumentarAnyo(form)
	{
	anyoActual++;
	inicio(diaActual,parseInt(mesActual),parseInt(anyoActual),form);
	}	
function sel(d,m,a,form)
{
dia = d;
mes = m;
agno = a;
if(dia < 10)dia = "0" + dia;
if(mes < 10)mes = "0" + mes;
var objFecha = eval("document.formEntrada.FECHAINICIO");
objFecha.value = dia + "/" + mes + "/" +agno;
self.close();
}