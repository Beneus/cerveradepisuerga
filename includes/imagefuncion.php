<?php
function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura,$img_nueva_calidad) {
	// crear imagen desde original
	$img = ImageCreateFromJPEG($img_original);
	// crear imagen nueva
	$thumb = ImageCreate($img_nueva_anchura,$img_nueva_altura);
	// redimensionar imagen original copiandola en la imagen
	ImageCopyResized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
	// guardar la imagen redimensionada donde indicia $img_nueva
	ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
}

function redimensionar_gif($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura,$img_nueva_calidad) {
	// crear imagen desde original
	$img = ImageCreateFromGIF($img_original);
	// crear imagen nueva
	$thumb = ImageCreate($img_nueva_anchura,$img_nueva_altura);
	// redimensionar imagen original copiandola en la imagen
	ImageCopyResized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
	// guardar la imagen redimensionada donde indicia $img_nueva
	ImageGIF($thumb,$img_nueva,$img_nueva_calidad);
}
?>