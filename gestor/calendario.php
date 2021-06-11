<?php
setlocale(LC_ALL, 'es_ES.ISO8859-1');

$anoInicial = date("Y");
$funcionTratarFecha = 'document.location = "?dia="+dia+"&amp;mes="+mes+"&amp;ano="+ano;';
$fecha = getdate(time());

if(isset($_GET["dia"]))$dia = $_GET["dia"];
if(isset($_GET["mes"]))$mes = $_GET["mes"];
if(isset($_GET["ano"]))$ano = $_GET["ano"];
if ($ano==""){$ano = intval($fecha['year']); }
if ($mes==""){$mes = intval($fecha['mon']); }


function PintaMes($mes,$dia,$ano,$idNucleoUrbano,$idTipoEvento){
	$diasSem = Array ('l','m','x','j','v','s','d');
	$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
	$mesesMin = Array ('ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic');
	$posicion = Array (1,2,3,4,5,6,0);
	$fecha = mktime(0,0,0,$mes,$dia,$ano);
	$fechaInicioMes = date("w",$fecha); // día de la semana en que empieza el mes der 0 a 6
	$ultimoDia = date('t',$fecha); // numero máximo de días del mes
	$numMes = 0;
	$diahoy = date("j");
	$meshoy = date("n");
	$anohoy = date("Y");
	if($ano > date("Y")){$anoAnt = intval($ano) - 1;}else{$anoAnt="";}
	$anoSig = intval($ano) + 1;
	if($anoAnt !=""){$urlanoAnt = "<a href=?ano=$anoAnt&mes=$mes>". $anoAnt . "</a> - ";
	}else{$urlanoAnt = "";}
	$urlanoSig = "<a href=?ano=$anoSig&mes=$mes>" . $anoSig . "</a>";
	if($mes == 1){
		if($ano > $anohoy){$urlmesAnt = "<a href='?ano=$anoAnt&mes=12'><</a>";
		}else{
			$urlmesAnt = "";
		}
		}else{$urlmesAnt = "<a href='?ano=$ano&mes=".($mes-1)."'><</a>";}
	if($mes == 12){
		$urlmesSig = "<a href='?ano=$anoSig&mes=1'>></a>";
		}else{$urlmesSig = "<a href='?ano=$ano&mes=".($mes+1)."'>></a>";}

	
	echo "<link href=\"css/agenda.css\" rel=\"stylesheet\" type=\"text/css\"/>";
	echo "<div class=\"ClaseAno\">";
	echo "<div class=\"ClaseMes\">";
	echo "<div class=\"fila0\"> $urlanoAnt $urlmesAnt - " . $meses[$mes-1] . " - $urlmesSig $urlanoSig </div>";
	for ($fila = 0; $fila < 7; $fila++){
	  echo "<div class=\"filaSemana\">\n";
	  for ($coln = 0; $coln < 7; $coln++){
		  if($fila == 0){echo '<div class="CeldaFila0"><span class="DiasSemana">'.$diasSem[$coln]; echo "</span></div>\n";}
		    elseif(($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)){// es un dia del mes
			++$numMes;
				
		     if(($diahoy == $numMes)&&( $mes == $meshoy)&&( $ano == $anohoy)){//dia de hoy
			 			$ClaseDia = "CeldaCalendarioHoy";
						echo "<div class=\"$ClaseDia\" title=\"$numMes\">";
						echo $numMes;
						echo "</div>\n";

				}elseif(($coln==5)||($coln==6)){// fin de semana
						$ClaseDia = "CeldaCalendarioFindeSemana";
						echo "<div class=\"$ClaseDia\" title=\"$numMes\">";
						echo $numMes;
						echo "</div>\n";

				}else{//resto de dias
		      	
						$ClaseDia = "CeldaCalendario";
						echo "<div class=\"$ClaseDia\" title=\"$numMes\">";
						echo $numMes;
						echo "</div>\n";
					}
		    }else{
		    	printf ("<div class=\"CeldaCalendario\"><span class=\"SinDias\">&nbsp;</span></div>\n");//resto de días
		    }
		   
		  }
	  echo "</div>\n";
	}
	echo"</div>";
	echo"</div>";

}

PintaMes($mes,$dia,$ano,$idNucleoUrbano,$idTipoEvento);
?> 

