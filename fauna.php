<?php
include("includes/funciones.php");
include("includes/Conn.php");

$Buscar = $_GET["Buscar"];
$Pagina = $_GET["Pagina"];
$Pagina = $_GET["Pagina"];
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"];
if (!is_numeric($Mostrar))$Mostrar = 10;
if($Buscar != ""){$ValorBuscar=$Buscar;}
$MetaTitulo = "Cervera de Pisuerga: Guia de Fauna en la Montaña Palentina";
$MetaDescripcion = "Guia de Fauna, senderismo, Mountain Bike, MTB en la Monta�a Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero hist�rico, Fuente del Cobre y Deshondonada, Senda Pe�a del Oso, Tejada de Tosande , Bosque F�sil, Pe�a Redonda";
$MetaKeywords = "Cervera de Pisuerga, Guia de rutas, Monta�a Palentina, Guia de rutas de la Monta�a Palentina: Verdiana, senderismo, Pozo de las Lomas, Robl�n de Estalaya, Pineda, Curavacas, GR-1 Sendero hist�rico, Fuente del Cobre y Deshondonada, Senda Pe�a del Oso, Tejada de Tosande , Bosque F�sil, Pe�a Redonda";
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
               <h1>Fauna</h1>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="fauna.php" title="Fauna de la Montaña Palentina">Fauna</a>
               </div>
               <form name="formBuscar" action="fauna.php" method="post" onsubmit="Buscar(document.formBuscar.BUSCAR);return false;">
                    <label for="BUSCAR" accesskey="W" lang="es" title="Buscar, tecla W">Buscar: <input name="BUSCAR" size="25" type="text" id="BUSCAR" value="<?php echo $ValorBuscar; ?>" placeholder="Buscar" /></label>
                    <input name="BUSCARBOTON" type="submit" value="Buscar" />
               </form>
               <?php 
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

                    $link = ConnBDCervera();
                    $sql = "SELECT idFauna, NombreComun, NombreCientifico, Familia, Descripcion, ImgDescripcion FROM Fauna ";
                    // Buscar
                    if ($Buscar != "") {
                    $sql .= " where (NombreComun 		like '%$Buscar%' "
                         . " or NombreCientifico 	like '%$Buscar%' "
                         . " or NombreComun 		like '%$Buscar%' "
                         . " or Familia			like '%$Buscar%' "     
                         . " or Descripcion      like '%$Buscar%' "     
                         . " or Habitat       	like '%$Buscar%')";  
                    }
                    // orden
                    $sql = $sql . " order by NombreComun ";

                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
                         // Paginador
                         echo " <div class='selectpag'>";
                         if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
                              echo "<label title=\"Ir a la Pagina\" for=\"Pagina1\" lang=\"es\">Ir a P&aacute;gina: ";
                              echo "<select name=\"Pagina\" id=\"Pagina1\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
                              for ($i = 1;$i <= $numPags; $i++){
                                   if ($i == $Pagina){
                                        echo "<option value=\"$i\"  selected=\"selected\">$i</option>";
                                   }else{
                                        echo "<option value=\"$i\">$i</option>";
                                   }
                              }
                              echo "</select></label>";
                         }
                         echo "</div>";
                         // Paginador

                         
                    }
                    ?>
               </div>
              
               <div class="content">
                    <?php
                         if($max > 0){  
                              // Bucle de registros
                              $RegistroMostrado = 0;
                              while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) && ($RegistroMostrado < $Mostrar)) {
                              $idFlora = $row["idFlora"];


                              ?>
                              <div class="museo">
                              <?php
                                   if($row["ImgDescripcion"] > 0){
                                                $sqlImg = "select * from Imagenes where idImagen = ". $row["ImgDescripcion"]. " and Publicar = 1 ";
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
                                                       echo "<a href=\"fauna-detalle.php?idFauna=".$row["idFauna"]."\" class=\"strDirectorio\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\"  /></a>";
                                                  }
                                                  mysqli_free_result($resultImg);
                                           }
                                   $Tecla++;
                                   if($Tecla == 10)$Tecla = 0;	
                                   ?>
                                   <h2><a href="fauna-detalle.php?idFauna=<?php echo $row["idFauna"];?>" accesskey="<?php echo $Tecla;?>" class="strRutas" title="m�s informaci�n sobre <?php echo $row["NombreComun"];?>, tecla <?php echo $Tecla;?>"><?php echo $row["NombreComun"];?></a></h2>
                                   ( <?php echo $row["NombreCientifico"];?> - <?php echo $row["Familia"];?> )
                                   <p>
                                   <?php 
                                   $Descripcion = html_entity_decode($row["Descripcion"], ENT_QUOTES);
                                   if($Descripcion != "") echo GetDescription($Descripcion,200);
                                   ?>
                                   <a href="fauna-detalle.php?idFauna=<?php echo $row["idFauna"];?>" class="strRutas" title="más informacián sobre <?php echo $row["NombreComun"];?>, tecla <?php echo $Tecla;?>">más...</a>
                                   </p>
                                   </div>
                              <?php

                              }


                         }

                    ?>
               </div>
               <div class="content">
                    <div class="paginator">
                         <div>
                    <?php
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
     echo "<a href=\"fauna.php?Pagina=".($Pagina - 1)."&amp;Buscar=$Buscar\" class=\"linkVerde\" title=\"Anterior página\" lang=\"es\"> &lt;&lt; Anterior </a>";
}else{
echo "&nbsp;";
}
?>
</div>
<div>
<?php
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"fauna.php?Pagina=".($Pagina + 1)."&amp;Buscar=$Buscar\" class=\"linkVerde\" title=\"Siguiente página\" lang=\"es\"> Siguiente &gt;&gt; </a>";
}else{
echo "&nbsp;";
}
?>
</div>
<div>
<?php
if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<label title=\"Ir a la Pagina\" for=\"ESCUDOSPAGINACION\" lang=\"es\">Ir a P&aacute;gina: </label>";
echo "<select name=\"Pagina\" id=\"ESCUDOSPAGINACION\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
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
	location.href = "fauna.php?Buscar=<?php echo $Buscar; ?>&Pagina="+x.value;
}
function Buscar(x){
	location.href = "fauna.php?Buscar=" + x.value;
}
//-->
</script>
</body>
</html>