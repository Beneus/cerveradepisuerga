<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$idNucleoUrbano = $_GET["idNucleoUrbano"] ?? '';
$Ano = $_GET["Ano"] ?? '';
$Mes = $_GET["Mes"] ?? '';
$Dia = $_GET["Dia"] ?? '';
$Buscar = $_GET["Buscar"] ?? '';
$Pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar))$Mostrar = 10;
$titulo = '';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Agenda listado</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
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
		var urldest = "deportes-eliminar.php";
		var cad = "page=" + pag +"&cadEliminados=" + cad_eliminados;
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
		function SeleccionNucleoUrbano(x){
		location.href = "deportes-listado.php?Mostrar=<?php echo $Mostrar;?>&Ano=<?php echo $Ano;?>&Mes=<?php echo $Mes;?>&Dia=<?php echo $Dia;?>&idNucleoUrbano="+x.value;
		
		}		
		function SeleccionAno(x){
		location.href = "deportes-listado.php?Mostrar=<?php echo $Mostrar;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Mes=<?php echo $Mes;?>&Dia=<?php echo $Dia;?>&Ano="+x.value;
		
		}
		function SeleccionMes(x){
		location.href = "deportes-listado.php?Mostrar=<?php echo $Mostrar;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Ano=<?php echo $Ano;?>&Dia=<?php echo $Dia;?>&Mes="+x.value;
		
		}
		function SeleccionDia(x){
		location.href = "deportes-listado.php?Mostrar=<?php echo $Mostrar;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Ano=<?php echo $Ano;?>&Mes=<?php echo $Mes;?>&Dia="+x.value;
		
		}
		function Paginar(x){
			location.href = "deportes-listado.php?&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Dia=<?php echo $Dia;?>&Mes=<?php echo $Mes;?>&Ano=<?php echo $Ano;?>&Mostrar="+x.value;
			
		}
		function CambiarPagina(x){
			location.href = "deportes-listado.php?&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Dia=<?php echo $Dia;?>&Mes=<?php echo $Mes;?>&Ano=<?php echo $Ano;?>&Mostrar=<?php echo $Mostrar;?>&Pagina="+x.value;
			
		}
		function Buscar(x){
		location.href = "deportes-listado.php?Buscar=" + x.value;
		}
	</script>
</head>

<body>
<div id="cab">
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
<map name="Map" id="Map">
<area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
</map></div>
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
    <li><a title="A&ntilde;adir noticia" href="deportes-entrada.php">A&ntilde;adir entrada</a></li>
    <li class="liselect"><a title="Listado del noticias"  href="deportes-listado.php">Listado</a></li>
  </ul>
</div>
<hr class="separador" />
<div id="contenido">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td>Buscar</td>
    <td>d&iacute;a</td>
    <td>mes</td>
    <td>a&ntilde;o</td>
    <td>localidad</td>
    <td>Mostrar</td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td><form id="form1" name="form1" method="post" action="">
      <input name="BUSCAR" type="text" id="BUSCAR" value="<?php echo $Buscar; ?>" placeholder="Buscar" />
<input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
    </form>    </td>
    <td><?php 
$link = ConnBDCervera();
$sql = "SELECT DISTINCT day(FechaInicio) FROM Deportes order by day(FechaInicio)";
$accion = "onchange=\"SeleccionDia(this);\"";
echo CrearSelect("DIA","day(FechaInicio)","day(FechaInicio)",$sql,$link,"","","",$accion,$Dia);
?></td>
    <td><?php 
$link = ConnBDCervera();
$sql = "SELECT DISTINCT month(FechaInicio), monthname(FechaInicio) FROM Deportes order by Month(FechaInicio) ";
$accion = "onchange=\"SeleccionMes(this);\"";
echo CrearSelect("MES","month(FechaInicio)","monthname(FechaInicio)",$sql,$link,"","","",$accion,$Mes);
?></td>
    <td><?php 
$link = ConnBDCervera();
$sql = "SELECT DISTINCT year(FechaInicio) FROM Deportes order by year(FechaInicio) desc";
$accion = "onchange=\"SeleccionAno(this);\"";
echo CrearSelect("ANO","year(FechaInicio)","year(FechaInicio)",$sql,$link,"","","",$accion,$Ano);
?></td>
<td><?php 
$link = ConnBDCervera();
$sql = "SELECT distinct idNucleoUrbano, NombreNucleoUrbano FROM NucleosUrbanos order by NombreNucleoUrbano";
$accion = "onchange=\"SeleccionNucleoUrbano(this);\"";
echo CrearSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$sql,$link,"","","",$accion,$idNucleoUrbano);
?></td>
    <td>
							<select name="MOSTRAR" onChange="Paginar(this);" class="txt_inputs_buscador">
								<option value="10" <?php if ($Mostrar == 10) echo "selected"; ?>>10</option>
								<option value="25" <?php if ($Mostrar == 25) echo "selected"; ?>>25</option>
								<option value="50" <?php if ($Mostrar == 50) echo "selected"; ?>>50</option>
								<option value="100" <?php if ($Mostrar == 100) echo "selected"; ?>>100</option>
								<option value="0" <?php if ($Mostrar == 0) echo "selected"; ?>>Todos</option>
							</select>    </td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
</table>

<?php


$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT DEP.*, NU.NombreNucleoUrbano FROM Deportes as DEP ";
		
if ($idNucleoUrbano > 0){ 
$sql = $sql . " inner JOIN NucleosUrbanos as NU ON DEP.idNucleoUrbano = NU.idNucleoUrbano where DEP.idNucleoUrbano = $idNucleoUrbano ";
	if($Buscar != ""){
	$sql .= " and  DEP.Evento like '%$Buscar%' "
	. " or DEP.Lugar like '%$Buscar%' "
	. " or NU.NombreNucleoUrbano like '%$Buscar%'"
	. " or DEP.FechaInicio like '%$Buscar%'"
	. " or DEP.HoraE like '%$Buscar%'"
	. " or DEP.Descripcion like '%$Buscar%'";
	}
	if($Ano != ""){
	$sql .= " and Year(DEP.FechaInicio) = '$Ano'";
	}
	if($Mes != ""){
	$sql .= " and Month(DEP.FechaInicio) = '$Mes'";
	}
	if($Dia != ""){
	$sql .= " and day(DEP.FechaInicio) = '$Dia'";
	}
	
}else{
$sql = $sql . " left JOIN NucleosUrbanos as NU ON DEP.idNucleoUrbano = NU.idNucleoUrbano ";
	if($Buscar != ""){
	$sql .= " where  DEP.ActoDeportivo like '%$Buscar%' "
	. " or DEP.Lugar like '%$Buscar%' "
	. " or NU.NombreNucleoUrbano like '%$Buscar%'"
	. " or DEP.FechaInicio like '%$Buscar%'"
	. " or DEP.Hora like '%$Buscar%'"
	. " or DEP.Descripcion like '%$Buscar%'";
	if($Ano != ""){
		$sql .= " and Year(DEP.FechaInicio) = '$Ano'";
		if($Mes != ""){
			$sql .= " and Month(DEP.FechaInicio) = '$Mes'";
		}
		if($Dia != ""){
			$sql .= " and day(DEP.FechaInicio) = '$Dia'";
		}
	}
	}elseif($Ano != ""){
		$sql .= " where Year(DEP.FechaInicio) = '$Ano'";
		if($Mes != ""){
		$sql .= " and Month(DEP.FechaInicio) = '$Mes'";
		}
		if($Dia != ""){
		$sql .= " and day(DEP.FechaInicio) = '$Dia'";
		}
	}elseif($Mes != ""){
		$sql .= " where Month(DEP.FechaInicio) = '$Mes'";
		if($Dia != ""){
		$sql .= " and day(DEP.FechaInicio) = '$Dia'";
		}
	}elseif($Dia != ""){
	$sql .= " where day(DEP.FechaInicio) = '$Dia'";
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
//calculo el total de p�ginas
$max = mysqli_num_rows($result);
if($Mostrar > 0) {$numPags=ceil($NumTotalRegistros/$Mostrar);}else{$numPags=1;}

$sql = $sql . " order by FechaInicio, Hora ";

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
    <td width="25" class="lateralizq">&nbsp;</td>
    <td width="100" class="columnafecha">Fecha </td>
    <td width="70" class="titulolistado">Hora</td>
    <td class="titulolistado">Acto deportivo</td>
    <td class="titulolistado">Lugar</td>
    <td width="150" class="titulolistado">Nucleo Urbano</td>
    <td width="64" class="columnaselect"><div align="center">
      <input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos"/>
    </div></td>
    <td width="50" class="columnaeditar"><div align="center"></div></td>
    <td width="31" class="lateralizq">&nbsp;</td>
  </tr>
<?php
$clasefila = "filagris";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		
		if ($clasefila == "filagris" ){
			$clasefila = "filablanca";
		}else{
			$clasefila = "filagris";
		}
		
	if(!is_null($row["Hora"])){
	    $Hora = date("H:i", strtotime($row["Hora"]));
	  }else{
	  	$Hora = "--:--";
	  }
?>
 <tr class="<?php echo $clasefila; ?>">
    <td class="<?php echo $clasefila; ?>">&nbsp;</td>
    <td class="columnafecha"><?php echo date("d/m/Y",strtotime($row["FechaInicio"]));?></td>
    <td class="<?php echo $clasefila; ?>"><?php echo $Hora; ?></td>
    <td class="<?php echo $clasefila; ?>"><?php echo $row["ActoDeportivo"];?></td>
    <td class="<?php echo $clasefila; ?>"><?php echo $row["Lugar"];?></td>
    <td width="150"><?php echo $row["NombreNucleoUrbano"];?></td>
    <td class="columnaselect"><div align="center">
      <input type="checkbox" name="idDir" value="<?php echo $row["idDeporte"];?>"/>
    </div></td>
    <td class="columnaeditar"><div align="center">
      <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='deportes-editar.php?idDeporte=<?php echo $row["idDeporte"];?>&Pagina=<?php echo $Pagina;?>&Mostrar=<?php echo $sigMostrar;?>&titulo=<?php echo $titulo;?>&idNucleoUrbano=<?php echo $idNucleoUrbano;?>&Ano=<?php echo $Ano;?>&Dia=<?php echo $Dia;?>&Mes=<?php echo $Mes;?>'"/>
    </div></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>

<?php
	
	}
?>
 
   <tr class="titulolistado">
    <td class="lateralizq">&nbsp;</td>
    <td class="columnafecha">&nbsp;</td>
    <td class="titulolistado">&nbsp;</td>
    <td class="titulolistado">&nbsp;</td>
    <td class="titulolistado">&nbsp;</td>
    <td width="150">&nbsp;</td>
    <td class="columnaselect"><div align="center"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $Pagina;?>)"/></div></td>
    <td class="columnaeditar"><div align="center"></div></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
   <tr class="titulolistado">
    <td class="lateralizq">&nbsp;</td>
    <td class="columnafecha">&nbsp;</td>
    <td class="titulolistado">&nbsp;</td>
    <td class="titulolistado">
    	
<?php 
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
//echo "<a href=\"noticias-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\"><img src=\"images/pag_der_a.gif\" width=\"9\" height=\"13\" border=\"0\"></a>";
echo "<a href=\"deportes-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano\" class=\"linkBlanco\"> << Anterior </a>";
}else{
//echo "<img src=\"images/pag_der_d.gif\" width=\"9\" height=\"13\" border=\"0\">";
}
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
//echo "<a href=\"noticias-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\"><img src=\"images/pag_der_a.gif\" width=\"9\" height=\"13\" border=\"0\"></a>";
echo "<a href=\"deportes-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano\" class=\"linkBlanco\"> Siguiente >> </a>";
}else{
//echo "<img src=\"images/pag_izq_d.gif\" width=\"9\" height=\"13\" border=\"0\">";
}
?>    	</td>
    <td class="titulolistado">&nbsp;</td>
    <td width="150">
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
    <td class="columnaselect">&nbsp;</td>
    <td class="columnaeditar">&nbsp;</td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
</table>

<?php
}else{
	// No hay entradas en el directorio
?>
<div class="errortexto">No hay eventos en la agenda.</div>
<?php
}
mysqli_free_result($result);
mysqli_close($link);	
?>
</div>
<br clear="left" />
</body>
</html>
