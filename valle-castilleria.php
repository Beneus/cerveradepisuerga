<?php
include("includes/Conn.php");
include("includes/funciones.php");

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
               <h1>Valle de Castillería</h1>
	               <div class="MigasdePan">
                 <a title="Localidades" href="area-municipal.php">Localidades</a> &gt; 
   	<a title="Valle de Castillería" href="valle-castilleria.php">Valle de Castillería</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p>
				   <img src="images/valleCastilleria.gif" title="Localidades del Valle de Castiler�a: Celada de Roblecedo, Estalaya, Herreruela de Castiller�a, San Felices de Castiler�a, Verde�a" alt="Localidades del Valle de Castiler�a: Celada de Roblecedo, Estalaya, Herreruela de Castiller�a, San Felices de Castiler�a, Verde�a" width="580" height="522" usemap="#Map" />
     <map name="Map" id="Map">
       <!-- Valle de Castilleria -->
       <area shape="circle" coords="348,195,5" href="localidades.php?idNucleoUrbano=8&amp;idArea=3" alt="Estalaya" title="Estalaya" />
       <area shape="circle" coords="369,168,5" href="localidades.php?idNucleoUrbano=9&amp;idArea=3" alt="Verde�a" title="Verde�a" />
       <area shape="circle" coords="411,163,5" href="localidades.php?idNucleoUrbano=10&amp;idArea=3" alt="Celada de Roblecedo" title="Celada de Roblecedo" />
       <area shape="circle" coords="390,199,5" href="localidades.php?idNucleoUrbano=11&amp;idArea=3" alt="San Felices de Castilleria" title="San Felices de Castilleria" />
       <area shape="circle" coords="439,189,5" href="localidades.php?idNucleoUrbano=12&amp;idArea=3" alt="Herreruela de Castilleria" title="Herreruela de Castilleria" />
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




