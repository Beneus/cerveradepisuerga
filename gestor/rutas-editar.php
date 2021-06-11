<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



// datos de la entrada del museo

$idRuta = $_GET["idRuta"];
$link = ConnBDCervera();
$sql = " Select * from Rutas where idRuta = $idRuta ";
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
	$Ruta = $row["Ruta"];
	$Inicio = $row["Inicio"];
	$Llegada = $row["Llegada"]; 
	$Distancia = $row["Distancia"];
	$Tiempo = $row["Tiempo"];
	$Desnivel = $row["Desnivel"];
	$Dificultad = $row["Dificultad"];
	$Piso = $row["Piso"];
	$Descripcion = $row["Descripcion"];
	$Flora = $row["Flora"];
	$Fauna = $row["Fauna"];
	$Epoca = $row["Epoca"];
	$URL = $row["URL"];

}else{
	header("Location:rutas-listado.php");
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
<title>Gestor de contenidos: Rutas editar</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="scripts/tiny_mce.js"></script>
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
    <li><a title="A&ntilde;adir entrada al directorio" href="rutas-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del directorio"  href="rutas-listado.php">Listado</a> 
      <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
    </li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaRuta(this,'editar');return false;" method="post">
<div class="tablaizq">
  <ul class="tablaformizq">
    <li class="campoform">
      <div class="tituloentradaform">Ruta</div>
      <div class="valorentradaform">
        <input name="RUTA" type="text" id="RUTA" value="<?php echo $Ruta; ?>" size="35" />
      </div>
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Inicio</div>
      <div class="valorentradaform">
        <input name="INICIO" type="text" id="INICIO" value="<?php echo $Inicio; ?>" size="35" />
      </div>
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Llegada</div>
      <div class="valorentradaform">
        <input name="LLEGADA" type="text" id="LLEGADA" value="<?php echo $Llegada; ?>" size="35" />
      </div>
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Distancia</div>
      <div class="valorentradaform">
        <input name="DISTANCIA" type="text" id="DISTANCIA" value="<?php echo $Distancia; ?>" size="35" />
      </div>
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Tiempo</div>
      <div class="valorentradaform">
        <input name="TIEMPO" type="text" id="TIEMPO" value="<?php echo $Tiempo; ?>" size="35" />
      </div>
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de imagenes</div>
        <div class="valorentradaform">
         <a href="galeria-fotografica.php?Ambito=Rutas&amp;idAmbito=<?php echo $idRuta;?>&amp;Campo=idRuta&amp;NCampo=Ruta&amp;Referer=rutas-editar.php">Galeria de imagenes</a>
        </div>    </li> 
            <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de documentos</div>
        <div class="valorentradaform">
         <a href="galeria-documentos.php?Ambito=Rutas&amp;idAmbito=<?php echo $idRuta;?>&amp;Campo=idRuta&amp;NCampo=Ruta&amp;Referer=rutas-editar.php">Galeria de documentos</a>
        </div>    
            </li> 
  </ul>
</div>
<div class="tablader">
<ul class="tablaformder">
  <li class="campoform">
        <div class="tituloentradaform">Desnivel</div>
        <div class="valorentradaform">
          <input name="DESNIVEL" type="text" id="DESNIVEL" value="<?php echo $Desnivel; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Piso</div>
        <div class="valorentradaform">
          <input name="PISO" type="text" id="PISO" value="<?php echo $Piso; ?>" size="35" />
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Dificultad</div>
        <div class="valorentradaform">
          <input name="DIFICULTAD" type="text" id="DIFICULTAD" value="<?php echo $Dificultad; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Epoca</div>
        <div class="valorentradaform">
          <input name="EPOCA" type="text" id="EPOCA" value="<?php echo $Epoca; ?>" size="35" />
        </div>    </li>    
        <li class="campoform">
        <div class="tituloentradaform">URL</div>
        <div class="valorentradaform">
          <input name="URL" type="text" id="URL" value="<?php echo $URL; ?>" size="35" />
        </div>    </li>  
</ul>
</div>
<br class="limpiar" />
<div class="textolargo">
<ul class="tablaformtextolargo">
    <li class="campoform">
      <div class="tituloentradaform">Descripci&oacute;n</div>
      <div class="valorentradaform">
        <textarea name="DESCRIPCION" cols="80" rows="10" id="DESCRIPCION"><?php echo $Descripcion; ?></textarea>
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Flora</div>
        <div class="valorentradaform"><textarea name="FLORA" cols="80" rows="10" id="FLORA"><?php echo $Flora; ?></textarea>
         </div>
        </li>
       <li class="campoform">
        <div class="tituloentradaform">Fauna</div>
        <div class="valorentradaform"><textarea name="FAUNA" cols="80" rows="10" id="FAUNA"><?php echo $Fauna; ?></textarea>
         </div>
        </li>
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Guardar Datos" />
        </div>    </li>    
</ul>
</div>
<input type="hidden" name="IDRUTA" value="<?php echo $idRuta;?>"/>
</form>
</div>

<br clear="left" />
</body>
</html>
