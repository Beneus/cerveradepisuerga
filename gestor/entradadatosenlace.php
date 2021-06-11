<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$TextoEnlace = $_POST["TEXTOENLACE"];
$UrlEnlace = $_POST["URLENLACE"];
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);


if ($TextoEnlace == ""){
	$ErrorMsn = "<span class=\"errortexto\">Texto del Enlace</a><br/>";
}
if ($UrlEnlace == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Url del Enlace</a><br/>";
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
	$sqlIns = "INSERT INTO Enlaces (TextoEnlace, Descripcion, UrlEnlace, Fecha) VALUES ( "
				. "'" . Limpiar($TextoEnlace,100) . "', "
				. "'" . $Descripcion . "', "
				. "'" . Limpiar($UrlEnlace,255) . "', "
				. " Now()) ";

	
	
	$result = mysqli_query($link,$sqlIns);
	
	$sql = " Select idEnlace from Enlaces order by idEnlace desc limit 1";
	$result = mysqli_query($link,$sql);
		if (!$result)
			{
			$message = "Invalid query".mysqli_error($link)."\n";
			$message .= "whole query: " .$sql;	
			die($message);
			exit;
			}
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$idEnlace = $row["idEnlace"];
		mysqli_free_result($result);

		$sqlUp = "Update Enlaces set Orden = " & $idEnlace;
		$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>