<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$idDeporte = $_GET["idDeporte"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
$Buscar= $_GET["Buscar"] ?? '';
$Ano= $_GET["Ano"] ?? '';
$Dia= $_GET["Dia"] ?? '';
$Mes= $_GET["Mes"] ?? '';
$FechaNoticia = '';
$ErrorMsn = '';

$link = ConnBDCervera();
$sql = "SELECT DEP.*, IM.Path as ImgPath, IM.Archivo as ImgArchivo, IM.AnchoThumb, IM.AltoThumb, DOC.Path as DocPath, DOC.Archivo as DocArchivo FROM Deportes as DEP "
		. " left join Imagenes as IM on DEP.ImgDescripcion = IM.idImagen "
    . " left join Documentos as DOC ON DEP.docDeporte = DOC.idDoc where idDeporte = $idDeporte ";
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
	
	
	$idDeporte = $row["idDeporte"] ?? '';
	$ActoDeportivo = $row["ActoDeportivo"] ?? '';
	$idNucleoUrbano = $row["idNucleoUrbano"] ?? '';
	$Lugar = $row["Lugar"] ?? '';
	if(!is_null($row["Hora"] ?? '')){
	$Hora = date("H:i", strtotime($row["Hora"] ?? ''));
	}else{
	$Hora = NULL;
	}
	$FechaInicio = FechaDerecho($row["FechaInicio"] ?? '');
	$FechaFinal = FechaDerecho($row["FechaFinal"] ?? '');
	$Contacto = $row["Contacto"] ?? '';
	$Email = $row["Email"] ?? '';
	$Url = $row["Url"] ?? '';
	$Precio = $row["Precio"] ?? '';
	$Telefono = $row["Telefono"] ?? '';
	$Descripcion = $row["Descripcion"];
	$ImgNoticia = $row["ImgNoticia"] ?? ''; 
	$DocNoticia = $row["DocNoticia"] ?? ''; 
	$ImgArchivo = $row["ImgArchivo"] ?? ''; 
	$ImgPath = $row["ImgPath"] ?? '';
	$AnchoThumb = $row["AnchoThumb"] ?? '';
	$AltoThumb = $row["AltoThumb"] ?? '';
	$DocArchivo = $row["DocArchivo"] ?? ''; 
	$DocPath = $row["DocPath"] ?? ''; 
	
	
	
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
<form id="formEntrada" method="post" name="formEntrada" action="deportes-editar.php" onsubmit="EnviarEntradaDeportes(this,'editar');return false;">
<input type="hidden" name="IDDEPORTE" value="<?PHP echo $idDeporte;?>" />
<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Acto deportivo</div>
      <div class="valorentradaform">
        <input name="ACTODEPORTIVO" type="text" id="ACTODEPORTIVO" value="<?php echo $ActoDeportivo; ?>" size="35" />
      </div>
     </li>
     <li class="campoform">
      <div class="tituloentradaform">Lugar</div>
      <div class="valorentradaform">
        <input name="LUGAR" type="text" id="LUGAR" value="<?php echo $Lugar; ?>" size="35" />
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
        </div>    </li>  
     <li class="campoform">
        <div class="tituloentradaform">Hora </div>
        <div class="valorentradaform">
          <input name="HORA" type="text" id="HORA" value="<?php echo $Hora; ?>" size="5" maxlength="5" />
          (hh:mm)
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Fecha Inicio</div>
        <div class="valorentradaform"><input name="FECHAINICIO" type="text" id="FECHAINICIO" value="<?php echo $FechaInicio; ?>" size="10" maxlength="10" />
          (dd/mm/aaaa)         </div>
        </li>
        <li class="campoform">
        <div class="tituloentradaform">Fecha Finalizaci&oacute;n</div>
        <div class="valorentradaform"><input name="FECHAFINAL" type="text" id="FECHAFINAL" value="<?php echo $FechaFinal; ?>" size="10" maxlength="10" />
          (dd/mm/aaaa)         </div>
        </li>
         
        
       
       
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
  <li class="campoform">
        <div class="tituloentradaform">Email</div>
        <div class="valorentradaform">
          <input name="EMAIL" type="text" id="EMAIL" value="<?php echo $Email; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">URL</div>
        <div class="valorentradaform">
          <input name="URL" type="text" id="URL" value="<?php echo $Url; ?>" size="35" />
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Contacto</div>
        <div class="valorentradaform">
          <input name="CONTACTO" type="text" id="CONTACTO" value="<?php echo $Contacto; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Precio</div>
        <div class="valorentradaform">
          <input name="PRECIO" type="text" id="PRECIO" value="<?php echo $Precio; ?>" />
        </div>    
         </li>    
      <li class="campoform">
        <div class="tituloentradaform">Tel&eacute;fono</div>
        <div class="valorentradaform">
          <input name="TELEFONO" type="text" id="TELEFONO" value="<?php echo $Telefono; ?>" size="16" maxlength="16" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a fotogr&aacute;fica</div>
        <div class="valorentradaform"><a href="galeria-fotografica.php?Ambito=Deportes&idAmbito=<?php echo $idDeporte;?>&Campo=idDeporte&NCampo=ActoDeportivo&Referer=deportes-editar.php" >Galeria de imagenes</a></div>    
         </li>  
          <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a documentos</div>
        <div class="valorentradaform"><a href="galeria-documentos.php?Ambito=Deportes&idAmbito=<?php echo $idDeporte;?>&Campo=idDeporte&NCampo=ActoDeportivo&Referer=deportes-editar.php" >Galeria de documentos</a></div>    
         </li>  
        
        
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
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Publicar Acto Deportivo" />

<?php
$volver = 'location.href="deportes-listado.php?Mostrar=' . $Mostrar . '&Pagina=' . $Pagina . '&Buscar=' . $Buscar . '&idNucleoUrbano=' . $_GET["idNucleoUrbano"] . '&Ano=' . $Ano . '&Dia=' . $Dia . '&Mes='. $Mes .'"';
?>
<input type="button" name="VOLVER" id="VOLVER" value="Volver al listado" onclick='<?= $volver ?>' />
        </div>    
     </li>    
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
