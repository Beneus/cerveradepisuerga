<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Inicio;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Imagenes;

$dc = new DataCarrier();
$Inicio = new Inicio();
$inicioManager = new Manager($Inicio);

$ErrorMsg = '';



if ($_SERVER['REQUEST_METHOD'] == "POST") {


     $Inicio->_POST();
     if ($ErrorMsg == "") {
          $Inicio->idInicio = 1;
          $Inicio->Fecha = date("Y-m-d H:m:s");
          //var_dump($Inicio);
          $inicioManager->Save($Inicio);
          $lastInsertedId = $inicioManager->GetLastInsertedId();

          if ($lastInsertedId) {
               $Inicio->idInicio = $lastInsertedId;
               $dc->Set($inicioManager->Get($lastInsertedId), 'Inicio');
          }
          
     } else {
          $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
          $ErrorMsn .= "<blockquote>";
          $ErrorMsn .= $ErrorMsg;
          $ErrorMsn .= "</blockquote>";
     }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
     $inicioManager->Get(1);
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
     <script src="https://use.fontawesome.com/4ecc3dbb0b.js"></script>


     <script type="text/javascript" src="scripts/tiny_mce.js" language="javascript"></script>
     <script language="javascript" type="text/javascript">
          tinyMCE.init({
               height: "250",
               mode: "textareas",
               theme: "advanced",
               content_css: 'css/form.css',
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


     <script>
          $(document).ready(function() {

               $(document).on('click', '#ENVIAR', function(evt) {

                    $('#formEntrada').submit();
                    evt.preventDefault();
                    return false;
               });


          });

          function EnviarEntradaInicio(x, tipo) {

               var cad = "";
               var subservicios = "";

               var contentCuerpo = tinyMCE.getContent('DESCRIPCION');
               var contentDescripcion = tinyMCE.getContent('DESCRIPCION');
               contentDescripcion = contentDescripcion.replace(/\+/g, "&#43");
               contentDescripcion = contentDescripcion.replace(/\\/g, "&#92");
               contentDescripcion = escape(contentDescripcion);

               if (navigator.userAgent == "Explorer") {
                    x.DESCRIPCION.innerHTML = contentDescripcion
                    x.DESCRIPCION.value = contentDescripcion;
               } else {

                    x.DESCRIPCION.value = contentDescripcion;
                    x.DESCRIPCION.innerHTML = contentDescripcion;

               }

               for (i = 0; i < x.length; i++) {
                    if (cad == "") {
                         cad = x[i].name + "=" + x[i].value;
                    } else {
                         cad = cad + "&" + x[i].name + "=" + x[i].value;
                    }
               }

               disDiv("contenido", true);
               document.getElementById("espere").style.display = "block";
               if (tipo == "nuevo") {
                    FAjax('entradadatosinicio.php', 'espere', cad, 'post', x, true);
               } else {
                    FAjax('editardatosinicio.php', 'espere', cad, 'post', x, false);
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
                              <li><a href="galeria-fotografica.php?Ambito=Inicio&amp;idAmbito=1&amp;Campo=idInicio&amp;NCampo=idInicio&amp;Referer=inicio.php">A&ntilde;adir imagen</a></li>
                         </ul>
                    </div>

                    <div class="content">
                         <div class="form_wrapper">
                              <div class="form_container">
                                   <div class="title_container">
                                        <h2>Inicio</h2>
                                   </div>
                                   <form enctype="multipart/form-data" name="formEntrada" id="formEntrada" method="POST">
                                        <input name="IDINICIO" type="hidden" id="IDINICIO" value="<?= $Inicio->idInicio; ?>" />
                                        <div class="row clearfix">
                                             <div class="col">
                                                  <label>Contenido</label>
                                                  <div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>
                                                       <textarea name="DESCRIPCION" cols="80" rows="40" placeholder="Notas del evento" id="DESCRIPCION">
												<?= $Inicio->Descripcion; ?>
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