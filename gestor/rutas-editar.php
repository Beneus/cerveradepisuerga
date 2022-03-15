<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'rutas-editar.php';
$listPage = 'rutas.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Rutas';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();

$NucleosUrbanos = new NucleosUrbanos();
$nucleosUrbanosManager = new Manager($NucleosUrbanos);

$dc->Set($nucleosUrbanosManager->GetAll(), 'NucleosUrbanos');

$currentPage = curPageName();
$ErrorMsg = "";

$idMuseo = $_GET[$entityId] ?? '';
$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $entity->_POST();
   if ($entity->Ruta == "") {
      $ErrorMsg = "<li class=\"errortexto\">Museo</li>";
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

echo $entity->fauna;
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
         selector: '#DESCRIPCION,#FAUNA,#FLORA'
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
                     <form id="formEntrada" method="post" name="formEntrada" action="<?= $currentPage; ?>" onsubmit="EnviarEntradaMuseo(this,'editar');return false;">
                        <input type="hidden" name="<?= strtoupper($entityId) ?>" value="<?= $entity->$entityId; ?>" />
                        <input type="hidden" name="IMGDESCRIPCION" value="<?= $entity->ImgDescripcion; ?>" />
                        <input type="hidden" name="IMGFLORA" value="<?= $entity->ImgFlora; ?>" />
                        <input type="hidden" name="IMGFAUNA" value="<?= $entity->ImgFauna; ?>" />
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Ruta</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-route"></i></span>
                                 <input name="RUTA" type="text" id="RUTA" value="<?= $entity->Ruta; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Desnivel</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                                 <input name="DESNIVEL" type="text" id="DESNIVEL" value="<?= $entity->Desnivel; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Inicio</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                                 <input name="INICIO" type="text" id="INICIO" value="<?= $entity->Inicio; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Piso</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-person-hiking"></i></span>
                                 <input name="PISO" type="text" id="PISO" value="<?= $entity->Piso; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Llegada</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-arrow-right-to-bracket"></i></span>
                                 <input name="LLEGADA" type="text" id="LLEGADA" value="<?= $entity->Llegada; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Dificultad</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-stairs"></i></span>
                                 <input name="DIFICULTAD" type="text" id="DIFICULTAD" value="<?= $entity->Dificultad; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Distancia</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-infinity"></i></span>
                                 <input name="DISTANCIA" type="text" id="DISTANCIA" value="<?= $entity->Distancia; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Epoca</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-mitten"></i></span>
                                 <input name="EPOCA" type="text" id="EPOCA" value="<?= $entity->Epoca; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Tiempo</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-clock"></i></span>
                                 <input name="TIEMPO" type="text" id="TIEMPO" value="<?= $entity->Tiempo; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Link</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-link"></i></span>
                                 <input name="URL" type="text" id="URL" value="<?= $entity->URL; ?>" size="35" />
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
                        <div class="row clearfix">
                           <div class="col">
                              <label>Flora</label>
                              <div class="textarea_field">
                                 <span><i class="fa-solid fa-holly-berry"></i></span>
                                 <textarea name="FLORA" cols="80" rows="10" id="FLORA"><?= $entity->Flora; ?></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Fauna</label>
                              <div class="textarea_field">
                                 <span><i class="fa-solid fa-crow"></i></span>
                                 <textarea name="FAUNA" cols="80" rows="10" id="FAUNA"><?= $entity->Fauna; ?></textarea>
                              </div>
                           </div>
                        </div>

                        <?php if ($entity->$entityId) {
                           $imagenUrl = 'location.href="galeria-fotografica.php?Ambito=' . $entityTable . '&idAmbito=' . $entity->$entityId . '&Campo=' . $entityId . '&NCampo=' . $entityTable . '&Referer=' . $currentPage . '"';
                           $documentUrl = 'location.href="galeria-documentos.php?Ambito=' . $entityTable . '&idAmbito=' . $entity->$entityId . '&Campo=' . $entityId . '&NCampo=' . $entityTable . '&Referer=' . $currentPage . '"';
                        ?>
                           <div class="row clearfix">
                              <div class="col_half">
                                 <div class="input_field">
                                    <span><i aria-hidden="true" class="fa fa-picture-o"></i></span>
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
                                 $volver = 'location.href="museos.php?mostrar=' . $mostrar . '&pagina=' . $pagina . '"';
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