<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$cadEliminados = $_GET["cadEliminados"];

$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
$link = ConnBDCervera();
for ($i=0; $i< $NumEntradas; $i++){
	  
	$sqlDel = "DELETE FROM UsuariosAcceso WHERE idUsuariosAcceso = $idDirs[$i] ";
	mysqli_query($link,$sqlDel);  

}
	mysqli_close($link);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Monumentos eliminar</title>
</head>
<body>
	Eliminado Usuario...
	<script type="text/javascript">

		window.parent.opener.location.reload();self.close();

	</script>
</body>
</html>