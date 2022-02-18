<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\Noticias;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$noticiasEntity = new Noticias();
$noticiasManager = new Manager($noticiasEntity);
$db = new DB();

$idNucleoUrbano = '';
$idSubservicio = '';
$titulo = '';
$buscar = $_GET["buscar"] ?? '';
$pagina = $_GET["pagina"] ?? '';
if (!is_numeric($pagina)) $pagina = 1;
$mostrar = $_GET["mostrar"] ?? '';
if (!is_numeric($mostrar)) $mostrar = 10;


function SearchResult($buscar, $mostrar, $pagina, $db)
{
    $sql = "SELECT * FROM Noticias ";
    if ($buscar != "") {
        $sql .= " where  Noticias.Titulo like '%$buscar%' "
            . " or Noticias.Entradilla like '%$buscar%' "
            . " or Noticias.Cuerpo like '%$buscar%' "
            . " or Noticias.Fuente like '%$buscar%' "
            . " or Noticias.FechaNoticia like '%$buscar%' ";
    }

    $sql = $sql . " order by FechaNoticia desc ";

    $list = $db->query($sql);
    $NumTotalRegistros = count($list);

    if ($mostrar > 0) {
        $sql = $sql . " LIMIT " . ((($pagina * $mostrar) - $mostrar)) . "," . $mostrar;
    } else {
        $sql = $sql . " LIMIT " . ((($pagina * $NumTotalRegistros) - $NumTotalRegistros)) . "," . ($NumTotalRegistros);
    }


    return ['total' => $NumTotalRegistros, 'result' => $db->query($sql, 'fetch_object')];
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
            var urldest = "noticias-eliminar.php";
            var cad = "page=" + pag + "&cadEliminados=" + cad_eliminados;
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

        function Buscar(x) {
            location.href = "noticias.php?buscar=" + x.value;
        }

        function Paginar(x) {
            location.href = "noticias.php?mostrar=" + x.value;

        }

        function CambiarPagina(x) {
            location.href = "noticias.php?mostrar=<?php echo $mostrar; ?>&pagina=" + x.value;

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
                        <li><a href="noticias-editar.php">A&ntilde;adir noticia</a></li>
                        <li><a thref="noticias.php">Listado</a></li>
                    </ul>
                </div>

                <div id="content">
                    <table role="table" id="noticiasSearch">
                        <thead role="rowgroup">
                            <tr>
                                <th role="columnheader">Buscar</th>
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
                                    <span class="opcionElegida">mostrar:</span>
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


                $res = SearchResult($buscar, $mostrar, $pagina, $db);
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
                                    <th role="columnheader">Fecha</th>
                                    <th role="columnheader">Título</th>
                                    <th role="columnheader">Fuente</th>
                                    <th role="columnheader">Editar</th>
                                    <th role="columnheader"><input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos" /></th>
                                </tr>
                            </thead>


                            <tbody role="rowgroup">
                                <?php
                                $clasefila = "filagris";
                                foreach ($list as $noticia) {
                                ?>
                                    <tr role="row">
                                        <td role="cell"><?php echo date("d/m/Y", strtotime($noticia->FechaNoticia)); ?></td>
                                        <td role="cell"><?php echo $noticia->Titulo; ?></td>
                                        <td role="cell"><?php echo $noticia->Fuente; ?></td>
                                        <td role="cell">
                                        <div align="center">
                                        <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='noticias-editar.php?idNoticia=<?php echo $noticia->idNoticia;?>&pagina=<?php echo $pagina;?>&mostrar=<?= $sigmostrar;?>&titulo=<?php echo $titulo;?>'"/>
                                        </div></td>
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

                        <table role="table" id="noticias">
                            <tbody role="rowgroup">
                                <tr role="row">
                                    <td role="cell">

                                        <?php

                                        if (($pagina > 1) and ($mostrar < $NumTotalRegistros)) {

                                            echo "<a href=\"noticias.php?pagina=" . ($pagina - 1) . "&mostrar=$mostrar&buscar=$buscar\" class=\"linkBlanco\"> << Anterior </a>";
                                        }

                                        ?>
                                    </td>
                                    <td role="cell">
                                        <?php
                                        if (($pagina < $numPags) and ($mostrar < $NumTotalRegistros)) {

                                            echo "<a href=\"noticias.php?pagina=" . ($pagina + 1) . "&mostrar=$mostrar&buscar=$buscar\" class=\"linkBlanco\"> Siguiente >> </a>";
                                        }
                                        ?> </td>

                                    <td role="cell">
                                        <?php
                                        if (($numPags > 1) and ($mostrar < $NumTotalRegistros)) {
                                            echo "Ir a P&aacute;gina: ";
                                            echo "<select name=\"pagina\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
                                            for ($i = 1; $i <= $numPags; $i++) {
                                                if ($i == $pagina) {
                                                    echo "<option value=\"$i\" selected>$i</option>";
                                                } else {
                                                    echo "<option value=\"$i\">$i</option>";
                                                }
                                            }
                                            echo "</select>";
                                        }

                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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