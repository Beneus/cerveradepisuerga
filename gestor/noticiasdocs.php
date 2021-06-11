<?php
session_start();
include("includes/funciones.php");
include("includes/imagefuncion.php");
include("includes/Conn.php");

$uploadErrors = array(
    UPLOAD_ERR_OK => 'La foto ha subido correctamente.',
    UPLOAD_ERR_INI_SIZE => 'El tamaño de la foto excede el máximo permitido en php.ini.',
    UPLOAD_ERR_FORM_SIZE => 'El tamaño de la foto excede el máximo permitido en MAX_FILE_SIZE especificada en el HTML Form.',
    UPLOAD_ERR_PARTIAL => 'la subida de la foto ha sido parcial.',
    UPLOAD_ERR_NO_FILE => 'La foto no ha subido.',
    UPLOAD_ERR_NO_TMP_DIR => 'La carpeta tmp no existe.',
    UPLOAD_ERR_CANT_WRITE => 'Error al guardar la foto.',
    UPLOAD_ERR_EXTENSION => 'La extensión del archivo no está permitida.',
);

function fileExt($tipoImagen){
	$gd_function_suffix = array(  
 		'image/pjpeg' => 'JPEG', 
 		'image/jpeg' => 'JPEG', 
 		'image/gif' => 'GIF', 
 		'image/bmp' => 'WBMP',
		'image/png' => 'PNG',
 		'image/x-png' => 'PNG' 
		);
		$function_suffix = $gd_function_suffix[$tipoImagen];
		if($function_suffix){
			return true;
		}
		else{
			return false;
		}
	
}

		$function_suffix = $gd_function_suffix[$tipoImagen];
 
		// Build Function name for ImageCreateFromSUFFIX 

$idAmbito = $_POST['IDAMBITO'];
$Ambito = $_POST['AMBITO'];
$titulos = explode(";", $_POST['TITULOS']);
$pies = explode(";", $_POST['PIES']);
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos
echo ("../$Ambito.<br/>");
if (!is_dir("../$Ambito")){
			mkdir("../$Ambito");
			chmod("../$Ambito",  0777);
			//sleep(1);
		}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos
echo ("../$Ambito/$idAmbito.<br/>");
if (!is_dir("../$Ambito/$idAmbito")){
			mkdir("../$Ambito/$idAmbito");
			chmod("../$Ambito/$idAmbito",  0777);
			//sleep(1);
		}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos
echo ("../$Ambito/$idAmbito/images.<br/>");
if (!is_dir("../$Ambito/$idAmbito/images")){
			mkdir("../$Ambito/$idAmbito/images");
			chmod("../$Ambito/$idAmbito/images",  0777);
			//sleep(1);
		}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Creo la carpeta del cliente donde se guardaran sus archivos thumb
if (!is_dir("../$Ambito/$idAmbito/thumb")){
			mkdir("../$Ambito/$idAmbito/thumb");
			chmod("../$Ambito/$idAmbito/thumb",  0777);
			//sleep(1);
		}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


$foto = $_FILES['IMAGEN'];
$cantidad = count($foto['name']);
$link = ConnBDCervera();
echo $cantidad;
exit;
for ($i=0; $i < $cantidad;$i++){
	if(!$foto['size'][$i])
	continue;
	if (fileExt($foto['type'][$i])){
		if ($foto['error'][$i] == UPLOAD_ERR_OK){
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
			if (file_exists($fotolocation)){
				unlink($fotolocation);
			}
echo "temporal: ". $tmp_name."<br/>";
echo "fotolocation: ". $fotolocation."<br/>";
			move_uploaded_file($tmp_name, $fotolocation);
echo "error: ". $error."<br/>";

if (is_uploaded_file($foto['tmp_name'][$i])) {
   echo "File ". $foto['tmp_name'][$i] ." uploaded successfully.\n";
   echo "Displaying contents\n";
   //readfile($foto['tmp_name'][$i]);
   move_uploaded_file($tmp_name, $fotolocation);
} else {
   echo "Possible file upload attack: ";
   echo "filename '". $foto['tmp_name'][$i] . "'.";
}
			
			// redimension El logo
list($ancho, $alto) = getimagesize($fotolocation);
echo "ancho: ". $ancho."<br/>";
echo "alto: ". $alto."<br/>";

				if (($ancho > 250)||($alto > 250)){
					if ($ancho > $alto) {$porcentaje = (250/$ancho); $nuevoancho =floor(($ancho*floor($porcentaje*100))/100); $nuevoalto = floor(($alto*floor($porcentaje*100))/100);}
					if ($ancho == $alto) {$nuevoancho = 250;  $nuevoalto = 250;}
					if ($ancho < $alto) {$porcentaje = (250/$alto); $nuevoancho = floor(($ancho*floor($porcentaje*100))/100); $nuevoalto = floor(($alto*floor($porcentaje*100))/100);}
					
					if ($ext == "jpg"){
						redimensionar_jpeg($fotolocation,$thumblocation,$nuevoancho,$nuevoalto,100);
					}
					if ($ext == "gif"){
						redimensionar_gif($fotolocation,$thumblocation,$nuevoancho,$nuevoalto,100);
					}
				}
				else{
					$nuevoancho = $ancho;
					$nuevoalto = $alto;
					if ($ext == "jpg"){
						redimensionar_jpeg($fotolocation,$thumblocation,$ancho,$alto,100);
					}
					if ($ext == "gif"){
						redimensionar_gif($fotolocation,$thumblocation,$ancho,$alto,100);
					}
				}
				// fin redimension El logo
				
				// Se introducen los valores en la base de datos una vez subido y redimensionado la imagen
				
				// borramos cualquier archivo con el mismo nombre antes de volverlo a introducir
				$sqlDel = "Delete From Imagenes where Ambito = '$Ambito' and idAmbito = $idAmbito and Archivo = '$nombre' ";
				$result = mysqli_query($link,$sqlDel);
	
				// introducimos los datosdel nuevo archivo
				$sqlIns = " INSERT INTO Imagenes (Ambito, idAmbito, Archivo, Path, Tipo, Tamano, Ancho, Alto, AnchoThumb, AltoThumb, Titulo, Pie, Fecha) VALUES ("	   	    			
				. " '". $Ambito ."', "
				. $idAmbito  .", "	 							
				. " '". Limpiar($nombre,100) ."', "	
				. " '$Ambito/$idAmbito/images', "				
				. " '". $tipo ."', "
				. " ". $tamano .", "		
				. " ". $ancho .", "
				. " ". $alto .", "
				. " ". $nuevoancho .", "
				. " ". $nuevoalto .", "	
				. " '". Limpiar($titulo,100) ."', " 
				. " '". Limpiar($pie,250) ."', " 				
				. " Now()) ";
			echo $sqlIns;
				$result = mysqli_query($link,$sqlIns);

    }else{
    	echo $uploadErrors [$foto['error'][$i]];
    }
  }else{
  	echo "La foto " .$foto['name'][$i] . " no tiene el formato adecuado";
  }
}
mysqli_close($link);

?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>

