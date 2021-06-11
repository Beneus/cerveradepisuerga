<?php
session_start();

include("includes/funciones.php");
include("includes/Conn.php");

$ErrorMsn = '';
$idBan = $_POST["IDBAN"] ?? '';
$Publicar = $_POST["PUBLICAR"] ?? '';


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
if ($Publicar){
	$sqlUp = " Update BannersGestion set "
					. " Publicar = 1, " 	 	   	    				
					. " Fecha = Now() "						 
					. " where idBannersGestion = $idBan ";
}else{
	$sqlUp = " Update BannersGestion set "		
					. " Publicar = 0, " 	
					. " Fecha = Now() "						 
					. " where idBannersGestion = $idBan ";
}



$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>