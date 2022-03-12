<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'setas-editar.php';
$listPage = 'setas.php';
$introPage = 'setas-introduccion.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Setas';

$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$entityManager = new Manager($entity);
$dc = new DataCarrier();
$db = new DB();

$ErrorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $entity->_POST();
   if ($entity->Comentarios == "") {
      $ErrorMsg = "<span class=\"errortexto\">Comentario</span><br/>";
   }
   if ($ErrorMsg == "") {
      $entity->Fecha = date("Y-m-d H:m:s");
      $entityManager->Save($entity);
      $lastInsertedId = $entityManager->GetLastInsertedId();
      if ($lastInsertedId) {
         $entity->$entityId = $lastInsertedId;
         $dc->Set($entityManager->Get($lastInsertedId), $entityTable);
      }
      echo $lastInsertedId;
   } else {
      $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
      $ErrorMsn .= "<blockquote>";
      $ErrorMsn .= $ErrorMsg;
      $ErrorMsn .= "</blockquote>";
   }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
   $entityManager->Get(0);
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

   <script language="javascript" type="text/javascript">
      tinyMCE.init({
         height: "250",
         mode: "textareas",
         theme: "advanced",
         theme_advanced_buttons1: "newdocument,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
         theme_advanced_buttons1_add: "outdent,indent",
         theme_advanced_buttons2: "",
         theme_advanced_buttons3: "",
         theme_advanced_toolbar_location: "top",
         theme_advanced_toolbar_align: "left",
         theme_advanced_path_location: "bottom",
         extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
      });
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
                  <li><a href="<?= $introPage ?>">Introducción</a></li>
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
                     <?= $entityId; ?>
                     
                     <form id="formEntrada" method="post" name="formEntrada" action="<?= $currentPage; ?>">
                        <input type="hidden" name="<?= strtoupper($entityId) ?>" value="0" />
                        <input type="hidden" name="IMGSETAS" value="<?= $entity->ImgSetas; ?>" />
                        <div class="row clearfix">
                           <div class="col">
                              <label>Comentario</label>
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