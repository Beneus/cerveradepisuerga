<?php
//ini_set ('error_reporting', E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");
  
$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Inicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
$sql = " select * from Caza Limit 0,1";  
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
$MetaTitulo = "Cervera de Pisuerga: Caza en la Reserva Regional Fuentes Carrionas";
$MetaDescripcion = "Cervera de Pisuerga, en El coraz�n de la Monta�a Palentina. Caza en la Reserva Regional Fuentes Carrionas, solicitudes, fechas y normas. Tramitaci�n de permisos, plazos cotos.";
$MetaKeywords = "Cervera de Pisuerga, Monta�a Palentina, Caza, Reserva Regional, Fuentes Carrionas, solicitudes, fechas, normas, permisos, plazos, cotos, cazadores, ciervo, rebeco, corzo, jabali";
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
               <h1>caza</h1>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qu� ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="caza.php" title="caza en la Monta�a Palentina">caza</a>
               </div>
               </div>
               <div class="content">
               <div class="museo">
               <?php 
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
                              echo "<a href='$Path/$Archivo' title='$Titulo'><img src=\"$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                         }
                         mysqli_free_result($result);

               }
                    echo $Descripcion; 
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