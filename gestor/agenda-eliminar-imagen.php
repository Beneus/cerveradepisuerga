<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idImagen = $_GET["idImagen"];
$idAgenda = $_GET["idAgenda"];
$Archivo = $_GET["Archivo"];

	$link = ConnBDCervera();
	
	unlink ("../Agenda/$idAgenda/images/$Archivo");
	unlink ("../Agenda/$idAgenda/thumb/$Archivo");
	
	$sqlDel = "DELETE FROM Imagenes WHERE idImagen = $idImagen ";
	mysqli_query($link,$sqlDel); 
	$sqlUp = "UPDATE Agenda SET ImgAgenda = 0 where idAgenda = $idAgenda ";
	mysqli_query($link,$sqlUp);  

	mysqli_close($link);
	
?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>