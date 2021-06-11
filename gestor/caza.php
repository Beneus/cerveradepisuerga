<?php
session_start();
include ("includes/Conn.php");
include("includes/variables.php");


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Caza</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="cab">
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
<map name="Map" id="Map">
<area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
</map></div>
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
    <li><a title="A&ntilde;adir noticia" href="caza-entrada.php">Editar</a></li>
    <li><a title="Listado del noticias"  href="galeria-fotografica.php?Ambito=Caza&idAmbito=1&Campo=idCaza&NCampo=idCaza&Referer=caza-entrada.php">A&ntilde;adir imagen</a></li>
  </ul>
</div>
<hr class="separador" />
<div id="contenido"></div>
</body>
</html>
