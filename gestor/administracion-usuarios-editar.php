<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Usuario;
use citcervera\Model\Entities\UsuariosAcceso;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;


$dc = new DataCarrier();
$Usuario = new Usuario();
$UsuariosAcceso = new UsuariosAcceso();
$usuarioManager = new Manager($Usuario);
$usuariosAccesoManager = new Manager($UsuariosAcceso);
$dc->Set($usuariosAccesoManager->GetAll(), 'UsuariosAcceso');

$Idusuario = '';
$ErrorMsn = '';
$ErrorMsg = '';

$link = ConnBDCervera();

function NombreItem($Amb, $Camp, $idAmb)
{

	switch ($Amb) {
		case "Directorio":
			$Sel = "NombreComercial";
			break;
		case "Monumentos":
			$Sel = "Monumento";
			break;
		case "Museos":
			$Sel = "Museo";
			break;
		case "NucleosUrbanos":
			$Sel = "NombreNucleoUrbano";
			break;
		case "Rutas":
			$Sel = "Ruta";
			break;
	}
	$link = ConnBDCervera();
	$sql = "select $Sel from $Amb where $Camp = $idAmb ";
	$result = mysqli_query($link, $sql);
	if (!$result) {
		$message = "Invalid query" . mysqli_error($link) . "\n";
		$message .= "whole query: " . $sql;
		die($message);
		exit;
	}
	$max = mysqli_num_rows($result);
	if ($max > 0) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row[$Sel];
	} else {
		return "";
	}
}




if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$Usuario->_POST();

	if ($Usuario->Usuario == "") {
		$ErrorMsg .= "<span class=\"errortexto\">Usuario.</span><br/>";
	} elseif (strlen($Usuario->Usuario) < 6) {
		$ErrorMsg .= "El <span class=\"errortexto\">Usuario.</span> debe de tener al menos 6 caracteres<br/>";
	}
	if ($Usuario->Clave == "") {
		$ErrorMsg .= "<span class=\"errortexto\">Clave.</span><br/>";
	} elseif (strlen($Usuario->Clave) < 6) {
		$ErrorMsg .= "La <span class=\"errortexto\">Clave.</span> debe de tener al menos 6 caracteres<br/>";
	}
	if ($_POST["CLAVE2"] != $Usuario->Clave) {
		$ErrorMsg .= "Las <span class=\"errortexto\">Claves</span> introducidas no son iguales.<br/>";
	}
	if (($Usuario->Email != "") and (!isEmail($Usuario->Email))) {
		$ErrorMsg .= "<span class=\"errortexto\">Email.</span><br/>";
	}

	if ($ErrorMsg == "") {
		$Usuario->Clave = hashPassword($Usuario->Clave);
		$usuarioManager->Save($Usuario);
		$lastInsertedId = $usuarioManager->GetLastInsertedId();

		if ($lastInsertedId) {
			$Usuario->Idusuario = $lastInsertedId;
			$dc->Set($usuarioManager->Get($lastInsertedId), 'Usuarios');
		}
	} else {
		// devolvemos el error
		$ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
		$ErrorMsn .= "<blockquote>";
		$ErrorMsn .= $ErrorMsg;
		$ErrorMsn .= "</blockquote>";
	}
}


if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['idUsuario'])) {
		$usuarioManager->Get($_GET['idUsuario']);
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Gestor de contenidos: Administraci&oacute;n</title>
	<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/table.css" />
	<link rel="stylesheet" href="css/form.css" type="text/css" />
	<script type="text/javascript">
		function Cargar(sel) {
			var respuesta = "";
			var direccion = "";

			direccion = "administracion-ambitos.php?Ambito=" + sel.value;

			//alert(direccion);
			if (window.ActiveXObject) {
				var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlHttp.open("GET", direccion, false);
				xmlHttp.send();
				respuesta = xmlHttp.responseText;
			} else if (document.implementation && document.implementation.createDocument) {
				xmlHttp = new XMLHttpRequest();
				xmlHttp.open("GET", direccion, false);
				xmlHttp.send(null);
				respuesta = xmlHttp.responseText;
			}


			if (respuesta != "") {
				document.getElementById("grupo_idambito").innerHTML = respuesta;
			} else {
				document.getElementById("grupo_idambito").innerHTML = "";
			}

		}

		function EliminarEntrada(pag) {
			var num_idleg = document.getElementsByName("idDir").length;
			var cad_eliminados = "";
			for (i = 0; i < num_idleg; i++) {
				if (document.getElementsByName("idDir")[i].checked) {
					if (cad_eliminados == "") {
						cad_eliminados += document.getElementsByName("idDir")[i].value;
					} else {
						cad_eliminados += "-" + document.getElementsByName("idDir")[i].value;
					}
				}
			}
			var urldest = "administracion-eliminar-user-item.php";
			var cad = "Pagina=" + pag + "&cadEliminados=" + cad_eliminados;
			if (cad_eliminados != "") {
				window.open(urldest + "?" + cad, '', 'width=200,height=200');
			}
		}

		function SelTodos(x) {
			var CheckDir = document.getElementsByName('idDir');
			for (i = 0; i < CheckDir.length; i++) {
				if (x.checked) {
					CheckDir[i].checked = true;
				} else {
					CheckDir[i].checked = false;
				}
			}
		}
	</script>
</head>

<body>
	<div id="espere" style="display:none">
		<div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
	</div>
	<?php
	if ($ErrorMsn != "") {
	?>
		<script type="text/javascript">
			disDiv("contenido", true);
		</script>
		<div id="error">
			<div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
			<div id="errormsn"><?php echo $ErrorMsn; ?>
			</div>
		</div>
	<?php
	}
	?>
	<div class="wrapper">
		<header id="header" class="grid">
			<div class="grid-cell">
				<div class="grid">
					<a href="/"><img id="logo" src="images/LOGO-CIT-CERVERA.gif"></a>
				</div>
			</div>
		</header>
		<label for="menu-toggle" class="label-toggle"></label>
		<input type="checkbox" id="menu-toggle" />
		<nav>
			<?php
			echo $strMenu;

			?>
		</nav>
		<div class="grid container">

			<div class="main">

				<div id="opciones">
					<ul>
						<li>
							<h2><?= explode('.', curPageName())[0] ?></h2>
						</li>
						<li><a title="Listado del noticias" href="administracion-usuarios-editar.php">A&ntilde;adir usuario</a></li>
						<li class="liselect"><a title="Listado del noticias" href="administracion-usuarios.php">Listado de usuarios</a></li>
					</ul>
				</div>

				<div class="content" id="contenido">
					<div class="form_wrapper">
						<div class="form_container">
							<div class="title_container">
								<h2>Usuarios</h2>
							</div>

							<form id="formEntrada" name="formEntrada" action="administracion-usuarios-editar.php" method="post">
								<div class="tablaizq">
									<ul class="tablaformizq">

										<li class="campoform">
											<div class="tituloentradaform">Usuario</div>
											<div class="valorentradaform">
												<input name="USUARIO" type="text" id="USUARIO" value="<?php echo $Usuario->Usuario; ?>" size="16" maxlength="16" autocomplete="off" />
												(m&iacute;n 6 m&aacute;x. 16)
											</div>
										</li>
										<li class="campoform">
											<div class="tituloentradaform">Clave</div>
											<div class="valorentradaform"><input name="CLAVE" type="password" id="CLAVE" size="16" maxlength="16" autocomplete="off" />
												(m&iacute;n 6 m&aacute;x. 16)
											</div>
										</li>
										<li class="campoform">
											<div class="tituloentradaform">Repetir clave</div>
											<div class="valorentradaform">
												<input name="CLAVE2" type="password" id="CLAVE2" size="16" maxlength="16" autocomplete="off" />
												(m&iacute;n 6 m&aacute;x. 16)
											</div>
										</li>
										<li class="campoform">
											<div class="tituloentradaform">Tipo de usuario</div>
											<div class="valorentradaform">
												<select name="TIPOUSUARIO" onchange="CambiarClase(this);">
													<option value="ADMIN" <?php if ($Usuario->TipoUsuario == "ADMIN") echo "selected"; ?>>ADMIN</option>
													<option value="USERCIT" <?php if ($Usuario->TipoUsuario == "USERCIT") echo "selected"; ?>>USERCIT</option>
													<option value="USER" <?php if ($Usuario->TipoUsuario == "USER") echo "selected"; ?>>USER</option>
												</select>
											</div>
										</li>
										<li class="campoform">
											<div class="tituloentradaform">Email</div>
											<div class="valorentradaform">
												<input name="EMAIL" type="text" id="EMAIL" value="<?php echo $Usuario->Email; ?>" size="35" />
											</div>
										</li>
										<li class="campoform">
											<div class="tituloentradaform">Acceso</div>
											<div class="valorentradaform">
												<select name="AMBITO" size="4" onchange="Cargar(this)">
													<option value="Directorio">Directorio</option>
													<option value="Monumentos">Monumentos</option>
													<option value="Museos">Museos</option>
													<option value="NucleosUrbanos">NucleosUrbanos</option>
													<option value="Rutas">Rutas</option>
												</select>
											</div>
										</li>
									</ul>
								</div>
								<div class="tablader">
								</div>
								<br class="limpiar" />
								<div class="textolargo">
									<ul class="tablaformtextolargo">
										<li class="campoform">
											<div class="tituloentradaform">&nbsp;</div>
											<div class="valorentradaform">
												<span id="grupo_idambito"></span>
											</div>
										</li>
										<li class="campoform">
											<div class="tituloentradaform">&nbsp;</div>
											<div class="valorentradaform">
												<input type="submit" name="ENVIAR" id="ENVIAR" value="Actualizar Usuario" />
											</div>
										</li>

									</ul>
								</div>
								<input type="hidden" name="IDUSUARIO" value="<?php echo $Usuario->Idusuario; ?>" />
							</form>
							<br class="limpiar" />
							<?php
							$sql = "select IdusuariosAcceso, Idusuario, Ambito, Campo, idAmbito from UsuariosAcceso where Idusuario = '. $Usuario->Idusuario . 'order by Ambito";
							$result = mysqli_query($link, $sql);
							if (!$result) {
								$message = "Invalid query" . mysqli_error($link) . "\n";
								$message .= "whole query: " . $sql;
								die($message);
								exit;
							}
							$max = mysqli_num_rows($result);
							if ($max > 0) { ?>
								<table width="500" border="0" cellpadding="0" cellspacing="0">
									<tr class="titulolistado">
										<td class="lateralizq">&nbsp;</td>
										<td>Apartado</td>
										<td>Elemento</td>
										<td align="center"><input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" /></td>
										<td class="lateralizq">&nbsp;</td>
									</tr>

									<?php
									$clasefila = "filagris";
									while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
										if ($clasefila == "filagris") {
											$clasefila = "filablanca";
										} else {
											$clasefila = "filagris";
										}
									?>
										<tr class="<?php echo $clasefila; ?>">
											<td class="lateralizq">&nbsp;</td>
											<td><?php echo $row["Ambito"]; ?></td>
											<td><?php echo NombreItem($row["Ambito"], $row["Campo"], $row["idAmbito"]); ?></td>
											<td align="center"><input type="checkbox" name="idDir" value="<?php echo $row["idUsuariosAcceso"]; ?>" /></td>
											<td class="lateralizq">&nbsp;</td>
										</tr>
									<?php
									}
									?>
									<tr>
										<td class="lateralizq">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada('')" /></td>
										<td class="lateralizq">&nbsp;</td>
									</tr>
								</table>
							<?php
							} else {
								echo "no tiene asociado ningun item";
							}
							mysqli_close($link);
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
			include("./footer.php");
			?>
		</div>
	</div>
















</body>

</html>