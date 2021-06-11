<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


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
	<li class="liselect"><a title="A&ntilde;adir entrada al directorio" href="pesca-entrada.php">A&ntilde;adir entrada tramo de pesca</a></li>
	<li><a title="Listado del directorio"  href="pesca-listado.php">Listado tramo de pesca</a></li>
</ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" name="formEntrada" onsubmit="EnviarEntradaPesca(this,'nuevo');return false;" method="post">
<div class="tablaizq">
<ul class="tablaformizq">
    <li class="campoform">
        <div class="tituloentradaform">TipoTramo</div>
        <div class="valorentradaform">
          <select name="TIPOTRAMO" id="TIPOTRAMO" >
            <option value="Coto">Coto</option>    
            <option value="Tramo Libre">Tramo Libre</option>
            <option value="Coto">Escenario deportivo</option>
          </select>
        </div>    
    </li>
    <li class="campoform">
      <div class="tituloentradaform">Rio</div>
      <div class="valorentradaform">
        <input name="RIO" type="text" id="RIO" size="30" maxlength="50" />
      </div>
     </li>
    <li class="campoform">
        <div class="tituloentradaform">Nombre</div>
        <div class="valorentradaform"><input name="NOMBRE" type="text" id="NOMBRE" size="30" maxlength="50" />
         </div>
        </li>
    <li class="campoform">
        <div class="tituloentradaform">Tipo de pesca</div>
        <div class="valorentradaform">
          <select name="TIPOPESCA" onchange="CambiarClase(this);" id="TIPOPESCA">
      	<option value="Sin muerte">Sin muerte</option>
        <option value="Regimen Tradicional">Regimen Tradicional</option>
        <option value="Intensico">Intensico</option>
      </select>
        </div>    </li>
   <li class="campoform">
        <div class="tituloentradaform">Espacio</div>
        <div class="valorentradaform">
          <input name="ESPACIO" type="text" id="ESPACIO" size="10" />
        </div>    </li>
    <li class="campoform">
        <div class="tituloentradaform">Periodo habil</div>
        <div class="valorentradaform">
          <input name="PERIODOHABIL" type="text" id="PERIODOHABIL" size="35" />
        </div>    </li>
    <li class="campoform">
        <div class="tituloentradaform">Limite superior</div>
        <div class="valorentradaform">
          <input name="LIMITESUPERIOR" type="text" id="LIMITESUPERIOR" size="35" />
        </div>    </li>
    <li class="campoform">
        <div class="tituloentradaform">Limite inferior</div>
        <div class="valorentradaform">
          <input name="LIMITEINFERIOR" type="text" id="LIMITEINFERIOR" size="35" />
        </div>    </li>
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
        <input name="CUPOCAPTURAS" type="text" id="CUPOCAPTURAS" size="10" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Tama�o m�nimo de capturas </div>
        <div class="valorentradaform">
        <input name="TAMANOCAPTURAS" type="text" id="TAMANOCAPTURAS" size="10" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Cebos</div>
        <div class="valorentradaform">
        <input name="CEBOS" type="text" id="CEBOS" size="35" maxlength="100" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Permisos por d�a</div>
        <div class="valorentradaform">
         <input name="PERMISOSDIA" type="text" id="PERMISOSDIA" size="10" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Especies </div>
        <div class="valorentradaform">
        <input name="ESPECIES" type="text" id="ESPECIES" size="35" maxlength="50" />
        </div>   
    </li>
    <li class="campoform">
        <div class="tituloentradaform">Dias habiles </div>
        <div class="valorentradaform">
        <select name="DIASHABILES" size="8" multiple="multiple" id="DIASHABILES" style="overflow:hidden">
        <option value="L">lunes</option>
        <option value="M">martes</option>
        <option value="X">miercoles</option>
        <option value="J">jueves</option>
        <option value="V">viernes</option>
        <option value="S">sabado</option>
        <option value="D">domingo</option>
        <option value="F">fiestas</option>
      </select>
        </div>   
    </li>
</ul>
</div>
</form>
</div>
<br clear="left" />
<script type="text/javascript">
document.formEntrada.CLASE.value = "ASCOMICETOS";
CambiarClase(document.formEntrada.CLASE);

</script>
</body>
</html>
