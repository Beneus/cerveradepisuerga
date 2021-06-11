<?php
include("includes/Conn.php");
include("includes/funciones.php");
$opcion = 0;
$usuario = $_POST["usuario"] ?? '';
$clave = $_POST["clave"] ?? '';
$query = $_SERVER["QUERY_STRING"];
$msgError = '';

if ($_SERVER['REQUEST_METHOD']== "POST"){
$query = $_POST["query"];
	if (($usuario != '') && ($clave != '')){
	$sql = " SELECT idUsuario, usuario, TipoUsuario FROM Usuarios where usuario = '$usuario' and clave = '".hashPassword($clave)."' ";
//echo $sql;
		$link = ConnBDCervera();
			$result = mysqli_query($link ,$sql);
			$max = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($max){
				//usuario identificado
					//if(($row["TipoUsuario"] == "ADMIN") or ($row["TipoUsuario"] == "USERCIT")){
						$opcion = 1;
						$_SESSION['Conexion'] = true;
						$_SESSION['idUsuario'] = $row["idUsuario"]; 
						$_SESSION['Usuario'] = $row["usuario"]; 
						$_SESSION['TipoUsuario'] = $row["TipoUsuario"];
						header("Location:$query");
						exit;
					/*}else{
						$opcion = 3;
						$_SESSION['Conexion'] = true;
						$_SESSION['idUsuario'] = $row["idUsuario"]; 
						$_SESSION['Usuario'] = $row["usuario"]; 
						$_SESSION['TipoUsuario'] = $row["TipoUsuario"];
						header("Location:indexuser.php");
						exit;
					}
					*/
				}
				else{
					// usuario incorrecto;
					$opcion = 2;
					$_SESSION['Conexion'] = false;
					$_SESSION['idUsuario'] = 0; 
					$_SESSION['Usuario'] = ''; 
					$_SESSION['TipoUsuario'] = '';

					$msgError = "<span class=\"TituloBlanco\">El nombre de </span><span class=\"TituloRojo\">usuario</span><span class=\"TituloBlanco\"> y/o la </span><span class=\"TituloRojo\">contrase�a</span><span class=\"TituloBlanco\"> no son correctas.</span>";		
				}
			mysqli_free_result($result);
			mysqli_close($link);
	}else{
	$msgError = "<span class=\"TituloBlanco\">Debes introducir un nombre de </span><span class=\"TituloRojo\">usuario</span> y una </span><span class=\"TituloRojo\">contrase�a</span>";
	}
}	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Login</title>
<link rel="stylesheet" href="css/ppal.css" />
<link rel="stylesheet" href="css/estilos.css" />
<script type="text/javascript" src="js/funciones.js"></script>
</head>

<body>
<div id="contenedor">
<div id="izquierda">
<!-- zona editable de la izquierda -->
<!-- Fin zona editable de la izquierda -->
</div>
<div id="cuerpologin">
<!-- zona editable del cuerpo -->
<div id="zonalogin">
<img src="images/banner.gif" alt="Dosdecadatres" width="151" height="100" /> 
<div class="TituloBlanco">Gestor de contenidos </div><br />
<br />


<div id="FormLogin">
<form name="formLogin" action="login.php" method="post">
<input type="hidden" name="query" value="<?php echo $query; ?>"/>
<input name="usuario" type="text" class="linkusuario" id="usuario" value="Usuario"  size="16" maxlength="16" onfocus="this.value='';">
<br/>
<input name="clave" type="password" class="linkusuario" id="clave" value="" size="16" maxlength="16" style="display:none" />
<input name="clave2" type="text" class="linkusuario" id="clave2" value="Contraseña" size="16" maxlength="16"  onfocus="this.style.display='none';this.value='';document.getElementById('clave').style.display='';document.getElementById('clave').focus();">
<br><br>
<input type="submit" name="Entrar" value="Entrar" class="linkusuario"/>         
</form>
</div>
<div id="msnError"><? echo $msgError; ?></div>

<!-- Fin zona editable del cuerpo -->
  </div>
<br class="clearfloat" />
</div>
</body>
</html>

