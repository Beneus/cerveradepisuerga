<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'noticias-editar.php';
$listPage = 'noticias.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Noticias';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();


$currentPage = curPageName();
$ErrorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$entity->_POST();
	if ($entity->Titulo == "") {
		$ErrorMsg .= "<li class=\"errortexto\">Titulo.</li>";
	}
   if ($entity->FechaNoticia == "") {
		$ErrorMsg .= "<li class=\"errortexto\">Fecha noticia.</li>";
	}
	if ($ErrorMsg == "") {
		$entity->Fecha = date("Y-m-d H:m:s");
		$entityManager->Save($entity);
		$lastInsertedId = $entityManager->GetLastInsertedId();

		if ($lastInsertedId) {
			$entity->idNoticia = $lastInsertedId;
			$dc->Set($entityManager->Get($lastInsertedId), 'Noticias');
		}
	} else {
		$ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:"
			. "<ul>"
			. $ErrorMsg
			. "</ul>";
	}
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if (isset($_GET['idNoticia'])) {
		$entityManager->Get($_GET['idNoticia']);
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

	<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
	<script src="https://kit.fontawesome.com/baa3bdeae8.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tiny.cloud/1/83pnziyrx0kiq1bgkbpgrc19n68sqvirdkp71te4e9vmqb5e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#CUERPO,#ENTRADILLA'
		});
	</script>
</head>

<body>
	<?php
	include('includes/error.php');
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
								<input type="hidden" name="IDNOTICIA" value="<?= $entity->$entityId; ?>" />
								<div class="row clearfix">
									<div class="col">
										<label>Título</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input name="TITULO" type="text" id="TITULO" value="<?= $entity->Titulo; ?>" size="106" maxlength="100" />
										</div>
									</div>
									<div class="col_half">

									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label>Fecha noticias</label>
										<div class="input_field">
											<input name="FECHANOTICIA" type="date" id="FECHANOTICIA" placeholder="dd/mm/aaaa" value="<?= $entity->FechaNoticia ? $entity->FechaNoticia : date("Y-m-d"); ?>" />
										</div>
									</div>
									<div class="col_half">
										<label>Fuente</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input name="FUENTE" type="text" id="FUENTE" value="<?= $entity->Fuente; ?>" size="50" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col">
										<label>Entradilla</label>
										<div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

											<textarea name="ENTRADILLA" cols="80" rows="5" class="mceNoEditor" id="ENTRADILLA"><?php echo $entity->Entradilla; ?></textarea>

										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col">
										<label>Cuerpo de la noticia</label>
										<div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

											<textarea name="CUERPO" cols="80" rows="80" id="CUERPO">
												<?= $entity->Cuerpo; ?></textarea>
											</textarea>

										</div>
									</div>
								</div>

								<?php if ($entity->idNoticia) {
									$imagenUrl = 'location.href="galeria-fotografica.php?Ambito=Noticias&idAmbito=' . $entity->idNoticia . '&Campo=idNoticia&NCampo=Noticias&Referer=noticias-editar.php"';
									$documentUrl = 'location.href="galeria-documentos.php?Ambito=Noticias&idAmbito=' . $entity->idNoticia . '&Campo=idNoticia&NCampo=Noticias&Referer=noticias-editar.php"';

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
											<button type="submit" class="button" name="ENVIAR" id="ENVIAR">Salvar</button>
										</div>
									</div>
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<?php
											$volver = 'location.href="' . $listPage . '?mostrar=' . $mostrar . '&pagina=' . $pagina . '"';
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