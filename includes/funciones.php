<?php

function isEmail($email) 
{
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
}

function Limpiar($cad,$longitud)
{
	$cad = str_replace("'","",$cad);
	if ($longitud > 0){
	$cad = substr($cad,0,$longitud);
	}
	$cad = trim($cad," \'\"\t\n");
	return $cad;
}

function isValidDateTime($dateTime)
{
	// formato de fecha con hora dd-mm-aaaa hh:mm:ss
    if (preg_match("/^(\d{2})-(\d{2})-(\d{4}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
        if (checkdate($matches[1], $matches[2], $matches[3])) {
            return true;
        }
    }

    return false;
}

function isValidaFechaCorta($Fecha)
{
		//  dd/mm/aaaa
	$date = explode("/", $Fecha);
	$dia = $date[0];
	$mes = $date[1];
	$anyo = $date[2];
	if (checkdate($mes,$dia,$anyo)){
		return true;
	}else{
		return false;
	}
}

function FechaReves($Fecha)
{
	if(!is_null($Fecha)){
		$date = explode("/", $Fecha);
		return date("Y-m-d",mktime(0,0,0,$date[1],$date[0],$date[2]));	
	}
}

function FechaDerecho($Fecha)
{
	if(!is_null($Fecha)){
		$date = explode("-", $Fecha);
		return date("d/m/Y",strtotime($Fecha));
	}
} 

function advancedRmdir($path) 
{ //Elimina un directorio con todo su contendo
    $origipath = $path;
    $handler = opendir($path);
    while (true) {
        $item = readdir($handler);
        if ($item == "." or $item == "..") {
            continue;
        } elseif (gettype($item) == "boolean") {
            closedir($handler);
            if (!@rmdir($path)) {
                return false;
            }
            if ($path == $origipath) {
                break;
            }
            $path = substr($path, 0, strrpos($path, "/"));
            $handler = opendir($path);
        } elseif (is_dir($path."/".$item)) {
            closedir($handler);
            $path = $path."/".$item;
            $handler = opendir($path);
        } else {
            unlink($path."/".$item);
        }
    }
    return true;
}

function GetSelect($nombre,$valor,$nombreValor,$list,$tipo,$tamano,$clase,$accion,$valorSel)
{
	if($list){
		$listadoSelect = "<select id=\"$nombre\" name=\"$nombre\" class=\"$clase\" $accion size=\"$tamano\" $tipo>";
		$listadoSelect .= "<option value=\"\">Todos</option>";
		foreach($list as $key=>$value)
		{
			if($valorSel == $value[$valor])
			{
				$listadoSelect .= "<option value=\"$value[$valor]\" selected=\"selected\">$value[$nombreValor]</option>";
			}
			else
			{
				$listadoSelect .= "<option value=\"$value[$valor]\">$value[$nombreValor]</option>";
			}
		}
		$listadoSelect .= "</select>";
	}else{
		$listadoSelect = "";	
	}
	return $listadoSelect;
}

function CrearSelect($nombre,$valor,$nombreValor,$sql,$link,$tipo,$tamano,$clase,$accion,$valorSel)
{

	$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$max = mysqli_num_rows($result);
	//echo "El numero de registros es: ".$max;	
	if($max > 0){
		$listadoSelect = "<select id=\"$nombre\" name=\"$nombre\" class=\"$clase\" $accion size=\"$tamano\" $tipo>";
		//if ($valorSel != "Sin"){
		$listadoSelect .= "<option value=\"\">Todos</option>";
		//}
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			if($valorSel == $row[$valor]){
				$listadoSelect .= "<option value=\"$row[$valor]\" selected=\"selected\">$row[$nombreValor]</option>";
			}else{
				$listadoSelect .= "<option value=\"$row[$valor]\">$row[$nombreValor]</option>";
			}
		}
		$listadoSelect .= "</select>";
	}else{
		$listadoSelect = "";	
	}
	mysqli_free_result($result);
	mysqli_close($link);
	return $listadoSelect;
}

function convertLatin1ToHtml($str) { 
$allEntities = get_html_translation_table(HTML_ENTITIES, ENT_NOQUOTES); 
$specialEntities = get_html_translation_table(HTML_SPECIALCHARS, ENT_NOQUOTES); 
$noTags = array_diff($allEntities, $specialEntities); 
$str = strtr($str, $noTags); 
return $str; 
} 

$HTML_TAG = "</?[a-z][a-z0-9]*[^<>]*>";
//$HTML_TAG2 = "<([A-Z][A-Z0-9]*)[^>]*>(.*?)</\1>";


function GetDescription($cad,$long){
	//$cad = preg_replace("|<[^>]+>|U",$reemplazo,$cad);
	$cad = preg_replace('/[:,.\'\"]/',' ', $cad);
	$cad = preg_replace('/\s\s+/',' ', $cad);

	if(strpos(substr ($cad,$long,1)," ")===false){
		while(strpos(substr ($cad,$long,1)," ")===false){
			$cad = substr($cad,0,$long--);
		}
	}else{
		$cad = substr($cad,0,$long+1);
	}
	return $cad;
}

function GenKeyWords($cad,$longitud){
	$MetaKeyWord = "";
		
	//$cad = preg_replace("|<[^>]+>|U",$reemplazo,$cad);
	$cad = preg_replace('/[:,.\'\"]/',' ', $cad);
	$cad = preg_replace('/\s\s+/',' ', $cad);
	
	$KeyWords = explode(" ", $cad);
	$numMetaKey = 0;
	for($i = 0;(($i < sizeof($KeyWords)) and ($numMetaKey < 20)); $i++){
		if((strlen($KeyWords[$i]) > $longitud) and (!stripos($MetaKeyWord,$KeyWords[$i]))){
			if ($MetaKeyWord == ""){
				$MetaKeyWord = $KeyWords[$i];
			}else{
				$MetaKeyWord .= ", " . $KeyWords[$i];
			}	
			$numMetaKey ++;
		}
	}
	return $MetaKeyWord;
}

function do_reg($text, $regex)
{
	$salida = "";
	preg_match_all($regex, $text, $result, PREG_SET_ORDER);
	for ($matchi = 0; $matchi < count($result); $matchi++) {
		for ($backrefi = 0; $backrefi < count($result[$matchi]); $backrefi++) {
			$salida .= $result[$matchi][$backrefi];
		} 
	}
	return $salida;
}


function IconosSubservicio($idDirectorio,$idServicio){
	$linkfunction = ConnBDCervera();
	$sqlIcono = "SELECT DISTINCT DSS.idSubServicio, SS.NombreSubServicio, SS.icono, S.NombreServicio, S.idServicio FROM DirectorioSubServicio AS DSS\n"
	    . "INNER JOIN DirectorioServicio AS DS ON DSS.IDDIRECTORIO = DS.IDDIRECTORIO \n"
	    . "INNER JOIN SubServicios AS SS ON DSS.idSubServicio =SS.idSubServicio\n"
	    . "INNER JOIN Servicios AS S ON SS.idServicio = S.idServicio\n"
	    . "WHERE DSS.idDirectorio = " . $idDirectorio ;	
	    
	if ($idServicio > 0){$sqlIcono .= " and S.idServicio = $idServicio ";}
	$resultIcono = mysqli_query($linkfunction,$sqlIcono);
	if (!$resultIcono)
		{
		$message = "Invalid query".mysqli_error($linkfunction)."\n";
		$message .= "whole query: " .$sqlIcono;	
		die($message);
		exit;
		}
	$maxIcono = mysqli_num_rows($resultIcono);	
	$Iconos = "";
	if($maxIcono > 0){  
		while ($rowIcono = mysqli_fetch_array($resultIcono, MYSQLI_ASSOC)) {		
			$Iconos .= "<img src=\"iconos/".$rowIcono["icono"]."\" height=\"32\" width=\"32\" alt=\"".$rowIcono["NombreServicio"]. " ". $rowIcono["NombreSubServicio"]."\" title=\"".$rowIcono["NombreServicio"]. " ".$rowIcono["NombreSubServicio"]."\"/>";
		}
	}else{
		$Iconos = "";
	}
	mysqli_free_result($resultIcono);
	return $Iconos;
}

// muestra un numero de tel�fono con el formato intenacional + 34 numero
function MostrarTelefono($Num){
	return " +34 " . substr($Num,0,3) . " " . substr($Num,3,2) . " " . substr($Num,5,2) . " " . substr($Num,7,2);
}

// devuelve una URL  con el estandar de la W3C
function UrlW3c($UrlIn){
	$UrlOut = '';
	$ArrayUrl = explode("&", $UrlIn);
	for ($i = 0 ; $i < sizeof($ArrayUrl) ; $i++) { 
		if(substr($ArrayUrl[$i],0,4) != "amp;"){
			if($UrlOut != ""){
				$UrlOut .= "&amp;" . $ArrayUrl[$i];
			}else{
				$UrlOut .= $ArrayUrl[$i]; // comienzo de la URL http://
			}
		}else{
			$UrlOut .= "&" . $ArrayUrl[$i];
		}
	}
	if(substr($UrlOut,0,3) != "../"){
		return $UrlOut;
	}else{
		return substr($UrlOut,3);
	}
}

function selfURL() { 
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
} 

function strleft($s1, $s2) { 
	return substr($s1, 0, strpos($s1, $s2)); 
}

function ColocarBanners(){
	$sql = " SELECT BNS.*,GBN.* FROM Banners as BNS inner join BannersGestion as GBN on BNS.idBanner = GBN.idBanner where 1 = 1 "
	. " and Publicar = 1 "
	//. " and Pagina = '" .selfURL() . "' "
	. " and FechaInicio <= '".Date("Y-m-d")."' "
	. " and FechaFin >= '".Date("Y-m-d")."' "
	. " order by GBN.Orden ";

	$link = ConnBDCervera();
	
	$result = mysqli_query($link, $sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$max = mysqli_num_rows($result);	
	if($max > 0){  
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$UrlBanner = $row["UrlBanner"];
			$idBanner = $row["idBanner"];
			$idBannersGestion = $row["idBannersGestion"];
			$Banner = $row["Banner"];
			$Pagina = $row["Pagina"];
			$TextoBanner = $row["TextoBanner"];
			$Ancho = $row["Ancho"];
			$Alto = $row["Alto"];
			
			if($Pagina == curPageURL())
			{
				echo "<a href=\"". str_Replace("&","&amp;",urldecode($UrlBanner)) ."\" onclick=\"javascript: pageTracker._trackPageview('/outgoing/outbound-banner-partner3.com');\"><img src=\"Banners/$idBanner/$Banner\" alt=\"$TextoBanner\" title=\"$TextoBanner\" longdesc=\"". str_Replace("&","&amp;",$UrlBanner) ."\" style=\"min-width:100%\" /></a><br/>";
			
			
			// contabiliza las veces que se muestra un banner por los usuarios
			$sqlIn = "Insert into BannersVistos (idBanner, idBannersGestion, Banner, TextoBanner, UrlBanner, Pagina, IP, Referer, Fecha) values ("
							. " $idBanner, "
							. " $idBannersGestion, "
							. " '$Banner', "
							. " '$TextoBanner', "
							. " '$UrlBanner', "
							. " '$Pagina', "
							. "'". $_SERVER['REMOTE_ADDR'] ?? '' . "',"
							. "'". $_SERVER['HTTP_REFERER'] ?? '' . "',"
							. "Now())";
			$resultIn = mysqli_query($link,$sqlIn);
			}

			
		}
	}
	mysqli_free_result($result);
	mysqli_close($link);	
}


function curPageURL() 
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] ?? '' == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	$pageURL .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return str_replace('index.php','',$pageURL);
}

function getNameOfDay($d){
	$dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
	return $dias[$d];
}
function getNameOfMonth($m){
	$meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
	return $meses[$m - 1];
}

//Salida: Viernes 24 de Febrero del 2012

?>
