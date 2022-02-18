<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\Documentos;
use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Managers\DataCarrier;


$entity = new Agenda();
$entityManager = new Manager($entity);
$documentos = new Documentos();
$documentoManager = new Manager($documentos);
$imagenes = new Imagenes();
$imagenManager = new Manager($imagenes);


$cadEliminados = $_GET["cadEliminados"];
$idDirs = explode("-",$cadEliminados);
$NumEntradas = count($idDirs);
for ($i=0; $i< $NumEntradas; $i++){
	
	$dc = new DataCarrier();

	$sql = "select * from Imagenes where Ambito = 'Agenda' and idAmbito = " . $idDirs[$i];
	$image = $imagenManager->Query($sql, 'fetch_object', new Imagenes());
	$dc->Set($image, 'Imagenes');

	$sql = "select * from Documentos where Ambito = 'Agenda' and idAmbito = " . $idDirs[$i];
	$documentos = $documentoManager->Query($sql, 'fetch_object', new Documentos());
	$dc->Set($documentos, 'Documentos');

	foreach ($dc->GetEntities('Imagenes') as $img){
		$imagenManager->Delete($img->idImagen);
	}
	foreach ($dc->GetEntities('Documentos') as $doc){
		$documentoManager->Delete($doc->idDoc);
	}

	$entityManager->Delete($idDirs[$i]);
	// Borramos el directorio completo
	delete_directory("../files/Agenda/$idDirs[$i]");
	
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