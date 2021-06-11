<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


function BorrarDirectorio($directorio) {

	$archivos = scandir($directorio); //hace una lista de archivos del directorio
	$num = count($archivos); //los cuenta
	//Los borramos
	for ($i=0; $i<=$num; $i++) {
	 unlink ($directorio."/".$archivos[$i]); 
	}
	
	//borramos el directorio
	
	rmdir ($directorio);
}

$cadEliminados = $_GET["cadEliminados"];

$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
$link = ConnBDCervera();
for ($i=0; $i< $NumEntradas; $i++){
	
	$sql = " SELECT ImgNoticia, DocNoticia FROM Noticias WHERE idNoticia = $idDirs[$i] ";
	$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$max = mysqli_num_rows($result);	
	if($max > 0){  
		$ImgNoticia = $row["ImgNoticia"]; 
		$DocNoticia = $row["DocNoticia"]; 
	}
	mysqli_free_result($result);
	
	$sqlDel = "DELETE FROM Documentos WHERE idDocumento = $ImgNoticia ";
	mysqli_query($link,$sqlDel); 
	$sqlDel = "DELETE FROM Imagenes WHERE idImagen = $ImgNoticia ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM Noticias WHERE idNoticia = $idDirs[$i] ";
	mysqli_query($link,$sqlDel); 
	echo "../Noticias/$idDirs[$i]";
	delete_directory("../Noticias/$idDirs[$i]");
}
	mysqli_close($link);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Noticias elimnar</title>
</head>
<body>
	Eliminado noticia...
	<script type="text/javascript">
window.parent.opener.location.reload();self.close();
	</script>
</body>
</html>