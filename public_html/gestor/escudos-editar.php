<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idEscudo = $_GET["idEscudo"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
$DocPath = '';


$link = ConnBDCervera();

$sql = "SELECT ESC.*, IM.Path as ImgPath, IM.Archivo as ImgArchivo, IM.AnchoThumb, IM.AltoThumb FROM Escudos as ESC "
		. " left join Imagenes as IM on ESC.ImgDescripcion = IM.idImagen "
    . " where idEscudo = $idEscudo ";
 


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
				$idNucleoUrbano = $row["idNucleoUrbano"] ?? '';
				$Nombre = $row["Nombre"] ?? '';
				$Direccion = $row["Direccion"] ?? '';
				$ImgDescripcion = $row["ImgDescripcion"] ?? '';
				$Descripcion = $row["Descripcion"] ?? '';
				$ImgArchivo = $row["ImgArchivo"] ?? ''; 
				$ImgPath = $row["ImgPath"] ?? '';
				$AnchoThumb = $row["AnchoThumb"] ?? '';
				$AltoThumb = $row["AltoThumb"] ?? '';
				$DocArchivo = $row["DocArchivo"] ?? ''; 
				$DocPath = $row["DocPath"] ?? '';

}else{
	header("Location:pesca-listado.php");
	exit;
	
}
mysqli_free_result($result);
mysqli_close($link);	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Flora entrada</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/tiny_mce.js" language="javascript" ></script>
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_buttons1 : "newdocument,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
	theme_advanced_buttons1_add : "outdent,indent",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
});

function stopUpload(){
	  	location.href="escudos-editar.php?idEscudo=<?php echo $idEscudo;?>";
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
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
  <map name="Map" id="Map">
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
	<li><a title="A&ntilde;adir introducci&oacute;n" href="escudos-introduccion.php">Editar introducción</a></li>
	<li><a title="a&ntilde;adir imagen a la introducci&oacute;n"  href="galeria-fotografica.php?Ambito=Escudos&idAmbito=0&Campo=idEscudo&NCampo=idEscudo&Referer=escudos-introduccion.php">A&ntilde;adir imagen introducci&oacute;n</a> </li>
	<li><a title="A&ntilde;adir entrada al directorio" href="escudos-entrada.php">A&ntilde;adir entrada escudo</a></li>
	<li><a title="Listado del directorio"  href="escudos-listado.php">Listado de escudos</a></li>
</ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaEscudo(this,'editar');return false;" method="post">
<div class="tablaizq">
<ul class="tablaformizq">
   
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
  
</ul>
</div>
<br class="limpiar" />
<div class="textolargo">
<ul class="tablaformtextolargo">
 <li class="campoform">
        <div class="tituloentradaform">Nombre del escudo</div>
        <div class="valorentradaform">
           <input name="NOMBRE" type="text" id="NOMBRE" value="<?php echo $Nombre; ?>" size="80" maxlength="255" />
        </div>    
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Direcci&oacute;n</div>
      <div class="valorentradaform">
        <input name="DIRECCION" type="text" id="DIRECCION" value="<?php echo $Direccion; ?>" size="80" maxlength="255" />
      </div>
     </li>
    <li class="campoform">
       <div class="tituloentradaform">Poblaci&oacute;n</div>
        <div class="valorentradaform">
          <?php 
	  	$link = ConnBDCervera();
		$sql = "SELECT distinct idNucleoUrbano, NombreNucleoUrbano FROM NucleosUrbanos order by NombreNucleoUrbano";
	  	echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","","",$idNucleoUrbano);
	  ?>
        </div>    
  
   </li>
     <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de imagenes</div>
        <div class="valorentradaform">
          <a href="galeria-fotografica.php?Ambito=Escudos&amp;idAmbito=<?php echo $idEscudo;?>&amp;Campo=idEscudo&amp;NCampo=Nombre&amp;Referer=escudos-editar.php">Galeria de imagenes</a>
        </div>    
        </li>   
        <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de documentos</div>
        <div class="valorentradaform">
          <a href="galeria-documentos.php?Ambito=Escudos&amp;idAmbito=<?php echo $idEscudo;?>&amp;Campo=idEscudo&amp;NCampo=Nombre&amp;Referer=escudos-editar.php">Galeria de documentos</a>
        </div>    
        </li>   
<li class="campoform">
        <div class="tituloentradaform">Descripci&oacute;n</div>
        <div class="valorentradaform">
          <textarea name="DESCRIPCION" cols="80" rows="20" id="DESCRIPCION"><?php echo $Descripcion; ?></textarea>
        </div>
        </li>
          <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Guardar Datos" />
          <input type="button" name="VOLVER" id="VOLVER" value="Volver al listado" onclick="location.href='escudos-listado.php?Mostrar=<?php echo $Mostrar; ?>&Pagina=<?php echo $Pagina; ?>&Buscar=<?php echo $Buscar; ?>'"/>
        </div>    </li>  
</ul>
</div>
<input type="hidden" name="IDESCUDO" id="IDESCUDO" value="<?php echo $idEscudo; ?>" />
</form>
</div>
<br clear="left" />

</body>
</html>
