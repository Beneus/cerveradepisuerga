<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$Mostrar = '';
$Pag = $_GET["Pag"] ?? '';
$Publicado = $_GET["Publicado"] ?? '';
$idImagen = '';
// datos de la entrada del directorio
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Administraci&oacute;n Galer&iacute;a Banners</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
<script type="text/javascript">
	function stopUpload(){
      document.getElementById('barracargando').style.visibility = 'hidden';
      document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="galeria-banners.php";
	  	return true;   
}
function SeleccionPagina(x){
location.href = "administracion-banners-listado.php?Mostrar=<?php echo $Mostrar;?>&Publicado=<?php echo $Publicado;?>&Pag="+x.value;

}
function SeleccionPublicado(x){
location.href = "administracion-banners-listado.php?Mostrar=<?php echo $Mostrar;?>&Pag=<?php echo $Pag;?>&Publicado="+x.value;

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
  <div>
<img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" /> <map name="Map" id="Map">
<area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
</map>
</div>
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
<li><a href="galeria-banners.php" class="">Galeria de anuncios</a></li>
<li><a href="administracion-banners-gestion.php">Gesti&oacute;n de anuncios</a></li>
<li class="liselect"><a href="administracion-banners-listado.php" class="">Anuncios publicados</a></li>
</ul>
</div>
<div class="separador">&nbsp;</div>

<div id="contenido">

<?php

$link = ConnBDCervera();
$sql = "SELECT Pagina, Replace(Mid(Pagina,1,Instr(Pagina,'.php')-1),'http://www.cerveradepisuerga.eu/','') as Pag FROM BannersGestion as BGS inner join Banners as BNS on BGS.idBanner = BNS.idBanner group by Pag order by Pag ";
$accion = "onchange=\"SeleccionPagina(this);\"";
echo CrearSelect("PAGINA","Pagina","Pag",$sql,$link,"","","",$accion,$Pag);
?>
<label for="PUBLICADO">Estado: 
<select name="PUBLICADO" onchange="SeleccionPublicado(this);">
<option  value="">Todos</option>
<option  value="1" <?php if($Publicado=="1"){echo "selected=\"selected\"";} ?> >Publicado</option>
<option  value="0" <?php if($Publicado=="0"){echo "selected=\"selected\"";} ?> >No publicado</option>
</select></label>
<?php
// datos de la entrada del directorio
$link = ConnBDCervera();
$sql = " SELECT BNS.*,GBN.* FROM Banners as BNS inner join BannersGestion as GBN on BNS.idBanner = GBN.idBanner where 1 = 1 ";
if ($Pag != ""){
	$sql .= " And Pagina = '".$Pag."'";
}
if ($Publicado != ""){
	$sql .= " And Publicar = '".$Publicado."'";
}
$sql .= " order by GBN.Orden ";		

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
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

		$idBanner = $row["idBanner"];
		$idBannersGestion = $row["idBannersGestion"];
		$TextoBanner = $row["TextoBanner"];
		$UrlBanner = $row["UrlBanner"];
		$Banner = $row["Banner"];
		$Ancho = $row["Ancho"];
		$Alto = $row["Alto"];
		$Tamano = $row["Tamano"];
		$Orden = $row["Orden"];
		$Pagina = $row["Pagina"];
		$Publicar = $row["Publicar"];
		$FechaInicio = $row["FechaInicio"];
		$FechaFin = $row["FechaFin"];

		echo "<div class=\"galeriaImagen\"  id=\"Ban$idBannersGestion\">\n";
	  	echo "<div class=\"Imagen\">\n";
	  	echo "<img src=\"../Banners/". $idBanner ."/" .$Banner. "\" width=\"$Ancho\" height=\"$Alto\" border=\"0\" title=\"". $TextoBanner ."\"/>\n";
	  	echo "</div>\n";
	  	echo "<div class=\"DatosImagen\">\n";
	  	
		  echo "<ul>\n";
		  echo "<li>Fecha de inicio del anuncio: <strong>". FechaDerecho($FechaInicio) ."</strong></li>\n";
		  echo "<li>Fecha de finalizaci&oacute;n del anuncio: <strong>". FechaDerecho($FechaFin) ."</strong></li>\n";
		  echo "<li>Banner: ". $Banner ."</li>\n"; 
		  echo "<li>Anchura: ". $Ancho ." px.</li>\n";
		  echo "<li>Altura: ". $Alto ." px.</li>\n";
		  echo "<li>Tama&ntilde;o: ". $Tamano ."</li>\n";
		  echo "<li><strong>P&aacute;gina: </strong>". $Pagina ."</li>\n";
		  echo "<form name=\"formBanner$idBannersGestion\" >\n";
		  // T�tulo de imagen
		  echo "<li><span onclick=\"EditarBanner('TEXTOBANNER',$idBannersGestion);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el texto del banner\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el texto del banner\"><strong>Texto del banner(m&aacute;x 255): </strong></span><span id=\"TEXTOBANNER$idBannersGestion\" onclick=\"EditarBanner('TEXTOBANNER',$idBannersGestion);\" onmouseover=\"this.style.cursor='pointer';\">". $TextoBanner ."</span>";
		  echo "<input type=\"text\" name=\"TEXTOBANNER\" value=\"".$TextoBanner."\" style=\"display:none\" disabled=\"disabled\" onBlur=\"GuardarDatosBanner('TEXTOBANNER',$idBannersGestion);\" onchange=\"TextoModificado=true;\" size=\"70\" maxlength=\"100\" class=\"textoimagen\" /></li>\n";
		  // Pie de imagen
		  echo "<li><span onclick=\"EditarBanner('URLBANNER',$idBannersGestion);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar la Url del banner\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar la Url del banner\"><strong>Url del banner (m&aacute;x 255): </strong></span><span id=\"URLBANNER$idBannersGestion\" onclick=\"EditarBanner('URLBANNER',$idBannersGestion);\" onmouseover=\"this.style.cursor='pointer';\">". urldecode($UrlBanner) ."</span>";
		  echo "<textarea name=\"URLBANNER\" cols=\"45\" rows=\"2\" disabled=\"disabled\" style=\"display:none\" onblur=\"GuardarDatosBannerGestion('URLBANNER',$idBannersGestion);\" onchange=\"TextoModificado=true;\"  class=\"textoimagen\"></textarea>";
		 	// Publicar 
			echo "<li><strong>Publicar: </strong><input type=\"checkbox\" name=\"PUBLICAR\" value=\"$idImagen\" onclick=\"PublicarBanner($idBannersGestion,this);\" ";
		 	if($Publicar){echo "checked";}
		 	echo "/></li>\n";
			// Eliminar
		 	echo "<li><img onmouseover=\"this.style.cursor='pointer';\" src=\"images/eliminarfoto.gif\" alt=\"Eliminar foto\" width=\"50\" height=\"25\" onClick=\"EliminarBannersGestion(".$idBannersGestion.")\" /></li>";
		 	echo "</form>\n";
		 	// Asociacion de imagenes
		 	
		 	
		 	echo "<li><strong>Intercambiar posici&oacute;n: </strong><input type=\"checkbox\" name=\"POSICION\" value=\"$idBannersGestion\" onclick=\"IntercambiarBannersGestion(this);\" /></li>";
		  echo "</ul>\n";
		  
	  echo "</div>\n";
		echo "</div>\n";
	
	 
	
	}
	echo "<nobr clear=\"left\" ></nobr>\n";
	
}
mysqli_free_result($result);
mysqli_close($link);	
?>
</div>
<br clear="left" />
</body>
</html>
