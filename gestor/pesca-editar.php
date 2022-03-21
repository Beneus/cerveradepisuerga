<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'pesca-editar.php';
$listPage = 'pesca-listado.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Pesca';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();

$currentPage = curPageName();
$ErrorMsg = "";

$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $entity->_POST();
  if ($entity->Nombre == "") {
    $ErrorMsg = "<li class=\"errortexto\">Nombre</li>";
  }
  if ($entity->Rio == "") {
    $ErrorMsg .= "<li class=\"errortexto\">Rio</li>";
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
  <script type="text/javascript" src="scripts/tiny_mce.js" language="javascript"></script>
  <script type="text/javascript" src="js/funciones.js" language="javascript"></script>
  <script src="https://kit.fontawesome.com/baa3bdeae8.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/83pnziyrx0kiq1bgkbpgrc19n68sqvirdkp71te4e9vmqb5e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#DESCRIPCION'
    });
  </script>

  <script>
    function ModifyDiasHabiles(x) {
      var diashabiles = '';
      for (i = 0; i < x.options.length; i++) {
        if (x.options[i].selected) {
          if (diashabiles == "") {
            diashabiles = x.options[i].value;
          } else {
            diashabiles = diashabiles + "-" + x.options[i].value;
          }
        }
      }
      document.getElementById('DIASHABILES').value = diashabiles;
    }
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
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Tipo tramo</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-building-columns"></i></span>
                      <input name="TIPOTRAMO" type="text" id="TIPOTRAMO" value="<?= $entity->TipoTramo; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Cupo de capturas</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-at"></i></span>
                      <input name="CUPOCAPTURAS" type="text" id="CUPOCAPTURAS" value="<?= $entity->CupoCapturas; ?>" size="35" />
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Rio</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-location-pin"></i></span>
                      <input name="RIO" type="text" id="RIO" value="<?= $entity->Rio; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Tamaño mínimo de capturas</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-link"></i></span>
                      <input name="TAMANOCAPTURAS" type="text" id="TAMANOCAPTURAS" value="<?= $entity->TamanoCapturas; ?>" size="35" />
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Nombre</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-address-card"></i></span>
                      <input name="NOMBRE" type="text" id="NOMBRE" value="<?= $entity->Nombre; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Cebos</label>
                    <div class="input_field">
                      <span><i aria-hidden="true" class="fa fa-user"></i></span>
                      <input name="CEBOS" type="text" id="CEBOS" value="<?= $entity->Cebos; ?>" size="35" />
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Tipo de pesca</label>
                    <div class="select_field">
                      <span><i aria-hidden="true" class="fa fa-user"></i></span>
                      <select name="TIPOPESCA" onchange="CambiarClase(this);" id="TIPOPESCA">
                        <option value="Sin muerte" <?php if ($entity->TipoPesca == "Sin muerte") echo "selected"; ?>>Sin muerte</option>
                        <option value="Regimen Tradicional" <?php if ($entity->TipoPesca == "Regimen Tradicional") echo "selected"; ?>>Regimen Tradicional</option>
                        <option value="Intensivo" <?php if ($entity->TipoPesca == "Intensivo") echo "selected"; ?>>Intensivo</option>
                      </select>
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Permisos por día</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-calendar-days"></i></span>
                      <input name="PERMISOSDIA" type="text" id="PERMISOSDIA" value="<?= $entity->PermisosDia; ?>" />
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Espacio</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-clock"></i></span>
                      <input name="ESPACIO" type="text" id="ESPACIO" value="<?= $entity->Espacio; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Especies</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-calendar-days"></i></span>
                      <input name="ESPECIES" type="text" id="ESPECIES" value="<?= $entity->Especies; ?>" />
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col_half">
                    <label>Periodo habil</label>
                    <div class="input_field">
                      <span><i class="fa-solid fa-clock"></i></span>
                      <input name="PERIODOHABIL" type="text" id=" PERIODOHABIL" value="<?= $entity->PeriodoHabil; ?>" size="35" />
                    </div>
                  </div>
                  <div class="col_half">
                    <label>Días habiles</label>
                    <div class="select_field">
                      <span><i class="fa-solid fa-calendar-days"></i></span>

                      <input type="hidden" name="DIASHABILES" id="DIASHABILES" value="<?= $entity->DiasHabiles ?>" />
                      <select name="DIAHABILES" size="8" multiple="multiple" id="DIAHABILES" style="overflow:hidden" onclick="ModifyDiasHabiles(this)">
                        <option value="L" <?php if (!(strrpos($entity->DiasHabiles, "L") === false)) echo "selected"; ?>>lunes</option>
                        <option value="M" <?php if (!(strrpos($entity->DiasHabiles, "M") === false)) echo "selected"; ?>>martes</option>
                        <option value="X" <?php if (!(strrpos($entity->DiasHabiles, "X") === false)) echo "selected"; ?>>miercoles</option>
                        <option value="J" <?php if (!(strrpos($entity->DiasHabiles, "J") === false)) echo "selected"; ?>>jueves</option>
                        <option value="V" <?php if (!(strrpos($entity->DiasHabiles, "V") === false)) echo "selected"; ?>>viernes</option>
                        <option value="S" <?php if (!(strrpos($entity->DiasHabiles, "S") === false)) echo "selected"; ?>>sabado</option>
                        <option value="D" <?php if (!(strrpos($entity->DiasHabiles, "D") === false)) echo "selected"; ?>>domingo</option>
                        <option value="F" <?php if ((!strrpos($entity->DiasHabiles, "F") === false)) echo "selected"; ?>>fiestas</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!--
                                <div class="row clearfix">
                                    <div class="col_half">
                                        <label>Longitud</label>
                                        <div class="input_field">

                                            <img src="images/izq.gif" alt="Más al Oeste" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('O');" onmouseup="clearInterval(idTime);;" onmouseout="clearInterval(idTime);" /> <input name="LONGITUD" type="text" id="LONGITUD" value="<?php echo $Longitud; ?>" size="16" align="right" onchange="Longitud = this.value;initialize();" />
                                            <img src="images/der.gif" alt="Más al Este" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('E');" onmouseup="clearInterval(idTime);" onmouseout="clearInterval(idTime);" />
                                        </div>
                                    </div>
                                    <div class="col_half">
                                        <label>Latitud</label>
                                        <div class="input_field">

                                            <img src="images/arriba.gif" alt="Más al Norte" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('N');" onmouseup="clearInterval(idTime);;" onmouseout="clearInterval(idTime);" />
                                            <input name="LATITUD" type="text" id="LATITUD" value="<?php echo $Latitud; ?>" size="16" align="right" onchange="Latitud = this.value;initialize();" />
                                            <img src="images/abajo.gif" alt="Más al Sur" width="14" height="14" border="0" onmouseover="this.style.cursor='pointer';" onmousedown="PosicionarMapa('S');" onmouseup="clearInterval(idTime);" onmouseout="clearInterval(idTime);" />
                                        </div>
                                    </div>
                                </div>

                                -->
                <div class="row clearfix">
                  <div class="col">
                    <label>Descripción</label>
                    <div class="textarea_field">
                      <span><i class="fa-solid fa-message"></i></span>
                      <textarea name="DESCRIPCION" cols="80" rows="10" id="DESCRIPCION"><?= $entity->Descripcion; ?></textarea>

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