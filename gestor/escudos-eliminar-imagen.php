<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idImagen = $_GET["idImagen"];
$idEscudo = $_GET["idEscudo"];
$Archivo = $_GET["Archivo"];

	$link = ConnBDCervera();
	
	unlink ("../Escudos/$idEscudo/images/$Archivo");
	unlink ("../Escudos/$idEscudo/thumb/$Archivo");
	
	$sqlDel = "DELETE FROM Imagenes WHERE idImagen = $idImagen ";
	mysqli_query($link,$sqlDel); 
	$sqlUp = "UPDATE Escudos SET ImgDescripcion = 0 where idEscudo = $idEscudo ";
	mysqli_query($link,$sqlUp);  

	mysqli_close($link);
	
?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>