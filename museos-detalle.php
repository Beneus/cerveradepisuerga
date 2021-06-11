<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idMuseo = $_GET["idMuseo"] ?? '';
$msnError = '';
 //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "select M.*, NU.NombreNucleoUrbano from Museos as M inner join NucleosUrbanos NU on M.idNucleoUrbano = NU.idNucleoUrbano where idMuseo = $idMuseo";
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

	$Museo = $row["Museo"];
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
	if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Museos&amp;idAmbito=$idMuseo&amp;Campo=idMuseo&amp;Att=Museo\" title=\"Contacta con el responsable de $Museo\">Contacta</a>";}
}else{
	// No hay entradas en el directorio
$msnError = "el Museo no está disponible, perdone las molestias.";
}
mysqli_free_result($result);
mysqli_close($link);

$MetaTitulo = $Museo ." en " . $NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo .", direccion:" . $Direccion .", " . $Tema .", abierto: " .$Tipo .", Horario: " .$Horario.", Responsable: " .$Responsable;
$MetaKeywords = $Museo .", " . $NombreNucleoUrbano .", " . $Direccion .", " . $Tema .", " . $Tipo .", " .$Horario .", " .$Tipo .", " .$Responsable;
?>
<!DOCTYPE html>
<html>
     <head>
<?php
include('./head.php');
?>        

<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
<script type="text/javascript">
<!--
html = '<div style="width:210px; padding-right:10px;text-align: left;"><img src="iconos/museos.png" alt="Museos de la Monta�a Palentina" width="32" height="32" hspace="10" />'+
        '<strong><?php echo $Museo; ?></strong><br/><?php echo $Tema; ?></div>';
var Latitud = "<?php echo $Latitud; ?>";
var Longitud = "<?php echo $Longitud; ?>";
//-->
</script>
<script src="js/googlemapsmuseo.js" type="text/javascript"></script>
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
               <h2><img src="iconos/museos.png" alt="Museos de la Montaña Palentina" title="Museos de la Montaña Palentina" width="32" height="32"  class="iconosimagen"/>  Museos</h2>
               <div class="MigasdePan">
                    <a title="Qu´2 ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt; 
                    <a href="museos.php" title="Museos">Museos</a> &gt; 
                    <a href="museos-detalle.php?idMuseo=<?php echo $idMuseo; ?>" title="<?php echo $Museo; ?>"><?php echo $Museo; ?></a>
               </div>
               </div>
               <div class="content">
               <?php
if($msnError == ""){  
?>
   <h1><?php echo $Museo;?></h1>
<div class="museo">

<ul>
<?php if ($Tipo == "TEMPORAL"){?>
<li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?php echo $Tema;?></span></li>
<?php
}else
{?>
<li><span class="DatosTitulo">Tema</span><span class="DatosValor"><?php echo $Tema;?></span></li>
<?php
}?>
<?php if ($Direccion != ""){ ?>
<li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
<?php } ?>
<?php if ($idNucleoUrbano != ""){ ?>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<?php } ?>
<?php if ($Horario != ""){ ?>
<li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?php echo $Horario;?></span></li>
<?php } ?>
<?php if ($Telefono != ""){ ?>
<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
<?php } ?>
<?php if ($Tipo != ""){ ?>
<li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?php echo $Tipo;?></span></li>
<?php } ?>
<?php if (!is_null($FechaInauguracion)){?>
<li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?php echo $FechaInauguracion;?></span></li>
<?php
}
if (!is_null($FechaClausura)){?>
<li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?php echo $FechaClausura;?></span></li>
<?php
}
if ($Email!=""){?>
<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
<?php }
if ($URL!=""){?>
<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Museo;?>" target="_blank"><?php echo $URL;?></a></span></li>
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
				echo "<a href=\"$Path/$Archivo\" title='$Titulo'><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\"/></a>";
			}
			mysqli_free_result($result);
   	}
   		echo $Descripcion; 
   		echo "<br class=\"limpiar\" />";
   		echo "</div>";
   	}
   		$sql = "select * from Imagenes where Ambito = 'Museos' and idAmbito = $idMuseo and Publicar = 1 ";
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
	   		echo "<div class='content'>";
			echo"<a href='galeriafotografica.php?Ambito=Museos&amp;idAmbito=$idMuseo&amp;Origen=museos-detalle.php&amp;Campo=idMuseo' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "<h3>Galería fotográfica</h3>";
			echo "</a></div>";
	   	}
	   	mysqli_free_result($result);
			mysqli_close($link);	
   		?>
<div class="texto"><div id="mapa" style="width: 100%; height: 300px" ></div>
</div>
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