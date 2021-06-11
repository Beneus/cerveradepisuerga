<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

// datos de la entrada del directorio

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: C&oacute;mo llegar galer&iacute;a</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
<script language="javascript" type="text/javascript">

//var upload_number = 2;
function addFileInput() {
 	var d = document.createElement("div");
 	var file = document.createElement("input");
	var titulo = document.createElement("input");
	var pie = document.createElement("input");
	var saltolinea = document.createElement("br");
 	file.setAttribute("type", "file");
 	file.setAttribute("name", "foto[]");
	titulo.setAttribute("type", "text");
 	titulo.setAttribute("name", "TITULO");
 	titulo.setAttribute("size", "50");
	pie.setAttribute("type", "text");
 	pie.setAttribute("name", "PIE");
 	pie.setAttribute("size", "50");
 	d.appendChild(file);
	d.appendChild(titulo);
	d.appendChild(pie);
 	document.getElementById("moreUploads").appendChild(d);
 	//upload_number++;
}


function startUpload(){
      document.getElementById('barracargando').style.visibility = 'visible';
      document.getElementById('FormImage').style.visibility = 'hidden';
      return true;
}
function stopUpload(){
      document.getElementById('barracargando').style.visibility = 'hidden';
      document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="como-llegar-galeria.php?Ambito=ComoLlegar&idAmbito=1";
	  	return true;   
}
var TextoModificado = false;

function Editar(idspan,idImg){
	var objSpan = eval("document.getElementById('"+idspan+idImg+"')");
	var objForm = eval("document.formImagen"+ idImg+"."+idspan);
	objSpan.style.display='none';
	objForm.style.display = "";
	objForm.value = objSpan.innerHTML;
	objForm.disabled = false;
	objForm.focus();
}
function GuardarDatos(idspan,idImg){
	var objSpan = eval("document.getElementById('"+idspan+idImg+"')");
	var objForm = eval("document.formImagen"+ idImg+"."+idspan);
	if (TextoModificado){
		// enviar datos al servidior;
		document.getElementById("espere").style.display = "block";
		cad = "IDIMAGEN=" + idImg + "&CAMPO=" + idspan + "&"+ idspan.toUpperCase() + "=" + objForm.value;
		FAjax('editarimagen.php','espere',cad,'post');
			
		objSpan.innerHTML = objForm.value;
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
		TextoModificado = false;
	}else{
		objSpan.style.display =  "";
		objForm.style.display =  "none";
		objForm.disabled = true;
	}
}
function EliminarImagen(idImg){
	var cad = "eliminarimagen.php?idImagen=" + idImg;
	window.open(cad,'','width=100px,height=100px');
	
}
function Publicar(idImg,x){
	document.getElementById("espere").style.display = "block";
	var cad = "" ;
	if(x.checked){
		cad = "PUBLICAR=1&IDIMAGEN=" + idImg ;
		FAjax('publicarimagen.php','espere',cad,'post');
	}else{
		cad = "PUBLICAR=0&IDIMAGEN=" + idImg ;
		FAjax('publicarimagen.php','espere',cad,'post');
	}
}

function AsociarImagen(asociacion,idImg,tabla,x,campo,campovalor){
	document.getElementById("espere").style.display = "block";
	var cad = "" ;
	if(x.checked){
		cad = "ASOCIACION="+ asociacion + "&IDIMAGEN=" + idImg + "&TABLA=" + tabla + "&CAMPO=" + campo + "&CAMPOVALOR=" + campovalor;
		FAjax('asociarimagen.php','espere',cad,'post');
		eval("document.formImagen" + idImg + ".PUBLICAR.checked = true");
	}
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
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" /></div>
</div>
<div id="menu">
<?php echo $strMenu; ?>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
<?php echo $strSubMenu; ?>
</div>
<div id="opciones">
  <ul>
    <li><a title="A&ntilde;adir entrada al directorio" href="como-llegar-entrada.php">Editar</a></li>
    <li class="liselect"><a title="Listado del directorio"  href="como-llegar-galeria.php">A&ntilde;adir imagen</a> 
      <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
    </li>
  </ul>
</div>
<div class="separador">&nbsp;</div>

<div id="contenido">
<h3 align="center">Galeria de imagenes de Como Llegar</h3>
<a href="como-llegar-entrada.php">Volver a Editar </a>
<div id="barracargando" style="visibility:hidden">Cargando fotos...<br/><img src="images/loader.gif" /></div>
<div id="FormImage">
<form method="post" enctype="multipart/form-data" id="uploadform">
<input type="hidden" name="IDAMBITO" value="1"/>
<input type="hidden" name="AMBITO" value="ComoLlegar"/>
<input type="hidden" name="TITULOS" value=""/>
<input type="hidden" name="PIES" value=""/>
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
<div id="moreUploadsLink" style="display:none;"><a href="javascript:addFileInput();">A&ntilde;adir otra imagen</a></div>
</form>
</div>
<a href="#" name="subirImg" class="uploadfile" onclick="uploadFile();startUpload();">Subir Imagen</a>
<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>
<?php
// datos de la entrada del directorio

$sql = " SELECT Img.*,COM.ImgDescripcion FROM Imagenes as Img "
			." inner join ComoLlegar as COM on Img.idAmbito = COM.idComoLlegar "
			." WHERE Ambito = 'ComoLlegar' AND idAmbito = 1 ";

$link = ConnBDCervera();
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
		$Descripcion = $row["Descripcion"];



	echo "<div class=\"galeriaImagen\">\n";
	  echo "<div class=\"Imagen\">\n";
	  	echo "<img src=\"../$Path/$Archivo\" width=\"$AnchoThumb\" height=\"$AltoThumb\" border=\"0\" title=\"". $Titulo ."\"/>\n";
	  echo "</div>\n";
	  echo "<div class=\"DatosImagen\">\n";
	  	
		  echo "<ul>\n";
		  echo "<li>Fecha: ". $Fecha ."</li>\n";
		  echo "<li>Archivo: ". $Archivo ."</li>\n"; 
		  echo "<li>Anchura: ". $Ancho ." px.</li>\n";
		  echo "<li>Altura: ". $Alto ." px.</li>\n";
		  echo "<li>Tama&ntilde;o: ". $Tamano ."</li>\n";
		  echo "<form name=\"formImagen$idImagen\" >\n";
		  echo "<li><span onclick=\"Editar('TITULO',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\">T&iacute;tulo: </span><span id=\"TITULO$idImagen\" onclick=\"Editar('TITULO',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\">". $Titulo ."</span>";
		  echo "<input type=\"text\" name=\"TITULO\" value=\"".$Titulo."\" style=\"display:none\" disabled=\"disabled\" onBlur=\"GuardarDatos('TITULO',$idImagen);\" onchange=\"TextoModificado=true;\" size=\"50\" /></li>\n";
		  
		  echo "<li><span onclick=\"Editar('PIE',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\">Pie de foto: </span><span id=\"PIE$idImagen\" onclick=\"Editar('PIE',$idImagen);\" onmouseover=\"this.style.cursor='pointer';\">". $Pie ."</span>";
		  echo "<input type=\"text\" name=\"PIE\" value=\"".$Pie."\" style=\"display:none\" disabled=\"disabled\" onBlur=\"GuardarDatos('PIE',$idImagen);\" onchange=\"TextoModificado=true;\" size=\"50\" /></li>\n";
	
			echo "<li>Publicar:<input type=\"checkbox\" name=\"PUBLICAR\" value=\"$idImagen\" onclick=\"Publicar($idImagen,this);\" ";
		 	if($Publicar){echo "checked";}
		 	echo "/></li>\n";
		 	
		 	echo "<li><img onmouseover=\"this.style.cursor='pointer';\" src=\"images/eliminarfoto.gif\" alt=\"Eliminar foto\" width=\"50\" height=\"25\" onClick=\"EliminarImagen(".$idImagen.")\" /></li>";
		 	echo "</form>\n";
		 	echo "<li>Descripci&oacute;n: <input type=\"radio\" name=\"DESCRIPCION\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgDescripcion',$idImagen,'ComoLlegar',this,'idComoLlegar',1);\" ";
		 	if($ImgDescripcion == $idImagen){echo "checked";}
		 	echo "/></li>\n";
		 	//echo "<li>H�storia: <input type=\"radio\" name=\"HISTORIA\" value=\"$idImagen\" onclick=\"AsociarImagen('ImgHistoria',$idImagen,'$Ambito',this,'idNucleoUrbano',$idAmbito);\" ";
		 //if($ImgHistoria == $idImagen){echo "checked";}
		 //	echo "/></li>\n";
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