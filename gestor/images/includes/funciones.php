<?php
setlocale (LC_ALL, 'es_ES'); 

function isEmail($email) {
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
}

function Limpiar($cad,$longitud){
$cad = str_replace("'","",$cad);
if ($longitud > 0){
$cad = substr($cad,0,$longitud);
}
$cad = trim($cad," \'\t\n");
return $cad;
}

function ConvierteFecha($formato,$fecha){
	//formato : "Y-m-d"
	//formato : "d-m-Y"
	$aux = explode("/", $fecha);
	$dia = $aux[0];
	$mes = $aux[1];
	$anyo = $aux[2];
	if ($formato == "Y-m-d"){
		return $aux[2]."-".$aux[1]."-".$aux[0];
	}else{
		return $fecha;
	}
		
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



function isValidaFechaCorta($Fecha){
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

function isValidaHoraCorta($Hora){
		//  dd/mm/aaaa

$tiempo = explode(":", $Hora);
$hora = $tiempo[0];
$minuto = $tiempo[1];

if (($hora >=0) && ($hora < 25) && (is_numeric($hora))){
	return true;											
}elseif(($minuto >=0) && ($minuto < 60) && (is_numeric($minuto))){
	return true;
}else{
	return false;
}
	
}

function FechaReves($Fecha){
	if(!is_null($Fecha)){
		$date = explode("/", $Fecha);
		return date("Y-m-d",mktime(0,0,0,$date[1],$date[0],$date[2]));
	}
}

function FechaDerecho($Fecha){
	if(!is_null($Fecha)){
		$date = explode("-", $Fecha);
		return date("d/m/Y",strtotime($Fecha));
	}
}

function advancedRmdir($path) { //Elimina un directorio con todo su contendo
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

function CrearSelect($nombre,$valor,$nombreValor,$sql,$link,$tipo,$tamano,$clase,$accion,$valorSel){
	$trad = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
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
		$listadoSelect = "<select name=\"$nombre\" class=\"$clase\" $accion size=\"$tamano\" $tipo>";
		if ($valorSel != "Sin"){
		$listadoSelect .= "<option value=\"\">Todos</option>";
		}
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
			$ValorVisto = $row[$nombreValor];
			if($nombre == "MES"){$ValorVisto = strtr($row[$valor]-1, $trad);}
			if($valorSel == $row[$valor]){
				$listadoSelect .= "<option value=\"$row[$valor]\" selected>$ValorVisto</option>";
			}else{
				$listadoSelect .= "<option value=\"$row[$valor]\">$ValorVisto</option>";
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

// Borra el contendo completo de un directorio

function delete_directory($dirname) { 
	if (is_dir($dirname)) 
	$dir_handle = opendir($dirname); 
	if (!$dir_handle) 
	return false; 
	while($file = readdir($dir_handle)) { 
	if ($file != "." && $file != "..") { 
	if (!is_dir($dirname."/".$file)) 
	unlink($dirname."/".$file); 
	else 
	delete_directory($dirname.'/'.$file); 
	} 
	} 
	closedir($dir_handle); 
	rmdir($dirname); 
	return true; 
}

function Campos($tab,$conexion){
	$campos_tabla = array();
	$resultado=mysqli_query( $conexion,"SHOW FIELDS from $tab");
	$Z=mysqli_num_rows($resultado);
	$num = 0;
	while($v=mysqli_fetch_array ($resultado)){
	foreach($v as $clave=>$valor) {
	 if(!is_int($clave)){
	    if($valor==""){$valor="&nbsp;";};
		 if ($clave == "Field") {
		 $campos_tabla[$num] = $valor;
		}
	     }
	}
	$num +=1;
	}
	# liberamos memoria borrando de ella el resultado
	mysqli_free_result ($resultado);
	return $campos_tabla;
}

function hashPassword($password)
{
  $salt = "some_long_random_string";
  //encrypt the password, rotate characters by length of original password
  $len = strlen($password);
  $password = md5($password);
  $password = rotateHEX($password,$len);
  return md5($salt.$password);
}

function rotateHEX($string, $n)
{
  //for more security, randomize this string
  $chars="abcdef1234567890";
  $str="";
  for ($i=0;$i<strlen($string);$i++)
  {
    $pos = strpos($chars,$string[$i]);
    $pos += $n;
    if ($pos>=strlen($chars))
      $pos = $pos % strlen($chars);
    $str.=$chars[$pos];
  }
  return $str;
}

?>
