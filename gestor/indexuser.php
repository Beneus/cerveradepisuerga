<?php
session_start();
include("includes/variables-user.php");
include("includes/funciones.php");
include("includes/Conn.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Cervera de Pisuerga: El coraz&oacute;n de la Monta&ntilde;a Palentina</title>
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
				echo '<li><a href="user_museos.php">Museos</a></li>';
			}
			if($row["Ambito"]=='Monumentos'){
				echo '<li><a href="user_monumentos.php">Monumentos</a></li>';
			}
			if($row["Ambito"]=='NucleosUrbanos'){
				echo '<li><a href="user_nucleosurbanos.php">NucleosUrbanos</a></li>';
			}
			
		}
		
		
		?>

        
	</ul>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
	
</div>
<div id="opciones"></div>
<hr class="separador" />
<div id="contenido"></div>
</body>
</html>
