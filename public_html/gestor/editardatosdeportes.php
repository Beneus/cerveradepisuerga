<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$ErrorMsn = '';
$idDeporte = $_POST["IDDEPORTE"] ?? '';
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
		$ErrorMsn .= "<span class=\"errortexto\">Fecha fnalicación.</a><br/>";
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
}else{	

$link = ConnBDCervera();
$sqlUp = " Update Deportes set "
				." idNucleoUrbano = ".$idNucleoUrbano .", " 
				." ActoDeportivo  = '".Limpiar($ActoDeportivo,255) ."', ";
				
				if(!is_null($FechaInicio)){$sqlUp .= "FechaInicio = '".FechaReves($FechaInicio)."',";}	
				if(!is_null($FechaFinal)){$sqlUp .= "FechaFinal = '".FechaReves($FechaFinal)."',";}	
				if(!is_null($Hora)){$sqlUp .= "Hora = '".$Hora."',";}	
			
$sqlUp .= " Lugar = '".Limpiar($Lugar,255) ."', " 
				." Contacto = '".Limpiar($Contacto,100) ."', " 
				." Telefono = '".Limpiar($Telefono,16) ."', " 
				." Email = '".Limpiar($Email,100) ."', " 
				." Url = '".Limpiar($Url,255) ."', " 
				." Precio = '".Limpiar($Precio,50) ."', " 
				." Descripcion = '".$Descripcion ."', " 
				." Fecha = Now()"
				." where idDeporte = ". $idDeporte ;



$result = mysqli_query($link,$sqlUp);


mysqli_close($link);		


}
?>