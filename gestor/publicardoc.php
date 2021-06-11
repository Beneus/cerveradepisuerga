<?php
session_start();

include("includes/funciones.php");
include("includes/Conn.php");

$idDoc = $_POST["IDDOC"] ?? '';
$Publicar = $_POST["PUBLICAR"] ?? '';
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
if ($Publicar){
	$sqlUp = " Update Documentos set "
					. " Publicar = 1, " 	 	   	    				
					. " Fecha = Now() "						 
					. " where idDoc = $idDoc ";
}else{
	$sqlUp = " Update Documentos set "		
					. " Publicar = 0, " 	
					. " Fecha = Now() "						 
					. " where idDoc = $idDoc ";
}



$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>