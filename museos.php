<?php
include("includes/funciones.php");
include("includes/Conn.php");
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';

$MetaTitulo = "Cervera de Pisuerga: Museos de la Montaña Palentina";
$MetaDescripcion = "Guia de museos de la Montaña Palentina: Casa Cantarranas, Casa del Parque Natural, Fundación Piedad Isla, La Casa del Oso Cantábrico, Museo Etnográfico de Perazancas";
$MetaKeywords =  "Cervera de Pisuerga, Guia de museos, Montaña Palentina, Casa Cantarranas, Casa del Parque Natural, Fundación Piedad Isla, La Casa del Oso Cantábrico, Museo Etnográfico de Perazancas, turísmo, naturaleza virgen, arte, historia";
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
               <h1><img src="iconos/museos.png" alt="Museos de la Montaña Palentina" width="32" height="32" class="iconosimagen" title="Museos de la Monta�a Palentina" />Museos y exposiciones</h1>
               <div class="MigasdePan">
                    <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
                    <a href="museos.php" title="Museos y exposiciones">Museos y exposiciones</a>
                    </div>
               </div>
               <div class="content">

               <?php 
   
                    $link = ConnBDCervera();
                    mysqli_query($link,'SET NAMES utf8');
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    // NucleosUrbanos +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                         
                    $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Museos as M "
                                        ." inner join NucleosUrbanos as NU on M.idNucleoUrbano = NU.idNucleoUrbano "
                                        ." group by idNucleoUrbano order by NU.NombreNucleoUrbano ";  
                    
                    $accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
                    echo "<label for=\"IDNUCLEOURBANO\">Localidad: ";
                    echo "</label>";
                    echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
                    
                    ?>
               </div>
               <div class="content">
               <?php
               $link = ConnBDCervera();
               $sql = "SELECT MU.*, NU.NombreNucleoUrbano FROM Museos as MU inner join NucleosUrbanos as NU on MU.idNucleoUrbano = NU.idNucleoUrbano ";

               if ($idNucleoUrbano != ''){$sql .= " where MU.idNucleoUrbano= $idNucleoUrbano ";}
               $sql = $sql . " order by FechaClausura desc, Museo ";


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
               $max = mysqli_num_rows($result);	
               if($max > 0){  

               $clasefila = "filagris";
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                         
                         if ($clasefila == "filagris" ){
                              $clasefila = "filablanca";
                         }else{
                              $clasefila = "filagris";
                         }
                         $Museo = $row["Museo"];
                         $idMuseo = $row["idMuseo"];
                         $Tema = $row["Tema"];
                         $Direccion = $row["Direccion"];
                         $NombreNucleoUrbano = $row["NombreNucleoUrbano"];
                         $idNucleoUrbano = $row["idNucleoUrbano"];
                         $Telefono = $row["Telefono"];
                         $Responsable = $row["Responsable"];   
                         $URL = $row["URL"];
                         $Email = $row["Email"];
                         $Tipo = $row["Tipo"];
                         $FechaInauguracion = FechaDerecho($row["FechaInauguracion"]);
                         $FechaClausura = FechaDerecho($row["FechaClausura"]);
                         $Horario = $row["Horario"];
                         
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
                                                  echo "<a href=\"museos-detalle.php?idMuseo=$idMuseo\" class=\"strDirectorio\" title=\"$Titulo\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
                                             }
                                             mysqli_free_result($resultImg);
                                        
                                        
                                   }
                              if($Email !=""){$Email = "<span><a href=\"mail.php?Ambito=Museos&amp;idAmbito=$idMuseo&amp;Campo=idMuseo&amp;Att=Museo\" title=\"Contacta con el responsable de $Museo\">Contacta</a></span>";}
                              
                              ?>
                              <h2><a href="museos-detalle.php?idMuseo=<?php echo $row["idMuseo"];?>" class="strMuseos"><?php echo $Museo;?></a></h2>
<ul>
<?php if ($Tipo == "TEMPORAL"){?>
<li><span class="DatosTitulo">Lugar</span><span class="DatosValor"><?php echo $Tema;?></span></li>
<?php }else{ ?>
<li><span class="DatosTitulo">Tema</span><span class="DatosValor"><?php echo $Tema;?></span></li>
<?php } ?>
<li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
<li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
<li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?php echo $Horario;?></span></li>
<li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
<li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?php echo $Tipo;?></span></li>
<?php if (!is_null($FechaInauguracion)){?>
<li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?php echo $FechaInauguracion;?></span></li>
<?php } ?>
<?php if (!is_null($FechaClausura)){?>
<li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?php echo $FechaClausura;?></span></li>
<?php } ?>


<?php if ($Email!=""){?>
<li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
<?php } ?>
<?php if ($URL!=""){?>
<li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Museo;?>, Enlace a ventana nueva" target="_blank">Ir ala URL del sitio</a></span></li>
<?php } ?>


<li><a href="museos-detalle.php?idMuseo=<?php echo $row["idMuseo"];?>" title="<?php echo $Museo;?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
</ul>
                         </div>
                         <?php


                    }
               }
               mysqli_free_result($result);
               mysqli_close($link);	
               ?>
               </div>
               <div class="content">
              
               </div>

               <div class="museo">
              
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
			location.href = "museos.php?idNucleoUrbano="+x.value;	
		}

</script>
</body>
</html>