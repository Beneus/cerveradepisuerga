<?php
namespace citcervera;

include("includes/funciones.php");
include("includes/Conn.php");

use citcervera\Model\Entities\Inicio;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Imagenes;

$dc = new DataCarrier();
$Manager = new Manager();

$sql = " select * from Inicio Limit 0,1 ";
$inicio = $Manager->Query($sql, 'fetch_object', new Inicio());

$dc->Set($inicio, 'Inicio');

$sql = "select * from Imagenes where Ambito = 'Inicio' and Publicar = 1 order by Orden";
$image = $Manager->Query($sql, 'fetch_object', new Imagenes());

$dc->Set($image, 'Imagenes');

function GetDescription($dc)
{
     echo html_entity_decode($dc->GetEntities('Inicio')[0]->Descripcion);
}

function GetImageDescription($dc)
{
     foreach ($dc->GetEntities('Imagenes') as $imagen) {
          if ($imagen->idImagen == $dc->GetEntities('Inicio')[0]->ImgDescripcion) {
               PrintImage($imagen);
               break;
          }
     }
}

function RenderGaleria($dc)
{

     if ($dc->GetEntities('Imagenes')) {
          echo "<a href='galeriafotografica.php?Ambito=Inicio&amp;idAmbito=1&amp;Origen=index.php&amp;Campo=' hreflang='es'>";
          echo "<h3>Galería fotográfica</h3>";
          echo "</a>";
     }
}

function PrintImage($imagen)
{

     if ($imagen) {
          $Path = $imagen->Path;
          $Archivo = $imagen->Archivo;
          $Titulo = $imagen->Titulo;
          $Pie = $imagen->Pie;
          $Ancho = $imagen->Ancho;
          $Alto = $imagen->Alto;
          $AnchoThumb = $imagen->AnchoThumb;
          $AltoThumb = $imagen->AltoThumb;
          echo "<a href='../files/$Path/$Archivo'  class='lightbox' title='$Titulo' hreflang='es' ><img src=\"../files/$Path/$Archivo\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
     }
}

$MetaTitulo = "Cervera de Pisuerga, Palencia: El corazón de la Montaña Palentina";

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
                         <h1>Inicio</h1>
                         <div class="MigasdePan"><a href="index.php" title="inicio">inicio</a></div>
                    </div>
                    <div class="content">
                         <?php
                         GetImageDescription($dc);
                         GetDescription($dc);
                         ?>
                    </div>
                    <div class="content">
                         <?php
                         RenderGaleria($dc);
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
</body>
</html>