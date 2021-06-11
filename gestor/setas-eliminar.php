<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$cadEliminados = $_GET["cadEliminados"];

$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
$link = ConnBDCervera();
for ($i=0; $i< $NumEntradas; $i++){
	
	$sqlDel = "DELETE FROM Imagenes WHERE Ambito = 'Setas' and idAmbito = $idDirs[$i] ";
	mysqli_query($link,$sqlDel); 
	$sqlDel = "DELETE FROM Setas WHERE idSetas = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  
	delete_directory("../Setas/$idDirs[$i]"); 

}
	mysqli_close($link);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Flora eliminar</title>
</head>
<body>
	Eliminado Entrada...
	<script type="text/javascript">
window.parent.opener.location.reload();self.close();
	</script>
</body>
</html>