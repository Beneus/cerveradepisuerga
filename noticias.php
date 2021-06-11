<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idNucleoUrbano = '';
$idSubservicio = '';
$MetaTitulo = "CIT Cervera de Pisuerga: Noticias de la Montaña Palentina";
$MetaDescripcion = "CIT Cervera de Pisuerga: Noticias de la Montaña Palentina";
$MetaKeywords =  "Cervera de Pisuerga, Pisuerga, Montaña Palentina, rural, tradicional, tradición ganadera, comercial, artesanal, capital, Montaña Palentina, cabecera de partido judicial, turísmo, naturaleza virgen, arte, historia";

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
               <h1>Noticias</h1>
	               <div class="MigasdePan">
	                    <a href="noticias.php" title="Noticias">Noticias</a>
	                   
	               </div>
              
               </div>
               <div class="content">
               		<form name="formBuscar" action="noticias.php" method="post">
				   <input type="hidden" name="PAGINA" value="<?php echo $Pagina;?>" />
				   <input type="hidden" name="MOSTRAR" value="<?php echo $Mostrar;?>" />
				   <label for="BUSCAR">Buscar: <input placeholder="Buscar" type="text" size="30" value="<?php echo $ValorBuscar;?>" name="BUSCAR" id="BUSCAR"/></label>
				   <input type="submit" name="BOTONBUSCAR" value="Buscar" />
				   </form>
               </div>
               <div class="content">
              	

<?php 

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT * FROM Noticias ";
if(isset($Buscar)) $sql .= " where  Titulo like '%$Buscar%' or Entradilla like '%$Buscar%' or Fuente like '%$Buscar%' or FechaNoticia like '%$Buscar%' or Cuerpo like '%$Buscar%' ";
$sql .= " order by FechaNoticia desc, idNoticia desc ";

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$result = mysqli_query($link,$sql);
if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$NumTotalRegistros = mysqli_num_rows($result);

$max = mysqli_num_rows($result);	

if($Mostrar > 0) 
	{
		$numPags = ceil($NumTotalRegistros/$Mostrar);
	}
else
	{
		$numPags = 1;
	}

if ($Mostrar > 0){
	$sigMostrar = $Mostrar;
	$sql = $sql . " LIMIT ". ((($Pagina * $Mostrar) - $Mostrar) ) .",". (($Pagina * $Mostrar) );
	
}else{
	$Mostrar = $NumTotalRegistros;
	$sigMostrar = 0;
	$sql = $sql . " LIMIT ". ((($Pagina * $NumTotalRegistros) - $NumTotalRegistros) ) .",". ($NumTotalRegistros);	
}


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$result = mysqli_query($link,$sql);
if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($result);	
if($max > 0){ 
$RegistroMostrado = 0;
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) && ($RegistroMostrado < $Mostrar)) 
{

?>
<div class="museo">
<span class="noticiafecha" ><?php echo FechaDerecho($row["FechaNoticia"]);?></span><br/>
<span class="noticiatitulo" ><a href="noticias-detalle.php?idNoticia=<?php echo $row["idNoticia"];?>&amp;Pagina=<?php echo $Pagina;?>&amp;Mostrar=<?php echo $Mostrar;?>&amp;Buscar=<?php echo $Buscar;?>" ><?php echo $row["Titulo"];?></a></span><br/>
<span class="noticiaentradilla" ><a href="noticias-detalle.php?idNoticia=<?php echo $row["idNoticia"];?>&amp;Pagina=<?php echo $Pagina;?>&amp;Mostrar=<?php echo $Mostrar;?>&amp;Buscar=<?php echo $Buscar;?>" ><?php echo $row["Entradilla"];?></a></span><br/>
<?php  if ($row["Fuente"] != ""){echo "<span class='noticiafuente' >Fuente: ".$row['Fuente']."</span>";}?>
</div>
<?php
$RegistroMostrado++;
	}
echo " <div class='paginador'>"; 
echo " <div class='anterior'>";	
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"noticias.php?Pagina=".($Pagina - 1)."&amp;Mostrar=$Mostrar&amp;buscar=$Buscar&amp;idNucleoUrbano=$idNucleoUrbano&amp;idSubservicio=$idSubservicio\" title=\"Pagina anterior, tecla Alt + B\" accesskey=\"B\" hreflang=\"es\" class=\"linkVerde\"> << Anterior </a>";
}else{
echo "&nbsp;";
}
echo "</div>";
echo " <div class='siguiente'>";
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"noticias.php?Pagina=".($Pagina + 1)."&amp;Mostrar=$Mostrar&amp;buscar=$Buscar&amp;idNucleoUrbano=$idNucleoUrbano&amp;idSubservicio=$idSubservicio\" title=\"Pagina siguiente, tecla Alt + G\" accesskey=\"G\" hreflang=\"es\" class=\"linkVerde\"> Siguiente >> </a>";
}else{
echo "&nbsp;";
}
echo "</div>";
echo " <div class='selectpag'>";
if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<label title=\"Ir a la Pagina, tecla Ñ\" for=\"Pagina\" accesskey=\"Ñ\" lang=\"es\">Ir a Página: ";
echo "<select id=\"Pagina\" name=\"Pagina\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
for ($i = 1;$i <= $numPags; $i++){
	if ($i == $Pagina){
		echo "<option value=\"$i\" selected=\"selected\">$i</option>";
	}else{
		echo "<option value=\"$i\">$i</option>";
	}
}
echo "</select></label>";
}
echo "</div>";
echo "</div>";

}else{
	// No hay entradas en el directorio
?>

<div class="errortexto">No hay Noticias</div>
<?php
}
mysqli_free_result($result);
mysqli_close($link);	
?>



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