<?php
include("includes/funciones.php");
include("includes/Conn.php");

use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$Manager = new Manager();


$FechaNoticia = '';
$Titulo = '';
$Entradilla = '';
$ImgNoticia = '';
$DocNoticia = '';
$Fuente = '';
$Cuerpo = '';
$DocNoticia = '';

$idNoticia = $_GET["idNoticia"] ?? '';
$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT NOTI.*, IM.Path as ImgPath, IM.Archivo as ImgArchivo, IM.AnchoThumb, IM.AltoThumb, IM.Titulo as ImgTitulo, IM.Pie as ImgPie, DOC.Path as DocPath, DOC.Archivo as DocArchivo FROM Noticias as NOTI "
	. " left join Imagenes as IM on NOTI.ImgNoticia = IM.idImagen "
	. " left join Documentos as DOC ON NOTI.docNoticia = DOC.idDoc where idNoticia = $idNoticia ";



//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

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
	$FechaNoticia = date("d/m/Y", strtotime($row["FechaNoticia"]));
	$Titulo = $row["Titulo"] ?? '';
	$Entradilla = $row["Entradilla"];
	$ImgNoticia = $row["ImgNoticia"];
	$DocNoticia = $row["DocNoticia"];
	$Fuente = $row["Fuente"];
	$Cuerpo = html_entity_decode($row["Cuerpo"]);

	$ImgArchivo = $row["ImgArchivo"];
	$ImgPath = $row["ImgPath"];
	$AnchoThumb = $row["AnchoThumb"];
	$AltoThumb = $row["AltoThumb"];
	$DocArchivo = $row["DocArchivo"];
	$DocPath = $row["DocPath"];
	$ImgTitulo = $row["ImgTitulo"] ?? '';
	$ImgPie = $row["ImgPie"];
}
mysqli_free_result($result);


$MetaTitulo = $Titulo;
$MetaDescripcion = $Entradilla;
$MetaKeywords =  GenKeyWords($Titulo . " " . $Entradilla, 3);





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
					<h1>Noticias</h1>
					<div class="MigasdePan">
						<a href="noticias.php" title="Noticias">Noticias</a>

					</div>

				</div>
				<div class="content">


					<div class="museo">
						<span class="noticiafecha"><?php echo $FechaNoticia; ?></span><br />
						<span class="noticiatitulo"><?php echo $Titulo; ?></span><br />
						<span class="noticiaentradilla"><?php echo $Entradilla; ?></span><br />
						<?php if ($Fuente != "") {
							echo "<span class='noticiafuente' >Fuente: $Fuente</span><br/>";
						} ?>
						<p class="noticiacuerpo">
							<?php
							if ($ImgNoticia > 0) {
								echo "<a href='$ImgPath/$ImgArchivo' class='lightbox' title='$ImgTitulo'><img alt='$ImgTitulo' src='$ImgPath/$ImgArchivo' width ='$AnchoThumb' height='$AltoThumb' style=\"float:right;padding-left:20px;padding-bottom:20px;\"/></a>";
							}

							echo $Cuerpo;
							?>

						</p>
						<p><a href="noticias.php?Pagina=<?php echo $Pagina; ?>&Mostrar=<?php echo $Mostrar; ?>&Buscar=<?php echo $Buscar; ?>" class="linksencillo">volver</a></p>
					</div>

					<?php
					if ($DocNoticia > 0) {
						echo "<div class='texto'>";
						echo "Documento adjunto: <a href='$DocPath/$DocArchivo' target='_Blank' class='VerDoc' >$DocArchivo</a>";
						echo "</div>";
						echo "<br clear='all' />";
					}

					// listado de documentos asociados
					$sql = "select * from Documentos where Ambito = 'Noticias' and idAmbito = $idNoticia and Publicar = 1 order by Orden";
					$link = ConnBDCervera();
					$result = mysqli_query($link, $sql);
					if (!$result) {
						$message = "Invalid query" . mysqli_error($link) . "\n";
						$message .= "whole query: " . $sql;
						die($message);
						exit;
					}

					$max = mysqli_num_rows($result);

					if ($max > 0) {
						echo "<div class=\"etiqueta\"> ";
						echo "<img src=\"images/documentos.png\" width=\"280\" height=\"50\" name=\"etiqueta\"/>";
						echo "</div>";
						echo "<div class='texto'><ul>";
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




					$sql = "select * from Imagenes where Ambito = 'Noticias' and idAmbito = $idNoticia and Publicar = 1 ";
					$link = ConnBDCervera();
					$result = mysqli_query($link, $sql);
					if (!$result) {
						$message = "Invalid query" . mysqli_error($link) . "\n";
						$message .= "whole query: " . $sql;
						die($message);
						exit;
					}

					$max = mysqli_num_rows($result);

					if ($max > 0) {
						echo "<div class='texto'>";
						echo "<a href='galeriafotografica.php?Ambito=Noticias&idAmbito=$idNoticia&Origen=noticias-detalle.php&Campo=idNoticia'>";
						echo "<img src='images/galeriafotografica.png' name='etiqueta' alt='Galería fotográfica' title='Galería fotográfica, tecla K' width='280' height='50'  />";
						echo "</a></div>";
					}
					mysqli_free_result($result);
					mysqli_close($link);
					?>


				</div>

				<div class="museo">

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