<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");
$link = ConnBDCervera();

$NombreComercial = '';
if(isset($_GET["idDirectorio"])){$idDirectorio = $_GET["idDirectorio"];}
else{$idDirectorio = "";}
if(isset($_GET["idServicio"])){$idServicio = $_GET["idServicio"];}
else {$idServicio = "";}
if(isset($_GET["idSubServicio"])){$idSubServicio = $_GET["idSubServicio"];}
else {$idSubServicio = "";}

if ($idDirectorio == ""){
	header("Location:directorio.php");
	exit;
}

if ($idSubServicio == ""){
$sql = "SELECT NombreServicio FROM Servicios WHERE Servicios.idServicio = $idServicio ";
}else{
$sql = "SELECT NombreServicio,NombreSubServicio FROM Servicios "
			."inner join SubServicios on Servicios.idservicio = SubServicios.idservicio "
			."WHERE Servicios.idServicio = $idServicio "
			."AND  SubServicios.idSubServicio = $idSubServicio ";
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
$NombreServicio = $row["NombreServicio"] ?? '';
	if ($idSubServicio != ""){
		$NombreSubServicio = $row["NombreSubServicio"] ?? '';
	}
}
mysqli_free_result($result);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Servicios +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT D.*,NU.NombreNucleoUrbano, DS.idServicio FROM Directorio as D\n"
    . "inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio\n"
    . "inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano\n"
    . "WHERE D.idDirectorio = $idDirectorio "
    . "order by NombreComercial "	;

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

$clasefila = "filagris";
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($clasefila == "filagris" ){
			$clasefila = "filablanca";
		}else{
			$clasefila = "filagris";
		}
$NombreComercial = $row["NombreComercial"] ?? '';
$Direccion = $row["Direccion"] ?? '';
$NombreNucleoUrbano = $row["NombreNucleoUrbano"] ?? '';
$idNucleoUrbano = $row["idNucleoUrbano"] ?? '';
$Telefono = $row["Telefono"] ?? '';
$Movil = $row["Movil"] ?? '';
$Fax = $row["Fax"] ?? '';
$Email = $row["Email"] ?? '';
$URL = $row["URL"] ?? '';
$Contacto = trim($row["NombreContacto"]. " " . $row["Apellido1Contacto"]. " " . $row["Apellido2Contacto"]);
$Latitud = $row["Latitud"] ?? '';
$Longitud = $row["Longitud"] ?? '';
$ImgDescripcion = $row["ImgDescripcion"] ?? '';
$FechaCreacion = $row["FechaCreacion"] ?? '';
$Prestaciones = $row["Prestaciones"] ?? '';
$Descripcion = html_entity_decode($row["Descripcion"]);
if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Directorio&idAmbito=$idDirectorio&Campo=idDirectorio&Att=NombreComercial\" title=\"Contacta con el responsable de $NombreComercial\">Contacta</a>";}
}
mysqli_free_result($result);
mysqli_close($link);


$link = ConnBDCervera();

$sql = "SELECT DISTINCT D.idDirectorio,DSB.idSubServicio, D.NombreComercial, NU.NombreNucleoUrbano,SB.NombreSubServicio,SB.icono FROM Directorio as D "
			." inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio "
			." inner join Servicios as S on DS.idServicio = S.idServicio "
			." inner join DirectorioSubServicio as DSB on D.idDirectorio = DSB.idDirectorio "
			." inner join SubServicios as SB on DSB.idSubServicio = SB.idSubServicio AND SB.idServicio = S.idServicio "
			." inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano "
			." where DS. idDirectorio = $idDirectorio order by NU.NombreNucleoUrbano, NombreComercial";


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

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

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	if ($row["icono"]!= ""){
		$imagenhtml = "<img src=\"iconos/".$row["icono"]."\" alt=\"".$row["NombreSubServicio"]."\" title=\"".$row["NombreSubServicio"]."\" style=\"float:left;padding-right:5px;padding-bottom:5px;\"/>";
	}
}
}else{
	// No hay entradas en el directorio
?>
<div class="errortexto">No hay Rutas establecidas</div>
<?php
}
mysqli_free_result($result);
	

$MetaTitulo = $NombreComercial ." ". $NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo .", direccion:" . $Direccion .", " . $NombreServicio .", " .$NombreSubServicio;
$MetaKeywords =  GenKeyWords($MetaDescripcion,3);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<title><?php echo $MetaTitulo; ?></title>
<!-- MetaNmaes -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="title" content= "<?php echo $MetaTitulo; ?>" />
<meta http-equiv="title" content= "<?php echo $MetaTitulo; ?>" />
<meta name="description" content="<?php echo $MetaDescripcion; ?>"/>
<meta http-equiv="description" content="<?php echo $MetaDescripcion; ?>"/>
<meta http-equiv="keywords" content="<?php echo $MetaKeywords; ?>"/> 
<meta name="keywords" content="<?php echo $MetaKeywords; ?>"/> 
<meta name="author" content="CIT Cervera de Pisuerga"/> 
<meta name="VW96.objecttype" content="Document" />
<meta name="DC.Language" scheme="RFC1766" content="Spanish" />
<meta name="language" content="es"/>
<meta name="distribution" content="global"/>
<meta name="resource-type" content="Document"/>
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache"/>
<meta name="Revisit" content="1 day"/>
<meta name="robots" content="index,follow,all"/>
<meta name="verify-v1" content="RSARgq/bC4qUh16fvW8t0J5vVri9xlZNdDvjFNqsHpk=" />
<meta name="msvalidate.01" content="3685710D7DF55A6B09BFC9F6D0B19B06" />
<!-- MetaNmaes -->
<!-- CSS -->
<link href="css/menu.css" rel="stylesheet" type="text/css" media="screen" title="normal"/>
<link href="css/menu-contraste.css" rel="alternate stylesheet" type="text/css" media="screen" title="contraste"/>
<link href="css/estructura.css" rel="stylesheet" type="text/css" media="screen" title="normal"/>
<link href="css/estructura-contraste.css" rel="alternate stylesheet" type="text/css" media="screen" title="contraste"/>
<link href="css/directorio.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="print" href="css/print.css" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<!-- CSS -->
<!-- SCRIPTS -->
<script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
<script src="js/jquery.lightbox.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.funciones.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$(".lightbox").lightbox();
	});
	
</script>
<script type="text/javascript">

var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

</script>
<script type="text/javascript">

try {
var pageTracker = _gat._getTracker("UA-7481428-1");
pageTracker._trackPageview();
} catch(err) {}

</script>
<!-- SCRIPTS -->
</head>
<body>
<div id="cuerpo">
<div id="izq">
</div>
<div id="der"><a href="http://www.cerveradepisuerga.eu/" title="CIT Cervera de Pisuerga"><img src="images/LOGO-CIT-CERVERA.gif" alt="CIT Cervera de Pisuerga" name="imgCIT" width="99" height="100" hspace="30" align="middle" id="imgCIT" /></a>
<div id="menu">
	<ul>
		<li><a href="index.php" title="inicio" accesskey="i" hreflang="es">Inicio</a></li>
		<li><a href="localizacion.php"  title="localizaci&oacute;" accesskey="l" hreflang="es">Localizaci�n</a></li>
		<li><a href="que-ofrecemos.php" title="qu� ofrecemos"  accesskey="q" hreflang="es">Qu� ofrecemos</a></li>
		<!-- <li><a href="que-creamos.html">Qu� creamos</a></li> -->
		<li><a href="agenda.php" title="agenda" accesskey="a" hreflang="es">Agenda</a></li>
        <li><a href="area-municipal.php" title="localidades" accesskey="p" hreflang="es">Localidades</a></li>
        <li><a href="noticias.php" title="noticias" accesskey="n" hreflang="es">Noticias</a></li>
        <li><a href="directorio.php" class="seleccion">Directorio</a></li>
        <li><a href="mapa-web.php" title="Mapa Web">Mapa Web</a></li>
<li><a href="http://cerveradepisuerga.sedeelectronica.es" title="Ayuntamiento de Cervera de Pisuerga" target="_Blank" accesskey="y" hreflang="es">Ayuntamiento</a></li>
	</ul>
</div>
<p class="banner">
<?php
ColocarBanners();
?>
</p>
<p class="validator">
<img src="http://chart.apis.google.com/chart?cht=qr&chs=160x160&chl=<?php echo curPageURL();?>&chld=H|0" width="160" height="160" alt="QR de cerveradepieuerga.eu" longdesc="<?php echo curPageURL();?>" />
<br />
<a href="http://validator.w3.org/check?uri=referer" hreflang="en" title="Valid XHTML 1.0 Transitional">
<img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a><br/><a href="http://jigsaw.w3.org/css-validator/check/referer" hreflang="en" title="�CSS V�lido!">
<img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="�CSS V�lido!" width="88" height="31" style="border:0;width:88px;height:31px" /></a><br/>
<a href="http://www.w3.org/WAI/WCAG1AAA-Conformance"	title="Explicaci�n del Nivel Triple-A de Conformidad"><img height="31" width="88" src="http://www.w3.org/WAI/wcag1AAA-blue.gif" alt="Icono de conformidad con el Nivel Triple-A, de las Directrices de Accesibilidad para el Contenido Web 1.0 del W3C-WAI"/></a>
</p>
</div>
<div id="centro">
<div id="cab"><a href="/" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina"><img src="images/cab2.gif" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" width="624" height="103" /></a></div>
<div id="contenido"><div class="Fuentes"><a href="#" rel="contraste" id="CSS"><img src="images/contraste.png" alt="Alto contraste" width="32" height="32" title="Alto contraste"/></a><img src="images/fuentemas.png" name="etiqueta" id="FuenteMas" title="Aumentar el tama�o de la fuente de la pagina, tecla +" alt="Aumentar el tama�o de la fuente de la pagina, tecla +" width="32" height="32" /><img src="images/fuentemenos.png" name="etiqueta" id="FuenteMenos" title="Disminuir el tama�o de la fuente de la pagina, tecla -" alt="Disminuir el tama�o de la fuente de la pagina, tecla -" width="32" height="32" />
</div><div class="MigasdePan">
<a href="directorio.php" alt='Directorio' title='Directorio'>Directorio</a> 
<?php if ($idServicio != "") {?>
> <a href='directorio-listado.php?idServicio=<?php echo $idServicio; ?>' alt='<?php echo $NombreServicio; ?>' title='<?php echo $NombreServicio; ?>'><?php echo $NombreServicio; ?></a>
<?php }if ($idSubServicio != "") {?>
> <a href='directorio-listado.php?idServicio=<?php echo $idServicio; ?>&idSubServicio=<?php echo $idSubServicio; ?>' alt='<?php echo $NombreSubServicio; ?>' title='<?php echo $NombreSubServicio; ?>'><?php echo $NombreSubServicio; ?></a>
<?php } if ($idDirectorio != "") {?>
> <a href='directorio-detalle.php?idDirectorio=<?php echo $idDirectorio; ?>&idServicio=<?php echo $idServicio; ?>&idSubServicio=<?php echo $idSubServicio; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>' alt='<?php echo $NombreComercial; ?>' title='<?php echo $NombreComercial; ?>'><?php echo $NombreComercial; ?></a>
<?php } ?>
</div>
   <h3>Directorio</h3>
   
<div class="texto">
<?php
if($ImgDescripcion > 0){
   		$link = ConnBDCervera();
   		$sql = "select * from Imagenes where idImagen = $ImgDescripcion and Publicar = 1 ";
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			$max = mysqli_num_rows($result);	
			if($max > 0){
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$Path = $row["Path"];
				$Archivo = $row["Archivo"];
				$Titulo = $row["Titulo"];
				$Pie = $row["Pie"]; 
				$Ancho = $row["Ancho"];
				$Alto = $row["Alto"];
				$AnchoThumb = $row["AnchoThumb"];
				$AltoThumb = $row["AltoThumb"];
				echo "<a href=\"$Path/$Archivo\"  class='lightbox' title='$Titulo'><img src=\"".str_replace("images","thumb",$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" /></a>";
			}
			mysqli_free_result($result);
			mysqli_close($link);	
   		
   		
   	}

?>
<?php echo IconosSubservicio($idDirectorio,$idServicio);	?><br/><br/>
<span class="strDirectorio"><?php echo $NombreComercial; ?></span>
<a href="directorio-detalle.php?idDirectorio=<?php echo $row["idDirectorio"];?>&idServicio=<?php echo $idServicio;?>&idSubServicio=<?php echo $idSubServicio;?>&idNucleoUrbano=<?php echo $row["idNucleoUrbano"];?>" class="strDirectorio"><?php echo $row["NombreComercial"];?></a>
<ul>
<?php if($Direccion != ""){ ?>
<li><span class="DatosTitulo">Direcci�n</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
<?php } if($NombreNucleoUrbano != ""){ ?>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<?php } if($Telefono != ""){ ?>
<li><span class="DatosTitulo">Tel�fono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
<?php } if($Movil != ""){ ?>
<li><span class="DatosTitulo">Movil</span><span class="DatosValor"><?php echo MostrarTelefono($Movil);?></span></li>
<?php } if($Fax != ""){ ?>
<li><span class="DatosTitulo">Fax</span><span class="DatosValor"><?php echo MostrarTelefono($Fax);?></span></li>
<?php } if($Email != ""){ ?>
<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
<?php } if($URL != ""){ ?>
<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Museo;?>" target="_blank"><?php echo $URL;?></a></span></li>
<?php } ?>
</ul>
</div>		
<?php
	echo "</ul>";
?>
<?php

if(trim($Descripcion) != ""){
   		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/descripcion.png\" width=\"280\" height=\"50\" alt=\"Descripci�n\"  name=\"etiqueta\"/>";
   		echo "</div>";
   		echo "<div class=\"texto\">";
  		echo $Descripcion; 
   		echo "<br clear=\"left\" /> ";
   		echo "</div>";
		echo "<br clear=\"left\" /> ";
}
$link = ConnBDCervera();
// listado de documentos asociados
$sql = "select * from Documentos where Ambito = 'Directorio' and idAmbito = $idDirectorio and Publicar = 1 order by Orden";

   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			
			$max = mysqli_num_rows($result);	
	
			if($max > 0){
			echo "<div class=\"etiqueta\"> ";
			echo "<img src=\"images/documentos.png\" width=\"280\" height=\"50\" name=\"etiqueta\"/>";
			echo "</div>";
	   		echo "<div class='texto'><ul>";
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$DocTitulo = $row["Titulo"];
				$DocPie = $row["Pie"];				
				
				if ($DocTitulo != ""){
				
				echo "<li>";
				echo "<a href=\"".$row["Path"]."/".$row["Archivo"]."\" title=\"".$row["Titulo"]."\">".$DocTitulo."</a>";
				if ($DocPie != ""){echo "<p>$DocPie</p>";}
				echo "</li>";
				
				}else{
				echo "<li><a href=\"".$row["Path"]."/".$row["Archivo"]."\" title=\"".$row["Titulo"]."\">".$row["Archivo"]."</a></li>";
				}
			}
			echo "</ul></div>";
	   	}
	   	mysqli_free_result($result);

// Prestaciones de servicio
if (trim($Prestaciones) !=""){
$Prestaciones = explode(",", $Prestaciones);
echo "<div class=\"etiqueta\"> ";
echo "<img src=\"images/servicios.png\" width=\"280\" height=\"50\" name=\"etiqueta\"/>";
echo "</div>";
echo "<div class=\"texto\">";


$link = ConnBDCervera();
		$sql = "SELECT distinct * FROM Iconos WHERE Codigo in ('" . implode("','",$Prestaciones)."') order by Orden";
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
			$NumReg = 0;
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$NumReg ++;

				$idIcono =$row["idIcono"];
				$Codigo =$row["Codigo"];
				$Nombre =$row["Nombre"];
				$Imagen =$row["Imagen"];
					echo "<div class=\"IconosTurismo\">";
					echo "<img src=\"iconos/Turismo/$Imagen\" weight=\"32\" height=\"32\" title=\"$Nombre\" />";
					echo "<span class=\"letraIcono\"> $Nombre</span>";
					echo "</div>";
				if (($NumReg % 2) ==0){
					echo "<br clear=\"left\" />";
				}
				
				
				}
		}
echo "</div>";
}
if ($Latitud != "" and $Longitud != ""){?>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
<script type="text/javascript">
<!--

html = '<div style=\"width:210px; padding-right:10px;text-align: left;\"><?php echo IconosSubservicio($idDirectorio,$idServicio);	?>'+
'<strong><br clear=\"left\"/><?php echo $NombreComercial; ?></strong></div>';
galleta = "<?php echo $NombreComercial; ?>";
var Latitud = "<?php echo $Latitud; ?>";
var Longitud = "<?php echo $Longitud; ?>";

//-->
</script>
<script src="js/googlemapsmuseo.js" type="text/javascript"></script>
	<br class="limpiar" />
    <div class="texto">
	<div id="mapa" style="width: 100%; height: 300px" ></div>
	</div>
<?php } ?>

 <?php
   		$sql = "select * from Imagenes where Ambito = 'Directorio' and idAmbito = $idDirectorio and Publicar = 1 ";
   		$link = ConnBDCervera();
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			
			$max = mysqli_num_rows($result);	
	
			if($max > 0){
	   		echo "<div class='texto'>";
			echo"<a href='galeriafotografica.php?Ambito=Directorio&idAmbito=$idDirectorio&Origen=directorio-detalle.php&Campo=idDirectorio&idServicio=$idServicio&idSubServicio=$idSubServicio'>";
			echo "<img src='images/galeriafotografica.png' name='etiqueta' alt='Galer�a fotogr�fica' title='Galer�a fotogr�fica, tecla K' width='280' height='50'  />";
			echo "</a></div>";
	   	}
	   	mysqli_free_result($result);
			mysqli_close($link);	
   		?> 
 <div class="imprimir"></div><a href="http://www.jcyl.es/" target="_blank" title="Junta de Castilla y Le�n" ><img src="images/logojuntacastillayleon.gif" alt="Junta de Castilla y Le�n" width="100" height="60" style="float:left;padding:20px;" /></a><a href="http://cerveradepisuerga.sedeelectronica.es/" target="_blank" title="Ayuntamiento de Cervera de Pisuerga" ><img src="images/ayuntamiento.gif" alt="Ayuntamiento de Cervera de Pisuerga" width="56" height="100" style="float:left;padding-left:100px;padding-top:20px;" /></a><a href="http://www.fecitcal.com/" target="_blank" title="Federaci�n de Centros de Iniciativas Tur�sticas de Castilla y Le�n" ><img src="images/fecitcal.gif" alt="Federaci�n de Centros de Iniciativas Tur�sticas de Castilla y Le�n" width="98" height="61"  style="float:right;padding:20px;"/></a>
</div>
<br class="limpiar" />
<div class="copyright">
<p align="center" class="copiright">
<a href="mail.php?Ambito=Directorio&amp;idAmbito=305&amp;Campo=idDirectorio&amp;Att=NombreComercial" title="contacto con el CIT de Cervera de Pisuerga">contacto</a> - <a href="mapa-web.php" title="Mapa Web">mapa web</a><br />
<a href="directorio-detalle.php?idDirectorio=305&amp;idServicio=7&amp;idSubServicio=&amp;idNucleoUrbano=1" title="CIT - Centro de Iniciativas Tur�sticas de Cervera de Pisuerga">&copy; Centro de Iniciativas Tur�sticas de Cervera de Pisuerga </a><br />
<a href="http://cerveradepisuerga.sedeelectronica.es/" title="Ayuntamiento de Cervera de Pisuerga">&copy; Ayuntamiento de Cervera de Pisuerga</a></p>
</div>
</div>
</div>
<div id="MP"><img src="images/montanapalentinalateral.png" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" width="160" height="627" /></div>
</body>
</html>
