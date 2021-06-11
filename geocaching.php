
<?php
//setlocale  (LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: Geocaching en la Montaña Palentina";
$MetaDescripcion = "Geocaching, geocache, Guia de rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Roblón de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
$MetaKeywords = "Geocaching, geocache, Cervera de Pisuerga, Guia de rutas, Montaña Palentina, Guia de rutas de la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Roblón de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
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
                    <h1>Introducci&oacute;n al Geocaching</h1>
                    <a href="http://www.geocaching.com" title="Geocaching"><img src="images/geocachinglogo.gif" width="128" height="128" alt="Geocaching" longdesc="http://www.geocaching.com" /></a>
                    <h2>El Juego</h2>
                    <hr/>
                    
               </div>
               <div class="content">
                    <h3>&iquest;Qu&eacute; es?</h3>
                    <div class="museo">
                         <p>El Geocaching es un juego de b&uacute;squeda de tesoros al aire libre, en el mundo real, usando dispositivos GPS (outdoor o smartphone). Los participantes se dirigen a unas coordenadas GPS concretas (en datum WGS84 y coordenadas de grados y minutos), y entonces tratan de encontrar el geocach&eacute; (contenedor) oculto (porotro usuario) y disfrutar de la b&uacute;squeda.</p>
                         <p>Adem&aacute;s es un soporte interesante como actividad l&uacute;dica, did&aacute;ctica (el TL en CyL es educaci&oacute;n no formal y puede ser una herramienta m&aacute;s, poniendo el acento en la educaci&oacute;n ambiental) y tur&iacute;stica (Turismo Activo).</p>
                    </div>
               </div>
               
               <div class="content">
               <h3>&iquest;C&oacute;mo se juega?</h3>
                    <div class="museo">
                         <p>En su nivel m&aacute; simple, el geocaching requiere estos pasos:</p>
                         <ol>
                         <li>Registrarse en una delas plataformas de geocaching :<ol>
                              <li> <a href="http://www.geocaching.com" title="geocaching">http://www.geocaching.com</a></li>
                              <li><a href="http://www.terracaching.com" title="Terracaching">http://www.terracaching.com</a></li>
                              <li><a href="http://www.opencaching.com">http://www.opencaching.com</a></li>
                              <li><a href="http://www.gpsgames.org" title="gpsgames">http://www.gpsgames.org</a>
                              </li>
                         </ol>
                         </li>
                         <li>Visitar la p&aacute;gina &quot;Esconder y Buscar un Cache&quot;.</li>
                         <li>Introducir un c&oacute;digo postal (lugar en el planteas buscar) y hacer click en &quot;buscar&quot;.</li>
                         <li>Elegir cualquier geocach&eacute; de la lista y hacer click en su nombre.</li>
                         <li>Introducir las coordenadas del geocach&eacute; en el dispositivo GPS.</li>
                         <li>Utilizar el dispositivo GPS para encontrar el geocach&eacute; escondido.
                              <ol>
                              <li>Hay que recordar que los obst&aacute;culos ambientales pueden retrasar el hallazgo del cach&eacute;.</li>
                              <li>Y tener en cuenta que el camino recto ( es el que el GPS indica) no suele ser el m&aacute;s f&aacute;cil.</li>
                              </ol>
                         </li>
                         <li>Cunado se est&aacute; cerca del geocach&eacute; (16m), hay que usar m&aacute;s los ojos que el GPS, y ayudarse de las pistas.</li>
                         <li>Cuando se encuentra el geocach&eacute;, hay que respetar unas normas:
                              <ol>
                              <li>S&iacute; el cach&eacute; est&aacute; eneun sitio p&uacute;blico, o hay gente alrededor (geomuggles), ser discreto.</li>
                              <li>S&iacute; se coge algo del geocach&eacute;, hay que dejar algo de valor igual o superior.</li>
                              <li>S&iacute; se lleva un <a href="#" title="viajero o rastreable">viajero o rastreable</a>, hay que registrarlo.</li>
                              <li>Escribir el hallazgo en el libro de registro (logbook) del cach&eacute;.</li>
                              <li>Devolver el cach&eacute; a su ubicaci&oacute;n original (siempre escondido o mimetizado, nunca enterrado).</li>
                              </ol>
                         </li>
                         <li>Compartir on-line las historias, sensaciones, fotos...</li>
                         <li>Cuando encuentres tu primer cach&eacute;, ya te podr&aacute;s llamar <a href="#" title="Geocacher">geocacher</a>.</li>
                         </ol>
                    </div>
               </div>
               <div class="content">
                    <h3>&iquest;Quien puede jugar?</h3>
                    <div class="museo">
                         
                         <p>Cualquiera (hay tantos tipos jugadores como personas) que tenga ganas de jugar, bien en solitario o acompai'lado (en
                         familia, en pandilla ... el usuario seria entonces un equipo), y que adem&aacute;s disponga de un dispositivo GPS.<br />
                         Un geocacher es aquel usuario que sabe combinar la tecnolog&iacute;a del GPS con la aventura y la exploraci&oacute;n al aire 
                         libre. Y que adem&aacute;s, comparte su experiencia escribiendo en el cach&eacute; encontrado, o escondiendo un tesoro.</p>
                         
                    </div>
               </div>
               
               <div class="content">
                    <h3>&iquest;C&oacute;mo empez&oacute; todo?</h3>
                    <div class="museo">
                         <p>Este juego tuvo su origen en el grupo de noticias sci.geo.satellite-nav dedicado a los Sistemas Globales de Navegaci&oacute;n por Sat&eacute;lite (GNSS). David Ulmer, consultor inform&aacute;tico y asiduo de este grupo, decidi&oacute; celebrar la
                         decisi&oacute;n del gobierno estadounidense de suprimir la disponibilidad selectiva (SA) el 1 de mayo de 2000. Esta
                         degradaba intencionadamente la senal de los sat&eacute;lites para evitar que los receptores comerciales fueran precisos.</p>
                         <p> Propuso un juego (&quot;Great American GPS Stash Hunt&quot;) al resto de miembros, escondiendo el 3 de mayo un &quot;cofre del
                         tesoro&quot; (un cubo negro, con un cuademo, un l&aacute;piz, y varios premios, como videos, libros, software ... ) en los alrededores de la
                         ciudad de Portland (Oreg&oacute;n) y enviando al grupo de noticias las coordenadas exactas de su ubicaci&oacute;n (N 45&deg; 17.460 W
                         122&deg; 24.800).</p>
                         
                         <div class="video-container"><iframe width="420" height="315" src="http://www.youtube.com/embed/NXwzg0VbN2U" frameborder="0" allowfullscreen></iframe></div>
                         <p>El sitio en la actualidad ya no tiene el cach&eacute; original, sino una placa conmemorativa (cach&eacute; GCGVOP), de cuya colocaci&oacute;n en
                         septiembre de 2003 tambi&eacute;n hay un v&iacute;deo que os mostramos a continuaci&oacute;n. En &eacute;l se supone que encuentran, bastante
                         deteriorado, uno de los primeros objetos de intercambio: una lata de jud&iacute;as (frijoles), tambi&eacute;n conocida en el mundo del
                         geocaching como la famosa OCB (Original Can of Beans). Es curioso constatar que aquel primer geocach&eacute; incumpl&iacute;a dos de las
                         normas actuales (que por cierto, se siguen incumpliendo): no enterrar el cach&eacute; y no poner comida 
                         <a href="http://www.geocaching.com/seek/cache_details.aspx?wp=GCGVOP" title="Original Stash Tribute Plaque">http://www.geocaching.com/seek/cache_details.aspx?wp=GCGVOP</a></p>
                         <div class="video-container"><iframe width="420" height="315" src="http://www.youtube.com/embed/bw9Yidq8YV4" frameborder="0" allowfullscreen></iframe></div>
                         <p>El 6 de mayo fue visitado dos veces (Mike Teague fue la primera persona en encontrar el &quot;tesoro&quot;), quedando registrado en el
                         libro de visitas; y a lo largo de la semana, otros compa&iacute;'leros se interesaron por la posibilidad de esconder y
                         encontrar escondites, escondiendo sus propios recipientes y public&aacute;ndolos.    </p>
                         <p>El 30 de mayo, Mall Stum acu&ntilde;&oacute; el t&eacute;rmino Geocaching, uniendo dos palabras conocidas. El prefijo geo, que
                         designa la Tierra, es usado para describir la naturaleza global de la actividad. Y la palabra cache, con dos
                         significados diferentes: (1) un vocablo franc&eacute;s que refiere a un escondite que se utiliza para almacenar objetos; y
                         (2) la memoria cach&eacute;, que es el almacenamiento de equipo que se utiliza para recuperar r&aacute;pidamente la
                         informaci&oacute;n de uso frecuente.    </p>
                         <p>A&uacute;n as&iacute;, el &quot;GPS Stash Hunt&quot; era el t&eacute;rmino original y m&aacute;s utilizado hasta el 2 de septiembre de 2000. Ese d&iacute;a
                         recoge el testigo Jeremy lrish, un desarrollador web para una empresa de Seattle. Jeremy tropez&oacute; con el sitio web
                         de Mike Teague en julio mientras hac&iacute;a una investigaci&oacute;n sobre la tecnolog&iacute;a GPS. La idea de la caza del tesoro y
                         el uso de tecnolog&iacute;as representaba la uni&oacute;n de dos intereses. As&iacute; cre&oacute; Geocaching.com y aplic&oacute; sus habilidades
                         para mejorar la b&uacute;squeda del cach&eacute;.    </p>
                         <p>El espaldarazo a esta actividad lo dieron los Medios de Comunicaci&oacute;n. La popular revista en l&iacute;nea Slashdot,
                         inform&oacute; de la nueva actividad el 25 de septiembre de 2000. The New York Times recogi&oacute; la historia en octubre, y
                         cre&oacute; un efecto domin&oacute; de art&iacute;culos escritos en revistas, peri&oacute;dicos y otros medios de comunicaci&oacute;n de todo el
                         mundo. CNN incluso hizo una serie de sesiones en diciembre de 2000.    </p>
                         <p>A trav&eacute;s del boca a boca, art&iacute;culos de prensa, e incluso de descubrimientos accidentales de cach&eacute;s, m&aacute;s y m&aacute;s
                         personas se involucran en el geocaching. Primero comenz&oacute; entusiastas de GPS; ahora tambi&eacute;n hay parejas,
                         familias y grupos de todos los &aacute;mbitos de la vida. Hoy en d&iacute;a se puede hacer una b&uacute;squeda en cualquier lugar del
                         mundo y ser capaz de caminar, en bicicleta o en coche a un cach&eacute; oculto m&aacute;s cerca de lo que creemos.    </p>
                         <p>Otro paso importante fue, a finales de 2000, la creaci&oacute;n de la empresa llamada Groundspeak Inc. (originalmente
                         'Grounded lnc.'). Para ello Jeremy Irish y Mike Teague se asociaron con El&iacute;as Alvord y Roth Bryan, dos
                         compa&ntilde;eros de trabajo. Los 4 compaginaban su trabajo, volcando su tiempo libre a la gesti&oacute;n de la nueva
                         compa&ntilde;&iacute;a y el sitio web.    </p>
                         <p>Pudieron dedicarse a la compa&ntilde;&iacute;a, gracias a membres&iacute;a Premium, a los viajeros, y al &quot;merchandising&quot; en general.</p>
                    </div>
               </div>
               <div class="content">
                    <h3>Las cach&eacute;s</h3>
                    <div class="museo">
                         <p>La ubicaci&oacute;n, m&aacute;s que el tesoro, es lo principal. Los cach&eacute;s pueden hallarse por todo el mundo (hasta en el Jard&iacute;n
                         del vecino, o en el buz&oacute;n de un amigo en Salda&ntilde;a). Es com&uacute;n que los geocachers escondan cach&eacute;s en lugares que les son
                         importantes o tienen un inter&eacute;s, valor, belleza, significado ... especial para ellos. Estos lugares son muy diversos.<br />
                         Pueden estar en un parque local, al final de una larga caminata, bajo el agua o en una calle de la ciudad, cerca o en
                         un monumento ... (s&iacute; est&aacute;n en una propiedad privada, es porque cuentan con el permiso del propietario).<br />
                         Est&aacute;n bien escondidos o mimetizados (por ejemplo, a modo de tornillo, como en el Puente de Hierro de Palencia). Nunca
                         podr&aacute;n estar enterrados, ni en lugares en que haya que pagar entrada o restricci&oacute;n de paso. Tampoco cerca de
                         instalaciones con potencial amenaza terrorista (colegios, aeropuertos, estaciones, bases militares o cuarteles de polic&iacute;a y guardia
                         civil).</p>
                         <p>La distancia m&iacute;nima entre cach&eacute;s ser&aacute; de por lo menos 161 metros (es decir 0,10 millas &Oacute; 100 yardas).</p>
                    </div>
               </div>
               <div class="content">
                    <h3>Tipos de cach&eacute;s</h3>
                    <div class="museo">
                         <p>Estos son, con sus caracter&iacute;sticas, los tipos de cach&eacute; m&aacute;s importantes (con el icono que les Identifica):</p>
                         <ol>
                         <li> <strong>Tradicional</strong>: Es el cach&eacute; original y el m&aacute;s normal. Consiste, como m&iacute;nimo, en un contenedor fisico de tama&ntilde;o diverso (se explica m&aacute;s adelante) con su libro de registro (Logbook) y elementos de intercambio. Las
                              coordenadas publicadas en la p&aacute;gina de cach&eacute; tradicionales proporcionan la ubicaci&oacute;n exacta del
                              geocache. Por lo que s&oacute;lo hay que ir a por &eacute;l.</li>
                         <li> <strong>Multi-cach&eacute;:</strong> (cach&eacute; de desplazamiento): Un multi-cach&eacute; (&quot;m&uacute;ltiple&quot;) involucra a dos o m&aacute;s ubicaciones, donde la ubicaci&oacute;n final es un contenedor flsico. Hay muchas variaciones. Lo m&aacute;s com&uacute;n es que el primer cache o
                              waypoint contenga o proporcione las coordenadas de la pr&oacute;xima localizaci&oacute;n. Otra variaci&oacute;n muy popular es una
                              serie de waypoints donde cada uno de estos sitios proporcionan parte de las coordenadas de la posici&oacute;n exacta del
                              cache final.</li>
                         <li><strong>Misterio o rompecabezas Caches:</strong> Es el Gran tesoro de todos los tipos de caches. Esta clase de caches
                              , puede consistir en complicados rompecabezas que hay que resolver para detenninar las coordenadas del
                              cach&eacute; (por ejemplo, Investigar en p&aacute;ginas wcb p&uacute;blicas para as&iacute; poder determinar las coordenadas). Las coordenadas
                              publicadas en la p&aacute;gina del cach&eacute; no son la localizaci&oacute;n exacta del cache sino un punto de referencia general que
                              no deber&iacute;an estar a m&aacute;s de 2 &oacute; 3 kil&oacute;metros de distancia.</li>
                         <li> <strong>Evento:</strong> es una reuni&oacute;n de geocachers locales u organizaciones de geocaching para hablar de geocaching.
                              La p&aacute;gina de la cach&eacute; de eventos especifica un tiempo para el evento y proporciona las coordenadas de su
                              ubicaci&oacute;n.</li>
                         <li><strong>Mega-Evento: </strong>es un evento al que asisten m&aacute;s de 500 personas, por lo que ese volumen de gente requiere
                              una planificaci&oacute;n detallada. Estos grandes acontecimientos atraen geocachers de todo el mundo y con
                              frecuencia se lleva a cabo anualmente.<br />
                              <strong>Evento de basura fuera:</strong> son reuniones de geocachers que se centran en la basura de limpieza,
                              eliminaci&oacute;n de especies invasoras, esfuerzos de reforestaci&oacute;n o construcci&oacute;n de senderos. Algo a tener en
                              cuenta para la educaci&oacute;n ambiental.<br />
                              <strong>EarthCache: </strong>es un lugar especial que la gente puede visitar para conocer algo m&aacute;s acerca de una
                              caracteristica &uacute;nica de las ciencias de la tierra.<br />
                              <strong>Cach&eacute; Virtual: </strong>se trata de descubrir un lugar interesante y fuera de lo com&uacute;n, en vez de un contenedor.
                              Los requisitos para el registro de un cache virtual varian (se le puede pedir responder a una pregunta acerca de la
                              ubicaci&oacute;n. tomar una foto, completar una tarea, etc).</li>
                         </ol>
                    </div>
               </div>
               <div class="content">
                    <h3>Tama&ntilde;os de los caches</h3>
                    <div class="museo">
                   
                         <p>Hablamos de los caches como recipiente f&iacute;sico.</p>
                         <ol>
                         <li>Nano: contenedor del tamallo de una falange de un dedo, incluso menor.<br />
                              Micro: bote de carretes de fotos, o tubo del que se hacen las botellas de agua. Pequello: Tupperware de tamallo de un s&aacute;ndwich o similar.<br />
                              Nonnal: Tupperware nonnal.</li>
                         <li> Grande: Cubo o bote de dimensiones mayores.</li>
                         </ol>
                         
                    </div>
               </div>
               <div class="content">
                    <h3>&iquest;Qu&eacute; contienen los caches?</h3>
                    <div class="museo">
                         <p><strong>Bolsas Zip de diversos tama&ntilde;os</strong>. No puede faltar. Su raz&oacute;n de ser, preservar el contenido de los cach&eacute;s.</p>
                         <p> <strong>Libro de registro.</strong> Seg&uacute;n sea el tamallo del cach&eacute;, as&iacute; ser&aacute; el tamallo del &quot;Logbook&quot;. Puede ser una tira de papel
                         enrollada (para los nanos), una libreta o incluso un cuaderno. Recomendado que quede dentro de una bolsa zip,
                         henn&eacute;tica o estanca.    </p>
                         <p><strong>Lapiz, </strong>para apuntar el hallazgo del cach&eacute;. Nunca un bol&iacute;grafo, porque se puede secar o puede manchar el
                         contenido del cach&eacute; en caso de que se estropee. A&uacute;n asi, cada geocacher suele llevar su propia &quot;maquina de
                         registro~' (no s&oacute;lo un boligrafo, SinO tambien una pegatma o un sello).    </p>
                         <p><strong>Artlculos de intercambio</strong>:
                         Quien esconde un cach&eacute;, puede meter cualquier objeto menos comida (o art&iacute;culos que huelen a comida, ya que los ammales
                         pueden buscar en los recipIentes y destruirlos), explosivos, fuegos artificiales, munici&oacute;n, mecheros, navajas (incluyendo
                         multiusos), pilas, drogas, alcohol u olro material il&iacute;cito o dallino para el medio ambiente.
                         Hay que tener en cuenta de que el Geocaching tambi&eacute;n es una actividad familiar y el contenido de los caches debe
                         ser conveniente para todas las edades.
                         Lo normal suele ser juguetes, pines o chapas, folletos, monedas, cuelgam&oacute;viles, barajas.. muchos de los objetos
                         suelen ser elementos de propaganda o &quot;merchandising&quot;.    </p>
                         <p><strong>Rastreables o viajeros:</strong> Son &quot;piezas especiales de juego&quot; de geocaching, y no hay raz&oacute;n para encontrarlos siempre.
                         Son objetos grabados con un c&oacute;digo o identificador &uacute;nico de seguimiento (como si fuera una matr&iacute;cula) que se utiliza
                         para registrar sus movimientos a medida que viaja por el mundo real de cach&eacute; en cach&eacute;. Cada rastreable puede
                         tener una misi&oacute;n dada por su creador (por ejemplo, viajar por todas las capitales nacionales .. ), y tienen que estar dados de
                         alta (te dan otro c&oacute;digo, previo pago, a modo de permiso de circulaci&oacute;n).</p>
                         <p>Hay dos formas de registrar los rastreables, el Retrieve (que es cuando lo retiras y le ayudas a viajar para cumplir su misi&oacute;n), y el discovered (lo dejas donde esta, pero lo registras con el n&uacute;mero de la placa; asi se da constancIa que SIgue en el sitio y nadie lo ha
                         relirado).<br />
                         Los tipos mayoritarios son las Geocoin (moneda especial) y los Travel Bugs (chapa rastreable), y hay que pagar por
                         ellos. Tambi&eacute;n hay otros modelos, m&aacute;s minoritarios, incluso gratuitos, pero hay que tener alg&uacute;n programa a
                         mayores para poder visualizarlos y registrarlos (<a href="http://www.geokrety.org" title="geotreky">http://www.geokrety.org</a>). <a href="http:/www.geocaching.com/track/default.aspx">M&aacute;s informaci&oacute;n</a>.<br />
                         <strong>Articulos de coleccionista:</strong> Son sobre todo las Pathtags (Pts), moneditas, de 23 mm de di&aacute;metro y 2,0 mm de espesor, que se pueden
                         coleccionar (se suelen intercambIar por otras, o por objetos de m&aacute;s valor). No son rastreables, pero se pueden convertir si
                         tienen un vehlculo con matr&iacute;cula y c&oacute;digo. Este veh&iacute;culo recibe el nombre de &quot;Sherpa&quot;, de unos 4,5 cm de l di&aacute;metro. Tambi&eacute;n tienen un c&oacute;digo num&eacute;rico.</p>
                         <p> Hay muchos geocachers que coleccionan estas monedas, y que tienen sus monedas como objeto de firma y de
                         intercambio (a modo de huella). Tambi&eacute;n se suele utilizar como suvenir o recuerdo para los asistentes de &quot;Cach&eacute;seventos&quot;.
                         Tambi&eacute;n es una buena forma de difundir una ciudad, una provincia ..
                         Para m&aacute;s informaci&oacute;n sobre Pts se puede ir a los siguientes enlaces: <a href="http://www.pathtags.com" title="pathtags">http://www.pathtags.com</a>; <a href="http://www.paztags.com" title="paztags">http://www.paztags.com</a>; <a href="http://www.pathtagsibericos.com" title="pathtagsibericos">http://www.pathtagsibericos.com</a>.</p>
                         
               
                    s
                         <p><strong>Los esconden</strong> (publican) <strong>y los buscan los jugadores registrados.</strong><br />
                         El que lo esconde (conocido como propIetario del cache) adquiere el compromiso de mantenerlo, se hace responsable
                         de &eacute;l (visita el lugar de vez en cuando y se asegura de que&quot;, el escondite&quot;, los objetos sufren deterioro ... ). Si un geocacher que ha<br />
                         encontrado un cach&eacute; estropeado (porque alguien lo ha cerrado mal, porque ha sido descubierto y expoliado o por un animal o por
                         una persona ... ) y avisa de su estado, el propietario tendr&aacute; que acercarse aunque no lo tuviera planeado.</p>
                         <p> Si no se restaura, los revisores (voluntarios que se encargar ver si los cach&eacute;s cumplen los requ isitos y dar el visto bueno a su
                         publicaCI&oacute;n) pueden archivar el clch&eacute; (deja de aparecer en las herramIentas de b&uacute;squeda de los geocachers que no han encontrado
                         el cache).</p>
                         <p> Que<strong> la mejor recompensa</strong>, en muchas ocasiones, son las vistas y los lugares que nos invitan a visitar, y por
                         supuesto, la gente que se conoce y con la que se puede compartir esta afici&oacute;n.</p>
                         <p> Otra cosa, <strong>hay cach&eacute;s muy originales</strong> como prueban los siguientes videos:</p>
                         <div class="video-container"><iframe width="420" height="315" src="http://www.youtube.com/embed/azKh4qyGdkI" frameborder="0" allowfullscreen></iframe></div>
                         <div class="video-container"><iframe width="560" height="315" src="http://www.youtube.com/embed/qiOiThvgwHA" frameborder="0" allowfullscreen></iframe></div>
                         <div class="video-container"><iframe width="560" height="315" src="http://www.youtube.com/embed/XnfCXxpqOi4" frameborder="0" allowfullscreen></iframe></div>
                         </p>
                         <p>Si se busca en youtube con las siguientes palabras, &quot;geocaching containers&quot;, aparecer&aacute;n muchos m&aacute;s.    </p>
                         <p>Es recomendable que haya una cierta uniformidad de estilo, tanto en los contenedores, como en los Lookbook y
                         otras cuestiones. Esto ayuda a dar una misma entidad al geocacher y a sus series de cach&eacute;s (otra definici&oacute;n: gusano
                         sene de caches, con un m&iacute;nimo de 20 contenedores y bastante seguidos en el espacio, de tal manera, que VIstos en el mapa de geocaching
                         forman como un gusano). El colocar
                         No olvidemos algunos <strong>enemigos de los cach&eacute;s:</strong></p>
                         <ol>
                         <li><strong>Humedad</strong> (a temperaturas bajo cero. hay muchos tipos de pl&aacute;stico que se vuelven rigidos y quebradizos, y con el calor se dilatan y se deforman .<br />
                              la mejor recomendaci&oacute;n: un buen contenedor &quot;aplo para microondas, congelador y lavavajillas) .<br />
                              <strong>Temperaturas extremas</strong> (influye mucho el lugar donde se sit&uacute;a el cach&eacute; y la posici&oacute;n en que se coloca el contenedor. la mejor
                              recomendaci&oacute;n: un buen contenedor que tenga sello de goma en la tapa. objetos en bolsas zip, y una bolsita anti-humedad, de gel de s&iacute;lice).</li>
                         </ol>
                         <p> Tambi&eacute;n, y a modo de recomendaci&oacute;n, est&aacute; el<strong> kit del geocacher:</strong></p>
                         <ol>
                         <li>      Si es al aire libre, material de senderismo (buen calzado: mochila, ri&ntilde;onera. para llevar las &quot;berramientas&quot;: ropa adecuada
                              impcnneable y de abrigo: bastones; mapa topogr&aacute;fico, br&uacute;jula: botiquin, linterna ... )<br />
                              El GPS, c&aacute;mara fotogr&aacute;fica, de video y pilas de repuesto.<br />
                              Material para el mantenimiento de los cach&eacute;s (rollo peque&ntilde;o de cinta adhesiva americana o de electricista., bolsas zip, adhesivo de
                              cianocrilato o superglue. pa&ntilde;uelos de bolsillo para secar un cach&eacute; empapado; s&iacute; esta muy mal. contenedores. l&aacute;pices y logbooks). Y es que no
                              est&aacute; dem&aacute;s ser solidario y reparar los cach&eacute;s. Si no se ha necesitado, se puede aprovechar para poner un cach&eacute;    propio.</li>
                         </ol>
                    </div>
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