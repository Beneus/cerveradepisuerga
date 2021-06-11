<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idFauna = $_GET["idFauna"];

 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT * FROM Fauna where idFauna = $idFauna";

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

$idFlora = $row["idFlora"];
$NombreComun = $row["NombreComun"];
$NombreCientifico = $row["NombreCientifico"];
$Familia = $row["Familia"];   
$Habitat = html_entity_decode($row["Habitat"]);
$Usos = html_entity_decode($row["Usos"]);
$Descripcion = html_entity_decode($row["Descripcion"], ENT_QUOTES);
$ImgDescripcion = $row["ImgDescripcion"];
$Habitat = html_entity_decode($row["Habitat"], ENT_QUOTES);
$ImgHabitat = $row["ImgHabitat"];

}else{
	// No hay entradas en el directorio
$msnError = "La Ruta no está disponible, perdone las molestias.";
}
mysqli_free_result($result);


$MetaTitulo = "Fauna en la Montaña Palentina: $NombreComun $NombreCientifico $Familia";
$MetaDescripcion = GetDescription($MetaTitulo . " " . $Descripcion  ,200);
$MetaKeywords = GenKeyWords($MetaDescripcion,4);
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
               <h2>Fauna</h2>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="fauna.php" title="Fauna de la Montaña Palentina" >Fauna</a> &gt; 
               <a href="fauna-detalle.php?idFauna=<?php echo $idFauna; ?>" title="<?php echo $NombreComun; ?>" ><?php echo $NombreComun; ?></a>
               </div>
               </div>
               <div class="content">
                    <h1><?php echo $NombreComun;?></h1>
                    <div class="museo">
                         <ul>
                         <li><span class="DatosTitulo">Nombre común</span><span class="DatosValor"><?php echo $NombreComun;?></span></li>
                         <li><span class="DatosTitulo">Nombre cientifico</span><span class="DatosValor"><?php echo $NombreCientifico;?></span></li>
                         <li><span class="DatosTitulo">Familia</span><span class="DatosValor"><?php echo $Familia;?></span></li>
                         </ul>
                    </div>
                    
                    <?php     
                         if($Descripcion != ""){
                              echo "<h3> ";
                              echo "Descripción";
                              echo "</h3>";
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
                              
                         }
                              echo $Descripcion; 
                              echo "</div>";
                         }

                         
                         if($Habitat != ""){
                              echo "<h3> ";
                                 echo "Habitat";
                              echo "</h3>";
                                 echo "<div class=\"museo\">";
                            if($ImgHabitat > 0){
                                 $link = ConnBDCervera();
                                 $sql = "select * from Imagenes where idImagen = $ImgHabitat and Publicar = 1 ";
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
                                        echo "<a href=\"$Path/$Archivo\" title=\"$Titulo\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                                   }
                                   mysqli_free_result($result);
                                 mysqli_close($link);	
                            }
                                 echo '<p>' . $Habitat . '</p>'; 
                                 echo "</div>";
                            }

                    
                    ?>
               </div>


               <div class="content">
               <?php
               $sql = "select * from Imagenes where Ambito = 'Fauna' and idAmbito = $idFauna and Publicar = 1 ";
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
                                   echo"<a href='galeriafotografica.php?Ambito=Fauna&amp;idAmbito=$idFauna&amp;Origen=fauna-detalle.php&amp;Campo=idFauna' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
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