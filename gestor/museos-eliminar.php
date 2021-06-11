<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$cadEliminados = $_GET["cadEliminados"];

$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
$link = ConnBDCervera();
for ($i=0; $i< $NumEntradas; $i++){
	
	
	$sqlDel = "DELETE FROM MuseosImagenes WHERE idMuseo = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);   
	$sqlDel = "DELETE FROM Museos WHERE idMuseo = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	// eliminamos el directorio de imagenes del Museos
	$path = "../Museos/".$idDirs[$i];
	advancedRmdir($path);
}
	
	mysqli_close($link);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Museos eliminar</title>
</head>
<body>
	Eliminado Entrada...
	<script type="text/javascript">
window.parent.opener.location.reload();self.close();
	</script>
</body>
</html>