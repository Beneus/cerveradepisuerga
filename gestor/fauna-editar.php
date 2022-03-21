<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'fauna-editar.php';
$listPage = 'fauna.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Fauna';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();

$ErrorMsg = "";

$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $entity->_POST();
  if ($entity->NombreComun == "") {
    $ErrorMsg = "<li class=\"errortexto\">Nombre común</li>";
  }
  if ($entity->NombreCientifico == "") {
    $ErrorMsg .= "<li class=\"errortexto\">Nombre científico</li>";
  }
  if ($ErrorMsg == "") {
    $entity->Fecha = date("Y-m-d H:m:s");
    $entityManager->Save($entity);
    $lastInsertedId = $entityManager->GetLastInsertedId();
    if ($lastInsertedId) {
      $entity->$entityId = $lastInsertedId;
      $dc->Set($entityManager->Get($lastInsertedId), $entityTable);
    }
  } else {
    $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:"
      . "<ul>"
      . $ErrorMsg
      . "</ul>";
  }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET[$entityId])) {
    $entityManager->Get($_GET[$entityId]);
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
  <title>Gestor de contenidos: <?= $entityTable; ?> Editar</title>
  <link rel="stylesheet" href="css/beneus.css" />
  <link rel="stylesheet" href="css/menu.css" />
  <link href="css/form.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/funciones.js" language="javascript"></script>
  <script src="https://kit.fontawesome.com/baa3bdeae8.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/83pnziyrx0kiq1bgkbpgrc19n68sqvirdkp71te4e9vmqb5e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#DESCRIPCION,#HABITAT,#USOS'
    });
  </script>
</head>

<body>
  <?php
  include('includes/error.php');
  ?>
  <div class="wrapper">
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

        <div id="opciones">
          <ul>
            <li>
              <h2><?= explode('.', curPageName())[0] ?></h2>
            </li>
            <li class="liselect"><a href="<?= $currentPage; ?>">A&ntilde;adir entrada</a></li>
            <li><a href="<?= $listPage ?>">Listado</a></li>
          </ul>
        </div>

        <div class="content">
          <div class="form_wrapper">
            <div class="form_container">
              <div class="title_container">
                <h2><?= $entityTable ?></h2>
              </div>
              <form id="formEntrada" method="post" name="formEntrada" action="<?= $currentPage; ?>">
                <input type="hidden" name="<?= strtoupper($entityId) ?>" value="<?= $entity->$entityId; ?>" />
                <input type="hidden" name="IMGDESCRIPCION" value="<?= $entity->ImgDescripcion; ?>" />
                <input type="hidden" name="IMGHABITAT" value="<?= $entity->ImgHabitat; ?>" />
                <input type="hidden" name="IMGUSOS" value="<?= $entity->ImgUsos; ?>" />
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Nombre común</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-otter"></i></span>
                      <input name="NOMBRECOMUN" type="text" id="NOMBRECOMUN" value="<?= $entity->NombreComun; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Nombre cientítico</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-paw"></i></span>
                      <input name="NOMBRECIENTIFICO" type="text" id="NOMBRECIENTIFICO" value="<?= $entity->NombreCientifico; ?>" size="35" />
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Familia</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-folder-tree"></i></span>
                      <input name="FAMILIA" type="text" id="FAMILIA" value="<?= $entity->Familia; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label></label>
                    <div class="input_field">
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col">
                    <label>Descripción</label>
                    <div class="textarea_field">
                      <span><i class="fa-solid fa-message"></i></span>
                      <textarea name="DESCRIPCION" cols="80" rows="10" id="DESCRIPCION"><?= $entity->Descripcion; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col">
                    <label>Habitat</label>
                    <div class="textarea_field">
                      <span><i class="fa-solid fa-earth-europe"></i></span>
                      <textarea name="HABITAT" cols="80" rows="10" id="HABITAT"><?= $entity->Habitat; ?></textarea>
                    </div>
                  </div>
                </div>
                <?php if ($entity->$entityId) {
                  $imagenUrl = 'location.href="galeria-fotografica.php?Ambito=' . $entityTable . '&idAmbito=' . $entity->$entityId . '&Campo=' . $entityId . '&NCampo=' . $entityTable . '&Referer=' . $currentPage . '"';
                  $documentUrl = 'location.href="galeria-documentos.php?Ambito=' . $entityTable . '&idAmbito=' . $entity->$entityId . '&Campo=' . $entityId . '&NCampo=' . $entityTable . '&Referer=' . $currentPage . '"';
                ?>
                  <div class="row clearfix">
                    <div class="col_half">
                      <div class="input_field"> <span><i aria-hidden="true" class="fa fa-picture-o"></i></span>
                        <input type="button" name="IMAGEN" id="IMAGEN" class="button" value="Adjuntar Imagen" onclick='<?= $imagenUrl ?>' />
                      </div>
                    </div>
                    <div class="col_half">
                      <div class="input_field"> <span><i aria-hidden="true" class="fa fa-file"></i></span>
                        <input type="button" name="DOCUMENTO" id="DOCUMENTO" class="button" value="Adjuntar Documeto" onclick='<?= $documentUrl ?>' />
                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>
                <div class="row clearfix">
                  <div class="col_half">
                    <label></label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-floppy-disk"></i></span>
                      <button type="submit" class="button" name="ENVIAR" id="ENVIAR">Salvar</button>
                    </div>
                  </div>
                  <div class="col_half">
                    <label></label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-list"></i></span>
                      <?php
                      $volver = 'location.href="' . $listPage . '?mostrar=' . $mostrar . '&pagina=' . $pagina . '"';
                      ?>
                      <input type="button" name="VOLVER2" id="VOLVER2" class="button" value="Volver al listado" onclick='<?= $volver ?>' />
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</body>

</html>