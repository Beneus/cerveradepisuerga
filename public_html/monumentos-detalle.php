<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idMonumento = $_GET["idMonumento"] ?? '';
$msnError = '';
 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "select M.*, NU.NombreNucleoUrbano from Monumentos as M inner join NucleosUrbanos NU on M.idNucleoUrbano = NU.idNucleoUrbano where idMonumento = $idMonumento";
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

	$Monumento = $row["Monumento"];
	$Direccion = $row["Direccion"];
	$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
	$idNucleoUrbano = $row["idNucleoUrbano"];
	$Telefono = $row["Telefono"];
	$Responsable = $row["Responsable"];   
	$URL = $row["URL"];
	$Email = $row["Email"];
	$Latitud = $row["Latitud"];
	$Longitud = $row["Longitud"];
	$FechaInauguracion = FechaDerecho($row["FechaInauguracion"]);
	$FechaClausura = FechaDerecho($row["FechaClausura"]);
	$Tipo = $row["Tipo"];
	$Tema = $row["Tema"] ?? '';
	$Horario = $row["Horario"];
	$ImgDescripcion = $row["ImgDescripcion"];
	$Descripcion = html_entity_decode($row["Descripcion"], ENT_QUOTES);
if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Monumentos&amp;idAmbito=$idMonumento&amp;Campo=idMonumento&amp;Att=Monumento\" title=\"Contacta con el responsable de $Monumento\">Contacta</a>";}

}else{
	// No hay entradas en el directorio
$msnError = "el Museo no está disponible, perdone las molestias.";
}
mysqli_free_result($result);
mysqli_close($link);

$MetaTitulo = $Monumento ." en " . $NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo .", direccion:" . $Direccion .", " . $Tema .", abierto: " .$Tipo .", Horario: " .$Horario.", Responsable: " .$Responsable;
$MetaKeywords = $Monumento .", " . $NombreNucleoUrbano .", " . $Direccion .", " . $Tema .", " . $Tipo .", " .$Horario .", " .$Tipo .", " .$Responsable;

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
               <h2><img src="iconos/monumentos.png" alt="Monumentos en la Montaña Palentina" title="Monumentos en la Montaña Palentina" width="32" height="32" class="iconosimagen" /> Monumentos</h2>
               <div class="MigasdePan">
               <a title="Qué ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt; 
               <a href="monumentos.php" title="Monumentos" >Monumentos</a> &gt; 
               <a href="monumentos-detalle.php?idMonumento=<?php echo $idMonumento; ?>" title="<?php echo $Monumento; ?>"><?php echo $Monumento; ?></a>
               </div>
               </div>
               <div class="content">
                    <?php
if($msnError == ""){  
?>
<h1><?php echo $Monumento;?></h1>
<div class="museo">
<ul>
<li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<?php if ($Horario  != ""){ ?>
<li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?php echo $Horario;?></span></li>
<?php }
if ($Telefono != ""){?>
<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
<?php } ?>
<li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?php echo $Tipo;?></span></li>
<?php if ($Responsable != ""){?>
<li><span class="DatosTitulo">Responsable</span><span class="DatosValor"><?php echo $Responsable;?></span></li>
<?php }
if (!is_null($FechaInauguracion)){?>
<li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?php echo $FechaInauguracion;?></span></li>
<?php }
if (!is_null($FechaClausura)){?>
<li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?php echo $FechaClausura;?></span></li>
<?php }
if ($Email!=""){?>
<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
<?php }
if ($URL!=""){?>
<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Museo;?>" target="_blank"><?php echo $URL;?></a></span></li>
<?php }?>
</ul>
</div>
<?php } ?>
               </div>
<div class="content">
<?php
   	if($Descripcion != ""){
		echo "<h3>Descripcion</h3>";
   		echo "<div class=\"museo\">";
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
				echo "<a href=\"$Path/$Archivo\"  class='lightbox' title='$Titulo'><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
				
			}
			mysqli_free_result($result);
			mysqli_close($link);	
			
   	}
   		echo $Descripcion; 
   		echo "</div>";
   		
   	}
   	
	// listado de documentos asociados
$sql = "select * from Documentos where Ambito = 'Monumentos' and idAmbito = $idMonumento and Publicar = 1 order by Orden";
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
	
			if($max > 0){
			echo "<h3>Documentos</h3>";
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
     ?>
     </div>
     <?php
// listado de imagenes asociadas
	
   		$sql = "select * from Imagenes where Ambito = 'Monumentos' and idAmbito = $idMonumento and Publicar = 1 ";
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
			echo"<a href='galeriafotografica.php?Ambito=Monumentos&amp;idAmbito=$idMonumento&amp;Origen=monumentos-detalle.php&amp;Campo=idMonumento' hreflang='es' title='Acceso a la galeria fotográfica'>";
			echo "<h3>galería fotográfica</h3>";
			echo "</a></div>";
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