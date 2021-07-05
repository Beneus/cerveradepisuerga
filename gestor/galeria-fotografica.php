<?php

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
	
	<script type="text/javascript">
		var TextoModificado = false;
		$(document).ready(function() {

			function load() {
				$.ajax({
					type: 'GET',
					url: 'img-list.php',
					data: '<?= $_SERVER['QUERY_STRING'] ?>',
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						$('#draggableArea').html(data);
					}
				});
			}

			function EliminarImg(idImagen) {
				$.ajax({
					type: 'GET',
					url: 'img-delete.php',
					data: 'idImagen=' + idImagen,
					success: function(data) {
						$('#FormImage' + idImagen).remove();
					}
				})

			}

			function GuardarDatos(idspan, idImg, value) {
				if (TextoModificado) {
					document.getElementById("espere").style.display = "block";
					cad = "IDIMAGEN=" + idImg + "&CAMPO=" + idspan + "&" + idspan.toUpperCase() + "=" + value;
					FAjax('img-editar.php', 'espere', cad, 'post');
				} 
			}

			//------------------------------------------------------------------------

			$(document).on('click', '.span-titulo-content', function(evt) {
				var form = $(this).closest('form');
				var texto = $(this).text();
				$("input[name='TITULO']", form)
					.val($.trim(texto))
					.show()

					.prop("disabled", false).focus();

				evt.preventDefault();
				return false;
			});

			$(document).on('click', '.span-pie-content', function(evt) {
				var form = $(this).closest('form');
				var texto = $(this).text();
				$("textarea[name='PIE']", form)
					.val($.trim(texto))
					.show()

					.prop("disabled", false).focus();

				evt.preventDefault();
				return false;
			});

			$(document).on('click', '.span-titulo', function(evt) {
				var form = $(this).closest('form');
				var texto = $(this).next('span').text();
				$("input[name='TITULO']", form)
					.val($.trim(texto))
					.show()
					.prop("disabled", false).focus();

				evt.preventDefault();
				return false;
			});

			$(document).on('click', '.span-pie', function(evt) {
				var form = $(this).closest('form');
				var texto = $(this).next('span').text();
				$("textarea[name='PIE']", form)
					.val($.trim(texto))
					.show()
					.prop("disabled", false).focus();

				evt.preventDefault();
				return false;
			});

			$(document).on('blur', '.textoimagen', function(evt) {
				$(this)
					.hide()
					.prop("disabled", true).focus();

				GuardarDatos($(this).attr('name'),$(this).attr('idImagen'), $(this).val());
				$(this).prev('span').text($(this).val());
				TextoModificado = false;
				evt.preventDefault();
				return false;
			});

			$(document).on('change', '.textoimagen', function(evt) {
				TextoModificado = true;
			});

			load();

			$('#buttonUp').on('click', function(e) {
				$('#uploadform').submit();
				e.preventDefault();
				return false;
			});

			function progress(evt) {
				if (evt.lengthComputable) {
					var percentComplete = (evt.loaded / evt.total) * 100;
					$('.progress-bar').css('width', percentComplete + '%').attr('aaria-valuenowial', percentComplete);
				}
			}

			$('#uploadform').on('submit', function(e) {
				var formData = new FormData(this);
				$('#progress').show();
				$.ajax({
					type: 'POST',
					url: 'img-upload.php',
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
						console.log(data);
						$('#moreUploads').html('');
						load();
					}
				})
				e.preventDefault();
				return false;
			});

			$(document).on('click', '.delete', function(evt) {
				EliminarImg($(this).attr('idImagen'));
				evt.preventDefault();
				return false;

			});

			
        
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
											<input name="TITULOS[]" type="text" size="50" />
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
											<input name="PIES[]" type="text" size="50" />
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
										<div class="input_field">
											<span>
												<i aria-hidden="true" class="fa fa-title"></i>
											</span>

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
											<button class="button" id="buttonUp">Subir imagen</button>

										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="image_wrapper" id="draggableArea">
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>