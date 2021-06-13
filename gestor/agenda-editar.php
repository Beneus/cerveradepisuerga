<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Entities\TipoEvento;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$Agenda = new Agenda();
$NucleosUrbanos = new NucleosUrbanos();
$agendaManager = new Manager($Agenda);
$nucleosUrbanosManager = new Manager($NucleosUrbanos);
$TipoEvento = new TipoEvento();
$tipoEventoManager = new Manager($TipoEvento);
$dc->Set($nucleosUrbanosManager->GetAll(), 'NucleosUrbanos');
$dc->Set($tipoEventoManager->GetAll(), 'TipoEvento');

$ErrorMsg = '';
$Evento = '';
$Lugar = '';
$idNucleoUrbano = '';
$Telefono = '';
$Email = '';
$URL = '';
$Contacto = '';
$Precio = '';
$idTipoEvento = '';
$ErrorMsn = '';
$HoraEvento = '';
$FechaEvento = '';
$Mostrar = $_GET["Mostrar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$Agenda->_POST();
	if ($Agenda->Evento == "") {
		$ErrorMsg = "<span class=\"errortexto\">Evento.</span><br/>";
	}
	if ($Agenda->idTipoEvento != "17") { // fiestas oficiales
		if ($Agenda->Lugar == "") {
			$ErrorMsg .= "<span class=\"errortexto\">Lugar.</span><br/>";
		}
	}
	if (is_null($Agenda->FechaEvento)) {
		$ErrorMsg .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
	}

	if ($ErrorMsg == "") {
		$agendaManager->Save($Agenda);
		$lastInsertedId = $agendaManager->GetLastInsertedId();

		if ($lastInsertedId) {
			$idAgenda->idAgenda = $lastInsertedId;
			$dc->Set($agendaManager->Get($lastInsertedId), 'Agenda');
		}
	} else {
		$ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
		$ErrorMsn .= "<blockquote>";
		$ErrorMsn .= $ErrorMsg;
		$ErrorMsn .= "</blockquote>";
	}
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['idAgenda'])) {
		$agendaManager->Get($_GET['idAgenda']);
	}
}


?>
<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
	<!--[if lt IE 9]> <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<script src="https://use.fontawesome.com/4ecc3dbb0b.js"></script>
	<link href="css/form.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="scripts/tiny_mce.js" language="javascript"></script>
	<script language="javascript" type="text/javascript">
		tinyMCE.init({
			height: "250",
			mode: "textareas",
			theme: "advanced",
			content_css: 'css/form.css',
			theme_advanced_buttons1: "newdocument,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
			theme_advanced_buttons1_add: "outdent,indent",
			theme_advanced_buttons2: "",
			theme_advanced_buttons3: "",
			theme_advanced_toolbar_location: "top",
			theme_advanced_toolbar_align: "left",
			theme_advanced_path_location: "bottom",
			extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
		});
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
						<li class="liselect"><a title="A&ntilde;adir monumento" href="agenda-editar.php">A&ntilde;adir entrada</a></li>
						<li><a title="Listado del monumentos" href="agenda.php">Listado</a></li>
					</ul>
				</div>

				<div class="content">
					<div class="form_wrapper">
						<div class="form_container">
							<div class="title_container">
								<h2>Eventos</h2>
							</div>

							<form id="formEntrada" method="post" name="formEntrada" action="agenda-editar.php" onsubmit="EnviarEntradaAgenda(this,'nuevo');return false;">

								<div class="row clearfix">
									<div class="col_half">
										<label>Evento</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input name="EVENTO" type="text" placeholder="Evento" id="EVENTO" value="<?= htmlspecialchars($Agenda->Evento); ?>" />
										</div>
									</div>
									<div class="col_half">
										<label>Lugar</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input name="LUGAR" type="text" placeholder="Lugar del evento" id="LUGAR" value="<?= htmlspecialchars($Agenda->Lugar); ?>" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Tipo evento</label>
										<div class="select_field"> <span><i aria-hidden="true" class="fa fa-list"></i></span>
											<?php
											$list = GetSmallArrayFromBiggerOne($dc, 'TipoEvento', array('idTipoEvento', 'TipoEvento'));
											echo GetSelect("IDTIPOEVENTO", "idTipoEvento", "TipoEvento", $list, "", "", "", "", $Agenda->idTipoEvento);
											?>
										</div>
									</div>
									<div class="col_half">
										<label>Poblaci&oacute;n</label>
										<div class="select_field"> <span><i aria-hidden="true" class="fa fa-list"></i></span>
											<?php

											$list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano', 'NombreNucleoUrbano'));
											echo GetSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $list, "", "", "", "", $Agenda->idNucleoUrbano);
											?>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Hora evento</label>
										<div class="input_field">
											<input name="HORAEVENTO" type="time" id="HORAEVENTO" placeholder="hh:mm" value="<?= $Agenda->HoraEvento; ?>" />
										</div>
									</div>
									<div class="col_half">
										<label>Fecha evento</label>
										<div class="input_field">
											<input name="FECHAEVENTO" type="date" id="FECHAEVENTO" placeholder="dd/mm/aaaa" value="<?= $Agenda->FechaEvento ? $Agenda->FechaEvento : date("Y-m-d"); ?>" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Email</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
											<input name="EMAIL" type="text" id="EMAIL" placeholder="contacto@email.es" value="<?= htmlspecialchars($Agenda->Email); ?>" />
										</div>
									</div>
									<div class="col_half">
										<label>URL</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-link"></i></span>
											<input name="URL" type="text" id="URL" placeholder="http://www.cerveradepisuerga.eu" value="<?= htmlspecialchars($Agenda->URL); ?>" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Contacto</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-building-o"></i></span>
											<input name="CONTACTO" type="text" id="CONTACTO" placeholder="contacto" value="<?= htmlspecialchars($Agenda->Contacto); ?>" />
										</div>
									</div>
									<div class="col_half">
										<label>Precio</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-money"></i></span>
											<input name="PRECIO" type="text" id="PRECIO" placeholder="Precio de la entrada" value="<?= htmlspecialchars($Agenda->Precio); ?>" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Teléfono</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
											<input name="TELEFONO" type="text" id="TELEFONO" placeholder="Teléfono" value="<?= htmlspecialchars($Agenda->Telefono); ?>" size="16" maxlength="16" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col">
										<label>Descripción</label>
										<div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>
											<textarea name="DESCRIPCION" cols="80" rows="40" placeholder="Notas del evento" id="DESCRIPCION">
												<?= $Agenda->Descripcion; ?>
											</textarea>
										</div>
									</div>
								</div>
								<?php if ($Agenda->idAgenda) {
									$imagenUrl = 'location.href="galeria-fotografica.php?Ambito=Agenda&idAmbito=' . $Agenda->idAgenda . '&Campo=idAgenda&NCampo=Evento&Referer=agenda-editar.php"';
									$documentUrl = 'location.href="galeria-documentos.php?Ambito=Agenda&idAmbito=' . $Agenda->idAgenda . '&Campo=idAgenda&NCampo=Evento&Referer=agenda-editar.php"';

								?>
									<div class="row clearfix">
										<div class="col_half">
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-picture-o"></i></span>
												<input type="button" name="IMAGEN" id="IMAGEN" class="button" value="Adjuntar Imagen" onclick='<?= $imagenUrl ?>' />
											</div>
										</div>
										<div class="col_half">
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file"></i></span>
												<input type="button" name="DOCUMENTO" id="DOCUMENTO" class="button" value="Adjuntar Documeto" onclick='<?= $documentUrl ?>' />
											</div>
										</div>
									</div>
								<?php
								}
								?>
								<div class="row clearfix">
									<div class="col_half">
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-save"></i></span>
											<input type="submit" class="button" name="ENVIAR" id="ENVIAR" value="Salvar" />

										</div>
									</div>
									<div class="col_half">
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-save"></i></span>
											<?php
											$volver = 'location.href="agenda.php?Mostrar=' . $Mostrar . '&Pagina=' . $Pagina . '"';
											?>
											<input type="button" name="VOLVER2" id="VOLVER2" class="button" value="Volver al listado" onclick='<?= $volver ?>' />

										</div>
									</div>
								</div>
								<input name="IDAGENDA" type="hidden" id="IDAGENDA" value="<?= $Agenda->idAgenda; ?>" />
								<input type="hidden" name="ADJUNTAR" value="0" />
							</form>
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