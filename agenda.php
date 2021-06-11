<?php
namespace citcervera;

include_once("includes/Conn.php");
include_once("includes/funciones.php");

use citcervera\Model\Managers\Manager;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\Santoral;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Entities\TipoEvento;

$dc = new DataCarrier();
$agendaEntity = new Agenda();
$agendaManager = new Manager($agendaEntity);
$santoralEntity = new Santoral();
$santoralManager = new Manager($santoralEntity);
$nucleosUrbanosEntity = new NucleosUrbanos();
$nucleosUrbanosManager = new Manager($nucleosUrbanosEntity);
$tipoEventoEntity = new TipoEvento();
$tipoEventoManager = new Manager($tipoEventoEntity);

$anoInicial = '2009';
$anoFinal = date("Y")+1;
$funcionTratarFecha = 'document.location = "?dia="+dia+"&amp;mes="+mes+"&amp;ano="+ano;';
$fecha = getdate(time());
$idNucleoUrbano = 0;
$idTipoEvento = 0;
$where = [];

$conditions = [];
$format = [];
$ano = $_GET["ano"] ?? '';
$mes = $_GET["mes"] ?? '';
$dia = $_GET["dia"] ?? '';
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$idTipoEvento = $_GET["idTipoEvento"] ?? '';

if(isset($_GET["dia"]))$dia = $_GET["dia"]; 
if(isset($_GET["mes"]))$mes = $_GET["mes"]; 
if(isset($_GET["ano"]))$ano = $_GET["ano"]; 
if(isset($_GET["idNucleoUrbano"]))$idNucleoUrbano = $_GET["idNucleoUrbano"];
if(isset($_GET["idTipoEvento"]))$idTipoEvento = $_GET["idTipoEvento"];

if ($ano=="")
{
	$ano = $fecha['year']; 
}
if ($mes!="")
{
	$conditions['Month(FechaEvento)'] = $mes; 
	$where []= '( Month(FechaEvento) =? )';
	$where_param[] = $mes;
	$format[]= '%s';
}
if ($dia!="")
{
	$conditions['Day(FechaEvento)'] = $dia; 
	$where []= '( Day(FechaEvento) =? )';
	$where_param[] = $dia;
	$format[]= '%s';
}
if ($idNucleoUrbano!="")
{
	$conditions['idNucleoUrbano'] = $idNucleoUrbano; 
	$where []= '( idNucleoUrbano =? OR idNucleoUrbano =? )';
	$where_param[] = $idNucleoUrbano;
	$where_param[] = 0;
	$format[]= '%s';
	$format[]= '%s';
}
if ($idTipoEvento!="")
{
	$conditions[] = 'idTipoEvento =>' . $idTipoEvento; 
	$where []= '( idTipoEvento =? )';
	$where_param[] = $idTipoEvento;
	$format[]= '%s';
}
$where []= '( Year(FechaEvento) =? )';
$where_param[] = $ano;
$format[]= '%s';

$query = ' SELECT * FROM Agenda WHERE ' .implode(' AND ',$where);

$eventos = $agendaManager->Search($query,$where_param,$format);
$santoral = $santoralManager->GetAll();
$nucleosUrbanos = $nucleosUrbanosManager->GetAll();
$tipoEvento = $tipoEventoManager->GetAll();

$dc->Set($eventos, 'Agenda');
$dc->Set($santoral, 'Santoral');
$dc->Set($nucleosUrbanos, 'NucleosUrbanos');
$dc->Set($tipoEvento, 'TipoEvento');


function GetSmallArrayFromBiggerOne($dc,$entityName, $arrayKeys)
{
	$ret = [];
	
	foreach($dc->GetEntities($entityName) as $entity){
		$ret2 = [];
		foreach($arrayKeys as $key){
			if($key == 'FechaEvento')
			{
				$ret2[$key] = substr($entity->{$key},0,4);
			}
			else
			{
				$ret2[$key] = $entity->{$key};
			}	
		}
		$ret[] = $ret2;
	}
	return $ret;
}

function getFilterArrayByValue($dc, $entityTableName, $searchedFields, $searchedValues)
{
	$dc2 = $dc->getEntities($entityTableName);
	for($i=0;$i<count($searchedFields);$i++){
		$searchedField = $searchedFields[$i];
		$searchedValue = $searchedValues[$i];
		$dc2 = array_filter(
			$dc2,
			function ($e) use ($searchedField,$searchedValue) {
				if($searchedField == 'Year(FechaEvento)')
				{
					return substr($e->FechaEvento,0,4) == $searchedValue;
				}
				elseif($searchedField == 'Month(FechaEvento)')
				{
					return substr($e->FechaEvento,3,2) == $searchedValue;
				}
				else
				{
					return $e->{$searchedField} == $searchedValue;
				}
				
			}
		);
		
	}
	return $dc2;
}

function getFilterArrayByValue2($dc, $entityTableName, $searchedField, $searchedValue)
{
	return array_filter(
		$dc->getEntities($entityTableName),
		function ($e) use ($searchedField,$searchedValue) {
			return $e->{$searchedField} == $searchedValue;
		}
	);
}

function SantosDia(\citcervera\Model\Managers\DataCarrier $dc, $mes, $dia)
{
	$fieldsToFilter = array('Dia');
	$valuesToFilter = array($dia);
	$santosDia = array_values(getFilterArrayByValue($dc,'Santoral',$fieldsToFilter,$valuesToFilter));
	return $santosDia[0]->Santos;
}

function ComprobarDia($dc,$fecha,$idNucleoUrbano,$idTipoEvento)
{
	if ($idNucleoUrbano == ""){$idNucleoUrbano = 0;}
	if ($idTipoEvento == ""){$idTipoEvento = 0;}

	$fieldsToFilter = [];
	$valuesToFilter = [];

	$fieldsToFilter[] = 'FechaEvento';
	$valuesToFilter[] = $fecha;

	if ($idNucleoUrbano > 0){
		$fieldsToFilter[] = 'idNucleoUrbano';
		$valuesToFilter[] = $idNucleoUrbano;
		//$sql = "SELECT * FROM Agenda WHERE FechaEvento = '$fecha' and (idNucleoUrbano = $idNucleoUrbano or idNucleoUrbano = 0) "; 
		if ($idTipoEvento > 0){
			$fieldsToFilter[] = 'idTipoEvento';
			$valuesToFilter[] = $idTipoEvento;
			//$sql .= " and idTipoEvento = $idTipoEvento ";
		}
		
		$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
		if(count($eventosDia) > 0)
		{
			return count($eventosDia) > 0;
		}
		else
		{
			$fieldsToFilter = [];
			$valuesToFilter = [];

			$fieldsToFilter[] = 'FechaEvento';
			$valuesToFilter[] = $fecha;
			$fieldsToFilter[] = 'idNucleoUrbano';
			$valuesToFilter[] = 0;
			//$sql = "SELECT * FROM Agenda WHERE FechaEvento = '$fecha' and (idNucleoUrbano = $idNucleoUrbano or idNucleoUrbano = 0) "; 
			if ($idTipoEvento > 0){
				$fieldsToFilter[] = 'idTipoEvento';
				$valuesToFilter[] = $idTipoEvento;
				//$sql .= " and idTipoEvento = $idTipoEvento ";
			}
			
			$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
			return count($eventosDia) > 0;
		}
	}else{
		//$sql = "SELECT * FROM Agenda WHERE FechaEvento = '$fecha' "; 
		if ($idTipoEvento > 0){
			$fieldsToFilter[] = 'idTipoEvento';
			$valuesToFilter[] = $idTipoEvento;
			//$sql .= " and idTipoEvento = $idTipoEvento ";
		}
		
		$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
		return count($eventosDia) > 0;
	}
}

function TipoFiesta($dc,$fecha,$idNucleoUrbano,$idTipoEvento)
{

	if ($idNucleoUrbano == ""){$idNucleoUrbano = 0;}
	if ($idTipoEvento == ""){$idTipoEvento = 0;}

	$fieldsToFilter[] = 'FechaEvento';
	$valuesToFilter[] = $fecha;

	if ($idNucleoUrbano > 0){
		
		$fieldsToFilter[] = 'idNucleoUrbano';
		$valuesToFilter[] = $idNucleoUrbano;
		
		if ($idTipoEvento > 0){
			$fieldsToFilter[] = 'idTipoEvento';
			$valuesToFilter[] = $idTipoEvento;
		}
		$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
		if(count($eventosDia) > 0)
		{
			return count($eventosDia) > 0;
		}
		else
		{
			$fieldsToFilter = [];
			$valuesToFilter = [];

			$fieldsToFilter[] = 'FechaEvento';
			$valuesToFilter[] = $fecha;
			$fieldsToFilter[] = 'idNucleoUrbano';
			$valuesToFilter[] = 0;
			
			if ($idTipoEvento > 0){
				$fieldsToFilter[] = 'idTipoEvento';
				$valuesToFilter[] = $idTipoEvento;
			}
			
			$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
			return count($eventosDia) > 0;
		} 
		
	}else{
		if ($idTipoEvento > 0){
			$fieldsToFilter[] = 'idTipoEvento';
			$valuesToFilter[] = $idTipoEvento;
		}
		
		$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
		return count($eventosDia) > 0;
	}
	
	return false;
	
}

function ComprobarMes($dc,$ano,$mes,$idNucleoUrbano,$idTipoEvento)
{
	if ($idNucleoUrbano == ""){$idNucleoUrbano = 0;}
	if ($idTipoEvento == ""){$idTipoEvento = 0;}

	$fieldsToFilter[] = 'Year(FechaEvento)';
	$valuesToFilter[] = $ano;
	$fieldsToFilter[] = 'Month(FechaEvento)';
	$valuesToFilter[] = $mes;

	if ($idNucleoUrbano > 0){ 
		$fieldsToFilter[] = 'idNucleoUrbano';
		$valuesToFilter[] = $idNucleoUrbano;
		if ($idTipoEvento > 0){
			$fieldsToFilter[] = 'idTipoEvento';
			$valuesToFilter[] = $idTipoEvento;
		}
		$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
		return count($eventosDia) > 0;
	}else{
		if ($idTipoEvento > 0){
			$fieldsToFilter[] = 'idTipoEvento';
			$valuesToFilter[] = $idTipoEvento;
		}
		$eventosDia = getFilterArrayByValue($dc,'Agenda',$fieldsToFilter,$valuesToFilter);
		return count($eventosDia) > 0;
	}
	return false;
}

function PintaMes($mes,$dia,$ano,$idNucleoUrbano,$idTipoEvento,\citcervera\Model\Managers\DataCarrier $dc)
{
	
	$diasSem = Array ('l','m','x','j','v','s','d');
	$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
	$posicion = Array (1,2,3,4,5,6,0);
	$fecha = mktime(0,0,0,$mes,$dia,$ano);
	$fechaInicioMes = date("w",$fecha); // día de la semana en que empieza el mes der 0 a 6
	$ultimoDia = date('t',$fecha); // numero máximo de días del mes
	$numMes = 0;
	$diahoy = date("j");
	$meshoy = date("n");
    $anohoy = date("Y");
     

	$dc->getEntities('Agenda');

	echo '<div class="month">';
	if(ComprobarMes($dc,$ano,$mes,$idNucleoUrbano,$idTipoEvento)){
		echo '<div class="week month-name"><a href="agenda.php?ano='.$ano.'&amp;mes='.$mes.'" title="Ver eventos de &#10;&#13;'.$meses[$mes-1].' de '.$ano.'" >'.$meses[$mes-1].'</a></div>';
	}else{
		echo '<div class="week month-name">'.$meses[$mes-1].'</div>';
	}
	for ($fila = 0; $fila < 7; $fila++){
	  echo "<div class=\"week\">\n";
	  for ($coln = 0; $coln < 7; $coln++){
		  if($fila == 0){echo '<div class="day-name">'.$diasSem[$coln] . "</div>\n";}
		    elseif(($numMes && $numMes < $ultimoDia) || (!$numMes && $posicion[$coln] == $fechaInicioMes)){// es un dia del mes
			++$numMes;
			$fecha = $ano . '-' . (($mes < 10)? '0'.$mes : $mes) . '-' . (($numMes < 10)? '0'.$numMes : $numMes);
			 if(($diahoy == $numMes)&&( $mes == $meshoy)&&( $ano == $anohoy)){//dia de hoy
				$fecha = $ano . '-' . (($mes < 10)? '0'.$mes : $mes) . '-' . $numMes;
			 		if (TipoFiesta($dc,$fecha,$idNucleoUrbano,17)){$ClaseDia = "CeldaCalendarioFiestaOficial";}else{$ClaseDia = "CeldaCalendarioHoy";}
					 
					 if (ComprobarDia($dc,$fecha,$idNucleoUrbano,$idTipoEvento)){//Hay eventos
						echo "<div class=\"day $ClaseDia\">";
						echo "<a href=\"agenda.php?ano=$ano&amp;mes=$mes&amp;dia=$numMes\" title=\"Ver eventos del dia $numMes de ".$meses[$mes-1]." de $ano. Santos: ".SantosDia($dc,$meses[$mes-1],$numMes)."\" >";
						echo $numMes;
						echo'</a>';
						echo "</div>\n";
					}else{
						echo "<div class=\"day $ClaseDia\" title=\"Santos: ".SantosDia( $dc,$meses[$mes-1],$numMes)."\">";
						echo $numMes;
						echo "</div>\n";
					}
				}elseif(($coln==5)||($coln==6)){// fin de semana
					if (ComprobarDia($dc,$fecha,$idNucleoUrbano,$idTipoEvento)){//Hay eventos
						if (TipoFiesta($dc,$fecha,$idNucleoUrbano,17)){$ClaseDia = "CeldaCalendarioFiestaOficial";}else{$ClaseDia = "CeldaCalendarioEvento";}
						echo "<div class=\"day $ClaseDia\">";
						echo "<a href=\"agenda.php?ano=$ano&amp;mes=$mes&amp;dia=$numMes\" title=\"Ver eventos del dia $numMes de ".$meses[$mes-1]." de $ano. Santos: ".SantosDia($dc,$meses[$mes-1],$numMes)."\" >";
						echo $numMes;
						echo'</a>';
						echo "</div>\n";
					}else{
						if (TipoFiesta($dc,$fecha,$idNucleoUrbano,17)){$ClaseDia = "CeldaCalendarioFiestaOficial";}else{$ClaseDia = "CeldaCalendarioEvento";}
						echo "<div class=\"day\" title=\"Santos: ".SantosDia($dc,$meses[$mes-1],$numMes)."\">";
						echo $numMes;
						echo "</div>\n";
					}
					
				}else{//resto de dias
		      	if (ComprobarDia($dc,$fecha,$idNucleoUrbano,$idTipoEvento)){//Hay eventos
		      	if (TipoFiesta($dc,$fecha,$idNucleoUrbano,17)){$ClaseDia = "CeldaCalendarioFiestaOficial";}else{$ClaseDia = "CeldaCalendarioEvento";}
						echo "<div class=\"day $ClaseDia\">";
						echo "<a href=\"agenda.php?ano=$ano&amp;mes=$mes&amp;dia=$numMes\" title=\"Ver eventos del dia $numMes de ".$meses[$mes-1]." de $ano. Santos: ".SantosDia($dc,$meses[$mes-1],$numMes)."\" >";
						echo $numMes;
						echo'</a>';
						echo "</div>\n";
					}else{
						if (TipoFiesta($dc,$fecha,$idNucleoUrbano,17)){$ClaseDia = "CeldaCalendarioFiestaOficial";}else{$ClaseDia = "CeldaCalendario";}
						echo "<div class=\"day $ClaseDia\" title=\"Santos: ".SantosDia($dc,$meses[$mes-1],$numMes)."\">";
						echo $numMes;
						echo "</div>\n";
					}
                     }
                    
		    }else{
		    	printf ("<div class=\"day blank\"></div>\n");//resto de d�as
		    }
		   
		  }
	  echo "      </div>\n";
	}
	echo'</div>';

}

function ObtenerNombreNucleoUrbano($dc,$idNucleoUrbano)
{
	$index = '';
	if ($idNucleoUrbano !=""){
		$index = array_search(12, array_column($dc->GetEntities('NucleosUrbanos'), 'idNucleoUrbano'));
		return $dc->GetEntities('NucleosUrbanos')[$index]->NombreNucleoUrbano;
	}	
}

function ObtenerTipoEvento($dc,$idTipoEvento)
{
	$index = '';
	if ($idTipoEvento !=""){
		$index = array_search(12, array_column($dc->GetEntities('TipoEvento'), 'idTipoEvento'));
		return $dc->GetEntities('TipoEvento')[$index]->TipoEvento;
	}
}

function ObtenerMes($mes)
{
	$meses = Array ('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
	if(($mes > 0) and ($mes < 13))return $meses[$mes - 1];
}


$MetaTitulo = "Agenda de eventos de la Montaña Palentina año $ano";
if ($mes > 0) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de ".ObtenerMes($mes)." de $ano";
if (($dia > 0) and ($mes > 0)) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de $dia de ".ObtenerMes($mes)." de $ano";

if($idNucleoUrbano > 0){
		$NombreNucleoUrbano = ObtenerNombreNucleoUrbano($dc,$idNucleoUrbano);
		$MetaTitulo = "Agenda de eventos de la Montaña Palentina de $ano. $NombreNucleoUrbano";
		if ($mes > 0) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de ".ObtenerMes($mes)." de $ano. $NombreNucleoUrbano";
		if (($dia > 0) and ($mes > 0)) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de $dia de ".ObtenerMes($mes)." de $ano. $NombreNucleoUrbano";
	if($idTipoEvento > 0){
		$TipoEbvcento = ObtenerTipoEvento($dc,$idTipoEvento);
		$MetaTitulo = "Agenda de eventos $TipoEbvcento de la Montaña Palentina de ".ObtenerMes($mes)." de $ano. $NombreNucleoUrbano";
		if ($mes > 0) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de ".ObtenerMes($mes)." de $ano. $NombreNucleoUrbano";
		if (($dia > 0) and ($mes > 0)) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de $dia de ".ObtenerMes($mes)." de $ano. $NombreNucleoUrbano";
	}

}else{
	if($idTipoEvento > 0){
		$TipoEbvcento = ObtenerTipoEvento($dc,$idTipoEvento);
		$MetaTitulo = "Agenda de eventos $TipoEbvcento de la Montaña Palentina de ".ObtenerMes($mes)." de $ano";
		if ($mes > 0) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de ".ObtenerMes($mes)." de $ano";
		if (($dia > 0) and ($mes > 0)) $MetaTitulo = "Agenda de eventos de la Montaña Palentina de $dia de ".ObtenerMes($mes)." de $ano";
	}
}

$MetaDescripcion = $MetaTitulo ;
$MetaKeywords =  GenKeyWords($MetaDescripcion,3);

?>
<!DOCTYPE html>
<html>
     <head>
	<?php
include('./head.php');
?>  
     </head>
     <body>
          <div id="testsize" style="display:none;position:fixed;top:0;left:0;background:#fff;height:50px;z-index:10000"></div>
<div class="wrapper">
<?php
include('./header.php');
include("./menu.php");
?>
 <div class="grid container">
 <?php
include('./aside1.php');
include('./aside2.php');
?>
            <div class="main">        
               <div class="content">
               <?php

if (($mes == "") && ($dia == "")){

?>
               <div class="selectors">
                    <div class="selectano">
                    <?php 
$query = "Select Year(FechaEvento) as ano from Agenda group by ano order by ano desc";
$listAnos = $agendaManager->Query($query);
$accion = "onchange=\"SeleccionAno(this);\"";
echo GetSelect("ANO","ano","ano",$listAnos,"","","",$accion,$ano);
?>
          </div>
          <div class="selectVillage">
               <?php
$accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
$list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano','NombreNucleoUrbano') );
echo GetSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$list,"","","",$accion,$idNucleoUrbano);
 ?>
                             
                         </div>
                         <div class="selectevent">
                              <?php
$accion = "onchange=\"SeleccionTipoEvento(this);\"";
$list = GetSmallArrayFromBiggerOne($dc, 'TipoEvento', array('idTipoEvento','TipoEvento') );
echo GetSelect("IDTIPOEVENTO","idTipoEvento","TipoEvento",$list,"","","",$accion,$idTipoEvento);
 ?>
                         </div>
                         </div>
     <div class="year">
          <div class="term">
               <?php
                	 PintaMes(1,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc);
                   	 PintaMes(2,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
               ?>
          </div>
          <div class="term">
          <?php
                    PintaMes(3,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
                    PintaMes(4,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
               ?>
                   
               </div>
          <div class="term">
          <?php
                    PintaMes(5,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
                    PintaMes(6,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
               ?>
               </div>
               <div class="term">
               <?php
                    PintaMes(7,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
                    PintaMes(8,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
               ?>
                    </div>
          <div class="term">
          <?php
                    PintaMes(9,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
                    PintaMes(10,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc);  
               ?>
                          </div>
          <div class="term">
          <?php
                    PintaMes(11,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
                    PintaMes(12,1,$ano,$idNucleoUrbano,$idTipoEvento, $dc); 
               ?>
                         </div>
     </div>
     <?php
}elseif ($dia == ""){// eventos por meses
	
	echo "<h1>Actividades en ". getNameOfMonth($mes) . " de " .  $ano ."</h1>\n";
	?>
    <div class="MigasdePan"><a title="Agenda" href="agenda.php">Agenda</a>
    </div>
    <br/>
	<?php
	
	$link = ConnBDCervera(); 
	$sql = "SELECT * FROM Agenda WHERE Year(FechaEvento) = '$ano' and Month(FechaEvento) = $mes order by FechaEvento,HoraEvento"; 
	
	
		$sql = "SELECT AG.*, NU.NombreNucleoUrbano,IM.Path as ImgPath, IM.Archivo as ImgArchivo, "
		. " IM.AnchoThumb, IM.AltoThumb, DOC.Path as DocPath, DOC.Archivo as DocArchivo FROM Agenda as AG "
        . " left JOIN NucleosUrbanos as NU ON AG.idNucleoUrbano = NU.idNucleoUrbano "
        . " left join Imagenes as IM on AG. ImgAgenda = IM.idImagen"
        . " left join Documentos as DOC on AG.DocAgenda = DOC.idDoc"
        . " WHERE Year(FechaEvento) = '$ano' and Month(FechaEvento) = $mes  order by FechaEvento,HoraEvento "; 
		
		$listEventosMes = $agendaManager->Query($sql,'fetch_object', new Agenda());
  
	
	if(count($listEventosMes) > 0){
	$FE = "";
		echo "<div class=\"DiasMes\">\n";

		foreach($listEventosMes as $evento){
		if ($FE == ""){
		echo "<div class=\"Dia\">\n";
		echo "<p class=\"DiaNombre\"><span>".strftime("%d de %B de %Y", strtotime($evento->FechaEvento))."</span></p>\n";
		echo "<div class=\"EventosLista\">\n";
		$FE =  $evento->FechaEvento;
		}
			if($FE == $evento->FechaEvento){
				echo "<div class=\"Evento\"><h2 class=\"EventoTitulo\">".$evento->Evento."</h2>";
				if(!is_null($evento->HoraEvento)){
				echo "<span class=\"EventoHora\">".date("H:i",strtotime($evento->HoraEvento))."</span>";
				}
				echo "</div>\n";
				echo "<div class=\"EventoContenido\">\n";
				$idAgenda = $evento->idAgenda;
				$ImgAgenda = $evento->ImgAgenda;
				$DocAgenda = $evento->DocAgenda;
				if ($ImgAgenda>0){
					$ImgPath = $evento->ImgPath;
					$ImgArchivo = $evento->ImgArchivo;
					$AnchoThumb = $evento->AnchoThumb;
					$AnchoThumb = $evento->AnchoThumb;
					echo "<img src='../$ImgPath/$ImgArchivo' width ='$AnchoThumb' height='$AnchoThumb' style='float:right;padding:20px;' />";
					
				}
				echo "<p>\n";
					if(($evento->Lugar)!="")echo "<span class=\"EventoDetalle\">Lugar</span>". $evento->Lugar ."<br/>";
					if(($evento->NombreNucleoUrbano)!="")echo 	"<span class=\"EventoDetalle\">Localidad</span>". $evento->NombreNucleoUrbano ."<br/>";
					
					if($evento->Email != ""){$Email = "<a href=\"mail.php?Ambito=Agenda&amp;idAmbito=$idAgenda&amp;Campo=idAgenda&amp;Att=Evento\" title=\"Contacta con el responsable de $Evento\">Contacta</a>";}
					if(($evento->Email)!="")echo  "<span class=\"EventoDetalle\">Email</span>". $Email ."<br/>";
					if(($evento->URL)!="")echo  "<span class=\"EventoDetalle\">URL</span><a href=\"". $evento->URL ."\" target=\"_blank\" title=\"".$evento->Evento."\">".$evento->Evento."</a><br/>";
					if(($evento->Telefono)!="")echo  "<span class=\"EventoDetalle\">Telefono</span>". MostrarTelefono($evento->Telefono) ."<br/>";
					if(($evento->Contacto)!="")echo  "<span class=\"EventoDetalle\">Contacto</span>". $evento->Contacto ."<br/>";
					if($DocAgenda > 0){
							$DocArchivo = $evento->DocArchivo;
							$DocPath = $evento->DocPath;
							echo "<span class=\"EventoDetalle\">Descargar</span><a href='../$DocPath/$DocArchivo' target='_Blank' class='VerDoc' >$DocArchivo</a>";
						}
					echo "<br/><a class=\"linkVerde\" href=\"agenda-detalle.php?idAgenda=$idAgenda\" title=\"".$evento->Evento."\">Ver Ficha del evento</a>";
					echo "</p>\n";
					// if(($evento->Descripcion)!=""){
					// 	echo "<p>\n";
					// 	echo html_entity_decode($evento->Descripcion);
					// 	echo "</p>\n";
					// }

				echo "</div>\n";
				}else{
					echo "</div>\n";
					echo "</div>\n";
					echo "<div class=\"Dia\">\n";
		echo "<p class=\"DiaNombre\"><span>".strftime("%d de %B de %Y", strtotime($evento->FechaEvento))."</span></p>\n";
					echo "<div class=\"EventosLista\">\n";
					echo "<div class=\"Evento\"><h2 class=\"EventoTitulo\">".$evento->Evento."</h2>";
					if(!is_null($evento->HoraEvento)){
					echo "<span class=\"EventoHora\">".date("H:i",strtotime($evento->HoraEvento))."</span>";
					}
					echo "</div>\n";
					echo "<div class=\"EventoContenido\">\n";
					$idAgenda = $evento->idAgenda;
					$ImgAgenda = $evento->ImgAgenda;
					$DocAgenda = $evento->DocAgenda;
					if ($ImgAgenda>0){
						$ImgPath = $evento->ImgPath;
						$ImgArchivo = $evento->ImgArchivo;
						$AnchoThumb = $evento->AnchoThumb;
						$AnchoThumb = $evento->AnchoThumb;
						echo "<img src='../$ImgPath/$ImgArchivo' width ='$AnchoThumb' height='$AnchoThumb' style='float:right;padding:20px;' />";
						
					}
					echo "<p>\n";
						if(($evento->Lugar)!="")echo "<span class=\"EventoDetalle\">Lugar</span>". $evento->Lugar ."<br/>";
						if(($evento->NombreNucleoUrbano)!="")echo 	"<span class=\"EventoDetalle\">Localidad</span>". $evento->NombreNucleoUrbano ."<br/>";
						if($evento->Email !=""){$Email = "<a href=\"mail.php?Ambito=Agenda&amp;idAmbito=$idAgenda&amp;Campo=idAgenda&amp;Att=Evento\" title=\"Contacta con el responsable de $Evento\">Contacta</a>";}
						if(($evento->Email)!="")echo  "<span class=\"EventoDetalle\">Email</span>". $Email ."<br/>";
						if(($evento->URL)!="")echo  "<span class=\"EventoDetalle\">URL</span><a href=\"". $evento->URL ."\" target=\"_blank\" title=\"".$evento->Evento."\">".$evento->Evento."</a><br/>";
						if(($evento->Telefono)!="")echo  "<span class=\"EventoDetalle\">Telefono</span>". MostrarTelefono($evento->Telefono) ."<br/>";
						if(($evento->Contacto)!="")echo  "<span class=\"EventoDetalle\">Contacto</span>". $evento->Contacto ."<br/>";
						if($DocAgenda > 0){
							$DocArchivo = $evento->DocArchivo;
							$DocPath = $evento->DocPath;
							echo "<span class=\"EventoDetalle\">Descargar</span><a href='../$DocPath/$DocArchivo' target='_Blank' class='VerDoc' >$DocArchivo</a>";
						}
						echo "<br/><a class=\"linkVerde\" href=\"agenda-detalle.php?idAgenda=$idAgenda\" title=\"".$evento->Evento."\">Ver Ficha del evento</a>";
						echo "</p>\n";
						if(($evento->Descripcion)!=""){
							echo "<p>\n";
							echo html_entity_decode($evento->Descripcion);
							echo "</p>\n";
						}
					echo "</div>\n";
					$FE =  $evento->FechaEvento;
				}
		
		}
		echo "</div>\n";
		echo "</div>\n";
	}
	// echo "<div class=\"EventoFin\">&nbsp;</div>";
	// echo "</div>\n";
	// echo "<p class=\"collapse_buttons\">\n";
	// echo "<span class=\"AbrirTodo\"><a href=\"#\" class=\"mostrar_todo\">Abrir todo</a></span>\n";
	// echo "<span class=\"AbrirTodo\"><a href=\"#\" class=\"cerrar_todo\">Cerrar todo</a></span>\n";
	// echo "</p>\n";

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
}else{ // eventos por dias
	$fecha = $ano."-".$mes."-".$dia;

	$dayofweek = date('w', strtotime($fecha));

	echo "<h1>Actividades el ". getNameOfDay($dayofweek) . " " . $dia . " de " .getNameOfMonth($mes) . " de " .  $ano ."</h1>\n";
?>
    <div class="MigasdePan"><a title="Agenda" href="agenda.php">Agenda</a>
    </div>
    <br/>
	<?php
	$link = ConnBDCervera(); 
	$sql = "SELECT AG.*, NU.NombreNucleoUrbano,IM.Path as ImgPath, IM.Archivo as ImgArchivo, "
		. " IM.AnchoThumb, IM.AltoThumb, DOC.Path as DocPath, DOC.Archivo as DocArchivo FROM Agenda as AG "
        . " left JOIN NucleosUrbanos as NU ON AG.idNucleoUrbano = NU.idNucleoUrbano "
        . " left join Imagenes as IM on AG. ImgAgenda = IM.idImagen"
        . " left join Documentos as DOC on AG.DocAgenda = DOC.idDoc"
        . " WHERE FechaEvento = '$fecha' order by FechaEvento,HoraEvento "; 
		$listEventosDia = [];
	$listEventosDia = $agendaManager->Query($sql,'fetch_object', new Agenda());
		
	if(count($listEventosDia > 0)){
		echo "<div class=\"Dia\">\n";
		foreach($listEventosDia as $evento){
				echo "<div class=\"Evento\"><h2 class=\"EventoTitulo\">".$evento->Evento."</h2>";
				if(!is_null($evento->HoraEvento)){
				echo "<span class=\"EventoHora\">".date("H:i",strtotime($evento->HoraEvento))."</span>";
				}
				echo "</div>\n";
				echo "<div class=\"EventoContenido\">\n";
				$idAgenda = $evento->idAgenda;
				$ImgAgenda = $evento->ImgAgenda;
				$DocAgenda = $evento->DocAgenda;
				if ($ImgAgenda>0){
				$ImgPath = $evento->ImgPath;
				$ImgArchivo = $evento->ImgArchivo;
				$AnchoThumb = $evento->AnchoThumb;
				$AnchoThumb = $evento->AnchoThumb;
					echo "<img src='../$ImgPath/$ImgArchivo' width ='$AnchoThumb' height='$AnchoThumb' style='float:right;padding:20px;' />";
					
				}
				echo "<p>\n";
				if(($evento->Lugar)!="")echo "<span class=\"EventoDetalle\">Lugar</span>". $evento->Lugar ."<br/>";
				if(($evento->NombreNucleoUrbano)!="")echo 	"<span class=\"EventoDetalle\">Localidad</span>". $evento->NombreNucleoUrbano ."<br/>";
				if($evento->Email !=""){$Email = "<a href=\"mail.php?Ambito=Agenda&amp;idAmbito=$idAgenda&amp;Campo=idAgenda&amp;Att=Evento\" title=\"Contacta con el responsable de $evento->Evento\">Contacta</a>";}
				if(($evento->Email)!="")echo  "<span class=\"EventoDetalle\">Email</span>". $Email ."<br/>";
				if(($evento->URL)!="")echo  "<span class=\"EventoDetalle\">URL</span><a href=\"". $evento->URL ."\" target=\"_blank\" title=\"".$evento->Evento."\">".$evento->Evento."</a><br/>";
				if(($evento->Telefono)!="")echo  "<span class=\"EventoDetalle\">Telefono</span>". MostrarTelefono($evento->Telefono) ."<br/>";
				if(($evento->Contacto)!="")echo  "<span class=\"EventoDetalle\">Contacto</span>". $evento->Contacto ."<br/>";
				if($DocAgenda > 0){
					$DocArchivo = $evento->DocArchivo;
					$DocPath = $evento->DocPath;
					echo "<span class=\"EventoDetalle\">Descargar</span><a href='../$DocPath/$DocArchivo' target='_Blank' class='VerDoc' >$DocArchivo</a>";
				}
				echo "<br/><a class=\"linkVerde\" href=\"agenda-detalle.php?idAgenda=$idAgenda\" title=\"".$evento->Evento."\">Ver Ficha del evento</a>";
				echo "</p>\n";
				// if(($evento->Descripcion)!=""){
				// 	echo "<p>\n";
				// 	echo html_entity_decode($evento->Descripcion);
				// 	echo "</p>\n";
				// }
				echo "</div>\n";
		}		
		echo "</div>\n";
	}	
}
?>
</div>

<?php
include("./sponsors.php");
?>
              
</div>

<?php
include("./footer.php");
?>
             
</div>
<script type="text/javascript">

function SeleccionNucleoUrbano(x){
	location.href = "agenda.php?ano=<?php echo $ano; ?>&mes=<?php echo $mes; ?>&dia=<?php echo $dia; ?>&idTipoEvento=<?php echo $idTipoEvento; ?>&idNucleoUrbano="+x.value;
	
}
function SeleccionAno(x){
	location.href = "agenda.php?idTipoEvento=<?php echo $idTipoEvento; ?>&mes=<?php echo $mes; ?>&dia=<?php echo $dia; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&ano="+x.value;
	
}
function SeleccionTipoEvento(x){
	location.href = "agenda.php?ano=<?php echo $ano; ?>&mes=<?php echo $mes; ?>&dia=<?php echo $dia; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&idTipoEvento="+x.value;
	
}

</script>   
     </body>
</html>