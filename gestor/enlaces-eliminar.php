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
	
	$sqlDel = "DELETE FROM Enlaces WHERE idEnlace = $idDirs[$i] ";
	mysqli_query($link,$sqlDel); 
	
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