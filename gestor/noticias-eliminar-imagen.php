<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idImagen = $_GET["idImagen"];
$idNoticia = $_GET["idNoticia"];
$Archivo = $_GET["Archivo"];

	$link = ConnBDCervera();
	
	unlink ("../Noticias/$idNoticia/images/$Archivo");
	unlink ("../Noticias/$idNoticia/thumb/$Archivo");
	
	$sqlDel = "DELETE FROM Imagenes WHERE idImagen = $idImagen ";
	mysqli_query($link,$sqlDel); 
	$sqlUp = "UPDATE Noticias SET ImgNoticia = 0 where idNoticia = $idNoticia ";
	mysqli_query($link,$sqlUp);  

	mysqli_close($link);
	
?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>