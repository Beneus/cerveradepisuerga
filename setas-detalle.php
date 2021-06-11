<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idSetas = $_GET["idSetas"] ?? '';
$msnError = '';
 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT S.*, SS.SubOrden FROM Setas as S ";
$sql .= " left join SetasSubOrden as SS on S.idSetasSubOrden = SS.idSetasSubOrden";
$sql .= " where S.idSetas = $idSetas ";
$sql .= " order by S.NombreComun ";

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

$idSetas = $row["idSetas"];
$NombreComun = $row["NombreComun"];
$NombreCientifico = $row["NombreCientifico"];
$Autor = $row["Autor"];   
$Clase = $row["Clase"]; 
$Clasificacion = $row["Clasificacion"]; 
$Sombrero = html_entity_decode($row["Sombrero"]);
$PieSeta = html_entity_decode($row["Pie"]);
$Cuerpo = html_entity_decode($row["Cuerpo"], ENT_QUOTES);
$Laminas = html_entity_decode($row["Laminas"], ENT_QUOTES);
$Himenio = html_entity_decode($row["Himenio"], ENT_QUOTES);
$Exporada = html_entity_decode($row["Exporada"], ENT_QUOTES);
$Carne = html_entity_decode($row["Carne"], ENT_QUOTES);
$EpocaHabitat = html_entity_decode($row["EpocaHabitat"], ENT_QUOTES);
$Comestibilidad = html_entity_decode($row["Comestibilidad"], ENT_QUOTES);
$Comentarios = html_entity_decode($row["Comentarios"], ENT_QUOTES);
$ImgSetas = $row["ImgSetas"];

switch ($row["Clasificacion"]){
	case "Mortal" : $ImagenSeta = "setas-mortal.gif"; break;
	case "Venenosa" : $ImagenSeta = "setas-venenosa.gif";break;
	case "Sin valor culinario" : $ImagenSeta = "setas-sin-valor-culinario.gif";break;
	case "Buena" : $ImagenSeta = "setas-buena.gif";break;
	case "Excelente" : $ImagenSeta = "setas-excelente.gif";break;
	case "Sin clasificar" : $ImagenSeta = "setas-sin-clasificar.gif";break;
}
$Clasificacion = "<img src='images/$ImagenSeta' title='".$row["Clasificacion"]."' alt='".$row["Clasificacion"]."' width='16px' height='16px' class=\"iconosimagen\"/>".$row["Clasificacion"];
}else{
	// No hay entradas en el directorio
$msnError = "La Seta no est&aacute; disponible, perdone las molestias.";
}
mysqli_free_result($result);


if ($NombreComun != "S/N"){
	$MetaTitulo = "Setas de la Montaña Palentina: $NombreComun $NombreCientifico $Autor";
}else{
	$MetaTitulo = "Setas de la Montaña Palentina: $NombreCientifico $Autor";
}
$MetaTitulo = substr($MetaTitulo,0,80);
$MetaDescripcion = GetDescription($MetaTitulo . " " . $Comentarios  ,200);
$MetaKeywords = GenKeyWords($MetaTitulo . " " . $Comentarios,4);

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
               <h2>Setas</h2>
               <div class="MigasdePan">
               <a title="Qué ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt; 
               <a href="setas.php" title="Setas" >Setas</a> &gt;
               <a href="setas-listado.php" title="Gu&iacute;a Micol&oacute;gica de la Monta�a Palentina">Guia Micol&oacute;gica</a>  &gt;
                    <?php if ( $NombreComun != "S/N"){ ?>
                         <a href="setas-detalle.php?idSetas=<?php echo $idSetas; ?>" title="<?php echo $NombreComun; ?>" ><?php echo $NombreComun; ?></a>
                    <?php	} 
                    else{?>
                         <a href="setas-detalle.php?idSetas=<?php echo $idSetas; ?>" title="<?php echo $NombreCientifico; ?>" ><?php echo $NombreCientifico; ?></a>
                    <?php	 }	?>
               </div>
               </div>
               <div class="content">
               <?php
                    if($msnError == ""){  
                    ?>
                    <h3>
                         <?php if ( $NombreComun != "S/N"){ 
                              echo $NombreComun;}
                         else{
                              echo $NombreCientifico;
                         }
                         ?>
                         </h3>

                    <div class="museo">
                    <?php
                    if($row["ImgSetas"] > 0){
                         $link = ConnBDCervera();
                              $sqlImg = "select * from Imagenes where idImagen = ". $row["ImgSetas"]. " and Publicar = 1 ";
                              $resultImg = mysqli_query($link,$sqlImg);
                                   if (!$resultImg){
                                        $message = "Invalid query".mysqli_error($link)."\n";
                                        $message .= "whole query: " .$sqlImg;	
                                        die($message);
                                        exit;
                                   }
                                   $maxImg = mysqli_num_rows($resultImg);	
                                   if($maxImg > 0){
                                        $rowImg = mysqli_fetch_array($resultImg, MYSQLI_ASSOC);
                                        $Path = $rowImg["Path"];
                                        $Archivo = $rowImg["Archivo"];
                                        $Titulo = $rowImg["Titulo"];
                                        $Pie = $rowImg["Pie"]; 
                                        $Ancho = $rowImg["Ancho"];
                                        $Alto = $rowImg["Alto"];
                                        $AnchoThumb = $rowImg["AnchoThumb"];
                                        $AltoThumb = $rowImg["AltoThumb"];
                                        echo "<p><a href=\"$Path/$Archivo\" title='$NombreComun ($NombreCientifico)' ><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a></p>";
                                   }
                                   mysqli_free_result($resultImg);
                              
                              mysqli_close($link);
                    }
                    
                    ?>
                    <ul>
                    <?php if ( $NombreComun != "S/N"){ ?>
                    <li><span class="DatosTitulo">Nombre común</span><span class="DatosValor"><?php echo $NombreComun;?></span></li>
                    <?php } ?>
                    <li><span class="DatosTitulo">Nombre cientifico</span><span class="DatosValor"><?php echo $NombreCientifico;?></span></li>
                    <li><span class="DatosTitulo">Autor</span><span class="DatosValor"><?php echo $Autor;?></span></li>
                    <li><span class="DatosTitulo">Clase</span><span class="DatosValor"><?php echo $Clase;?></span></li>
                    <li><span class="DatosTitulo">Sub clase</span><span class="DatosValor"><?php echo $SubOrden;?></span></li>
                    <li><span class="DatosTitulo">Clasificación</span><span class="DatosValor"><?php echo $Clasificacion;?></span></li>
                    </ul>

                    <?php
   	if(trim($Sombrero) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/sombrero.png\" width=\"280\" height=\"50\" alt=\"Sombrero\" title=\"Sombrero\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Sombrero; 
   		echo "</div>";
   	}
   	if(trim($PieSeta) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/pie.png\" width=\"280\" height=\"50\" alt=\"Pie\" title=\"Pie\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $PieSeta; 
   		echo "</div>";
   	}
	if(trim($Cuerpo) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/cuerpo.png\" width=\"280\" height=\"50\" alt=\"Cuerpo\" title=\"Cuerpo\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Cuerpo; 
   		echo "</div>";
   	}
   	if(trim($Laminas) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/laminas.png\" width=\"280\" height=\"50\" alt=\"Laminas\" title=\"Laminas\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Laminas; 
   		echo "</div>";
   	}
   	if(trim($Himenio) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/himenio.png\" width=\"280\" height=\"50\" alt=\"Himenio\" title=\"Himenio\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Himenio; 
   		echo "</div>";
   	}
   	if(trim($Exporada) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/exporada.png\" width=\"280\" height=\"50\" alt=\"Exporada\" title=\"Exporada\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Exporada; 
   		echo "</div>";
   	}
   	if(trim($Carne) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/carne.png\" width=\"280\" height=\"50\" alt=\"Carne\" title=\"Carne\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Carne; 
   		echo "</div>";
   	}
   	if(trim($EpocaHabitat) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/epocahabitat.png\" width=\"280\" height=\"50\" alt=\"Epoca y habitat\" title=\"Epoca y habitat\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $EpocaHabitat; 
   		echo "</div>";
   	}
   	if(trim($Comestibilidad) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/comestibilidad.png\" width=\"280\" height=\"50\" alt=\"Comestibilidad\" title=\"Comestibilidad\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Comestibilidad; 
   		echo "</div>";
   	}
   	if(trim($Comentarios) != ""){
		echo "<div class=\"etiqueta\"> ";
   		echo "<img src=\"images/comentarios.png\" width=\"280\" height=\"50\" alt=\"Comentarios\" title=\"Comentarios\" name=\"etiqueta\"/>";
		echo "</div>";
   		echo "<div class=\"texto\">";
   		echo $Comentarios; 
   		echo "</div>";
        }
        ?>
                    </div>
                    <?php
                    }
                    ?>
               </div>
          
               <?php
          $sql = "select * from Imagenes where Ambito = 'Setas' and IdAmbito = $idSetas ";
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

			echo"<div class=\"content\"><h3><a href='galeriafotografica.php?Ambito=Setas&amp;idAmbito=$idSetas&amp;Origen=setas-detalle.php&amp;Campo=idSetas' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "galería fotográfica";
			echo "</a></h3></div>";
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