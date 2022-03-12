<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idFlora = $_GET["idFlora"];

 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT * FROM Flora where idFlora = $idFlora";

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
$ImgHabitat = $row["ImgHabitat"];
$ImgUsos = $row["ImgUsos"];

}else{
	// No hay entradas en el directorio
$msnError = "La Flora no está disponible, perdone las molestias.";
}
mysqli_free_result($result);
mysqli_close($link);

$tabla = get_html_translation_table(HTML_ENTITIES);
$codificada = strtr($Descripcion, $tabla);
//echo $codificada;

$MetaTitulo = "Flora en la Montaña Palentina: $NombreComun $NombreCientifico $Familia";
$MetaDescripcion = GetDescription($MetaTitulo . " " . $Descripcion  ,200);
$MetaKeywords = GenKeyWords($MetaTitulo . " " . $Descripcion,4);

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
               <h2>Flora</h2>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos" >Qué ofrecemos</a> &gt; 
               <a href="flora.php" title="Flora" >Flora</a> &gt; 
               <a href="flora-detalle.php?idFlora=<?php echo $idFlora; ?>" title="<?php echo $NombreComun; ?>" ><?php echo $NombreComun; ?></a>
               </div>
               </div>
               <?php
                    if($msnError == ""){  
  
                         ?>
               <div class="content">
                    <h1><?php echo $NombreComun;?></h1>     
                    <div class="museo">
                         <ul>
                         <li><span class="DatosTitulo">Nombre común</span><span class="DatosValor"><?php echo $NombreComun;?></span></li>
                         <li><span class="DatosTitulo">Nombre cientifico</span><span class="DatosValor"><?php echo $NombreCientifico;?></span></li>
                         <li><span class="DatosTitulo">Familia</span><span class="DatosValor"><?php echo $Familia;?></span></li>
                         </ul>
                    </div>
               </div>
               
                      
               <?php

                    if($Descripcion != ""){
                         ?>
                         <div class="content">
                              <h3>Descripción</h3>
                              <div class="museo">
                         <?php
                    if($ImgDescripcion > 0){
                         $link = ConnBDCervera();
                         $sql = "select * from Imagenes where idImagen = $ImgDescripcion and Publicar = 1 ";
                         mysqli_query($link,'SET NAMES utf8');
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
                              echo "<a href=\"$Path/$Archivo\" title=\"$Titulo\"><img src=\"../files/".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                         }
                         mysqli_free_result($result);
                         mysqli_close($link);	
                         
                    }
                         ?>
                         <p><?=$Descripcion?></p> 
                         </div>
                    </div>
                         <?php
                    }


    
                  }
  


               if($Habitat != ""){
                    ?>
                    <div class="content">
                         <h3>Habitat</h3>
                         <div class="museo">
                    <?php
                    if($ImgHabitat > 0){
                         $link = ConnBDCervera();
                         $sql = "select * from Imagenes where idImagen = $ImgHabitat and Publicar = 1 ";
                         mysqli_query($link,'SET NAMES utf8');
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
                                   echo "<a href=\"$Path/$Archivo\"  title=\"$Titulo\"><img src=\"../files/".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                              }
                              mysqli_free_result($result);
                         mysqli_close($link);	
                         
                    }
                         ?>
                         <p><?=$Habitat?></p> 
                         </div>
                    </div>
                         <?php
                    }



                    
                    if($Usos != ""){
                         ?>
                    <div class="content">
                         <h3>Usos</h3>
                         <div class="museo">
                    <?php
                    if($ImgUsos > 0){
                         $link = ConnBDCervera();
                         $sql = "select * from Imagenes where idImagen = $ImgUsos and Publicar = 1 ";
                         mysqli_query($link,'SET NAMES utf8');
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
                                   echo "<a href=\"$Path/$Archivo\" title=\"$Titulo\"><img src=\"../files/".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                              }
                              mysqli_free_result($result);
                         mysqli_close($link);	
                         
                    }
                         ?>
                         <p><?=$Usos?></p> 
                         </div>
                    </div>
                         <?php
                    }

                    $sql = "select * from Imagenes where Ambito = 'Flora' and IdAmbito = $idFlora ";
                    $link = ConnBDCervera();
                    mysqli_query($link,'SET NAMES utf8');
                    $result = mysqli_query($link,$sql);
                      if (!$result){
                           $message = "Invalid query".mysqli_error($link)."\n";
                           $message .= "whole query: " .$sql;	
                           die($message);
                           exit;
                      }
                      
                      $max = mysqli_num_rows($result);	
            
                      if($max > 1){
                    echo "<div class='content'>";
                      echo"<h3><a href='galeriafotografica.php?Ambito=Flora&amp;idAmbito=$idFlora&amp;Origen=flora-detalle.php&amp;Campo=idFlora' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
                      echo "Galería fotográfica";
                      echo "</a></h3></div>";
                    }
                    mysqli_free_result($result);
                      mysqli_close($link);	




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