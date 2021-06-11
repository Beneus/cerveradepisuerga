<?php
session_start();

include("includes/funciones.php");
include("includes/Conn.php");

$idBanner = $_POST["IDBANNER"];
$TextoBanner = $_POST["TEXTOBANNER"];
$UrlBanner = str_replace("_38_","&",$_POST["URLBANNER"]);
$Campo  = $_POST["CAMPO"];
$ErrorMsn = "";


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
if ($Campo == "TEXTOBANNER"){
	$sqlUp = " Update Banners set "
					. " TextoBanner = '". Limpiar($TextoBanner,255) ."', " 	 	   	    				
					. " Fecha = Now() "						 
					. " where idBanner = $idBanner ";
}else{
	$sqlUp = " Update Banners set "		
					. " UrlBanner = '". Limpiar(urlencode($UrlBanner),255)  ."', "		
					. " Fecha = Now() "						 
					. " where idBanner = $idBanner ";
}


$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>