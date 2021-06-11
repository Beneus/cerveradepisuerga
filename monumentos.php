
<?php
//setlocale  (LC_ALL,"es_ES@euro","es_ES","esp");
setlocale(LC_ALL, 'es_ES.ISO8859-1');
session_start();
include("includes/funciones.php");
include("includes/Conn.php");
$MetaTitulo = "Cervera de Pisuerga: Monumentos y románico de la Montaña Palentina";
$MetaDescripcion = "Guia de monumentos de la Montaña Palentina: iglesias, ermitas, pintutas, arte románico, románico, casas, blasones, escudos, palacios, humilladero, bosque fósil";
$MetaKeywords = "Cervera de Pisuerga, Guia de monumentos, Montaña Palentina, iglesias, ermitas, pintutas, arte románico, románico, casas, blasones, escudos, palacios, humilladero, bosque fósil";
$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
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
               <h1><img src="iconos/monumentos.png" alt="Monumentos en la Montaña Palentina" title="Monumentos en la Montaña Palentina" width="32" height="32" class="iconosimagen" /> Monumentos</h1>
               <div class="MigasdePan">
               <a href="que-ofrecemos.php" title="Qué ofrecemos">Qué ofrecemos</a> &gt; 
               <a href="monumentos.php" title="Monumentos">Monumentos</a>
               </div>
               <?php 
   
                    $link = ConnBDCervera();
                    
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    // NucleosUrbanos +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                         
                    $sql = "select NU.NombreNucleoUrbano, NU.idNucleoUrbano from Monumentos as M "
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
$sql = "SELECT M.*, NU.NombreNucleoUrbano FROM Monumentos as M inner join NucleosUrbanos as NU ";
$sql .= " on M.idNucleoUrbano = NU.idNucleoUrbano ";

if ($idNucleoUrbano != ''){$sql .= " where M.idNucleoUrbano= $idNucleoUrbano ";}
$sql = $sql . " order by Monumento ";
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
		$idMonumento = $row["idMonumento"];
		$Direccion = $row["Direccion"];
		$Monumento = $row["Monumento"];
		$NombreNucleoUrbano = $row["NombreNucleoUrbano"];
		$idNucleoUrbano = $row["idNucleoUrbano"];
		$Telefono = $row["Telefono"];
		$Responsable = $row["Responsable"];   
		$URL = $row["URL"];
		$Email = $row["Email"];
		$Tipo = $row["Tipo"];
		$FechaInauguracion = FechaDerecho($row["FechaInauguracion"]);
		$FechaClausura = FechaDerecho($row["FechaClausura"]);
		$Tema = $row["Tema"] ?? '';
		$Horario = $row["Horario"];
          if($Email !=""){$Email = "<a href=\"mail.php?Ambito=Monumentos&amp;idAmbito=$idMonumento&amp;Campo=idMonumento&amp;Att=Monumento\" title=\"Contacta con el responsable de $Monumento\">Contacta</a>";}

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
				echo "<a href=\"monumentos-detalle.php?idMonumento=$idMonumento&amp;idNucleoUrbano=$idNucleoUrbano\" class=\"strDirectorio\" title=\"$Titulo\"><img src=\"../".$Path."/".$Archivo."\" title=\"$Titulo\" alt=\"$Titulo\" /></a>";
			}
			mysqli_free_result($resultImg);
   		
   		
   	}

?>
          <h2><a href="monumentos-detalle.php?idMonumento=<?php echo $idMonumento;?>" class="strMonumentos" title="<?php echo $Monumento;?>: más informaci&oacute;n"><?php echo $Monumento;?></a></h2>
          <ul>
          <li><span class="DatosTitulo">Dirección</span><span class="DatosValor"><?php echo $Direccion;?></span></li>
          <li><span class="DatosTitulo">Localidad</span><span class="DatosValor"><a href="localidades.php?idNucleoUrbano=<?php echo $idNucleoUrbano; ?>" title="<?php echo $NombreNucleoUrbano;?>"><?php echo $NombreNucleoUrbano;?></a></span></li>
          <?php if ($Horario  != ""){ ?>
          <li><span class="DatosTitulo">Horario</span><span class="DatosValor"><?php echo $Horario;?></span></li>
          <?php }
          if ($Telefono != ""){?>
          <li><span class="DatosTitulo">Teléfono</span><span class="DatosValor"><?php echo MostrarTelefono($Telefono);?></span></li>
          <?php } ?>
          <li><span class="DatosTitulo">Tipo</span><span class="DatosValor"><?php echo $Tipo;?></span></li>
          <?php if ($Responsable != ""){?>
          <li><span class="DatosTitulo">Responsable</span><span class="DatosValor"><?php echo $Responsable;?></span></li>
          <?php }
          if (!is_null($FechaInauguracion)){?>
          <li><span class="DatosTitulo">Fecha de Inauguración</span><span class="DatosValor"><?php echo $FechaInauguracion;?></span></li>
          <?php }
          if (!is_null($FechaClausura)){?>
          <li><span class="DatosTitulo">Fecha de Clausura</span><span class="DatosValor"><?php echo $FechaClausura;?></span></li>
          <?php }
          if ($Email!=""){?>
          <li><span class="DatosTitulo">Email</span><span class="DatosValor"><?php echo $Email;?></span></li>
          <?php }
          if ($URL!=""){?>
          <li><span class="DatosTitulo">URL</span><span class="DatosValor"><a href="<?php echo $URL;?>" title="<?php echo $Museo;?>" target="_blank"><?php echo $URL;?></a></span></li>
          <?php }?>
          <li><a href="monumentos-detalle.php?idMonumento=<?php echo $idMonumento;?>" title="<?php echo $Monumento;?>: más informaci&oacute;n">más informaci&oacute;n...</a></li>
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
	
	function SeleccionNucleoUrbano(x){
			location.href = "monumentos.php?idNucleoUrbano="+x.value;	
		}
</script>
</body>
</html>