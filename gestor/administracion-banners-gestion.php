<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Administraci&oacute;n gesti&oacute;n de banners</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<link href="css/cal.css" media="screen" rel="stylesheet" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js" ></script>
<script type="text/javascript" src="js/jquery.validate.js" ></script>
<script type="text/javascript" src="js/jquery.calendario.js"></script>
<script type="text/javascript"> 

$(document).ready(function(){
	//centra un div Enmedio de la pantalla
	function centerThis(div) {
			var winH = $(window).height();
			var winW = $(window).width();
			var centerDiv = $('#' + div);
			centerDiv.css('top', winH/2-centerDiv.height()/2);
			centerDiv.css('left', winW/2-centerDiv.width()/2);
		}
    centerThis('espere'); 
  	$(window).resize(function() { centerThis('espere');  });
	
	$("#calendar").calendario({form:"#FECHAINICIO"});
	$("#calendar").calendario({form:"#FECHAFIN"});	
	
	$("img").attr("name","ImagenBanner").click(function(){
		$("img").attr("name","ImagenBanner").each(function( intIndex ){
			$(this).parent("li").css({ "background-color":""});
		});
		$(this).parent("li").css({ "background-color":"red" });
		var objTB = "#TEXTOBUNNER"+ $(this).attr("idbanner");
		var objUB = "#URLBANNER"+ $(this).attr("idbanner");
		var objID = "#IDBANNER"+ $(this).attr("idbanner");
	
		$("#formEntrada #TEXTOBANNER").val($(objTB).val());
		$("#formEntrada #URLBANNER").val($(objUB).val());
		$("#formEntrada #IDBANNER").val($(objID).val());
	});
	
	$('form :input:visible:first').focus();
	$("#espere").hide();
	$("#formEntrada").validate({
					submitHandler: function(form) {
					//$("#espere").html("<p style=\"text-align:center\"><img src=\"images/espera2.gif\" title=\"Espere, el documento se est&aacute; cargando\" alt=\"Espere, el documento se est&aacute; cargando\" width=\"32\" height=\"32\" /><br/>Actualizando. Por favor, espere...</p>");
					$("#espere").show();
					EnviarEntradaBanner(form,'nuevo');
					return false;
					//form.submit();
					}
});//$("#myform").validate({
}); //$(document).ready(function(){
</script>

</head>

<body><div id="calendar"></div>
	<div id="espere"> 
  <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
</div>
<div id="error" style="display:none" >
  <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
  <div id="errormsn" >
  </div>
</div>
<div id="cab">
<div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
<map name="Map" id="Map">
<area shape="rect" coords="855,42,1009,75" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
</map>
</div>
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
<ul>
<li><a href="galeria-banners.php">Galeria de anuncios</a></li>
<li class="liselect"><a href="administracion-banners-gestion.php">Gesti&oacute;n de anuncios</a></li>
<li><a href="administracion-banners-listado.php">Anuncios publicados</a></li>
</ul>
</div>

<hr class="separador" />
<div id="contenido">

<div class="tablaizqBanner">
<form id="formEntrada" name="formEntrada" method="post">
<ul class="tablaformizq">
    <li class="campoform">
      <div class="tituloentradaform" title="Texto que define o sustituye a la imagen del banner">Texto banner</div>
      <div class="valorentradaform">
        <input name="TEXTOBANNER" type="text" id="TEXTOBANNER" size="60" class="required" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform"  title="Direcci�n web a donde nos dirige el anuncio al hacer click en �l">Url banner</div>
        <div class="valorentradaform"><input name="URLBANNER" type="text" id="URLBANNER" size="60" class="required url" />
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform" title="Fecha de aparici�n del anuncio, el primer d�a que aparece">Fecha inicio</div>
        <div class="valorentradaform">
          <input name="FECHAINICIO" type="text" id="FECHAINICIO" size="10" maxlength="10" class="required dateES" />
        </div>  
        </li> 
        <li class="campoform">
        <div class="tituloentradaform" title="Fecha de finalizaci&oacute;n del anuncio, el �ltimo d�a que aparece">Fecha f&iacute;n</div>
        <div class="valorentradaform">
          <input name="FECHAFIN" type="text" id="FECHAFIN" size="10" maxlength="10" class="required dateES" />
        </div>    
        </li> 
        <li class="campoform">
        <div class="tituloentradaform" title="P&aacute;gina web de cerveradepisuerga.eu donde aparecer� el anuncio">P&aacute;gina de colocaci&oacute;n</div>
        <div class="valorentradaform">
          <input name="PAGINA" type="text" id="PAGINA" size="60"  class="required"/>
        </div>    
        </li>     
         <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
        <input type="hidden" name="IDBANNER" id="IDBANNER" value="" />
          <input name="BTNENVIAR" type="submit" id="BTNENVIAR" value="A&nacute;adir Banner" />
        </div>    
        </li> 
</ul>
</form>
</div>
<div class="tabladerBanner">
 <?php
 $link = ConnBDCervera();
 $sql = " select * from Banners order by Orden";
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
	echo "<ul class=\"listabanners\">";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$idBanner = $row["idBanner"];
		$Banner = $row["Banner"];
		$Alto = $row["Alto"];
		$Ancho = $row["Ancho"];
		$TextoBanner = $row["TextoBanner"];
		$UrlBanner = urldecode($row["UrlBanner"]);
		echo "<li><img src=\"../Banners/$idBanner/$Banner\" width=\"$Ancho\" height=\"$Alto\" id=\"Banner$idBanner\" name=\"ImagenBanner\" idbanner=\"$idBanner\" title=\"$TextoBanner\" />";
		echo "<input type=\"hidden\" name=\"IDBANNER$idBanner\" id=\"IDBANNER$idBanner\" value=\"$idBanner\" />";
		echo "<input type=\"hidden\" name=\"TEXTOBUNNER$idBanner\" id=\"TEXTOBUNNER$idBanner\" value=\"$TextoBanner\" />";
		echo "<input type=\"hidden\" name=\"URLBANNER$idBanner\" id=\"URLBANNER$idBanner\" value=\"$UrlBanner\" /></li>";
		
		
	}
	echo "</ul>";
}else{
	echo "no hay ning&uacute;n banner";
}
mysqli_close($link);	
 ?>
</div>


<br class="limpiar" />
<div class="textolargo">
</div>

</div>
</body>
</html>
