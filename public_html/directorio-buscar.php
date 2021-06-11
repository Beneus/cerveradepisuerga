<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");

$idNucleoUrbano = $_POST["IDNUCLEOURBANO"];
$Buscar = $_POST["BUSCAR"];
if($Buscar != ""){$ValorBuscar=$Buscar;}else{$ValorBuscar="Buscar";}
$MetaTitulo = "Cervera de Pisuerga: Directorio y guia de la Montaña Palentina: " . $NombreServicio ." ". $NombreSubServicio;
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
<link rel="stylesheet" type="text/css" media="print" href="css/print.css" />
<!-- CSS -->
<!-- SCRIPTS -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script type="text/javascript" src="js/jquery.lightbox.js"></script>
<script type="text/javascript" src="js/jquery.funciones.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript">
<!--
function SeleccionNucleoUrbano(x){
		location.href = "directorio-listado.php?idServicio=<?php echo $idServicio; ?>&idNucleoUrbano="+x.value;	
	}
	//-->
</script>
<script type="text/javascript">
<!--
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
//-->
</script>
<script type="text/javascript">
<!--
try {
var pageTracker = _gat._getTracker("UA-7481428-1");
pageTracker._trackPageview();
} catch(err) {}
//-->
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
<li><a href="localizacion.php"  title="localizaci&oacute;n, tecla L" accesskey="L" hreflang="es"><span class="AccesKey">L</span>ocalización</a></li>
<li><a href="que-ofrecemos.php" title="qué ofrecemos, tecla Q"  accesskey="Q" hreflang="es"><span class="AccesKey">Q</span>ué ofrecemos</a></li>
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
<img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a><br/><a href="http://jigsaw.w3.org/css-validator/check/referer" hreflang="en" title="¡CSS Válido!">
<img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="¡CSS Válido!" width="88" height="31" style="border:0;width:88px;height:31px" /></a><br/>
<a href="http://www.w3.org/WAI/WCAG1AAA-Conformance"	title="Explicación del Nivel Triple-A de Conformidad"><img height="31" width="88" src="http://www.w3.org/WAI/wcag1AAA-blue.gif" alt="Icono de conformidad con el Nivel Triple-A, de las Directrices de Accesibilidad para el Contenido Web 1.0 del W3C-WAI"/></a>
</p>
</div>
<div id="centro">
<div id="cab"><a href="/" title="Cervera de Pisuerga: El corazón de la Montaña Palentina"><img src="images/cab2.gif" title="Cervera de Pisuerga: El corazón de la Montaña Palentina" alt="Cervera de Pisuerga: El corazón de la Montaña Palentina" width="624" height="103" /></a></div>
<div id="contenido"><div class="Fuentes"><a href="#" rel="contraste" id="CSS"><img src="images/contraste.png" alt="Alto contraste" width="32" height="32" title="Alto contraste"/></a><img src="images/fuentemas.png" name="etiqueta" id="FuenteMas" title="Aumentar el tamaño de la fuente de la pagina, tecla +" alt="Aumentar el tamaño de la fuente de la pagina, tecla +" width="32" height="32" /><img src="images/fuentemenos.png" name="etiqueta" id="FuenteMenos" title="Disminuir el tamaño de la fuente de la pagina, tecla -" alt="Disminuir el tamaño de la fuente de la pagina, tecla -" width="32" height="32" />
</div>
<h1>Directorio</h1>
<div class="MigasdePan">
<a href="directorio.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="Directorio">Directorio</a> 
<?php if ($idServicio != "") {?>
> <a href='directorio-listado.php?idServicio=<?php echo $idServicio; ?>&amp;idNucleoUrbano=<?php echo $idNucleoUrbano; ?>' title="<?php echo $NombreServicio; ?>"><?php echo $NombreServicio; ?></a>
<?php }if ($idSubServicio != "") {?>
> <a href='directorio-listado.php?idServicio=<?php echo $idServicio; ?>&amp;idSubServicio=<?php echo $idSubServicio; ?>&amp;idNucleoUrbano=<?php echo $idNucleoUrbano; ?>' title="<?php echo $NombreSubServicio; ?>"><?php echo $NombreSubServicio; ?></a>
<?php } ?>
</div>
<form name="formBuscar" action="directorio-buscar.php" method="post">
<?php 
$link = ConnBDCervera();
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// NucleosUrbanos +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  
 $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Directorio as D "
 			. " inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano ";
 $sql .= "group by idNucleoUrbano order by NU.NombreNucleoUrbano LIMIT 0, 30 ";

echo "<label for=\"IDNUCLEOURBANO\">Localidad: ";
echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
echo "</label>";
?>
 <input type="hidden" name="PAGINA" value="<?php echo $Pagina;?>" />
 <input type="hidden" name="MOSTRAR" value="<?php echo $Mostrar;?>" />
 <label for="BUSCAR" lang="es">Buscar: <input type="text" size="25" value="<?php echo $ValorBuscar;?>" id="BUSCAR" name="BUSCAR"/></label>
 <input type="submit" name="BOTONBUSCAR" value="Buscar" />
</form>

<?php 
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Servicios +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
if($Buscar == ""){
$sql = "SELECT D.*,NU.NombreNucleoUrbano, DS.idServicio FROM Directorio as D\n"
    . "inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio\n"
    . "inner join DirectorioSubServicio as DSS on D.idDirectorio = DSS.idDirectorio\n"
    . "inner join NucleosUrbanos as NU on D.idnucleourbano = NU.idnucleourbano\n";
    if ($idNucleoUrbano != "") $sql .= " WHERE D.idNucleoUrbano = $idNucleoUrbano "; 
    $sql .=  " group by D.idDirectorio order by NombreComercial "	;
}else{	
$sql = "SELECT D.*,NU.NombreNucleoUrbano, DS.idServicio, DSS.idSubServicio FROM Directorio as D\n"
    . "inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio\n"
    . "inner join DirectorioSubServicio as DSS on D.idDirectorio = DSS.idDirectorio\n"
    . "inner join NucleosUrbanos as NU on D.idnucleourbano = NU.idnucleourbano\n"
    . "Where NombreComercial like '%$Buscar%' "
    . "or Direccion like '%$Buscar%' "
    . "or Telefono like '%$Buscar%' "
    . "or Movil like '%$Buscar%' "
    . "or Fax like '%$Buscar%' ";
    if ($idNucleoUrbano != "") $sql .= " and D.idNucleoUrbano = $idNucleoUrbano "; 
    $sql .=  " group by D.idDirectorio order by NombreComercial ";	
    
  }
$result = mysql_query($sql);
if (!$result)
	{
	$message = "Invalid query".mysql_error()."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysql_num_rows($result);	
if($max > 0){  

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$idDirectorio = $row["idDirectorio"];
		$Direccion = $row["Direccion"];
		$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
		$idNucleoUrbano = $row["idNucleoUrbano"];
		$idServicio = $row["idServicio"];
		$idSubServicio = $row["idSubServicio"];
		$Telefono = $row["Telefono"];
		$Movil = $row["Movil"];   
		$URL = $row["URL"];
		$Email = $row["Email"];
		$Fax = $row["Fax"];


		if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Directorio&amp;idAmbito=$idDirectorio&amp;Campo=idDirectorio&amp;Att=NombreComercial\" title=\"Contacta con el responsable de $NombreComercial\">Contacta</a>";}
?>
<div class="texto">
<?php
if($row["ImgDescripcion"] > 0){
   		$sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
   		$resultImg = mysql_query($sqlImg);
			if (!$resultImg){
				$message = "Invalid query".mysql_error()."\n";
				$message .= "whole query: " .$sqlImg;	
				die($message);
				exit;
			}
			$maxImg = mysql_num_rows($resultImg);	
			if($maxImg > 0){
				$rowImg = mysql_fetch_array($resultImg, MYSQL_ASSOC);
				$Path = $rowImg["Path"];
				$Archivo = $rowImg["Archivo"];
				$Titulo = $rowImg["Titulo"];
				$Pie = $rowImg["Pie"]; 
				$Ancho = $rowImg["Ancho"];
				$Alto = $rowImg["Alto"];
				$AnchoThumb = $rowImg["AnchoThumb"];
				$AltoThumb = $rowImg["AltoThumb"];
				echo "<a href=\"directorio-detalle.php?idDirectorio=".$row["idDirectorio"]."&amp;idServicio=".$idServicio."&amp;idSubServicio=".$idSubServicio."&amp;idNucleoUrbano=".$row["idNucleoUrbano"]."\" class=\"strDirectorio\"><img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" /></a>";
			}
			mysql_free_result($resultImg);
   	}

?>
<?php echo IconosSubservicio($row["idDirectorio"],$idServicio);	?><br/><br/>
<a href="directorio-detalle.php?idDirectorio=<?php echo $row["idDirectorio"];?>&amp;idServicio=<?php echo $idServicio;?>&amp;idSubServicio=<?php echo $idSubServicio;?>&amp;idNucleoUrbano=<?php echo $row["idNucleoUrbano"];?>" class="strDirectorio"><?php echo $row["NombreComercial"];?></a>
<ul>
<li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo $Telefono;?></span></li>
<li><a href="directorio-detalle.php?idDirectorio=<?php echo $row["idDirectorio"];?>&amp;idServicio=<?php echo $idServicio; ?>&amp;idSubServicio=<?php echo $idSubServicio; ?>&amp;idNucleoUrbano=<?php echo $row["idNucleoUrbano"];?>" title="<?php echo $NombreComercial;?>: más información">más información...</a></li>

</ul>
</div>		
<?php

	}

}
mysql_free_result($result);

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Servicios +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
mysql_close($link);	
?>
<br class="limpiar" />
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
<a href="directorio-detalle.php?idDirectorio=305&amp;idServicio=7&amp;idSubServicio=&amp;idNucleoUrbano=1" title="CIT - Centro de Iniciativas Turísticas de Cervera de Pisuerga">&copy; Centro de Iniciativas Turísticas de Cervera de Pisuerga </a><br />
<a href="http://cerveradepisuerga.sedeelectronica.es/" title="Ayuntamiento de Cervera de Pisuerga">&copy; Ayuntamiento de Cervera de Pisuerga</a></p>
</div>
</div>

</div>
<div id="MP"><img src="images/montanapalentinalateral.png" title="Cervera de Pisuerga: El corazón de la Montaña Palentina" alt="Cervera de Pisuerga: El corazón de la Montaña Palentina" width="160" height="627" /></div>
</body>
</html>

