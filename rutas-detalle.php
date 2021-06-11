<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");
$idRuta = $_GET["idRuta"];
$msnError = "";
 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT * FROM Rutas where idRuta = $idRuta";
$sql = $sql . " order by Ruta ";
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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

$Ruta = $row["Ruta"];
$Inicio = $row["Inicio"];
$Llegada = $row["Llegada"];
$Distancia = $row["Distancia"];   
$Tiempo = $row["Tiempo"];
$Desnivel = $row["Desnivel"];
$Piso = $row["Piso"];  
$Dificultad = $row["Dificultad"];
$Epoca = $row["Epoca"];
$ImgDescripcion = $row["ImgDescripcion"];
$ImgFlora = $row["ImgFlora"];
$ImgFauna = $row["ImgFauna"];
$Flora = html_entity_decode($row["Flora"]);
$Fauna = html_entity_decode($row["Fauna"]);
$Descripcion = html_entity_decode($row["Descripcion"], ENT_QUOTES);

}else{
	// No hay entradas en el directorio
$msnError = "La Ruta no est&aacute; disponible, perdone las molestias.";
}
mysqli_free_result($result);
mysqli_close($link);

$MetaTitulo = "Rutas de la Montaña Palentina: " . $Ruta ;
$MetaDescripcion = $MetaTitulo .", origen:" . $Inicio ." y destino en  " . $Llegada .", con una distancia de " .$Distancia .", tiempo estimado de " .$Tiempo.", y una dicficultad " .$Dificultad. ", se puede ralizar ". $Epoca;
$MetaKeywords = $Ruta .", " . $Inicio .", " . $Llegada .", " . $Distancia .", " . $Tiempo .", " .$Dificultad .", " .$Epoca .", " .$Piso;
$MetaDescripcion = GetDescription($MetaDescripcion  ,200);
$MetaKeywords = GenKeyWords($MetaKeywords,4);
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
               <h2><img src="iconos/rutas.png" alt="Rutas por la Montaña Palentina" title="Rutas por la Montaña Palentina" width="32" height="32" class="iconosimagen"/> Rutas</h2>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="rutas.php" title="Rutas, senderismo, Mountain Bike, MTB en la Montaña Palentina">Rutas</a> &gt; 
               <a href="rutas-detalle.php?idRuta=<?php echo $idRuta; ?>" title="<?php echo $Ruta; ?>"><?php echo $Ruta; ?></a>
               </div>
               </div>
               <div class="content">
               <?php
               if($msnError == ""){  
               ?>
               <h3><?php echo $Ruta;?></h3>
               <div class="museo">
               <ul>
               <li><span class="DatosTitulo">Inicio</span><span class="DatosValor"><?php echo $Inicio;?></span></li>
               <li><span class="DatosTitulo">Destino</span><span class="DatosValor"><?php echo $Llegada;?></span></li>
               <li><span class="DatosTitulo">Distancia</span><span class="DatosValor"><?php echo $Distancia;?></span></li>
               <li><span class="DatosTitulo">Tiempo</span><span class="DatosValor"><?php echo $Tiempo;?></span></li>
               <li><span class="DatosTitulo">Desnivel</span><span class="DatosValor"><?php echo $Desnivel;?></span></li>
               <li><span class="DatosTitulo">Piso</span><span class="DatosValor"><?php echo $Piso;?></span></li>
               <li><span class="DatosTitulo">Dificultad</span><span class="DatosValor"><?php echo $Dificultad;?></span></li>
               <li><span class="DatosTitulo">Epoca</span><span class="DatosValor"><?php echo $Epoca;?></span></li>
               </ul>
               </div>
               <?php
               }
               ?>
               </div>


               <div class="content">

              <?php  if($Descripcion != ""){
		echo "<h3>Descripción</h3>";
		echo "<div class=\"museo\">";
   	if($ImgDescripcion > 0){
   		$link = ConnBDCervera();
   		$sql = "select * from Imagenes where idImagen = $ImgDescripcion and Publicar = 1 ";
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			$max = mysqli_num_rows($result);	
			if($max > 0){
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$Path = $row["Path"];
				$Archivo = $row["Archivo"];
				$Titulo = $row["Titulo"];
				$Pie = $row["Pie"]; 
				$Ancho = $row["Ancho"];
				$Alto = $row["Alto"];
				$AnchoThumb = $row["AnchoThumb"];
				$AltoThumb = $row["AltoThumb"];
				echo "<a href=\"$Path/$Archivo\" title='$Titulo'><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\"/></a>";
			}
			mysqli_free_result($result);
   		mysqli_close($link);	
   		
   	}
   		echo $Descripcion; 
   		echo "</div>";
        }
        ?>
               </div>
               <div class="content">
<?php
               $sql = "select * from Imagenes where Ambito = 'Rutas' and IdAmbito = $idRuta and Publicar = 1";
   		$link = ConnBDCervera();
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			
			$max = mysqli_num_rows($result);	
	
			if($max > 1){
	   	echo "<h3>";
			echo"<a href='galeriafotografica.php?Ambito=Rutas&amp;idAmbito=$idRuta&amp;Origen=rutas-detalle.php&amp;Campo=idRuta' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "Galería fotográfica";
			echo "</a></h3>";
	   	}
	   	mysqli_free_result($result);
			mysqli_close($link);	
?>
</div>
<?php

             if($Flora != ""){
          echo "<div class=\"content\">";
		echo "<h3>Flora</h3>";
   		echo "<div class=\"museo\">";
   	if($ImgFlora > 0){
   		$link = ConnBDCervera();
   		$sql = "select * from Imagenes where idImagen = $ImgFlora and Publicar = 1 ";
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			$max = mysqli_num_rows($result);	
			if($max > 0){
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$Path = $row["Path"];
				$Archivo = $row["Archivo"];
				$Titulo = $row["Titulo"];
				$Pie = $row["Pie"]; 
				$Ancho = $row["Ancho"];
				$Alto = $row["Alto"];
				$AnchoThumb = $row["AnchoThumb"];
				$AltoThumb = $row["AltoThumb"];
				echo "<a href=\"$Path/$Archivo\" title='$Titulo'><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\"/></a>";
			}
			mysqli_free_result($result);
   		mysqli_close($link);	
   		
   	}
   		echo $Flora; 
             echo "</div>";
             echo "</div>";
        }

        // Fauna		
if($Fauna != ""){
     echo "<div class=\"content\">";
		echo "<h3>Fauna</h3>";
   		echo "<div class=\"museo\">";
   if($ImgFauna > 0){
        $link = ConnBDCervera();
        $sql = "select * from Imagenes where idImagen = $ImgFauna and Publicar = 1 ";
        $result = mysqli_query($link,$sql);
          if (!$result){
               $message = "Invalid query".mysqli_error($link)."\n";
               $message .= "whole query: " .$sql;	
               die($message);
               exit;
          }
          $max = mysqli_num_rows($result);	
          if($max > 0){
               $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
               $Path = $row["Path"];
               $Archivo = $row["Archivo"];
               $Titulo = $row["Titulo"];
               $Pie = $row["Pie"]; 
               $Ancho = $row["Ancho"];
               $Alto = $row["Alto"];
               $AnchoThumb = $row["AnchoThumb"];
               $AltoThumb = $row["AltoThumb"];
               echo "<a href=\"$Path/$Archivo\" title='$Titulo'><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
          }
          mysqli_free_result($result);
        mysqli_close($link);	
        
   }
        echo $Fauna; 
        echo "</div>";
        echo "</div>";
   }
        
  if ($idRuta != 21){ ?>
     <div class="content">
     <div class="museo">
     <p>
     Recorrido virtual de la ruta en 3D con Google Earth. </p>
       <p><img src="images/ico_google2.gif" width="16" height="16" class="iconosimagen" alt="Google" /><a href="Rutas/ruta<?php echo $idRuta;?>.kmz" title="<?php echo $Ruta;?> con Google Earth"><?php echo $Ruta;?></a></p>
       <p class="EarthGoogle">
           <a href="http://earth.google.es/" title="Descargar Google Earth - Cervera de Pisuerga: La Montaña Palentina" target="_blank" class="linksencillo">Descarga  el programa
           <br />
           <img src="images/googleearth.gif" width="150" height="55" alt="Google Earth"/></a></p>
     </div>
     </div>
     <?php 
     }
        ?>
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