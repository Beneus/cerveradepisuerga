<?php
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: Callejero, Plano, Mapa";
$MetaDescripcion = "Cervera de Pisuerga: Callejero, Plano, Mapa";
$MetaKeywords = "Cervera de Pisuerga, Callejero, Plano, Mapa";

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
                    <h1>Callejero de Cervera de Pisuerga</h1>
                    <div class="MigasdePan"><a title="Localización" href="localizacion.php">Localización </a>&gt; <a title="Callejero de Cervera de Pisuerga" href="callejero.php">Callejero de Cervera de Pisuerga</a></div>
               </div>
               <div class="content">
                    <div class="center">
                         <a href="images/Mapaextensible.jpg" rel='lightbox'><img src="images/Mapaextensible.gif" alt="Ver imagen más grande" width="580" height="409" class="center" /></a><br />
                    <br />
                    <a href="callejero/Mapaextensible.pdf" target="_blank" class="linkVerde">descargar callejero en formato pdf</a><br />
                    <br />
                    <a href="http://www.adobe.com/es/products/acrobat/readstep2.html"><img src="images/get_adobe_reader.png" alt="descargar Adobe Reader" width="158" height="39" class="center" /></a><br />
                    <br />
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