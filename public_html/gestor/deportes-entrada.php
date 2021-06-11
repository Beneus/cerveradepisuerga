<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$ErrorMsn = '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Deportes entrada</title>
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
  <div id="errormsn" ><?php echo $ErrorMsn; ?>
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
    <li class="liselect"><a title="A&ntilde;adir monumento" href="deportes-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del monumentos"  href="deportes-listado.php">Listado</a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" method="post" name="formEntrada" action="deportes-entrada.php" onsubmit="EnviarEntradaDeportes(this,'nuevo');return false;">

<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Acto deportivo</div>
      <div class="valorentradaform">
        <input name="ACTODEPORTIVO" type="text" id="ACTODEPORTIVO" size="35" />
      </div>
     </li>
     <li class="campoform">
      <div class="tituloentradaform">Lugar</div>
      <div class="valorentradaform">
        <input name="LUGAR" type="text" id="LUGAR" size="35" />
      </div>
     </li>
    
    <li class="campoform">
        <div class="tituloentradaform">Poblaci&oacute;n</div>
        <div class="valorentradaform">
          <?php 
	  	$link = ConnBDCervera();
		$sql = "SELECT distinct idNucleoUrbano, NombreNucleoUrbano FROM NucleosUrbanos order by NombreNucleoUrbano";
	  	echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","","","Todos");
	  ?>
        </div>    </li>  
     <li class="campoform">
        <div class="tituloentradaform">Hora </div>
        <div class="valorentradaform">
          <input name="HORA" type="text" id="HORA" size="5" />
          (hh:mm)
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Fecha Inicio</div>
        <div class="valorentradaform"><input name="FECHAINICIO" type="text" id="FECHAINICIO" size="10" maxlength="10" />
          (dd/mm/aaaa)         </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Fecha Finalizaci&oacute;n</div>
        <div class="valorentradaform"><input name="FECHAFINAL" type="text" id="FECHAFINAL" size="10" maxlength="10" />
          (dd/mm/aaaa)         </div>
        </li>
        
       
       
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
        <div class="tituloentradaform">Contacto</div>
        <div class="valorentradaform">
          <input name="CONTACTO" type="text" id="CONTACTO" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Precio</div>
        <div class="valorentradaform">
          <input name="PRECIO" type="text" id="PRECIO" />
        </div>    
         </li>    
      <li class="campoform">
        <div class="tituloentradaform">Tel&eacute;fono</div>
        <div class="valorentradaform">
          <input name="TELEFONO" type="text" id="TELEFONO" size="16" maxlength="16" />
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
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Publicar Acto Deportivo" />
          <br />
          <input type="submit" name="ENVIAR2" id="ENVIAR2" value="Publicar Acto Deportivo y adjuntar Documento" onclick="document.formEntrada.ADJUNTAR.value=1;"/>
        </div>    </li>    
</ul>
</div>
<input type="hidden" name="ADJUNTAR" value="0" />
</form>
</div>


<br clear="left" />
</body>
<?php if ($ErrorMsn != ""){ ?>
<script type="text/javascript">
disDiv("contenido",true); 
</script>
<?php } ?>
</html>
