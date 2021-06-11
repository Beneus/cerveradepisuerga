<?php
include("includes/funciones.php");
include("includes/Conn.php");
  
$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Inicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
$sql = " select * from ComoLlegar Limit 0,1";  
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
$MetaTitulo = "Cervera de Pisuerga: Como llegar en coche, autobus, tren, avión";
$MetaDescripcion="Cómo llegar a Cervera y al resto de la Montaña Palentina desde: Palencia, Vallaolid, Madrid, Burgos, Santander, León... por carretera, coche , autobus, tren, y avión";
$MetaKeywords="Cervera de Pisuerga, Montaña Palentina, ALSA, FEVE, RENFE, Autobuses DUQUE, Autobuses del Pisuerga, avión, transporte, comunicación, carreteras, Palencia, Vallaolid, Madrid, Burgos, Santander, León...";
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
               <h1>Cómo llegar</h1>
                    <div class="MigasdePan">
                    <a href="localizacion.php">Localización</a>&nbsp;&gt;&nbsp;
                    <a href="como-llegar.php">cómo llegar</a>   	
                    </div>
               </div>
               <div class="content">
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
            
       }
       mysqli_free_result($result);
       
     
     echo "<a href='$Path/$Archivo' class='lightbox'><img src=\"$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
}
     echo $Descripcion; 
?>
               </div>
               <div class="content">
               <?php
   		$sql = "select * from Imagenes where Ambito = 'ComoLlegar' ";
   		$result = mysqli_query($link, $sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			
			$max = mysqli_num_rows($result);	
	
			if($max > 0){

			echo"<a href='galeriafotografica.php?Ambito=ComoLlegar&amp;idAmbito=1&amp;Origen=como-llegar.php&amp;Campo='>";
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