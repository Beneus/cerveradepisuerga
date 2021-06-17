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
$camposQuery = '';
$Volver = "$Referer?$Campo=$idAmbito";



$sql = " Select * from $Ambito where $Campo = $idAmbito ";
$ambito = $db->query($sql, 'fetch_object');
$nombreCampo = $ambito[0]->{$NCampo};

$columns = get_object_vars($ambito[0]);

$keys = array();
$columnKeys = array_keys($columns);
$camposDoc = array_values(array_filter($columnKeys, function ($ret2) {
	return stripos($ret2, "Doc") !== false;
}));

?>
<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link rel="stylesheet" href="css/form.css" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
	<!-- <script type="text/javascript" src="js/jquery.funciones.js"></script> -->
	<!--[if lt IE 9]> <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
	<script src="https://use.fontawesome.com/4ecc3dbb0b.js"></script>
	<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
	<script type="text/javascript" src="js/uploader.js" language="javascript"></script>
	<script type="text/javascript">
		function stopUpload() {
			document.getElementById('barracargando').style.visibility = 'hidden';
			document.getElementById('FormImage').style.visibility = 'visible';
			location.href = "galeria-documentos.php?Ambito=<?php echo $Ambito; ?>&idAmbito=<?php echo $idAmbito; ?>&Campo=<?php echo $Campo; ?>&NCampo=<?php echo $NCampo; ?>&Referer=<?php echo $Referer; ?>";
			return true;
		}
	</script>


	<script type="text/javascript">
		$(document).ready(function() {
			$('#buttonUp').on('click', function(e) {
				$('#uploadform').submit();
				e.preventDefault();
				return false;
			});
			$('#uploadform').on('submit', function(e) {
				var formData = new FormData(this);
				$('#progress').show();
				$.ajax({
					type: 'POST',
					url: 'doc-upload.php',
					data: formData,
					xhr: function() {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", progress, false);
						return xhr;
					},

					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						//console.log(data);
						$('#moreUploads').html('');
					}
				})
				e.preventDefault();
				return false;
			});

			function progress(evt) {
				if (evt.lengthComputable) {
					var percentComplete = (evt.loaded / evt.total) * 100;
					$('.progress-bar').css('width', percentComplete + '%').attr('aaria-valuenowial', percentComplete);

				}

			}
			$('#ADDMORE').click(function(evt) {
				$('.document:last').clone().appendTo('#moreUploads');
				evt.preventDefault();
				return false;
			});

			$('.eliminar-doc').on('click', function(evt) {

				EliminarDoc($(this).attr('idDoc'));
				evt.preventDefault();
				return false;

			})

			function EliminarDoc(idDoc) {
				$.ajax({
					type: 'GET',
					url: 'doc-delete.php?idDoc=' + idDoc,
					data: 'idDoc=' + idDoc,
					xhr: function() {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", progress, false);
						return xhr;
					},

					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						//console.log(data);
					}
				})

			}



		});
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
				<div id="barracargando" style="visibility:hidden">Cargando documento...<br /><img src="images/loader.gif" /></div>
				<div class="content">
					<div class="form_wrapper">
						<div class="form_container" id="FormImage">
							<div class="title_container">
								<h2>Documentos de <?php echo $nombreCampo; ?></h2>
							</div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">70% Complete</span>
								</div>
							</div>
							<form enctype="multipart/form-data" id="uploadform">
								<input type="hidden" name="IDAMBITO" value="<?php echo $idAmbito; ?>" />
								<input type="hidden" name="AMBITO" value="<?php echo $Ambito; ?>" />
								<div class="document">
									<div class="row clearfix">
										<div class="col_half">
											<label></label>
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-o"></i></span>
												<input type="file" name="DOCUMENTS[]" name="DOC" />
											</div>
										</div>
										<div class="col_half">
											<label>T&iacute;tulo del documento (m&aacute;x 100)</label>
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-text"></i></span>
												<input name="TITULOS[]" type="text" size="50" />
											</div>
										</div>
									</div>

									<div class="row clearfix">
										<div class="col_half">
										</div>
										<div class="col_half">
											<label>Pie del documento (m&aacute;x 250)</label>
											<div class="input_field"> <span><i aria-hidden="true" class="fa fa-file-text"></i></span>
												<input name="PIES[]" type="text" size="50" />
											</div>
										</div>
									</div>
								</div>
								<div id="moreUploads"></div>
								<div class="row clearfix">
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-picture-o"></i></span>
											<button class="button" id="ADDMORE">Otro documento</button>
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
											<button class="button" id="buttonUp">Subir documentos</button>
										</div>
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>


				<div class="content">

					<div class="image_wrapper" id="draggableArea">

						<?php
						// datos de la entrada del directorio


						for ($i = 0; $i < sizeof($camposDoc); $i++) {
							$camposQuery .= ", AM." . $camposDoc[$i];
						}

						$sql = " SELECT Doc.* $camposQuery FROM Documentos as Doc "
							. " inner join $Ambito as AM on Doc.idAmbito = AM.$Campo "
							. " WHERE Ambito = '$Ambito' AND idAmbito = $idAmbito ";
						$sql .= " order by Doc.Orden, Doc.idDoc ";

						$list = $db->query($sql, 'fetch_object');
						$max = count($list);

						if ($max > 0) {

							foreach ($list as $doc) {

								$idDoc  	 	= $doc->idDoc;
								$Ambito  	 	= $doc->Ambito;
								$idAmbito  	 	= $doc->idAmbito;
								$Archivo 		= $doc->Archivo;
								$Path 			= $doc->Path;
								$Tipo 			= $doc->Tipo;
								$Tamano 		= $doc->Tamano;
								$Titulo 		= $doc->Titulo;
								$Pie 			= $doc->Pie;
								$Orden 			= $doc->Orden;
								$Fecha 			= $doc->Fecha;
								$Publicar 		= $doc->Publicar;
								$DocDescripcion = $doc->ImgDescripcion ?? '';
								$DocHistoria 	= $doc->DocHistoria ?? '';
								$DocFlora 		= $doc->DocFlora ?? '';
								$DocFauna 		= $doc->DocFauna ?? '';
								$DocAgenda 		= $doc->DocAgenda ?? '';


						?>

								<div class="galeriaImagen" id="Doc<?= $idDoc ?>">
									<div class="Imagen">
									</div>;
									<div class="DatosImagen">
										<ul>
											<li>Fecha: <?= $Fecha ?></li>
											<li>Archivo: <?= $Archivo ?></li>
											<li>Tama&ntilde;o: <?= $Tamano ?></li>

											<form name="formImagen<?= $idDoc ?>">
												<li class="">
													<span onclick="Editar('TITULO',<?= $idDoc ?>);" onmouseover="this.style.cursor='pointer';" alt="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto" title="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el t&iacute;tulo de la foto"><strong>T&iacute;tulo (m&aacute;x 100): </strong></span><span id="TITULO<?= $idDoc ?>" onclick="Editar('TITULO',<?= $idDoc ?>);" onmouseover="this.style.cursor='pointer';"><?= $Titulo ?></span>
													<input type="text" name="TITULO" value="<?= $Titulo ?>" style="display:none" disabled="disabled" onblur="GuardarDatos('TITULO',<?= $idDoc ?>);" onchange="TextoModificado=true;" width="100%" maxlength="100" class="textoimagen" />
												</li>
												<li class=""><span onclick="Editar('PIE',<?= $idDoc ?>);" onmouseover="this.style.cursor='pointer';" alt="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto\" title="Hacer click con el bot&oacute;n derecho del rat&oacute;n para editar el pie de foto"><strong>Pie de foto (m&aacute;x 250): </strong></span><span id="PIE<?= $idDoc ?>" onclick="Editar('PIE',<?= $idDoc ?>);" onmouseover="this.style.cursor='pointer';"><?= $Pie ?></span>
													<textarea name="PIE" cols="45" rows="2" disabled="disabled" style="display:none" onblur="GuardarDatos('PIE',<?= $idDoc ?>);" onchange="TextoModificado=true;" class="textoimagen"></textarea>
												</li>
												<li class="input_field">
													<strong>Publicar: </strong>
													<input class="publicar-doc" type="checkbox" name="PUBLICAR" value="<?= $idDoc ?>" onclick="PublicarDoc(<?= $idDoc ?>,this);" <?= ($Publicar) ? "checked" : ""; ?> />
												</li>
												<?php
												for ($i = 0; $i < sizeof($camposDoc); $i++) {
													$checked = "";
													$area = "";
													switch ($camposDoc[$i]) {
														case 'DocDescripcion':
															if ($DocDescripcion == $idDoc) {
																$checked = "checked";
															}
															$area = "Descripcion";
															break;
														case 'DocHistoria':
															if ($DocHistoria == $idDoc) {
																$checked = "checked";
															}
															$area = "Historia";
															break;
														case 'DocFlora':
															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "Flora";
															break;
														case 'DocFauna':
															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "Fauna";
															break;
														case 'DocUsos':
															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "";
															break;
														case 'DocHabitat':
															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "Habitat";
															break;
														case 'DocSetas':
															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "Setas";
															break;
														case 'DocNoticia':
															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "Noticia";
															break;
														case 'DocAgenda':

															if ($DocFlora == $idDoc) {
																$checked = "checked";
															}
															$area = "Agenda";
															break;
													}

												?>
													<li>
														<strong><?= $area ?> </strong>
														<input type="checkbox" name="<?= $area ?>" value="<?= $idDoc ?>" onclick="AsociarImagen('<?= $camposDoc[$i] ?>',<?= $idDoc ?>,'<?=$Ambito?>',this,'<?=$Campo?>',<?= $idAmbito ?>);" <?= $checked ?> />
													</li>
												<?php
												}
												?>
												<li>
													<strong>Intercambiar posici&oacute;n: </strong><input type="checkbox" name="POSICION" value="<?=$idDoc?>" onclick="IntercambiarDoc(this);" />
												</li>
												<li>
													<img onmouseover="this.style.cursor='pointer';" src="images/eliminarfoto.gif" alt="Eliminar foto" width="50" height="25" onClick="EliminarImagen(<?= $idDoc ?>)" />
												</li>
											</form>
										</ul>
									</div>
								</div>
							<?php
							}
							?>
							<nobr clear="left"></nobr>
						<?php
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

</html>