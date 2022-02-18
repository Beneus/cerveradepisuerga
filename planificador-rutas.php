<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Planifica tu viaje a la Montaña Palentina (Cervera de Pisuerga)";
$MetaDescripcion = "Planifica tu viaje a la Montaña Palentina (Cervera de Pisuerga). Documenta tu viaje con las indicaciones necesarias con la herramienta de Google Maps";
$MetaKeywords = "Cervera de Pisuerga, Montaña Palentina, Plano de carreteres, ALSA, FEVE, RENFE, Autobuses DUQUE, Autobuses del Pisuerga, avión, transporte, comunicación, carreteras, Palencia, Vallaolid, Madrid, Burgos, Santander, León...";

?>
<!DOCTYPE html>
<html>

<head>
     <?php
     include('./head.php');
     ?>
     <meta name="verify-v1" content="RSARgq/bC4qUh16fvW8t0J5vVri9xlZNdDvjFNqsHpk=" />
     <meta name="msvalidate.01" content="3685710D7DF55A6B09BFC9F6D0B19B06" />
     <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;oe=ISO-8859-1;&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
     <script type="text/javascript">
          var map;
          var gdir;
          var geocoder = null;
          var addressMarker;

          function initialize() {
               if (GBrowserIsCompatible()) {
                    map = new GMap2(document.getElementById("mapa_ruta"));
                    map.setCenter(new GLatLng(42.866245, -4.498236), 12);
                    map.addControl(new GMapTypeControl());
                    map.addControl(new GLargeMapControl());
                    map.addControl(new GScaleControl());
                    map.addControl(new GOverviewMapControl());
                    gdir = new GDirections(map, document.getElementById("direcciones"));
                    GEvent.addListener(gdir, "load", onGDirectionsLoad);
                    GEvent.addListener(gdir, "error", handleErrors);

               }
          }

          function setDirections(fromAddress, toAddress, locale) {
               gdir.load("from: " + fromAddress + " to: " + toAddress, {
                    "locale": locale
               });
          }

          function handleErrors() {
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

          function onGDirectionsLoad() {
               // Use this function to access information about the latest load()
               // results.
               // e.g.
               // document.getElementById("getStatus").innerHTML = gdir.getStatus().code;
               // and yada yada yada...
          }
     </script>
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
                         <h1>Planifica tu viaje</h1>
                         <div class="MigasdePan">
                              <a href="localizacion.php">Localización</a>&nbsp;&gt;&nbsp;
                              <a href="planificador-rutas.php">planifica tu viaje</a>
                         </div>
                    </div>


                    <div class="content">
                         <div class="mapouter">
                              <div class="gmap_canvas">
                                   <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=cervera%20de%20pisuerga&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                   <a href="https://www.whatismyip-address.com/divi-discount/"></a><br>
                                   <style>
                                        .mapouter {
                                             position: relative;
                                             text-align: right;
                                             height: 100vh;
                                             width: 100vw;
                                        }
                                   </style>
                                 
                                   <style>
                                        .gmap_canvas {
                                             overflow: hidden;
                                             background: none !important;
                                             height: 90vh;
                                             width: 90vw;
                                        }
                                        #gmap_canvas {
                                             overflow: hidden;
                                             background: none !important;
                                             height: 90%;
                                             width: 90%;
                                             left: 0;
                                             right: 0;
                                             position: absolute;
                                        }
                                   </style>
                              </div>
                         </div>
                    </div>
                    <div class="content">
                         <form action="#" onsubmit="setDirections(this.fromAddress.value, this.to.value, this.locale.value); return false" name="form">
                              <label for="fromAddress">Origen: </label>
                              <input name="fromAddress" type="text" id="fromAddress" value="Origen" size="25" />

                              <label for="to">Destino: </label>
                              <select name="to" id="to" class="">
                                   <option value="Arbejal, Palencia">Arbejal</option>
                                   <option value="Barcenilla, Palencia">Barcenilla</option>
                                   <option value="Celada de Roblecedo, Palencia">Celada de Roblecedo</option>
                                   <option value="Cervera, Palencia" selected="selected">Cervera de Pisuerga</option>
                                   <option value="Cubillo de Ojeda, Palencia">Cubillo de Ojeda</option>
                                   <option value="Estalaya, Palencia">Estalaya</option>
                                   <option value="Gramedo, Palencia">Gramedo</option>
                                   <option value="Herreruela de Castilleria, Palencia">Herreruela de Castilleria</option>
                                   <option value="Liggüerzana, Palencia">Ligüerzana</option>
                                   <option value="Perazancas de Ojeda, PALPalenciaENCIA">Perazancas de Ojeda</option>
                                   <option value="Quintanaluengos, PALEPalenciaNCIA">Quintanaluengos</option>
                                   <option value="Rabanal de los Caballeros, Palencia">Rabanal de los Caballeros</option>
                                   <option value="Rebanal de las Llantas, Palencia">Rebanal de las Llantas</option>
                                   <option value="Resoba, Palencia">Resoba</option>
                                   <option value="Rueda, Palencia">Rueda</option>
                                   <option value="Ruesga, Palencia">Ruesga</option>
                                   <option value="San Felices de Castilleria, Palencia">San Felices de Castilleria</option>
                                   <option value="San Martín de los Herreros, Palencia">San Martín de los Herreros</option>
                                   <option value="Santibañez de Resoba, Palencia">Santibañez de Resoba</option>
                                   <option value="Vallespinoso, Palencia">Vallespinoso</option>
                                   <option value="Valsadornín, Palencia">Valsadornín</option>
                                   <option value="Vañes, Palencia">Vañes</option>
                                   <option value="Ventanilla, Palencia">Ventanilla</option>
                                   <option value="Verdeña, Palencia">Verdeña</option>
                              </select>
                              <br />
                              <label for="locale">Idioma: </label><select id="locale" name="locale">
                                   <option value="es" selected="selected">Español</option>
                                   <option value="en">English</option>
                                   <option value="fr">French</option>
                                   <option value="de">German</option>
                                   <option value="ja">Japanese</option>
                              </select>
                              <input type="submit" name="Submit" value="Viaje de ida" />
                              <input type="button" name="Submit2" id="Submit2" value="Viaje de vuelta" />
                         </form>
                    </div>




                    <div id="mapa_ruta" class="content" style="height:580px;"></div>

                    <div id="direcciones" class="content"></div>

                    <?php
                    include("./sponsors.php");
                    ?>
               </div>
               <?php
               include("./footer.php");
               ?>
          </div>
     </div>
</body>

</html>