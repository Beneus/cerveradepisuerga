<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");
  
$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Inicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
$sql = " select * from Pesca where idPesca = 0 Limit 0,1"; 
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
$Descripcion = html_entity_decode($row["Descripcion"]);	
$ImgPesca = $row["ImgPesca"];		
}
mysqli_free_result($result);
mysqli_close($link);	
$MetaTitulo = "Cervera de Pisuerga: Pesca en la Monta�a Palentina";
$MetaDescripcion = "Pesca en la Monta�a Palentina: Cotos de pesca, zonas de pesca sin muerte y tradicional. Pesca en rios Pisuerga, Carri�n y Rivera de alta monta�a ";
$MetaKeywords = "Cervera de Pisuerga, Pesca, Cotos, Pesca sin muerte, pesca tradicional, mosca artificial, Monta�a Palentina, Pisuerga, Carri�n, Rivera, Carda�o, Arauz, Pineda, Triollo, Velilla, Ventanilla, Quintanaluengos";
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
               <h1>Pesca</h1>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qu� ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="pesca.php" title="Pesca, cotos y zonas de pesca en la Monta�a Palentina">Pesca</a>
               </div>
               </div>
               <div class="content">
                    <div class="museo">
                    <?php 
                    $link = ConnBDCervera();
                    if($ImgPesca > 0){
                         
                         $sql = "select * from Imagenes where idImagen = $ImgPesca and Publicar = 1 ";
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
                                   echo "<a href='$Path/$Archivo' title='$Titulo'><img src=\"$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\"/></a>";
                              }
                              mysqli_free_result($result);
                    }
                         echo $Descripcion; 
                    ?>

                    </div>
                    </div>
                    <div class="content">
                    <?php
                         $sql = "select * from Imagenes where Ambito = 'Pesca' and idAmbito = 0 ";
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
                              echo"<a href='galeriafotografica.php?Ambito=Pesca&idAmbito=1&Origen=pesca.php&Campo='  accesskey=\"K\" hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
                              echo "Galería fotográfica";
                              echo "</a></h3>";
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