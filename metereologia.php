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
                    <iframe name="iframe_aemet_id33044" width="100%" height="470" tabindex="0" id="iframe_aemet_id33044" src="https://www.aemet.es/es/eltiempo/prediccion/municipios/mostrarwidget/cervera-de-pisuerga-id34056?w=g4p11111111ovmffffffw992z470x4f86d9t95b6e9r1s8n2" frameborder="0" scrolling="no"></iframe>
                    http://www.aemet.es/es/eltiempo/prediccion/municipios/cervera-de-pisuerga-id34056
     
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