<?php
include("includes/funciones.php");
include("includes/Conn.php");

$idMuseo = $_GET["idMuseo"] ?? '';
$msnError = '';

use citcervera\Model\Entities\Museos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Entities\Documentos;
use citcervera\Model\Entities\NucleosUrbanos;

$currentPage = curPageName();

$dc = new DataCarrier();
$Manager = new Manager(new Museos());
$entity = $Manager->Get($idMuseo);
$dc->Set($entity, $entity->GetTable());

$sqlImg = "select * from NucleosUrbanos where idNucleoUrbano = " . $entity->idNucleoUrbano;
$nucleoUrbano = $Manager->Query($sqlImg, 'fetch_object', new NucleosUrbanos());
$dc->Set($nucleoUrbano, 'NucleosUrbanos');

$sql = "select * from Imagenes where Ambito = 'Museos' and idAmbito = $entity->idMuseo and Publicar = 1 order by Orden";
$image = $Manager->Query($sql, 'fetch_object', new Imagenes());

$dc->Set($image, 'Imagenes');

$sql = "select * from Documentos where Ambito = 'Museos' and idAmbito = $entity->idMuseo and Publicar = 1 order by Orden";
$documentos = $Manager->Query($sql, 'fetch_object', new Documentos());

$dc->Set($documentos, 'Documentos');

function GetDescripcion($descripcion)
{
	echo html_entity_decode($descripcion);
}


function RenderDocumentos($dc)
{
	if ($dc->GetEntities('Documentos')) {
?>
		<h3>Documentos</h3>
		<ul>
			<?php
			foreach ($dc->GetEntities('Documentos') as $doc) {
			?>
				<li>
					<a href="<?= '../files/' . $doc->Path . '/' . $doc->Archivo; ?>"><?= $doc->Archivo; ?></a>
				</li>
			<?php
			}
			?>
		</ul>
	<?php
	}
}


function RenderGaleria($dc, $ambito, $idAmbito, $currentPage)
{

	if ($dc->GetEntities('Imagenes')) {
	?>
		<a href='galeriafotografica.php?Ambito=<?= $ambito ?>&amp;idAmbito=<?= $idAmbito ?>&amp;Origen=<?= $currentPage; ?>&amp;Campo=idMuseo'>
			<h3>Galería fotográfica</h3>
		</a>
<?php
	}
}

function GetImageDescription($dc, $imgDescripcion)
{
	foreach ($dc->GetEntities('Imagenes') as $imagen) {
		if ($imagen->idImagen == $imgDescripcion) {
			PrintImage($imagen);
			break;
		}
	}
}

function PrintImage($imagen)
{
	if ($imagen) {
		$Path = $imagen->Path;
		$Archivo = $imagen->Archivo;
		$Titulo = $imagen->Titulo;
		$Pie = $imagen->Pie;
		$Ancho = $imagen->Ancho;
		$Alto = $imagen->Alto;
		$AnchoThumb = $imagen->AnchoThumb;
		$AltoThumb = $imagen->AltoThumb;
		echo "<a href='../files/$Path/$Archivo'  class='lightbox' title='$Titulo' hreflang='es' ><img src=\"../files/$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
	}
}

$MetaTitulo = $entity->Museo . " en " . $nucleoUrbano[0]->NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo . ", direccion:" . $entity->Direccion . ", " . $entity->Tema . ", abierto: " . $entity->Tipo . ", Horario: " . $entity->Horario . ", Responsable: " . $entity->Responsable;
$MetaKeywords = $entity->Museo . ", " . $nucleoUrbano[0]->NombreNucleoUrbano . ", " . $entity->Direccion . ", " . $entity->Tema . ", " . $entity->Tipo . ", " . $entity->Horario . ", " . $entity->Tipo . ", " . $entity->Responsable;
?>
<!DOCTYPE html>
<html>

<head>
	<?php
	include('./head.php');
	?>

	<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
	<script type="text/javascript">
		html = '<div style="width:210px; padding-right:10px;text-align: left;"><img src="iconos/museos.png" alt="Museos de la Monta�a Palentina" width="32" height="32" hspace="10" />' +
			'<strong><?= $entity->Museo; ?></strong><br/><?= $entity->Tema; ?></div>';
		var Latitud = "<?= $entity->Latitud; ?>";
		var Longitud = "<?= $entity->Longitud; ?>";
	</script>
	<script src="js/googlemapsmuseo.js" type="text/javascript"></script>
</head>

<body>
	<div class="wrapper">
		<?php
		include('./header.php');
		include("./menu.php");
		?>
		<div class="grid container">
			<?php
			include('./aside1.php');
			include('./aside2.php');
			?>

			<div class="main">
				<div class="content">
					<h2><img src="iconos/museos.png" alt="Museos de la Montaña Palentina" title="Museos de la Montaña Palentina" width="32" height="32" class="iconosimagen" /> Museos</h2>
					<div class="MigasdePan">
						<a title="Qu´2 ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt;
						<a href="museos.php" title="Museos">Museos</a> &gt;
						<a href="museos-detalle.php?idMuseo=<?= $entity->idMuseo; ?>" title="<?= $entity->Museo; ?>"><?= $entity->Museo; ?></a>
					</div>
				</div>
				<div class="content">
					<h1><?= $entity->Museo; ?></h1>
					<div class="museo">

						<ul>
							<?php if ($entity->Tipo == "TEMPORAL") { ?>
								<li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?= $entity->Tema; ?></span></li>
							<?php
							} else { ?>
								<li><span class="DatosTitulo">Tema</span><span class="DatosValor"><?= $entity->Tema; ?></span></li>
							<?php
							} ?>
							<?php if ($entity->Direccion != "") { ?>
								<li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?= $entity->Direccion; ?></span></li>
							<?php } ?>
							<?php if ($entity->idNucleoUrbano != "") { ?>
								<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?= $entity->idNucleoUrbano; ?>" title="<?= $nucleoUrbano[0]->NombreNucleoUrbano; ?>"><?= $nucleoUrbano[0]->NombreNucleoUrbano; ?></a></span></li>
							<?php } ?>
							<?php if ($entity->Horario != "") { ?>
								<li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?= $entity->Horario; ?></span></li>
							<?php } ?>
							<?php if ($entity->Telefono != "") { ?>
								<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($entity->Telefono); ?></span></li>
							<?php } ?>
							<?php if ($entity->Tipo != "") { ?>
								<li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?= $entity->Tipo; ?></span></li>
							<?php } ?>
							<?php if (!is_null($entity->FechaInauguracion)) { ?>
								<li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?= $entity->FechaInauguracion; ?></span></li>
							<?php
							}
							if (!is_null($entity->FechaClausura)) { ?>
								<li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?= $entity->FechaClausura; ?></span></li>
							<?php
							}
							if ($entity->Email != "") { ?>
								<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?= $entity->Email; ?></span></li>
							<?php }
							if ($entity->URL != "") { ?>
								<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?= $entity->URL; ?>" title="<?= $entity->Museo; ?>" target="_blank"><?= $entity->URL; ?></a></span></li>
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="content">
					<?php

					if ($entity->Descripcion != "") {
					?>
						<h3>Descripción</h3>
						<div class="museo">
							<?php
							GetImageDescription($dc, $entity->ImgDescripcion);
							GetDescripcion($entity->Descripcion);
							?>
						</div>
					<?php
					}
					RenderGaleria($dc, 'Museos', $entity->idMuseo, $currentPage);
					RenderDocumentos($dc, 'Museos', $entity->idMuseo)
					?>
				</div>

				<div class="content">
					<div id="mapa" style="width: 100%; height: 300px"></div>
				</div>
				<br class="limpiar" />
				<?php
				include("./sponsors.php");
				?>
			</div>
			<?php
			include("./footer.php");
			?>
		</div>
	</div>
</body>

</html>