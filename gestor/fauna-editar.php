<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


// datos de la entrada del museo

$idFauna = $_GET["idFauna"];
$link = ConnBDCervera();
$sql = " Select * from Fauna where idFauna = $idFauna ";
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
	$NombreComun = $row["NombreComun"] ?? '';
	$NombreCientifico = $row["NombreCientifico"] ?? '';
	$Familia = $row["Familia"] ?? ''; 
	$Descripcion = $row["Descripcion"] ?? '';
	$Habitat = $row["Habitat"] ?? '';
	$Usos = $row["Usos"] ?? '';

}else{
	header("Location:fauna-listado.php");
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
<title>Gestor de contenidos: Fauna editar</title>
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
    <li><a title="A&ntilde;adir entrada al directorio" href="fauna-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del directorio"  href="fauna-listado.php">Listado</a> 
      <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
    </li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaFauna(this,'editar');return false;" method="post">
<input type="hidden" name="IDFAUNA" value="<?php echo $idFauna;?>"/>
<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Nombre Com&uacute;n</div>
      <div class="valorentradaform">
        <input name="NOMBRECOMUN" type="text" id="NOMBRECOMUN" value="<?php echo $NombreComun; ?>" size="35" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Nombre Cient&iacute;fico</div>
        <div class="valorentradaform"><input name="NOMBRECIENTIFICO" type="text" id="NOMBRECIENTIFICO" value="<?php echo $NombreCientifico; ?>" size="35" />
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">Familia</div>
        <div class="valorentradaform">
          <input name="FAMILIA" type="text" id="FAMILIA" value="<?php echo $Familia; ?>" size="35" />
        </div>    </li> <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de imagenes</div>
        <div class="valorentradaform">
          <a href="galeria-fotografica.php?Ambito=Fauna&amp;idAmbito=<?php echo $idFauna;?>&amp;Campo=idFauna&amp;NCampo=NombreComun&amp;Referer=fauna-editar.php">Galeria de imagenes</a>
        </div>    </li>   
        <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de documentos</div>
        <div class="valorentradaform">
          <a href="galeria-documentos.php?Ambito=Fauna&amp;idAmbito=<?php echo $idFauna;?>&amp;Campo=idFauna&amp;NCampo=NombreComun&amp;Referer=fauna-editar.php">Galeria de documentos</a>
        </div>    
        </li>  
</ul>
</div>
<div class="tablader">
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
        <div class="tituloentradaform">Habitat</div>
        <div class="valorentradaform"><textarea name="HABITAT" cols="80" rows="10" id="HABITAT"><?php echo $Habitat; ?></textarea>
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
