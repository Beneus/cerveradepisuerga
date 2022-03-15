<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$editPage = 'monumentos-editar.php';
$listPage = 'monumentos.php';
$currentPage = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Monumentos';

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
   if ($entity->Monumento == "") {
      $ErrorMsg = "<span class=\"errortexto\">Monumento</span><br/>";
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
                              <label>Monumento</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-archway"></i></span>
                                 <input name="MONUMENTO" type="text" id="MONUMENTO" value="<?= $entity->Monumento; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Email</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-at"></i></span>
                                 <input name="EMAIL" type="text" id="EMAIL" value="<?= $entity->Email; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Dirección</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-address-card"></i></span>
                                 <input name="TEMA" type="text" id="TEMA" value="<?= $entity->Direccion; ?>" size="35" />
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
                              <label>Responsable</label>
                              <div class="input_field">
                                 <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                 <input name="RESPONSABLE" type="text" id="RESPONSABLE" value="<?= $entity->Responsable; ?>" size="35" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Horario</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-clock"></i></span>
                                 <input name="HORARIO" type="text" id="HORARIO" value="<?= $entity->Horario; ?>" size="35" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Fecha de Inauguración</label>
                              <div class="select_field">
                                 <span><i class="fa-solid fa-calendar-days"></i></span>
                                 <input name="FECHAINAUGURACION" type="date" id="FECHAINAUGURACION" placeholder="dd/mm/aaaa" value="<?= $entity->FechaInauguracion; ?>" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">
                           <div class="col_half">
                              <label>Teléfono</label>
                              <div class="input_field">
                                 <span><i class="fa-solid fa-phone"></i></span>
                                 <input name="TELEFONO" type="text" id="TELEFONO" value="<?= $entity->Telefono; ?>" size="16" maxlength="16" />
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Fecha de Clausura</label>

                              <div class="select_field">
                                 <span><i class="fa-solid fa-calendar-days"></i></span>
                                 <input name="FECHACLAUSURA" type="date" id="FECHACLAUSURA" placeholder="dd/mm/aaaa" value="<?= $entity->FechaClausura; ?>" />
                              </div>
                           </div>
                        </div>
                        <div class="row clearfix">

                           <div class="col_half">
                              <label>Tipo</label>
                              <div class="select_field">
                                 <span><i class="fa-solid fa-business-time"></i></span>
                                 <select name="TIPO">
                                    <option value="PERMANENTE" <?php if ($entity->Tipo == "PERMANENTE") echo "selected"; ?>>PERMANENTE</option>
                                    <option value="TEMPORAL" <?php if ($entity->Tipo == "TEMPORAL") echo "selected"; ?>>TEMPORAL</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col_half">
                              <label>Teléfono</label>
                              <div class="input_field">

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