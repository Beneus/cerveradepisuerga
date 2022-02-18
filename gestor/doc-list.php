<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;

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

        $idDoc           = $doc->idDoc;
        $Ambito           = $doc->Ambito;
        $idAmbito           = $doc->idAmbito;
        $Archivo         = $doc->Archivo;
        $Path             = $doc->Path;
        $Tipo             = $doc->Tipo;
        $Tamano         = $doc->Tamano;
        $Titulo         = $doc->Titulo;
        $Pie             = $doc->Pie;
        $Orden             = $doc->Orden;
        $Fecha             = $doc->Fecha;
        $Publicar         = $doc->Publicar;
        $DocDescripcion = $doc->ImgDescripcion ?? '';
        $DocHistoria     = $doc->DocHistoria ?? '';
        $DocFlora         = $doc->DocFlora ?? '';
        $DocFauna         = $doc->DocFauna ?? '';
        $DocAgenda         = $doc->DocAgenda ?? '';


?>

        <div class="galeriaImagen" id="Doc<?= $idDoc ?>">

            <div class="DatosImagen">
                <ul>
                    <li>Fecha: <?= $Fecha ?></li>
                    <li>Archivo: <?= $Archivo ?></li>
                    <li>Tama&ntilde;o: <?= $Tamano ?></li>

                    <form name="formImagen<?= $idDoc ?>">
                        <li class="">
                            <span onclick="Editar('TITULO',<?= $idDoc ?>);" class="pointer">
                                <strong>T&iacute;tulo (m&aacute;x 100): </strong>
                            </span>
                            <span id="TITULO<?= $idDoc ?>" onclick="Editar('TITULO',<?= $idDoc ?>);" class="pointer">
                                <?= $Titulo ?>
                            </span>
                            <input type="text" name="TITULO" value="<?= $Titulo ?>" style="display:none" disabled="disabled" onblur="GuardarDatosDoc('TITULO',<?= $idDoc ?>);" onchange="TextoModificado=true;" width="100%" maxlength="100" class="textoimagen" />
                        </li>
                        <li class="">
                            <span onclick="Editar('PIE',<?= $idDoc ?>);" class="pointer">
                                <strong>Pie de foto (m&aacute;x 250): </strong>
                            </span>
                            <span id="PIE<?= $idDoc ?>" onclick="Editar('PIE',<?= $idDoc ?>);" class="pointer">
                                <?= $Pie ?>
                            </span>
                            <textarea name="PIE" cols="45" rows="2" disabled="disabled" style="display:none" onblur="GuardarDatosDoc('PIE',<?= $idDoc ?>);" onchange="TextoModificado=true;" class="textoimagen"></textarea>
                        </li>
                        <li class="input_field">
                            <strong>Publicar: </strong>
                            <input class="publicar-doc" type="checkbox" name="PUBLICAR" value="<?= $idDoc ?>" onclick="Publicar(<?= $idDoc ?>,this);" <?= ($Publicar) ? "checked" : ""; ?> />
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
                        }
                        ?>
                        <li>
                            <strong>Intercambiar posici&oacute;n: </strong><input type="checkbox" name="POSICION" value="<?= $idDoc ?>" onclick="IntercambiarDoc(this);" />
                        </li>
                        <li>
                            <button idDoc="<?= $idDoc ?>" class="delete">Eliminar</button>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
    <?php
    }
    ?>
<?php
}

?>