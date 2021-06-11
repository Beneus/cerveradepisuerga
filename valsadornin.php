<?php
include("includes/Conn.php");
include("includes/funciones.php");

$idNucleoUrbano = '';
$idSubservicio = '';
$MetaTitulo = "Valsadornín en la Montaña Palentina, Palencia, Castilla y León";
$MetaDescripcion = "Valsadornín, en El corazón de la Montaña Palentina. Gramedo, Rabanal de los Caballeros, Valsadornín, Palencia y de la región de Castilla y León";
$MetaKeywords =  "Valsadornín, Pisuerga, Montaña Palentina, Gramedo, Rabanal de los Caballeros, Valsadornín, Palencia, Castilla y León, rural, turísmo, naturaleza virgen, arte, historia, turimo rural";

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
               <h1>Valsadornín</h1>
	               <div class="MigasdePan">
                  <a title="Localidades" href="area-municipal.php">Localidades</a> &gt; 
   <a title="Valsadornín" href="valsadornin.php">Valsadornín</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p>
               <img src="images/valsadornin.gif" title="Localidades de Valsadorn�n: Gramedo, Rabanal de los Caballeros, Valsadorn�n" alt="Localidades de Valsadorn�n: Gramedo, Rabanal de los Caballeros, Valsadorn�n" width="580" height="522" usemap="#Map" />
   <map name="Map" id="Map">
<!-- Valsadornin -->                         
<area shape="circle" coords="345,279,5" href="localidades.php?idNucleoUrbano=14&amp;idArea=4" alt="Valsadornin" title="Valsadornin" />
<area shape="circle" coords="374,270,5" href="localidades.php?idNucleoUrbano=15&amp;idArea=4" alt="Gramedo" title="Gramedo" />
<area shape="circle" coords="345,250,5" href="localidades.php?idNucleoUrbano=13&amp;idArea=4" alt="Rabanal de los Caballeros" title="Rabanal de los Caballeros" />
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




