<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$Ruta = $_POST["RUTA"];
$Inicio = $_POST["INICIO"];
$Llegada = $_POST["LLEGADA"];
$Distancia = $_POST["DISTANCIA"];
$Tiempo = $_POST["TIEMPO"];
$Desnivel = $_POST["DESNIVEL"];
$Piso = $_POST["PISO"];
$Dificultad = $_POST["DIFICULTAD"];
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);
$Flora = htmlentities($_POST["FLORA"],ENT_QUOTES);
$Fauna = htmlentities($_POST["FAUNA"],ENT_QUOTES);
$Epoca = $_POST["EPOCA"];
$URL = $_POST["URL"];

if ($Ruta == ""){
	$ErrorMsn = "<span class=\"errortexto\">Ruta.</a><br/>";
}
if ($Inicio == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Inicio.</a><br/>";
}
if ($Llegada == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Llegada.</a><br/>";
}
if ($Distancia == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Distancia.</a><br/>";
}
if ($Tiempo == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Tiempo.</a><br/>";
}
if ($Desnivel == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Desnivel.</a><br/>";
}
if ($Piso == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Piso.</a><br/>";
}
if ($Dificultad == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Dificultad.</a><br/>";
}
if ($Epoca == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Piso.</a><br/>";
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
$sqlIns = " INSERT INTO Rutas (Ruta, Inicio, Llegada, Distancia, Tiempo, Desnivel, Piso, Dificultad,  Epoca, Descripcion, Flora, Fauna, URL, Fecha) VALUES ("	
				. " '". Limpiar($Ruta,100) ."', " 	 	   	    	
				. " '". Limpiar($Inicio,100)  ."', "				
				. " '". Limpiar($Llegada,100) ."', "				
				. " '". Limpiar($Distancia,100) ."', "
				. " '". Limpiar($Tiempo,100) ."', "
				. " '". Limpiar($Desnivel,100) ."', "			
				. " '". Limpiar($Piso,100) ."', " 							
				. " '". Limpiar($Dificultad,100) ."', " 	
				. " '". Limpiar($Epoca,100) ."', "	
				. " '". $Descripcion ."', "
				. " '". $Flora ."', "
				. " '". $Fauna ."', "
				. " '". Limpiar($URL,255) ."', " 								 
				. " Now()) ";
	



$result = mysqli_query($link,$sqlIns);

mysqli_close($link);		


}
?>