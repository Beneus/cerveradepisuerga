<?php
include("includes/Conn.php");
include("includes/variables.php");
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/beneus.css" />
  <link rel="stylesheet" href="css/menu.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://code.jquery.com/jquery-latest.pack.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/jquery.funciones.js"></script>
  <script type="text/javascript" src="js/funciones.js"></script>
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
              <li><a title="A&ntilde;adir entrada al directorio" href="directorio-entrada.php">A&ntilde;adir entrada</a></li>
            <?php } ?>
            <li><a title="Listado del directorio" href="directorio-listado.php">Listado</a> </li>
          </ul>
        </div>
        <div class="content">
        </div>
      </div>
      <?php
      include("./footer.php");
      ?>
    </div>
  </div>
</body>

</html>