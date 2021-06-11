<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");

$link = ConnBDCervera();


$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$Buscar = $_GET["Buscar"]?? '';
$MetaKeywords = '';
if($Buscar != ""){$ValorBuscar=$Buscar;}else{$ValorBuscar="Buscar";}

$sqlS = " SELECT DISTINCT DS.idServicio, S.NombreServicio FROM DirectorioServicio "
				." AS DS INNER JOIN Servicios AS S ON DS.idServicio = S.idServicio "
				." inner join Directorio as D on DS.idDirectorio = D.idDirectorio ";
				if ($idNucleoUrbano != "") { $sqlS .= " where D.idNucleoUrbano = $idNucleoUrbano "; }
				$sqlS .= " ORDER BY NombreServicio ";

				mysqli_query($link,'SET NAMES utf8');
$resultS = mysqli_query($link,$sqlS);

if (!$resultS)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sqlS;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($resultS);	
if($max > 0){  
	while ($rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC)) {
		
		$MetaKeywords .= $rowS["NombreServicio"] .", ";
	}
}	
mysqli_free_result($resultS);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
<title>Cervera de Pisuerga: Directorio y guia de la Monta�a Palentina</title>
<!-- MetaNmaes -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="title" content= "Cervera de Pisuerga: Directorio y guia de la Monta�a Palentina" />
<meta http-equiv="title" content= "Cervera de Pisuerga: Directorio y guia de la Monta�a Palentina" />
<meta name="description" content="<?php echo $MetaKeywords; ?>"/>
<meta http-equiv="description" content="<?php echo $MetaKeywords; ?>"/>
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
<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
<!-- CSS -->
<!-- SCRIPTS -->
<script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
<script src="js/jquery.lightbox.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.funciones.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript">

	function SeleccionNucleoUrbano(x){
			location.href = "directorio.php?idNucleoUrbano="+x.value;	
		}
		
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
<li><a href="index.php" title="inicio, tecla I" accesskey="I" hreflang="es"><span class="AccesKey">I</span>nicio</a></li>
<li><a href="localizacion.php"  title="localizaci&oacute;n, tecla L" accesskey="L" hreflang="es"><span class="AccesKey">L</span>ocalizaci�n</a></li>
<li><a href="que-ofrecemos.php" title="qué ofrecemos, tecla Q"  accesskey="Q" hreflang="es"><span class="AccesKey">Q</span>u� ofrecemos</a></li>
<li><a href="agenda.php" title="agenda, tecla A" accesskey="A" hreflang="es"><span class="AccesKey">A</span>genda</a></li>
<li><a href="area-municipal.php" title="localidades, tecla O" accesskey="O" hreflang="es">L<span class="AccesKey">o</span>calidades</a></li>
<li><a href="noticias.php" title="noticias, tecla N" accesskey="N" hreflang="es"><span class="AccesKey">N</span>oticias</a></li>
<li><a href="directorio.php" class="seleccion" title="directorio, tecla D" accesskey="D" hreflang="es"><span class="AccesKey">D</span>irectorio</a></li>
<li><a href="http://cerveradepisuerga.sedeelectronica.es" title="Sede electr&oacute;nica del Ayuntamiento de Cervera de Pisuerga"
 target="_Blank" accesskey="R" hreflang="es">Sede elect<span class="AccesKey">r</span>&oacute;nica</a></li>
<li><a href="http://www.cerveradepisuerga.es" title="Ayuntamiento de Cervera de Pisuerga" target="_Blank" accesskey="Y" hreflang="es">A<span class="AccesKey">y</span>untamiento </a></li>
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
<div id="contenido">
<div class="Fuentes"><a href="#" rel="contraste" id="CSS"><img src="images/contraste.png" alt="Alto contraste" width="32" height="32" title="Alto contraste"/></a><img src="images/fuentemas.png" name="etiqueta" id="FuenteMas" title="Aumentar el tama�o de la fuente de la pagina, tecla +" alt="Aumentar el tama�o de la fuente de la pagina, tecla +" width="32" height="32" /><img src="images/fuentemenos.png" name="etiqueta" id="FuenteMenos" title="Disminuir el tama�o de la fuente de la pagina, tecla -" alt="Disminuir el tama�o de la fuente de la pagina, tecla -" width="32" height="32" />
</div>
<h1>Directorio</h1>
<div class="MigasdePan">
<a href="directorio.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="Directorio">Directorio</a>
</div>
<form name="formBuscar" action="directorio-buscar.php" method="post">
<?php 
$link = ConnBDCervera();
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// NucleosUrbanos ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Directorio as D "
 				." inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano "
 				." group by idNucleoUrbano order by NU.NombreNucleoUrbano ";  

$accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
echo "<label for=\"IDNUCLEOURBANO\">Localidad: ";
echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
echo "</label>";
?>
<label for="BUSCAR">Buscar: 
<input type="text" size="25" value="<?php echo $ValorBuscar;?>" id="BUSCAR" name="BUSCAR"/></label>
 <input type="submit" name="BOTONBUSCAR" value="Buscar" />
</form>
<div class="texto">
<?php
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Servicios +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sqlS = " SELECT DISTINCT DS.idServicio, S.NombreServicio FROM DirectorioServicio "
				." AS DS INNER JOIN Servicios AS S ON DS.idServicio = S.idServicio "
				." inner join Directorio as D on DS.idDirectorio = D.idDirectorio ";
				if ($idNucleoUrbano != "") { $sqlS .= " where D.idNucleoUrbano = $idNucleoUrbano "; }
				$sqlS .= " ORDER BY NombreServicio ";

$resultS = mysqli_query($link,$sqlS);
if (!$resultS)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sqlS;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($resultS);	
if($max > 0){  
echo "<ul>";
$clasefila = "filagris";
	while ($rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC)) {
		echo "<li class='servicio'><a href='directorio-listado.php?idServicio=".$rowS["idServicio"]."&amp;idNucleoUrbano=$idNucleoUrbano' title='".$rowS["NombreServicio"] ."'>" .$rowS["NombreServicio"] ."</a>";
		
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Subservicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
$sqlSS = "SELECT DISTINCT DSB.idSubServicio, S.NombreSubServicio, S.icono FROM DirectorioSubServicio AS DSB "
	    . "INNER JOIN SubServicios AS S ON DSB.idSubServicio = S. idSubServicio "
	    . "INNER JOIN Directorio AS D ON DSB.idDirectorio = D. idDirectorio "
	    . "WHERE S.idServicio = ".$rowS["idServicio"];
if ($idNucleoUrbano != "") $sqlSS .= " and D.idNucleoUrbano = $idNucleoUrbano "; 	    
$sqlSS .= " ORDER BY NombreSubServicio ";
  		
						$resultSS = mysqli_query($link,$sqlSS);
			if (!$resultSS)
				{
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sqlSS;	
				die($message);
				exit;
				}
			$max = mysqli_num_rows($resultSS);	
			if($max > 0){  
			echo "<ul>";
			$clasefila = "filagris";
				while ($rowSS = mysqli_fetch_array($resultSS, MYSQLI_ASSOC)) {
					
					if ($clasefila == "filagris" ){
						$clasefila = "filablanca";
					}else{
						$clasefila = "filagris";
					}
					
					echo "<li class='subservicio'><img src='iconos/".$rowSS["icono"]."' width='32' height='32' title='".$rowSS["NombreSubServicio"] ."' alt='".$rowSS["NombreSubServicio"] ."' /><a href='directorio-listado.php?idServicio=".$rowS["idServicio"]."&amp;idSubServicio=".$rowSS["idSubServicio"]."&amp;idNucleoUrbano=$idNucleoUrbano' title='".$rowSS["NombreSubServicio"] ."'>" .$rowSS["NombreSubServicio"] ."</a></li>";
				}
				echo "</ul></li>";
			}
			mysqli_free_result($resultSS);
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Subservicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++			

	}
	echo "</ul>";
}
mysqli_free_result($resultS);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Servicios +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
mysqli_close($link);	
?>
</div>
<div class="imprimir"></div>
<?php
include("pie.html");
?>
<br class="limpiar" />
</div>
<br class="limpiar" />
<div class="copyright">
<p class="copiright">
<a href="mail.php?Ambito=Directorio&amp;idAmbito=305&amp;Campo=idDirectorio&amp;Att=NombreComercial" title="contacto con el CIT de Cervera de Pisuerga">contacto</a> - <a href="accesibilidad.php" title="accesibilidad">accesibilidad</a> - <a href="mapa-web.php" title="Mapa Web">mapa web</a><br />
<a href="directorio-detalle.php?idDirectorio=305&amp;idServicio=7&amp;idSubServicio=&amp;idNucleoUrbano=1" title="CIT - Centro de Iniciativas Tur�sticas de Cervera de Pisuerga">&copy; Centro de Iniciativas Tur�sticas de Cervera de Pisuerga </a><br />
<a href="http://cerveradepisuerga.sedeelectronica.es/" title="Ayuntamiento de Cervera de Pisuerga">&copy; Ayuntamiento de Cervera de Pisuerga</a></p>
</div>
</div>

</div>
<div id="MP"><img src="images/montanapalentinalateral.png" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" width="160" height="627" /></div>
</body>
</html>
