<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idSetas = $_POST["IDSETAS"] ?? '';
$NombreComun = $_POST["NOMBRECOMUN"] ?? '';
$NombreCientifico = $_POST["NOMBRECIENTIFICO"] ?? '';
$Autor = $_POST["AUTOR"] ?? '';
$Clasificacion = $_POST["CLASIFICACION"] ?? '';
$Clase = $_POST["CLASE"] ?? '';
$idSetasSubOrden = $_POST["IDSETASSUBORDEN"] ?? '';
if ($idSetasSubOrden =="")$idSetasSubOrden = 0;
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
	$ErrorMsn = "<span class=\"errortexto\">Nombre común.</a><br/>";
}
if ($NombreCientifico == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Nombre científico.</a><br/>";
}
echo $$ErrorMsn = 'ddd';
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
$sqlUp = " Update Setas set "
				. " NombreComun = '". Limpiar($NombreComun,100) ."', " 	 	   	    				
				. " NombreCientifico = '". Limpiar($NombreCientifico,100)  ."', "		
				. " Autor = '". Limpiar($Autor,100)  ."', "	
				. " Clasificacion = '".$Clasificacion."', "
				. " Clase = '".$Clase."', "
				. " idSetasSubOrden = ".$idSetasSubOrden.", "
				. " Sombrero = '".$Sombrero."', "
				. " Pie = '".$Pie."', "
				. " Cuerpo = '".$Cuerpo."', "
				. " Laminas = '".$Laminas."', "
				. " Himenio = '".$Himenio."', "
				. " Exporada = '".$Exporada."', "
				. " Carne = '".$Carne."', "
				. " EpocaHabitat = '".$EpocaHabitat."', "
				. " Comestibilidad = '".$Comestibilidad."', "
				. " Comentarios = '".$Comentarios."' " 	
				. " where idSetas = $idSetas ";



$result = mysqli_query($link,$sqlUp);

mysqli_close($link);

}
?>