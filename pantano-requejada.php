<?php
include("includes/Conn.php");
include("includes/funciones.php");

$idNucleoUrbano = '';
$idSubservicio = '';
$MetaTitulo = "Pantano de Requejada en la Montaña Palentina, Palencia, Castilla y León";
$MetaDescripcion = "Pantano de Requejada, en El corazón de la Montaña Palentina. Arbejal, Vañes, Palencia y de la región de Castilla y León";
$MetaKeywords =  "Pantano de Requejada, Montaña Palentina, Arbejal, Vañes, Palencia, Castilla y León, rural, turísmo, naturaleza virgen, arte, historia, turimo rural";

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
               <h1>Pantano Requejada</h1>
   <div class="MigasdePan">
   	<a title="Localidades" href="area-municipal.php">Localidades</a> &gt; 
   	<a title="Pantano de Requejada" href="pantano-requejada.php">Pantano de Requejada</a>
   	</div>
               </div>
               <div class="content">
 				<div class="museo">
   				<p>
				   <img src="images/pantanoRequejada.gif" title="Localidades del Pantano de Requejada: Arbejal, Va�es" alt="Localidades del Pantano de Requejada: Arbejal, Va�es" width="580" height="522" usemap="#Map" />
					<map name="Map" id="Map">
					<!-- Pantano de Requejada -->                 
					<area shape="circle" coords="294,267,5" href="localidades.php?idNucleoUrbano=16&amp;idArea=5" alt="Arbejal" title="Arbejal" />
					<area shape="circle" coords="328,215,5" href="localidades.php?idNucleoUrbano=17&amp;idArea=5" alt="Va�es" title="Va�es" />
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




