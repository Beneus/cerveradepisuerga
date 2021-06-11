<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Administraci&oacute;n</title>
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
<li><a href="administracion-servicios.php">Servicios</a></li>
<li class="liselect"><a href="administracion-subservicios.php">Subservicios</a></li>
</ul>
</div>

<hr class="separador" />
<div id="contenido"></div>
</body>
</html>
