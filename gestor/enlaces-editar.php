<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Enlaces;
use citcervera\Model\Managers\Manager;
use citcervera\Model\Connections\DB;
use citcervera\Model\Managers\DataCarrier;

$dc = new DataCarrier();
$db = new DB();
$Enlaces = new Enlaces();
$enlacesManager = new Manager($Enlaces);

$ErrorMsg = "";
$idEnlace = $_GET["idEnlace"] ?? '';
$mostrar = $_GET["Mostrar"] ?? '';
$pagina = $_GET["Pagina"] ?? '';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $Enlaces->_POST();

  
  if ($Enlaces->UrlEnlace == "") {
    $ErrorMsg = "<span class=\"errortexto\">Url Enlace</span><br/>";
  }
  if ($ErrorMsg == "") {
    $Enlaces->Fecha = date("Y-m-d H:m:s");
    //var_dump($Enlaces);
    $enlacesManager->Save($Enlaces);
    $lastInsertedId = $enlacesManager->GetLastInsertedId();

    if ($lastInsertedId) {
      $Enlaces->idEnlace = $lastInsertedId;
      $dc->Set($enlacesManager->Get($lastInsertedId), 'Enlaces');
    }
  } else {
    $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
    $ErrorMsn .= "<blockquote>";
    $ErrorMsn .= $ErrorMsg;
    $ErrorMsn .= "</blockquote>";
  }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['idEnlace'])) {
    $enlacesManager->Get($_GET['idEnlace']);
    //var_dump($Enlaces);
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
  <title>Gestor de contenidos: Noticias editar</title>
  <link rel="stylesheet" href="css/beneus.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<link href="css/form.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="scripts/tiny_mce.js" language="javascript"></script>
  <script type="text/javascript" src="js/funciones.js" language="javascript"></script>

  <script language="javascript" type="text/javascript">
    tinyMCE.init({
      mode: "textareas",
      theme: "advanced",
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
</head>

<body>
  <div id="espere" style="display:none">
    <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
  </div>
  <?php
  if ($ErrorMsn != "") {
  ?>
    <script type="text/javascript">
      disDiv("contenido", true);
    </script>
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
            <li class="liselect"><a href="enlaces-editar.php">A&ntilde;adir enlace</a></li>
            <li><a href="enlaces.php">Listado</a></li>
          </ul>
        </div>

        <div class="content">
        <div class="form_wrapper">
						<div class="form_container">
							<div class="title_container">
								<h2>Noticias</h2>
							</div>
              <form name="formEntrada" id="formEntrada" action="enlaces-editar.php" onsubmit="EnviarEntradaEnlace(this,'editar');return false;" method="post">
								<div class="row clearfix">
									<div class="col_half">
										<label>Texto enlace</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                      <input name="TEXTOENLACE" type="text" id="TEXTOENLACE" value="<?= $Enlaces->TextoEnlace; ?>" size="100" maxlength="100" />
										</div>
									</div>
									<div class="col_half">
										<label>Url enace</label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input name="URLENLACE" type="text" id="URLENLACE" value="<?= $Enlaces->UrlEnlace; ?>" size="100" maxlength="255" />
										</div>
									</div>
								</div>
                <div class="row clearfix">
									<div class="col">
										<label>Descripción</label>
										<div class="textarea_field"> <span><i aria-hidden="true" class="fa fa-comment"></i></span>
                    <textarea name="DESCRIPCION" cols="80" rows="40" id="DESCRIPCION">
												<?= $Enlaces->Descripcion; ?></textarea>
											</textarea>

										</div>
									</div>
								</div>
                <div class="row clearfix">
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<input type="hidden" name="IDENLACE" value="<?php echo $Enlaces->idEnlace; ?>" />
											<button type="submit" class="button" name="ENVIAR" id="ENVIAR">Salvar</button>
										</div>
									</div>
									<div class="col_half">
										<label></label>
										<div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
											<?php
											$volver = 'location.href="enlaces.php?mostrar=' . $mostrar . '&pagina=' . $pagina . '"';
											?>
											<input type="button" name="VOLVER2" id="VOLVER2" class="button" value="Volver al listado" onclick='<?= $volver ?>' />
										</div>
									</div>
								</div>
              </form>
            </div>
        </div>
        <div class="content">
          
        </div>
        <div class="content">
          
        </div>
        <div class="content">
          
        </div>

      </div>
    </div>
  </div>



 
</body>

</html>