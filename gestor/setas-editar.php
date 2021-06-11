<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



// datos de la entrada del museo

$idSetas = $_GET["idSetas"];

$link = ConnBDCervera();
$sql = " Select S.* from Setas as S left join SetasSubOrden as SS on S.idSetasSubOrden = SS.idSetasSubOrden where idSetas = $idSetas ";
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
	$NombreComun = $row["NombreComun"];
	$NombreCientifico = $row["NombreCientifico"];
	$Autor = $row["Autor"]; 
	$Clasificacion = $row["Clasificacion"];
	$Clase = $row["Clase"];
	$idSetasSubOrden = $row["idSetasSubOrden"];
	$Sombrero = $row["Sombrero"];
	$Pie = $row["Pie"];
	$Cuerpo = $row["Cuerpo"];
	$Laminas = $row["Laminas"];
	$Himenio = $row["Himenio"];
	$Exporada = $row["Exporada"];
	$Carne = $row["Carne"];
	$EpocaHabitat = $row["EpocaHabitat"];
	$Comestibilidad = $row["Comestibilidad"];
	$Comentarios = $row["Comentarios"];
}else{
	header("Location:setas-listado.php");
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
<title>Gestor de contenidos: Flora editar</title>
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

function InicializarClase(x){
	if(x=="BASIDIOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenBasidiomicetos;
	}
	if(x=="ASCOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenAscomicetos;
	}
	if(x=="FRAGMOBASIDIOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenFragmoasidiomicetos;
	}
}

function CambiarClase(x){
	if(x.value=="BASIDIOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenBasidiomicetos;
	}
	if(x.value=="ASCOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenAscomicetos;
	}
	if(x.value=="FRAGMOBASIDIOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenFragmoasidiomicetos;
	}
}


<?php 
$link = ConnBDCervera();
$sql = "SELECT distinct idSetasSubOrden, SubOrden FROM SetasSubOrden where Clase = 'BASIDIOMICETOS' order by SubOrden";
$result = mysqli_query($link,$sql);
if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($result);
//echo "El numero de registros es: ".$max;	
if($max > 0){
	$listadoSelect = "<option value=\"0\">Todos</option>";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$ValorVisto = $row['SubOrden'];
		if($idSetasSubOrden == $row['idSetasSubOrden']){
			$listadoSelect .= "<option value=\"$row[idSetasSubOrden]\" selected>$ValorVisto</option>";
		}else{
			$listadoSelect .= "<option value=\"$row[idSetasSubOrden]\">$ValorVisto</option>";
		}
	}
}else{
	$listadoSelect = "";	
}
mysqli_free_result($result);
echo "var ordenBasidiomicetos = '$listadoSelect';\n";

$sql = "SELECT distinct idSetasSubOrden, SubOrden FROM SetasSubOrden where Clase = 'ASCOMICETOS' order by SubOrden";
$result = mysqli_query($link,$sql);
if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($result);
//echo "El numero de registros es: ".$max;	
if($max > 0){
	$listadoSelect = "<option value=\"0\">Todos</option>";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$ValorVisto = $row['SubOrden'];
		if($idSetasSubOrden == $row['idSetasSubOrden']){
			$listadoSelect .= "<option value=\"$row[idSetasSubOrden]\" selected>$ValorVisto</option>";
		}else{
			$listadoSelect .= "<option value=\"$row[idSetasSubOrden]\">$ValorVisto</option>";
		}
	}
}else{
	$listadoSelect = "";	
}
mysqli_free_result($result);

echo "var ordenAscomicetos = '$listadoSelect';\n";

$sql = "SELECT distinct idSetasSubOrden, SubOrden FROM SetasSubOrden where Clase = 'FRAGMOBASIDIOMICETOS' order by SubOrden";
$result = mysqli_query($link,$sql);
if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($result);
//echo "El numero de registros es: ".$max;	
if($max > 0){
	$listadoSelect = "<option value=\"0\">Todos</option>";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$ValorVisto = $row['SubOrden'];
		if($idSetasSubOrden == $row['idSetasSubOrden']){
			$listadoSelect .= "<option value=\"$row[idSetasSubOrden]\" selected>$ValorVisto</option>";
		}else{
			$listadoSelect .= "<option value=\"$row[idSetasSubOrden]\">$ValorVisto</option>";
		}
	}
}else{
	$listadoSelect = "";	
}
mysqli_free_result($result);
mysqli_close($link);
echo "var ordenFragmoasidiomicetos = '$listadoSelect';\n";
	  ?>
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
    <li><a title="A&ntilde;adir introducci&oacute;n" href="setas-introduccion.php">Editar introducción</a></li>
   <li><a title="a&ntilde;adir imagen a la introducci&oacute;n"  href="galeria-fotografica.php?Ambito=Setas&idAmbito=0&Campo=idSetas&NCampo=idSetas&Referer=setas-introduccion.php">A&ntilde;adir imagen introducci&oacute;n</a> </li>
    <li><a title="A&ntilde;adir entrada al directorio" href="setas-entrada.php">A&ntilde;adir entrada gu&iacute;a micol&oacute;gica</a></li>
    <li><a title="Listado del directorio"  href="setas-listado.php">Listado gu&iacute;a micol&oacute;gica</a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaSetas(this,'nuevo');return false;" method="post">
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
        <div class="tituloentradaform">Autor</div>
        <div class="valorentradaform">
          <input name="AUTOR" type="text" id="AUTOR" value="<?php echo $Autor; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de imagenes</div>
        <div class="valorentradaform">
          <a href="galeria-fotografica.php?Ambito=Setas&amp;idAmbito=<?php echo $idSetas;?>&amp;Campo=idSetas&amp;NCampo=NombreComun&amp;Referer=setas-editar.php">Galeria de imagenes</a>
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de documentos</div>
        <div class="valorentradaform">
          <a href="galeria-documentos.php?Ambito=Setas&amp;idAmbito=<?php echo $idSetas;?>&amp;Campo=idSetas&amp;NCampo=NombreComun&amp;Referer=setas-editar.php">Galeria de documentos</a>
        </div>    
         </li>   
   
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
   <li class="campoform">
        <div class="tituloentradaform">Clase</div>
        <div class="valorentradaform">
          <select name="CLASE" onchange="CambiarClase(this);">
        <option value="BASIDIOMICETOS" <?php if($Clase=="BASIDIOMICETOS") echo "selected";?>>BASIDIOMICETOS</option>
        <option value="ASCOMICETOS" <?php if($Clase=="ASCOMICETOS") echo "selected";?>>ASCOMICETOS</option>
        <option value="FRAGMOBASIDIOMICETOS" <?php if($Clase=="FRAGMOBASIDIOMICETOS") echo "selected";?>>FRAGMOBASIDIOMICETOS</option>
      </select>
        </div>    </li> 
    <li class="campoform">
        <div class="tituloentradaform">Orden</div>
        <div class="valorentradaform">
          <select name="IDSETASSUBORDEN"></select>
        </div>    </li> 
      <li class="campoform">
        <div class="tituloentradaform">Clasificaci&oacute;n</div>
        <div class="valorentradaform">
          <select name="CLASIFICACION">
        <option value="Mortal" <?php if($Clasificacion == "Mortal") echo "selected=\"selected\""; ?>>Mortal</option>
        <option value="Venenosa" <?php if($Clasificacion == "Venenosa") echo "selected=\"selected\""; ?>>Venenosa</option>
        <option value="Sin valor culinario" <?php if($Clasificacion == "Sin valor culinario") echo "selected=\"selected\""; ?>>Sin valor culinario</option>
        <option value="Buena" <?php if($Clasificacion == "Buena") echo "selected=\"selected\""; ?>>Buena</option>
        <option value="Excelente" <?php if($Clasificacion == "Excelente") echo "selected=\"selected\""; ?>>Excelente</option>
        <option value="Sin clasificar" <?php if($Clasificacion == "Sin clasificar") echo "selected=\"selected\""; ?>>Sin clasificar</option>
      </select>
        </div>    </li> 
</ul>
</div>
<br class="limpiar" />
<div class="textolargo">
<ul class="tablaformtextolargo">
    
    <li class="campoform">
        <div class="tituloentradaform">Sombrero</div>
        <div class="valorentradaform">
          <textarea name="SOMBRERO" cols="80" rows="10" id="SOMBRERO"><?php echo $Sombrero; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Pie</div>
        <div class="valorentradaform">
          <textarea name="PIE" cols="80" rows="10" id="PIE"><?php echo $Pie; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Cuerpo</div>
        <div class="valorentradaform">
          <textarea name="CUERPO" cols="80" rows="10" id="CUERPO"><?php echo $Cuerpo; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Laminas</div>
        <div class="valorentradaform">
          <textarea name="LAMINAS" cols="80" rows="10" id="LAMINAS"><?php echo $Laminas; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Himenio</div>
        <div class="valorentradaform">
          <textarea name="HIMENIO" cols="80" rows="10" id="HIMENIO"><?php echo $Himenio; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Exporada</div>
        <div class="valorentradaform">
          <textarea name="EXPORADA" cols="80" rows="10" id="EXPORADA"><?php echo $Exporada; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Carne</div>
        <div class="valorentradaform">
          <textarea name="CARNE" cols="80" rows="10" id="CARNE"><?php echo $Carne; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Epoca y habitat</div>
        <div class="valorentradaform">
          <textarea name="EPOCAHABITAT" cols="80" rows="10" id="EPOCAHABITAT"><?php echo $EpocaHabitat; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Comestibilidad</div>
        <div class="valorentradaform">
          <textarea name="COMESTIBILIDAD" cols="80" rows="10" id="COMESTIBILIDAD"><?php echo $Comestibilidad; ?></textarea>
        </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Comentarios</div>
        <div class="valorentradaform">
          <textarea name="COMENTARIOS" cols="80" rows="10" id="COMENTARIOS"><?php echo $Comentarios; ?></textarea>
        </div>
        </li>
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Guardar Datos" />
        </div>    </li>    
</ul>
</div>
<input type="hidden" name="IDSETAS" value="<?php echo $idSetas;?>"/>
</form>
</div>


<br clear="left" />
<script type="text/javascript">
//document.formEntrada.CLASE.value='<?php echo $Clase; ?>';
//CambiarClase(document.formEntrada.CLASE.value);
InicializarClase('<?php echo $Clase; ?>');
</script>
</body>
</html>
