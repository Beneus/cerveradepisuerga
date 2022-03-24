<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Servicios;
use citcervera\Model\Entities\SubServicios;
use citcervera\Model\Entities\NucleosUrbanos;

$editPage = 'directorio-editar.php';
$listPage = 'directorio.php';
$pageName = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Directorio';
$entity = new $entityName();
$entityId = $entity->getId();
$entityTable = $entity->getTable();

$dc = new DataCarrier();
$entityManager = new Manager($entity);
$db = new DB();

$idServicio = $_GET["idServicio"] ?? '';
$idSubServicio = $_GET["idSubServicio"] ?? '';
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$buscar = $_GET["buscar"] ?? '';
$pagina = $_GET["pagina"] ?? '';
if (!is_numeric($pagina)) $pagina = 1;
$mostrar = $_GET["mostrar"] ?? '';
if (!is_numeric($mostrar)) $mostrar = 10;

$nucleosUrbanosEntity = new NucleosUrbanos();
$nucleosUrbanosManager = new Manager($nucleosUrbanosEntity);
$serviciosEntity = new Servicios();
$serviciosManager = new Manager($serviciosEntity);
$subServiciosEntity = new SubServicios();
$subserviciosManager = new Manager($subServiciosEntity);



$dc->Set($nucleosUrbanosManager->GetAll(), 'NucleosUrbanos');
$dc->Set($serviciosManager->GetAll(), 'Servicios');
if ($idServicio != '') {
   $sql = " select * from SubServicios where idServicio = " . $idServicio . " order by NombreSubServicio";
   $dc->Set($entityManager->Query($sql, 'fetch_object', new SubServicios()), 'SubServicios');
} else {
   $dc->Set([], 'SubServicios');
}

$queryString = '&idNucleoUrbano=' . $idNucleoUrbano . '&idServicio=' . $idServicio . '&idSubServicio=' . $idSubServicio;

function GetQuery($buscar, $idNucleoUrbano, $idServicio, $idSubServicio)
{
   $sql = "Select D.*, NU.* from Directorio as D  INNER JOIN NucleosUrbanos  as NU ON D.idNucleoUrbano = NU.idNucleoUrbano";

   if (($_SESSION["TipoUsuario"] != "ADMIN") and ($_SESSION["TipoUsuario"] != "USERCIT")) {
      $sql = $sql . " INNER JOIN UsuariosAcceso as UA ON D.idDirectorio = UA.idAmbito ";
   }

   if (intval($idServicio) > 0) {
      $sql = $sql . " inner join DirectorioServicio as DS on D.idDirectorio = DS.idDirectorio ";
   }
   if (intval($idSubServicio) > 0) {
      $sql = $sql . " inner join DirectorioSubServicio as DSB on D.idDirectorio = DSB.idDirectorio ";
   }
   if (intval($idNucleoUrbano)  > 0) {
      $sql .= " where D.idNucleoUrbano = $idNucleoUrbano ";
      if (intval($idServicio) > 0) {
         $sql .= " and  DS.idServicio = $idServicio ";
      }

      if (intval($idSubServicio) > 0) {
         $sql .= " and  DSB.idSubServicio = $idSubServicio ";
      }
   } else {
      if (intval($idServicio) > 0) {
         $sql .= " where  DS.idServicio = $idServicio ";
      }
      if (intval($idSubServicio) > 0) {
         $sql .= " and  DSB.idSubServicio = $idSubServicio ";
      }
   }

   if ($buscar != "") {
      $sql .= " where  ( D.NombreComercial like '%$buscar%' "
         . " or NU.NombreNucleoUrbano like '%$buscar%' "
         . " or D.Direccion like '%$buscar%' ) ";
   }
   if (($_SESSION["TipoUsuario"] != "ADMIN") and ($_SESSION["TipoUsuario"] != "USERCIT")) {

      $sql = $sql . " and UA.Ambito = 'Directorio' and  UA.idUsuario = " . $_SESSION["idUsuario"];
   }
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
   return ['total' => $numTotalRegistros, 'result' => $db->query($query, 'fetch_object')];
}
?>
<!DOCTYPE html>
<html>

<head>

   <link rel="stylesheet" href="css/beneus.css" />
   <link rel="stylesheet" href="css/menu.css" />
   <link rel="stylesheet" href="css/table.css" />
   <link rel="stylesheet" href="css/form.css" type="text/css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
   <script type="text/javascript" src="js/jquery.funciones.js"></script>
   <script type="text/javascript" src="js/funciones.js"></script>
   <script type="text/javascript">
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

      function SeleccionNucleoUrbano(x) {
         location.href = "<?= $pageName; ?>?mostrar=<?php echo $mostrar; ?>&idServicio=<?php echo $idServicio; ?>&idSubServicio=<?php echo $idSubServicio; ?>&idNucleoUrbano=" + x.value;

      }

      function SeleccionaServicio(x) {
         location.href = "<?= $pageName; ?>?mostrar=<?php echo $mostrar; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&idServicio=" + x.value;

      }

      function SeleccionaSubServicio(x) {
         location.href = "<?= $pageName; ?>?mostrar=<?php echo $mostrar; ?>&idNucleoUrbano=<?php echo $idNucleoUrbano; ?>&idServicio=<?php echo $idServicio; ?>&idSubServicio=" + x.value;

      }


      function Buscar(x) {
         location.href = "<?= $pageName; ?>?buscar=" + x.value;
      }

      function Paginar(x) {
         location.href = "<?= $pageName; ?>?mostrar=" + x.value;

      }

      function CambiarPagina(x) {
         location.href = "<?= $pageName; ?>?mostrar=<?php echo $mostrar; ?>&pagina=" + x.value;

      }
   </script>
</head>

<body>
   <div class="wrapper">
      <header id="header" class="grid">
         <div class="grid-cell">
            <div class="grid">
               <a href="/"><img id="logo" src="images/LOGO-CIT-CERVERA.gif" /> </a>
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

            <div id="content">
               <table role="table" id="noticiasSearch">
                  <thead role="rowgroup">
                     <tr>
                        <th role="columnheader">Buscar</th>
                        <th role="columnheader">Población</th>
                        <th role="columnheader">Servicio</th>
                        <th role="columnheader">Sub servicio</th>
                        <th role="columnheader">mostrar</th>
                     </tr>
                  </thead>
                  <tbody role="rowgroup">
                     <tr>
                        <td>
                           <form id="form1" name="form1" method="post" action="">
                              <label>Buscar
                                 <input type="text" name="BUSCAR" id="BUSCAR" />
                              </label><input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
                           </form>
                        </td>
                        <td>
                           <?php
                           $accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
                           $list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano', 'NombreNucleoUrbano'));
                           echo GetSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $list, "", "", "", $accion, $idNucleoUrbano);
                           ?>
                        </td>
                        <td>
                           <?php
                           $accion = "onchange=\"SeleccionaServicio(this);\"";
                           $list = GetSmallArrayFromBiggerOne($dc, 'Servicios', array('idServicio', 'NombreServicio'));
                           echo GetSelect("IDSERVICIO", "idServicio", "NombreServicio", $list, "", "", "", $accion, $idServicio);
                           ?>
                        </td>
                        <td>
                           <?php
                           $accion = "onchange=\"SeleccionaSubServicio(this);\"";
                           $list = GetSmallArrayFromBiggerOne($dc, 'SubServicios', array('idSubServicio', 'NombreSubServicio'));
                           echo GetSelect("IDSUBSERVICIO", "idSubServicio", "NombreSubServicio", $list, "", "", "", $accion, $idSubServicio);
                           ?></td>
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

            $query = GetQuery($buscar, $idNucleoUrbano, $idServicio, $idSubServicio);
            $res = SearchResult($query, $mostrar, $pagina, $db);
            $NumTotalRegistros = $res['total'];
            $list = $res['result'];

            if ($mostrar > 0) {
               $numPags = ceil($NumTotalRegistros / $mostrar);
            } else {
               $numPags = 1;
            }

            if ($mostrar > 0) {
               $sigmostrar = $mostrar;
            } else {
               $mostrar = $NumTotalRegistros;
               $sigmostrar = 0;
            }
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


            if ($NumTotalRegistros > 0) {
            ?>

               <div class="content">
                  <table role="table" id="noticias">
                     <thead role="rowgroup">
                        <tr role="row">
                           <th role="columnheader">Nombre comercial</th>
                           <th role="columnheader">Dirección</th>
                           <th role="columnheader">Población</th>
                           <th role="columnheader">Editar</th>
                           <th role="columnheader"><input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" /></th>
                        </tr>
                     </thead>


                     <tbody role="rowgroup">
                        <?php
                        $clasefila = "filagris";
                        foreach ($list as $entity) {
                        ?>
                           <tr role="row">
                              <td role="cell"><?= $entity->NombreComercial; ?></td>
                              <td role="cell"><?= $entity->Direccion; ?></td>
                              <td role="cell"><?= $entity->NombreNucleoUrbano; ?></td>
                              <td role="cell">
                                 <div align="center">
                                    <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='<?= $editPage ?>?<?= $entityId ?>=<?= $item->$entityId; ?>&pagina=<?php echo $pagina; ?>&mostrar=<?= $sigmostrar; ?>&titulo=<?php echo $titulo; ?>'" />
                                 </div>
                              </td>
                              <td role="cell">
                                 <div align="center">
                                    <input type="checkbox" name="idDir" value="<?php echo $noticia->idNoticia; ?>" />
                                 </div>
                              </td>

                           </tr>

                        <?php

                        }
                        ?>

                        <tr role="row">
                           <td role="cell"></td>
                           <td role="cell">

                           </td>

                           <td role="cell">

                           </td>
                           <td role="cell">

                           </td>
                           <td role="cell"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $pagina; ?>)" /></td>
                        </tr>
                     </tbody>
                  </table>

                  <?php Pagination($pageName, $pagina, $mostrar, $NumTotalRegistros, $numPags, $queryString); ?>
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