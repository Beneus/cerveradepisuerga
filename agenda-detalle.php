<?php
include("includes/Conn.php");
include("includes/funciones.php");


$Descripcion = '';
$NombreNucleoUrbano = '';
$Email = '';
$URL = '';

if(isset($_GET["idAgenda"])){
$idAgenda = $_GET["idAgenda"] ?? '';
$link = ConnBDCervera(); 
mysqli_query($link,'SET NAMES utf8');
	$sql = "SELECT AG.*, NU.NombreNucleoUrbano,IM.Path as ImgPath, IM.Archivo as ImgArchivo, "
		. " IM.AnchoThumb, IM.AltoThumb, DOC.Path as DocPath, DOC.Archivo as DocArchivo FROM Agenda as AG "
        . " left JOIN NucleosUrbanos as NU ON AG.idNucleoUrbano = NU.idNucleoUrbano "
        . " left join Imagenes as IM on AG. ImgAgenda = IM.idImagen"
        . " left join Documentos as DOC on AG.DocAgenda = DOC.idDoc"
        . " WHERE idAgenda = $idAgenda "; 

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
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$Evento = $row["Evento"];
				if(!is_null($row["HoraEvento"])){
					$HoraEvento = date("H:i",strtotime($row["HoraEvento"]));
				}
				if(!is_null($row["FechaEvento"])){
                         $FechaEvento = strftime("%A %d %B %Y",strtotime($row["FechaEvento"]));
      
				}
				$idAgenda = $row["idAgenda"];
				$ImgAgenda = $row["ImgAgenda"];
				$DocAgenda = $row["DocAgenda"];
				if ($ImgAgenda>0){
					$ImgPath = $row["ImgPath"];
					$ImgArchivo = $row["ImgArchivo"];
					$AnchoThumb = $row["AnchoThumb"];
					$AnchoThumb = $row["AnchoThumb"];
				}
				if(($row["Lugar"])!="") $Lugar = $row["Lugar"];
				if(($row["NombreNucleoUrbano"])!="") $NombreNucleoUrbano = $row["NombreNucleoUrbano"];
				if($row["Email"] !=""){$Email = "<a href=\"mail.php?Ambito=Agenda&amp;idAmbito=$idAgenda&amp;Campo=idAgenda&amp;Att=Evento\" title=\"Contacta con el responsable de $Evento\">Contacta</a>";}
				if(($row["URL"])!="")$URL =  $row["URL"];
				if(($row["Telefono"])!="")$Telefono = MostrarTelefono($row["Telefono"]);
				if(($row["Contacto"])!="")$Contacto = $row["Contacto"];
				if($DocAgenda > 0){
					$DocArchivo = $row["DocArchivo"];
					$DocPath = $row["DocPath"];
				}
				if(($row["Descripcion"])!="")$Descripcion = html_entity_decode($row["Descripcion"]);
		}		

	}
	mysqli_free_result($result);
	mysqli_close($link);	
}

		
$MetaTitulo = $Evento . ", " .$NombreNucleoUrbano  . ", " . $FechaEvento;
$MetaDescripcion = $MetaTitulo . ", hora: " . $HoraEvento . ", " . $Lugar . ", " . $NombreNucleoUrbano . ", " . $Telefono . ", " . $Contacto;
$MetaDescripcion = GetDescription($MetaDescripcion,200);
$MetaKeywords =  GenKeyWords($MetaDescripcion,3);


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
               <h1><?php echo $Evento; ?></h1>
               <div class="MigasdePan"><a title="Agenda" href="agenda.php">Agenda</a></div>
               <ul>
                    <?php if($HoraEvento != "") { ?> <li><span class="DatosTitulo">Hora</span><span class="DatosValor"><?php echo $HoraEvento;?></span></li> <?php } ?>
                    <?php if($FechaEvento != "") { ?> <li><span class="DatosTitulo">Fecha</span><span class="DatosValor"><?php echo $FechaEvento;?></span></li> <?php } ?>
                    <?php if($Lugar != "") { ?> <li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?php echo $Lugar;?></span></li> <?php } ?>
                    <?php if($NombreNucleoUrbano != "") { ?> <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><?php echo $NombreNucleoUrbano;?></span></li> <?php } ?>
                    <?php if($Email != "") { ?> <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li> <?php } ?>
                    <?php if($URL != "") { ?> <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Evento; ?>"><?php echo $Evento;?></a></span></li> <?php } ?>
                    <?php if($Telefono != "") { ?> <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo $Telefono;?></span></li> <?php } ?>
                    <?php if($Contacto != "") { ?> <li><span class="DatosTitulo">Contacto</span><span class="DatosValor"><?php echo $Contacto;?></span></li> <?php } ?>
               </ul>
               </div>
               <?php if($Descripcion != "") { ?>
               <div class="content">
                    <?php echo $Descripcion;?>
               </div>
               <?php } ?>



<div class="content">

<?php
// listado de documentos asociados
$sql = "select * from Documentos where Ambito = 'Agenda' and idAmbito = $idAgenda and Publicar = 1 order by Orden";
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

// listado de imagenes asociadas
$sql = "select * from Imagenes where Ambito = 'Agenda' and idAmbito = $idAgenda and Publicar = 1 order by Orden";
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
	   		echo "<div class='texto'>";
			echo"<a href='galeriafotografica.php?Ambito=Agenda&amp;idAmbito=$idAgenda&amp;Origen=agenda-detalle.php&amp;Campo=idAgenda' accesskey=\"K\"  hreflang='es' title='Acceso a la galeria fotogr�fica, tecla K'>";
			echo "<h3>Galería fotográfica</h3>";
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
              
     </body>
    
</html>