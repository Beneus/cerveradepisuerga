<?php
include("includes/Conn.php");
include("includes/funciones.php");

$idNucleoUrbano = '';
$idSubservicio = '';
$MetaTitulo = "Valle Estrecho en la Montaña Palentina, Palencia, Castilla y León";
$MetaDescripcion = "Valle Estrecho, en El corazón de la Montaña Palentina. Resoba, Ruesga, San Martín de los Herreos, Rebanal de las llantas, Santíbañez de Resoba, Ventanilla, Palencia y de la región de Castilla y León";
$MetaKeywords =  "Valle Estrecho, Pisuerga, Montaña Palentina, Resoba, Ruesga, San Martín de los Herreos, Rebanal de las llantas, Santíbañez de Resoba, Ventanilla, Palencia, Castilla y León, rural, turísmo, naturaleza virgen, arte, historia, turimo rural";

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
               <h1>Valle Estrecho</h1>
	               <div class="MigasdePan">
				   <a title="Localidades" href="area-municipal.php">Localidades</a> &gt; 
<a title="Valle Estrecho" href="valle-estrecho.php">Valle Estrecho</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p>
				   <img src="images/valleEstrecho.gif" alt="Mapa municipio" width="580" height="522" usemap="#Map" />
<map name="Map" id="Map">
<!-- Valle Estrecho -->
<area shape="circle" coords="273,306,5" href="localidades.php?idNucleoUrbano=2&amp;idArea=2" alt="Ruesga" title="Ruesga" />
<area shape="circle" coords="158,228,5" href="localidades.php?idNucleoUrbano=6&amp;idArea=2" alt="Sant�ba�ez de Resoba" title="Sant�ba�ez de Resoba" />
<area shape="circle" coords="131,260,6" href="localidades.php?idNucleoUrbano=5&amp;idArea=2" alt="Rebanal de las Llantas" title="Rebanal de las Llantas" />
<area shape="circle" coords="176,259,5" href="localidades.php?idNucleoUrbano=4&amp;idArea=2" alt="San Mart�n de los Herreros" title="San Mart�n de los Herreros" />
<area shape="circle" coords="227,240,5" href="localidades.php?idNucleoUrbano=7&amp;idArea=2" alt="Resoba" title="Resoba" />
<area shape="circle" coords="220,282,5" href="localidades.php?idNucleoUrbano=3&amp;idArea=2" alt="Ventanilla" title="Ventanilla" />
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




