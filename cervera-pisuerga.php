<?php

include("includes/funciones.php");
include("includes/Conn.php");
$idNucleoUrbano = '';
$idSubservicio = '';
$MetaTitulo = "Cervera de Pisuerga en la Montaña Palentina";
$MetaDescripcion = "Cervera de Pisuerga, en El corazón de la Montaña Palentina. Cervera de Pisuerga, Palencia y de la región de Castilla y León";
$MetaKeywords =  "Cervera de Pisuerga, Montaña Palentina, Cervera de Pisuerga, Palencia, Castilla y Leónrural, turísmo, naturaleza virgen, arte, historia, turimo rural";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$Buscar = $_POST["BUSCAR"] ?? '';
	$Pagina = $_POST["PAGINA"] ?? '';
	if (!is_numeric($Pagina))$Pagina = 1;
	$Mostrar = $_POST["MOSTRAR"] ?? 0;
	if (!is_numeric($Mostrar))$Mostrar = 10;
}else{
	$Buscar = $_GET["Buscar"] ?? '';
	$Pagina = $_GET["Pagina"] ?? '';
	if (!is_numeric($Pagina))$Pagina = 1;
	$Mostrar = $_GET["Mostrar"] ?? 0;
	if (!is_numeric($Mostrar))$Mostrar = 10;
}


if($Buscar != ""){$ValorBuscar=$Buscar;}else{$ValorBuscar="";}
?>
<!DOCTYPE html>
<html>
     <head>
<?php
include('./head.php');
?>        
     </head>
<body>
<div class="wrapper">
     <?php
     include('./header.php');
     include("./menu.php");
     ?>
     <div class="grid container">
          <?php
          include('./aside1.php');
          include('./aside2.php');
          ?>
               
          <div class="main">     
               <div class="content">
               <h1>Cervera de Pisuerga</h1>
	               <div class="MigasdePan">
	                    <a title="Localidades" href="area-municipal.php">Localidades</a> &gt; 
   						<a title="Cervera de Pisuerga" href="cervera-pisuerga.php">Cervera de Pisuerga</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p><img src="images/cerveradepisuerga.gif" title="Localidades: Cervera de Pisuerga" alt="Localidades: Cervera de Pisuerga" width="580" height="522" usemap="#Map" />
			   <map name="Map" id="Map">
				<!-- Cervaera de Pisuerga -->
				<area shape="poly" coords="321,309,309,317,300,313,304,306,301,302,305,295,309,295,313,297,322,309" href="localidades.php?idNucleoUrbano=1&amp;idArea=1" alt="Cervera de Pisuerga" title="Cervera de Pisuerga" />
				</map>
   				</p>
              
               </div>


               
              
              </div>

          <?php
          include("./sponsors.php");
          ?>         
          </div>
          <?php
          include("./footer.php");
          ?>
     </div>
</div>    
</body>
</html>




