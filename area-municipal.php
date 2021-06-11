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
                 <a title="Localización" href="localizacion.php">Localización</a> &gt; 
                  <a title="Mapa del municipio" href="mapa-municipio.php">Mapa del municipio</a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
   				<p><<img src="images/municipio.gif" alt="Mapa del municipio de Cervera de Pisuerga y la Monta�a Palentina" width="580" height="522" border="0" usemap="#Map" class="center" title="Mapa del municipio de Cervera de Pisuerga y la Monta�a Palentina" />
    <map name="Map" id="Map">
      <!-- Valle de Castilleria -->
      <area shape="circle" coords="411,164,5" href="localidades.php?idNucleoUrbano=10&amp;idArea=3" alt="Celadad de Castiller�a" title="Celadad de Castiller�a"/>
      <area shape="circle" coords="369,169,5" href="localidades.php?idNucleoUrbano=9&amp;idArea=3" alt="Verde�a" title="Verde�a" />
      <area shape="circle" coords="439,190,5" href="localidades.php?idNucleoUrbano=12&amp;idArea=3" alt="Herreruela de Castiller�a" title="Herreruela de Castiller�a" />
      <area shape="circle" coords="390,199,5" href="localidades.php?idNucleoUrbano=11&amp;idArea=3" alt="San Felices de Castiller�a" title="San Felices de Castiller�a" />
      <area shape="circle" coords="348,195,5" href="localidades.php?idNucleoUrbano=8&amp;idArea=3" alt="Estalaya" title="Estalaya" />
      <!-- Pantano de Requejada -->
      <area shape="circle" coords="328,214,5" href="localidades.php?idNucleoUrbano=17&amp;idArea=5" alt="Va�es" title="Va�es" />
      <area shape="circle" coords="294,267,5" href="localidades.php?idNucleoUrbano=16&amp;idArea=5" alt="Arbejal" title="Arbejal" />
      <!-- Valle Estrecho -->
      <area shape="circle" coords="229,240,5" href="localidades.php?idNucleoUrbano=7&amp;idArea=2" alt="Resoba" title="Resoba" />
      <area shape="circle" coords="130,259,5" href="localidades.php?idNucleoUrbano=5&amp;idArea=2" alt="Rebanal de las Llantas" title="Rebanal de las Llantas" />
      <area shape="circle" coords="176,260,5" href="localidades.php?idNucleoUrbano=4&amp;idArea=2" alt="San Mart�n de los Herreros" title="San Mart�n de los Herreros" />
      <area shape="circle" coords="271,306,5" href="localidades.php?idNucleoUrbano=2&amp;idArea=2" alt="Ruesga" title="Ruesga" />
      <area shape="circle" coords="222,283,5" href="localidades.php?idNucleoUrbano=3&amp;idArea=2" alt="Ventanilla" title="Ventanilla" />
      <area shape="circle" coords="158,229,5" href="localidades.php?idNucleoUrbano=6&amp;idArea=2" alt="Santiba�ez de Resoba" title="Santiba�ez de Resoba" />
      <!-- Valsadornin -->
      <area shape="circle" coords="344,250,5" href="localidades.php?idNucleoUrbano=13&amp;idArea=4" alt="Rabanal de los Caballeros" title="Rabanal de los Caballeros" />
      <area shape="circle" coords="345,280,5" href="localidades.php?idNucleoUrbano=14&amp;idArea=4" alt="Valsadorn�n" title="Valsadorn�n" />
      <area shape="circle" coords="375,271,5" href="localidades.php?idNucleoUrbano=15&amp;idArea=4" alt="Gramedo" title="Gramedo" />
      <!-- El Pisuerga -->
      <area shape="circle" coords="412,286,5" href="localidades.php?idNucleoUrbano=24&amp;idArea=7" alt="Vallespinoso de Cervera" title="Vallespinoso de Cervera" />
      <area shape="circle" coords="365,319,5" href="localidades.php?idNucleoUrbano=20&amp;idArea=7" alt="Lig��rzana" title="Lig��rzana" />
      <area shape="circle" coords="426,321,5" href="localidades.php?idNucleoUrbano=23&amp;idArea=7" alt="Rueda de Pisuerga" title="Rueda de Pisuerga" />
      <area shape="circle" coords="415,326,5" href="localidades.php?idNucleoUrbano=21&amp;idArea=7" alt="Quintanaluengos" title="Quintanaluengos" />
      <area shape="circle" coords="435,337,5" href="localidades.php?idNucleoUrbano=22&amp;idArea=7" alt="Barcenilla de Pisuerga" title="Barcenilla de Pisuerga" />
      <!-- La Ojeda -->
      <area shape="circle" coords="395,415,5" href="localidades.php?idNucleoUrbano=18&amp;idArea=6" alt="Cubillo de Ojeda" title="Cubillo de Ojeda" />
      <area shape="circle" coords="414,450,5" href="localidades.php?idNucleoUrbano=19&amp;idArea=6" alt="Perazancas de Ojeda" title="Perazancas de Ojeda" />
      <!-- Cervera de Pisuerga -->
      <area shape="poly" coords="302,298,304,307,301,317,310,319,319,310,310,295,301,298" href="localidades.php?idNucleoUrbano=1&amp;idArea=1" alt="Cervera de Pisuerga" title="Cervera de Pisuerga" />
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




