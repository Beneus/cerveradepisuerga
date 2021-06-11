<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idDocumento = $_GET["idDocumento"];
$idAgenda = $_GET["idAgenda"];
$Archivo = $_GET["Archivo"];

	$link = ConnBDCervera();
	
	unlink ("../Agenda/$idAgenda/docs/$Archivo");
	
	$sqlDel = "DELETE FROM Documentos WHERE idDocumento = $idDocumento ";
	mysqli_query($link,$sqlDel); 
	$sqlUp = "UPDATE Agenda SET DocAgenda = 0 where idAgenda = $idAgenda ";
	mysqli_query($link,$sqlUp);  

	mysqli_close($link);
	
?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>