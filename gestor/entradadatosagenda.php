<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


 
$Evento = $_POST["EVENTO"] ?? '';
$Lugar = $_POST["LUGAR"] ?? '';
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
if ($idNucleoUrbano == "")$idNucleoUrbano = 0;
$Telefono = $_POST["TELEFONO"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$URL = $_POST["URL"] ?? '';
$Contacto = $_POST["CONTACTO"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);
$idTipoEvento = $_POST["IDTIPOEVENTO"] ?? '';
$Precio = $_POST["PRECIO"] ?? '';
$HoraEvento = $_POST["HORAEVENTO"] ?? '';
$FechaEvento = $_POST["FECHAEVENTO"] ?? '';

if ($Evento == ""){
	$ErrorMsn = "<span class=\"errortexto\">Evento.</a><br/>";
}
if ($Lugar == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Lugar.</a><br/>";
}
if ($FechaEvento == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
}
if (($FechaEvento != "") && ((!isValidaFechaCorta($FechaEvento)) or ( strlen($FechaEvento) != 10))){
		$ErrorMsn .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
}
if (($HoraEvento != "") && ((!isValidaFechaCorta($HoraEvento)) or ( strlen($HoraEvento) != 5))){
		$ErrorMsn .= "<span class=\"errortexto\">Hora del evento.</a><br/>";
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
	$sqlIns = " INSERT INTO Agenda (idNucleoUrbano, Evento, Lugar, Descripcion, idTipoEvento, Precio, FechaEvento, HoraEvento, Email, URL, Telefono, Contacto, ImgDescripcion, DocAgenda, Fecha) VALUES ("																																				   				. $idNucleoUrbano  .", "
				. " '". Limpiar($Evento,255) ."', " 	 	   	    	
				. " '". Limpiar($Lugar,255)  ."', "
				. " '". $Descripcion ."', "
				. $idNucleoUrbano  .", "
				. " '". $Precio ."', "
				. " '". $FechaEvento ."', "
				. " '". $HoraEvento ."', "
				. " '". Limpiar($Email,100) ."', " 	
				. " '". Limpiar($URL,255) ."', " 	
				. " '". Limpiar($Telefono,16) ."', "
				. " '". Limpiar($Contacto,50) ."', " 	
				. "0, "
				. "0, "
				. " Now()) ";
			$ErrorMsn = $sqlIns;		

	
	
	$result = mysqli_query($link,$sqlIns);
	
	// obtengo el idDirectorio del ultimo registro introducido
	
	$sql = " Select idAgenda from Agenda order by idAgenda desc limit 1";
	$result = mysqli_query($link,$sql);
		if (!$result)
			{
			$message = "Invalid query".mysqli_error($link)."\n";
			$message .= "whole query: " .$sql;	
			die($message);
			exit;
			}
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$idAgenda = $row["idAgenda"];
		mysqli_free_result($result);


mysqli_close($link);		


}

?>