<?php
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Predicción metereológica y clima de Cervera de Pisuerga y la Montaña Palentina. El clima";
$MetaDescripcion = "Cervera de Pisuerga, en el corazón de la Montaña Palentina. Predicción metereológica y clima de Cervera de Pisuerga y la Montaña Palentina. El clima";
$MetaKeywords = "Cervera de Pisuerga, Tiempo, clima, nieve, sol, lluvia, previsión, Montaña Palentina, rural,tradicional, tradición ganadera, comercial, artesanal, capital, Monta�a Palentina";

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
                    <h1>Predicción meteorológica</h1>
                    <div class="MigasdePan">
                         <a title="Localización" href="localizacion.php">Localización </a>&gt; <a title="predicci&oacute;n metereol&oacute;gica" href="metereologia.php">Predicción meteorológica</a>
                    </div>
               
               </div>
              
  
               <div class="content">

                    <div style=' background-image: url( http://vortex.accuweather.com/adcbin/netweather_v2/backgrounds/green_500x440_bg.jpg ); background-repeat: no-repeat; background-color: #336633;margin-left:auto;margin-right:auto;' >
                         <div style='height: 420px;' >
                              <script type="text/javascript" src='http://netweather.accuweather.com/adcbin/netweather_v2/netweatherV2.asp?partner=netweather&amp;tStyle=whteYell&amp;logo=0&amp;zipcode=EUR|ES|SP007|CERVERA|&amp;lang=esp&amp;size=13&amp;theme=green&amp;metric=1&amp;target=_self'></script>
                              </div>
                         <div style='text-align: center; font-family: arial, helvetica, verdana, sans-serif; font-size: 12px; line-height: 20px; color: #FFFFFF;' >
                                <a style='color: #FFFFFF' href='http://www.accuweather.com/world-index-forecast.asp?partner=netweather&amp;locCode=EUR|ES|SP007|CERVERA|&amp;metric=1' >Weather Forecast</a> 
                              | <a style='color: #FFFFFF' href='http://www.accuweather.com/maps-satellite.asp' >Weather Maps</a> 
                              | <a style='color: #FFFFFF' href='http://www.accuweather.com/index-radar.asp?partner=accuweather&amp;traveler=0&amp;zipcode=EUR|ES|SP007|CERVERA|' >Weather Radar</a> 
                              | <a style='color: #FFFFFF' href='http://hurricane.accuweather.com/hurricane/index.asp' >Hurricane Center</a>
                         </div>
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