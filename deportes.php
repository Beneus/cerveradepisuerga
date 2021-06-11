
<?php
include("includes/Conn.php");
include("includes/funciones.php");

$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$MetaTitulo = "Cervera de Pisuerga: Museos de la Monta�a Palentina";
$MetaDescripcion = "Guia de museos de la Monta�a Palentina: Casa Cantarranas, Casa del Parque Natural, Fundaci�n Piedad Isla, La Casa del Oso Cant�brico, Museo Etnogr�fico de Perazancas";
$MetaKeywords = "Cervera de Pisuerga, Guia de museos, Monta�a Palentina, Casa Cantarranas, Casa del Parque Natural, Fundaci�n Piedad Isla, La Casa del Oso Cant�brico, Museo Etnogr�fico de Perazancas, tur�smo, naturaleza virgen, arte, historia";
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
                    <h1><img src="iconos/deportes.png" alt="Museos de la Montaña Palentina" width="32" height="32" class="iconosimagen" title="Museos de la Monta�a Palentina" /> Deportes</h1>
                    <div class="MigasdePan">
                    <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
                    <a href="deportes.php" title="Deportes en la Montaña Palentina">Deportes</a>
                    </div>
               </div>
               <div class="content">
               <?php 
   
               $link = ConnBDCervera();
                    
               $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Museos as M "
                                   ." inner join NucleosUrbanos as NU on M.idNucleoUrbano = NU.idNucleoUrbano "
                                   ." group by idNucleoUrbano order by NU.NombreNucleoUrbano ";  
               
               $accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
               echo "<label for=\"IDNUCLEOURBANO\">Localidad: ";
               echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
               echo "</label>";
               ?>
               </div>

               <div class="content">

               <?php
                    $link = ConnBDCervera();
                    $sql = "SELECT DEP.*, NU.NombreNucleoUrbano FROM Deportes as DEP inner join NucleosUrbanos as NU on DEP.idNucleoUrbano = NU.idNucleoUrbano ";
                    
                    if ($idNucleoUrbano != ''){$sql .= " where DEP.idNucleoUrbano= $idNucleoUrbano ";}
                    $sql = $sql . " order by FechaInicio desc, ActoDeportivo ";
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
                    
                         $clasefila = "filagris";
                         while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                              
                              if ($clasefila == "filagris" ){
                                   $clasefila = "filablanca";
                              }else{
                                   $clasefila = "filagris";
                              }
                              $ActoDeportivo = $row["ActoDeportivo"] ?? '';
                              $idDeporte = $row["idDeporte"] ?? '';
                              $Lugar = $row["Lugar"] ?? '';
                              $NombreNucleoUrbano = $row["NombreNucleoUrbano"] ?? '';
                              $idNucleoUrbano = $row["idNucleoUrbano"] ?? '';
                              $Telefono = $row["Telefono"] ?? '';
                              $Contacto = $row["Contacto"] ?? '';   
                              $Url = $row["Url"] ?? '';
                              $Email = $row["Email"] ?? '';
                              $Precio = $row["Precio"] ?? '';
                              $FechaInicio = FechaDerecho($row["FechaInicio"] ?? '');
                              $FechaFinal = FechaDerecho($row["FechaFinal"] ?? '');
                              if(!is_null($row["Hora"])){
                                   $Hora = date("H:i", strtotime($row["Hora"] ?? ''));
                              }else{
                                   $Hora = NULL;
                              }

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
                                                  $Path = $rowImg["Path"] ?? '';
                                                  $Archivo = $rowImg["Archivo"] ?? '';
                                                  $Titulo = $rowImg["Titulo"] ?? '';
                                                  $Pie = $rowImg["Pie"] ?? ''; 
                                                  $Ancho = $rowImg["Ancho"] ?? '';
                                                  $Alto = $rowImg["Alto"] ?? '';
                                                  $AnchoThumb = $rowImg["AnchoThumb"] ?? '';
                                                  $AltoThumb = $rowImg["AltoThumb"] ?? '';
                                                  echo "<a href=\"deportes-detalle.php?idDeporte=$idDeporte\" class=\"strDirectorio\" title=\"$Titulo\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                                             }
                                             mysqli_free_result($resultImg);
                                           
                                           
                                      }
                              if($Email !=""){$Email = "<span><a href=\"mail.php?Ambito=Deportes&amp;idAmbito=$idDeporte&amp;Campo=idDeporte&amp;Att=Contacto\" title=\"Contacta con el responsable\">Contacta</a></span>";}
                              ?>
                              <h2><a href="deportes-detalle.php?idDeporte=<?php echo $row["idDeporte"];?>" class="strMuseos"><?php echo $ActoDeportivo;?></a></h2>
                              <ul>
                              <li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?php echo $Lugar;?></span></li>
                              <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
                              <?php
                              if (!is_null($Hora)){?>
                              <li><span class="DatosTitulo">Hora</span><span class="DatosValor"><?php echo $Hora;?></span></li>
                              <?php }
                              if ($Telefono!=""){?>
                              <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
                             
                              <?php 
                              }
                              if ($Contacto!=""){?>
                              <li><span class="DatosTitulo">Contacto</span><span class="DatosValor"><?php echo $Contacto;?></span></li>
                              <?php }
                              if ($Email!=""){?>
                              <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
                              <?php }
                              if ($Url!=""){?>
                              <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $Url;?>" title="<?php echo $ActoDeportivo;?>, Enlace a ventana nueva" target="_blank"><?php echo $Url;?></a></span></li>
                              <?php }?><li><a href="deportes-detalle.php?idDeporte=<?php echo $row["idDeporte"];?>" title="<?php echo $ActoDeportivo;?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
                              </ul>
                         </div>
                         <?php

                         }
                         mysqli_free_result($result);
                         mysqli_close($link);	
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

 	function SeleccionNucleoUrbano(x){
			location.href = "deportes.php?idNucleoUrbano="+x.value;	
		}
          
</script>
</body>
</html>