<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
$NombreNucleoUrbano = $_POST["NOMBRENUCLEOURBANO"] ?? '';
$idArea = $_POST["IDAREA"] ?? '';
$CodigoPostal = $_POST["CODIGOPOSTAL"] ?? '';
$Altitud = $_POST["ALTITUD"] ?? '';
$Latitud = $_POST["LATITUD"] ?? '';
$Longitud = $_POST["LONGITUD"] ?? '';
$GoogleMaps = htmlentities($_POST["GOOGLEMAPS"] ?? '',ENT_QUOTES);
$Historia = htmlentities($_POST["HISTORIA"] ?? '',ENT_QUOTES);
$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$ErrorMsn = '';

if ($NombreNucleoUrbano == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nucleo urbano.</a><br/>";
}
if ($CodigoPostal == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Código Postal.</a><br/>";
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
$sqlUp = " Update NucleosUrbanos set "
				. " NombreNucleoUrbano = '". Limpiar($NombreNucleoUrbano,100) ."', " 	 	   	    	
				. " idArea = ". $idArea  .", "				
				. " CodigoPostal = '". Limpiar($CodigoPostal,5)  ."', "		
				. " Altitud = '". Limpiar($Altitud,100)  ."', "	
				. " Latitud = '". Limpiar($Latitud,100)  ."', "				
				. " Longitud = '". Limpiar($Longitud,100)  ."', "	
				. " GoogleMaps = '". $GoogleMaps ."', "				
				. " Historia = '". $Historia ."', "
				. " Descripcion = '". $Descripcion ."', "
				. " Fecha = Now() "						 
				. " where idNucleoUrbano = $idNucleoUrbano ";



$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>