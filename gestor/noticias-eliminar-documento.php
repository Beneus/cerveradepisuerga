<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idDocumento = $_GET["idDocumento"];
$idNoticia = $_GET["idNoticia"];
$Archivo = $_GET["Archivo"];

	$link = ConnBDCervera();
	
	unlink ("../Noticias/$idNoticia/docs/$Archivo");
	
	$sqlDel = "DELETE FROM Documentos WHERE idDocumento = $idDocumento ";
	mysqli_query($link,$sqlDel); 
	$sqlUp = "UPDATE Noticias SET DocNoticia = 0 where idNoticia = $idNoticia ";
	mysqli_query($link,$sqlUp);  

	mysqli_close($link);
	
?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>