<?php

namespace citcervera;

include("includes/funciones.php");
include("includes/Conn.php");

$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';

use citcervera\Model\Entities\Museos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Entities\NucleosUrbanos;

$dc = new DataCarrier();
$Manager = new Manager();

$sql = "SELECT * FROM Museos ";
if ($idNucleoUrbano != '') {
     $sql .= " where idNucleoUrbano= $idNucleoUrbano ";
}
$sql = $sql . " order by FechaClausura desc, Museo ";
$inicio = $Manager->Query($sql, 'fetch_object', new Museos());
$dc->Set($inicio, 'Museos');


$MetaTitulo = "Cervera de Pisuerga: Museos de la Montaña Palentina";
$MetaDescripcion = "Guia de museos de la Montaña Palentina: Casa Cantarranas, Casa del Parque Natural, Fundación Piedad Isla, La Casa del Oso Cantábrico, Museo Etnográfico de Perazancas";
$MetaKeywords =  "Cervera de Pisuerga, Guia de museos, Montaña Palentina, Casa Cantarranas, Casa del Parque Natural, Fundación Piedad Isla, La Casa del Oso Cantábrico, Museo Etnográfico de Perazancas, turísmo, naturaleza virgen, arte, historia";
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
                         <h1><img src="iconos/museos.png" alt="Museos de la Montaña Palentina" width="32" height="32" class="iconosimagen" title="Museos de la Montaña Palentina" />Museos y exposiciones</h1>
                         <div class="MigasdePan">
                              <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt;
                              <a href="museos.php" title="Museos y exposiciones">Museos y exposiciones</a>
                         </div>
                    </div>
                    <div class="content">

                         <?php

                         $link = ConnBDCervera();
                         mysqli_query($link, 'SET NAMES utf8');
                         //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                         // NucleosUrbanos +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                         //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                         $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Museos as M "
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
                         foreach ($dc->GetEntities('Museos') as $Museo) {
                         ?>
                              <div class="museo">
                                   <?php

                                   if ($Museo->ImgDescripcion != 0) {
                                        $sqlImg = "select * from Imagenes where idImagen = " . $Museo->ImgDescripcion . " and Publicar = 1 ";
                                        $imgDescription = $Manager->Query($sqlImg, 'fetch_object', new Imagenes());

                                        if ($imgDescription) {
                                             $image = $imgDescription[0];
                                             echo "<a href=\"museos-detalle.php?idMuseo=$Museo->idMuseo\" class=\"strDirectorio\" title=\"$image->Titulo\"><img src=\"../files/" . $image->Path . "/" . $image->Archivo . "\" title=\"$image->Titulo\" alt=\"$image->Titulo\" /></a>";
                                        }
                                   }

                                   $sqlImg = "select * from NucleosUrbanos where idNucleoUrbano = " . $Museo->idNucleoUrbano;
                                   $nucleoUrbano = $Manager->Query($sqlImg, 'fetch_object', new NucleosUrbanos());
                                   ?>

                                   <h2><a href="museos-detalle.php?idMuseo=<?= $Museo->idMuseo; ?>" class="strMuseos"><?= $Museo->Museo; ?></a></h2>
                                   <ul>
                                        <?php if ($Museo->Tipo == "TEMPORAL") { ?>
                                             <li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?= $Museo->Tema; ?></span></li>
                                        <?php } else { ?>
                                             <li><span class="DatosTitulo">Tema</span><span class="DatosValor"><?= $Museo->Tema; ?></span></li>
                                        <?php } ?>
                                        <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?= $Museo->Direccion; ?></span></li>
                                        <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?= $Museo->idNucleoUrbano; ?>" title="<?= $nucleoUrbano[0]->NombreNucleoUrbano; ?>"><?= $nucleoUrbano[0]->NombreNucleoUrbano; ?></a></span></li>
                                        <li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?= $Museo->Horario; ?></span></li>
                                        <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?= MostrarTelefono($Museo->Telefono); ?></span></li>
                                        <li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?= $Museo->Tipo; ?></span></li>
                                        <?php if (!is_null($Museo->FechaInauguracion)) { ?>
                                             <li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?= $Museo->FechaInauguracion; ?></span></li>
                                        <?php } ?>
                                        <?php if (!is_null($Museo->FechaClausura)) { ?>
                                             <li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?= $Museo->FechaClausura; ?></span></li>
                                        <?php } ?>


                                        <?php if ($Museo->Email != "") { ?>
                                             <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?= $Museo->Email; ?></span></li>
                                        <?php } else {
                                        ?>
                                             <li><span><a href="mail.php?Ambito=Museos&amp;idAmbito=<?= $Museo->idMuseo; ?>&amp;Campo=idMuseo&amp;Att=Museo" title="Contacta con el responsable de <?= $Museo->Museo; ?>">Contacta</a></span></li>


                                        <?php
                                        } ?>
                                        <?php if ($Museo->URL != "") { ?>
                                             <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?= $Museo->URL; ?>" title="<?= $Museo->Museo; ?>, Enlace a ventana nueva" target="_blank">Ir ala URL del sitio</a></span></li>
                                        <?php } ?>


                                        <li><a href="museos-detalle.php?idMuseo=<?= $Museo->idMuseo; ?>" title="<?= $Museo->Museo; ?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
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
               location.href = "museos.php?idNucleoUrbano=" + x.value;
          }
     </script>
</body>

</html>