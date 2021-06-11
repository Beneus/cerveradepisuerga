<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idNoticia = $_GET["idNoticia"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';

$link = ConnBDCervera();
$sql = "SELECT NOTI.*, IM.Path as ImgPath, IM.Archivo as ImgArchivo, IM.AnchoThumb, IM.AltoThumb, DOC.Path as DocPath, DOC.Archivo as DocArchivo FROM Noticias as NOTI "
		. " left join Imagenes as IM on NOTI.ImgNoticia = IM.idImagen "
    . " left join Documentos as DOC ON NOTI.docNoticia = DOC.idDoc where idNoticia = $idNoticia ";
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
	$Titulo = $row["Titulo"];
	$Entradilla = $row["Entradilla"];
	$FechaNoticia = FechaDerecho($row["FechaNoticia"]);
	$Fuente = $row["Fuente"];
	$ImgNoticia = $row["ImgNoticia"]; 
	$DocNoticia = $row["DocNoticia"]; 
	$Cuerpo = $row["Cuerpo"]; 
	$ImgArchivo = $row["ImgArchivo"]; 
	$ImgPath = $row["ImgPath"];
	$AnchoThumb = $row["AnchoThumb"];
	$AltoThumb = $row["AltoThumb"];
	$DocArchivo = $row["DocArchivo"]; 
	$DocPath = $row["DocPath"]; 
	
	
	
	if ($FechaNoticia == "0000-00-00 00:00:00")$FechaNoticia = "";
}else{
	header("Location:noticias-listado.php");
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
<title>Gestor de contenidos: Noticias editar</title>
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
      //document.getElementById('barracargando').style.visibility = 'hidden';
      //document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="noticias-editar.php?idNoticia=<?php echo $idNoticia;?>";
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
<form enctype="multipart/form-data" name="formEntrada" id="formEntrada" onsubmit="EnviarEntradaNoticias(this,'editar');return false;" method="post">
<div class="textolargo">
<ul class="tablaformtextolargo">
    <li class="campoform">
      <div class="tituloentradaform">T&iacute;tulo</div>
      <div class="valorentradaform">
        <input name="TITULO" type="text" id="TITULO" value="<?php echo $Titulo; ?>" size="106" maxlength="100" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Entradilla</div>
        <div class="valorentradaform"><textarea name="ENTRADILLA" cols="80" rows="5" class="mceNoEditor" id="ENTRADILLA"><?php echo $Entradilla; ?></textarea>
         </div>
        </li>
       <li class="campoform">
        <div class="tituloentradaform">Fecha</div>
        <div class="valorentradaform"><input name="FECHANOTICIA" type="text" id="FECHANOTICIA" value="<?php echo $FechaNoticia; ?>" size="10" maxlength="10" />
        (dd/mm/aaaa)
         </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Fuente</div>
        <div class="valorentradaform"><input name="FUENTE" type="text" id="FUENTE" value="<?php echo $Fuente; ?>" size="50" />
         </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Cuerpo de la noticia</div>
        <div class="valorentradaform"><textarea name="CUERPO" cols="80" rows="20" id="CUERPO"><?php echo $Cuerpo; ?></textarea>
         </div>
        </li>
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Enviar" />
        <input type="button" name="VOLVER" id="VOLVER" value="Volver al listado" onclick="location.href='noticias-listado.php?Mostrar=<?php echo $Mostrar; ?>&Pagina=<?php echo $Pagina; ?>'"/>
        </div>    </li>    
</ul>
</div>
	<input type="hidden" name="IDNOTICIA" value="<?php echo $idNoticia;?>"/>
</form>
</div>
<div id="contenido2">


<div class="textolargo">
<ul class="tablaformtextolargo">
 <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a fotogr&aacute;fica</div>
        <div class="valorentradaform"><a href="galeria-fotografica.php?Ambito=Noticias&idAmbito=<?php echo $idNoticia;?>&Campo=idNoticia&NCampo=Titulo&Referer=noticias-editar.php" >Galeria de imagenes</a></div>    
         </li>  
          <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a documentos</div>
        <div class="valorentradaform"><a href="galeria-documentos.php?Ambito=Noticias&idAmbito=<?php echo $idNoticia;?>&Campo=idNoticia&NCampo=Titulo&Referer=noticias-editar.php" >Galeria de documentos</a></div>    
         </li>  
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
         <label>
         <input type="button" name="VOLVER2" id="VOLVER2" value="Volver al listado" onclick="location.href='noticias-listado.php?Mostrar=<?php echo $Mostrar; ?>&amp;Pagina=<?php echo $Pagina; ?>'"/>
         </label>
        </div>    
     </li>    
</ul>
</div>
</div>
<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>

</body>
</html>
