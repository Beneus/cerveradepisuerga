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
<title>Gestor de contenidos: Fauna </title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="cab">
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
    <map name="Map" id="Map">
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
  <ul>
    <li><a title="A&ntilde;adir entrada al directorio" href="fauna-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del directorio"  href="fauna-listado.php">Listado</a> </li>
  </ul>
</div>
<hr class="separador" />
<div id="contenido"><br />

</div>

<br clear="left" />
</body>
</html>
