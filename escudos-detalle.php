<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idEscudo = $_GET["idEscudo"];

 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();

$sql = "SELECT ESC.* , NU.NombreNucleoUrbano FROM Escudos as ESC ";
$sql .= " left join NucleosUrbanos as NU on ESC.idNucleoUrbano = NU.idNucleoUrbano";
$sql .= " where idEscudo = $idEscudo ";

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

$idEscudo = $row["idEscudo"];
$Nombre = $row["Nombre"];
$Direccion = $row["Direccion"];   
$NombreNucleoUrbano = $row["NombreNucleoUrbano"]; 
$Descripcion = html_entity_decode($row["Descripcion"]);
$ImgDescripcion = $row["ImgDescripcion"];
}else{
	// No hay entradas en el directorio
$msnError = "El escudo no est&aacute; disponible, perdone las molestias.";
}
mysqli_free_result($result);



$MetaTitulo = "$Nombre, Cervera de Pisuerga, Palencia";
$MetaTitulo = substr($MetaTitulo,0,80);
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
                    <h2>Escudos</h2>
                    <div class="MigasdePan">
                    <a title="Qué ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt; 
                    <a href="escudos.php" title="Setas" >Escudos </a> &gt;
                    <a href="escudos-listado.php" title="Gu&iacute;a Micol&oacute;gica de la Montaña Palentina">Guia de labras her&aacute;ldicas</a>  &gt;
                    <a href="escudos-detalle.php?idEscudo=<?php echo $idEscudo; ?>" title="<?php echo $Nombre; ?>" ><?php echo $Nombre; ?></a>
                    </div>
               </div>
               <div class="content">
                    <?php
if($msnError == ""){  
?>
<h1>
	<?php echo $Nombre; ?>
	</h1>

<div class="museo">
<ul>
<?php if ($row["Direccion"] != ''){ ?>
     <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $row["Direccion"];?></span></li>
<?php } ?>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><?php echo $row["NombreNucleoUrbano"];?></span></li>
</ul>
</div>
<div class="museo">
<?php
if($row["ImgDescripcion"] > 0){
	$link = ConnBDCervera();
   		$sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
             mysqli_query($link,'SET NAMES utf8');   
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
				echo "<a href=\"$Path/$Archivo\"  title='$Nombre' ><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\"/></a>";
			}
			mysqli_free_result($resultImg);
   		 mysqli_close($link);
   		
   	}
  
?>



<?php
   	if(trim($Descripcion) != ""){
   		echo $Descripcion; 
        }
        ?>


</div>
        <?php
   		$sql = "select * from Imagenes where Ambito = 'Escudos' and IdAmbito = $idEscudo ";
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
	   	     echo "<h3'>";
			echo"<a href='galeriafotografica.php?Ambito=Escudos&amp;idAmbito=$idEscudo&amp;Origen=escudos-detalle.php&amp;Campo=idEscudo' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "Galería fotográfica";
			echo "</a></h3>";
	   	}
	   	mysqli_free_result($result);
			mysqli_close($link);	

}else{
	// No hay entradas en el directorio
?>
<div class="errortexto"><?php echo $msnError;?></div>
<?php
}
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