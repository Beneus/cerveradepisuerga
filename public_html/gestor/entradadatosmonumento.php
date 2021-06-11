<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idNucleoUrbano = $_POST["IDNUCLEOURBANO"];
$Monumento = $_POST["MONUMENTO"];
$Direccion = $_POST["DIRECCION"];
$Telefono = $_POST["TELEFONO"];
$Responsable = $_POST["RESPONSABLE"];
$URL = $_POST["URL"];
$Email = $_POST["EMAIL"];
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);
$FechaInauguracion = $_POST["FECHAINAUGURACION"];
$FechaClausura = $_POST["FECHACLAUSURA"];
$Horario = $_POST["HORARIO"];
$Latitud = $_POST["LATITUD"];
$Longitud = $_POST["LONGITUD"];
$Tipo = $_POST["TIPO"];
if ($FechaInauguracion == "")$FechaInauguracion = NULL;
if ($FechaClausura == "")$FechaClausura = NULL;



if ($Monumento == ""){
	$ErrorMsn = "<span class=\"errortexto\">Monumento.</a><br/>";
}
if ($Direccion == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Direcci&oacute;n.</a><br/>";
}
if ($Horario == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Horario.</a><br/>";
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
	
$sqlIns = " INSERT INTO Monumentos (idNucleoUrbano,idArea,Monumento,Direccion,Telefono,Responsable,URL,Email,Descripcion,FechaInauguracion,FechaClausura,Tipo,Horario,Latitud,Longitud,ImgDescripcion,Fecha) VALUES ("
				. $idNucleoUrbano  .", "	
				. $idArea  .", "	
				. " '". Limpiar($Monumento,50) ."', " 	 	   	    	
				. " '". Limpiar($Direccion,100)  ."', "	
				. " '". Limpiar($Telefono,16)  ."', "	
				. " '". Limpiar($Responsable,100)  ."', "				
				. " '". Limpiar($URL,255) ."', "				
				. " '". Limpiar($Email,100) ."', "		
				. " '". $Descripcion ."', ";
				if(is_null($FechaInauguracion)){$sqlIns .= " NULL , " ;}else{$sqlIns .= " '" .FechaReves($FechaInauguracion) ."', " ;}	 		
				if(is_null($FechaClausura)){$sqlIns .= " NULL, " ;}else{$sqlIns .= " '" .FechaReves($FechaClausura) ."', " ;}	 					
$sqlIns .= " '". $Tipo ."', " 
				. " '". Limpiar($Horario,100) ."', " 	
				. " '". Limpiar($Latitud,50) ."', " 
				. " '". Limpiar($Longitud,50) ."', " 	 		
				. " 0, " 							 
				. " Now()) ";
	



$result = mysqli_query($link,$sqlIns);


mysqli_close($link);		


}
?>