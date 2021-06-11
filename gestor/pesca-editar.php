<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idPesca = $_GET["idPesca"] ?? '';
$Mostrar = $_GET["Mostrar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';

$link = ConnBDCervera();
$sql = "SELECT * from Pesca where idPesca = $idPesca ";
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
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$TipoTramo = $row["TipoTramo"] ?? '';
				$Rio = $row["Rio"] ?? '';
				$Nombre = $row["Nombre"] ?? '';
				$TipoPesca = $row["TipoPesca"] ?? '';
				$Espacio = $row["Espacio"] ?? '';
				$PeriodoHabil = $row["PeriodoHabil"] ?? '';
				$DiasHabiles = $row["DiasHabiles"] ?? '';
				$CupoCapturas = $row["CupoCapturas"] ?? '';
				$TamanoCapturas = $row["TamanoCapturas"] ?? '';
				$Cebos = $row["Cebos"] ?? '';
				$PermisosDia = $row["PermisosDia"] ?? '';
				$LimiteSuperior = $row["LimiteSuperior"] ?? '';
				$LimiteInferior = $row["LimiteInferior"] ?? '';
				$Especies = $row["Especies"] ?? '';
				$Longitud = $row["Longitud"] ?? '';
				$Latitud = $row["Latitud"] ?? '';
				$LongitudLimiteSuperior = $row["LongitudLimiteSuperior"] ?? '';
				$LatitudLimiteSuperior  = $row["LatitudLimiteSuperior"] ?? '';
				$LongitudLimiteInferior = $row["LongitudLimiteInferior"] ?? '';
				$LatitudLimiteInferior  = $row["LatitudLimiteInferior"] ?? '';
				$NucleoUrbano = $row["NucleoUrbano"] ?? '';
				$encodedPoints = $row["encodedPoints"] ?? '';
				$encodedLevels = $row["encodedLevels"] ?? '';
				$numLevels = $row["numLevels"] ?? '';
				$Zoom = $row["Zoom"] ?? '';
				$Color = $row["Color"] ?? '';
				
				$Descripcion = $row["Descripcion"] ?? '';
	
}else{
	header("Location:pesca-listado.php");
	exit;
	
}
mysqli_free_result($result);
mysqli_close($link);	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Flora entrada</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script language="javascript" type="text/javascript">

function CambiarClase(x){
	if(x.value=="BASIDIOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenBasidiomicetos;
	}
	if(x.value=="FRAGMOBASIDIOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenFragmoasidiomicetos;
	}
	if(x.value=="ASCOMICETOS"){
		document.formEntrada.IDSETASSUBORDEN.innerHTML = ordenAscomicetos;
	}
	
}

</script>

</head>

<body>
<div id="espere" style="display:none" >
  <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
</div>
<div id="error" style="display:none" >
  <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
  <div id="errormsn" >
  </div>
</div>
<div id="cab">
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
  <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map>
  </div>
</div>
<div id="menu">
<?php echo $strMenu; ?>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
<?php echo $strSubMenu; ?>
</div>
<div id="opciones">
<ul>
	<li><a title="A&ntilde;adir introducci&oacute;n" href="pesca-introduccion.php">Editar introducción</a></li>
	<li><a title="a&ntilde;adir imagen a la introducci&oacute;n"  href="galeria-fotografica.php?Ambito=Pesca&idAmbito=0&Campo=idPesca&NCampo=idPesca&Referer=pesca-introduccion.php">A&ntilde;adir imagen introducci&oacute;n</a> </li>
    <li><a title="a&ntilde;adir imagen a la introducci&oacute;n"  href="galeria-documento.php?Ambito=Pesca&idAmbito=0&Campo=idPesca&NCampo=idPesca&Referer=pesca-introduccion.php">A&ntilde;adir documento introducci&oacute;n</a> </li>
	<li class="liselect"><a title="A&ntilde;adir entrada al directorio" href="pesca-entrada.php">A&ntilde;adir entrada tramo de pesca</a></li>
	<li><a title="Listado del directorio"  href="pesca-listado.php">Listado tramo de pesca</a></li>
</ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaPesca(this,'editar');return false;" method="post">
<input type="hidden" name="IDPESCA" value="<?php echo $idPesca;?>" />
<div class="tablaizq">
<ul class="tablaformizq">
    <li class="campoform">
        <div class="tituloentradaform">TipoTramo</div>
        <div class="valorentradaform">
          <select name="TIPOTRAMO" id="TIPOTRAMO" >
            <option value="Coto" <?php if ($TipoTramo =="Coto") echo "selected"; ?>>Coto</option>
            <option value="Tramo Libre" <?php if ($TipoTramo =="Tramo Libre") echo "selected"; ?>>Tramo Libre</option>
            <option value="Escenario deportivo" <?php if ($TipoTramo =="Escenario deportivo") echo "selected"; ?>>Escenario deportivo</option>
          </select>
        </div>    
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Rio</div>
      <div class="valorentradaform">
        <input name="RIO" type="text" id="RIO" size="30" maxlength="50" value="<?php echo $Rio; ?>" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Nombre</div>
        <div class="valorentradaform">
          <input name="NOMBRE" type="text" id="NOMBRE" size="30" maxlength="50" value="<?php echo $Nombre; ?>" />
        </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">Tipo de pesca</div>
        <div class="valorentradaform">
         <select name="TIPOPESCA" onchange="CambiarClase(this);" id="TIPOPESCA">
      	<option value="Sin muerte" <?php if ($TipoPesca =="Sin muerte") echo "selected"; ?>>Sin muerte</option>
        <option value="Regimen Tradicional" <?php if ($TipoPesca =="Regimen Tradicional") echo "selected"; ?>>Regimen Tradicional</option>
        <option value="Intensivo" <?php if ($TipoPesca =="Intensivo") echo "selected"; ?>>Intensivo</option>
      </select>
        </div>    </li>
   <li class="campoform">
        <div class="tituloentradaform">Espacio</div>
        <div class="valorentradaform">
          <input name="ESPACIO" type="text" id="ESPACIO" size="10"  value="<?php echo $Espacio; ?>"/>
        </div>    </li>
    <li class="campoform">
        <div class="tituloentradaform">Periodo habil</div>
        <div class="valorentradaform">
          <input name="PERIODOHABIL" type="text" id="PERIODOHABIL" size="35"  value="<?php echo $PeriodoHabil; ?>"/>
        </div>    </li>
    <li class="campoform">
        <div class="tituloentradaform">Limite superior</div>
        <div class="valorentradaform">
          <input name="LIMITESUPERIOR" type="text" id="LIMITESUPERIOR" size="35"  value="<?php echo $LimiteSuperior; ?>"/>
        </div>    </li>
        <li class="campoform">
        <div class="tituloentradaform">Longitud Limite superior</div>
        <div class="valorentradaform">
          <input name="LONGITUDLIMITESUPERIOR" type="text" id="LONGITUDLIMITESUPERIOR" size="35"  value="<?php echo $LongitudLimiteSuperior; ?>"/>
        </div>    
     </li> 
          <li class="campoform">
        <div class="tituloentradaform">Latitud Limite superior</div>
        <div class="valorentradaform"><input name="LATITUDLIMITESUPERIOR" type="text" id="LATITUDLIMITESUPERIOR" size="35"  value="<?php echo $LatitudLimiteSuperior; ?>"/>
        </div>    
          </li> 
    <li class="campoform">
        <div class="tituloentradaform">Limite inferior</div>
        <div class="valorentradaform">
          <input name="LIMITEINFERIOR" type="text" id="LIMITEINFERIOR" size="35"  value="<?php echo $LimiteInferior; ?>"/>
        </div>    
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Longitud Limite inferior</div>
        <div class="valorentradaform">
          <input name="LONGITUDLIMITEINFERIOR" type="text" id="LONGITUDLIMITEINFERIOR" size="35"  value="<?php echo $LongitudLimiteInferior; ?>"/>
        </div>    
     </li> 
          <li class="campoform">
        <div class="tituloentradaform">Latitud Limite inferior</div>
        <div class="valorentradaform"><input name="LATITUDLIMITEINFERIOR" type="text" id="LATITUDLIMITEINFERIOR" size="35"  value="<?php echo $LatitudLimiteInferior; ?>"/>
        </div>    
          </li> 
     <li class="campoform">
        <div class="tituloentradaform">Longitud</div>
        <div class="valorentradaform">
          <input name="LONGITUD" type="text" id="LONGITUD" size="35"  value="<?php echo $Longitud; ?>"/>
        </div>    
     </li> 
          <li class="campoform">
        <div class="tituloentradaform">Latitud</div>
        <div class="valorentradaform"><input name="LATITUD" type="text" id="LATITUD" size="35"  value="<?php echo $Latitud; ?>"/>
        </div>    
          </li> 
           <li class="campoform">
        <div class="tituloentradaform">Nucleo Urbano</div>
        <div class="valorentradaform"><input name="NUCLEOURBANO" type="text" id="NUCLEOURBANO" size="35"  value="<?php echo $NucleoUrbano; ?>"/>
        </div>    
          </li> 
          <li class="campoform">
        <div class="tituloentradaform">encodedPoints</div>
        <div class="valorentradaform"><input name="ENCODEDPOINTS" type="text" id="ENCODEDPOINTS" size="35"  value="<?php echo $encodedPoints; ?>"/>
        </div>    
          </li> 
           <li class="campoform">
        <div class="tituloentradaform">encodedLevels</div>
        <div class="valorentradaform"><input name="ENCODEDLEVELS" type="text" id="ENCODEDLEVELS" size="35"  value="<?php echo $encodedLevels; ?>"/>
        </div>    
          </li> 
           <li class="campoform">
        <div class="tituloentradaform">numLevels</div>
        <div class="valorentradaform"><input name="NUMLEVELS" type="text" id="NUMLEVELS" size="4"  value="<?php echo $numLevels; ?>"/>
        </div>    
          </li> 
           <li class="campoform">
        <div class="tituloentradaform">Zoom</div>
        <div class="valorentradaform"><input name="ZOOM" type="text" id="ZOOM" size="4"  value="<?php echo $Zoom; ?>"/>
        </div>    
          </li> 
           <li class="campoform">
        <div class="tituloentradaform">Color</div>
        <div class="valorentradaform"><input name="COLOR" type="text" id="COLOR"  value="<?php echo $Color; ?>" size="8" maxlength="8"/>
        </div>    
          </li>  <li class="campoform">
        <div class="tituloentradaform">Galer&iacute;a de documentos</div>
        <div class="valorentradaform">
          <a href="galeria-documentos.php?Ambito=Pesca&amp;idAmbito=<?php echo $idPesca;?>&amp;Campo=idPesca&amp;NCampo=Nombre&amp;Referer=pesca-editar.php">Galeria de documentos</a>
        </div>    
        </li>  
          <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Guardar Datos" />
        </div>    </li>  
          
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
   <li class="campoform">
        <div class="tituloentradaform">Cupo de capturas </div>
        <div class="valorentradaform">
        <input name="CUPOCAPTURAS" type="text" id="CUPOCAPTURAS" size="10"  value="<?php echo $CupoCapturas; ?>"/>
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Tamaño mínimo de capturas </div>
        <div class="valorentradaform">
        <input name="TAMANOCAPTURAS" type="text" id="TAMANOCAPTURAS" size="10"  value="<?php echo $TamanoCapturas; ?>"/>
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Cebos</div>
        <div class="valorentradaform">
        <input name="CEBOS" type="text" id="CEBOS" size="35" maxlength="100"  value="<?php echo $Cebos; ?>" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Permisos por día</div>
        <div class="valorentradaform">
         <input name="PERMISOSDIA" type="text" id="PERMISOSDIA" size="10"  value="<?php echo $PermisosDia; ?>" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Especies </div>
        <div class="valorentradaform">
        <input name="ESPECIES" type="text" id="ESPECIES" size="35" maxlength="50"  value="<?php echo $Especies; ?>"/>
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Dias habiles </div>
        <div class="valorentradaform">
        <select name="DIASHABILES" size="8" multiple="multiple" id="DIASHABILES" style="overflow:hidden">
        <option value="L" <?php if (!(strrpos($DiasHabiles,"L") === false)) echo "selected"; ?>>lunes</option>
        <option value="M" <?php if (!(strrpos($DiasHabiles,"M") === false)) echo "selected"; ?>>martes</option>
        <option value="X" <?php if (!(strrpos($DiasHabiles,"X") === false)) echo "selected"; ?>>miercoles</option>
        <option value="J" <?php if (!(strrpos($DiasHabiles,"J") === false)) echo "selected"; ?>>jueves</option>
        <option value="V" <?php if (!(strrpos($DiasHabiles,"V") === false))echo "selected"; ?>>viernes</option>
        <option value="S" <?php if (!(strrpos($DiasHabiles,"S") === false)) echo "selected"; ?>>sabado</option>
        <option value="D" <?php if (!(strrpos($DiasHabiles,"D") === false)) echo "selected"; ?>>domingo</option>
        <option value="F" <?php if ((!strrpos($DiasHabiles,"F") === false)) echo "selected"; ?>>fiestas</option>
      </select>
        </div>   
    </li>
</ul>
</div>
</form>
</div>
<br clear="left" />
</body>
</html>
