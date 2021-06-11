<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$cadEliminados = $_GET["cadEliminados"];
$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
$link = ConnBDCervera();
for ($i=0; $i< $NumEntradas; $i++){
	
	$sqlDel = "DELETE FROM Documentos WHERE Ambito = 'Deportes' and idAmbito = $idDirs[$i] ";
	mysqli_query($link,$sqlDel); 
	$sqlDel = "DELETE FROM Imagenes WHERE Ambito = 'Deportes' and idAmbito = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	$sqlDel = "DELETE FROM Deportes WHERE idDeporte = $idDirs[$i] ";
	mysqli_query($link,$sqlDel); 
	// Borramos el directorio completo
	delete_directory("../Agenda/$idDirs[$i]");
}
	mysqli_close($link);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Agenda eliminar</title>
</head>
<body>
	Eliminado evento de la agenda...
	<script type="text/javascript">

		window.parent.opener.location.reload();self.close();

	</script>
</body>
</html>