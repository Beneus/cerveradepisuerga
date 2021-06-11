<?php
include("includes/funciones.php");
include("includes/Conn.php");


function IconosSubservicio($idDirectorio,$idServicio){
	$linkfunction = ConnBDCervera();
	$sqlIcono = "SELECT DISTINCT DSS.idSubServicio, SS.NombreSubServicio, SS.icono, S.NombreServicio, S.idServicio FROM DirectorioSubServicio AS DSS\n"
	    . "INNER JOIN DirectorioServicio AS DS ON DSS.IDDIRECTORIO = DS.IDDIRECTORIO \n"
	    . "INNER JOIN SubServicios AS SS ON DSS.idSubServicio =SS.idSubServicio\n"
	    . "INNER JOIN Servicios AS S ON SS.idServicio = S.idServicio\n"
	    . "WHERE DSS.idDirectorio = " . $idDirectorio ;	
	    
	if ($idServicio > 0){$sqlIcono .= " and S.idServicio = $idServicio ";}
	$link = ConnBDCervera();
	$resultIcono = mysqli_query($link,$sqlIcono);
	if (!$resultIcono)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sqlIcono;	
		die($message);
		exit;
		}
	$maxIcono = mysqli_num_rows($resultIcono);	
	$Iconos = "";
	if($maxIcono > 0){  
		while ($rowIcono = mysqli_fetch_array($resultIcono, MYSQLI_ASSOC)) {		
			$Iconos .= "<img src=\"iconos/".$rowIcono["icono"]."\" height=\"32\" witdh=\"32\" alt=\"".$rowIcono["NombreServicio"]. " ". $rowIcono["NombreSubServicio"]."\" title=\"".$rowIcono["NombreServicio"]. " ".$rowIcono["NombreSubServicio"]."\">";
		}
	}else{
		$Iconos = "";
	}
	mysqli_free_result($resultIcono);
	//mysqli_close($linkfunction);	
	return $Iconos;
}

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
$link = ConnBDCervera();
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
$NombreServicio = $row["NombreServicio"];
	if ($idSubServicio != ""){
		$NombreSubServicio = $row["NombreSubServicio"];
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
$NombreComercial = $row["NombreComercial"];
$Direccion = $row["Direccion"];
$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
$idNucleoUrbano = $row["idNucleoUrbano"];
$Telefono = $row["Telefono"];
$Movil = $row["Movil"];
$Fax = $row["Fax"];
$Email = $row["Email"];
$URL = $row["URL"];
$Contacto = trim($row["NombreContacto"]. " " . $row["Apellido1Contacto"]. " " . $row["Apellido2Contacto"]);
$Latitud = $row["Latitud"];
$Longitud = $row["Longitud"];
$ImgDescripcion = $row["ImgDescripcion"];
$FechaCreacion = $row["FechaCreacion"];
$Prestaciones = $row["Prestaciones"];
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
mysqli_close($link);	

$MetaTitulo = $NombreComercial ." ". $NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo .", direccion:" . $Direccion .", " . $NombreServicio .", " .$NombreSubServicio;



?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $MetaTitulo; ?></title>
<!-- MetaNmaes -->
<meta charset="UTF-8" />
<meta name="title" content= "<?php echo $MetaTitulo; ?>" />
<meta http-equiv="title" content= "<?php echo $MetaTitulo; ?>" />
<meta name="description" content="<?php echo $MetaDescripcion; ?>"/>
<meta http-equiv="description" content="<?php echo $MetaDescripcion; ?>"/>
<meta http-equiv="keywords" content="<?php echo $MetaKeywords; ?>"/> 
<meta name="keywords" content="<?php echo $MetaKeywords; ?>"/> 
<meta name="author" content="CIT Cervera de Pisuerga"/> 
<meta name="VW96.objecttype" content="Document">
<meta name="DC.Language" scheme="RFC1766" content="Spanish">
<meta name="language" content="es"/>
<meta name="distribution" content="global"/>
<meta name="resource-type" content="Document"/>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache"/>
<meta name="Revisit" content="1 day"/>
<meta name="robots" content="index,follow,all"/>
<meta name="verify-v1" content="RSARgq/bC4qUh16fvW8t0J5vVri9xlZNdDvjFNqsHpk=" />
<meta name="msvalidate.01" content="3685710D7DF55A6B09BFC9F6D0B19B06" />
<!-- MetaNmaes -->
<!-- CSS -->
<link href="css/menu.css" rel="stylesheet" type="text/css"/>
<link href="css/estructura.css" rel="stylesheet" type="text/css"/>
<link href="css/directorio.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="print" href="css/print.css" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<!-- CSS -->
<!-- SCRIPTS -->
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
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
		<li><a href="index.php">Inicio</a></li>
		<li><a href="localizacion.php">Localizaci�n</a></li>
		<li><a href="que-ofrecemos.html">Qu� ofrecemos</a></li>
		<!-- <li><a href="que-creamos.html">Qu� creamos</a></li> -->
		<li><a href="agenda.php">Agenda</a></li>
        <li><a href="localidades.html">Localidades</a></li>
        <li><a href="noticias.php">Noticias</a></li>
        <li><a href="directorio.php" class="seleccion">Directorio</a></li>
        <li><a href="http://www.cerveradepisuerga.es" target="_Blank">Ayuntamiento</a></li>
	</ul>
</div>
</div>
<div id="centro">
<div id="cab"><a href="/" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina"><img src="images/cab2.gif" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" width="624" height="103" /></a></div>
<div id="contenido"><div class="Fuentes"><img src="images/fuentemas.gif" onclick="AumentarFuente();" onmouseover="this.style.cursor='pointer';this.src='images/fuentemas-on.gif'" onmouseout="this.src='images/fuentemas.gif'" title="Aumentar el tama�o de la  fuente de la pagina" alt="Aumentar el tama�o de la  fuente de la pagina" width="32" height="32" longdesc="Aumentar el tama�o de la  fuente de la pagina" /><img src="images/fuentemenos.gif" onclick="DisminuirFuente();" onmouseover="this.style.cursor='pointer';this.src='images/fuentemenos-on.gif'" onmouseout="this.src='images/fuentemenos.gif'" title="Disminuir el tama�o de la  fuente de la pagina" alt="Disminuir el tama�o de la  fuente de la pagina" width="32" height="32" longdesc="Disminuir el tama�o de la  fuente de la pagina" /></div><h6>
<a href="directorio.php" alt='Directorio' title='Directorio'>Directorio</a> 
<?php if ($idServicio != "") {?>
> <a href='directorio-listado.php?idServicio=<?php echo $idServicio; ?>' alt='<?php echo $NombreServicio; ?>' title='<?php echo $NombreServicio; ?>'><?php echo $NombreServicio; ?></a>
<?php }if ($idSubServicio != "") {?>
> <a href='directorio-listado.php?idServicio=<?php echo $idServicio; ?>&idSubServicio=<?php echo $idSubServicio; ?>' alt='<?php echo $NombreSubServicio; ?>' title='<?php echo $NombreSubServicio; ?>'><?php echo $NombreSubServicio; ?></a>
<?php } if ($idDirectorio != "") {?>
> <a href='directorio-detalle.php?idDirectorio=<?php echo $idDirectorio; ?>&idServicio=<?php echo $idServicio; ?>&idSubServicio=<?php echo $idSubServicio; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>' alt='<?php echo $NombreComercial; ?>' title='<?php echo $NombreComercial; ?>'><?php echo $NombreComercial; ?></a>
<?php } ?>
</h6>
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
				echo "<a href=\"$Path/$Archivo\"  rel='lightbox'><img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" ></a>";
			}
			mysqli_free_result($result);
			mysqli_close($link);	
   		
   		
   	}

?>
<?php echo IconosSubservicio($idDirectorio,$idServicio);	?><br/><br/>
<span class="strDirectorio"><?php echo $NombreComercial; ?></span>
<a href="directorio-detalle.php?idDirectorio=<?php echo $row["idDirectorio"];?>&idServicio=<?php echo $idServicio;?>&idSubServicio=<?php echo $idSubServicio;?>&idNucleoUrbano=<?php echo $row["idNucleoUrbano"];?>" class="strDirectorio"><?php echo $row["NombreComercial"];?></a>
<ul>
<li><span class="DatosTitulo">Direcci�n</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<li><span class="DatosTitulo">Tel�fono</span><span class="DatosValor"><?php echo $Telefono;?></span></li>
<li><span class="DatosTitulo">Movil</span><span class="DatosValor"><?php echo $Movil;?></span></li>
<li><span class="DatosTitulo">Fax</span><span class="DatosValor"><?php echo $Fax;?></span></li>
<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Museo;?>" target="_blank"><?php echo $URL;?></a></span></li>
</ul>
</div>		
<?php
	echo "</ul>";
?>
<?php

   	if($Descripcion != ""){
   		echo "<img src=\"images/rutasdescripcion.gif\" width=\"280\" height=\"50\" />";
   		echo "<div class=\"texto\">";
  		echo $Descripcion; 
   		echo "<br clear=\"left\" /> ";
   		echo "</div>";
		echo "<br clear=\"left\" /> ";
   	}



// Prestaciones de servicio
if (trim($Prestaciones) !=""){
	echo "dd";
$Prestaciones = explode(",", $Prestaciones);
echo "<img src=\"images/servicios.gif\" width=\"280\" height=\"50\" />";
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
					echo "<img src=\"/iconos/Turismo/$Imagen\" weight=\"32\" height=\"32\" title=\"$Nombre\" />";
					echo "<span class=\"letraIcono\"> $Nombre</span>";
					echo "</div>";
				if (($NumReg % 2) ==0){
					echo "<br clear=\"left\" />";
				}
				
				
				}
		}
		

echo "<br clear=\"left\" /> ";
echo "</div>";
echo "<br clear=\"left\" /> ";
	
}

if ($Latitud != "" and $Longitud != ""){?>
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
<script type="text/javascript">

html = '<div style=\"width:210px; padding-right:10px;text-align: left;\"><?php echo IconosSubservicio($idDirectorio,$idServicio);	?>'+
'<strong><br clear=\"left\"/><?php echo $NombreComercial; ?></strong></div>';
galleta = "<?php echo $NombreComercial; ?>";
var Latitud = "<?php echo $Latitud; ?>";
var Longitud = "<?php echo $Longitud; ?>";
//-->
</script>
<script src="js/googlemapsmuseo.js" type="text/javascript"></script>
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
			echo "<img src='images/galeriafotografica.gif' alt='Galer�a fotogr�fica' width='279' height='27' border='0' />";
			echo "</a></div>";
	   	}
	   	mysqli_free_result($result);
			mysqli_close($link);	
   		?>

<br clear="left" />    
 <div class="imprimir"><a href="#" onClick="window.print();" title="Imprimir p�gina">Imprimir&nbsp;&nbsp;<img src="images/imprimir.gif" alt="Imrimir" hspace="3" /></a></div><a href="http://www.jcyl.es/" target="_blank" title="Junta de Castilla y Le�n" ><img src="images/logojuntacastillayleon.gif" alt="Junta de Castilla y Le�n" width="100" height="60" style="float:left;padding:20px;" /></a><a href="http://www.cerveradepisuerga.es/" target="_blank" title="Ayuntamiento de Cervera de Pisuerga" ><img src="images/ayuntamiento.gif" alt="Ayuntamiento de Cervera de Pisuerga" width="100" height="59" style="float:left;padding-left:100px;padding-top:20px;" /></a><a href="http://www.fecitcal.com/" target="_blank" title="Federaci�n de Centros de Iniciativas Tur�sticas de Castilla y Le�n" ><img src="images/fecitcal.gif" alt="Federaci�n de Centros de Iniciativas Tur�sticas de Castilla y Le�n" width="98" height="61"  style="float:right;padding:20px;"/></a><br clear="all" />
</div>
<br clear="all" />
<div class="copyright">
<p align="center" class="copiright">
<a href="directorio-detalle.php?idDirectorio=305&amp;idServicio=7&amp;idSubServicio=&amp;idNucleoUrbano=1" title="CIT - Centro de Iniciativas Tur�sticas de Cervera de Pisuerga">&copy; Centro de Iniciativas Tur�sticas de Cervera de Pisuerga </a><br />
<a href="http://www.cerveradepisuerga.es/" title="Ayuntamiento de Cervera de Pisuerga">&copy; Ayuntamiento de Cervera de Pisuerga</a></p>
</div>
</div>
</div>
<div id="MP"><img src="images/montanapalentinalateral.png" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" width="160" height="627" /></div>
</body>
</html>
