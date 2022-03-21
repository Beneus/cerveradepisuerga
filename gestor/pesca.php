<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'pesca-editar.php';
$listPage = 'pesca.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Pesca';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();

$ErrorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$entity->_POST();

	if ($ErrorMsg == "") {
		$entity->Fecha = date("Y-m-d H:m:s");
		$entityManager->Save($entity);
		$lastInsertedId = $entityManager->GetLastInsertedId();
		if ($lastInsertedId) {
			$entity->$entityId = $lastInsertedId;
			$dc->Set($entityManager->Get($lastInsertedId), $entityTable);
		}
	} else {
		$ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:"
			. "<ul>"
			. $ErrorMsg
			. "</ul>";
	}
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$entityManager->Get(0);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link href="css/form.css" rel="stylesheet" type="text/css" />
	<meta charset=UTF-8 />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
	<!--[if lt IE 9]> <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<script src="https://kit.fontawesome.com/baa3bdeae8.js" crossorigin="anonymous"></script>
	<script src="https://cdn.tiny.cloud/1/83pnziyrx0kiq1bgkbpgrc19n68sqvirdkp71te4e9vmqb5e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#DESCRIPCION'
		});
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
						<li class="liselect"><a title="A&ntilde;adir introducci&oacute;n" href="pesca.php">Editar introducción</a></li>
						<li><a title="A&ntilde;adir tramo de pesca" href="pesca-entrada.php">A&ntilde;adir entrada tramo de pesca</a></li>
						<li><a title="Listado del directorio" href="pesca-listado.php">Listado tramo de pesca</a></li>
					</ul>
				</div>
				<div class="content">
					<div class="form_wrapper">
						<div class="form_container">
							<div class="title_container">
								<h2><?= $entityTable ?></h2>
							</div>
							<form enctype="multipart/form-data" name="formEntrada" id="formEntrada" method="POST">
								<input type="hidden" name="<?= strtoupper($entityId) ?>" value="<?= $entity->$entityId; ?>" />
								<div class="row clearfix">
									<div class="col">
										<label>Contenido</label>
										<div class="textarea_field">
											<span><i class="fa-solid fa-message"></i></span>
											<textarea name="DESCRIPCION" cols="80" rows="40" placeholder="Notas del evento" id="DESCRIPCION">
												<?= $entity->Descripcion; ?>
											</textarea>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<div class="input_field">
										</div>
									</div>
									<div class="col_half">
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-save"></i></span>
											<button id="ENVIAR">Salvar</button>
										</div>
									</div>
								</div>
								<?php
								$imagenUrl = 'location.href="galeria-fotografica.php?Ambito=' . $entityTable . '&idAmbito=' . $entity->$entityId . '&Campo=' . $entityId . '&NCampo=' . $entityTable . '&Referer=' . $currentPage . '"';
								$documentUrl = 'location.href="galeria-documentos.php?Ambito=' . $entityTable . '&idAmbito=' . $entity->$entityId . '&Campo=' . $entityId . '&NCampo=' . $entityTable . '&Referer=' . $currentPage . '"';
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

								?>
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