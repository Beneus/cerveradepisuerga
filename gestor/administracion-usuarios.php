<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$TipoUsuario = $_GET["TipoUsuario"] ?? '';
$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($Pagina)) $Pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar)) $Mostrar = 10;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
	<title>Gestor de contenidos: Fauna listado</title>
	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/table.css" />
	<link rel="stylesheet" href="css/form.css" type="text/css" />
	<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
	<script type="text/javascript">
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
			var urldest = "administracion-eliminar-user.php";
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

		function Paginar(x) {
			location.href = "administracion-list-user.php?&Buscar=<?php echo $Buscar; ?>&TipoUsuario=<?php echo $TipoUsuario; ?>&Mostrar=" + x.value;
		}

		function CambiarPagina(x) {
			location.href = "administracion-list-user.php?Mostrar=<?php echo $Mostrar; ?>&Buscar=<?php echo $Buscar; ?>&Pagina=" + x.value;
		}

		function CambiarTipo(x) {
			location.href = "administracion-list-user.php?TipoUsuario=" + x.value;
		}

		function Buscar(x) {
			location.href = "administracion-list-user.php?Buscar=" + x.value;
		}
	</script>
</head>

<body>
	<div id="espere" style="display:none">
		<div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
	</div>
	<div id="error" style="display:none">
		<div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
		<div id="errormsn">
		</div>
	</div>

	<body>
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

					<div class="content">
						<div class="form_wrapper">
							<div class="form_container">
								<div class="title_container">
									<h2>Usuarios</h2>
								</div>

								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td class="lateralizq">&nbsp;</td>
										<td>
											<form id="form1" name="form1" method="post" action="">
												<label>Buscar
													<input name="BUSCAR" type="text" id="BUSCAR" value="<?php echo $Buscar; ?>" />
												</label><input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
											</form>
										</td>
										<td>
											<select name="TIPOUSUARIO" onchange="CambiarTipo(this);">
												<option value="" <?php if ($TipoUsuario == "") echo "selected"; ?>>Todos</option>
												<option value="ADMIN" <?php if ($TipoUsuario == "ADMIN") echo "selected"; ?>>ADMIN</option>
												<option value="USERCIT" <?php if ($TipoUsuario == "USERCIT") echo "selected"; ?>>USERCIT</option>
												<option value="USER" <?php if ($TipoUsuario == "USER") echo "selected"; ?>>USER</option>
											</select>
										</td>
										<td>
											<span class="opcionElegida">Mostrar:</span>
											<select name="MOSTRAR" onChange="Paginar(this);" class="txt_inputs_buscador">
												<option value="10" <?php if ($Mostrar == 10) echo "selected"; ?>>10</option>
												<option value="25" <?php if ($Mostrar == 25) echo "selected"; ?>>25</option>
												<option value="50" <?php if ($Mostrar == 50) echo "selected"; ?>>50</option>
												<option value="100" <?php if ($Mostrar == 100) echo "selected"; ?>>100</option>
												<option value="0" <?php if ($Mostrar == 0) echo "selected"; ?>>Todos</option>
											</select>
										</td>
										<td class="lateralizq">&nbsp;</td>
									</tr>
								</table>

								<?php

								$link = ConnBDCervera();
								//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

								$sql = "SELECT idUsuario, Usuario, TipoUsuario, Email FROM Usuarios ";
								if ($TipoUsuario != "") {
									$sql .= " where  Usuarios.TipoUsuario = '$TipoUsuario' ";
									if ($Buscar != "") {
										$sql .= " and  (Usuarios.Usuario like '%$Buscar%' "
											. " or Usuarios.TipoUsuario like '%$Buscar%' "
											. " or Usuarios.Email like '%$Buscar%' )";
									}
								} elseif ($Buscar != "") {
									$sql .= " where  Usuarios.Usuario like '%$Buscar%' "
										. " or Usuarios.TipoUsuario like '%$Buscar%' "
										. " or Usuarios.Email like '%$Buscar%' ";
								}


								$result = mysqli_query($link, $sql);
								if (!$result) {
									$message = "Invalid query" . mysqli_error($link) . "\n";
									$message .= "whole query: " . $sql;
									die($message);
									exit;
								}

								$NumTotalRegistros = mysqli_num_rows($result);
								//calculo el total de p�&copy; nas
								$max = mysqli_num_rows($result);
								if ($Mostrar > 0) {
									$numPags = ceil($NumTotalRegistros / $Mostrar);
								} else {
									$numPags = 1;
								}

								$sql = $sql . " order by Usuario ";

								if ($Mostrar > 0) {
									$sql = $sql . " LIMIT " . ((($Pagina * $Mostrar) - $Mostrar)) . "," . (($Pagina * $Mostrar) - 1);
								} else {
									$Mostrar = $NumTotalRegistros;
									$sql = $sql . " LIMIT " . ((($Pagina * $Mostrar) - $Mostrar)) . "," . ($NumTotalRegistros);
								}

								//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

								$result = mysqli_query($link, $sql);
								if (!$result) {
									$message = "Invalid query" . mysqli_error($link) . "\n";
									$message .= "whole query: " . $sql;
									die($message);
									exit;
								}
								$max = mysqli_num_rows($result);
								if ($max > 0) {
								?>
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr class="titulolistado">
											<td class="lateralizq">&nbsp;</td>
											<td>Usuario</td>
											<td>Tipo de usuario</td>
											<td>Email</td>
											<td>
												<div align="center">
													<input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" />
												</div>
											</td>
											<td>
												<div align="center"></div>
											</td>
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
												<td>&nbsp;</td>
												<td><?php echo $row["Usuario"]; ?></td>
												<td><?php echo $row["TipoUsuario"]; ?></td>
												<td><?php echo $row["Email"]; ?></td>
												<td>
													<div align="center">
														<input type="checkbox" name="idDir" value="<?php echo $row["idUsuario"]; ?>" />
													</div>
												</td>
												<td>
													<div align="center">
														<input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='administracion-usuarios-editar.php?idUsuario=<?php echo $row["idUsuario"]; ?>&page=<?php echo $Pagina; ?>'" />
													</div>
												</td>
												<td class="lateralizq">&nbsp;</td>
											</tr>

										<?php

										}
										?>

										<tr class="titulolistado">
											<td class="lateralizq">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												<div align="center"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $Pagina; ?>)" /></div>
											</td>
											<td>
												<div align="center"></div>
											</td>
											<td class="lateralizq">&nbsp;</td>
										</tr>
										<tr class="titulolistado">
											<td class="lateralizq">&nbsp;</td>
											<td>&nbsp;</td>
											<td><?php
												if (($Pagina > 1) and ($Mostrar < $NumTotalRegistros)) {
													echo "<a href=\"administracion-list-user.php?Pagina=" . ($Pagina - 1) . "&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\" class=\"linkBlanco\"> << Anterior </a>";
												}
												if (($Pagina < $numPags) and ($Mostrar < $NumTotalRegistros)) {
													echo "<a href=\"administracion-list-user.php?Pagina=" . ($Pagina + 1) . "&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\" class=\"linkBlanco\"> Siguiente >> </a>";
												}
												?></td>
											<td>
												<?php
												if (($numPags > 1) and ($Mostrar < $NumTotalRegistros)) {
													echo "Ir a P&aacute;gina: ";
													echo "<select name=\"Pagina\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
													for ($i = 1; $i <= $numPags; $i++) {
														if ($i == $Pagina) {
															echo "<option value=\"$i\" selected>$i</option>";
														} else {
															echo "<option value=\"$i\">$i</option>";
														}
													}
													echo "</select>";
												}
												?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td class="lateralizq">&nbsp;</td>
										</tr>
									</table>

								<?php
								} else {
									// No hay Usuarios
								?>
									<div class="errortexto">No hay Usuarios.</div>
								<?php
								}
								mysqli_free_result($result);
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