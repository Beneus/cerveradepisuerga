<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$idServicio = '';
if (isset($_GET["idServicio"])){$idServicio = $_GET["idServicio"];}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Administraci&oacute;n</title>
<script type="text/javascript" src="js/jquery-1.3.2.min.js" ></script>
<script type="text/javascript">

$(document).ready(function(){
// Servicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	var TextoServicio = "";
	$(".Servicio").click(function(){
		// cierro cualquier input text abierto
		$("input[name$='TextServicio']").each(function(index){
			$(this).siblings("span").attr("style","display:''");
			$(this).siblings("span").html($(this).val());
			$(this).attr("style","display:none");
		});
		TextoServicio = $(this).html();
		$(this).attr("style","display:none");
		$("#TextServ" + $(this).attr("id")+ "").attr("style","display:''");
		$("#TextServ" + $(this).attr("id")+ "").attr("disabled",false);
		$("#TextServ" + $(this).attr("id")+ "").attr("size",TextoServicio.length);
		$("#TextServ" + $(this).attr("id")+ "").focus();
	});
// servicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$("input[name$='TextServicio']").blur(function(){
		var idServicio = $(this).attr("id").replace("TextServ","").split("-")[0];
		var isSubServicio = $(this).attr("id").replace("TextServ","").split("-")[1];
		if(TextoServicio != $.trim($(this).val())){
			// actualizamos el nuevo valor en la base de datos
			$.ajax({
		//alert('administracion-servicios-edit.php?tipo=Servicio&idServicio='+idServicio + '&NombreServicio=' + $(this).val());
			  url: 'administracion-servicios-edit.php?tipo=Servicio&idServicio='+idServicio + '&NombreServicio=' + $(this).val(),
			  beforesend:function(){},
			  success: function(data) {
			  	location.href="administracion-servicios.php?idServicio="+idServicio;
			  }
			});
		}

		$(this).siblings("span").attr("style","display:''");
		$(this).siblings("span").html($(this).val());
		$(this).attr("style","display:none");

	});
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	// SubServicios
	var TextoInicial = "";
	$(".SubServicio").mouseover(function(){$(this).attr("style","cursor:pointer")});
	$(".SubServicio").click(function(){
		// cierro cualquier input text abierto
		$("input[name$='TextSubServicio']").each(function(index){
			$(this).siblings("span").attr("style","display:''");
			$(this).siblings("span").html($(this).val());
			$(this).attr("style","display:none");
		});
		TextoInicial = $(this).html();
		$(this).attr("style","display:none");
		$("#TextSubS" + $(this).attr("id")+ "").attr("style","display:''");
		$("#TextSubS" + $(this).attr("id")+ "").attr("disabled",false);
		$("#TextSubS" + $(this).attr("id")+ "").attr("size",TextoInicial.length);
		$("#TextSubS" + $(this).attr("id")+ "").focus();
	});
// Subservicio ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$("input[name$='TextSubServicio']").blur(function(){
		var idServicio = $(this).attr("id").replace("TextSubS","").split("-")[0];
		var isSubServicio = $(this).attr("id").replace("TextSubS","").split("-")[1];
		if(TextoInicial != $.trim($(this).val())){
			// actualizamos el nuevo valor en la base de datos
			$.ajax({
			  url: 'administracion-servicios-edit.php?tipo=SubServicio&idServicio='+idServicio + '&idSubServicio=' + isSubServicio + '&NombreSubServicio=' + $(this).val(),
			  beforesend:function(){},
			  success: function(data) {
			  }
			});
		}

		$(this).siblings("span").attr("style","display:''");
		$(this).siblings("span").html($(this).val());
		$(this).attr("style","display:none");

	});
	
// Nuevo Servicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$("#Enviar").click(function(){
		if($("#NuevoServicio").val()!=""){
			// enviar nuevo servicio
			
			// actualizamos el nuevo valor en la base de datos
			$.ajax({
			  url: 'administracion-servicios-edit.php?tipo=NuevoServicio&NombreServicio='+$("#NuevoServicio").val(),
			  beforesend:function(){},
			  success: function(data) {
				  if(data == ""){
				  	location.href="administracion-servicios.php?idServicio=<?php echo $idServicio; ?>";
				  }else{
				  	alert(data);
				  }
				  	
			  }
			});
	
		}
		
	});
// Nuevo Sub Servicio +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$("#EnviarSub").click(function(){
		if($("#NuevoSubServicio").val()!=""){
			// enviar nuevo servicio
			
			// actualizamos el nuevo valor en la base de datos
			$.ajax({
			  url: 'administracion-servicios-edit.php?tipo=NuevoSubServicio&idServicio=<?php echo $idServicio; ?>&NombreSubServicio='+$("#NuevoSubServicio").val(),
			  beforesend:function(){},
			  success: function(data) {
				  if(data == ""){
				  	location.href="administracion-servicios.php?idServicio=<?php echo $idServicio; ?>";
				  }else{
				  	alert(data);
				  }
				  	
			  }
			});
	
		}
		
	});	
	
	
	
// Eliminar Servicio+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$(".ImagenBorrar").click(function(){
			var answer = confirm('Eliminar  '+$(this).next("a").html());
			// Elimina un servicio
			// actualizamos el nuevo valor en la base de datos
			if (answer){
			$.ajax({
			  url: 'administracion-servicios-edit.php?tipo=EliminarServicio&idServicio='+ $(this).attr("id") + '&NombreServicio=' + $(this).next("a").html(),
			  beforesend:function(){},
			  success: function(data) {
				  if(data == ""){
				  	location.href="administracion-servicios.php?idServicio=<?php echo $idServicio; ?>";
				  }else{
				  	alert(data);
				  }
				  	
			  }
			});
			}
		
	});
// Eliminar SubServicio++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	$(".ImagenBorrarSub").click(function(){
			var answer = confirm('Eliminar  '+$(this).next().next().html());
			// Elimina un servicio
			// actualizamos el nuevo valor en la base de datos
			if (answer){
			$.ajax({
			  url: 'administracion-servicios-edit.php?tipo=EliminarSubServicio&idSubServicio='+ $(this).attr("id") + '&NombreSubServicio=' + $(this).next().next().html(),
			  beforesend:function(){},
			  success: function(data) {
				  if(data == ""){
				  	location.href="administracion-servicios.php?idServicio=<?php echo $idServicio; ?>";
				  }else{
				  	alert(data);
				  }
				  	
			  }
			});
			}
		
	});



//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
});

</script>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
</head>

<body>
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
<li class="liselect"><a href="administracion-servicios.php">Servicios</a></li>
<li></li>
</ul>
</div>

<hr class="separador" />
<div id="contenido">
<div> 
  <p>Actualizaci&oacute;n de las clasificaciones del directorio.<br />
    Cambiar nombre de un servicio o subservicio:<br />
    1.- Elegir el Servicio de la columna de la derecha
    <br />
    2.- 
  Hacer click en el nombre del servico o del subservico asociado en la columna de la derecha. El contenido del nombre se convertira en editable.<br />
  3.- Al salir se guardan automaticamente los cambios
  <br />
  A&ntilde;adir nuevo servicio o subservicio<br />
  Utilizar el formulario que hay debajo de cada columna.<br />
  Borrar o eliminar<br />
  Desde el icono con un aspa y fondo rojo se puede eliminar cada uno de los servicios o subservicios.
  </p>
</div>
<div class="tablaizq">
 <?php
 $link = ConnBDCervera();
 $sql = " select * from Servicios order by idServicio";
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
		
				echo "<li><img src=\"images/borrar.png\" width=\"16\" height=\"16\" class=\"ImagenBorrar\" id=\"".$row["idServicio"]."\" title=\"Borrar servicio: " . $row["NombreServicio"] . "\"/><a href=\"?idServicio=".$row["idServicio"]."\">" . $row["NombreServicio"] . "</a></li>";		
			if ($idServicio == $row["idServicio"]){
				$NombreServicio = $row["NombreServicio"];
			}
		
	}
	echo "</ul>";
}else{
	echo "no hay ning�n servicio";
}
mysqli_close($link);

 ?>
 
 <fieldset> <legend>Nuevo Servicios:</legend>
 <ul>
 <li><input type="text" name="NuevoServicio" id="NuevoServicio" value=""/><input type="button" name="Enviar" id="Enviar" value="A�adir"/></li>
 <li></li>
 </ul>
 </fieldset>
</div>
<div class="tablader">
 <?php
 
 if ($idServicio != ""){
 echo "<ul><li><span id=\"".$idServicio."\" class=\"Servicio\">" . $NombreServicio . "</span><input type=\"text\" id=\"TextServ". $idServicio . "\" name=\"TextServicio\" value=\"" . $NombreServicio . "\"  style=\"display:none\"></li></ul>";
}
$link = ConnBDCervera();
 $sql = " select * from SubServicios ";
 		if ($idServicio != ""){
		 $sql .= " where idServicio = $idServicio ";
		}
 $sql .= " order by idServicio, NombreSubServicio";
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
		if ($row["icono"] != ""){$Icono = $row["icono"];}else{$Icono = "noicono.png";}

		// solo en caso de que haya idservicio se pueden actualizar
		if ($idServicio != ""){
			echo "<li><img src=\"images/borrar.png\" width=\"16\" height=\"16\" class=\"ImagenBorrarSub\" id=\"".$row["idSubServicio"]."\" title=\"Borrar Subservicio: " . $row["NombreSubServicio"] . "\"/><img src=\"../iconos/" . $row["icono"] . "\" ><span class=\"SubServicio\" id=\"" . $row["idServicio"] . "-" .$row["idSubServicio"]. "\">" . $row["NombreSubServicio"] . "</span><input type='text' id='TextSubS". $row["idServicio"] . "-" .$row["idSubServicio"]."' name='TextSubServicio' value='". $row["NombreSubServicio"] ."' style=\"display:none\" /></li>";
		}else{
			echo "<li><img src=\"../iconos/" . $row["icono"] . "\" ><span>" . $row["NombreSubServicio"] . "</span></li>";
		}
	}
	echo "</ul>";
}else{
	echo "no hay ning�n subservicio";
}
mysqli_close($link);
if ($idServicio != ""){
 ?>
 <fieldset> <legend>Nuevo SubServicios:</legend>

   <ul>
 <li><label for="IconoSubServicio">icono (32x32)<input type="file" name="IconoSubServicio" id="IconoSubServicio" value=""/></label></li>
 <li><label for="NuevoSubServicio">Nombre: <input type="text" name="NuevoSubServicio" id="NuevoSubServicio" value=""/><input type="button" name="EnviarSub" id="EnviarSub" value="A�adir"/></label></li>
 <li></li>
 </ul></fieldset>
 <?php
 }
 ?>
</div>
</div>
</body>
</html>
