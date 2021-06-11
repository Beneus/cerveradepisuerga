<?php
//setlocale  (LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: Rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina";
$MetaDescripcion = "Guia de rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Roblón de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
$MetaKeywords = "Guia de rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
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
               <h1><img src="iconos/rutas.png" alt="Rutas por la Montaña Palentina" title="Rutas por la Montaña Palentina" width="32" height="32" class="iconosimagen"/> Rutas</h1>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="rutas.php" title="Rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina">Rutas</a>
               </div>
               </div>
               <div class="content">
               <?php 
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                    $link = ConnBDCervera();
                    $sql = "SELECT idRuta, Ruta, Inicio, Llegada, Distancia, Tiempo, Piso FROM Rutas ";
                    $sql = $sql . " order by Ruta ";

                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    mysqli_query($link,'SET NAMES utf8');
                    $result = mysqli_query($link, $sql);
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
                         while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>
                    <div class="museo">
                    <h2><a href="rutas-detalle.php?idRuta=<?php echo $row["idRuta"];?>" class="strRutas"><?php echo $row["Ruta"];?></a></h2>
                    ( de <?php echo $row["Inicio"];?> a <?php echo $row["Llegada"];?> )</div>
                    <?php
                         }
                    }else{
                         // No hay entradas en el directorio
                    ?>
                    <div class="errortexto">No hay Rutas establecidas</div>
                    <?php
                    }
                    mysqli_free_result($result);
                    mysqli_close($link);	
                    ?>
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