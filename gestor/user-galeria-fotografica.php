<?php

session_start();
include("includes/variables-user.php");
include("includes/funciones.php");
include("includes/Conn.php");
// datos de la entrada del directorio

$Ambito = $_GET["Ambito"];
$idAmbito = $_GET["idAmbito"];
$Campo = $_GET["Campo"];
$NCampo = $_GET["NCampo"];
$Referer = $_GET["Referer"];

$Volver = "$Referer?$Campo=$idAmbito";

$link = ConnBDCervera();
$sql = " select * from $Ambito inner join UsuariosAcceso on $Ambito.$Campo =  UsuariosAcceso.idAmbito where UsuariosAcceso.idusuario = ". $_SESSION['idUsuario'] . " and  $Campo = $idAmbito";




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
	$NombreCampo = $row[$NCampo]; 
}

mysqli_free_result($result);

$campos = array();
$campos = Campos($Ambito,$link);
$CamposImage = array();

for($i = 0; $i < sizeof($campos); $i++){
	$pos1 = stripos($campos[$i],"Img");
	if($pos1 !== false){
		array_push($CamposImage, $campos[$i]);
	}
}



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Galer&iacute;a Fotogr&aacute;fica</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
<script type="text/javascript">
	function stopUpload(){
      document.getElementById('barracargando').style.visibility = 'hidden';
      document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="user-galeria-fotografica.php?Ambito=<?php echo $Ambito;?>&idAmbito=<?php echo $idAmbito;?>&Campo=<?php echo $Campo;?>&NCampo=<?php echo $NCampo;?>&Referer=<?php echo $Referer;?>";
	  	return true;   
}
</script>
</head>

<body>
<div id="espere" style="display:none" >
  <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
</div>
<div id="error" style="display:none" >
  <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
  <div id="errormsn" >
  </div>
</div>
<div id="cab">
  <div>
<img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" /> <map name="Map" id="Map">
<area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
</map>
</div>
</div
><div id="menu">
<ul>
<?php
		$sql = ' select * from UsuariosAcceso where idUsuario = ' . $_SESSION['idUsuario'];

		$link = ConnBDCervera();
		$result = mysqli_query($link,$sql);
		if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			if($row["Ambito"]=='Directorio'){
				echo '<li><a href="user-directorio-listado.php">Directorio</a></li>';
			}
			if($row["Ambito"]=='Museos'){
				echo '<li><a href="user-museos-listado.php">Museos</a></li>';
			}
			if($row["Ambito"]=='Monumentos'){
				echo '<li><a href="user-monumentos-listado.php">Monumentos</a></li>';
			}
			if($row["Ambito"]=='NucleosUrbanos'){
				echo '<li><a href="user-nucleosurbanos-listado.php">NucleosUrbanos</a></li>';
			}
			
		}
		
		
		?>
</ul>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">

</div>
<div id="opciones">
<h3 align="center">Galeria de imagenes de <?php echo $NombreCampo; ?></h3>
  <ul>
    <li><a href="<?php echo $Volver; ?>">Volver a Editar <?php echo $NombreCampo; ?></a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>

<div id="contenido">


<div id="barracargando" style="visibility:hidden">Cargando fotos...<br/><img src="images/loader.gif" /></div>
<div id="FormImage">
<form method="post" enctype="multipart/form-data" id="uploadform">
<input type="hidden" name="IDAMBITO" value="<?php echo $idAmbito;?>"/>
<input type="hidden" name="AMBITO" value="<?php echo $Ambito;?>"/>
<input type="hidden" name="TITULOS" value=""/>
<input type="hidden" name="PIES" value=""/>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput('foto[]');">A&ntilde;adir otra imagen</a></div>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="19">Archivo fotogr&aacute;fico</td>
<td>T&iacute;tulo de la foto (m&aacute;x 100)</td>
<td>Pie de foto (m&aacute;x 250)</td>
</tr>
<tr>
<td><input type="file" name="foto[]" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" /></td>
<td><input name="TITULO" type="text" size="50" /></td>
<td><input name="PIE" type="text" size="50" /></td>
</tr>
</table>
<div id="moreUploads"></div>
</form>
</div>
<a href="#" name="subirImg" class="uploadfile" onclick="uploadFile('Img');startUpload();">Subir Imagen</a>
<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>
<br class="limpiar" />
<?php
// datos de la entrada del directorio


for($i = 0; $i < sizeof($CamposImage); $i++){
		$CamposQuery .= ", AM." . $CamposImage[$i];
}

$sql = " SELECT Img.* $CamposQuery FROM Imagenes as Img "
			." inner join $Ambito as AM on Img.idAmbito = AM.$Campo "
			." WHERE Ambito = '$Ambito' AND idAmbito = $idAmbito ";
$sql .= " order by Img.Orden, Img.idImagen ";			
			
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
	
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

		$idImagen  	 = $row["idImagen"];
		$Ambito  	 = $row["Ambito"];
		$idAmbito  	 = $row["idAmbito"];
		$Archivo = $row["Archivo"];
		$Path = $row["Path"];
		$Tipo = $row["Tipo"]; 
		$Tamano = $row["Tamano"];
		$Ancho = $row["Ancho"];
		$Alto = $row["Alto"];
		$Titulo = $row["Titulo"];
		$Pie = $row["Pie"];
		$AltoThumb = $row["AltoThumb"];
		$AnchoThumb = $row["AnchoThumb"];
		$Fecha = $row["Fecha"];
		$Publicar = $row["Publicar"];
		
		$ImgDescripcion = $row["ImgDescripcion"];
		$ImgHistoria = $row["ImgHistoria"];
		$ImgFlora = $row["ImgFlora"];
		$ImgFauna = $row["ImgFauna"];
		

		

			echo "<div class=\"galeriaImagen\"  id=\"Img$idImagen\">\n";
	  	echo "<div class=\"Imagen\">\n";
	  	echo "<img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" border=\"0\" title=\"". $Titulo ."\"/>\n";
	  	echo "</div>\n";
	  	echo "<div class=\"DatosImagen\">\n";
	  	
		  echo "<ul>\n";
		  echo "<li>Fecha: ". $Fecha ."</li>\n";
		  echo "<li>Archivo: ". $Archivo ."</li>\n"; 
		  echo "<li>Anchura: ". $Ancho ." px.</li>\n";
		  echo "<li>Altura: ". $Alto ." px.</li>\n";
		  echo "<li>Tama&ntilde;o: ". $Tamano ."</li>\n";
		  echo "<form name=\"formImagen$idImagen\" >\n";
		  // T�tulo de imagen
		  echo "<li><span onclick=\"Editar('TITULO',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto\"><strong>T&iacute;tulo (m&aacute;x 100): </strong></span><span id=\"TITULO$idImagen\" onclick=\"Editar('TITULO',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\">". $Titulo ."</span>";
		  echo "<input type=\"text\" name=\"TITULO\" value=\"".$Titulo."\" style=\"display:none\" disabled=\"disabled\" onBlur=\"GuardarDatos('TITULO',$idImagen);\" onchange=\"TextoModificado=true;\" size=\"70\" maxlength=\"100\" class=\"textoimagen\" /></li>\n";
		  // Pie de imagen
		  echo "<li><span onclick=\"Editar('PIE',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto\"><strong>Pie de foto (m&aacute;x 250): </strong></span><span id=\"PIE$idImagen\" onclick=\"Editar('PIE',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\">". $Pie ."</span>";
		  echo "<textarea name=\"PIE\" cols=\"45\" rows=\"2\" disabled=\"disabled\" style=\"display:none\" onblur=\"GuardarDatos('PIE',$idImagen);\" onchange=\"TextoModificado=true;\"  class=\"textoimagen\"></textarea>";
			// Publicar
			echo "<li><strong>Publicar: </strong><input type=\"checkbox\" name=\"PUBLICAR\" value=\"$idImagen\" onclick=\"Publicar($idImagen,this);\" ";
		 	if($Publicar){echo "checked";}
		 	echo "/></li>\n";
		 	// Eliminar
		 	echo "<li><img onmouseover=\"this.style.cursor='pointer';\" src=\"images/eliminarfoto.gif\" alt=\"Eliminar foto\" width=\"50\" height=\"25\" onClick=\"EliminarImagen(".$idImagen.")\" /></li>";
		 	echo "</form>\n";
		 	// Asociacion de imagenes
		 	
		 	for($i = 0; $i < sizeof($CamposImage); $i++){
					if( $CamposImage[$i] == "ImgDescripcion"){
						echo "<li><strong>Descripci&oacute;n: </strong><input type=\"checkbox\" name=\"DESCRIPCION\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgDescripcion',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgDescripcion == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $CamposImage[$i] == "ImgHistoria"){
						echo "<li><strong>H�storia: </strong><input type=\"checkbox\" name=\"HISTORIA\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgHistoria',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgHistoria == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $CamposImage[$i] == "ImgFlora"){
						echo "<li><strong>Flora: </strong><input type=\"checkbox\" name=\"FLORA\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgFlora',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgFlora == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $CamposImage[$i] == "ImgFauna"){
						echo "<li><strong>Fauna: </strong><input type=\"checkbox\" name=\"FAUNA\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgFauna',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgFauna == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $CamposImage[$i] == "ImgUsos"){
						echo "<li><strong>Usos: </strong><input type=\"checkbox\" name=\"USOS\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgUsos',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgUsos == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $CamposImage[$i] == "ImgHabitat"){
						echo "<li><strong>Habitat: </strong><input type=\"checkbox\" name=\"HABITAT\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgHabitat',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgHabitat == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $CamposImage[$i] == "ImgSetas"){
						echo "<li><strong>Setas: </strong><input type=\"checkbox\" name=\"SETAS\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgSetas',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgSetas == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $CamposImage[$i] == "ImgNoticia"){
						echo "<li><strong>Noticia: </strong><input type=\"checkbox\" name=\"NOTICIAS\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgNoticia',$idImagen,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($ImgNoticia == $idImagen){echo "checked";}
					 	echo "/></li>\n";
					}
			}
		 	echo "<li><strong>Intercambiar posici&oacute;n: </strong><input type=\"checkbox\" name=\"POSICION\" value=\"$idImagen\" onclick=\"IntercambiarImagen(this);\" /></li>";
		  echo "</ul>\n";
		  
	  echo "</div>\n";
		echo "</div>\n";
	
	 
	
	}
	echo "<nobr clear=\"left\" ></nobr>\n";
	
}
mysqli_free_result($result);
mysqli_close($link);	
?>
</div>
<br clear="left" />
</body>
</html>
