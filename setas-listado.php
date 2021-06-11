<?php
include("includes/funciones.php");
include("includes/Conn.php");

$RegistroMostrado = '';
$Clasificacion = $_GET["Clasificacion"] ?? '';
$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar))$Mostrar = 10;
if($Buscar != ""){$ValorBuscar=$Buscar;}else{$ValorBuscar="Buscar";}
$MetaTitulo = "Guia micológica de la Montaña Palentina (Setas)";
$MetaDescripcion = "Guia micológica de la Montaña Palentina (Setas)";
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
               <h1>Setas</h1>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos" >Qué ofrecemos</a> &gt; 
               <a href="setas.php" title="Setas">Setas</a> &gt;
               <a href="setas-listado.php" title="Gu&iacute;a Micol&oacute;gica de la Montaña Palentina">Guia Micol&oacute;gica</a></div>
                    <form name="formBuscar" action="setas-listado.php" method="post" onsubmit="Buscar(document.formBuscar.BUSCAR);return false;">
                    <label for="CLASIFICACION" lang="es">Clasificación:</label> 
               <select name="CLASIFICACION" id="CLASIFICACION" onchange="CambiarClasificacion(this);">
                         <option value="" >Todas</option>
                    <option value="Mortal" <?php if($Clasificacion == "Mortal") echo "selected=\"selected\"";  ?>>Mortal</option>
                    <option value="Venenosa" <?php if($Clasificacion == "Venenosa") echo "selected=\"selected\"";  ?>>Venenosa</option>
                    <option value="Sin valor culinario" <?php if($Clasificacion == "Sin valor culinario") echo "selected=\"selected\"";  ?>>Sin valor culinario</option>
                    <option value="Buena" <?php if($Clasificacion == "Buena") echo "selected=\"selected\"";  ?>>Buena</option>
                    <option value="Excelente" <?php if($Clasificacion == "Excelente") echo "selected=\"selected\"";  ?>>Excelente</option>
                    <option value="Sin clasificar" <?php if($Clasificacion == "Sin clasificar") echo "selected=\"selected\"";  ?>>Sin clasificar</option>
                    </select>
                    <label for="BUSCAR" lang="es" title="Buscar setas">Buscar: <input name="BUSCAR" type="text" id="BUSCAR" size="25" value="<?php echo $ValorBuscar; ?>" /></label>
                         <input name="BUSCARBOTON" type="submit" value="Buscar" />
               </form>
               <label class="opcionElegida" for="MOSTRAR" lang="es" title="Mostrar setas">Mostrar </label>
               <select name="MOSTRAR" id="MOSTRAR" onchange="Paginar(this);" class="txt_inputs_buscador">
               <option value="10" <?php if ($Mostrar == 10) echo "selected=\"selected\""; ?>>10</option>
               <option value="25" <?php if ($Mostrar == 25) echo "selected=\"selected\""; ?>>25</option>
               <option value="50" <?php if ($Mostrar == 50) echo "selected=\"selected\""; ?>>50</option>
               <option value="100" <?php if ($Mostrar == 100) echo "selected=\"selected\""; ?>>100</option>
               <option value="0" <?php if ($Mostrar == 0) echo "selected=\"selected\""; ?>>Todos</option>
               </select>
               </div>
               <?php     
                    $link = ConnBDCervera();
                    $sql = "SELECT S.idSetas, S.NombreComun, S.NombreCientifico, S.Autor, S.Clasificacion, S.Clase, S.ImgSetas, SS.SubOrden FROM Setas as S ";
                    $sql .= " left join SetasSubOrden as SS on S.idSetasSubOrden = SS.idSetasSubOrden";
                    $sql .= " where idSetas > 0 ";
                    // Clasificaci�n
                    if ($Clasificacion !="") $sql .= "and Clasificacion = '$Clasificacion' ";
                    // Buscar
                    if ($Buscar != "") {
                    $sql .= " and (NombreComun 		like '%$Buscar%' "
                         . " or NombreCientifico 	like '%$Buscar%' "
                         . " or NombreComun 		like '%$Buscar%' "
                         . " or Sombrero			like '%$Buscar%' "     
                         . " or Pie            		like '%$Buscar%' "    
                         . " or Cuerpo         		like '%$Buscar%' "    
                         . " or Laminas       		like '%$Buscar%' "    
                         . " or Himenio        		like '%$Buscar%' "    
                         . " or Exporada       		like '%$Buscar%' "    
                         . " or Carne          		like '%$Buscar%' "    
                         . " or EpocaHabitat   		like '%$Buscar%' "    
                         . " or Comestibilidad 		like '%$Buscar%' "    
                         . " or Comentarios    		like '%$Buscar%' )";  
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
                    mysqli_query($link,'SET NAMES utf8');
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
                         ?>
                         <div class="content">
                         <?php
                         if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
                              echo "<label title=\"Ir a la Pagina\" for=\"Pagina1\" lang=\"es\">Ir a P&aacute;gina: </label>";
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
                         ?>
                         </div>
                         <div class="content">
                         <?php


                         while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) && ($RegistroMostrado < $Mostrar)) {
                              $idSetas = $row["idSetas"];
                              ?>


                              <div class="museo">
                              <?php
                              if($row["ImgSetas"] > 0){
                                        $sqlImg = "select * from Imagenes where idImagen = ". $row["ImgSetas"]. " and Publicar = 1 ";
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
                                                  echo "<a href=\"setas-detalle.php?idSetas=$idSetas\" class=\"strDirectorio\" title=\"".$row["NombreComun"] ." (".$row["NombreCientifico"].")\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\"/></a>";
                                             }
                                             mysqli_free_result($resultImg);
                                        
                                        
                                   }
                                   
                              switch ($row["Clasificacion"]){
                                   case "Mortal" : $ImagenSeta = "setas-mortal.gif"; break;
                                   case "Venenosa" : $ImagenSeta = "setas-venenosa.gif";break;
                                   case "Sin valor culinario" : $ImagenSeta = "setas-sin-valor-culinario.gif";break;
                                   case "Buena" : $ImagenSeta = "setas-buena.gif";break;
                                   case "Excelente" : $ImagenSeta = "setas-excelente.gif";break;
                                   case "Sin clasificar" : $ImagenSeta = "setas-sin-clasificar.gif";break;
                              }

                              $MostrarClasificacion = "<img src='images/$ImagenSeta' title='".$row["Clasificacion"]."' alt='".$row["Clasificacion"]."' width='16px' height='16px' class=\"iconosimagen\" />".$row["Clasificacion"];
             
                              ?>
                              <h2><a href="setas-detalle.php?idSetas=<?php echo $row["idSetas"];?>" accesskey="<?php echo $Tecla;?>" class="strRutas" title="<?php echo $row["NombreComun"];?>: m�s informaci�n, tecla <?php echo $Tecla;?>">
                                   <?php if ( $row["NombreComun"] != "S/N"){ 
                                        echo $row["NombreComun"];}
                                   else{
                                        echo $row["NombreCientifico"];
                                   }
                                   ?>
                                   
                                   </a>
                              </h2>

                              <ul>
                              <?php if ( $row["NombreComun"] != "S/N"){ ?>
                              <li><span class="DatosTitulo">Nombre Común</span><span class="DatosValor"><?php echo $row["NombreComun"];?></span></li>
                              <?php } ?>
                              <li><span class="DatosTitulo">Nombre Científico</span><span class="DatosValor"><?php echo $row["NombreCientifico"];?></span></li>
                              <li><span class="DatosTitulo">Autor</span><span class="DatosValor"><?php echo $row["Autor"];?></span></li>
                              <li><span class="DatosTitulo">Clase</span><span class="DatosValor"><?php echo $row["Clase"];?></span></li>
                              <li><span class="DatosTitulo">Sub clase</span><span class="DatosValor"><?php echo $row["SubOrden"];?></span></li>
                              <li><span class="DatosTitulo">Clasificación</span><span class="DatosValor"><?php echo $MostrarClasificacion;?></span></li>
                              <li><a href="setas-detalle.php?idSetas=<?php echo $row["idSetas"];?>" title="<?php echo $row["NombreComun"];?>: más informaci&oacute;n, tecla <?php echo $Tecla;?>">más informaci&oacute;n...</a></li>
                              </ul>
                              </div>
                              <?PHP



                              

                         }


                    }

                    
                  
                    ?>
               

               </div>
               <div class="content">

               <?php
                      
                         
                         echo "<div class='paginator'>"; 
                         echo "<div class='anterior'>";	
                         if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
                         echo "<a href=\"setas-listado.php?Pagina=".($Pagina - 1)."&amp;Clasificacion=$Clasificacion&amp;Buscar=$Buscar&amp;Mostrar=$Mostrar\" class=\"linkVerde\" title=\"Anterior\"> &lt;&lt; Anterior </a>";
                         }else{
                         echo "&nbsp;";
                         }
                         echo "</div>";
                         echo "<div class='siguiente'>";
                         if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
                         echo "<a href=\"setas-listado.php?Pagina=".($Pagina + 1)."&amp;Clasificacion=$Clasificacion&amp;Buscar=$Buscar&amp;Mostrar=$Mostrar\" class=\"linkVerde\" title=\"Siguiente\"> Siguiente &gt;&gt; </a>";
                         }else{
                         echo "&nbsp;";
                         }
                         echo "</div>";
                         echo " <div class='selectpag'>";
                         if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
                         echo "<label title=\"Ir a la Pagina\" for=\"Pagina2\" lang=\"es\">Ir a P&aacute;gina: ";
                         echo "<select name=\"Pagina\" id=\"Pagina2\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
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
<script type="text/javascript">
<!--
function CambiarClasificacion(x){
	location.href = "setas-listado.php?Pagina=<?php echo $Pagina; ?>&Buscar=<?php echo $Buscar; ?>&Clasificacion="+x.value;	
}
function CambiarPagina(x){
location.href = "setas-listado.php?&Buscar=<?php echo $Buscar; ?>&Clasificacion=<?php echo $Clasificacion; ?>&Pagina="+x.value;

}
function Buscar(x){
location.href = "setas-listado.php?Buscar=" + x.value;
}
function Paginar(x){
location.href = "setas-listado.php?Buscar=<?php echo $Buscar; ?>&Clasificacion=<?php echo $Clasificacion; ?>&Mostrar="+x.value;

}
//-->
</script>
</body>
</html>