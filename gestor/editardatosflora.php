<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idFlora = $_POST["IDFLORA"] ?? '';
$NombreComun = $_POST["NOMBRECOMUN"] ?? '';
$NombreCientifico = $_POST["NOMBRECIENTIFICO"] ?? '';
$Familia = $_POST["FAMILIA"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$Habitat = htmlentities($_POST["HABITAT"] ?? '',ENT_QUOTES);
$Usos = htmlentities($_POST["USOS"] ?? '',ENT_QUOTES);
$ErrorMsn = '';

if ($NombreComun == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nombre com�n.</a><br/>";
}
if ($NombreCientifico == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Nombre cient�fico.</a><br/>";
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
$sqlUp = " Update Flora set "
				. " NombreComun = '". Limpiar($NombreComun,100) ."', " 	 	   	    				
				. " NombreCientifico = '". Limpiar($NombreCientifico,100)  ."', "		
				. " Familia = '". Limpiar($Familia,100)  ."', "	
				. " Descripcion = '".$Descripcion."', " 				
				. " Habitat = '".$Habitat."', " 					
				. " Usos = '".$Usos."' " 		 
				. " where idFlora = $idFlora ";
				


$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>