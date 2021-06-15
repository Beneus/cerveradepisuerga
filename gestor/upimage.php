<?php
session_start();
include("includes/funciones.php");
include("includes/imagefuncion.php");
include("includes/Conn.php");

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
var_dump($_POST);
$idAmbito = $_POST['IDAMBITO'] ?? '';
$Ambito = $_POST['AMBITO'] ?? '';
$titulos = explode(";", $_POST['TITULOS'] ?? '');
$pies = explode(";", $_POST['PIES'] ?? '');
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

if (!is_dir("../$Ambito/$idAmbito/images")) {
	mkdir("../$Ambito/$idAmbito/images");
	chmod("../$Ambito/$idAmbito/images",  0777);
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
$link = ConnBDCervera();

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
				/*
				if (strtolower($ext) == "jpg") {
					redimensionar_jpeg($fotolocation, $thumblocation, $nuevoancho, $nuevoalto, 100);
				}
				if (strtolower($ext) == "gif") {
					redimensionar_gif($fotolocation, $thumblocation, $nuevoancho, $nuevoalto, 100);
				}
				if (strtolower($ext) == "png") {
					redimensionar_png($fotolocation, $thumblocation, $ancho, $alto, 100);
				}
				*/
			} else {
				$nuevoancho = $ancho;
				$nuevoalto = $alto;
				/*
				if (strtolower($ext) == "jpg") {
					redimensionar_jpeg($fotolocation, $thumblocation, $ancho, $alto, 100);
				}
				if (strtolower($ext) == "gif") {
					redimensionar_gif($fotolocation, $thumblocation, $ancho, $alto, 100);
				}
				if (strtolower($ext) == "png") {
					redimensionar_png($fotolocation, $thumblocation, $ancho, $alto, 100);
				}
				*/
			}
			//				echo "ext".$ext."<br/>";
			//				echo "fotolocation: ". $fotolocation."<br/>";
			//				echo "thumblocation: ". $thumblocation."<br/>";
			//				echo "nuevoancho: ". $nuevoancho."<br/>";
			//				echo "nuevoalto: ". $nuevoalto."<br/>";
			//				exit;

			// fin redimension El logo

			// Se introducen los valores en la base de datos una vez subido y redimensionado la imagen

			// borramos cualquier archivo con el mismo nombre antes de volverlo a introducir
			$sqlDel = "Delete From Imagenes where Ambito = '$Ambito' and idAmbito = $idAmbito and Archivo = '$nombre' ";
			$result = mysqli_query($link, $sqlDel);

			// introducimos los datosdel nuevo archivo
			$sqlIns = " INSERT INTO Imagenes (Ambito, idAmbito, Archivo, Path, Tipo, Tamano, Ancho, Alto, AnchoThumb, AltoThumb, Titulo, Pie, Fecha) VALUES ("
				. " '" . $Ambito . "', "
				. $idAmbito  . ", "
				. " '" . Limpiar($nombre, 100) . "', "
				. " '$Ambito/$idAmbito/images', "
				. " '" . $tipo . "', "
				. " " . $tamano . ", "
				. " " . $ancho . ", "
				. " " . $alto . ", "
				. " " . $nuevoancho . ", "
				. " " . $nuevoalto . ", "
				. " '" . Limpiar($titulo, 100) . "', "
				. " '" . Limpiar($pie, 250) . "', "
				. " Now()) ";

			$result = mysqli_query($link, $sqlIns);

			$sql = "select idImagen from Imagenes where Ambito = '$Ambito' and idAmbito = $idAmbito order by idImagen desc ";
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
				$idImagen = $row["idImagen"];
			}
			$sqlUp = "Update Imagenes set Orden = $idImagen where idImagen = $idImagen ";
			$result = mysqli_query($link, $sqlUp);
		} else {
			echo $uploadErrors[$foto['error'][$i]];
		}
	} else {
		echo "La foto " . $foto['name'][$i] . " no tiene el formato adecuado";
	}
}
mysqli_close($link);

?>
<script language="javascript" type="text/javascript">
	window.top.window.stopUpload();
</script>