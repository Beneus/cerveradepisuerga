<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Localidades entrada</title>
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
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" /></div>
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
    <li class="liselect"><a title="A&ntilde;adir entrada al directorio" href="localidades-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del directorio"  href="localidades-listado.php">Listado</a> 
      <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
    </li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form enctype="multipart/form-data" name="formEntrada" id="formEntrada" onsubmit="EnviarEntradaNucleoUrbano(this,'nuevo');return false;" method="post">
<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Nucleo urbano</div>
      <div class="valorentradaform">
        <input name="NOMBRENUCLEOURBANO" type="text" id="NOMBRENUCLEOURBANO" size="35" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Area</div>
        <div class="valorentradaform"><?php 
	  	$link = ConnBDCervera();
		$sql = "SELECT distinct idArea, NombreArea FROM Areas order by NombreArea";
	  	echo CrearSelect("IDAREA","idArea","NombreArea",$sql,$link,"","","","","Sin");
	  ?>
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">C&oacute;digo postal</div>
        <div class="valorentradaform">
          <input name="CODIGOPOSTAL" type="text" id="CODIGOPOSTAL" size="5" maxlength="5" />
        </div>    </li>
     <li class="campoform">
        <div class="tituloentradaform">Google Maps</div>
        <div class="valorentradaform">
          <input name="GOOGLEMAPS" type="text" id="GOOGLEMAPS" size="35" />
        </div>    </li>   
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
    
    <li class="campoform">
      <div class="tituloentradaform">Latitud</div>
      <div class="valorentradaform">
        <input name="LATITUD" type="text" id="LATITUD" size="16" maxlength="16" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Longitud</div>
        <div class="valorentradaform"><input name="LONGITUD" type="text" id="LONGITUD" size="16" maxlength="16" />
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">Altitud</div>
        <div class="valorentradaform">
          <input name="ALTITUD" type="text" id="ALTITUD" size="4" maxlength="4" /> 
          metros
        </div>    
    </li>   
</ul>
</div>
<br class="limpiar" />
<div class="textolargo">
<ul class="tablaformtextolargo">
    <li class="campoform">
      <div class="tituloentradaform">Descripci&oacute;n</div>
      <div class="valorentradaform">
        <textarea name="DESCRIPCION" cols="80" rows="10" id="DESCRIPCION"></textarea>
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Historia</div>
        <div class="valorentradaform"><textarea name="HISTORIA" cols="80" rows="10" id="HISTORIA"></textarea>
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

<br clear="left" />
</body>
</html>
