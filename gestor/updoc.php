<?php
session_start();
include("includes/funciones.php");
include("includes/imagefuncion.php");
include("includes/Conn.php");

use citcervera\Model\Entities\Documentos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$documento = new Documentos();
$documentoManager = new Manager($documento);


$uploadErrors = array(
	UPLOAD_ERR_OK => 'La foto ha subido correctamente.',
	UPLOAD_ERR_INI_SIZE => 'El tama�o de la foto excede el m�ximo permitido en php.ini.',
	UPLOAD_ERR_FORM_SIZE => 'El tama�o de la foto excede el m�ximo permitido en MAX_FILE_SIZE especificada en el HTML Form.',
	UPLOAD_ERR_PARTIAL => 'la subida de la foto ha sido parcial.',
	UPLOAD_ERR_NO_FILE => 'La foto no ha subido.',
	UPLOAD_ERR_NO_TMP_DIR => 'La carpeta tmp no existe.',
	UPLOAD_ERR_CANT_WRITE => 'Error al guardar la foto.',
	UPLOAD_ERR_EXTENSION => 'La extensi�n del archivo no est� permitida.',
);

function fileExt($tipoImagen)
{
	$gd_function_suffix = array(
		'image/pjpeg' => 'JPEG',
		'image/jpeg' => 'JPEG',
		'image/gif' => 'GIF',
		'image/bmp' => 'WBMP',
		'image/png' => 'PNG',
		'image/x-png' => 'PNG'
	);
	$function_suffix = $gd_function_suffix[$tipoImagen];
	if ($function_suffix) {
		return true;
	} else {
		return false;
	}
}

//$function_suffix = $gd_function_suffix[$tipoImagen];

// Build Function name for ImageCreateFromSUFFIX 

$idAmbito = $_POST['IDAMBITO'];
$Ambito = $_POST['AMBITO'];
$titulos = $_POST['TITULOS'];
$pies = $_POST['PIES'];
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos

if (!is_dir("../$Ambito")) {
	mkdir("../$Ambito");
	chmod("../$Ambito",  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos

if (!is_dir("../$Ambito/$idAmbito")) {
	mkdir("../$Ambito/$idAmbito");
	chmod("../$Ambito/$idAmbito",  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos

if (!is_dir("../$Ambito/$idAmbito/docs")) {
	mkdir("../$Ambito/$idAmbito/docs");
	chmod("../$Ambito/$idAmbito/docs",  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


var_dump($_FILES['DOCUMENTS']);
var_dump($titulos);
var_dump($pies);
$documents = $_FILES['DOCUMENTS'];
$cantidad = count($documents['name']);

echo $cantidad;

for ($i = 0; $i < $cantidad; $i++) {
	if (!$documents['size'][$i]) {
		continue;
	}

	if ($documents['error'][$i] == UPLOAD_ERR_OK) {

		$tmp_name = $documents['tmp_name'][$i];
		$tipo = $documents['type'][$i];
		$tamano = $documents['size'][$i];
		$nombre  = $documents['name'][$i];
		$ext = substr(strrchr($nombre, "."), 1);
		$documentolocation = "../$Ambito/$idAmbito/docs/$nombre";
		$titulo = $titulos[$i];
		$pie = $pies[$i];
		// Si existe un archivo con el mismo nombre lo borro antes de introducir el nuevo
		if (file_exists($documentolocation)) {
			unlink($documentolocation);
		}
		move_uploaded_file($tmp_name, $documentolocation);

		if (is_uploaded_file($documents['tmp_name'][$i])) {
			echo "File " . $documents['tmp_name'][$i] . " uploaded successfully.\n";
			echo "Displaying contents\n";
			//readfile($foto['tmp_name'][$i]);
			move_uploaded_file($tmp_name, $documentolocation);
		} else {
			echo "Possible file upload attack: ";
			echo "filename '" . $documents['tmp_name'][$i] . "'.";
		}

		$sql = "Select * From Documentos where Ambito = '$Ambito' and idAmbito = $idAmbito and Archivo = '$nombre' ";
		$ret = $documentoManager->Query($sql, $fetch_type = 'fetch_assoc', $documento);
		$documento = new Documentos();
		if (count($ret) > 0) {
			$documento->idDocumento = $ret[0]->idDocumeto;
		}
		$documento->Ambito = $Ambito;
		$documento->idAmbito = $idAmbito;
		$documento->Archivo = $Limpiar($nombre, 100);
		$documento->Path = $Ambito . '/' . $idAmbito . '/docs';
		$documento->Tipo = $tipo;
		$documento->Tamano = $tamano;
		$documento->Titulo = Limpiar($titulo, 100);
		$documento->Pie = Limpiar($pie, 250);
		if (count($ret) > 0) {
			$documento->Orden = $ret[0]->Orden;
		}
		$documento->Fecha = date("Y-m-d H:m:s");
		$documentoManager->Save($documento);
		if (count($ret) === 0) {
			$lastInsertedId = $documentoManager->GetLastInsertedId();
			$documento->Orden = $lastInsertedId;
			$documentoManager->Save($documento);
		}
	}else {
		echo $uploadErrors[$documents['error'][$i]];
	}
}



/*
$link = ConnBDCervera();
for ($i = 0; $i < $cantidad; $i++) {
	if (!$documento['size'][$i])
		continue;
	if ($documento['error'][$i] == UPLOAD_ERR_OK) {
		//echo "no hay error ";
		$tmp_name = $documento['tmp_name'][$i];
		$tipo = $documento['type'][$i];
		$tamano = $documento['size'][$i];
		$nombre  = $documento['name'][$i];
		$ext = substr(strrchr($nombre, "."), 1);
		$documentolocation = "../$Ambito/$idAmbito/docs/$nombre";
		$titulo = $titulos[$i];
		$pie = $pies[$i];
		// Si existe un archivo con el mismo nombre lo borro antes de introducir el nuevo
		if (file_exists($documentolocation)) {
			unlink($documentolocation);
		}

		move_uploaded_file($tmp_name, $documentolocation);

		if (is_uploaded_file($documento['tmp_name'][$i])) {
			echo "File " . $documento['tmp_name'][$i] . " uploaded successfully.\n";
			echo "Displaying contents\n";
			//readfile($foto['tmp_name'][$i]);
			move_uploaded_file($tmp_name, $documentolocation);
		} else {
			echo "Possible file upload attack: ";
			echo "filename '" . $documento['tmp_name'][$i] . "'.";
		}

		// Se introducen los valores en la base de datos una vez subido y redimensionado la imagen

		// borramos cualquier archivo con el mismo nombre antes de volverlo a introducir
		$sqlDel = "Delete From Documentos where Ambito = '$Ambito' and idAmbito = $idAmbito and Archivo = '$nombre' ";
		$result = mysqli_query($link, $sqlDel);

		// introducimos los datosdel nuevo archivo
		$sqlIns = " INSERT INTO Documentos (Ambito, idAmbito, Archivo, Path, Tipo, Tamano, Titulo, Pie, Fecha) VALUES ("
			. " '" . $Ambito . "', "
			. $idAmbito  . ", "
			. " '" . Limpiar($nombre, 100) . "', "
			. " '$Ambito/$idAmbito/docs', "
			. " '" . $tipo . "', "
			. " " . $tamano . ", "
			. " '" . Limpiar($titulo, 100) . "', "
			. " '" . Limpiar($pie, 250) . "', "
			. " Now()) ";

		$result = mysqli_query($link, $sqlIns);

		$sql = "select idDoc from Documentos where Ambito = '$Ambito' and idAmbito = $idAmbito order by idDoc desc ";
		$result = mysqli_query($link, $sql);
		if (!$result) {
			$message = "Invalid query" . mysqli_error($link) . "\n";
			$message .= "whole query: " . $sql;
			die($message);
			exit;
		}
		$max = mysqli_num_rows($result);
		if ($max > 0) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$idDoc = $row["idDoc"];
		}
		$sqlUp = "Update Documentos set Orden = $idDoc where idDoc = $idDoc ";
		$result = mysqli_query($link, $sqlUp);
	} else {
		echo $uploadErrors[$documento['error'][$i]];
	}
}
mysqli_close($link);
*/
