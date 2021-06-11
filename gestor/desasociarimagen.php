<?php

session_start();

include("includes/funciones.php");
include("includes/Conn.php");

$tabla = $_POST["TABLA"] ?? '';
$idImagen = $_POST["IDIMAGEN"] ?? '';
$Campo = $_POST["CAMPO"] ?? '';
$CampoValor = $_POST["CAMPOVALOR"] ?? '';
$Asociacion = $_POST["ASOCIACION"] ?? '';
$ErrorMsn = '';

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

	$sqlUp = " Update $tabla set "
					. " $Asociacion = 0, "
					. " Fecha = Now() "
					. " where $Campo = $CampoValor ";

$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>