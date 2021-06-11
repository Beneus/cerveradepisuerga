<?php
session_start();

include("includes/funciones.php");
include("includes/Conn.php");

$idDoc = $_POST["IDDOC"];
$Titulo = $_POST["TITULO"];
$Pie = $_POST["PIE"];
$Campo  = $_POST["CAMPO"];

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
	$sqlUp = " Update Documentos set "
					. " Titulo = '". Limpiar($Titulo,100) ."', " 	 	   	    				
					. " Fecha = Now() "						 
					. " where idDoc = $idDoc ";
}else{
	$sqlUp = " Update Documentos set "		
					. " Pie = '". Limpiar($Pie,250)  ."', "		
					. " Fecha = Now() "						 
					. " where idDoc = $idDoc ";
}


$result = mysqli_query($link,$sqlUp);
mysqli_close($link);		


}
?>