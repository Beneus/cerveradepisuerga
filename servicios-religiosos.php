<?php
include("includes/Conn.php");
include("includes/funciones.php");

$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Inicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   
$sql = " select * from Religion Limit 0,1";  
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


$MetaTitulo = "Cervera de Pisuerga: Servicios religiosos en Cervera de Pisuerga";
$MetaDescripcion = "Cervera de Pisuerga, en El corazón de la Montaña Palentina. Servicios religiosos y otras fiestas y celebraciones.";
$MetaKeywords =  "Cervera de Pisuerga, Montaña Palentina, Cervera de Pisuerga, Palencia, Castilla y León, rural, Servicios religiosos";

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
               <h1>Servicios religiosos</h1>
				<div class="MigasdePan">
				<a href="que-ofrecemos.php" title="Qu� ofrecemos">Qué ofrecemos</a> &gt; 
				<a href="servicios-religiosos.php" title="servicios religiosos en la Montaña Palentina">servicios religiosos</a>
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
							echo "<a href='$Path/$Archivo'  class='lightbox' title='$Titulo'><img src=\"$Path/$Archivo\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" /></a>";
						}
						mysqli_free_result($result);

				}
					echo $Descripcion; 
				?>
     			</div>
	 <?php
	 
	 // listado de documentos asociados
$sql = "select * from Documentos where Ambito = 'Religion' and idAmbito = 1 and Publicar = 1 order by Orden";
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

			echo "<div class=\"etiqueta\"> ";
			echo "<img src=\"images/documentos.png\" width=\"280\" height=\"50\" name=\"etiqueta\"/>";
			echo "</div>";
	   		echo "<div class='museo'><ul>";
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$DocTitulo = $row["Titulo"];
				$DocPie = $row["Pie"];				
				
				if ($DocTitulo != ""){
				
				echo "<li>";
				echo "<a href=\"".$row["Path"]."/".$row["Archivo"]."\" title=\"".$row["Titulo"]."\">".$DocTitulo."</a>";
				if ($DocPie != ""){echo "<p>$DocPie</p>";}
				echo "</li>";
				
				}else{
				echo "<li><a href=\"".$row["Path"]."/".$row["Archivo"]."\" title=\"".$row["Titulo"]."\">".$row["Archivo"]."</a></li>";
				}
			}
			echo "</ul></div>";
	   	}
	   	mysqli_free_result($result);
		
	 	$link = ConnBDCervera();
   		$sql = "select * from Imagenes where Ambito = 'Religion' ";
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			
			$max = mysqli_num_rows($result);	
	
			if($max > 0){
	   		echo "<div class='museo'>";
			echo"<a href='galeriafotografica.php?Ambito=Religion&amp;idAmbito=1&amp;Origen=servicios-religiosos.php&amp;Campo=idReligion' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "<img src='images/galeriafotografica.png' name='etiqueta' alt='Galer�a fotogr�fica' title='Galer�a fotogr�fica, tecla K' width='280' height='50'  />";
			echo "</a></div>";
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




