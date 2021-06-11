
<?php
//setlocale  (LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: Geoturismo en la Monta&ntilde;a Palentina";
$MetaDescripcion = "Geocaching, geocache, Guia de rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
$MetaKeywords = "Geocaching, geocache, Cervera de Pisuerga, Guia de rutas, Montaña Palentina, Guia de rutas de la Monta�a Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
?>
<!DOCTYPE html>
<html>
     <head>
<?php
include('./head.php');
?>        
     </head>
<body>
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
               <h1>Geoturismo</h1>
               <div class="museo">
               <p>Cervera de Pisuerga es el centro neur&aacute;lgico de la Monta&ntilde;a Palentina, entidad comarcal de gran belleza y que corresponde a varias estructuras geol&oacute;gicas muy especiales dentro del haz de pliegues y cabalgamientos de la Cordillera Cant&aacute;brica.</p>
               <p> En su parte paleozoica tiene un registro que abarca desde el sil&uacute;rico superior hasta el pensilc&aacute;nico (carbon&iacute;fero), con sedimentos generalmente marinos pero incorporando tambi&eacute;n dep&oacute;sitos de carb&oacute;n formando parte de secuencias deltaicas.</p>
               <p>    Cervera ha sido un centro minero de carb&oacute;n.</p>
               <p><br />
               La geolog&iacute;a de la Mont&ntilde;a Palentina ha sido estudiada intendamente durante los &uacute;ltimos sesenta a&ntilde;os, con un detalle inusitado. Tambi&eacute;n se ha prestado a teor&iacute;as especulativas fruto de su complejidad geol&oacute;gica. </p>
               <p><br />
               Las numerosas publicaciones y ecol&oacute;gicas est&aacute;n en Espa&ntilde;ol y en Ingl&eacute;s. </p>
               <p><br />
               Entre los elementos de inter&eacute;s especial figura, en primer lugar, el Bosque Carbonifero de Verde&ntilde;a, una muestra de las huellas dejadas por el asentamiento de arboles de dos tipos que colonizaron un l&oacute;bulo deltaico. El lugar, en los abanicos del pueblo de Verde&ntilde;a, goza de protecci&oacute;n oficial y est&aacute; incorporado en las Sendas del Parque Natural de Fuentes Carrionas. Su estudio promenorizado, ha permitido interpretar su historia de asentamiento y destrucci&oacute;n posterior, por una s&uacute;bita entrada del mar que se deb&iacute;a a movimientos s&iacute;smicos, en un contexto de gran movilidad tect&oacute;nica. Ese ejemplo es &uacute;nico en el mundo. Se recoge en un folleto editado por el Parque Natural.</p>
               <p><br />
               Otros elementos de inter&eacute;s y ecol&oacute;gico incluye varios ejemplos de paleokarst , algunos muy instructivos, as&iacute; como una superficie de erosi&oacute;n con evidencia de meteorizaci&oacute;n tropical, como corresponde a la situaci&oacute;n hace unos 300 millones de a&ntilde;os en la zona ecuatorial. Esa superficie fue sepultado por el conglomerado de Curavacas, la cumbre m&aacute;s alta de la Mota&ntilde;a Palentina (2.600 metros ). Es una masa de dep&oacute;sitos de piedras rodadas, con varios centenares de metros de espesor y que proced&iacute;an del desmantelamiento de los relieves elevados hacia el Sureste (llegando a la Sierra de  la Demanda en la provincia de Burgos).</p>
               <p><br />
               Son muy llamativos los dep&oacute;sitos de &ldquo;debris floco&rdquo; (avenidas de derrubros) a varios niveles y con or&iacute;genes variados. El ejemplo m&aacute;s significativo se encuentra en los aleda&ntilde;os del pueblo de Perapert&uacute;. Corresponde a una situaci&oacute;n de plataformas carbonatadas cuyos m&aacute;regenes soltaban bloques de caliza que se deslizaban a las cuencas circundantes que acumulaban lodos.</p>
               <p><br />
               Aparte de los numerosos ejemplos de una sedimentaci&oacute;n variada, tan numerosos y variados que no cabe una relaci&oacute;n detallada, se hacen notas las muestras de una deformaci&oacute;n tect&oacute;nica caracterizada por grandes cabalgamientos con varios niveles de despegue y dando lugar a mantos de corrimiento. De hecho, es en la Mota&ntilde;a Palentina, donde los primeros mantos cre&iacute;ble de la Cordillera Cantabrica fueros descritos. Corresponden a movimientos gravitatorios a gran escala que resultaron tambi&eacute;n en pliegues con pendientes de eje muy fuertes, que son totalmente caracteristicos.</p>
               <p>El gran acervo y geol&oacute;gico de la Mota&ntilde;a Palentina lo convierte en una aula de la naturaleza, que merece ser desarrollada en una groturismo a nivel internacional, con Cervera de Pisuerga como su centro neur&aacute;lgico hist&oacute;rico.</p>
               <p><a href="monumentos-detalle.php?idMonumento=11" title="Ver El Bosque Fosil">Ver el Bosque fosil</a><br />
               </p>
               </div>
               </div>
               <div class="content">

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
</body>
</html>