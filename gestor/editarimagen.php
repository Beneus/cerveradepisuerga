<?php
session_start();

include("includes/funciones.php");
include("includes/Conn.php");

$idImagen = $_POST["IDIMAGEN"] ?? '';
$Titulo = $_POST["TITULO"] ?? '';
$Pie = $_POST["PIE"] ?? '';
$Campo  = $_POST["CAMPO"] ?? '';
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
if ($Campo == "TITULO"){
	$sqlUp = " Update Imagenes set "
					. " Titulo = '". Limpiar($Titulo,100) ."', " 	 	   	    				
					. " Fecha = Now() "						 
					. " where idImagen = $idImagen ";
}else{
	$sqlUp = " Update Imagenes set "		
					. " Pie = '". Limpiar($Pie,250)  ."', "		
					. " Fecha = Now() "						 
					. " where idImagen = $idImagen ";
}


$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>