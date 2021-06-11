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

$TextoBanners = explode(";", $_POST['TEXTOBANNERS']);
$UrlBanners = explode(";", $_POST['URLBANNERS']);

$foto = $_FILES['foto'];
$cantidad = count($foto['name']);
$link = ConnBDCervera();

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
		$TextoBanner = $TextoBanners[$i];
		$UrlBanner = $UrlBanners[$i];
		// acceso a la base de datos
		
		// introducimos los datosdel nuevo archivo
		$sqlIns = " INSERT INTO Banners (TextoBanner, UrlBanner, Banner, Tamano, Fecha) VALUES ("	   	    			 							
		. " '". Limpiar($TextoBanner,255) ."', "	
		. " '". Limpiar($UrlBanner,255) ."', "	
		. " '". $nombre ."', "	
		. $tamano .", "	
		. " Now()) ";

		$result = mysqli_query($link,$sqlIns);
		
		$sql = "select idBanner from Banners order by idBanner desc Limit 1 ";
		$result = mysqli_query($link,$sql);
		if (!$result)
			{
			$message = "Invalid query".mysqli_error($link)."\n";
			$message .= "whole query: " .$sql;	
			die($message);
			exit;
			}
		$max = mysqli_num_rows($result);	
		if($max > 0){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$idBanner = $row["idBanner"]; 
		}
		$fotolocation = "../Banners/$idBanner/$nombre";
		// Manejo del archivo imagen
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Creo la carpeta del cliente donde se guardaran sus archivos
		
		if (!is_dir("../Banners")){
					mkdir("../Banners");
					chmod("../Banners",  0777);
					//sleep(1);
				}
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Creo la carpeta del cliente donde se guardaran sus archivos
		
		if (!is_dir("../Banners/$idBanner")){
					mkdir("../Banners/$idBanner");
					chmod("../Banners/$idBanner",  0777);
					//sleep(1);
				}
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
		
		// Si existe un archivo con el mismo nombre lo borro antes de introducir el nuevo
		if (file_exists($fotolocation)){
			unlink($fotolocation);
		}

		move_uploaded_file($tmp_name, $fotolocation);


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
		
		$AnchoPrevisto = 160;
		
		if ($ancho > $AnchoPrevisto){
			if ($ancho > $alto) {$porcentaje = ($AnchoPrevisto/$ancho); $nuevoancho =floor(($ancho*floor($porcentaje*100))/100); $nuevoalto = floor(($alto*floor($porcentaje*100))/100);}
			if ($ancho == $alto) {$nuevoancho = $AnchoPrevisto;  $nuevoalto = $AnchoPrevisto;}
			if ($ancho < $alto)  {$porcentaje = ($AnchoPrevisto/$ancho); $nuevoancho =floor(($ancho*floor($porcentaje*100))/100); $nuevoalto = floor(($alto*floor($porcentaje*100))/100);}
			
			if (strtolower($ext) == "jpg"){
				redimensionar_jpeg($fotolocation,$fotolocation,$nuevoancho,$nuevoalto,100);
			}
			if (strtolower($ext) == "gif"){
				redimensionar_gif($fotolocation,$fotolocation,$nuevoancho,$nuevoalto,100);
			}
			if (strtolower($ext) == "png"){
				redimensionar_png($fotolocation,$fotolocation,$nuevoancho,$nuevoalto,100);
			}
		}
		else{
			$nuevoancho = $ancho;
			$nuevoalto = $alto;
			if (strtolower($ext) == "jpg"){
				redimensionar_jpeg($fotolocation,$fotolocation,$ancho,$alto,100);
			}
			if (strtolower($ext) == "gif"){
				redimensionar_gif($fotolocation,$fotolocation,$ancho,$alto,100);
			}
			if (strtolower($ext) == "png"){
				redimensionar_png($fotolocation,$fotolocation,$ancho,$alto,100);
			}
		}
		
		$sqlUp = "Update Banners set Alto = $nuevoalto, Ancho = $nuevoancho, Orden = $idBanner where idBanner = $idBanner ";
		$result = mysqli_query($link,$sqlUp);
					
				
    }else{
    	echo $uploadErrors [$foto['error'][$i]];
    }//if ($foto['error'][$i] == UPLOAD_ERR_OK){
  }else{
  	echo "La foto " .$foto['name'][$i] . " no tiene el formato adecuado";
  }//if (fileExt($foto['type'][$i])){
}//for ($i=0; $i < $cantidad;$i++){
mysqli_close($link);

?>
<script language="javascript" type="text/javascript">window.top.window.stopUpload();</script>

