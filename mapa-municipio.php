<?php
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: mapa, plano del municipio";
$MetaDescripcion = "Cervera de Pisuerga, mapa, plano del municipio de Cervera de Pisuerga";
$MetaKeywords = "Cervera de Pisuerga, Pisuerga, Montaña Palentina, rural,tradicional, tradición ganadera, comercial, artesanal, capital, Montaña Palentina, cabecera de partido judicial, turísmo, naturaleza virgen, arte, historia";

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
                    <h1>Mapa del municipio</h1>
                    <div class="MigasdePan">
                         <a title="Localización" href="localizacion.php">Localización </a>&gt; <a title="Mapa del municipio" href="mapa-municipio.php">Mapa del municipio </a>
                    </div> 
               </div>
               <div class="content">
                    <a href="images/municipio2.gif">
                         <img src="images/municipio2.gif" title="Mapa del municipio Aguas arriba del Pisuerga y la Montaña Palentina" alt="Mapa del municipio Aguas arriba del Pisuerga y la Montaña Palentina" />
                    </a>
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