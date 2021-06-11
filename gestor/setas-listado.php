<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$Clasificacion = $_GET["Clasificacion"] ?? '';
$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar))$Mostrar = 10;
$Clase = '';
$pagina_actual = '';
$titulo = '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Flora listado</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script type="text/javascript">

function EliminarEntrada(pag){

var num_idleg = document.getElementsByName("idDir").length;
var cad_eliminados = "";
for (i=0; i<num_idleg; i++){
if (document.getElementsByName("idDir")[i].checked){

if (cad_eliminados == ""){
cad_eliminados += document.getElementsByName("idDir")[i].value;
}else{
cad_eliminados += "-" + document.getElementsByName("idDir")[i].value;
}
}
}
var urldest = "setas-eliminar.php";
var cad = "Pagina=" + pag +"&cadEliminados=" + cad_eliminados;
if (cad_eliminados != ""){

window.open(urldest+"?"+cad,'','width=200,height=200');
}
}

function SelTodos(x){
var CheckDir = document.getElementsByName('idDir');

for (i=0;i<CheckDir.length;i++){
if (x.checked){
CheckDir[i].checked = true;
}else{
CheckDir[i].checked = false;
}

}

}
function SeleccionaServicio(x){
location.href = "setas-listado.php?idsubsevicio="+x.value;

}

function CambiarClasificacion(x){
location.href = "setas-listado.php?Mostrar=<?php echo $Mostrar;?>&Clasificacion="+x.value;

}
function Paginar(x){
location.href = "setas-listado.php?idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Mostrar="+x.value;

}
function CambiarPagina(x){
location.href = "setas-listado.php?Mostrar=<?php echo $Mostrar;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Pagina="+x.value;

}
function Buscar(x){
location.href = "setas-listado.php?Buscar=" + x.value;
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
    <li><a title="A&ntilde;adir introducci&oacute;n" href="setas-introduccion.php">Editar introducción</a></li>
     <li><a title="a&ntilde;adir imagen a la introducci&oacute;n"  href="galeria-fotografica.php?Ambito=Setas&idAmbito=0&Campo=idSetas&NCampo=idSetas&Referer=setas-introduccion.php">A&ntilde;adir imagen introducci&oacute;n</a> </li>
    <li><a title="A&ntilde;adir entrada al directorio" href="setas-entrada.php">A&ntilde;adir entrada gu&iacute;a micol&oacute;gica</a></li>
    <li class="liselect"><a title="Listado del directorio"  href="setas-listado.php">Listado gu&iacute;a micol&oacute;gica</a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="lateralizq">&nbsp;</td>
<td><form id="form1" name="form1" method="post" action="">
<label>Buscar
<input name="BUSCAR" type="text" id="BUSCAR" value="<?php echo $Buscar; ?>" />
</label><input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
</form>    </td>
<td>
<select name="CLASIFICACION" onchange="CambiarClasificacion(this);">
		<option value="" <?php if($Clasificacion == "") echo "selected=\"selected\""; ?>>Todas</option>
        <option value="Mortal" <?php if($Clasificacion == "Mortal") echo "selected=\"selected\""; ?>>Mortal</option>
        <option value="Venenosa" <?php if($Clasificacion == "Venenosa") echo "selected=\"selected\""; ?>>Venenosa</option>
        <option value="Sin valor culinario" <?php if($Clasificacion == "Sin valor culinario") echo "selected=\"selected\""; ?>>Sin valor culinario</option>
        <option value="Buena" <?php if($Clasificacion == "Buena") echo "selected=\"selected\""; ?>>Buena</option>
        <option value="Excelente" <?php if($Clasificacion == "Excelente") echo "selected=\"selected\""; ?>>Excelente</option>
        <option value="Sin clasificar" <?php if($Clasificacion == "Sin clasificar") echo "selected=\"selected\""; ?>>Sin clasificar</option>
      </select>
</td>
<td>
<span class="opcionElegida">Mostrar:</span>
<select name="MOSTRAR" onChange="Paginar(this);" class="txt_inputs_buscador">
<option value="10" <?php if ($Mostrar == 10) echo "selected"; ?>>10</option>
<option value="25" <?php if ($Mostrar == 25) echo "selected"; ?>>25</option>
<option value="50" <?php if ($Mostrar == 50) echo "selected"; ?>>50</option>
<option value="100" <?php if ($Mostrar == 100) echo "selected"; ?>>100</option>
<option value="0" <?php if ($Mostrar == 0) echo "selected"; ?>>Todos</option>
</select>
</td>
<td class="lateralizq">&nbsp;</td>
</tr>
</table>

<?php


//$link = ConnBDCervera();
$link = ConnBDCervera();
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT idSetas, NombreComun, NombreCientifico, Clasificacion,Setas.Clase, Autor, SetasSubOrden.SubOrden FROM Setas ";
$sql .= " left join SetasSubOrden on Setas.idSetasSubOrden = SetasSubOrden.idSetasSubOrden ";
if ($Clasificacion != ""){
	$sql .= " where  Setas.Clasificacion = '$Clasificacion' ";
	if($Buscar != ""){
		$sql .= " and  Setas.NombreComun like '%$Buscar%' "
		. " or Setas.NombreCientifico like '%$Buscar%' "
		. " or Setas.Autor like '%$Buscar%' "
		. " or Setas.Clasificacion like '%$Buscar%' "
		. " or Setas.Sombrero like '%$Buscar%' "
		. " or Setas.Pie like '%$Buscar%' "
		. " or Setas.Laminas like '%$Buscar%' "
		. " or Setas.Himenio like '%$Buscar%' "
		. " or Setas.Exporada like '%$Buscar%' "
		. " or Setas.Carne like '%$Buscar%' "
		. " or Setas.EpocaHabitat like '%$Buscar%' "
		. " or Setas.Comestibilidad like '%$Buscar%' "; 
		}
}else{
	if($Buscar != ""){
		$sql .= " where  Setas.NombreComun like '%$Buscar%' "
		. " or Setas.NombreCientifico like '%$Buscar%' "
		. " or Setas.Autor like '%$Buscar%' "
		. " or Setas.Clasificacion like '%$Buscar%' "
		. " or Setas.Sombrero like '%$Buscar%' "
		. " or Setas.Pie like '%$Buscar%' "
		. " or Setas.Laminas like '%$Buscar%' "
		. " or Setas.Himenio like '%$Buscar%' "
		. " or Setas.Exporada like '%$Buscar%' "
		. " or Setas.Carne like '%$Buscar%' "
		. " or Setas.EpocaHabitat like '%$Buscar%' "
		. " or Setas.Comestibilidad like '%$Buscar%' "; 
		}
	
}


$result = mysqli_query($link,$sql);
if (!$result)
{
$message = "Invalid query".mysqli_error($link)."\n";
$message .= "whole query: " .$sql;	
die($message);
exit;
}

$NumTotalRegistros = mysqli_num_rows($result);
//calculo el total de p�&copy; nas
$max = mysqli_num_rows($result);
if($Mostrar > 0) {$numPags=ceil($NumTotalRegistros/$Mostrar);}else{$numPags=1;}

$sql = $sql . " order by NombreComun ";

if ($Mostrar > 0){
$sql = $sql . " LIMIT ". ((($Pagina * $Mostrar) - $Mostrar) ) .",". $Mostrar;
}else{
$Mostrar = $NumTotalRegistros;
$sql = $sql . " LIMIT ". ((($Pagina * $Mostrar) - $Mostrar) ) .",". ($NumTotalRegistros);	
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
?>
<table width="924" border="0" cellpadding="0" cellspacing="0">
<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>Nombre Com&uacute;n</td>
<td>Nombre Cient&iacute;fico</td>
<td>Clase</td>
<td>SubOrden</td>
<td>Clas.</td>
<td>Autor</td>
<td><div align="center">
<input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos"/>
</div></td>
<td><div align="center"></div></td>
<td class="lateralizq">&nbsp;</td>
</tr>
<?php
$clasefila = "filagris";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

if ($clasefila == "filagris" ){
$clasefila = "filablanca";
}else{
$clasefila = "filagris";
}
?>
<tr class="<?php echo $clasefila; ?>">
<td>&nbsp;</td>
<td><?php echo $row["NombreComun"];?></td>
<td><?php echo $row["NombreCientifico"];?></td>
<td><?php echo substr($row["Clase"],0,3);?></td>
<td><?php echo $row["SubOrden"];?></td>
<td>
<?php 
switch ($row["Clasificacion"]){
	case "Mortal" : $ImagenSeta = "setas-mortal.gif"; break;
	case "Venenosa" : $ImagenSeta = "setas-venenosa.gif";break;
	case "Sin valor culinario" : $ImagenSeta = "setas-sin-valor-culinario.gif";break;
	case "Buena" : $ImagenSeta = "setas-buena.gif";break;
	case "Excelente" : $ImagenSeta = "setas-excelente.gif";break;
	case "Sin clasificar" : $ImagenSeta = "setas-sin-clasificar.gif";break;
}

echo "<img src='images/$ImagenSeta' title='".$row["Clasificacion"]."' width='16px' height='16px' align='top' hspace='2' />";

?></td>
<td><?php echo $row["Autor"];?></td>
<td><div align="center">
<input type="checkbox" name="idDir" value="<?php echo $row["idSetas"];?>"/>
</div></td>
<td><div align="center">
  <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='setas-editar.php?idSetas=<?php echo $row["idSetas"];?>&page=<?php echo $pagina_actual;?>&titulo=<?php echo $titulo;?>'"/>
</div></td>
<td class="lateralizq">&nbsp;</td>
</tr>

<?php

}
?>

<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><div align="center"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $pagina_actual;?>)"/></div></td>
<td><div align="center"></div></td>
<td class="lateralizq">&nbsp;</td>
</tr>
<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>&nbsp;</td>
<td><?php 
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"setas-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&buscar=$Buscar&Clasificacion=$Clasificacion&Clase=$Clase\" class=\"linkBlanco\"> << Anterior </a>";
}
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"setas-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&buscar=$Buscar&Clasificacion=$Clasificacion&Clase=$Clase\" class=\"linkBlanco\"> Siguiente >> </a>";
}
?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>
<?php
if(($numPags > 1) and ($Mostrar < $NumTotalRegistros)){
echo "Ir a P&aacute;gina: ";
echo "<select name=\"Pagina\" class=\"txt_inputs_buscador\" onchange=\"CambiarPagina(this);\">";
for ($i = 1;$i <= $numPags; $i++){
if ($i == $Pagina){
echo "<option value=\"$i\" selected>$i</option>";
}else{
echo "<option value=\"$i\">$i</option>";
}
}
echo "</select>";
}
?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td class="lateralizq">&nbsp;</td>
</tr>
</table>

<?php
}else{
// No hay entradas en el directorio
?>
<div class="errortexto">No hay entradas en Rutas.</div>
<?php
}
mysqli_free_result($result);
mysqli_close($link);	
?>
</div>
<br clear="left" />
</body>
</html>
