<?php

namespace citcervera;

include("includes/funciones.php");
include("includes/Conn.php");

$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';

use citcervera\Model\Entities\Monumentos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Entities\NucleosUrbanos;


$dc = new DataCarrier();
$Manager = new Manager();

$sql = "SELECT * FROM Monumentos ";
if ($idNucleoUrbano != '') {
     $sql .= " where idNucleoUrbano= $idNucleoUrbano ";
}
$sql = $sql . " order by Monumento ";
$monumentos = $Manager->Query($sql, 'fetch_object', new Monumentos());
$dc->Set($monumentos, 'Monumentos');

$MetaTitulo = "Cervera de Pisuerga: Monumentos y románico de la Montaña Palentina";
$MetaDescripcion = "Guia de monumentos de la Montaña Palentina: iglesias, ermitas, pintutas, arte románico, románico, casas, blasones, escudos, palacios, humilladero, bosque fósil";
$MetaKeywords = "Cervera de Pisuerga, Guia de monumentos, Montaña Palentina, iglesias, ermitas, pintutas, arte románico, románico, casas, blasones, escudos, palacios, humilladero, bosque fósil";

?>
<!DOCTYPE html>
<html>

<head>
     <?php
     include('./head.php');
     ?>
</head>

<body>
     <div class="wrapper">
          <?php
          include('./header.php');
          include("./menu.php");
          ?>
          <div class="grid container">
               <?php
               include('./aside1.php');
               include('./aside2.php');
               ?>

               <div class="main">
                    <div class="content">
                         <h1><img src="iconos/monumentos.png" alt="Monumentos en la Montaña Palentina" title="Monumentos en la Montaña Palentina" width="32" height="32" class="iconosimagen" /> Monumentos</h1>
                         <div class="MigasdePan">
                              <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt;
                              <a href="monumentos.php" title="Monumentos">Monumentos</a>
                         </div>
                         <?php

                         $link = ConnBDCervera();

                         //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                         // NucleosUrbanos +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                         //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                         $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Monumentos as M "
                              . " inner join NucleosUrbanos as NU on M.idNucleoUrbano = NU.idNucleoUrbano "
                              . " group by idNucleoUrbano order by NU.NombreNucleoUrbano ";

                         $accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
                         echo "<label for=\"IDNUCLEOURBANO\">Localidad: ";
                         echo "</label>";
                         echo CrearSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $sql, $link, "", "", "", $accion, $idNucleoUrbano);

                         ?>
                    </div>
                    <div class="content">
                         <?php
                         foreach ($dc->GetEntities('Monumentos') as $item) {
                         ?>
                              <div class="museo">
                                   <?php

                                   if ($item->ImgDescripcion != 0) {
                                        $sqlImg = "select * from Imagenes where idImagen = " . $item->ImgDescripcion . " and Publicar = 1 ";
                                        $imgDescription = $Manager->Query($sqlImg, 'fetch_object', new Imagenes());

                                        if ($imgDescription) {
                                             $image = $imgDescription[0];
                                             echo "<a href=\"museos-detalle.php?idMuseo=$item->idMonumento\" class=\"strDirectorio\" title=\"$image->Titulo\"><img src=\"../" . $image->Path . "/" . $image->Archivo . "\" title=\"$image->Titulo\" alt=\"$image->Titulo\" /></a>";
                                        }
                                   }

                                   $sqlImg = "select * from NucleosUrbanos where idNucleoUrbano = " . $item->idNucleoUrbano;
                                   $nucleoUrbano = $Manager->Query($sqlImg, 'fetch_object', new NucleosUrbanos())[0];

                                   ?>

                                   <h2><a href="monumentos-detalle.php?idMonumento=<?= $item->idMonumento; ?>" class="strMonumentos" title="<?= $item->Monumento; ?>: más informaci&oacute;n"><?= $item->Monumento; ?></a></h2>
                                   <ul>
                                        <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?= $item->Direccion; ?></span></li>
                                        <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?= $nucleoUrbano->idNucleoUrbano; ?>" title="<?= $nucleoUrbano->NombreNucleoUrbano; ?>"><?= $nucleoUrbano->NombreNucleoUrbano; ?></a></span></li>
                                        <?php if ($item->Horario  != "") { ?>
                                             <li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?= $item->Horario; ?></span></li>
                                        <?php }
                                        if ($item->Telefono != "") { ?>
                                             <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($item->Telefono); ?></span></li>
                                        <?php } ?>
                                        <li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?= $item->Tipo; ?></span></li>
                                        <?php if ($item->Responsable != "") { ?>
                                             <li><span class="DatosTitulo">Responsable</span><span class="DatosValor"><?= $item->Responsable; ?></span></li>
                                        <?php }
                                        if (!is_null($item->FechaInauguracion)) { ?>
                                             <li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?= $item->FechaInauguracion; ?></span></li>
                                        <?php }
                                        if (!is_null($item->FechaClausura)) { ?>
                                             <li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?= $item->FechaClausura; ?></span></li>
                                        <?php }
                                        if ($item->Email != "") { ?>
                                             <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?= $item->Email; ?></span></li>
                                        <?php }
                                        if ($item->URL != "") { ?>
                                             <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?= $item->URL; ?>" title="<?= $item->item; ?>" target="_blank"><?= $item->URL; ?></a></span></li>
                                        <?php } ?>
                                        <li><a href="monumentos-detalle.php?idMonumento=<?= $item->idMonumento; ?>" title="<?= $item->Monumento; ?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
                                   </ul>
                              </div>
                         <?php

                         }
                         ?>
                    </div>
                    <?php
                    include("./sponsors.php");
                    ?>
               </div>
               <?php
               include("./footer.php");
               ?>
          </div>
     </div>
     <script type="text/javascript">
          function SeleccionNucleoUrbano(x) {
               location.href = "monumentos.php?idNucleoUrbano=" + x.value;
          }
     </script>
</body>

</html>