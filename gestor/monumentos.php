<?php

namespace citcervera;

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\NucleosUrbanos;

$editPage = 'monumentos-editar.php';
$listPage = 'monumentos.php';
$pageName = curPageName();

$entityName = __NAMESPACE__ . '\Model\Entities\Monumentos';
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
$buscar = $_GET["buscar"] ?? '';
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$pagina = $_GET["pagina"] ?? '';
if (!is_numeric($pagina)) $pagina = 1;
$mostrar = $_GET["mostrar"] ?? '';
if (!is_numeric($mostrar)) $mostrar = 10;

$nucleosUrbanos = $nucleosUrbanosManager->GetAll();
$dc->Set($nucleosUrbanos, 'NucleosUrbanos');




function GetQuery($buscar, $idNucleoUrbano)
{
   $sql = " Select idMonumento,Monumento,Direccion,Monumentos.idNucleoUrbano,NombreNucleoUrbano, Telefono,FechaInauguracion,FechaClausura,Monumentos.Descripcion,Horario from Monumentos "
     ." INNER JOIN NucleosUrbanos ON Monumentos.idNucleoUrbano = NucleosUrbanos.idNucleoUrbano ";
     if(($_SESSION["TipoUsuario"]!= "ADMIN") AND ($_SESSION["TipoUsuario"]!= "USERCIT")){ 
     $sql = $sql . " INNER JOIN UsuariosAcceso as UA ON Monumentos.idMonumento = UA.idAmbito ";
     }
     if ($idNucleoUrbano > 0){ $sql = $sql . " where Monumentos.idNucleoUrbano = $idNucleoUrbano ";}	
     if($buscar != ""){
     $sql .= " where  (Monumentos.Monumento like '%$buscar%' "
     . " or Monumentos.Descripcion like '%$buscar%' )"; 
     }
     if(($_SESSION["TipoUsuario"]!= "ADMIN") AND ($_SESSION["TipoUsuario"]!= "USERCIT")){ 

     $sql = $sql . " and UA.Ambito = 'Monumentos' and   UA.idUsuario = ". $_SESSION["idUsuario"];
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
   <title>Gestor de contenidos: <?= $entityTable; ?> listado</title>
   <link rel="stylesheet" href="css/beneus.css" />
   <link rel="stylesheet" href="css/menu.css" />
   <link rel="stylesheet" href="css/table.css" />
   <link rel="stylesheet" href="css/form.css" type="text/css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
   <script type="text/javascript" src="js/funciones.js"></script>
   <script>
      function SeleccionNucleoUrbano(x) {
         location.href = "<?= $pageName; ?>?Mostrar=<?php echo $Mostrar; ?>&idNucleoUrbano=" + x.value;

      }

      function Buscar(x) {
         location.href = "<?= $pageName; ?>?buscar=" + x.value;
      }

      function Paginar(x) {
         location.href = "<?= $pageName; ?>?idNucleoUrbano=<?= $idNucleoUrbano; ?>&mostrar=" + x.value;
      }

      function CambiarPagina(x) {
         location.href = "<?= $pageName; ?>?mostrar=<?= $mostrar; ?>&idNucleoUrbano=<?= $idNucleoUrbano; ?>&pagina=" + x.value;
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
                        <th role="columnheader">localidad</th>
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
                        <td role="columnheader">
                           <?php
                           $accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
                           $list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano', 'NombreNucleoUrbano'));
                           echo GetSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $list, "", "", "", $accion, $idNucleoUrbano);
                           ?>
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
            $query = GetQuery($buscar, $idNucleoUrbano);
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
                           <th role="columnheader">Monumento</th>
                           <th role="columnheader">Dirección</th>
                           <th role="columnheader">Nucleo urbano</th>
                           <th role="columnheader">Horario</th>
                           <th role="columnheader">Editar</th>
                           <th role="columnheader"><input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" /></th>
                        </tr>
                     </thead>


                     <tbody role="rowgroup">
                        <?php
                        $clasefila = "filagris";
                        foreach ($list as $item) {
                        ?>
                           <tr role="row">
                              <td role="cell"><?= $item->Monumento; ?></td>
                              <td role="cell"><?= $item->Direccion; ?></td>
                              <td role="cell"><?= $item->NombreNucleoUrbano; ?></td>
                              <td role="cell"><?= $item->Horario; ?></td>
                              <td role="cell">
                                 <div align="center">
                                    <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='<?=$editPage?>?<?=$entityId?>=<?= $item->$entityId; ?>&pagina=<?php echo $pagina; ?>&mostrar=<?= $sigmostrar; ?>&titulo=<?php echo $titulo; ?>'" />
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
                           <td role="cell" colspan="5"></td>            
                           <td role="cell"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $pagina; ?>)" /></td>
                        </tr>
                     </tbody>
                  </table>

                  <?php Pagination($pageName, $pagina, $mostrar, $numTotalRegistros, $numPags, $buscar); ?>

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