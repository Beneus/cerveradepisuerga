<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$ErrorMsn = '';
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
$idMuseo = $_POST["IDMUSEO"] ?? '';
$Museo = $_POST["MUSEO"] ?? '';
$Direccion = $_POST["DIRECCION"] ?? '';
$Latitud = $_POST["LATITUD"] ?? '';
$Longitud = $_POST["LONGITUD"] ?? '';
$CP = $_POST["CP"] ?? ''; 
$Provincia = $_POST["PROVINCIA"] ?? '';
$Telefono = $_POST["TELEFONO"] ?? '';
$Tema = $_POST["TEMA"] ?? '';
$Tipo = $_POST["TIPO"] ?? '';
$Horario = $_POST["HORARIO"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$URL = $_POST["URL"] ?? '';
$Responsable = $_POST["RESPONSABLE"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$FechaInauguracion = $_POST["FECHAINAUGURACION"] ?? '';
$FechaClausura = $_POST["FECHACLAUSURA"] ?? '';


if ($FechaInauguracion == "")$FechaInauguracion = NULL;
if ($FechaClausura == "")$FechaClausura = NULL;

if ($Museo == ""){
	$ErrorMsn = "<span class=\"errortexto\">Museo.</a><br/>";
}
if ($Direccion == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Direcci&oacute;n.</a><br/>";
}
if ($Tema == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Tema.</a><br/>";
}

if(isset($FechaInauguracion)){
	if (($FechaInauguracion != "") && ((!isValidaFechaCorta($FechaInauguracion)) or ( strlen($FechaInauguracion) != 10))){
			$ErrorMsn .= "<span class=\"errortexto\">Fecha de Inauguración.</a><br/>";
	}
}
if(isset($FechaClausura)){
	if (($FechaClausura != "") && ((!isValidaFechaCorta($FechaClausura)) or ( strlen($FechaClausura) != 10))){
			$ErrorMsn .= "<span class=\"errortexto\">Fecha de Clausura.</a><br/>";
	}
}


if($ErrorMsn != ""){
	header("Content-Type: text/html;iso-8859-1");
	echo "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
	echo "<blockquote>";
	echo $ErrorMsn;
	echo "</blockquote>";
	exit;
}


if ($ErrorMsn == "" ){	
	
// Código Postal e idArea
$sql = " Select idArea, CodigoPostal from NucleosUrbanos where idNucleoUrbano = $idNucleoUrbano ";
$link = ConnBDCervera();
$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$idArea = $row["idArea"];
	$CodigoPostal = $row["CodigoPostal"];
	mysqli_free_result($result);
	


$sqlUp = " Update Museos set "
				. " Museo = '". Limpiar($Museo,100) ."', " 	 	   	    	
				. " Direccion = '". Limpiar($Direccion,50)  ."', "				
				. " Latitud = '". Limpiar($Latitud,50)  ."', "			
				. " Longitud = '". Limpiar($Longitud,50)  ."', "	
				. " idNucleoUrbano = $idNucleoUrbano , "	 			
				. " idArea = $idArea , "	
				. " Provincia = 'PALENCIA', " 				
				. " CP = '$CodigoPostal', "	
				. " Telefono = '". Limpiar($Telefono,16) ."', "				
				. " Tema = '". Limpiar($Tema,255) ."', "
				. " Tipo = '". $Tipo ."', "		
				. " Horario = '". Limpiar($Horario,255) ."', "			
				. " Email = '". Limpiar($Email,100) ."', " 				
				. " URL = '". Limpiar($URL,255) ."', " 				
				. " Responsable = '". Limpiar($Responsable,100) ."', ";	
				
				if(is_null($FechaInauguracion)){$sqlUp .= " FechaInauguracion = NULL , " ;}else{$sqlUp .= " FechaInauguracion = '" .FechaReves($FechaInauguracion) ."', " ;}	 		
				if(is_null($FechaClausura)){$sqlUp .= " FechaClausura = NULL , " ;}else{$sqlUp .= " FechaClausura = '" .FechaReves($FechaClausura) ."', " ;}
$sqlUp .= " Descripcion = '". $Descripcion ."' "		 
				. " where idMuseo = $idMuseo ";



$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>