<?php
session_start();
include ("includes/Conn.php");
include("includes/variables.php");


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Noticias entrada</title>
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
    <li class="liselect"><a title="A&ntilde;adir noticia" href="noticias-entrada.php">A&ntilde;adir noticia</a></li>
    <li><a title="Listado del noticias"  href="noticias-listado.php">Listado</a></li>
  </ul>
</div>
<hr class="separador" />
<div id="contenido">
<form enctype="multipart/form-data" name="formEntrada" id="formEntrada" onsubmit="EnviarEntradaNoticias(this,'nuevo');return false;" method="post">


<br class="limpiar" />
<div class="textolargo">
<ul class="tablaformtextolargo">
    <li class="campoform">
      <div class="tituloentradaform">T&iacute;tulo</div>
      <div class="valorentradaform">
        <input name="TITULO" type="text" id="TITULO" size="106" maxlength="100" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Entradilla</div>
        <div class="valorentradaform"><textarea name="ENTRADILLA" cols="80" rows="5" class="mceNoEditor" id="ENTRADILLA"></textarea>
         </div>
        </li>
       <li class="campoform">
        <div class="tituloentradaform">Fecha</div>
        <div class="valorentradaform"><input name="FECHANOTICIA" type="text" id="FECHANOTICIA" size="10" maxlength="10" />
        (dd/mm/aaaa)
         </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Fuente</div>
        <div class="valorentradaform"><input name="FUENTE" type="text" id="FUENTE" size="50" />
         </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Cuerpo de la noticia</div>
        <div class="valorentradaform"><textarea name="CUERPO" cols="80" rows="20" id="CUERPO"></textarea>
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
