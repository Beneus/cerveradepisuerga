<?php
session_start();
include("includes/funciones.php");
include("includes/imagefuncion.php");
include("includes/Conn.php");

use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;


const __FILESPATH__ = 'files/';
$_ROOTPATH = $_SERVER['DOCUMENT_ROOT'] . '/' .  __FILESPATH__;


$dc = new DataCarrier();
$imagen = new Imagenes();
$documentManager = new Manager($imagen);

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

// $function_suffix = $gd_function_suffix[$tipoImagen];

// Build Function name for ImageCreateFromSUFFIX 
$idAmbito = $_POST['IDAMBITO'] ?? '';
$Ambito = $_POST['AMBITO'] ?? '';
$titulos = $_POST['TITULOS'] ?? '';
$pies = $_POST['PIES'] ?? '';
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos



if (!is_dir($_ROOTPATH . $Ambito)) {
	mkdir($_ROOTPATH . $Ambito);
	chmod($_ROOTPATH . $Ambito,  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos

if (!is_dir($_ROOTPATH . "$Ambito/$idAmbito")) {
	mkdir($_ROOTPATH . "$Ambito/$idAmbito");
	chmod($_ROOTPATH . "$Ambito/$idAmbito",  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos

if (!is_dir($_ROOTPATH . "$Ambito/$idAmbito/images")) {
	mkdir($_ROOTPATH . "$Ambito/$idAmbito/images");
	chmod($_ROOTPATH . "$Ambito/$idAmbito/images",  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos thumb
if (!is_dir("../$Ambito/$idAmbito/thumb")) {
	mkdir("../$Ambito/$idAmbito/thumb");
	chmod("../$Ambito/$idAmbito/thumb",  0777);
	//sleep(1);
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


$foto = $_FILES['foto'] ?? '';
$cantidad = count($foto['name']);

for ($i = 0; $i < $cantidad; $i++) {
	if (!$foto['size'][$i])
		continue;
	if (fileExt($foto['type'][$i])) {
		if ($foto['error'][$i] == UPLOAD_ERR_OK) {
			//echo "no hay error ";
			$tmp_name = $foto['tmp_name'][$i];
			$tipo = $foto['type'][$i];
			$tamano = $foto['size'][$i];
			$nombre  = $foto['name'][$i];
			$ext = substr(strrchr($nombre, "."), 1);
			$fotolocation = "../$Ambito/$idAmbito/images/$nombre";
			$thumblocation = "../$Ambito/$idAmbito/thumb/$nombre";
			$titulo = $titulos[$i];
			$pie = $pies[$i];
			// Si existe un archivo con el mismo nombre lo borro antes de introducir el nuevo
			if (file_exists($fotolocation)) {
				unlink($fotolocation);
			}

			move_uploaded_file($tmp_name, $fotolocation);


			if (is_uploaded_file($foto['tmp_name'][$i])) {
				echo "File " . $foto['tmp_name'][$i] . " uploaded successfully.\n";
				echo "Displaying contents\n";
				//readfile($foto['tmp_name'][$i]);
				move_uploaded_file($tmp_name, $fotolocation);
			} else {
				echo "Possible file upload attack: ";
				echo "filename '" . $foto['tmp_name'][$i] . "'.";
			}

			// redimension El logo
			list($ancho, $alto) = getimagesize($fotolocation);
var_dump($ancho);

			if (($ancho > 250) || ($alto > 250)) {
				if ($ancho > $alto) {
					$porcentaje = (250 / $ancho);
					$nuevoancho = floor(($ancho * floor($porcentaje * 100)) / 100);
					$nuevoalto = floor(($alto * floor($porcentaje * 100)) / 100);
				}
				if ($ancho == $alto) {
					$nuevoancho = 250;
					$nuevoalto = 250;
				}
				if ($ancho < $alto) {
					$porcentaje = (250 / $alto);
					$nuevoancho = floor(($ancho * floor($porcentaje * 100)) / 100);
					$nuevoalto = floor(($alto * floor($porcentaje * 100)) / 100);
				}
			} else {
				$nuevoancho = $ancho;
				$nuevoalto = $alto;
				
			}
			

			$sql = "Select * From Imagenes where Ambito = '$Ambito' and idAmbito = $idAmbito and Archivo = '$nombre' ";
			$ret = $documentManager->Query($sql, $fetch_type = 'fetch_assoc', $imagen);
			$imagen = new Imagenes();

			if (count($ret) > 0) {
				$imagen->idImagen = $ret[0]['idImagen'];
			}

			$imagen->Ambito = $Ambito;
			$imagen->idAmbito = $idAmbito;
			$imagen->Archivo = Limpiar($nombre, 100);
			$imagen->Path = $Ambito . '/' . $idAmbito . '/images';
			$imagen->Tipo = $tipo;
			$imagen->Tamano = $tamano;
			$imagen->Ancho = $ancho;
			$imagen->Alto = $alto;
			$imagen->AnchoThumb = $nuevoancho;
			$imagen->AltoThumb= $nuevoalto;
			$imagen->Titulo = Limpiar(trim($titulo), 100);
			$imagen->Pie = Limpiar(trim($pie), 250);
			$imagen->Publicar = 0;
			
			if (count($ret) > 0) {
				$imagen->Orden = $ret[0]['Orden'];
			}
			
			$imagen->Fecha = date("Y-m-d H:m:s");
			var_dump($imagen);
			$rest = $documentManager->Save($imagen);

			if (count($ret) == 0) {
			
				$lastInsertedId = $documentManager->GetLastInsertedId();
				$imagen->idImagen = $lastInsertedId;
				$imagen->Orden = $lastInsertedId;
				var_dump($lastInsertedId);
				$rest = $documentManager->Save($imagen);

			}

		} else {
			echo $uploadErrors[$foto['error'][$i]];
		}
	} else {
		echo "La foto " . $foto['name'][$i] . " no tiene el formato adecuado";
	}
}