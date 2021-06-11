<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$Nombre = $_POST["NOMBRE"];
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"];
$Direccion = $_POST["DIRECCION"];
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);


if ($Nombre == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nombre</a><br/>";
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
$sqlIns = " INSERT INTO Escudos (Nombre, Direccion, idNucleoUrbano, Descripcion, imgDescripcion, Fecha) VALUES ("	
				. " '". Limpiar($Nombre,255) ."', " 	 	   	    	
				. " '". Limpiar($Direccion,255)  ."', "				
				. $idNucleoUrbano .", "				
				. " '". $Descripcion ."', "
				. " 0, "
				. " Now()) ";



$result = mysqli_query($link,$sqlIns);


$sql = "SELECT max(idEscudo) as idEscudo FROM Escudos";
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
	$idEscudo = $row["idEscudo"];
	
		
}//if($max > 0){

mysqli_close($link);		


}
?>