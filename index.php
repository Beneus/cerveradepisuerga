<?php
namespace citcervera;
error_reporting(E_ALL);
ini_set("display_errors","On");

include("includes/funciones.php");
include("includes/Conn.php");


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
 $MetaTitulo = "Cervera de Pisuerga, Palencia: El corazón de la Montaña Palentina";

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
                    <h1>Inicio</h1>
                    <div class="MigasdePan"><a href="index.php" title="inicio">inicio</a></div>
                    <?php 
                    if($ImgDescripcion > 0){
                         $link = ConnBDCervera();
                         $sql = "select * from Imagenes where idImagen = $ImgDescripcion and Publicar = 1 ";
                         mysqli_query($link, $sql);
                         $result = mysqli_query($link, $sql);
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
                              echo "<a href='$Path/$Archivo'  class='lightbox' title='$Titulo' hreflang='es' ><img src=\"$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                         }
                         mysqli_free_result($result);
                    }
                         echo $Descripcion; 
                    ?>
               </div>
               <div class="content">

                      <?php
                         $sql = "select * from Imagenes where Ambito = 'Inicio' ";
                         $link = ConnBDCervera();
                         $result = mysqli_query($link,$sql);
                              if (!$result){
                                   $message = "Invalid query".mysqli_error($link)."\n";
                                   $message .= "whole query: " .$sql;	
                                   die($message);
                                   exit;
                              }
                              
                              $max = mysqli_num_rows($result);	
                    
                              if($max > 0){
               
                              echo"<a href='galeriafotografica.php?Ambito=Inicio&amp;idAmbito=1&amp;Origen=index.php&amp;Campo=' hreflang='es'>";
                              echo "<h3>Galería fotográfica</h3>";
                              echo "</a>";
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