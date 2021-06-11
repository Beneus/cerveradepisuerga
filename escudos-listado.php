<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include("includes/funciones.php");
include("includes/Conn.php");

$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';
$ValorBuscar = '';
$NombreCientifico = '';
$NombreComun = '';
if (!is_numeric($Pagina))$Pagina = 1;
if (!is_numeric($Mostrar))$Mostrar = 10;

if($Buscar != ""){$ValorBuscar=$Buscar;}
$MetaTitulo = "Guia de labras heráldicas y escudos de Cervera de Pisuerga Palencia";
$MetaDescripcion = "Guia de labras heráldicas y escudos de Cervera de Pisuerga Palencia";
$MetaKeywords = "Cervera de Pisuerga, Pisuerga, Montaña Palentina, rural, tradicional, tradición ganadera, comercial, artesanal, capital, Montaña Palentina, cabecera de partido judicial, turísmo, naturaleza virgen, arte, historia";
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
                    <h1>Escudos (labras heraldicas)</h1>
                    <div class="MigasdePan">
                    <a href="que-ofrecemos.php" title="Qué ofrecemos" >Qué ofrecemos</a> &gt; 
                    <a href="escudos.php" title="Setas">Escudos </a> &gt; <a href="escudos-listado.php" title="Gu&iacute;a Micol&oacute;gica de la Monta&ntilde;a Palentina">Guia de labras her&aacute;ldicas</a>
                    </div>
                    <form name="formBuscar" action="escudos-listado.php" method="post" onsubmit="Buscar(document.formBuscar.BUSCAR);return false;">
                    <label for="BUSCAR" lang="es" accesskey="B" title="Buscar setas, tecla B">Buscar: </label>
                    <input name="BUSCAR" type="text" id="BUSCAR" size="25" value="<?php echo $ValorBuscar; ?>" placeholder="Buscar" />
                    <input name="BUSCARBOTON" type="submit" value="Buscar" />
                    </form>
                    <label class="opcionElegida" for="MOSTRAR" lang="es">Mostrar </label>
                    <select name="MOSTRAR" id="MOSTRAR" onchange="Paginar(this);" class="txt_inputs_buscador">
                    <option value="10" <?php if ($Mostrar == 10) echo "selected=\"selected\""; ?>>10</option>
                    <option value="25" <?php if ($Mostrar == 25) echo "selected=\"selected\""; ?>>25</option>
                    <option value="50" <?php if ($Mostrar == 50) echo "selected=\"selected\""; ?>>50</option>
                    <option value="100" <?php if ($Mostrar == 100) echo "selected=\"selected\""; ?>>100</option>
                    <option value="0" <?php if ($Mostrar == 0) echo "selected=\"selected\""; ?>>Todos</option>
                    </select>
               <?php     

                    $link = ConnBDCervera();
                    $sql = "SELECT ESC.* , NU.NombreNucleoUrbano FROM Escudos as ESC ";
                    $sql .= " left join NucleosUrbanos as NU on ESC.idNucleoUrbano = NU.idNucleoUrbano";
                    $sql .= " where idEscudo > 0 ";
                    // Clasificaci�n
                    if ($Buscar != "") {
                    $sql .= " and (ESC.Nombre 		like '%$Buscar%' "
                         . " or ESC.Direccion 	like '%$Buscar%' "
                         . " or ESC.Descripcion 		like '%$Buscar%' )";  
                    }
                    // orden
                    $sql = $sql . " order by Nombre ";
                    mysqli_query($link,'SET NAMES utf8');
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
                    if($Mostrar > 0) {$numPags=ceil($NumTotalRegistros/$Mostrar);}else{$numPags=1;}
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
                    // paginator
                         if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
                         echo "<label title=\"Ir a la P&aacute;gina\" for=\"Pagina1\" lang=\"es\">Ir a P&aacute;gina: </label>";
                         echo "<select name=\"Pagina\" id=\"Pagina1\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
                         for ($i = 1;$i <= $numPags; $i++){
                              if ($i == $Pagina){
                                   echo "<option value=\"$i\" selected=\"selected\">$i</option>";
                              }else{
                                   echo "<option value=\"$i\">$i</option>";
                              }
                         }
                         echo "</select>";
                         }
                    }
                    ?>
               </div>
               
               <div class="content">
                    <?php
                    $RegistroMostrado = 0;
                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) && ($RegistroMostrado < $Mostrar)) {
                    $idEscudo = $row["idEscudo"];

                    ?>
                    <div class="museo">
                    <?php
                    if($row["ImgDescripcion"] > 0){
                         $sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
                         mysqli_query($link,'SET NAMES utf8');
                         $resultImg = mysqli_query($link,$sqlImg);
                              if (!$resultImg){
                                   $message = "Invalid query".mysqli_error($link)."\n";
                                   $message .= "whole query: " .$sqlImg;	
                                   die($message);
                                   exit;
                              }
                              $maxImg = mysqli_num_rows($resultImg);	
                              if($maxImg > 0){
                                   $rowImg = mysqli_fetch_array($resultImg, MYSQLI_ASSOC);
                                   $Path = $rowImg["Path"];
                                   $Archivo = $rowImg["Archivo"];
                                   $Titulo = $rowImg["Titulo"];
                                   $Pie = $rowImg["Pie"]; 
                                   $Ancho = $rowImg["Ancho"];
                                   $Alto = $rowImg["Alto"];
                                   $AnchoThumb = $rowImg["AnchoThumb"];
                                   $AltoThumb = $rowImg["AltoThumb"];
                                   echo "<a href=\"escudos-detalle.php?idEscudo=$idEscudo\" class=\"strDirectorio\" title=\"".$row["NombreComun"] ." (".$row["NombreCientifico"].")\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                              }
                              ?>
                              


                         <?php
                              mysqli_free_result($resultImg);
                         }
                         ?>
                         <h2>
                              <a href="escudos-detalle.php?idEscudo=<?php echo $row["idEscudo"];?>" accesskey="<?php echo $Tecla;?>" class="strRutas" title="<?php echo $row["Nombre"];?>: m�s informaci�n, tecla <?php echo $Tecla;?>">
                              <?= $row["Nombre"]; ?></a></h2>
                              <ul>

                              <li><span class="DatosTitulo">Nombre</span><span class="DatosValor"><?php echo $row["Nombre"];?></span></li>
                              <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $row["Direccion"];?></span></li>
                              <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><?php echo $row["NombreNucleoUrbano"];?></span></li>
                              <li><a href="escudos-detalle.php?idEscudo=<?php echo $row["idEscudo"];?>" title="<?php echo $row["Nombre"];?>: más informaci&oacute;n, tecla <?php echo $Tecla;?>">más informaci&oacute;n...</a></li>
                              </ul>
                    </div>
                    <?php
                    $RegistroMostrado++;
                    }
                    ?>

               </div>
               <div class="content">
                    <div class="paginator">
                         <div>
                    <?php
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"escudos-listado.php?Pagina=".($Pagina - 1)."&amp;Buscar=$Buscar&amp;Mostrar=$Mostrar\" class=\"linkVerde\" accesskey=\"G\" title=\"Anterior, tecla G\"> &lt;&lt; Anterior </a>";
}else{
echo "&nbsp;";
}
?>
</div>
<div>
<?php
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"escudos-listado.php?Pagina=".($Pagina + 1)."&amp;Buscar=$Buscar&amp;Mostrar=$Mostrar\" class=\"linkVerde\" accesskey=\"H\" title=\"Siguiente, tecla H\"> Siguiente &gt;&gt; </a>";
}else{
echo "&nbsp;";
}
?>
</div>
<div>
<?php
if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<label title=\"Ir a la Pagina\" for=\"Pagina2\" lang=\"es\">Ir a P&aacute;gina: </label>";
echo "<select name=\"Pagina\" id=\"Pagina2\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
for ($i = 1;$i <= $numPags; $i++){
	if ($i == $Pagina){
		echo "<option value=\"$i\" selected=\"selected\">$i</option>";
	}else{
		echo "<option value=\"$i\">$i</option>";
	}
}
echo "</select>";
}
?>
</div>

<?php


mysqli_free_result($result);
mysqli_close($link);	
?>
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
<script type="text/javascript">
<!--
function CambiarPagina(x){
location.href = "escudos-listado.php?&Buscar=<?php echo $Buscar; ?>&Pagina="+x.value;
}
function Buscar(x){
location.href = "escudos-listado.php?Buscar=" + x.value;
}
function Paginar(x){
location.href = "escudos-listado.php?Buscar=<?php echo $Buscar; ?>&Mostrar="+x.value;

}
//-->
</script>
</body>
</html>