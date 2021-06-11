<?php
error_reporting(0);
ini_set('display_errors', 0);

//ini_set ('error_reporting', E_ALL);
include("../includes/funciones.php");
include("../includes/Conn.php");
  
$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Inicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
$sql = " select * from Inicio Limit 0,1";  
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
$Descripcion = html_entity_decode($row["Descripcion"]);	
$ImgDescripcion = $row["ImgDescripcion"];		
}
mysqli_free_result($result);
mysqli_close($link);	
?>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="css/index.css" type="text/css" media="screen" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flexbox responsive grid</title>
</head>
<body>
  <div class="wrapper">
  <div class="Grid Grid--full Grid--nested header">
    <div class="Grid-cell">
      <div class="Demo Holly">
        <img src="images/LOGO-CIT-CERVERA.gif" style="max-width:100%;vertical-align: middle;">
      </div>
    </div>   
  </div>
 
 <?php
include("./menu.php");
 ?>





 
  <div class="Grid Grid--gutters Grid--holly-grail">
    <div class="Grid-cell main">

    <div class="Demo-total Holly">
      <img style="max-width:100%" src="http://www.cerveradepisuerga.eu/eclesia_dei.png" />
    </div>
    
      <div class="content Demo Holly">
        <!-- <strong>Main</strong> -->
        
        <div class="">
        

        <div class="texto">
      <a href="Inicio/1/images/Papilio machaon.JPG" class="lightbox" title="" hreflang="es">
      <img src="Inicio/1/images/Papilio machaon.JPG" title="" alt="" style="float:right;padding-left:20px;padding-bottom:20px;"></a><p>Bienvenidos a <strong>Cervera de Pisuerga</strong>, en el corazón de la <strong>Montaña Palentina</strong>.<br><br>Estamos en la Cordillera Cantábrica, en el borde montañoso y más septentrional de la provincia de <strong>Palencia </strong>y de la región de <strong>Castilla y León</strong>. Nuestro territorio tiene una altitud media superior a los mil metros de altura sobre el nivel del mar y una extensión próxima a los&nbsp;325 Km.², donde vivimos más de dos mil seiscientas personas repartidas en veinticuatro núcleos de población.<br><br>Forma junto con <strong>Guardo y Aguilar</strong> las tres cabeceras de comarca de la <strong>Montaña Palentina;</strong> las tres villas más pobladas que articulan todo el territorio en tres grandes áreas funcionales y donde se concentran la mayor parte de los servicios, la industria y el comercio.<br><br><a href="localidades.php?idNucleoUrbano=1&amp;idArea=1" title="Cervera de Pisuerga">Cervera de Pisuerga</a> es la más pequeña de las tres villas y también es la que posee&nbsp;el&nbsp;carácter más rural y tradicional, por su antigua <strong>tradición ganadera, comercial y artesanal</strong>. Situada en el centro del territorio es la capital natural de la <strong>Montaña Palentina</strong>, cabecera de partido judicial, centro vital del pujante sector turístico de la comarca y punto estratégico para adentrarse en este antiguo, sorprendente y hospitalario país de <strong>naturaleza virgen, con </strong><a href="que-ofrecemos.html" title="Arte, historia, monumetos, museos">arte y con historia.</a></p><p>Quienes visitan la Montaña Palentina disponen de una amplia y cuidada oferta de servicios y actividades turísticas: <a href="directorio-listado.php?idServicio=9&amp;idNucleoUrbano=" title="Aojamientos hoteleros, rurales, Parador  y campings">alojamientos hoteleros y rurales</a>, <a href="directorio-listado.php?idServicio=3&amp;idNucleoUrbano=" title="Restaurantes y mesones">restaurantes y mesones</a>, albergues, campamentos, <a href="directorio-listado.php?idServicio=25&amp;idSubServicio=95&amp;idNucleoUrbano=" title="centros de interpretación y de actividades turísticas">centros de interpretación y de actividades turísticas</a>, etc., junto con una creciente red de <a href="directorio-listado.php?idServicio=7&amp;idNucleoUrbano=" title="Servicios públicos">servicios públicos</a>: <a href="directorio-listado.php?idServicio=4&amp;idNucleoUrbano=" title="Transporte público">transporte público</a>, <a href="directorio-listado.php?idServicio=15&amp;idNucleoUrbano=" title="Servicios médicos de urgencia">servicios médicos de urgencia</a>, equipamientos deportivos culturales y de ocio, <a href="directorio-listado.php?idServicio=13&amp;idNucleoUrbano=" title="comercio de la Montaña Palentina">establecimientos comerciales</a>… que garantizan la seguridad, tranquilidad y comodidad de su estancia entre nosotros.</p><br class="limpiar"></div>
      
        </div>
      
       
      
      </div>
      <div class="content Demo Holly">
       <div class="sponsor Grid--center">     
          <div class=""><a href="http://cerveradepisuerga.sedeelectronica.es" target="_blank" title="Ayuntamiento de Cervera de Pisuerga" hreflang="es"><img src="images/ayuntamiento.gif" alt="Ayuntamiento de Cervera de Pisuerga" width="56" height="100" style=""></a></div>

          <div class=""><a href="http://www.fecitcal.com" target="_blank" title="Federaci�n de Centros de Iniciativas Tur�sticas de Castilla y Le�n" hreflang="es"><img src="images/fecitcal.gif" alt="Federaci�n de Centros de Iniciativas Tur�sticas de Castilla y Le�n" width="98" height="61" style=""></a></div>

          <div class=""><a href="http://http://www.castillayleonesvida.com/" target="_blank" title="Es vida Castilla y Le�n" hreflang="es"><img src="images/esVida.jpg" alt="Es vida Castilla y Le�n" width="189" height="95" style=""></a></div>

          <div class=""><a href="http://www.dip-palencia.es" target="_blank" title="Diputaci�n de Palencia" hreflang="es"><img src="images/logo-diputacion-palencia2.png" alt="Diputaci�n de Palencia" width="150" height="45" style=""></a></div>
      </div>
      </div>



    </div>
    <!-- <div class="Grid-cell aside aside-1">
      <div class="Demo Holly"><strong>Aside 1</strong><br />
        <div class="img-placeholder"></div>
        
        Chocolate cake fruitcake icing muffin applicake chocolate.
      </div>
    </div> -->
    <div class="Grid-cell aside aside-2">
      <div class="Demo Holly">
        <!-- <strong>Banners</strong>
         -->
         <?php
ColocarBanners();
?>

<a href="http://www.cerveradepisuerga.eu/noticias-detalle.php?idNoticia=557&amp;Pagina=1&amp;Mostrar=10&amp;Buscar=" onclick="javascript: pageTracker._trackPageview('/outgoing/outbound-banner-partner3.com');">
<img style="max-width:100%" img src="Banners/497/BANNER ANUNCIAO FERIA 2018-001.jpg" alt="BASES E INSCRIPCION DE FERIA DE ARTESANIA 2018"  title="BASES E INSCRIPCION DE FERIA DE ARTESANIA 2018" longdesc="http%3A%2F%2Fwww.cerveradepisuerga.eu%2Fnoticias-detalle.php%3FidNoticia%3D557%26Pagina%3D1%26Mostrar%3D10%26Buscar%3D">
</a>
<img style="max-width:100%" src="http://www.cerveradepisuerga.eu/eclesia_dei.png" />



      </div>
    </div>
  </div>  
  
  <div class="Grid Grid--full">
    <div class="Grid-cell">
      <div class="Demo Holly Footer">
      <div class="copyright">
        <div class=""><a href="directorio-detalle.php?idDirectorio=305&amp;idServicio=7&amp;idSubServicio=&amp;idNucleoUrbano=1" title="Mapa Web">Mapa Web</a></div>
        <div class=""><a href="directorio-detalle.php?idDirectorio=305&amp;idServicio=7&amp;idSubServicio=&amp;idNucleoUrbano=1" title="CIT - Centro de Iniciativas Turísticas de Cervera de Pisuerga">&copy; CIT de Cervera de Pisuerga </a></div>
        <div class=""><a href="http://cerveradepisuerga.sedeelectronica.es/" title="Ayuntamiento de Cervera de Pisuerga">&copy; Ayuntamiento de Cervera de Pisuerga</a></div>
      </div>
      </div>
    </div>
  </div>
    
 </div>
</body>
</html>