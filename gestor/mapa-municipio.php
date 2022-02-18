<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");
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
                         </ul>
                    </div>
                    <div class="content">
                         <div class="form_wrapper">
                              <div class="form_container">
                                   <div class="title_container">
                                        <h2>Mapa del municipio</h2>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <?php
                    include("./footer.php");
                    ?>
               </div>
          </div>
     </div>
</body>

</html>