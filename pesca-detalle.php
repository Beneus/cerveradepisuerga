<?php
include("includes/funciones.php");
include("includes/Conn.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);
$idPesca = $_GET["idPesca"] ?? '';
$TipoTramo = $_GET["TipoTramo"] ?? '';
$TipoPesca = $_GET["TipoPesca"] ?? '';

$link = ConnBDCervera();
$sql = "SELECT * FROM Pesca  where idPesca = $idPesca ";
mysqli_query($link,'SET NAMES utf8');
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
			$TipoTramo = $row["TipoTramo"];
			$Nombre = $row["Nombre"];
			$Rio = $row["Rio"];
			$TipoPesca = $row["TipoPesca"];
			$Espacio = $row["Espacio"];
			$PeriodoHabil = $row["PeriodoHabil"]; 
			$DiasHabiles = $row["DiasHabiles"]; 
			$CupoCapturas = $row["CupoCapturas"]; 	
			$TamanoCapturas = $row["TamanoCapturas"];
			$Cebos = $row["Cebos"];
			$PermisosDia = $row["PermisosDia"];
			$LimiteSuperior = $row["LimiteSuperior"];
			$LimiteInferior = $row["LimiteInferior"];
			$Especies = $row["Especies"];
			$Descripcion = $row["Descripcion"];
			$ImgPesca = $row["ImgPesca"];
			$Longitud = $row["Longitud"];
			$Latitud = $row["Latitud"];
			$encodedPoints = $row["encodedPoints"];
			$encodedLevels = $row["encodedLevels"];
			$numLevels = trim($row["numLevels"]);
			$Zoom = trim($row["Zoom"]);
			$Color = trim($row["Color"]);
			$LongitudLimiteSuperior = $row["LongitudLimiteSuperior"];
			$LatitudLimiteSuperior  = $row["LatitudLimiteSuperior"];
			$LongitudLimiteInferior = $row["LongitudLimiteInferior"];
			$LatitudLimiteInferior  = $row["LatitudLimiteInferior"];
			$NucleoUrbano = $row["NucleoUrbano"];

$MetaTitulo = $TipoTramo ." " . $Nombre .". Rio " . $Rio .". Pesca en la Monta�a Palentina - Cervera de Pisuerga";
$MetaDescripcion = $MetaTitulo .". Pesca:" . $TipoPesca .", en un espacio de " . $Espacio ." Kms. Periodo habil: " .$PeriodoHabil ." y d�as habiles: " .$DiasHabiles.", Cupo de capturas: " .$CupoCapturas;
$MetaDescripcion .= " Tama�o m�nimo de las capturas ". $TamanoCapturas . " cms. Cebos permitidos " . $Cebos . " Permisos por d�a " . $PermisosDia;
$MetaDescripcion .= " limite superior: " . $LimiteSuperior . " y limite intefior: " .$LimiteInferior;
$MetaKeywords =  GenKeyWords($MetaDescripcion,3);
}	
mysqli_free_result($result);
mysqli_close($link);	
?>
<!DOCTYPE html>
<html>
     <head>
<?php
include('./head.php');
?>        
     </head>
<body onload="initialize()" onunload="GUnload()">
<div class="wrapper">
     <?php
     include('./header.php');
     include("./menu.php");
     ?>
     <div class="grid container">
          <?php
          include('./aside1.php');
          include('./aside2.php');
          ?>
               
          <div class="main">     
               <div class="content">
                    <h2><?php echo $TipoTramo . " " . $Nombre;?></h2>
                         <div class="MigasdePan">
                         <a title="Qu� ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt; 
                         <a href="pesca.php" title="Pesca, cotos y zonas de pesca en la Monta�a Palentina">Pesca</a> &gt; 
                         <a href="pesca-listado.php" title="Tramos de pesca, cotos, tramos libre y espacios deportivos en la Monta�a Palentina">Tramos de pesca</a> &gt; 
                         <a href="pesca-detalle.php?idPesca=<?php echo $idPesca; ?>" title="<?php echo $TipoTramo . " " . $Nombre;?>"><?php echo $TipoTramo . " " . $Nombre;?></a>
                         </div>
                    </div>
               <div class="content">
                    <div class="museo">
                    <?php
                    if($ImgPesca > 0){
                              $sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
                              $resultImg = mysqli_query($link,$sqlImg);
                                   if (!$resultImg){
                                        $message = "Invalid query".mysqli_error($link)."\n";
                                        $message .= "whole query: " .$sqlImg;	
                                        die($message);
                                        exit;
                                   }
                                   $maxImg = mysqli_num_rows($resultImg);	
                                   if($maxImg > 0){
                                        $rowImg = mysqli_fetch_array($resultImg, MYSQLI_ASSOC);
                                        $Path = $rowImg["Path"];
                                        $Archivo = $rowImg["Archivo"];
                                        $Titulo = $rowImg["Titulo"];
                                        $Pie = $rowImg["Pie"]; 
                                        $Ancho = $rowImg["Ancho"];
                                        $Alto = $rowImg["Alto"];
                                        $AnchoThumb = $rowImg["AnchoThumb"];
                                        $AltoThumb = $rowImg["AltoThumb"];
                                        echo "<a href=\"pesca-detalle.php?idPesca=$idPesca\" class=\"strDirectorio\" title=\"$Titulo\"><img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" /></a>";
                                   }
                                   mysqli_free_result($resultImg);
                         }
                    if($max > 0){ 
                    ?>
                    <ul>
                    <li><span class="DatosTitulo">Tipo de tramo</span><span class="DatosValor"><?php echo $TipoTramo;?></span></li>
                    <li><span class="DatosTitulo">Nombre</span><span class="DatosValor"><?php echo $Nombre;?></span></li>
                    <li><span class="DatosTitulo">Río</span><span class="DatosValor"><?php echo $Rio;?></span></li>
                    <li><span class="DatosTitulo">Tipo de pesca</span><span class="DatosValor"><?php echo $TipoPesca;?></span></li>
                    <li><span class="DatosTitulo">Espacio</span><span class="DatosValor"><?php echo $Espacio;?> Km.</span></li>
                    <li><span class="DatosTitulo">Periodo habil</span><span class="DatosValor"><?php echo $PeriodoHabil;?></span></li>
                    <li><span class="DatosTitulo">Dias habiles</span><span class="DatosValor"><?php echo $DiasHabiles;?></span></li>
                    <?php if($TipoPesca != "Sin muerte"){?>
                    <li><span class="DatosTitulo">Cupo de capturas</span><span class="DatosValor"><?php echo $CupoCapturas;?></span></li>
                    <li><span class="DatosTitulo">Tama&ntilde;o m&iacute;nimo de las capturas</span><span class="DatosValor"><?php echo $TamanoCapturas;?> cms.</span></li>
                    <?php } ?>
                    <li><span class="DatosTitulo">Cebos</span><span class="DatosValor"><?php echo $Cebos;?></span></li>
                    <li><span class="DatosTitulo">Permisos por d&iacute;a</span><span class="DatosValor"><?php echo $PermisosDia;?></span></li>
                    <li><span class="DatosTitulo">Limite superior</span><span class="DatosValor"><?php echo $LimiteSuperior;?></span></li>
                    <li><span class="DatosTitulo">Limite inferior</span><span class="DatosValor"><?php echo $LimiteInferior;?></span></li>
                    <li><span class="DatosTitulo">Especies</span><span class="DatosValor"><?php echo $Especies;?></span></li>
                    </ul>
                    </div>
                    <?php
                    }
                    ?>
               </div>

               <div class="content">
                    <div id="mapa" style="width: 100%; height: 500px" ></div>
               </div>
               <div class="content">
                    <div class="museo">
                    <h3>Cómo llegar a <?php echo $TipoTramo . " " . $Nombre;?></h3>
                    <form action="#" onsubmit="setDirections(this.fromAddress.value, this.to.value, this.locale.value); return false;" name="formIda">
                    <label for="fromAddress" lang="es">Origen: </label>
                    <input name="fromAddress" type="text" id="fromAddress" size="25" value="" placeholder="Ciudad, provincia"/>
                    <label for="to" lang="es">Destino: </label>
                    <input name="to" id="to" type="hidden" value="<?php echo $NucleoUrbano;?>"/>
                    <strong><?php echo $TipoTramo . " " . $Nombre;?></strong>
                    <br/>
                    <label for="locale" lang="es">Idioma: </label>
                    <select id="locale" name="locale">
                    <option value="es" selected="selected">Español</option>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                    <option value="ja">Japanese</option>
                    </select>
                    <input type="submit" name="SubmitIda" value="Viaje de ida"/>
                    </form>
                    <form action="#" onsubmit="setDirections(document.formIda.to.value, document.formIda.fromAddress.value, document.formIda.locale.value); return false;" name="formVuelta">
                    <input type="submit" name="SubmitVuelta" value="Viaje de vuelta" />
                    </form>
                    </div>
               </div>
               <div class="content">
                    <div id="direcciones" class="museo"></div>
               
               </div>

          <?php
          include("./sponsors.php");
          ?>         
          </div>
          <?php
          include("./footer.php");
          ?>
     </div>
</div>   
<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
<script type="text/javascript">
<!--

function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("mapa"));
        map.setCenter(new GLatLng(<?php echo $Longitud; ?>, <?php echo $Latitud; ?>),<?php echo $Zoom; ?>);
        map.setMapType(G_HYBRID_MAP);
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
				map.addControl(new GScaleControl());
				map.addControl(new GOverviewMapControl());
        
         // Add an encoded polyline.
        var encodedPoints = "<?php echo $encodedPoints; ?>";
        var encodedLevels = "<?php echo $encodedLevels; ?>";
        var encodedPolyline = new GPolyline.fromEncoded({
						color: "<?php echo $Color; ?>",
						weight: 10,
						points: encodedPoints,
						levels: encodedLevels,
						zoomFactor: <?php echo $Zoom; ?>,
						numLevels: <?php echo $numLevels; ?>});
				map.addOverlay(encodedPolyline);

				 // Create a base icon for all of our markers that specifies the
        // shadow, icon dimensions, etc.
        var baseIcon = new GIcon(G_DEFAULT_ICON);
        baseIcon.iconSize = new GSize(50, 33);
        baseIcon.iconAnchor = new GPoint(50, 33);
        baseIcon.infoWindowAnchor = new GPoint(25, 16);

        // Creates a marker whose info window displays the letter corresponding
        // to the given index.
        function createMarker(point, Imagen, Texto) {
          // Create a lettered icon for this point using our icon class
          var letteredIcon = new GIcon(baseIcon);
          letteredIcon.image = Imagen;
          // Set up our GMarkerOptions object
          markerOptions = { icon:letteredIcon };
          var marker = new GMarker(point, markerOptions);
          GEvent.addListener(marker, "click", function() {
            marker.openInfoWindowHtml(Texto);
          });
          return marker;
        }

        // A�adiomos tres marcas: limite superior, limite inferior y centro del coto
       	 var bounds = map.getBounds();
       	 var Imagen = "http://www.cerveradepisuerga.eu/images/cotopesca.gif";
       	 var Texto = "";
          var LimiteSuperior = new GLatLng(<?php echo $LongitudLimiteSuperior; ?>, <?php echo $LatitudLimiteSuperior; ?>);
          Texto = "Limite Superior del coto: <br/><b><?php echo $LimiteSuperior; ?></b>";
          Imagen = "http://www.cerveradepisuerga.eu/images/limite-superior.png";
          map.addOverlay(createMarker(LimiteSuperior,Imagen,Texto));
          var LimiteInferior = new GLatLng(<?php echo $LongitudLimiteInferior; ?>, <?php echo $LatitudLimiteInferior; ?>);
          Texto = "Limite Inferior del coto: <br/><b><?php echo $LimiteInferior; ?></b>";
          Imagen = "http://www.cerveradepisuerga.eu/images/limite-inferior.png";
          map.addOverlay(createMarker(LimiteInferior,Imagen,Texto));
          var Centro = new GLatLng(<?php echo $Longitud; ?>, <?php echo $Latitud; ?>);
        	Texto = "<?php echo $TipoTramo . " ". $Nombre; ?>";
        	<?php 
        	switch ($TipoTramo){
        		case "Coto" : if ($TipoPesca == "Sin muerte" ){$ImagenTramo = "coto-pesca-sin-muerte.png";}else{$ImagenTramo = "coto-pesca-tradicional.png";};break;
        		case "Tramo Libre" : if ($TipoPesca == "Sin muerte" ){$ImagenTramo = "tramo-libre-sin-muerte.png";}else{$ImagenTramo = "tramo-libre-tradicional.png";};break;
        		case "Escenario deportivo" : if ($TipoPesca == "Sin muerte" ){$ImagenTramo = "escenario-depor-sin-muerte.png";};break;
        	}
        	
        	
        	if ($TipoTramo == "")
        	?>
        	Imagen = "http://www.cerveradepisuerga.eu/images/<?php echo $ImagenTramo; ?>";
          map.addOverlay(createMarker(Centro,Imagen,Texto));
         // Adjuntamos la plicaci�n de rutas
  			gdir = new GDirections(map, document.getElementById("direcciones"));
				GEvent.addListener(gdir, "load", onGDirectionsLoad);
				GEvent.addListener(gdir, "error", handleErrors);
      }
    }  

function setDirections(fromAddress, toAddress, locale) {
	
  gdir.load("from: " + fromAddress + " to: " + toAddress,{ "locale": locale });
}

function handleErrors(){
 if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
   alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.\nError code: " + gdir.getStatus().code);
 else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
   alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);
 else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
   alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
//   else if (gdir.getStatus().code == G_UNAVAILABLE_ADDRESS)  Doc bug... this is either not defined, or Doc is wrong
//     alert("The geocode for the given address or the route for the given directions query cannot be returned due to legal or contractual reasons.\n Error code: " + gdir.getStatus().code);
 else if (gdir.getStatus().code == G_GEO_BAD_KEY)
   alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
 else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
   alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
 else alert("An unknown error occurred.");
}

//-->
</script> 
<script type="text/javascript">
<!--
function CambiarClasificacion(x){
location.href = "pesca-listado.php?TipoPesca=<?php echo $TipoPesca;?>&TipoTramo="+x.value;
}

function CambiarTipoPesca(x){
location.href = "pesca-listado.php?TipoTramo=<?php echo $TipoTramo;?>&TipoPesca="+x.value;
}
//-->
</script>
</body>
</html>