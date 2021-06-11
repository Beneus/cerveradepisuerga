<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


 
$Museo = $_POST["MUSEO"] ?? '';
$Direccion = $_POST["DIRECCION"] ?? '';
$Latitud = $_POST["LATITUD"] ?? '';
$Longitud = $_POST["LONGITU"] ?? '';
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
$Telefono = $_POST["TELEFONO"] ?? '';
$Tema = $_POST["TEMA"] ?? '';
$Horario = $_POST["HORARIO"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$URL = $_POST["URL"] ?? '';
$Representante = $_POST["REPRESENTANTE"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);
$FechaInauguracion = $_POST["FECHAINAUGURACION"] ?? '';
$FechaClausura = $_POST["FECHACLAUSURA"] ?? '';
$Tipo = $_POST["TIPO"] ?? '';
$ErrorMsn = '';

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
	
	
	
$sqlIns = " INSERT INTO Museos (idArea, idNucleoUrbano, Provincia, CP, Museo, Direccion, Latitud, Longitud, Telefono, Responsable, URL, Email, Tema, FechaInauguracion, FechaClausura ,Tipo ,Horario , Descripcion, Fecha) VALUES ("
				. $idArea  .", "	
				. $idNucleoUrbano  .", "	
				. " 'PALENCIA', " 
				. " '". $CodigoPostal ."', "	
				. " '". Limpiar($Museo,255) ."', " 	 	   	    	
				. " '". Limpiar($Direccion,100)  ."', "	
				. " '". Limpiar($Latitud,50)  ."', "	
				. " '". Limpiar($Longitud,50)  ."', "				
				. " '". Limpiar($Telefono,16) ."', "				
				. " '". Limpiar($Responsable,100) ."', "
				. " '". Limpiar($URL,255) ."', "			
				. " '". Limpiar($Email,100) ."', " 							
				. " '". Limpiar($Tema,50) ."', ";		
				if(is_null($FechaInauguracion)){$sqlIns .= " NULL , " ;}else{$sqlIns .= " '" .FechaReves($FechaInauguracion) ."', " ;}	 		
				if(is_null($FechaClausura)){$sqlIns .= " NULL, " ;}else{$sqlIns .= " '" .FechaReves($FechaClausura) ."', " ;}
				
$sqlIns .= " '". $Tipo ."', " 		 		
				. " '". Limpiar($Horario,255) ."', " 						
				. " '". $Descripcion ."', "		 
				. " Now()) ";
	


$result = mysqli_query($link,$sqlIns);

// obtengo el idMuseo del ultimo registro introducido

$sql = " Select idMuseo from Museos order by idMuseo desc limit 1";
$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$idMuseo = $row["idMuseo"];
	mysqli_free_result($result);




mysqli_close($link);		


}
?>