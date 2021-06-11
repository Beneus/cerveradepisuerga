<?php
function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura,$img_nueva_calidad) {
	// crear imagen desde original
	$img = imagecreatefromjpeg($img_original);
	// crear imagen nueva
	$thumb = imagecreatetruecolor( $img_nueva_anchura, $img_nueva_altura );
	// redimensionar imagen original copiandola en la imagen  
	imagecopyresized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
	// guardar la imagen redimensionada donde indicia $img_nueva
	imagejpeg($thumb,$img_nueva,$img_nueva_calidad);
}

function redimensionar_gif($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura,$img_nueva_calidad) {
	// crear imagen desde original
	$img = imagecreatefromgif($img_original);
	// crear imagen nueva
	$thumb = imagecreatetruecolor( $img_nueva_anchura, $img_nueva_altura );
	// redimensionar imagen original copiandola en la imagen
	imagecopyresized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
	// guardar la imagen redimensionada donde indicia $img_nueva
	imagegif($thumb,$img_nueva,$img_nueva_calidad);
}

function redimensionar_png($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura,$img_nueva_calidad) {
	// crear imagen desde original
	$img = imagecreatefrompng($img_original);
	// crear imagen nueva
	$thumb = imagecreatetruecolor( $img_nueva_anchura, $img_nueva_altura );
	// redimensionar imagen original copiandola en la imagen
	imagecopyresized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
	// guardar la imagen redimensionada donde indicia $img_nueva
	imagepng($thumb,$img_nueva,$img_nueva_calidad);
}


?>