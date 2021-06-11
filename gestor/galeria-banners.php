<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$link = ConnBDCervera();
// datos de la entrada del directorio
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Administraci&oacute;n Galer&iacute;a Banners</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
<script type="text/javascript">
	function stopUpload(){
      document.getElementById('barracargando').style.visibility = 'hidden';
      document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="galeria-banners.php";
	  	return true;   
}
</script>
</head>

<body>
<div id="espere" style="display:none" >
  <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
</div>
<div id="error" style="display:none" >
  <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
  <div id="errormsn" >
  </div>
</div>
<div id="cab">
  <div>
<img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" /> <map name="Map" id="Map">
<area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
</map>
</div>
</div>
<div id="menu">
<?php echo $strMenu; ?>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
<?php echo $strSubMenu; ?>
</div>
<div id="opciones">
<ul>
<li class="liselect"><a href="galeria-banners.php" class="">Galeria de anuncios</a></li>
<li><a href="administracion-banners-gestion.php">Gesti&oacute;n de anuncios</a></li>
<li><a href="administracion-banners-listado.php">Anuncios publicados</a></li>
</ul>
</div>
<div class="separador">&nbsp;</div>

<div id="contenido">


<div id="barracargando" style="visibility:hidden">Cargando fotos...<br/><img src="images/loader.gif" /></div>
<div id="FormImage">
<form method="post" enctype="multipart/form-data" id="uploadform">
<input type="hidden" name="TEXTOBANNERS" value=""/>
<input type="hidden" name="URLBANNERS" value=""/>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addBannerInput('foto[]');">A&ntilde;adir otro banner</a></div>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="19">Nuevo Banner</td>
    <td></td>
  </tr>
  <tr>
    <td><input type="file" name="foto[]" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" /></td>
    <td>Texto del banner (m&aacute;x 255)<br/><input name="TEXTOBANNER" type="text" size="50" /></td>

  </tr>
  <tr>
    <td></td>
    <td>Url del Banner (m&aacute;x 255)<br/><input name="URLBANNER" type="text" size="50" /></td>
  
  </tr>
</table>
<div id="moreUploads"></div>
</form>
</div>
<a href="#" name="subirImg" class="uploadfile" onclick="uploadBanner('Ban');startUpload();">Subir Banner</a>
<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>
<br class="limpiar" />
<?php
// datos de la entrada del directorio
 $CamposImage = array();

for($i = 0; $i < sizeof($CamposImage); $i++){
		$CamposQuery .= ", AM." . $CamposImage[$i];
}

$sql = " SELECT * FROM Banners order by Orden, idBanner ";			
			
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
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

		$idBanner = $row["idBanner"];
		$TextoBanner = $row["TextoBanner"];
		$UrlBanner = $row["UrlBanner"];
		$Banner = $row["Banner"];
		$Ancho = $row["Ancho"];
		$Alto = $row["Alto"];
		$Tamano = $row["Tamano"];
		$Orden = $row["Orden"];
		$Fecha = $row["Fecha"];

		echo "<div class=\"galeriaImagen\"  id=\"Ban$idBanner\">\n";
	  	echo "<div class=\"Imagen\">\n";
	  	echo "<img src=\"../Banners/". $idBanner ."/" .$Banner. "\" width=\"$Ancho\" height=\"$Alto\" border=\"0\" title=\"". $TextoBanner ."\"/>\n";
	  	echo "</div>\n";
	  	echo "<div class=\"DatosImagen\">\n";
	  	
		  echo "<ul>\n";
		  echo "<li>Fecha: ". $Fecha ."</li>\n";
		  echo "<li>Banner: ". $Banner ."</li>\n"; 
		  echo "<li>Anchura: ". $Ancho ." px.</li>\n";
		  echo "<li>Altura: ". $Alto ." px.</li>\n";
		  echo "<li>Tama&ntilde;o: ". $Tamano ."</li>\n";
		  echo "<form name=\"formBanner$idBanner\" >\n";
		  // T�tulo de imagen
		  echo "<li><span onclick=\"EditarBanner('TEXTOBANNER',$idBanner);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el texto del banner\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el texto del banner\"><strong>Texto del banner(m&aacute;x 255): </strong></span><span id=\"TEXTOBANNER$idBanner\" onclick=\"EditarBanner('TEXTOBANNER',$idBanner);\" onmouseover=\"this.style.cursor='pointer';\">". $TextoBanner ."</span>";
		  echo "<input type=\"text\" name=\"TEXTOBANNER\" value=\"".$TextoBanner."\" style=\"display:none\" disabled=\"disabled\" onBlur=\"GuardarDatosBanner('TEXTOBANNER',$idBanner);\" onchange=\"TextoModificado=true;\" size=\"70\" maxlength=\"100\" class=\"textoimagen\" /></li>\n";
		  // Pie de imagen
		  echo "<li><span onclick=\"EditarBanner('URLBANNER',$idBanner);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar la Url del banner\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar la Url del banner\"><strong>Url del banner (m&aacute;x 255): </strong></span><span id=\"URLBANNER$idBanner\" onclick=\"EditarBanner('URLBANNER',$idBanner);\" onmouseover=\"this.style.cursor='pointer';\">". $UrlBanner ."</span>";
		  echo "<textarea name=\"URLBANNER\" cols=\"45\" rows=\"2\" disabled=\"disabled\" style=\"display:none\" onblur=\"GuardarDatosBanner('URLBANNER',$idBanner);\" onchange=\"TextoModificado=true;\"  class=\"textoimagen\"></textarea>";
		 	// Eliminar
		 	echo "<li><img onmouseover=\"this.style.cursor='pointer';\" src=\"images/eliminarfoto.gif\" alt=\"Eliminar foto\" width=\"50\" height=\"25\" onClick=\"EliminarBanner(".$idBanner.")\" /></li>";
		 	echo "</form>\n";
		 	// Asociacion de imagenes
		 	
		 	
		 	echo "<li><strong>Intercambiar posici&oacute;n: </strong><input type=\"checkbox\" name=\"POSICION\" value=\"$idBanner\" onclick=\"IntercambiarBanner(this);\" /></li>";
		  echo "</ul>\n";
		  
	  echo "</div>\n";
		echo "</div>\n";
	
	 
	
	}
	echo "<nobr clear=\"left\" ></nobr>\n";
	
}
mysqli_free_result($result);
mysqli_close($link);	
?>
</div>
<br clear="left" />
</body>
</html>
