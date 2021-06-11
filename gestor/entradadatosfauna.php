<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$NombreComun = $_POST["NOMBRECOMUN"] ?? '';
$NombreCientifico = $_POST["NOMBRECIENTIFICO"] ?? '';
$Familia = $_POST["FAMILIA"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$Habitat = htmlentities($_POST["HABITAT"] ?? '',ENT_QUOTES);
$ErrorMsn = '';

if ($NombreComun == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nombre común.</a><br/>";
}
if ($NombreCientifico == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Nombre científico.</a><br/>";
}
if ($Familia == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Familia.</a><br/>";
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
$sqlIns = " INSERT INTO Fauna (NombreComun, NombreCientifico, Familia, Descripcion, Habitat, Fecha) VALUES ("	
				. " '". Limpiar($NombreComun,100) ."', " 	 	   	    	
				. " '". Limpiar($NombreCientifico,100)  ."', "				
				. " '". Limpiar($Familia,100) ."', "				
				. " '". $Descripcion ."', "
				. " '". $Habitat ."', "
				. " Now()) ";
	


$result = mysqli_query($link,$sqlIns);

mysqli_close($link);		


}
?>