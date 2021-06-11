<?php
session_start();
include("includes/variables-user.php");
include("includes/funciones.php");
include("includes/Conn.php");


$idSubservicio = $_GET["idSubservicio"];
$idNucleoUrbano = $_GET["idNucleoUrbano"];
$Buscar = $_GET["Buscar"];
$Pagina = $_GET["Pagina"];
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"];
if (!is_numeric($Mostrar))$Mostrar = 10;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Directorio listado</title>
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
var urldest = "directorio-eliminar.php";
var cad = "page=" + pag +"&cadEliminados=" + cad_eliminados;
if (cad_eliminados != ""){

window.open(urldest+"?"+cad,'','width=200,height=200');
//FAjax(urldest,'espere',cad,'post');
//location.href = "directorio-listado.php";
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
location.href = "user-directorio-listado.php?Mostrar=<?php echo $Mostrar;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&idSubservicio="+x.value;

}
function SeleccionNucleoUrbano(x){
location.href = "user-directorio-listado.php?Mostrar=<?php echo $Mostrar;?>&idSubservicio=<?php echo $idSubservicio;?>&idNucleoUrbano="+x.value;

}
function Paginar(x){
location.href = "user-directorio-listado.php?idNucleoUrbano=<?php echo $idNucleoUrbano;?>&idSubservicio=<?php echo $idSubservicio;?>&Buscar=<?php echo $Buscar;?>&Mostrar="+x.value;

}
function CambiarPagina(x){
location.href = "user-directorio-listado.php?Mostrar=<?php echo $Mostrar;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&idSubservicio=<?php echo $idSubservicio;?>&Pagina="+x.value;

}
function Buscar(x){
location.href = "user-directorio-listado.php?Buscar=" + x.value;
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
<ul>
<?php
		$sql = ' select * from UsuariosAcceso where idUsuario = ' . $_SESSION['idUsuario'];

		$link = ConnBDCervera();
		$result = mysqli_query($link,$sql);
		if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

			if($row["Ambito"]=='Directorio'){
				echo '<li><a href="user-directorio-listado.php">Directorio</a></li>';
			}
			if($row["Ambito"]=='Museos'){
				echo '<li><a href="user-museos-listado.php">Museos</a></li>';
			}
			if($row["Ambito"]=='Monumentos'){
				echo '<li><a href="user-monumentos-listado.php">Monumentos</a></li>';
			}
			if($row["Ambito"]=='NucleosUrbanos'){
				echo '<li><a href="user-nucleosurbanos-listado.php">NucleosUrbanos</a></li>';
			}
			
		}
		
		
		?>
</ul>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">

</div>
<div id="opciones">

</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="lateralizq">&nbsp;</td>
<td>
<label>Buscar
<input type="text" name="BUSCAR" id="BUSCAR" value="<?php echo $Buscar; ?>"/>
</label><input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
</td>
<td><?php 
$link = ConnBDCervera();
$sql = "SELECT distinct NucleosUrbanos.idNucleoUrbano, NombreNucleoUrbano FROM NucleosUrbanos 
inner join Directorio on NucleosUrbanos.idNucleoUrbano = Directorio.idNucleoUrbano
inner join UsuariosAcceso on Directorio.idDirectorio = UsuariosAcceso.idAmbito
where UsuariosAcceso.idusuario = " . $_SESSION['idUsuario'] . " order by NombreNucleoUrbano";
$accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
?> </td>
<td></td>
<td class="lateralizq">
<span class="opcionElegida">Mostrar:</span>
<select name="MOSTRAR" onChange="Paginar(this);" class="txt_inputs_buscador">
<option value="10" <?php if ($Mostrar == 10) echo "selected"; ?>>10</option>
<option value="25" <?php if ($Mostrar == 25) echo "selected"; ?>>25</option>
<option value="50" <?php if ($Mostrar == 50) echo "selected"; ?>>50</option>
<option value="100" <?php if ($Mostrar == 100) echo "selected"; ?>>100</option>
<option value="0" <?php if ($Mostrar == 0) echo "selected"; ?>>Todos</option>
</select>

</td>
</tr>
</table>

<?php

$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$sql = "Select Distinct D.idDirectorio , D.NombreComercial , D.Direccion , NU.NombreNucleoUrbano , D.Telefono "
. " from Directorio as D INNER JOIN NucleosUrbanos as NU ON D.idNucleoUrbano = NU.idNucleoUrbano  inner join UsuariosAcceso on D.idDirectorio = UsuariosAcceso.idAmbito";
 
 
 
if ($idSubservicio > 0 ) {				
$sql = $sql . " inner join DirectorioSubServicio as DSB on D.idDirectorio = DSB.idDirectorio ";
}

 $sql = $sql . " where UsuariosAcceso.idusuario = ". $_SESSION['idUsuario'];
 
if ($idNucleoUrbano > 0){ $sql = $sql . " and D.idNucleoUrbano = $idNucleoUrbano ";
if ($idSubservicio > 0 ) {$sql = $sql . " and  DSB.idSubservicio = $idSubservicio ";} 
}else{
if ($idSubservicio > 0 ) {$sql = $sql . " and  DSB.idSubservicio = $idSubservicio ";} 
}
if($Buscar != ""){
$sql .= " and(  D.NombreComercial like '%$Buscar%' "
. " or NU.NombreNucleoUrbano like '%$Buscar%' "
. " or D.Direccion like '%$Buscar%' )"; 
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

$sql = $sql . " order by NombreComercial ";

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
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>Nombre comercial</td>
<td>Direcci&oacute;n</td>
<td>Nucleo Urbano</td>
<td>Telefono</td>
<td><div align="center">

</div></td>
<td><div align="center"></div></td>
<td class="lateralizq">&nbsp;</td>
</tr>
<?php
$RegistroMostrado = 0;
$clasefila = "filagris";
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) && ($RegistroMostrado < $Mostrar)) {
if ($clasefila == "filagris" ){
$clasefila = "filablanca";
}else{
$clasefila = "filagris";
}

?>
<tr class="<?php echo $clasefila; ?>">
<td>&nbsp;</td>
<td><?php echo $row["NombreComercial"];?></td>
<td><?php echo $row["Direccion"];?></td>
<td><?php echo $row["NombreNucleoUrbano"];?></td>
<td align="right"><?php echo $row["Telefono"];?></td>
<td><div align="center">

</div></td>
<td><div align="center">
<input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='user-directorio-editar.php?idDirectorio=<?php echo $row["idDirectorio"];?>&Pagina=<?php echo $Pagina;?>&Mostrar=<?php echo $sigMostrar;?>&titulo=<?php echo $titulo;?>'"/>
</div></td>
<td class="lateralizq">&nbsp;</td>
</tr>

<?php
$RegistroMostrado++;
}
?>

<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><div align="center"></div></td>
<td>&nbsp;</td>
<td class="lateralizq">&nbsp;</td>
</tr>
<tr class="titulolistado">
<td class="lateralizq">&nbsp;</td>
<td>&nbsp;</td>
<td>

<?php 
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
//echo "<a href=\"directorio-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&Buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\"><img src=\"images/pag_der_a.gif\" width=\"9\" height=\"13\" border=\"0\"></a>";
echo "<a href=\"directorio-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&Buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\" class=\"linkBlanco\"> << Anterior </a>";
}else{
//echo "<img src=\"images/pag_der_d.gif\" width=\"9\" height=\"13\" border=\"0\">";
}
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
//echo "<a href=\"directorio-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&Buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\"><img src=\"images/pag_der_a.gif\" width=\"9\" height=\"13\" border=\"0\"></a>";
echo "<a href=\"directorio-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&Buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\" class=\"linkBlanco\"> Siguiente >> </a>";
}else{
//echo "<img src=\"images/pag_izq_d.gif\" width=\"9\" height=\"13\" border=\"0\">";
}
?>


</td>
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

?>
</td>
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

<div class="errortexto">No hay entradas en el directorio.</div>

<?php


}
mysqli_free_result($result);
mysqli_close($link);	
?>




</div>
<br clear="left" />
</body>
</html>
