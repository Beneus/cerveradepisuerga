<?php

use citcervera\Model\Connections\DB;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

// datos de la entrada del directorio

$db = new DB();

$Ambito = $_GET["Ambito"] ?? '';
$idAmbito = $_GET["idAmbito"] ?? '';
$Campo = $_GET["Campo"] ?? '';
$NCampo = $_GET["NCampo"] ?? '';
$Referer = $_GET["Referer"] ?? '';
$camposQuery = '';
$Volver = "$Referer?$Campo=$idAmbito";



$sql = " Select * from $Ambito where $Campo = $idAmbito ";
$ambito = $db->query($sql,'fetch_object');
$nombreCampo = $ambito[0]->{$NCampo};

$columns = get_object_vars($ambito[0]);

$keys = array();
$columnKeys = array_keys($columns);
$camposDoc = array_values(array_filter($columnKeys,function($ret2){ return stripos($ret2,"Doc")!== false;}));

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
	  	location.href="galeria-documentos.php?Ambito=<?php echo $Ambito;?>&idAmbito=<?php echo $idAmbito;?>&Campo=<?php echo $Campo;?>&NCampo=<?php echo $NCampo;?>&Referer=<?php echo $Referer;?>";
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
</div>
<div id="menu">
<?php echo $strMenu; ?>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
<?php echo $strSubMenu; ?>
</div>
<div id="opciones">
<h3 align="center">Galeria de documentos de <?php echo $nombreCampo; ?></h3>
  <ul>
    <li><a href="<?php echo $Volver; ?>">Volver a Editar <?php echo $nombreCampo; ?></a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>

<div id="contenido">


<div id="barracargando" style="visibility:hidden">Cargando documento...<br/><img src="images/loader.gif" /></div>
<div id="FormImage">
<form method="post" enctype="multipart/form-data" id="uploadform">
<input type="hidden" name="IDAMBITO" value="<?php echo $idAmbito;?>"/>
<input type="hidden" name="AMBITO" value="<?php echo $Ambito;?>"/>
<input type="hidden" name="TITULOS" value=""/>
<input type="hidden" name="PIES" value=""/>
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput('documento[]');">A&ntilde;adir otra imagen</a></div>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="19">Archivo documentos</td>
<td></td>
</tr>
<tr>
<td><input type="file" name="documento[]" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" /></td>
<td>T&iacute;tulo del documento (m&aacute;x 100)<br/><input name="TITULO" type="text" size="50" /></td>
</tr>
<tr>
<td></td>
<td>Pie del documento (m&aacute;x 250)<br/><input name="PIE" type="text" size="50" /></td>
</tr>
</table>
<div id="moreUploads"></div>
</form>
</div>
<a href="#" name="subirImg" class="uploadfile" onclick="uploadFile('Doc');startUpload();">Subir documento</a>
<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>
<br class="limpiar" />
<?php
// datos de la entrada del directorio


for($i = 0; $i < sizeof($camposDoc); $i++){
		$camposQuery .= ", AM." . $camposDoc[$i];
}

$sql = " SELECT Doc.* $camposQuery FROM Documentos as Doc "
			." inner join $Ambito as AM on Doc.idAmbito = AM.$Campo "
			." WHERE Ambito = '$Ambito' AND idAmbito = $idAmbito ";
$sql .= " order by Doc.Orden, Doc.idDoc ";			

$list = $db->query($sql,'fetch_object');
$max = count($list);	

if($max > 0){
	
	foreach($list as $doc){

		$idDoc  	 	= $doc->idDoc;
		$Ambito  	 	= $doc->Ambito;
		$idAmbito  	 	= $doc->idAmbito;
		$Archivo 		= $doc->Archivo;
		$Path 			= $doc->Path;
		$Tipo 			= $doc->Tipo; 
		$Tamano 		= $doc->Tamano;
		$Titulo 		= $doc->Titulo;
		$Pie 			= $doc->Pie;
		$Orden 			= $doc->Orden;
		$Fecha 			= $doc->Fecha;
		$Publicar 		= $doc->Publicar;
		$DocDescripcion = $doc->ImgDescripcion ?? '';
		$DocHistoria 	= $doc->DocHistoria ?? '';
		$DocFlora 		= $doc->DocFlora ?? '';
		$DocFauna 		= $doc->DocFauna ?? '';
		$DocAgenda 		= $doc->DocAgenda ?? '';


		echo "<div class=\"galeriaImagen\"  id=\"Doc$idDoc\">\n";
	  	echo "<div class=\"Imagen\">\n";
	  	//echo "<img src=\"".str_replace("images","thumb","../".$Path."/".$Archivo)."\" width=\"$AnchoThumb\" height=\"$AltoThumb\" border=\"0\" title=\"". $Titulo ."\"/>\n";
	  	echo "</div>\n";
	  	echo "<div class=\"DatosImagen\">\n";
	  	
		  echo "<ul>\n";
		  echo "<li>Fecha: ". $Fecha ."</li>\n";
		  echo "<li>Archivo: ". $Archivo ."</li>\n"; 
		  echo "<li>Tama&ntilde;o: ". $Tamano ."</li>\n";
		  echo "<form name=\"formImagen$idDoc\" >\n";
		  // T�tulo de imagen
		  echo "<li><span onclick=\"Editar('TITULO',$idDoc);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto\"><strong>T&iacute;tulo (m&aacute;x 100): </strong></span><span id=\"TITULO$idDoc\" onclick=\"Editar('TITULO',$idDoc);\" onmouseover=\"this.style.cursor='pointer';\">". $Titulo ."</span>";
		  echo "<input type=\"text\" name=\"TITULO\" value=\"".$Titulo."\" style=\"display:none\" disabled=\"disabled\" onBlur=\"GuardarDatosDoc('TITULO',$idDoc);\" onchange=\"TextoModificado=true;\" size=\"70\" maxlength=\"100\" class=\"textoimagen\" /></li>\n";
		  // Pie de imagen
		  echo "<li><span onclick=\"Editar('PIE',$idDoc);\" onmouseover=\"this.style.cursor='pointer';\" alt=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto\" title=\"Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto\"><strong>Pie de foto (m&aacute;x 250): </strong></span><span id=\"PIE$idDoc\" onclick=\"Editar('PIE',$idDoc);\" onmouseover=\"this.style.cursor='pointer';\">". $Pie ."</span>";
		  echo "<textarea name=\"PIE\" cols=\"45\" rows=\"2\" disabled=\"disabled\" style=\"display:none\" onblur=\"GuardarDatosDoc('PIE',$idDoc);\" onchange=\"TextoModificado=true;\"  class=\"textoimagen\"></textarea>";
			// Publicar
			echo "<li><strong>Publicar: </strong><input type=\"checkbox\" name=\"PUBLICAR\" value=\"$idDoc\" onclick=\"PublicarDoc($idDoc,this);\" ";
		 	if($Publicar){echo "checked";}
		 	echo "/></li>\n";
		 	// Eliminar
		 	echo "<li><img onmouseover=\"this.style.cursor='pointer';\" src=\"images/eliminarfoto.gif\" alt=\"Eliminar foto\" width=\"50\" height=\"25\" onClick=\"EliminarDoc(".$idDoc.")\" /></li>";
		 	echo "</form>\n";
		 	// Asociacion de imagenes
		 	
		 	for($i = 0; $i < sizeof($camposDoc); $i++){
					if( $camposDoc[$i] == "DocDescripcion"){
						echo "<li><strong>Descripci&oacute;n: </strong><input type=\"checkbox\" name=\"DESCRIPCION\" value=\"$idDoc\" onclick=\"AsociarImagen('DocDescripcion',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocDescripcion == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $camposDoc[$i] == "DocHistoria"){
						echo "<li><strong>H�storia: </strong><input type=\"checkbox\" name=\"HISTORIA\" value=\"$idDoc\" onclick=\"AsociarImagen('DocHistoria',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocHistoria == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $camposDoc[$i] == "DocFlora"){
						echo "<li><strong>Flora: </strong><input type=\"checkbox\" name=\"FLORA\" value=\"$idDoc\" onclick=\"AsociarImagen('DocFlora',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocFlora == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $camposDoc[$i] == "DocFauna"){
						echo "<li><strong>Fauna: </strong><input type=\"checkbox\" name=\"FAUNA\" value=\"$idDoc\" onclick=\"AsociarImagen('DocFauna',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocFauna == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $camposDoc[$i] == "DocUsos"){
						echo "<li><strong>Usos: </strong><input type=\"checkbox\" name=\"USOS\" value=\"$idDoc\" onclick=\"AsociarImagen('DocUsos',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocUsos == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $camposDoc[$i] == "DocHabitat"){
						echo "<li><strong>Habitat: </strong><input type=\"checkbox\" name=\"HABITAT\" value=\"$idDoc\" onclick=\"AsociarImagen('DocHabitat',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocHabitat == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $camposDoc[$i] == "DocSetas"){
						echo "<li><strong>Setas: </strong><input type=\"checkbox\" name=\"SETAS\" value=\"$idDoc\" onclick=\"AsociarImagen('DocSetas',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocSetas == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}	
					if( $camposDoc[$i] == "DocNoticia"){
						echo "<li><strong>Noticia: </strong><input type=\"checkbox\" name=\"NOTICIAS\" value=\"$idDoc\" onclick=\"AsociarImagen('DocNoticia',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocNoticia == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}
					if( $camposDoc[$i] == "DocAgenda"){
						echo "<li><strong>Agenda: </strong><input type=\"checkbox\" name=\"NOTICIAS\" value=\"$idDoc\" onclick=\"AsociarImagen('DocAgenda',$idDoc,'$Ambito',this,'$Campo',$idAmbito);\" ";
					 	if($DocAgenda == $idDoc){echo "checked";}
					 	echo "/></li>\n";
					}
			}
		 	echo "<li><strong>Intercambiar posici&oacute;n: </strong><input type=\"checkbox\" name=\"POSICION\" value=\"$idDoc\" onclick=\"IntercambiarDoc(this);\" /></li>";
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
