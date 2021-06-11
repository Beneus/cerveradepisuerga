<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


// datos de la entrada del directorio

$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';

$link = ConnBDCervera();

if(($_SESSION["TipoUsuario"]!= "ADMIN") AND ($_SESSION["TipoUsuario"]!= "USERCIT")){ 
$sql = " Select * from NucleosUrbanos as NU ";
$sql = $sql . " INNER JOIN UsuariosAcceso as UA ON NU.idNucleoUrbano = UA.idAmbito ";
$sql = $sql . " where idNucleoUrbano = " . $idNucleoUrbano;
}else{
$sql = " Select * from NucleosUrbanos where idNucleoUrbano = $idNucleoUrbano ";
}
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
	$NombreNucleoUrbano = $row["NombreNucleoUrbano"] ?? '';
	$idArea = $row["idArea"] ?? '';
	$CodigoPostal = $row["CodigoPostal"] ?? ''; 
	$Altitud = $row["Altitud"] ?? '';
	$Latitud = $row["Latitud"] ?? '';
	$Longitud = $row["Longitud"] ?? '';
	$GoogleMaps = $row["GoogleMaps"] ?? '';
	$Descripcion = $row["Descripcion"] ?? '';
	$Historia = $row["Historia"] ?? '';
	$Imagenes = $row["Imagenes"] ?? '';

}else{
	header("Location:localidades-listado.php");
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
<title>Gestor de contenidos: Localidades editar</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="scripts/tiny_mce.js"></script>
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
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
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
<script type="text/javascript">

var Latitud = "<?php echo $Latitud; ?>";
var Longitud = "<?php echo $Longitud; ?>";
var idTime;
 function redondea(sVal, nDec){
    var n = parseFloat(sVal);
    var s = "0.00";
    if (!isNaN(n)){
     n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec);
     s = String(n);
     s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1);
     s = s.substr(0, s.indexOf(".") + nDec + 1);
    }
    return s;
   }

   function ponDecimales(nDec){
    document.frm.t1.value = redondea(document.frm.t1.value, nDec);
    document.frm.t2.value = redondea(document.frm.t2.value, nDec);
   } 
function PosicionarMapa(direccion){
	idTime = setInterval("CambiarMapa('"+direccion+"')",50);
}
function CambiarMapa(direccion){
	var posLat = parseFloat(Latitud);
	var posLon = parseFloat(Longitud);
	switch (direccion){
		case "N": Latitud = posLat + 0.0001;document.formEntrada.LATITUD.value=redondea(Latitud,6);break;
		case "S": Latitud = posLat - 0.0001;document.formEntrada.LATITUD.value=redondea(Latitud,6);break;
		case "E": Longitud = posLon + 0.0001;document.formEntrada.LONGITUD.value=redondea(Longitud,6);break;
		case "O": Longitud = posLon - 0.0001;document.formEntrada.LONGITUD.value=redondea(Longitud,6);break;
	}
	initialize();
}

window.onload = init;

</script>
<script src="js/googlemaps.js" type="text/javascript"></script>
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
   <?php if(($_SESSION["TipoUsuario"]== "ADMIN") OR ($_SESSION["TipoUsuario"]== "USERCIT")){ ?>
<li><a title="A&ntilde;adir entrada al directorio" href="monumentos-entrada.php">A&ntilde;adir entrada</a></li>
<?php }?>
    <li><a title="Listado del directorio"  href="localidades-listado.php">Listado</a> 
      <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
    </li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form enctype="multipart/form-data" name="formEntrada" id="formEntrada" onsubmit="EnviarEntradaNucleoUrbano(this,'editar');return false;">
<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Nucleo urbano</div>
      <div class="valorentradaform">
        <input name="NOMBRENUCLEOURBANO" type="text" id="NOMBRENUCLEOURBANO" value="<?php echo $NombreNucleoUrbano; ?>" size="35" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Area</div>
        <div class="valorentradaform"><?php 
	  	$link = ConnBDCervera();
		$sql = "SELECT distinct idArea, NombreArea FROM Areas order by NombreArea";
	  	echo CrearSelect("IDAREA","idArea","NombreArea",$sql,$link,"","","","",$idArea);
	  ?>
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">C&oacute;digo postal</div>
        <div class="valorentradaform">
          <input name="CODIGOPOSTAL" type="text" id="CODIGOPOSTAL" value="<?php echo $CodigoPostal; ?>" size="5" maxlength="5" />
        </div>    </li>
     <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a fotogr&aacute;fica</div>
        <div class="valorentradaform"><a href="galeria-fotografica.php?Ambito=NucleosUrbanos&idAmbito=<?php echo $idNucleoUrbano;?>&Campo=idNucleoUrbano&NCampo=NombreNucleoUrbano&Referer=localidades-editar.php" >Galeria de imagenes</a></div>    
     </li>   
      <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a documentos</div>
        <div class="valorentradaform"><a href="galeria-documentos.php?Ambito=NucleosUrbanos&idAmbito=<?php echo $idNucleoUrbano;?>&Campo=idNucleoUrbano&NCampo=NombreNucleoUrbano&Referer=localidades-editar.php" >Galeria de documentos</a></div>    
     </li>   
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
    
    <li class="campoform">
      <div class="tituloentradaform">Latitud</div>
      <div class="valorentradaform">
        <img src="images/arriba.gif" alt="M�s al Norte" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('N');" onmouseup="clearInterval(idTime);;" onmouseout="clearInterval(idTime);" />
        <input name="LATITUD" type="text" id="LATITUD" value="<?php echo $Latitud; ?>" size="16" align="right" onchange="Latitud = this.value;initialize();" />
        <img src="images/abajo.gif" alt="M�s al Sur" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('S');" onmouseup="clearInterval(idTime);" onmouseout="clearInterval(idTime);" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Longitud</div>
        <div class="valorentradaform"><img src="images/izq.gif" alt="M�s al Oeste" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('O');" onmouseup="clearInterval(idTime);;" onmouseout="clearInterval(idTime);" /> <input name="LONGITUD" type="text" id="LONGITUD" value="<?php echo $Longitud; ?>" size="16" align="right" onchange="Longitud = this.value;initialize();" />
       <img src="images/der.gif" alt="M�s al Este" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';"  onmousedown="PosicionarMapa('E');" onmouseup="clearInterval(idTime);" onmouseout="clearInterval(idTime);" />
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">Altitud</div>
        <div class="valorentradaform">
          <input name="ALTITUD" type="text" id="ALTITUD" value="<?php echo $Altitud ?>" size="4" maxlength="4" /> 
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
        <textarea name="DESCRIPCION" cols="80" rows="10" id="DESCRIPCION"><?php echo $Descripcion; ?></textarea>
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Historia</div>
        <div class="valorentradaform"><textarea name="HISTORIA" cols="80" rows="10" id="HISTORIA"><?php echo $Historia; ?></textarea>
         </div>
        </li>
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Guardar Datos" />
        </div>    </li>    
        <li class="campoform">
        <div class="tituloentradaform">Google Maps</div>
        <div class="valorentradaform"><div id="mapa" style="width: 400px; height: 280px" ></div></div>    
        </li>    
</ul>
</div>
<input type="hidden" name="IDNUCLEOURBANO" value="<?php echo $idNucleoUrbano;?>"/>
</form>
</div>

<br clear="left" />
</body>
</html>
