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
               <h1>El Pisuerga</h1>
	               <div class="MigasdePan">
				   <a href="area-municipal.php" title="Localidades" >Localidades</a> &gt; 
					<a href="pisuerga.php" title="El Pisuerga" >El Pisuerga</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p>
				   <img src="images/pisuerga.gif" alt="Localidades del Pisuerga: Barcenilla de Pisuerga, Lig��rzana, Quintanaluengos, Rueda de Pisuerga, Vallespinoso de Cervera" title="Localidades del Pisuerga: Barcenilla de Pisuerga, Lig��rzana, Quintanaluengos, Rueda de Pisuerga, Vallespinoso de Cervera" width="580" height="522" usemap="#Map" longdesc="Mancomunidad aguas arriba del pisuerga, area: el Pisuerga, localidades:Barcenilla de Pisuerga, Lig��rzana, Quintanaluengos, Rueda de Pisuerga, Vallespinoso de Cervera" />
					<map name="Map" id="Map">
					<!-- El Pisuerga -->                      
					<area shape="circle" coords="365,318,5" href="localidades.php?idNucleoUrbano=20&amp;idArea=7" alt="Lig&uuml;�rzana" title="Lig&uuml;�rzana" />
					<area shape="circle" coords="415,326,5" href="localidades.php?idNucleoUrbano=21&amp;idArea=7" alt="Quintanaluengos" title="Quintanaluengos" />
					<area shape="circle" coords="425,320,5" href="localidades.php?idNucleoUrbano=23&amp;idArea=7" alt="rueda de Pisuerga" title="rueda de Pisuerga" />
					<area shape="circle" coords="434,337,5" href="localidades.php?idNucleoUrbano=22&amp;idArea=7" alt="Barcenilla de Pisuerga" title="Barcenilla de Pisuerga" />
					<area shape="circle" coords="412,287,5" href="localidades.php?idNucleoUrbano=24&amp;idArea=7" alt="Vallespinoso de Cervera" title="Vallespinoso de Cervera" />
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




