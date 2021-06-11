<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$link = ConnBDCervera();
$sql = " Select * from Escudos where idEscudo = 0 limit 0,1 ";
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
	$Descripcion = $row["Descripcion"]; 
}

mysqli_free_result($result);
mysqli_close($link);	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Inicio entrada</title>
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
</map></div>
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
<hr class="separador" />
<div id="contenido">


<form enctype="multipart/form-data" name="formEntrada" id="formEntrada" onsubmit="EnviarEntradaEscudosIntroduccion(this,'nuevo');return false;">
<div class="textolargo">
<ul class="tablaformtextolargo">
    <li class="campoform">
      <div class="tituloentradaform">Escudos introducci&oacute;n</div>
      <div class="valorentradaform">
        <textarea name="DESCRIPCION" cols="80" rows="20" id="DESCRIPCION"><?php echo $Descripcion; ?></textarea>
      </div>
     </li>
   
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Guardar Datos" />
        </div>    </li>    
</ul>
</div>
</form>
</div>

</body>
</html>
