<?php
session_start();
include ("includes/Conn.php");
include("includes/variables.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Gestor de contenidos: Mapa del Municipio</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="cab">
  <div><img src="images/cab.gif" width="1024" height="100" /></div>
</div>
<div id="menu">
<?php echo $strMenu; ?>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
<?php echo $strSubMenu; ?>
</div>
<div id="opciones"></div>
<hr class="separador" />
<div id="contenido"></div>
</body>
</html>
