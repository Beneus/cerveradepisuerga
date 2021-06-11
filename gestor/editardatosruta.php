<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idRuta = $_POST["IDRUTA"];
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
	$ErrorMsn .= "<span class=\"errortexto\">Epoca.</a><br/>";
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
$sqlUp = " Update Rutas set "
				. " Ruta = '". Limpiar($Ruta,100) ."', " 	 	   	    	
				. " Inicio = '". $Inicio  ."', "				
				. " LLegada = '". Limpiar($Llegada,100)  ."', "		
				. " Distancia = '". Limpiar($Distancia,100)  ."', "	
				. " Tiempo = '". Limpiar($Tiempo,100)  ."', "				
				. " Desnivel = '". Limpiar($Desnivel,100)  ."', "	
				. " Piso = '". Limpiar($Piso,100) ."', "				
				. " Dificultad = '". Limpiar($Dificultad,100) ."', "
				. " Epoca = '". Limpiar($Epoca,100) ."', "		
				. " Descripcion = '".$Descripcion."', " 				
				. " Flora = '".$Flora."', " 					
				. " Fauna = '".$Fauna."', " 		
				. " URL = '". Limpiar($URL,100) ."'  "				 
				. " where idRuta = $idRuta ";




$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>