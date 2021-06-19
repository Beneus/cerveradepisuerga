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

        $idImagen           = $imagen->idImagen ?? '';
        $Ambito           = $imagen->Ambito ?? '';
        $idAmbito           = $imagen->idAmbito ?? '';
        $Archivo         = $imagen->Archivo ?? '';
        $Path             = $imagen->Path ?? '';
        $Tipo             = $imagen->Tipo ?? '';
        $Tamano         = $imagen->Tamano ?? '';
        $Ancho             = $imagen->Ancho ?? '';
        $Alto             = $imagen->Alto ?? '';
        $Titulo         = $imagen->Titulo ?? '';
        $Pie             = $imagen->Pie ?? '';
        $AltoThumb         = $imagen->AltoThumb ?? '';
        $AnchoThumb     = $imagen->AnchoThumb ?? '';
        $Fecha             = $imagen->Fecha ?? '';
        $Publicar         = $imagen->Publicar ?? '';
        $ImgDescripcion = $imagen->ImgDescripcion ?? '';
        $ImgHistoria     = $imagen->ImgHistoria ?? '';
        $ImgFlora         = $imagen->ImgFlora ?? '';
        $ImgFauna         = $imagen->ImgFauna ?? '';
        $ImgAgenda         = $imagen->ImgAgenda ?? '';

?>
        <div class="dragChild form_container" id="FormImage<?= $idImagen ?>">
            <div class="row clearfix">
                <div class="">
                    <label></label>
                    <div class="input_field">
                        <span><i aria-hidden="true" class="fa fa-file-o"></i></span>

                        <img class="galeria-fotografica-thumb" src="<?php echo "../" . $Path . "/" . $Archivo ?>" width="<?= $AnchoThumb ?>" height="<?= $AltoThumb ?>" title="<?= $Titulo ?>" />
                    </div>
                </div>
                <div class="">
                    <label></label>
                    <div class="input_field">
                        <span>
                            <i aria-hidden="true" class="fa fa-file-text"></i>
                        </span>
                        <ul>
                            <li>Fecha: <?= $Fecha ?></li>
                            <li>Archivo: <?= $Archivo ?></li>
                            <li>Anchura: <?= $Ancho ?> px.</li>
                            <li>Tama&ntilde;o: <?= $Tamano ?></li>
                            <li>Altura: <?= $Alto ?> px.</li>
                            <form id="formImagen<?= $idImagen ?>" name="formImagen<?= $idImagen ?>">
                                <li class="">
                                    <span idImagen="<?= $idImagen ?>" class="span-titulo pointer">
                                        <strong>T&iacute;tulo (m&aacute;x 100): </strong>
                                    </span>
                                    <span idImagen="<?= $idImagen ?>"  class="span-titulo-content pointer">
                                        <?= $Titulo ?>
                                    </span>
                                    <input type="text" name="TITULO" value="<?= $Titulo ?>" idImagen="<?= $idImagen ?>" 
                                    style="display:none" disabled="disabled" width="100%" maxlength="100" class="textoimagen" />
                                </li>
                                <li class="">
                                    <span idImagen="<?= $idImagen ?>" class="span-pie pointer">
                                        <strong>Pie de foto (m&aacute;x 250): </strong>
                                    </span>
                                    <span idImagen="<?= $idImagen ?>" class="span-pie-content pointer">
                                        <?= $Pie ?>
                                    </span>
                                    <textarea name="PIE" cols="45" rows="2" disabled="disabled" style="display:none" 
                                    class="textoimagen" idImagen="<?= $idImagen ?>"></textarea>
                                </li>
                                <li class="input_field">
                                    <strong>Publicar: </strong>
                                    <input type="checkbox" name="PUBLICAR" value="<?= $idImagen ?>" onclick="Publicar(<?= $idImagen ?>,this);" <?= ($Publicar) ? "checked" : ""; ?> />
                                </li>
                                <li>
                                    <button idImagen="<?= $idImagen ?>" class="delete">Eliminar</button>
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