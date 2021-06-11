<?php

use citcervera\Model\Connections\DB;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

// datos de la entrada del directorio

$db = new DB();

$Ambito = $_GET["Ambito"] ?? '';
$idAmbito = $_GET["idAmbito"] ?? '';
$Campo = $_GET["Campo"] ?? '';
$NCampo = $_GET["NCampo"] ?? '';
$Referer = $_GET["Referer"] ?? '';
$CamposQuery = '';
$ImgNoticia = '';
$ImgUsos = '';
$ImgHabitat = '';
$ImgSetas = '';
$Volver = "$Referer?$Campo=$idAmbito";

$sql = " Select * from $Ambito where $Campo = $idAmbito ";
$ambito = $db->query($sql, 'fetch_object');
$nombreCampo = $ambito[0]->{$NCampo};

$columns = get_object_vars($ambito[0]);

$keys = array();
$columnKeys = array_keys($columns);
$camposImage = array_values(array_filter($columnKeys, function ($ret2) {
	return stripos($ret2, "Img") !== false;
}));

print_r($camposImage );


?>
<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/form.css" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
	<!-- <script type="text/javascript" src="js/jquery.funciones.js"></script> -->
	<!--[if lt IE 9]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<script src="https://use.fontawesome.com/4ecc3dbb0b.js"></script>
	<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
	<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
	<script type="text/javascript">
		function stopUpload() {
			document.getElementById('barracargando').style.visibility = 'hidden';
			document.getElementById('FormImage').style.visibility = 'visible';
			location.href = "galeria-fotografica.php?Ambito=<?php echo $Ambito; ?>&idAmbito=<?php echo $idAmbito; ?>&Campo=<?php echo $Campo; ?>&NCampo=<?php echo $NCampo; ?>&Referer=<?php echo $Referer; ?>";
			return true;
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


	<div id="contenido" class="wrapper">
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
				<div id="barracargando" style="visibility:hidden">Cargando fotos...<br /><img src="images/loader.gif" /></div>
				<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>
				<div class="content">
					<div class="form_wrapper">
						<div class="form_container" id="FormImage">
							<div class="title_container">
								<h2>Galeria de imagenes de <?php echo $nombreCampo; ?></h2>
							</div>
							<form method="post" enctype="multipart/form-data" id="uploadform">
								<input type="hidden" name="IDAMBITO" value="<?php echo $idAmbito; ?>" />
								<input type="hidden" name="AMBITO" value="<?php echo $Ambito; ?>" />
								<input type="hidden" name="TITULOS" value="" />
								<input type="hidden" name="PIES" value="" />
								<div class="row clearfix">
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-o"></i></span>
											<input type="file" name="foto[]" onchange="document.getElementById('moreUploadsLink').style.display = 'block';" />
										</div>
									</div>
									<div class="col_half">
										<label>Titulo</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-text"></i></span>
											<input name="TITULO" type="text" size="50" />
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label></label>

									</div>
									<div class="col_half">
										<label>Pie</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-text"></i></span>
											<input name="PIE" type="text" size="50" />
										</div>
									</div>
								</div>
								<div id="moreUploads"></div>
								<div class="row clearfix" id="moreUploadsLink" style="display:none;">
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-picture-o"></i></span>
											<input type="button" name="ADDIMAGE" id="ADDIMAGE" class="button" value="Más imagenes" onclick='addFileInput("foto[]");' />
										</div>
									</div>
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-title"></i></span>

										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col_half">
										<label></label>
									</div>
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-upload"></i></span>
											<input type="button" name="SUBIRIMG" id="SUBIRIMG" class="button" value="Subir Imagen" onclick='uploadFile("Img");startUpload();' />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="content">
					
					<div class="image_wrapper" id="draggableArea"  >

						<?php
						// datos de la entrada del directorio


						for ($i = 0; $i < sizeof($camposImage); $i++) {
							$CamposQuery .= ", AM." . $camposImage[$i];
						}

						$sql = " SELECT Img.* $CamposQuery FROM Imagenes as Img "
							. " inner join $Ambito as AM on Img.idAmbito = AM.$Campo "
							. " WHERE Ambito = '$Ambito' AND idAmbito = $idAmbito ";
						$sql .= " order by Img.Orden, Img.idImagen ";

						$list = $db->query($sql, 'fetch_object');
						$max = count($list);

						if ($max > 0) {

							foreach ($list as $imagen) {

								$idImagen  	 	= $imagen->idImagen ?? '';
								$Ambito  	 	= $imagen->Ambito ?? '';
								$idAmbito  	 	= $imagen->idAmbito ?? '';
								$Archivo 		= $imagen->Archivo ?? '';
								$Path 			= $imagen->Path ?? '';
								$Tipo 			= $imagen->Tipo ?? '';
								$Tamano 		= $imagen->Tamano ?? '';
								$Ancho 			= $imagen->Ancho ?? '';
								$Alto 			= $imagen->Alto ?? '';
								$Titulo 		= $imagen->Titulo ?? '';
								$Pie 			= $imagen->Pie ?? '';
								$AltoThumb 		= $imagen->AltoThumb ?? '';
								$AnchoThumb 	= $imagen->AnchoThumb ?? '';
								$Fecha 			= $imagen->Fecha ?? '';
								$Publicar 		= $imagen->Publicar ?? '';
								$ImgDescripcion = $imagen->ImgDescripcion ?? '';
								$ImgHistoria 	= $imagen->ImgHistoria ?? '';
								$ImgFlora 		= $imagen->ImgFlora ?? '';
								$ImgFauna 		= $imagen->ImgFauna ?? '';
								$ImgAgenda 		= $imagen->ImgAgenda ?? '';

						?>
								<div class="dragChild form_container" id="FormImage<?= $idImagen ?>">
									<div class="row clearfix">
										<div class="col_half">
											<label></label>
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-o"></i></span>
												<img src="<?php echo str_replace("images", "thumb", "../" . $Path . "/" . $Archivo); ?>" width="<?= $AnchoThumb ?>" height="<?= $AltoThumb ?>" title="<?= $Titulo ?>" />
											</div>
										</div>
										<div class="col_half">
											<label></label>
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-text"></i></span>
												<ul>
													<li>Fecha: <?= $Fecha ?></li>
													<li>Archivo: <?= $Archivo ?></li>
													<li>Anchura: <?= $Ancho ?> px.</li>
													<li>Tama&ntilde;o: <?= $Tamano ?></li>
													<li>Altura: <?= $Alto ?> px.</li>
													<form name="formImagen<?= $idImagen ?>">
														<li class="">
															<span onclick="Editar('TITULO',<?= $idImagen ?>);" onmouseover="this.style.cursor='pointer';" alt="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto" title="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto"><strong>T&iacute;tulo (m&aacute;x 100): </strong></span><span id="TITULO<?= $idImagen ?>" onclick="Editar('TITULO',<?= $idImagen ?>);" onmouseover="this.style.cursor='pointer';"><?= $Titulo ?></span>
															<input type="text" name="TITULO" value="<?= $Titulo ?>" style="display:none" disabled="disabled" onblur="GuardarDatos('TITULO',<?= $idImagen ?>);" onchange="TextoModificado=true;" width="100%" maxlength="100" class="textoimagen" />
														</li>
														<li class=""><span onclick="Editar('PIE',<?= $idImagen ?>);" onmouseover="this.style.cursor='pointer';" alt="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto\" title="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto"><strong>Pie de foto (m&aacute;x 250): </strong></span><span id="PIE<?= $idImagen ?>" onclick="Editar('PIE',<?= $idImagen ?>);" onmouseover="this.style.cursor='pointer';"><?= $Pie ?></span>
															<textarea name="PIE" cols="45" rows="2" disabled="disabled" style="display:none" onblur="GuardarDatos('PIE',<?= $idImagen ?>);" onchange="TextoModificado=true;" class="textoimagen"></textarea>
														</li>
														<li class="input_field">
															<strong>Publicar: </strong>
															<input type="checkbox" name="PUBLICAR" value="<?= $idImagen ?>" onclick="Publicar(<?= $idImagen ?>,this);" <?= ($Publicar) ? "checked" : ""; ?> />
														</li>
														<li>
															<img onmouseover="this.style.cursor='pointer';" src="images/eliminarfoto.gif" alt="Eliminar foto" width="50" height="25" onClick="EliminarImagen(<?= $idImagen ?>)" />
														</li>
													</form>
												</ul>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						}
						?>
					</div>
				</div>
			</div>
			<?php
			//include("./footer.php");
			?>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/draganddrop.js"></script>

</html>