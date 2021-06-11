<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$NombreComun = $_POST["NOMBRECOMUN"] ?? '';
$NombreCientifico = $_POST["NOMBRECIENTIFICO"] ?? '';
$Autor = $_POST["AUTOR"] ?? '';
$Clase = $_POST["CLASE"] ?? '';
$idSetasSubOrden = $_POST["IDSETASSUBORDEN"] ?? '';
if ($idSetasSubOrden =="")$idSetasSubOrden = 0;
$Clasificacion = $_POST["CLASIFICACION"] ?? '';
$Sombrero = htmlentities($_POST["SOMBRERO"] ?? '',ENT_QUOTES);
$Pie = htmlentities($_POST["PIE"] ?? '',ENT_QUOTES);
$Cuerpo = htmlentities($_POST["CUERPO"] ?? '',ENT_QUOTES);
$Laminas = htmlentities($_POST["LAMINAS"] ?? '',ENT_QUOTES);
$Himenio = htmlentities($_POST["HIMENIO"] ?? '',ENT_QUOTES);
$Exporada = htmlentities($_POST["EXPORADA"] ?? '',ENT_QUOTES);
$Carne = htmlentities($_POST["CARNE"] ?? '',ENT_QUOTES);
$EpocaHabitat = htmlentities($_POST["EPOCAHABITAT"] ?? '',ENT_QUOTES);
$Comestibilidad = htmlentities($_POST["COMESTIBILIDAD"] ?? '',ENT_QUOTES);
$Comentarios = htmlentities($_POST["COMENTARIOS"] ?? '',ENT_QUOTES);
$ErrorMsn = '';


if ($NombreComun == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nombre com&uacute;n.</a><br/>";
}
if ($NombreCientifico == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Nombre cient&iacute;fico.</a><br/>";
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
$sqlIns = " INSERT INTO Setas (NombreComun, NombreCientifico, Autor, Clasificacion, Clase, idSetasSubOrden, Sombrero, Pie, Cuerpo, Laminas, Himenio, Exporada, Carne, EpocaHabitat, Comestibilidad, Comentarios, Fecha) VALUES ("	
				. " '". Limpiar($NombreComun,100) ."', " 	 	   	    	
				. " '". Limpiar($NombreCientifico,100)  ."', "				
				. " '". Limpiar($Autor,100) ."', "	
				. " '". $Clasificacion ."', "		
				. " '". $Clase ."', "		
				. " ". $idSetasSubOrden .", "			
				. " '". $Sombrero ."', "
				. " '". $Pie ."', "
				. " '". $Cuerpo ."', "
				. " '". $Laminas ."', "
				. " '". $Himenio ."', "
				. " '". $Exporada ."', "
				. " '". $Carne ."', "
				. " '". $EpocaHabitat ."', "
				. " '". $Comestibilidad ."', "
				. " '". $Comentarios ."', "
				. " Now()) ";



$result = mysqli_query($link,$sqlIns);

mysqli_close($link);		


}
?>