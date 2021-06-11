<?php
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$idSubServicio = '';
$NNU = '';

setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Donde comer y dormir en Cervera de Pisuerga y la Montaña Palentina";
$MetaDescripcion = "Donde comer y dormir en la Montaña Palentina, selecciona una opci�n: Parador, Hotel, Casa Rural, Centro de Turismo Rural, Hotel Rural, Hostal, Bar, Restaurante, Pub, Discoteca";
$MetaKeywords = "Montaña Palentina, CTR, CR, Parador, Hotel, Casa Rural, Centro de Turismo Rural, Hotel Rural, Hostal, Bar, Restaurante, Pub, Discoteca";
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
               <h1>Comer y dormir</h1>
               <div class="MigasdePan">
                    <a href="directorio.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
                    <a href="comer-dormir.php" title="donde comer y dormir en la Montaña Palentina">Comer y dormir</a>
               </div>
               <?php
               $link = ConnBDCervera();
               $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Directorio as D "
                    ." inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano "
                    ." inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio "
                    ." where DS.idServicio = 3 or DS.idServicio = 9 "
                    ." group by idNucleoUrbano order by NU.NombreNucleoUrbano ";  

               $accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
               echo "<label for=\"IDNUCLEOURBANO\">Localidad: ";
               echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
               echo "</label>";
               ?>
               </div>
               <div class="content">
               <?php

$link = ConnBDCervera();

$sql = "SELECT  DISTINCT D.idDirectorio, D.idNucleoUrbano, D.NombreComercial,D.Direccion, D.Telefono, D.Email, D.URL, D.ImgDescripcion, NU.NombreNucleoUrbano FROM Directorio as D "
			." inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio "
			." inner join DirectorioSubServicio as DSS on D.idDirectorio = DSS.idDirectorio "
			." inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano "
			." where DS.idServicio = 3";
if ($idNucleoUrbano != ""){
		$sql .= " and D.idNucleoUrbano = ". $idNucleoUrbano;
}
$sql .= " order by NU.NombreNucleoUrbano, NombreComercial ";

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
echo "<div class=\"museo\">\n";
echo "<h3>Donde comer en:</h3>\n";
echo "<ul>\n"; // lista de pueblos
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

	$idDirectorio = $row["idDirectorio"];
	$NombreComercial = $row["NombreComercial"];
	$Direccion = $row["Direccion"];
	$idNucleoUrbano = $row["idNucleoUrbano"];
	$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
	$idNucleoUrbano = $row["idNucleoUrbano"];
	$Telefono = $row["Telefono"];
	$URL = $row["URL"];
	$Email = $row["Email"];
	$idSubServicio = $row["idSubServicio"] ?? '';

	if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Directorio&amp;idAmbito=$idDirectorio&amp;Campo=idDirectorio&amp;Att=NombreComercial\" title=\"Contacta con el responsable de $NombreComercial\">Contacta</a>";}
	
	if (($NNU != $row["NombreNucleoUrbano"])and ($NNU=="")){ // primer pueblo
		echo "<li class=\"localidad\">"; // nombre del pueblo, uno por cada pueblo		
		echo $row["NombreNucleoUrbano"];
		$NNU = $row["NombreNucleoUrbano"];
		echo "<ul>\n"; // lista de negocios
	}elseif ($NNU != $row["NombreNucleoUrbano"]){ // resto de pueblos
		echo "</ul>\n"; // cierre de lista de negocios
		echo "</li>\n"; // cierre de lista de pueblo
		echo "<li class=\"localidad\">"; // nombre del pueblo, uno por cada pueblo		
		echo $row["NombreNucleoUrbano"];
		$NNU = $row["NombreNucleoUrbano"];
		echo "<ul>\n"; // lista de negocios
	}
		echo "<li class=\"negocio\">";
		echo "<div class=\"comerydormir\">";
			if($row["ImgDescripcion"] > 0){
				$sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
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
						
						echo "<a href=\"directorio-detalle.php?idDirectorio=".$row["idDirectorio"]."&amp;idServicio=3&amp;idSubServicio=" . $idSubServicio . "&amp;idNucleoUrbano=" . $idNucleoUrbano."\" class=\"strDirectorio\" title=\"Más informaci&oacute;n de $Titulo\"><img src=\"../".$Path."/".$Archivo."\" title=\"Más informaci&oacute;n de $Titulo\" alt=\"Más informaci&oacute;n de $Titulo\" /></a>";
					}
					mysqli_free_result($resultImg);	
			}
			
		echo IconosSubservicio($row["idDirectorio"],3) . "<br/><a href=\"directorio-detalle.php?idDirectorio=".$idDirectorio."&amp;idServicio=3&amp;idSubServicio=".$idSubServicio."\" class=\"TitNombreComercial\" title=\"Más informaci&oacute;n de ".$row["NombreComercial"]."\" > ".$row["NombreComercial"]."</a>";
		?>
        <ul>
            <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
            <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="Acceder a la informaci&oacute;n de <?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
            <?php if($Telefono != ""){ ?>
            <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
            <?php } if($Email != ""){ ?>
            <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
            <?php } if($URL != ""){ ?>
            <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $NombreComercial;?>" target="_blank"><?php echo $URL;?></a></span></li>
            <?php } ?>
            <li><a href="directorio-detalle.php?idDirectorio=<?php echo $row["idDirectorio"];?>&amp;idServicio=3" title="<?php echo $NombreComercial;?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
        </ul>	
<?php	
		echo "</div>"; // cierre de <div class=\"comerydormir\">
		echo "</li>"; // cierre de <li class=\"negocio\">
}
echo "</ul>\n"; // cierre de lista de negocios
echo "</li>\n"; // cierre de lista de pueblo
echo "</ul>";// cierre de la lista de pueblos
echo "</div>";// cierre de <div class=\"texto\">

}
mysqli_free_result($result);
mysqli_close($link);	

?>


</div>

<div class="content">
<?php



//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++ DORMIR ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();

$sql = "SELECT  DISTINCT D.idDirectorio, D.idNucleoUrbano, D.NombreComercial,D.Direccion, D.Telefono, D.Email, D.URL, D.ImgDescripcion, NU.NombreNucleoUrbano FROM Directorio as D "
			." inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio "
			." inner join DirectorioSubServicio as DSS on D.idDirectorio = DSS.idDirectorio "
			." inner join NucleosUrbanos as NU on D.idNucleoUrbano = NU.idNucleoUrbano "
			." where DS.idServicio = 9 ";

if ($idNucleoUrbano != ""){
		$sql .= " and D.idNucleoUrbano = ". $idNucleoUrbano;
}
$sql .= " order by NU.NombreNucleoUrbano, NombreComercial ";

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
$NC = "";
$NNU = "";
echo "<div class=\"museo\">";
echo "<h3>Donde dormir en:</h3>";
echo "<ul>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$idDirectorio = $row["idDirectorio"];
	$NombreComercial = $row["NombreComercial"];
	$Direccion = $row["Direccion"];
	$idNucleoUrbano = $row["idNucleoUrbano"];
	$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
	$idNucleoUrbano = $row["idNucleoUrbano"];
	$idSubservicio = $row["idSubservicio"] ?? '';
	$Telefono = $row["Telefono"];
	$URL = $row["URL"];
	$Email = $row["Email"];
	if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Directorio&amp;idAmbito=$idDirectorio&amp;Campo=idDirectorio&amp;Att=NombreComercial\" title=\"Contacta con el responsable de $NombreComercial\">Contacta</a>";}
	
	
	if (($NNU != $row["NombreNucleoUrbano"])and ($NNU=="")){ // primer pueblo
		echo "<li class=\"localidad\">"; // nombre del pueblo, uno por cada pueblo		
		echo $row["NombreNucleoUrbano"];
		$NNU = $row["NombreNucleoUrbano"];
		echo "<ul>\n"; // lista de negocios
	}elseif ($NNU != $row["NombreNucleoUrbano"]){ // resto de pueblos
		echo "</ul>\n"; // cierre de lista de negocios
		echo "</li>\n"; // cierre de lista de pueblo
		echo "<li class=\"localidad\">"; // nombre del pueblo, uno por cada pueblo		
		echo $row["NombreNucleoUrbano"];
		$NNU = $row["NombreNucleoUrbano"];
		echo "<ul>\n"; // lista de negocios
	}
	echo "<li class=\"negocio\">";
			echo "<div class=\"comerydormir\">";
						if($row["ImgDescripcion"] > 0){
							$sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
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
									echo "<a href=\"directorio-detalle.php?idDirectorio=".$row["idDirectorio"]."&amp;idServicio=9&amp;idSubServicio=".$idSubServicio."&amp;idNucleoUrbano=".$row["idNucleoUrbano"]."\" class=\"strDirectorio\"><img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" title=\"$Titulo\" alt=\"$Titulo\" style=\"float:right;padding-left:20px;padding-bottom:20px;\" /></a>";
								}
								mysqli_free_result($resultImg);	
						}
						
					echo IconosSubservicio($row["idDirectorio"],9)."<br/><a href=\"directorio-detalle.php?idDirectorio=".$idDirectorio."&amp;idServicio=3&amp;idSubServicio=".$idSubservicio."\" class=\"TitNombreComercial\" >".$row["NombreComercial"]."</a>";
					?>
            <ul>
                    <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
                    <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
                    <?php if($Telefono != ""){ ?>
                    <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
                    <?php } if($Email != ""){ ?>
                    <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
                    <?php } if($URL != ""){ ?>
                    <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $NombreComercial;?>" target="_blank"><?php echo $URL;?></a></span></li>
                    <?php } ?>
                    <li><a href="directorio-detalle.php?idDirectorio=<?php echo $row["idDirectorio"];?>&amp;idServicio=3" title="<?php echo $NombreComercial;?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
            </ul>		
<?php	
		echo "</div>"; // cierre de <div class=\"comerydormir\">
		echo "</li>"; // cierre de <li class=\"negocio\">
}
echo "</ul>\n"; // cierre de lista de negocios
echo "</li>\n"; // cierre de lista de pueblo
echo "</ul>";// cierre de la lista de pueblos
echo "</div>";// cierre de <div class=\"texto\">
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
<script type="text/javascript">
<!--
	function SeleccionNucleoUrbano(x){
			location.href = "comer-dormir.php?idNucleoUrbano="+x.value;	
		}
//-->
</script>
</body>
</html>