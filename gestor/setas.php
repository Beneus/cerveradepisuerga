<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\NucleosUrbanos;

$editPage = 'setas-editar.php';
$listPage = 'setas.php';
$pageName = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Setas';
$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$dc = new DataCarrier();
$entityManager = new Manager($entity);
$db = new DB();
$nucleosUrbanosEntity = new NucleosUrbanos();
$nucleosUrbanosManager = new Manager($nucleosUrbanosEntity);



$pagina_actual = '';
$titulo = '';
$idSubservicio = '';
$clasificacion = $_GET["clasificacion"] ?? '';
$buscar = $_GET["buscar"] ?? '';
$pagina = $_GET["pagina"] ?? '';
if (!is_numeric($pagina)) $pagina = 1;
$mostrar = $_GET["mostrar"] ?? '';
if (!is_numeric($mostrar)) $mostrar = 10;

$queryString = '&buscar=' . $buscar .'&clasificacion=' . $clasificacion ;


function GetQuery($buscar, $clasificacion)
{
   $sql = "SELECT SE.*, IMG.* , SetasSubOrden.SubOrden  FROM Setas AS SE "
      . " LEFT join Imagenes as IMG on SE.ImgSetas = IMG.idImagen "
      . " LEFT join SetasSubOrden on SE.idSetasSubOrden = SetasSubOrden.idSetasSubOrden ";

   if ($clasificacion != "") {
      $sql .= " where  SE.Clasificacion = '$clasificacion' ";
      if ($buscar != "") {
         $sql .= " and SE.NombreComun like '%$buscar%' "
            . " or SE.NombreCientifico like '%$buscar%' "
            . " or SE.Autor like '%$buscar%' "
            . " or SE.Clasificacion like '%$buscar%' "
            . " or SE.Sombrero like '%$buscar%' "
            . " or SE.Pie like '%$buscar%' "
            . " or SE.Laminas like '%$buscar%' "
            . " or SE.Himenio like '%$buscar%' "
            . " or SE.Exporada like '%$buscar%' "
            . " or SE.Carne like '%$buscar%' "
            . " or SE.EpocaHabitat like '%$buscar%' "
            . " or SE.Comestibilidad like '%$buscar%' ";
      }
   } else {
      if ($buscar != "") {
         $sql .= " where SE.NombreComun like '%$buscar%' "
            . " or SE.NombreCientifico like '%$buscar%' "
            . " or SE.Autor like '%$buscar%' "
            . " or SE.Clasificacion like '%$buscar%' "
            . " or SE.Sombrero like '%$buscar%' "
            . " or SE.Pie like '%$buscar%' "
            . " or SE.Laminas like '%$buscar%' "
            . " or SE.Himenio like '%$buscar%' "
            . " or SE.Exporada like '%$buscar%' "
            . " or SE.Carne like '%$buscar%' "
            . " or SE.EpocaHabitat like '%$buscar%' "
            . " or SE.Comestibilidad like '%$buscar%' ";
      }
   }

   $sql = $sql . " order by NombreComun ";
   return $sql;
}


function SearchResult($query, $mostrar, $pagina, $db)
{
   $list = $db->query($query);
   $numTotalRegistros = count($list);

   if ($mostrar > 0) {
      $query = $query . " LIMIT " . ((($pagina * $mostrar) - $mostrar)) . "," . $mostrar;
   } else {
      $query = $query . " LIMIT " . ((($pagina * $numTotalRegistros) - $numTotalRegistros)) . "," . ($numTotalRegistros);
   }

   //echo $query;
   return ['total' => $numTotalRegistros, 'result' => $db->query($query, 'fetch_object')];
}

?>
<!DOCTYPE html>
<html>

<head>
   <title>Gestor de contenidos: <?= $entityTable; ?> listado</title>
   <link rel="stylesheet" href="css/beneus.css" />
   <link rel="stylesheet" href="css/menu.css" />
   <link rel="stylesheet" href="css/table.css" />
   <link rel="stylesheet" href="css/form.css" type="text/css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
   <script type="text/javascript" src="js/funciones.js"></script>
   <script>
    
      function Buscar(x) {
         location.href = "<?= $pageName; ?>?buscar=" + x.value;
      }

      function Paginar(x) {
         location.href = "<?= $pageName; ?>?<?= $queryString?>&mostrar=" + x.value;
      }

      function CambiarClasificacion(x) {
         location.href = "<?= $pageName; ?>?mostrar=<?php echo $mostrar; ?>&clasificacion=" + x.value;

      }

      function CambiarPagina(x) {
         location.href = "<?= $pageName; ?>?<?= $queryString?>&mostrar=<?= $mostrar; ?>&pagina=" + x.value;
      }

      function SelTodos(x) {
         var CheckDir = document.getElementsByName('idDir');

         for (i = 0; i < CheckDir.length; i++) {
            if (x.checked) {
               CheckDir[i].checked = true;
            } else {
               CheckDir[i].checked = false;
            }

         }

      }

      function EliminarEntrada(pag) {
         var num_idleg = document.getElementsByName("idDir").length;
         var cad_eliminados = "";
         for (i = 0; i < num_idleg; i++) {
            if (document.getElementsByName("idDir")[i].checked) {

               if (cad_eliminados == "") {
                  cad_eliminados += document.getElementsByName("idDir")[i].value;
               } else {
                  cad_eliminados += "-" + document.getElementsByName("idDir")[i].value;
               }
            }
         }
         var urldest = "entity-eliminar.php";
         var cad = "page=" + pag + "&cadEliminados=" + cad_eliminados + "&Ambito=<?= $entity->GetTable() ?>";

         if (cad_eliminados != "") {

            window.open(urldest + "?" + cad, '', 'width=200,height=200');
         }
      }
   </script>
</head>

<body>
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
                  <?php if (($_SESSION["TipoUsuario"] == "ADMIN") or ($_SESSION["TipoUsuario"] == "USERCIT")) { ?>
                     <li><a href="<?= $editPage ?>">A&ntilde;adir entrada</a></li>
                  <?php } ?>
                  <li><a href="<?= $listPage ?>">Listado</a> </li>
               </ul>
            </div>
            <div class="content">
               <table role="table" id="noticiasSearch">
                  <thead role="rowgroup">
                     <tr>
                        <th role="columnheader">Buscar</th>
                        <th role="columnheader">Clasificación</th>
                        <th role="columnheader">mostrar</th>
                     </tr>
                  </thead>
                  <tbody role="rowgroup">
                     <tr>
                        <td>
                           <form id="form1" name="form1" method="post" action="">
                              <label>Buscar
                                 <input type="text" name="BUSCAR" id="BUSCAR" />
                              </label>
                              <input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
                           </form>
                        </td>
                        <td>
                           <?php
                           $accion = "onchange=\"CambiarClasificacion(this);\"";
                           $list = $entityManager->get_enum_values('Clasificacion');
                           ?>
                           <select name="CLASIFICACION" onchange="CambiarClasificacion(this);">
                              <option value="" <?php if ($clasificacion == "") echo "selected=\"selected\""; ?>>Todas</option>
                              <?php
                              foreach ($list as $item) {
                              ?>
                                 <option value="<?= $item ?>" <?php if ($clasificacion == $item) echo "selected=\"selected\""; ?>><?= $item ?></option>
                              <?php
                              }
                              ?>
                           </select>
                        </td>
                        <td>
                           <span class="opcionElegida">Mostrar:</span>
                           <select name="MOSTRAR" onChange="Paginar(this);" class="txt_inputs_buscador">
                              <option value="10" <?php if ($mostrar == 10) echo "selected"; ?>>10</option>
                              <option value="25" <?php if ($mostrar == 25) echo "selected"; ?>>25</option>
                              <option value="50" <?php if ($mostrar == 50) echo "selected"; ?>>50</option>
                              <option value="100" <?php if ($mostrar == 100) echo "selected"; ?>>100</option>
                              <option value="0" <?php if ($mostrar == 0) echo "selected"; ?>>Todos</option>
                           </select>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <?php
            $query = GetQuery($buscar, $clasificacion);
            $res = SearchResult($query, $mostrar, $pagina, $db);
            $numTotalRegistros = $res['total'];
            $list = $res['result'];
                           
            if ($mostrar > 0) {
               $numPags = ceil($numTotalRegistros / $mostrar);
            } else {
               $numPags = 1;
            }

            if ($mostrar > 0) {
               $sigmostrar = $mostrar;
            } else {
               $mostrar = $numTotalRegistros;
               $sigmostrar = 0;
            }

            if ($numTotalRegistros > 0) {
            ?>
               <div class="content">
                  <table role="table" id="noticias">
                     <thead role="rowgroup">
                        <tr role="row">
                           <th role="columnheader">Nombre Común</th>
                           <th role="columnheader">Nombre Científico</th>
                           <th role="columnheader">Clase</th>
                           <th role="columnheader">Suborden</th>
                           <th role="columnheader">Clasificación</th>
                           <th role="columnheader">Autor</th>
                           <th role="columnheader"></th>
                           <th role="columnheader"></th>
                           <th role="columnheader"><input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" /></th>
                        </tr>
                     </thead>
                     <tbody role="rowgroup">
                        <?php
                        $clasefila = "filagris";
                        foreach ($list as $item) {
                        ?>
                           <tr role="row">
                              <td role="cell"><?= $item->NombreComun; ?></td>
                              <td role="cell"><?= $item->NombreCientifico; ?></td>
                              <td role="cell"><?= $item->Clase; ?></td>
                              <td role="cell"><?= $item->SubOrden; ?></td>
                              <td role="cell"><?= $item->Clasificacion; ?></td>
                              <td role="cell"><?= $item->Autor; ?></td>
                              <td role="cell"><img src="<?= str_replace("images", "thumb", "../files/" . $item->Path . "/" . $item->Archivo); ?>" width="<?= $AnchoThumb ?>" height="<?= $AltoThumb ?>" title="<?= $Titulo ?>" alt="<?= $Titulo ?>" /></td>
                              <td role="cell">
                                 <div align="center">
                                    <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='<?= $editPage ?>?<?= $entityId ?>=<?= $item->$entityId; ?>&pagina=<?php echo $pagina; ?>&mostrar=<?= $sigmostrar; ?>&titulo=<?php echo $titulo; ?>'" />
                                 </div>
                              </td>
                              <td role="cell">
                                 <div align="center">
                                    <input type="checkbox" name="idDir" value="<?php echo $item->$entityId; ?>" />
                                 </div>
                              </td>

                           </tr>

                        <?php

                        }
                        ?>

                        <tr role="row">
                           <td role="cell" colspan="8"></td>
                           <td role="cell"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $pagina; ?>)" /></td>
                        </tr>
                     </tbody>
                  </table>

                  <?php Pagination($pageName, $pagina, $mostrar, $numTotalRegistros, $numPags, $queryString); ?>

               </div>
            <?php

            }
            ?>
         </div>
         <?php
         include("./footer.php");
         ?>
      </div>
   </div>
</body>

</html>