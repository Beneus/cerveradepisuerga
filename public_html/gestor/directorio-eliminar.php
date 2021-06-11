<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$cadEliminados = $_GET["cadEliminados"];

$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
$link = ConnBDCervera();
for ($i=0; $i< $NumEntradas; $i++){
	
	
	$sqlDel = "DELETE FROM DirectorioSubServicio WHERE idDirectorio = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM DirectorioServicio WHERE idDirectorio = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM DirectorioNucleoUrbano WHERE idDirectorio = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM DirectorioImagen WHERE idDirectorio = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM DirectorioAreas WHERE idDirectorio = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM Directorio WHERE idDirectorio = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	

}
	mysqli_close($link);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Directorio eliminar</title>
</head>
<body>
	Eliminado Entrada...
	<script type="text/javascript">
window.parent.opener.location.reload();self.close();
	</script>
</body>
</html>