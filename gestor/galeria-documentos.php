<?php
$Ambito = $_GET["Ambito"] ?? '';
$idAmbito = $_GET["idAmbito"] ?? '';
$Campo = $_GET["Campo"] ?? '';
$NCampo = $_GET["NCampo"] ?? '';
$Referer = $_GET["Referer"] ?? '';
$camposQuery = '';
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

			function load() {
				$.ajax({
					type: 'GET',
					url: 'doc-list.php',
					data: '<?= $_SERVER['QUERY_STRING'] ?>',
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						$('#draggableArea').html(data);
					}
				});
			}


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
						load();
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

			$(document).on('click', '#ADDMORE', function(evt) {
				$('.document:last').clone().appendTo('#moreUploads');
				evt.preventDefault();
				return false;
			});

			$(document).on('click', '.delete', function(evt) {

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
						$('#Doc' + idDoc).remove();
					}
				})

			}


			load();
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
										<div class="input_field"> 
											<span><i aria-hidden="true" class="fa fa-title"></i><
												/span>
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