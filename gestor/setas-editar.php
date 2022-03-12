<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\SetasSubOrden;

$editPage = 'setas-editar.php';
$listPage = 'setas.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Setas';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();


$setasSubOrden = new SetasSubOrden();
$setasSubOrdenManager = new Manager($setasSubOrden);

$dc->Set($setasSubOrdenManager->GetAll(), 'SetasSubOrden');

$ErrorMsg = "";

$idMuseo = $_GET[$entityId] ?? '';
$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $entity->_POST();


   if ($entity->NombreComun == "") {
      $ErrorMsg = "<span class=\"errortexto\">Nombre común</span><br/>";
   }
   if ($entity->NombreCientifico == "") {
      $ErrorMsg = "<span class=\"errortexto\">Nombre científico Urbano</span><br/>";
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
   <script type="text/javascript" src="js/funciones.js"></script>
   <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
   <script type="text/javascript" src="js/textarea.js"></script>
   <script language="javascript" type="text/javascript">
      textarea('textarea#SOMBRERO,textarea#PIE,textarea#CUERPO,textarea#LAMINAS,textarea#HIMENIO,textarea#EXPORADA,textarea#CARNE,textarea#EPOCAHABITAT,textarea#COMESTIBILIDAD,textarea#COMENTARIOS');
   </script>
   <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAALjXpr6raYKwJ_pVadtUMehSnDxdfdmxtwDYhQFtyI9Wd5NFxURR-buW964RJIemSdlCcqLQinkmTNA" type="text/javascript"></script>
   <script type="text/javascript">
      var Latitud = "<?php echo $Latitud; ?>";
      var Longitud = "<?php echo $Longitud; ?>";
      var idTime;

      function redondea(sVal, nDec) {
         var n = parseFloat(sVal);
         var s = "0.00";
         if (!isNaN(n)) {
            n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec);
            s = String(n);
            s += (s.indexOf(".") == -1 ? "." : "") + String(Math.pow(10, nDec)).substr(1);
            s = s.substr(0, s.indexOf(".") + nDec + 1);
         }
         return s;
      }

      function ponDecimales(nDec) {
         document.frm.t1.value = redondea(document.frm.t1.value, nDec);
         document.frm.t2.value = redondea(document.frm.t2.value, nDec);
      }

      function PosicionarMapa(direccion) {
         idTime = setInterval("CambiarMapa('" + direccion + "')", 50);
      }

      function CambiarMapa(direccion) {
         var posLat = parseFloat(Latitud);
         var posLon = parseFloat(Longitud);
         switch (direccion) {
            case "N":
               Latitud = posLat + 0.0001;
               document.formEntrada.LATITUD.value = redondea(Latitud, 6);
               break;
            case "S":
               Latitud = posLat - 0.0001;
               document.formEntrada.LATITUD.value = redondea(Latitud, 6);
               break;
            case "E":
               Longitud = posLon + 0.0001;
               document.formEntrada.LONGITUD.value = redondea(Longitud, 6);
               break;
            case "O":
               Longitud = posLon - 0.0001;
               document.formEntrada.LONGITUD.value = redondea(Longitud, 6);
               break;
         }
         initialize();
      }
   </script>
   <script src="js/googlemapsmuseo.js" type="text/javascript"></script>
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
                     <form id="formEntrada" method="post" name="formEntrada" action="<?= $currentPage; ?>">
                        <input type="hidden" name="<?= strtoupper($entityId) ?>" value="<?= $entity->$entityId; ?>" />
                        <input type="hidden" name="IMGSETAS" value="<?= $entity->ImgSetas; ?>" />
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Nombre común</label>
                              <div class="input_field">
                                 <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                 <input name="NOMBRECOMUN" type="text" id="NOMBRECOMUN" value="<?= $entity->NombreComun; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Nombre cientítico</label>
                              <div class="input_field">
                                 <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                 <input name="NOMBRECIENTIFICO" type="text" id="NOMBRECIENTIFICO" value="<?= $entity->NombreCientifico; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Clase</label>
                              <div class="input_field">
                                 <select name="CLASE" type="text" id="CLASE">
                                    <option value="BASIDIOMICETOS" <?= $entity->Clase == 'BASIDIOMICETOS' ? 'selected' : '';   ?>>BASIDIOMICETOS</option>
                                    <option value="ASCOMICETOS" <?= $entity->Clase == 'ASCOMICETOS' ? 'selected' : '';   ?>>ASCOMICETOS</option>
                                    <option value="FRAGMOBASIDIOMICETOS" <?= $entity->Clase == 'FRAGMOBASIDIOMICETOS' ? 'selected' : '';   ?>>FRAGMOBASIDIOMICETOS</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Orden</label>
                              <div class="input_field">
                                 <?php
                                 $list = GetSmallArrayFromBiggerOne($dc, 'SetasSubOrden', array('idSetasSubOrden', 'SubOrden'));
                                 echo GetSelect("IDSETASSUBORDEN", "idSetasSubOrden", "SubOrden", $list, "", "", "", "", $entity->idSetasSubOrden);
                                 ?>
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Clasificación</label>
                              <div class="input_field">
                                 <select name="CLASIFICACION" type="text" id="CLASIFICACION">
                                    <option value="Mortal" <?= $entity->Clasificacion == 'Mortal' ? 'selected' : ''; ?>>Mortal</option>
                                    <option value="Venenosa" <?= $entity->Clasificacion == 'Venenosa' ? 'selected' : ''; ?>>Venenosa</option>
                                    <option value="Sin valor culinario" <?= $entity->Clasificacion == 'Sin valor culinario' ? 'selected' : ''; ?>>Sin valor culinario</option>
                                    <option value="Buena" <?= $entity->Clasificacion == 'Buena' ? 'selected' : ''; ?>>Buena</option>
                                    <option value="Excelente" <?= $entity->Clasificacion == 'Excelente' ? 'selected' : ''; ?>>Excelente</option>
                                    <option value="Sin clasificar" <?= $entity->Clasificacion == 'Sin clasificar' ? 'selected' : ''; ?>>Sin clasificar</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Autor</label>
                              <div class="input_field">
                                 <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                 <input name="AUTOR" type="text" id="AUTOR" value="<?= $entity->Autor; ?>" size="35" />
                              </div>
                           </div>
                        </div>


                        <div class="row clearfix">
                           <div class="col">
                              <label>Sombreo</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="SOMBRERO" cols="80" rows="10" id="SOMBRERO"><?= $entity->Sombrero; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Pie</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="PIE" cols="80" rows="10" id="PIE"><?= $entity->Pie; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Cuerpo</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="CUERPO" cols="80" rows="10" id="CUERPO"><?= $entity->Cuerpo; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Laminas</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="LAMINAS" cols="80" rows="10" id="LAMINAS"><?= $entity->Laminas; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Himenio</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="HIMENIO" cols="80" rows="10" id="HIMENIO"><?= $entity->Himenio; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Exporada</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="EXPORADA" cols="80" rows="10" id="EXPORADA"><?= $entity->Exporada; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Carne</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="CARNE" cols="80" rows="10" id="CARNE"><?= $entity->Carne; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Epoca y habitat</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="EPOCAHABITAT" cols="80" rows="10" id="EPOCAHABITAT"><?= $entity->EpocaHabitat; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Comestibilidad</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>

                                 <textarea name="COMESTIBILIDAD" cols="80" rows="10" id="COMESTIBILIDAD"><?= $entity->Comestibilidad; ?></textarea>

                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col">
                              <label>Comentarios</label>
                              <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>
                                 <textarea name="COMENTARIOS" cols="80" rows="10" id="COMENTARIOS"><?= $entity->Comentarios; ?></textarea>
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
                              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                 <input type="hidden" name="IDNOTICIA" value="<?php echo $idNoticia; ?>" />
                                 <button type="submit" class="button" name="ENVIAR" id="ENVIAR">Salvar</button>
                              </div>
                           </div>
                           <div class="col_half">
                              <label></label>
                              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
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