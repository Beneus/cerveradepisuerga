<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\Noticias;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$Noticias = new Noticias();
$noticiasManager = new Manager($Noticias);
$db = new DB();


$idNoticia = $_GET["idNoticia"] ?? '';
$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';

$Titulo = '';
$Entradilla = '';
$FechaNoticia = '';
$Fuente = '';
$ImgNoticia = '';
$DocNoticia = '';
$Cuerpo = '';
$ImgArchivo = '';
$ImgPath = '';
$AnchoThumb = '';
$AltoThumb = '';
$DocArchivo = '';
$DocPath = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$Noticias->_POST();
	if ($Noticias->Titulo == "") {
		$ErrorMsg = "<span class=\"errortexto\">Titulo.</span><br/>";
	}
	if ($ErrorMsg == "") {
		$Noticias->Fecha = date("Y-m-d H:m:s");
		$noticiasManager->Save($Noticias);
		$lastInsertedId = $noticiasManager->GetLastInsertedId();

		if ($lastInsertedId) {
			$Noticias->idNoticia = $lastInsertedId;
			$dc->Set($noticiasManager->Get($lastInsertedId), 'Noticias');
		}
	} else {
		$ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
		$ErrorMsn .= "<blockquote>";
		$ErrorMsn .= $ErrorMsg;
		$ErrorMsn .= "</blockquote>";
	}
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['idNoticia'])) {
		$noticiasManager->Get($_GET['idNoticia']);
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
	<title>Gestor de contenidos: Noticias editar</title>
	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link href="css/form.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="scripts/tiny_mce.js" language="javascript"></script>
	<script type="text/javascript" src="js/funciones.js" language="javascript"></script>

	<script language="javascript" type="text/javascript">
		tinyMCE.init({
			height: "250",
			mode: "textareas",
			theme: "advanced",
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
						<li class="liselect"><a href="noticias-editar.php">A&ntilde;adir entrada</a></li>
						<li><a href="noticias.php">Listado</a></li>
					</ul>
				</div>

				<div class="content">
					<div class="form_wrapper">
						<div class="form_container">
							<div class="title_container">
								<h2>Noticias</h2>
							</div>
							<form id="formEntrada" method="post" name="formEntrada" action="noticias-editar.php" onsubmit="EnviarEntradaNoticias(this,'editar');return false;">
								<input type="hidden" name="IDNOTICIA" value="<?= $Noticias->idNoticia; ?>" />
								<div class="row clearfix">
									<div class="col_half">
										<label>Título</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input name="TITULO" type="text" id="TITULO" value="<?= $Noticias->Titulo; ?>" size="106" maxlength="100" />
										</div>
									</div>
									<div class="col_half">
										<label>Entradilla</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<textarea name="ENTRADILLA" cols="80" rows="5" class="mceNoEditor" id="ENTRADILLA"><?php echo $Noticias->Entradilla; ?></textarea>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Fecha noticias</label>
										<div class="input_field">
											<input name="FECHANOTICIA" type="date" id="FECHANOTICIA" placeholder="dd/mm/aaaa" value="<?= $Noticias->FechaNoticia ? $Noticias->FechaNoticia : date("Y-m-d"); ?>" />
										</div>
									</div>
									<div class="col_half">
										<label>Fuente</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input name="FUENTE" type="text" id="FUENTE" value="<?= $Noticias->Fuente; ?>" size="50" />
										</div>
									</div>
								</div>

								<div class="row clearfix">
									<div class="col">
										<label>Cuerpo de la noticia</label>
										<div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

											<textarea name="CUERPO" cols="80" rows="80" id="CUERPO">
												<?= $Noticias->Cuerpo; ?></textarea>
											</textarea>

										</div>
									</div>
								</div>

								<?php if ($Noticias->idNoticia) {
									$imagenUrl = 'location.href="galeria-fotografica.php?Ambito=Noticias&idAmbito=' . $Noticias->idNoticia . '&Campo=idNoticia&NCampo=Noticias&Referer=noticias-editar.php"';
									$documentUrl = 'location.href="galeria-documentos.php?Ambito=Noticias&idAmbito=' . $Noticias->idNoticia . '&Campo=idNoticia&NCampo=Noticias&Referer=noticias-editar.php"';

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
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input type="hidden" name="IDNOTICIA" value="<?php echo $idNoticia; ?>" />
											<button type="submit" class="button" name="ENVIAR" id="ENVIAR">Salvar</button>
										</div>
									</div>
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<?php
											$volver = 'location.href="noticias.php?mostrar=' . $mostrar . '&pagina=' . $pagina . '"';
											?>
											<input type="button" name="VOLVER2" id="VOLVER2" class="button" value="Volver al listado" onclick='<?= $volver ?>' />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</body>

</html>