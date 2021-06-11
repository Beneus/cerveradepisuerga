<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$TipoTramo = $_GET["TipoTramo"] ?? '';
$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar))$Mostrar = 10;
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
	if (document.getElementsByName("idDir")[i].checked)
	{

		if (cad_eliminados == "")
		{
			cad_eliminados += document.getElementsByName("idDir")[i].value;
		}
		else
		{
			cad_eliminados += "-" + document.getElementsByName("idDir")[i].value;
		}
	}
}
var urldest = "pesca-eliminar.php";
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
location.href = "pesca-listado.php?idsubsevicio="+x.value;

}

function CambiarClasificacion(x){
location.href = "pesca-listado.php?Mostrar=<?php echo $Mostrar;?>&TipoTramo="+x.value;

}
function Paginar(x){
location.href = "pesca-listado.php?&Mostrar="+x.value;

}
function CambiarPagina(x){
location.href = "pesca-listado.php?Mostrar=<?php echo $Mostrar;?>&Pagina="+x.value;

}
function Buscar(x){
location.href = "pesca-listado.php?Buscar=" + x.value;
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
    <li><a title="a&ntilde;adir imagen a la introducci&oacute;n"  href="galeria-documentos.php?Ambito=Pesca&idAmbito=0&Campo=idPesca&NCampo=idPesca&Referer=pesca-introduccion.php">A&ntilde;adir documento introducci&oacute;n</a> </li>
	<li><a title="A&ntilde;adir entrada al directorio" href="pesca-entrada.php">A&ntilde;adir entrada gu&iacute;a micol&oacute;gica</a></li>
	<li class="liselect"><a title="Listado del directorio"  href="pesca-listado.php">Listado tramo de pesca</a></li>
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
<select name="TIPOTRAMO" id="TIPOTRAMO" onchange="CambiarClasificacion(this);">
						<option value="">Todos los tramos</option>    
            <option value="Coto" <?php if ($TipoTramo =="Coto") echo "selected"; ?>>Coto</option>    
            <option value="Tramo Libre" <?php if ($TipoTramo =="Tramo Libre") echo "selected"; ?>>Tramo Libre</option>
            <option value="Escenario deportivo" <?php if ($TipoTramo =="Escenario deportivo") echo "selected"; ?>>Escenario deportivo</option>
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

$sql = "SELECT idPesca, Rio, Nombre, TipoTramo, TipoPesca, PeriodoHabil, DiasHabiles FROM Pesca  where idPesca > 0 ";
if ($TipoTramo != ""){
	$sql .= " and TipoTramo = '$TipoTramo' ";
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

$sql = $sql . " order by Rio ";

if ($Mostrar > 0){
$sql = $sql . " LIMIT ". ((($Pagina * $Mostrar) - $Mostrar) ) .",". (($Pagina * $Mostrar) - 1 );
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
<td>R&iacute;o</td>
<td>Nombre del tramo</td>
<td>Tipo de tramo</td>
<td>Tipo de pesca</td>
<td>Periodo habil</td>
<td>D&iacute;as habiles</td>
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
<td><?php echo $row["Rio"];?></td>
<td><?php echo $row["Nombre"];?></td>
<td><?php echo $row["TipoTramo"];?></td>
<td><?php echo $row["TipoPesca"];?></td>
<td><?php echo $row["PeriodoHabil"];?></td>
<td><?php echo $row["DiasHabiles"];?></td>
<td><div align="center">
<input type="checkbox" name="idDir" value="<?php echo $row["idPesca"];?>"/>
</div></td>
<td><div align="center">
  <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='pesca-editar.php?idPesca=<?php echo $row["idPesca"];?>&page=<?php echo $Pagina;?>'"/>
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
<td><div align="center"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $Pagina;?>)"/></div></td>
<td><div align="center"></div></td>
<td class="lateralizq">&nbsp;</td>
</tr>
<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>&nbsp;</td>
<td><?php 
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"pesca-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&buscar=$Buscar\" class=\"linkBlanco\"> << Anterior </a>";
}
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
echo "<a href=\"pesca-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&buscar=$Buscar\" class=\"linkBlanco\"> Siguiente >> </a>";
}
?></td>
<td>&nbsp;</td>
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
