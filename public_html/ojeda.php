<?php
include("includes/Conn.php");
include("includes/funciones.php");

$idNucleoUrbano = '';
$idSubservicio = '';
$MetaTitulo = "Ojeda en la Montaña Palentina";
$MetaDescripcion = "Ojeda, en El corazón de la Montaña Palentina. Cubillo de Ojeda, Perazancas, Palencia y de la región de Castilla y León";
$MetaKeywords =  "Ojeda, Montaña Palentina, Cubillo de Ojeda, Perazancas, Palencia, Castilla y León, rural, turísmo, naturaleza virgen, arte, historia, turimo rural";

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
               <h1>Ojeda</h1>
   <div class="MigasdePan"><a title="Localidades" href="area-municipal.php">Localidades</a> &gt; <a href="ojeda.php" title="Ojeda">Ojeda</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p>
               <img src="images/ojeda.gif" title="Localidades de Ojeda: Cubillo de Ojeda, Perazancas" alt="Localidades de Ojeda: Cubillo de Ojeda, Perazancas" width="580" height="522" usemap="#Map" />
   <map name="Map" id="Map">
<!-- La Ojeda -->                             
<area shape="circle" coords="395,416,5" href="localidades.php?idNucleoUrbano=18&amp;idArea=6" alt="Cubillo de Ojeda" title="Cubillo de Ojeda" />
<area shape="circle" coords="414,449,5" href="localidades.php?idNucleoUrbano=19&amp;idArea=6" alt="Perazancas de Ojeda" title="Perazancas de Ojeda" />
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




