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
                                    <span idImagen="<?= $idImagen ?>" class="span-titulo-content pointer">
                                        <?= $Titulo ?>
                                    </span>
                                    <input type="text" name="TITULO" value="<?= $Titulo ?>" idImagen="<?= $idImagen ?>" style="display:none" disabled="disabled" width="100%" maxlength="100" class="textoimagen" />
                                </li>
                                <li class="">
                                    <span idImagen="<?= $idImagen ?>" class="span-pie pointer">
                                        <strong>Pie de foto (m&aacute;x 250): </strong>
                                    </span>
                                    <span idImagen="<?= $idImagen ?>" class="span-pie-content pointer">
                                        <?= $Pie ?>
                                    </span>
                                    <textarea name="PIE" cols="45" rows="2" disabled="disabled" style="display:none" class="textoimagen" idImagen="<?= $idImagen ?>"></textarea>
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

<script>
    (function($items) {
        var dragSrcEl = null;
        var lastId;

        function handleDragStart(e) {
            lastId = e.currentTarget.parentElement.lastElementChild;
            // Target (this) element is the source node.
            dragSrcEl = this;
            //e.currentTarget.style.backgroundColor = 'red';
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.outerHTML);

            this.classList.add('dragElem');
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault(); // Necessary. Allows us to drop.
            }
            this.classList.add('over');

            e.dataTransfer.dropEffect = 'move'; // See the section on the DataTransfer object.
            //e.currentTarget.style.backgroundColor = 'blueviolet';
            return false;
        }

        function handleDragEnter(e) {
            // this / e.target is the current hover target.
            //e.currentTarget.style.backgroundColor = 'blue';
        }

        function handleDragLeave(e) {
            this.classList.remove('over'); // this / e.target is previous target element.
            //e.currentTarget.style.backgroundColor = 'blueviolet';
        }

        function handleDrop(e) {
            // this/e.target is current target element.

            if (e.stopPropagation) {
                e.stopPropagation(); // Stops some browsers from redirecting.
            }

            // Don't do anything if dropping the same column we're dragging.
            if (dragSrcEl != this) {
                // Set the source column's HTML to the HTML of the column we dropped on.
                //alert(this.outerHTML);
                //dragSrcEl.innerHTML = this.innerHTML;
                //this.innerHTML = e.dataTransfer.getData('text/html');
                this.parentNode.removeChild(dragSrcEl);
                var dropHTML = e.dataTransfer.getData('text/html');
                var dropElem;
                this.insertAdjacentHTML('beforebegin', dropHTML);
                dropElem = this.previousSibling;
                // if (this == lastId) {
                //     this.insertAdjacentHTML('afterend', dropHTML);
                //     dropElem = this.nextSibling;
                // } else {
                //     this.insertAdjacentHTML('beforebegin', dropHTML);
                //     dropElem = this.previousSibling;
                // }
                addDnDHandlers(dropElem);
                //dropElem.style.backgroundColor = 'blueviolet';
            }
            this.classList.remove('over');
            //e.currentTarget.style.backgroundColor = 'blueviolet';
            var cols = e.currentTarget.parentElement.children;
            var ids = [];
            [].forEach.call(cols, function(elem) {
                ids.push(elem.id);
            });

            updateOrder(ids);
            return false;
        }

        const updateOrder = (ids) => {
            console.log(ids);
        }


        function handleDragEnd(e) {
            // this/e.target is the source node.
            this.classList.remove('over');
            // console.log(e.currentTarget)
            e.currentTarget.style.backgroundColor = '';
            /*[].forEach.call(cols, function (col) {
                col.classList.remove('over');
            });*/
            //e.currentTarget.style.backgroundColor = 'blueviolet';


        }

        function addDnDHandlers(elem) {
            elem.draggable = true;
            elem.addEventListener('dragstart', handleDragStart, false);
            elem.addEventListener('dragenter', handleDragEnter, false)
            elem.addEventListener('dragover', handleDragOver, false);
            elem.addEventListener('dragleave', handleDragLeave, false);
            elem.addEventListener('drop', handleDrop, false);
            elem.addEventListener('dragend', handleDragEnd, false);

        }

        var cols = document.querySelectorAll($items);
        [].forEach.call(cols, addDnDHandlers);

    })('#draggableArea .dragChild')
</script>