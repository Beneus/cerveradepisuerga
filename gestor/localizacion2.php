<?php
include("includes/Conn.php");
include("includes/variables.php");
?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="css/beneus.css"/>
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
  <li><h2><?= explode('.',curPageName())[0] ?></h2></li>
    <li><a title="A&ntilde;adir noticia" href="localizacion-entrada.php">Editar</a></li>
    <li><a title="Listado del noticias"  href="galeria-fotografica.php?Ambito=Localizacion&idAmbito=1&Campo=idLocalizacion&NCampo=idLocalizacion&Referer=localizacion-entrada.php">A&ntilde;adir imagen</a></li>
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