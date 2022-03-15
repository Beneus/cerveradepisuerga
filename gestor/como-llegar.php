<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\ComoLlegar;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$ComoLlegar = new ComoLlegar();
$ComoLlegarManager = new Manager($ComoLlegar);

$ErrorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $ComoLlegar->_POST();
    if ($ErrorMsg == "") {
        $ComoLlegar->idComoLlegar = 1;
        $ComoLlegar->Fecha = date("Y-m-d H:m:s");
        //var_dump($ComoLlegar);
        $ComoLlegarManager->Save($ComoLlegar);
        $lastInsertedId = $ComoLlegarManager->GetLastInsertedId();
echo $lastInsertedId;
        if ($lastInsertedId) {
            $ComoLlegar->idComoLlegar = $lastInsertedId;
            $dc->Set($ComoLlegarManager->Get($lastInsertedId), 'ComoLlegar');
        }
    } else {
        $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
        $ErrorMsn .= "<blockquote>";
        $ErrorMsn .= $ErrorMsg;
        $ErrorMsn .= "</blockquote>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $ComoLlegarManager->Get(1);
}


?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="css/beneus.css" />
    <link rel="stylesheet" href="css/menu.css" />
    <link href="css/form.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <!--[if lt IE 9]> <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
        <script src="https://kit.fontawesome.com/baa3bdeae8.js" crossorigin="anonymous"></script>
   <script src="https://cdn.tiny.cloud/1/83pnziyrx0kiq1bgkbpgrc19n68sqvirdkp71te4e9vmqb5e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
   <script>
      tinymce.init({
         selector: '#DESCRIPCION'
      });
   </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#ENVIAR', function(evt) {
                $('#formEntrada').submit();
                evt.preventDefault();
                return false;
            });
        });
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

                        <li><a href="galeria-fotografica.php?Ambito=ComoLlegar&amp;idAmbito=1&amp;Campo=idComoLlegar&amp;NCampo=idComoLlegar&amp;Referer=como-llegar.php">A&ntilde;adir imagen</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="form_wrapper">
                        <div class="form_container">
                            <div class="title_container">
                                <h2>Inicio</h2>
                            </div>
                            <form enctype="multipart/form-data" name="formEntrada" id="formEntrada" method="POST">
                                <div class="row clearfix">
                                    <div class="col">
                                        <label>Contenido</label>
                                        <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>
                                            <textarea name="DESCRIPCION" cols="80" rows="40" placeholder="Notas del evento" id="DESCRIPCION">
												<?= $ComoLlegar->Descripcion; ?>
											</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col_half">
                                        <div class="input_field">
                                        </div>
                                    </div>
                                    <div class="col_half">
                                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-save"></i></span>
                                            <button id="ENVIAR">Salvar</button>


                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include("./footer.php");
            ?>
        </div>
    </div>
</body>

</html>