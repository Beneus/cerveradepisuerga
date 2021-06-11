<?php
session_start();

include("includes/funciones.php");
include("includes/Conn.php");
$ErrorMsn = '';
$idImagen = $_POST["IDIMAGEN"] ?? '';
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
	$sqlUp = " Update Imagenes set "
					. " Publicar = 1, " 	 	   	    				
					. " Fecha = Now() "						 
					. " where idImagen = $idImagen ";
}else{
	$sqlUp = " Update Imagenes set "		
					. " Publicar = 0, " 	
					. " Fecha = Now() "						 
					. " where idImagen = $idImagen ";
}



$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>