<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'escudos-editar.php';
$listPage = 'escudos.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Escudos';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();

$NucleosUrbanos = new NucleosUrbanos();
$nucleosUrbanosManager = new Manager($NucleosUrbanos);

$dc->Set($nucleosUrbanosManager->GetAll(), 'NucleosUrbanos');


$ErrorMsg = "";

$idMuseo = $_GET[$entityId] ?? '';
$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $entity->_POST();
   if ($entity->Nombre == "") {
      $ErrorMsg = "<span class=\"errortexto\">Nombre</span><br/>";
   }
   if ($entity->idNucleoUrbano == "") {
      $ErrorMsg = "<span class=\"errortexto\">Nucleo Urbano</span><br/>";
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
      $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
      $ErrorMsn .= "<blockquote>";
      $ErrorMsn .= $ErrorMsg;
      $ErrorMsn .= "</blockquote>";
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
         selector: '#DESCRIPCION'
      });
   </script>
</head>

<body>
   <?php
   if ($ErrorMsn != "") {
   ?>
      <div id="error">
         <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
         <div id="errormsn"><?php echo $ErrorMsn; ?>
         </div>
      </div>
   <?php
   }
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
                     <form id="formEntrada" method="post" name="formEntrada" action="<?= $currentPage; ?>" onsubmit="EnviarEntradaMuseo(this,'editar');return false;">
                        <input type="hidden" name="<?= strtoupper($entityId) ?>" value="<?= $entity->$entityId; ?>" />
                        <input type="hidden" name="IMGDESCRIPCION" value="<?= $entity->ImgDescripcion; ?>" />
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Nombre de escudo</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-ribbon"></i></span>
                                 <input name="NOMBRE" type="text" id="NOMBRE" value="<?= $entity->Nombre; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>DirecciÓn</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-address-card"></i></span>
                                 <input name="DIRECCION" type="text" id="DIRECCION" value="<?= $entity->Direccion; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Poblaci&oacute;n</label>
                              <div class="select_field">
                              <span><i class="fa-solid fa-city"></i></span>
                                 <?php

                                 $list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano', 'NombreNucleoUrbano'));
                                 echo GetSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $list, "", "", "", "", $entity->idNucleoUrbano);
                                 ?>
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