<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idEnlace = $_POST["IDENLACE"];
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
$sqlUp = " Update Enlaces set "
				. " TextoEnlace = '". Limpiar($TextoEnlace,100) ."', " 	 	   	    				
				. " UrlEnlace = '". Limpiar($UrlEnlace,255)  ."', "		
				. " Descripcion = '".$Descripcion."' " 				
				. " where idEnlace = $idEnlace ";
				


$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>