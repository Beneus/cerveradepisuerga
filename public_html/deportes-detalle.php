<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idDeporte = $_GET["idDeporte"] ?? '';
$msnError = '';
 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "select DEP.*, NU.NombreNucleoUrbano from Deportes as DEP inner join NucleosUrbanos NU on DEP.idNucleoUrbano = NU.idNucleoUrbano where idDeporte = $idDeporte";
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

	$ActoDeportivo = $row["ActoDeportivo"];
	$idDeporte = $row["idDeporte"];
	$Lugar = $row["Lugar"];
	$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
	$idNucleoUrbano = $row["idNucleoUrbano"];
	$Telefono = $row["Telefono"];
	$Contacto = $row["Contacto"];   
	$Url = $row["Url"];
	$Email = $row["Email"];
	$Precio = $row["Precio"];
	$FechaInicio = FechaDerecho($row["FechaInicio"]);
	$FechaFinal = FechaDerecho($row["FechaFinal"]);
	if(!is_null($row["Hora"])){
	$Hora = date("H:i", strtotime($row["Hora"]));
	}else{
	$Hora = NULL;
	}
	$ImgDescripcion = $row["ImgDescripcion"];
	$Descripcion = html_entity_decode($row["Descripcion"], ENT_QUOTES);
	if($Email !=""){$Email = "<span><a href=\"mail.php?Ambito=Deportes&amp;idAmbito=$idDeporte&amp;Campo=idDeporte&amp;Att=Contacto\" title=\"Contacta con el responsable de $Museo\">Contacta</a></span>";}
}else{
	// No hay entradas en el directorio
$msnError = "No está disponible, perdone las molestias.";
}
mysqli_free_result($result);
mysqli_close($link);

$MetaTitulo = $ActoDeportivo ." en " . $NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo .", Lugar:" . $Lugar .", Hora: " .$Hora.", contacto: " .$Contacto;
$MetaKeywords = $ActoDeportivo .", " . $NombreNucleoUrbano .", " . $Lugar .", " .$Hora .", " .$Contacto;
$MetaDescripcion = GetDescription($MetaDescripcion  ,200);
$MetaKeywords = GenKeyWords($MetaKeywords,4);
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
                    <h2><img src="iconos/deportes.png" alt="Museos de la Monta�a Palentina" title="Museos de la Montaña Palentina" width="32" height="32"  class="iconosimagen"/> Deportes</h2>
                    <div class="MigasdePan">
                    <a title="Qu� ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt; 
                    <a href="deportes.php" title="Deportes en la Monta�a Palentina">Deportes</a> &gt; 
                    <a href="deportes-detalle.php?idDeporte=<?php echo $idDeporte; ?>" title="<?php echo $ActoDeportivo; ?>"><?php echo $ActoDeportivo; ?></a>
                    </div>
               </div>
               <div class="content">
               <?php
if($msnError == ""){  
?>
   <h3><?php echo $ActoDeportivo;?></h3>
<div class="museo">

<ul>
<li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?php echo $Lugar;?></span></li>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<?php
if (!is_null($Hora)){?>
<li><span class="DatosTitulo">Hora</span><span class="DatosValor"><?php echo $Hora;?></span></li>
<?php }
if ($Telefono!=""){?>
<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
<?php }
if (!is_null($FechaInicio)){?>
<li><span class="DatosTitulo">Fecha de inicio</span><span class="DatosValor"><?php echo $FechaInicio;?></span></li>
<?php
}
if (!is_null($FechaFinal)){?>
<li><span class="DatosTitulo">Fecha de finalizaci&oacute;n</span><span class="DatosValor"><?php echo $FechaFinal;?></span></li>
<?php
}
if ($Contacto!=""){?>
<li><span class="DatosTitulo">Contacto</span><span class="DatosValor"><?php echo $Contacto;?></span></li>
<?php }
if ($Email!=""){?>
<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
<?php }
if ($Url!=""){?>
<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $Url;?>" title="<?php echo $ActoDeportivo;?>, Enlace a ventana nueva" target="_blank"><?php echo $Url;?></a></span></li>
<?php }?>
</ul>
</div>

<?php
   	if($Descripcion != ""){
   		echo "<h3>Descripción</h3>";
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
				echo "<a href=\"$Path/$Archivo\"  title='$Titulo'><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
			}
			mysqli_free_result($result);
   	}
   		echo $Descripcion; 
   		echo "</div>";
   	}
   	
// listado de imagenes asociadas  	
   	$sql = "select * from Imagenes where Ambito = 'Deportes' and idAmbito = $idDeporte and Publicar = 1 ";
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
			echo"<a href='galeriafotografica.php?Ambito=Deportes&amp;idAmbito=$idDeporte&amp;Origen=deportes-detalle.php&amp;Campo=idDeporte' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "Galería fotográfica";
			echo "</a></h3>";
	   	}
	   	mysqli_free_result($result);
	   	
	   	
	   	
	   	// listado de documentos asociados
$sql = "select * from Documentos where Ambito = 'Deportes' and idAmbito = $idDeporte and Publicar = 1 order by Orden";
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
	   		echo "<div class='texto'><ul>";
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
			mysqli_close($link);	
   		?>
<br class="limpiar" />
<?php
}else{
	// No hay entradas en el directorio
echo "No hay museos registrados."
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