<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\Documentos;
use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Managers\Manager;


$agendaEntity = new Agenda();
$agendaManager = new Manager($agendaEntity);
$documentos = new Documentos();
$documentoManager = new Manager($documentos);
$imagenes = new Imagenes();
$imagenManager = new Manager($imagenes);


$cadEliminados = $_GET["cadEliminados"];
$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
for ($i=0; $i< $NumEntradas; $i++){
	
	$agenda = $agendaManager->Get($idDirs[$i]);
	$imgAgenda = $agenda->ImgAgenda; 
	$docAgenda = $agenda->DocAgenda; 

	$documentoManager->Delete($docAgenda);
	$imagenManager->Delete($docAgenda);
	$agendaManager->Delete($idDirs[$i]);

	// Borramos el directorio completo
	delete_directory("../Agenda/$idDirs[$i]");
	
}
	
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