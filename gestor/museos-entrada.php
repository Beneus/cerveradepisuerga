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
<title>Gestor de contenidos: Museos entrada</title>
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
    <li class="liselect"><a title="A&ntilde;adir entrada al directorio" href="museos-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del directorio"  href="museos-listado.php">Listado</a> 
      <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
    </li>
  </ul>
</div>
<div class="separador">&nbsp;</div>

<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaMuseo(this,'nuevo');return false;" method="post">
<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Museo/Exposici&oacute;n</div>
      <div class="valorentradaform">
        <input name="MUSEO" type="text" id="MUSEO" size="35" />
      </div>
     </li>
     <li class="campoform">
      <div class="tituloentradaform">Tema/Lugar</div>
      <div class="valorentradaform">
        <input name="TEMA" type="text" id="TEMA" size="35" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Direcci&oacute;n</div>
        <div class="valorentradaform"><input name="DIRECCION" type="text" id="DIRECCION" size="35" />
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">Poblaci&oacute;n</div>
        <div class="valorentradaform">
          <?php 
	  	$link = ConnBDCervera();
		$sql = "SELECT distinct idNucleoUrbano, NombreNucleoUrbano FROM NucleosUrbanos order by NombreNucleoUrbano";
	  	echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","","","Sin");
	  ?>
        </div>    </li>  
     <li class="campoform">
        <div class="tituloentradaform">Horario</div>
        <div class="valorentradaform">
          <input name="HORARIO" type="text" id="HORARIO" size="35" />
        </div>    </li>  
      <li class="campoform">
        <div class="tituloentradaform">Tel&eacute;fono</div>
        <div class="valorentradaform">
          <input name="TELEFONO" type="text" id="TELEFONO" size="16" maxlength="16" />
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Tipo</div>
        <div class="valorentradaform">
          <select name="TIPO">
        <option value="PERMANENTE">PERMANENTE</option>
        <option value="TEMPORAL">TEMPORAL</option>
      </select>
        </div>    </li> 
       
       
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
  <li class="campoform">
        <div class="tituloentradaform">Email</div>
        <div class="valorentradaform">
          <input name="EMAIL" type="text" id="EMAIL" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">URL</div>
        <div class="valorentradaform">
          <input name="URL" type="text" id="URL" size="35" />
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Responsable</div>
        <div class="valorentradaform">
          <input name="RESPONSABLE" type="text" id="RESPONSABLE" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Fecha de inauguraci&oacute;n</div>
        <div class="valorentradaform">
          <input name="FECHAINAUGURACION" type="text" id="FECHAINAUGURACION" size="10" maxlength="10" />
(dd/mm/aaaa)        </div>    
         </li>    
        <li class="campoform">
        <div class="tituloentradaform">Fecha de clausura</div>
        <div class="valorentradaform">
          <input name="FECHACLAUSURA" type="text" id="FECHACLAUSURA" size="10" maxlength="10" />
(dd/mm/aaaa)        </div>    
        </li> 
         
         <li class="campoform">
        <div class="tituloentradaform">Latitud</div>
        <div class="valorentradaform">
          <input name="LATITUD" type="text" id="LATITUD" size="20" />
        </div>    </li> 
         <li class="campoform">
        <div class="tituloentradaform">Longitud</div>
        <div class="valorentradaform">
          <input name="LONGITUD" type="text" id="LONGITUD" size="20" />
        </div>    </li>  
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
