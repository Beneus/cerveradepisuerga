<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");
  
$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Inicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
$sql = " select * from Setas where idSetas = 0 Limit 0,1";  
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
$Comentarios = html_entity_decode($row["Comentarios"]);	
$ImgSetas = $row["ImgSetas"];		
}
mysqli_free_result($result);
mysqli_close($link);	
$MetaTitulo = "Cervera de Pisuerga: Setas de la Montaña Palentina";
$MetaDescripcion = "Guia de Flora, senderismo, Mountain Bike, MTB en la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Peña del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
$MetaKeywords = "Cervera de Pisuerga, Guia de rutas, Montaña Palentina, Guia de rutas de la Montaña Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero histórico, Fuente del Cobre y Deshondonada, Senda Pea del Oso, Tejada de Tosande , Bosque Fósil, Peña Redonda";
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
                    <h1>Setas</h1>
                    <div class="MigasdePan">
                    <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
                    <a href="setas.php" title="Setas de la Montaña Palentina">Setas</a>
                    </div>
               </div>
               <div class="content">
                    <div class="museo">
               <?php 
                    $link = ConnBDCervera();
                    if($ImgSetas > 0){
                         
                         $sql = "select * from Imagenes where idImagen = $ImgSetas and Publicar = 1 ";
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
                                   echo "<a href='$Path/$Archivo'  title=''><img src=\"$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                              }
                              mysqli_free_result($result);
                    }
                    echo $Comentarios; 
                 
               ?>


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