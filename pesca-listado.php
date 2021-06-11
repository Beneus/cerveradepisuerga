<?php
$TipoTramo = $_GET["TipoTramo"];
$TipoPesca = $_GET["TipoPesca"];

//setlocale  (LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: Guia de tramos de pesca en la Monta�a Palentina";
$MetaDescripcion = "Cervera de Pisuerga: Guia de tramos de pesca en la Monta�a Palentina: cotos, tramos libres, espacios deportivos, Arauz, Carda�o, Carri�n, Rivera, Pisuerga, R�o Chico, Arroyo Valsurbio, Arroyo Valcobero, ";
$MetaKeywords = "Cervera de Pisuerga, Guia de cotos de pesca, Monta�a Palentina,Arauz, Carda�o, Carri�n, Rivera, Pisuerga, R�o Chico, Arroyo Valsurbio, Arroyo Valcobero ";
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
                    <h1>Tramos de pesca</h1>
                    <div class="MigasdePan">
                    <a href="que-ofrecemos.php" title="Qu� ofrecemos">Qué ofrecemos</a> &gt; 
                    <a href="pesca.php" title="Pesca, cotos y zonas de pesca en la Montaña Palentina">Pesca</a> &gt; 
                    <a href="pesca-listado.php" title="Tramos de pesca, cotos, tramos libre y espacios deportivos en la Monta�a Palentina">Tramos de pesca</a>
                    </div>
                    <label for="TIPOTRAMO" lang="es">Tipo de tramo: </label>
                    <select name="TIPOTRAMO" id="TIPOTRAMO" onchange="CambiarClasificacion(this);">
                    <option value="">Todos los tramos</option>    
                    <option value="Coto" <?php if ($TipoTramo =="Coto") echo "selected"; ?>>Coto</option>    
                    <option value="Tramo Libre" <?php if ($TipoTramo =="Tramo Libre") echo "selected"; ?>>Tramo Libre</option>
                    <option value="Escenario deportivo" <?php if ($TipoTramo =="Escenario deportivo") echo "selected"; ?>>Escenario deportivo</option>
                    </select>
                    <label for="TIPOPESCA" lang="es">Tipo de pesca: </label>
                    <select name="TIPOPESCA" onchange="CambiarTipoPesca(this);" id="TIPOPESCA">
                    <option value="">Tipos de pesca</option>
                    <option value="Sin muerte" <?php if ($TipoPesca =="Sin muerte") echo "selected"; ?>>Sin muerte</option>
                    <option value="Regimen Tradicional" <?php if ($TipoPesca =="Regimen Tradicional") echo "selected"; ?>>Regimen Tradicional</option>
                    <option value="Intensivo" <?php if ($TipoPesca =="Intensivo") echo "selected"; ?>>Intensivo</option>
                    </select>
               </div>
               <div class="content">
               <?php 

                    $link = ConnBDCervera();
                    $sql = "SELECT * FROM Pesca  where idPesca > 0 ";
                    if ($TipoTramo != "") $sql .= " and TipoTramo = '$TipoTramo' ";
                    if($TipoPesca != "") $sql .= " and TipoPesca = '$TipoPesca' ";
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
                    $max = mysqli_num_rows($result);	
                    if($max > 0){  

                         while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                   $idPesca = $row["idPesca"];
                                   $TipoTramo = $row["TipoTramo"];
                                   $Nombre = $row["Nombre"];
                                   $Rio = $row["Rio"];
                                   $TipoPesca = $row["TipoPesca"];
                                   $Espacio = $row["Espacio"];
                                   $PeriodoHabil = $row["PeriodoHabil"]; 
                                   $DiasHabiles = $row["DiasHabiles"]; 
                                   $CupoCapturas = $row["CupoCapturas"]; 	
                                   $TamanoCapturas = $row["TamanoCapturas"];
                                   $Cebos = $row["Cebos"];
                                   $PermisosDia = $row["PermisosDia"];
                                   $LimiteSuperior = $row["LimiteSuperior"];
                                   $LimiteInferior = $row["LimiteInferior"];
                                   $Especies = $row["Especies"];
                                   $Descripcion = $row["Descripcion"];
                                   $ImgPesca = $row["ImgPesca"];
                            
                              ?>

                              <div class="museo">
                              <?php
                                   if($row["ImgPesca"] > 0){
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
                                                       echo "<a href=\"pesca-detalle.php?idPesca=$idPesca\" class=\"strDirectorio\" title=\"$Titulo\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                                                  }
                                                  mysqli_free_result($resultImg);
                                             
                                             
                                        }

                                   ?>
                                   <h2><a href="pesca-detalle.php?idPesca=<?php echo $row["idPesca"];?>" class="strRutas" title="<?php echo $TipoTramo . " " . $Nombre;?>"><?php echo $TipoTramo . " " . $Nombre;?></a></h2>
                                   <ul>
                                   <li><span class="DatosTitulo">Tipo de tramo</span><span class="DatosValor"><?php echo $TipoTramo;?></span></li>
                                   <li><span class="DatosTitulo">Nombre</span><span class="DatosValor"><?php echo $Nombre;?></span></li>
                                   <li><span class="DatosTitulo">Río</span><span class="DatosValor"><?php echo $Rio;?></span></li>
                                   <li><span class="DatosTitulo">Tipo de pesca</span><span class="DatosValor"><?php echo $TipoPesca;?></span></li>
                                   <li><span class="DatosTitulo">Espacio</span><span class="DatosValor"><?php echo $Espacio;?> Km.</span></li>
                                   <li><span class="DatosTitulo">Periodo habil</span><span class="DatosValor"><?php echo $PeriodoHabil;?></span></li>
                                   <li><span class="DatosTitulo">Dias habiles</span><span class="DatosValor"><?php echo $DiasHabiles;?></span></li>
                                   <?php if($TipoPesca != "Sin muerte"){?>
                                   <li><span class="DatosTitulo">Cupo de capturas</span><span class="DatosValor"><?php echo $CupoCapturas;?></span></li>
                                   <li><span class="DatosTitulo">Tama&ntilde;o m&iacute;nimo de las capturas</span><span class="DatosValor"><?php echo $TamanoCapturas;?> cms.</span></li>
                                   <?php } ?>
                                   <li><span class="DatosTitulo">Cebos</span><span class="DatosValor"><?php echo $Cebos;?></span></li>
                                   <li><span class="DatosTitulo">Permisos por d&iacute;a</span><span class="DatosValor"><?php echo $PermisosDia;?></span></li>
                                   <li><span class="DatosTitulo">Limite superior</span><span class="DatosValor"><?php echo $LimiteSuperior;?></span></li>
                                   <li><span class="DatosTitulo">Limite inferior</span><span class="DatosValor"><?php echo $LimiteInferior;?></span></li>
                                   <li><span class="DatosTitulo">Especies</span><span class="DatosValor"><?php echo $Especies;?></span></li>
                                   <li><span class="DatosValor"><a href="pesca-detalle.php?idPesca=<?php echo $row["idPesca"];?>" class="strRutas" title="Mapa y planificador de ruta al <?php echo $TipoTramo . " " . $Nombre;?>">Mapa y planificador de ruta</a></span></li>
                                   </ul>
                                   
                              
                              
                              
                              
                              </div>


                              <?php 




                         }
                    }
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
location.href = "pesca-listado.php?TipoPesca=<?php echo $TipoPesca;?>&TipoTramo="+x.value;
}

function CambiarTipoPesca(x){
location.href = "pesca-listado.php?TipoTramo=<?php echo $TipoTramo;?>&TipoPesca="+x.value;
}
//-->
</script>   
</body>
</html>