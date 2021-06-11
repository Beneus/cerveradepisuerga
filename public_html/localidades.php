<?php
include("includes/Conn.php");
include("includes/funciones.php");


function UrlLocalidad($idN){

	switch ($idN){
		case "2":  $href="localidades.php?idNucleoUrbano=2&amp;idArea=2";break;
		case "6":  $href="localidades.php?idNucleoUrbano=6&amp;idArea=2";break;
		case "5":  $href="localidades.php?idNucleoUrbano=5&amp;idArea=2";break;
		case "4":  $href="localidades.php?idNucleoUrbano=4&amp;idArea=2";break;
		case "7":  $href="localidades.php?idNucleoUrbano=7&amp;idArea=2";break;
		case "3":  $href="localidades.php?idNucleoUrbano=3&amp;idArea=2";break;
		case "16": $href="localidades.php?idNucleoUrbano=16&amp;idArea=5";break;
		case "17": $href="localidades.php?idNucleoUrbano=17&amp;idArea=5";break;
		case "8":  $href="localidades.php?idNucleoUrbano=8&amp;idArea=3";break; 
		case "9":  $href="localidades.php?idNucleoUrbano=9&amp;idArea=3";break; 
		case "10": $href="localidades.php?idNucleoUrbano=10&amp;idArea=3";break;
		case "11": $href="localidades.php?idNucleoUrbano=11&amp;idArea=3";break;
		case "12": $href="localidades.php?idNucleoUrbano=12&amp;idArea=3";break;
		case "14": $href="localidades.php?idNucleoUrbano=14&amp;idArea=4";break;
		case "15": $href="localidades.php?idNucleoUrbano=15&amp;idArea=4";break;
		case "13": $href="localidades.php?idNucleoUrbano=13&amp;idArea=4";break;
		case "20": $href="localidades.php?idNucleoUrbano=20&amp;idArea=7";break;
		case "21": $href="localidades.php?idNucleoUrbano=21&amp;idArea=7";break;
		case "23": $href="localidades.php?idNucleoUrbano=23&amp;idArea=7";break;
		case "22": $href="localidades.php?idNucleoUrbano=22&amp;idArea=7";break;
		case "24": $href="localidades.php?idNucleoUrbano=24&amp;idArea=7";break;  
		case "18": $href="localidades.php?idNucleoUrbano=18&amp;idArea=6";break;
		case "19": $href="localidades.php?idNucleoUrbano=19&amp;idArea=6";break;
		case "1":  $href="localidades.php?idNucleoUrbano=1&amp;idArea=1";break;
	}
	return $href;

}

function UrlArea($idA){

	switch ($idA){
		case "2":  $href="valle-estrecho.php";break;
		case "6":  $href="ojeda.php";break;
		case "5":  $href="pantano-requejada.php";break;
		case "4":  $href="valsadornin.php";break;
		case "7":  $href="pisuerga.php";break;
		case "3":  $href="valle-castilleria.php";break;
		case "1":  $href="cervera-pisuerga.php";break;
	}
	return $href;
}

function UrlAreaCSS($idA){

	switch ($idA){
		case "2":  $href="valle-estrecho.css";break;
		case "6":  $href="ojeda.css";break;
		case "5":  $href="pantano-requejada.css";break;
		case "4":  $href="valsadornin.css";break;
		case "7":  $href="pisuerga.css";break;
		case "3":  $href="valle-castilleria.css";break;
		case "1":  $href="cervera-pisuerga.css";break;
	}
	return $href;
}

// datos de entrada
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$idArea = $_GET["idArea"] ?? '';
$link = ConnBDCervera();

$sql = " SELECT NucleosUrbanos. * , Areas.NombreArea FROM NucleosUrbanos "
			." INNER JOIN Areas ON NucleosUrbanos.idArea = Areas.idArea WHERE idNucleoUrbano = $idNucleoUrbano";

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
$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
$NombreArea = $row["NombreArea"];
$idArea = $row["idArea"];
$CodigoPostal = $row["CodigoPostal"]; 
$Altitud = $row["Altitud"];
$Latitud = $row["Latitud"];
$Longitud = $row["Longitud"];
$GoogleMaps = $row["GoogleMaps"];
$Descripcion = html_entity_decode($row["Descripcion"]);
$Historia = html_entity_decode($row["Historia"]);
$ImgDescripcion = $row["ImgDescripcion"];
$ImgHistoria = $row["ImgHistoria"];

}else{
header("Location:localidades-listado.php");
exit;

}
mysqli_free_result($result);
mysqli_close($link);	

$MetaTitulo = "$NombreNucleoUrbano ($NombreArea, Palencia)";
$MetaDescripcion = GetDescription($NombreNucleoUrbano . " " . $NombreArea . ": " . $Descripcion  ,200);
$MetaKeywords = GenKeyWords($MetaTitulo . " " . $MetaDescripcion,4);
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
			   <h1><?php echo $NombreNucleoUrbano; ?></h1>
               		<div class="MigasdePan">
					   <a href="area-municipal.php" title="Localidades">Localidades</a> &gt; 
					   <a href="<?php echo UrlArea($idArea); ?>" title="<?php echo $NombreArea; ?>"><?php echo $NombreArea; ?></a> &gt;
					   <a href="<?php echo UrlLocalidad($idNucleoUrbano); ?>" title="<?php echo $NombreNucleoUrbano; ?>"><?php echo $NombreNucleoUrbano; ?></a>
                    </div>
			   </div>
               <div class="content">

			
					<?php
   	if($Descripcion != ""){
		echo "<div class=\"etiqueta\"> ";
		echo "<img src=\"images/descripcion.png\" width=\"280\" height=\"50\" name=\"etiqueta\"/>";
		echo "</div>";
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
				echo "<a href='$Path/$Archivo'  class='lightbox' title='$Titulo'><img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" /></a>";
			}
			mysqli_free_result($result);
			mysqli_close($link);	
   		
   		
   	}
   		echo $Descripcion; 
   		echo "</div>";
	   }
	   
   	if($Historia != ""){
		
   		echo "<div class=\"museo\">";
   	if($ImgHistoria > 0){
   		$link = ConnBDCervera();
   		$sql = "select * from Imagenes where idImagen = $ImgHistoria and Publicar = 1 ";
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
				
				echo "<a href='$Path/$Archivo'  class='lightbox' title='$Titulo'><img Src=\"$Path/$Archivo\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:left;padding-right:20px;padding-bottom:20px;\" /></a>";
			}
			mysqli_free_result($result);
			mysqli_close($link);	
   	}
   	echo $Historia;
   	echo "</div>";
  }


  //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Subservicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

	$sqlSS = "SELECT DISTINCT SE. idServicio, SE.NombreServicio ,DSB.idSubServicio,S.NombreSubServicio, S.icono FROM DirectorioSubServicio AS DSB \n"
    . "INNER JOIN SubServicios AS S ON DSB.idSubServicio = S. idSubServicio \n"
    . "INNER JOIN Servicios AS SE ON S.idServicio = SE. idServicio \n"
    . "INNER JOIN Directorio AS D ON DSB.idDirectorio = D. idDirectorio \n"
    . "WHERE D.idNucleoUrbano = $idNucleoUrbano \n"
    . "ORDER BY SE.idServicio, NombreSubServicio ";			

	$link = ConnBDCervera();

			$resultSS = mysqli_query($link,$sqlSS);
			if (!$resultSS)
				{
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sqlSS;	
				die($message);
				exit;
				}
			$max = mysqli_num_rows($resultSS);	
			if($max > 0){  
			echo "<img src=\"images/servicios.png\" width=\"280\" height=\"50\" alt=\"Servicios\" />";
			echo "<div class=\"museo\">";
			$clasefila = "filagris";
				$ServicioAux = $rowSS["idServicio"] ?? '';
				while ($rowSS = mysqli_fetch_array($resultSS, MYSQLI_ASSOC)) {
					
					if(($rowSS["idServicio"] != $ServicioAux)and ($rowSS["icono"]!="")){
						$ServicioAux = $rowSS["idServicio"];
						echo "<br/>";
					}
					if ($rowSS["icono"] !=""){
					echo "<span><a href='directorio-listado.php?idServicio=".$rowSS["idServicio"]."&amp;idSubServicio=".$rowSS["idSubServicio"]."&amp;idNucleoUrbano=$idNucleoUrbano' title='".$rowSS["NombreServicio"] ." ".$rowSS["NombreSubServicio"] ."'><img src='iconos/".$rowSS["icono"]."'  alt='".$rowSS["NombreSubServicio"] ."' /></a></span>";
				}
				}
			echo "</div>";
			}
			mysqli_free_result($resultSS);
	

			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// listado de documentos asociados +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	
$sql = "select * from Documentos where Ambito = 'NucleosUrbanos' and idAmbito = $idNucleoUrbano and Publicar = 1 order by Orden";

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
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Galería fotografica +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

?>
<?php
$sql = "select * from Imagenes where Ambito = 'NucleosUrbanos' and idAmbito = $idNucleoUrbano ";
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
 echo"<a href='galeriafotografica.php?Ambito=NucleosUrbanos&amp;idAmbito=$idNucleoUrbano&amp;Origen=localidades.php&amp;Campo=idNucleoUrbano' accesskey='K'>";
 echo "<img src='images/galeriafotografica.png' name='etiqueta' alt='Galería fotográfica' title='Galería fotográfica, tecla K' width='280' height='50'  />";
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