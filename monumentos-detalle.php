<?php
include("includes/funciones.php");
include("includes/Conn.php");

$idMonumento = $_GET["idMonumento"] ?? '';
$msnError = '';

use citcervera\Model\Entities\Monumentos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Entities\Documentos;

$dc = new DataCarrier();
$Manager = new Manager(new Monumentos());
$item = $Manager->Get($idMonumento);
$dc->Set($item, 'Museos');

$sqlImg = "select * from NucleosUrbanos where idNucleoUrbano = " . $item->idNucleoUrbano;
$nucleoUrbano = $Manager->Query($sqlImg, 'fetch_object', new NucleosUrbanos());
$dc->Set($nucleoUrbano, 'NucleosUrbanos');

$sql = "select * from Imagenes where Ambito = 'Monumentos' and idAmbito = $item->idMonumento and Publicar = 1 order by Orden";
$image = $Manager->Query($sql, 'fetch_object', new Imagenes());
$dc->Set($image, 'Imagenes');

$sql = "select * from Documentos where Ambito = 'Monumentos' and idAmbito = $item->idMonumento and Publicar = 1 order by Orden";
$documentos = $Manager->Query($sql, 'fetch_object', new Documentos());
$dc->Set($documentos, 'Documentos');



function GetDescripcion($descripcion)
{
	echo html_entity_decode($descripcion);
}

function RenderGaleria($dc, $ambito, $idAmbito)
{

	if ($dc->GetEntities('Imagenes')) {
		echo "<a href='galeriafotografica.php?Ambito=$ambito&amp;idAmbito=$idAmbito&amp;Origen=museos-detalle.php&amp;Campo=idMonumento'>";
		echo "<h3>Galería fotográfica</h3>";
		echo "</a>";
	}
}

function RenderDocumentos($dc, $ambito, $idAmbito)
{

	if ($dc->GetEntities('Imagenes')) {
		echo "<a href='galeriafotografica.php?Ambito=$ambito&amp;idAmbito=$idAmbito&amp;Origen=museos-detalle.php&amp;Campo=idMonumento'>";
		echo "<h3>Galería fotográfica</h3>";
		echo "</a>";
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

$MetaTitulo = $item->Monumento . " en " . $nucleoUrbano[0]->NombreNucleoUrbano;
$MetaDescripcion = $MetaTitulo . ", direccion:" . $item->Direccion . ",  abierto: " . $item->Tipo . ", Horario: " . $item->Horario . ", Responsable: " . $item->Responsable;
$MetaKeywords = $item->Monumento . ", " . $nucleoUrbano[0]->NombreNucleoUrbano . ", " . $item->Direccion . ", " . $item->Tipo . ", " . $item->Horario . ", " . $item->Tipo . ", " . $item->Responsable;

?>
<!DOCTYPE html>
<html>

<head>
	<?php
	include('./head.php');
	?>
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
					<h2><img src="iconos/monumentos.png" alt="Monumentos en la Montaña Palentina" title="Monumentos en la Montaña Palentina" width="32" height="32" class="iconosimagen" /> Monumentos</h2>
					<div class="MigasdePan">
						<a title="Qué ofrecemos" href="que-ofrecemos.php">Qué ofrecemos</a> &gt;
						<a href="monumentos.php" title="Monumentos">Monumentos</a> &gt;
						<a href="monumentos-detalle.php?idMonumento=<?= $item->idMonumento; ?>" title="<?= $item->Monumento; ?>"><?= $item->Monumento; ?></a>
					</div>
				</div>
				<div class="content">
					<?php
					if ($msnError == "") {
					?>
						<h1><?= $item->Monumento; ?></h1>
						<div class="museo">
							<ul>
								<li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?= $item->Direccion; ?></span></li>
								<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?= $item->idNucleoUrbano; ?>" title="<?= $nucleoUrbano[0]->NombreNucleoUrbano; ?>"><?= $nucleoUrbano[0]->NombreNucleoUrbano; ?></a></span></li>
								<?php if ($item->Horario  != "") { ?>
									<li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?= $item->Horario; ?></span></li>
								<?php }
								if ($item->Telefono != "") { ?>
									<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono); ?></span></li>
								<?php } ?>
								<li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?= $item->Tipo; ?></span></li>
								<?php if ($item->Responsable != "") { ?>
									<li><span class="DatosTitulo">Responsable</span><span class="DatosValor"><?= $item->Responsable; ?></span></li>
								<?php }
								if (!is_null($item->FechaInauguracion)) { ?>
									<li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?= $item->FechaInauguracion; ?></span></li>
								<?php }
								if (!is_null($item->FechaClausura)) { ?>
									<li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?= $item->FechaClausura; ?></span></li>
								<?php }
								if ($item->Email != "") { ?>
									<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?= $item->Email; ?></span></li>
								<?php }
								if ($item->URL != "") { ?>
									<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?= $item->URL; ?>" title="<?= $item->Museo; ?>" target="_blank"><?= $item->URL; ?></a></span></li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
				</div>

				<div class="content">
					<?php
					if ($item->Descripcion != "") {
					?>
						<h3>Descripción</h3>
						<div class="museo">
							<?php
							GetImageDescription($dc, $item->ImgDescripcion);
							GetDescripcion($item->Descripcion);
							?>
						</div>
					<?php
					}
					RenderGaleria($dc, 'Monumentos', $item->idMonumento);
					?>
				</div>


				<div class="content">
					<?php
					if ($Descripcion != "") {
						echo "<h3>Descripcion</h3>";
						echo "<div class=\"museo\">";
						if ($ImgDescripcion > 0) {
							$link = ConnBDCervera();
							$sql = "select * from Imagenes where idImagen = $ImgDescripcion and Publicar = 1 ";
							mysqli_query($link, 'SET NAMES utf8');
							$result = mysqli_query($link, $sql);
							if (!$result) {
								$message = "Invalid query" . mysqli_error($link) . "\n";
								$message .= "whole query: " . $sql;
								die($message);
								exit;
							}
							$max = mysqli_num_rows($result);
							if ($max > 0) {
								$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
								$Path = $row["Path"];
								$Archivo = $row["Archivo"];
								$Titulo = $row["Titulo"];
								$Pie = $row["Pie"];
								$Ancho = $row["Ancho"];
								$Alto = $row["Alto"];
								$AnchoThumb = $row["AnchoThumb"];
								$AltoThumb = $row["AltoThumb"];
								echo "<a href=\"$Path/$Archivo\"  class='lightbox' title='$Titulo'><img src=\"../" . $Path . "/" . $Archivo . "\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
							}
							mysqli_free_result($result);
							mysqli_close($link);
						}
						echo $Descripcion;
						echo "</div>";
					}

					// listado de documentos asociados
					$sql = "select * from Documentos where Ambito = 'Monumentos' and idAmbito = $idMonumento and Publicar = 1 order by Orden";
					$link = ConnBDCervera();
					mysqli_query($link, 'SET NAMES utf8');
					$result = mysqli_query($link, $sql);
					if (!$result) {
						$message = "Invalid query" . mysqli_error($link) . "\n";
						$message .= "whole query: " . $sql;
						die($message);
						exit;
					}

					$max = mysqli_num_rows($result);

					if ($max > 0) {
						echo "<h3>Documentos</h3>";
						echo "<div class='museo'><ul>";
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$DocTitulo = $row["Titulo"];
							$DocPie = $row["Pie"];

							if ($DocTitulo != "") {

								echo "<li>";
								echo "<a href=\"" . $row["Path"] . "/" . $row["Archivo"] . "\" title=\"" . $row["Titulo"] . "\">" . $DocTitulo . "</a>";
								if ($DocPie != "") {
									echo "<p>$DocPie</p>";
								}
								echo "</li>";
							} else {
								echo "<li><a href=\"" . $row["Path"] . "/" . $row["Archivo"] . "\" title=\"" . $row["Titulo"] . "\">" . $row["Archivo"] . "</a></li>";
							}
						}
						echo "</ul></div>";
					}
					mysqli_free_result($result);
					?>
				</div>
				

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