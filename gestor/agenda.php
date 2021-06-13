<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Entities\TipoEvento;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$agendaEntity = new Agenda();
$agendaManager = new Manager($agendaEntity);
$nucleosUrbanosEntity = new NucleosUrbanos();
$nucleosUrbanosManager = new Manager($nucleosUrbanosEntity);
$tipoEventoEntity = new TipoEvento();
$tipoEventoManager = new Manager($tipoEventoEntity);
$db = new DB();

$idTipoEvento = $_GET["idTipoEvento"] ?? '';
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$Ano = $_GET["Ano"] ?? '';
$Mes = $_GET["Mes"] ?? '';
$Dia = $_GET["Dia"] ?? '';
$buscar = $_GET["Buscar"] ?? '';
$pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($pagina)) $pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar)) $Mostrar = 10;

$where = [];
$where_param = [];
$format = [];

if ($Ano != "") {
	$conditions['Year(FechaEvento)'] = $Ano;
	$where[] = '( Year(FechaEvento) =? )';
	$where_param[] = $Ano;
	$format[] = '%s';
}
if ($Mes != "") {
	$conditions['Month(FechaEvento)'] = $Mes;
	$where[] = '( Month(FechaEvento) =? )';
	$where_param[] = $Mes;
	$format[] = '%s';
}
if ($Dia != "") {
	$conditions['Day(FechaEvento)'] = $Dia;
	$where[] = '( Day(FechaEvento) =? )';
	$where_param[] = $Dia;
	$format[] = '%s';
}
if ($idNucleoUrbano != "") {
	$conditions['idNucleoUrbano'] = $idNucleoUrbano;
	$where[] = '( idNucleoUrbano =? OR idNucleoUrbano =? )';
	$where_param[] = $idNucleoUrbano;
	$where_param[] = 0;
	$format[] = '%s';
	$format[] = '%s';
}
if ($idTipoEvento != "") {
	$conditions[] = 'idTipoEvento =>' . $idTipoEvento;
	$where[] = '( idTipoEvento =? )';
	$where_param[] = $idTipoEvento;
	$format[] = '%s';
}

if ($where) {
	$query = ' SELECT * FROM Agenda WHERE ' . implode(' AND ', $where);
} else {
	$query = ' SELECT * FROM Agenda ';
}


// echo $query;
$eventos = $agendaManager->Search($query, $where_param, $format);
$nucleosUrbanos = $nucleosUrbanosManager->GetAll();
$tipoEvento = $tipoEventoManager->GetAll();

$dc->Set($eventos, 'Agenda');
$dc->Set($nucleosUrbanos, 'NucleosUrbanos');
$dc->Set($tipoEvento, 'TipoEvento');







function SearchResult($buscar, $idNucleoUrbano, $Ano, $Mes, $Dia, $Mostrar, $pagina, $db)
{
	$sql = "SELECT AG.*, NU.NombreNucleoUrbano FROM Agenda as AG ";

	if ($idNucleoUrbano > 0) {
		$sql = $sql . " inner JOIN NucleosUrbanos as NU ON AG.idNucleoUrbano = NU.idNucleoUrbano where AG.idNucleoUrbano = $idNucleoUrbano ";
		if ($buscar != "") {
			$sql .= " and  AG.Evento like '%$buscar%' "
				. " or AG.Lugar like '%$buscar%' "
				. " or NU.NombreNucleoUrbano like '%$buscar%'"
				. " or AG.FechaEvento like '%$buscar%'"
				. " or AG.HoraEvento like '%$buscar%'"
				. " or AG.Descripcion like '%$buscar%'";
		}
		if ($Ano != "") {
			$sql .= " and Year(AG.FechaEvento) = '$Ano'";
		}
		if ($Mes != "") {
			$sql .= " and Month(AG.FechaEvento) = '$Mes'";
		}
		if ($Dia != "") {
			$sql .= " and day(AG.FechaEvento) = '$Dia'";
		}
	} else {
		$sql = $sql . " left JOIN NucleosUrbanos as NU ON AG.idNucleoUrbano = NU.idNucleoUrbano ";
		if ($buscar != "") {
			$sql .= " where  AG.Evento like '%$buscar%' "
				. " or AG.Lugar like '%$buscar%' "
				. " or NU.NombreNucleoUrbano like '%$buscar%'"
				. " or AG.FechaEvento like '%$buscar%'"
				. " or AG.HoraEvento like '%$buscar%'"
				. " or AG.Descripcion like '%$buscar%'";
			if ($Ano != "") {
				$sql .= " and Year(AG.FechaEvento) = '$Ano'";
				if ($Mes != "") {
					$sql .= " and Month(AG.FechaEvento) = '$Mes'";
				}
				if ($Dia != "") {
					$sql .= " and day(AG.FechaEvento) = '$Dia'";
				}
			}
		} elseif ($Ano != "") {
			$sql .= " where Year(AG.FechaEvento) = '$Ano'";
			if ($Mes != "") {
				$sql .= " and Month(AG.FechaEvento) = '$Mes'";
			}
			if ($Dia != "") {
				$sql .= " and day(AG.FechaEvento) = '$Dia'";
			}
		} elseif ($Mes != "") {
			$sql .= " where Month(AG.FechaEvento) = '$Mes'";
			if ($Dia != "") {
				$sql .= " and day(AG.FechaEvento) = '$Dia'";
			}
		} elseif ($Dia != "") {
			$sql .= " where day(AG.FechaEvento) = '$Dia'";
		}
	}

	$sql = $sql . " order by FechaEvento desc, HoraEvento ";

	$list = $db->query($sql);
	$NumTotalRegistros = count($list);

	if ($Mostrar > 0) {
		$sql = $sql . " LIMIT " . ((($pagina * $Mostrar) - $Mostrar)) . "," . $Mostrar;
	} else {
		$sql = $sql . " LIMIT " . ((($pagina * $NumTotalRegistros) - $NumTotalRegistros)) . "," . ($NumTotalRegistros);
	}

	return ['total' => $NumTotalRegistros, 'result' => $db->query($sql, 'fetch_object')];
}


?>
<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/table.css" />
	<link rel="stylesheet" href="css/form.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="js/jquery.funciones.js"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
	<!--[if lt IE 9]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<script src="https://use.fontawesome.com/4ecc3dbb0b.js"></script>


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
			var urldest = "agenda-eliminar.php";
			var cad = "page=" + pag + "&cadEliminados=" + cad_eliminados;
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

		function SeleccionNucleoUrbano(x) {
			location.href = "agenda.php?Mostrar=<?php echo $Mostrar; ?>&Ano=<?php echo $Ano; ?>&Mes=<?php echo $Mes; ?>&Dia=<?php echo $Dia; ?>&idNucleoUrbano=" + x.value;

		}

		function SeleccionAno(x) {
			location.href = "agenda.php?Mostrar=<?php echo $Mostrar; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&Mes=<?php echo $Mes; ?>&Dia=<?php echo $Dia; ?>&Ano=" + x.value;

		}

		function SeleccionMes(x) {
			location.href = "agenda.php?Mostrar=<?php echo $Mostrar; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&Ano=<?php echo $Ano; ?>&Dia=<?php echo $Dia; ?>&Mes=" + x.value;

		}

		function SeleccionDia(x) {
			location.href = "agenda.php?Mostrar=<?php echo $Mostrar; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&Ano=<?php echo $Ano; ?>&Mes=<?php echo $Mes; ?>&Dia=" + x.value;

		}

		function Paginar(x) {
			location.href = "agenda.php?&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&Dia=<?php echo $Dia; ?>&Mes=<?php echo $Mes; ?>&Ano=<?php echo $Ano; ?>&Mostrar=" + x.value;

		}

		function CambiarPagina(x) {
			location.href = "agenda.php?&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&Dia=<?php echo $Dia; ?>&Mes=<?php echo $Mes; ?>&Ano=<?php echo $Ano; ?>&Mostrar=<?php echo $Mostrar; ?>&Pagina=" + x.value;

		}

		function Buscar(x) {
			location.href = "agenda.php?Buscar=" + x.value;
		}
	</script>
</head>

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
						<li class="liselect"><a title="A&ntilde;adir monumento" href="agenda-editar.php">A&ntilde;adir entrada</a></li>
						<li><a title="Listado del monumentos" href="agenda.php">Listado</a></li>
					</ul>
				</div>

				<div class="content">

					<table role="table" id="agendaSearch">
						<thead role="rowgroup">
							<tr>
								<th role="columnheader">Buscar</th>
								<th role="columnheader">d&iacute;a</th>
								<th role="columnheader">mes</th>
								<th role="columnheader">a&ntilde;o</th>
								<th role="columnheader">localidad</th>
								<th role="columnheader">Mostrar</th>
							</tr>
						</thead>

						<tbody role="rowgroup">
							<tr>
								<td role="columnheader">
									<form id="form1" name="form1" method="post" action="">
										<input name="BUSCAR" type="text" id="BUSCAR" value="<?php echo $buscar; ?>" />
										<input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
									</form>
								</td>
								<td role="columnheader">
									<?php
									$sql = "SELECT DISTINCT day(FechaEvento) AS DAY FROM Agenda where day(FechaEvento) > 0 order by day(FechaEvento)";
									$accion = "onchange=\"SeleccionDia(this);\"";
									$list = $db->query($sql);
									echo GetSelect("DIA", "DAY", "DAY", $list, "", "", "select_field", $accion, $Dia);
									?>
								</td>
								<td role="columnheader">
									<?php
									$sql = "SELECT DISTINCT month(FechaEvento) AS MONTH, monthname(FechaEvento) AS MONTHNAME FROM Agenda where month(FechaEvento) > 0 order by Month(FechaEvento) ";
									$accion = "onchange=\"SeleccionMes(this);\"";
									$list = $db->query($sql);
									echo GetSelect("MES", "MONTH", "MONTHNAME", $list, "", "", "select_field", $accion, $Mes);
									?>
								</td>
								<td role="columnheader">
									<?php
									$sql = "SELECT DISTINCT year(FechaEvento) as ANO FROM Agenda where year(FechaEvento) > 0 order by year(FechaEvento) desc";
									$accion = "onchange=\"SeleccionAno(this);\"";
									$list = $db->query($sql);
									echo GetSelect("ANO", "ANO", "ANO", $list, "", "", "select_field", $accion, $Ano);
									?>
								</td>
								<td role="columnheader">
									<?php
									$accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
									$list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano', 'NombreNucleoUrbano'));
									echo GetSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $list, "", "", "", $accion, $idNucleoUrbano);
									?>
								</td>
								<td role="columnheader">
									<select name="MOSTRAR" onChange="Paginar(this);">
										<option value="10" <?php if ($Mostrar == 10) echo "selected"; ?>>10</option>
										<option value="25" <?php if ($Mostrar == 25) echo "selected"; ?>>25</option>
										<option value="50" <?php if ($Mostrar == 50) echo "selected"; ?>>50</option>
										<option value="100" <?php if ($Mostrar == 100) echo "selected"; ?>>100</option>
										<option value="0" <?php if ($Mostrar == 0) echo "selected"; ?>>Todos</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<?php
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

				$res = SearchResult($buscar, $idNucleoUrbano, $Ano, $Mes, $Dia, $Mostrar, $pagina, $db);
				$NumTotalRegistros = $res['total'];
				$list = $res['result'];

				if ($Mostrar > 0) {
					$numPags = ceil($NumTotalRegistros / $Mostrar);
				} else {
					$numPags = 1;
				}

				if ($Mostrar > 0) {
					$sigMostrar = $Mostrar;
				} else {
					$Mostrar = $NumTotalRegistros;
					$sigMostrar = 0;
				}

				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


				if ($NumTotalRegistros > 0) {
				?>
					<div class="content">
						<table role="table" id="agenda">
							<thead role="rowgroup">
								<tr role="row">
									<th role="columnheader">Fecha</th>
									<th role="columnheader">Hora</th>
									<th role="columnheader">Evento</th>
									<th role="columnheader">Lugar</th>
									<th role="columnheader">Nucleo Urbano</th>
									<th role="columnheader"><input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" /></th>
									<th role="columnheader"></th>
								</tr>
							</thead>


							<tbody role="rowgroup">
								<?php
								$clasefila = "filagris";
								foreach ($list as $evento) {

									if (!is_null($evento->HoraEvento)) {
										$HoraEvento = date("H:i", strtotime($evento->HoraEvento));
									} else {
										$HoraEvento = "--:--";
									}
								?>
									<tr role="row">
										<td role="cell"><?php echo date("d/m/Y", strtotime($evento->FechaEvento)); ?></td>
										<td role="cell"><?php echo $HoraEvento; ?></td>
										<td role="cell"><?php echo $evento->Evento; ?></td>
										<td role="cell"><?php echo $evento->Lugar; ?></td>
										<td role="cell"><?php echo $evento->NombreNucleoUrbano; ?></td>
										<td role="cell">
											<div align="center">
												<input type="checkbox" name="idDir" value="<?php echo $evento->idAgenda; ?>" />
											</div>
										</td>
										<td role="cell">
											<div align="center">
												<input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='agenda-editar.php?idAgenda=<?php echo $evento->idAgenda; ?>&Pagina=<?php echo $pagina; ?>&Mostrar=<?php echo $sigMostrar; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&Ano=<?php echo $Ano; ?>&Dia=<?php echo $Dia; ?>&Mes=<?php echo $Mes; ?>'" />
											</div>
										</td>
									</tr>

								<?php

								}
								?>

								<tr role="row">
									<td role="cell"></td>
									<td role="cell"></td>
									<td role="cell">

										<?php

										if (($pagina > 1) and ($Mostrar < $NumTotalRegistros)) {

											echo "<a href=\"agenda.php?Pagina=" . ($pagina - 1) . "&Mostrar=$Mostrar&buscar=$buscar&idNucleoUrbano=$idNucleoUrbano\" class=\"linkBlanco\"> << Anterior </a>";
										}
										if (($pagina < $numPags) and ($Mostrar < $NumTotalRegistros)) {

											echo "<a href=\"agenda.php?Pagina=" . ($pagina + 1) . "&Mostrar=$Mostrar&buscar=$buscar&idNucleoUrbano=$idNucleoUrbano\" class=\"linkBlanco\"> Siguiente >> </a>";
										}
										?> </td>
									<td role="cell"></td>
									<td role="cell">
										<?php
										if (($numPags > 1) and ($Mostrar < $NumTotalRegistros)) {
											echo "Ir a P&aacute;gina: ";
											echo "<select name=\"Pagina\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
											for ($i = 1; $i <= $numPags; $i++) {
												if ($i == $pagina) {
													echo "<option value=\"$i\" selected>$i</option>";
												} else {
													echo "<option value=\"$i\">$i</option>";
												}
											}
											echo "</select>";
										}

										?>
									</td>
									<td role="cell"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $pagina; ?>)" /></td>
									<td role="cell"></td>

								</tr>
							</tbody>
						</table>
					</div>
				<?php
				}
				?>

			</div>
			<?php
			include("./footer.php");
			?>
		</div>
	</div>
</body>

</html>