<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$ErrorMsn = '';
$ActoDeportivo = $_POST["ACTODEPORTIVO"] ?? '';
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
if ($idNucleoUrbano == "")$idNucleoUrbano = 0;
$Lugar = $_POST["LUGAR"] ?? '';
$Hora = $_POST["HORA"] ?? '';
if ($Hora == "")$Hora = NULL;
$FechaInicio = $_POST["FECHAINICIO"] ?? '';
if ($FechaInicio == "")$FechaInicio = NULL;
$FechaFinal = $_POST["FECHAFINAL"] ?? '';
if ($FechaFinal == "")$FechaFinal = NULL;
$Contacto = $_POST["CONTACTO"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$Url = $_POST["URL"] ?? '';
$Precio = $_POST["PRECIO"] ?? '';
$Telefono = $_POST["TELEFONO"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);


if ($ActoDeportivo == ""){
	$ErrorMsn = "<span class=\"errortexto\">Acto Deportivo</a><br/>";
}
if ($Lugar == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Lugar.</a><br/>";
}
if ($FechaInicio == ""){
		$ErrorMsn .= "<span class=\"errortexto\">Fecha del inicio.</a><br/>";
}
if (($FechaInicio != "") && ((!isValidaFechaCorta($FechaInicio)) or ( strlen($FechaInicio) != 10))){
		$ErrorMsn .= "<span class=\"errortexto\">Fecha del inicio.</a><br/>";
}
if (($FechaFinal != "") && ((!isValidaFechaCorta($FechaFinal)) or ( strlen($FechaFinal) != 10))){
		$ErrorMsn .= "<span class=\"errortexto\">Fecha fnalicaci&oacute;n.</a><br/>";
}
if (($Hora != "") && ((!isValidaHoraCorta($Hora)) or ( strlen($Hora) != 5))){
		$ErrorMsn .= "<span class=\"errortexto\">Hora del acto deportivo.</a><br/>";
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
$link = ConnBDCervera();
$sqlIns = " INSERT INTO Deportes (idNucleoUrbano, ActoDeportivo , FechaInicio, FechaFinal, Hora, Lugar, Contacto, Telefono, Email, Url, Precio, Descripcion, ImgDescripcion, DocDeporte, Fecha ) VALUES ("	
				. $idNucleoUrbano .", "		
				. " '". Limpiar($ActoDeportivo,255) ."', ";
				if(is_null($FechaInicio)){$sqlIns .= " NULL , " ;}else{$sqlIns .= " '" .FechaReves($FechaInicio) ."', " ;}	 		
				if(is_null($FechaFinal)){$sqlIns .= " NULL, " ;}else{$sqlIns .= " '" .FechaReves($FechaFinal) ."', " ;}
				if(is_null($Hora)){$sqlIns .= " NULL, " ;}else{$sqlIns .= " '" .$Hora ."', " ;}
$sqlIns .=" '". Limpiar($Lugar,255)  ."', "		
				. " '". Limpiar($Contacto,100)  ."', "	
				. " '". Limpiar($Telefono,16)  ."', "	
				. " '". Limpiar($Email,100)  ."', "	
				. " '". Limpiar($Url,255)  ."', "	
				. " '". Limpiar($Precio,50)  ."', "	
				. " '". $Descripcion ."', "
				. " 0, "
				. " 0, "
				. " Now()) ";



$result = mysqli_query($link,$sqlIns);

$sql = "SELECT max(idDeporte) as idDeporte FROM Deportes";
$result = mysqli_query($link,$sql);
if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($result);	
if($max > 0){
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$idDeporte = $row["idDeporte"];
	
		
}//if($max > 0){

mysqli_close($link);		


}
?>