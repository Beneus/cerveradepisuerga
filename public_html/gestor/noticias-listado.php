<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");
$idNucleoUrbano = '';
$idSubservicio = '';
$titulo = '';
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
<title>Gestor de contenidos: Noticias listado</title>
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
		var urldest = "noticias-eliminar.php";
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
		function Buscar(x){
		location.href = "noticias-listado.php?Buscar=" + x.value;
		}
		function Paginar(x){
			location.href = "noticias-listado.php?Mostrar="+x.value;
			
		}
		function CambiarPagina(x){
			location.href = "noticias-listado.php?Mostrar=<?php echo $Mostrar;?>&Pagina="+x.value;
			
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
    <li><a title="A&ntilde;adir noticia" href="noticias-entrada.php">A&ntilde;adir entrada</a></li>
    <li class="liselect"><a title="Listado del noticias"  href="noticias-listado.php">Listado</a></li>
  </ul>
</div>
<hr class="separador" />
<div id="contenido">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td><form id="form1" name="form1" method="post" action="">
      <label>Buscar
        <input type="text" name="BUSCAR" id="BUSCAR" />
        </label><input name="BUSCARBOTON" type="button" value="Buscar" id="BUSCARBOTON" onclick="Buscar(document.getElementById('BUSCAR'));" />
    </form>    </td>
    <td>&nbsp;</td>
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


$link = ConnBDCervera();

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$sql = "SELECT * FROM Noticias ";
if($Buscar != ""){
$sql .= " where  Noticias.Titulo like '%$Buscar%' "
. " or Noticias.Entradilla like '%$Buscar%' "
. " or Noticias.Cuerpo like '%$Buscar%' "
. " or Noticias.Fuente like '%$Buscar%' "
. " or Noticias.FechaNoticia like '%$Buscar%' "; 
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

$sql = $sql . " order by FechaNoticia desc ";

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
    <td class="columnafecha">Fecha </td>
    <td>T&iacute;tulo</td>
    <td>Fuente</td>
    <td class="columnaselect"><div align="center">
      <input type="checkbox" name="idTodosDir" value="" onclick="SelTodos(this);" alt="Seleccionar todos" title="Seleccionar todos"/>
    </div></td>
    <td class="columnaeditar"><div align="center"></div></td>
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
    <td class="columnafecha"><?php echo date("d/m/Y",strtotime($row["FechaNoticia"]));?></td>
    <td><?php echo $row["Titulo"];?></td>
    <td><?php echo $row["Fuente"];?></td>
    <td class="columnaselect"><div align="center">
      <input type="checkbox" name="idDir" value="<?php echo $row["idNoticia"];?>"/>
    </div></td>
    <td class="columnaeditar"><div align="center">
      <input type="button" name="EDITAR" value="Editar" class="boton_button" onclick="location.href='noticias-editar.php?idNoticia=<?php echo $row["idNoticia"];?>&Pagina=<?php echo $Pagina;?>&Mostrar=<?php echo $sigMostrar;?>&titulo=<?php echo $titulo;?>'"/>
    </div></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>

<?php
	
	}
?>
 
   <tr class="titulolistado">
    <td class="lateralizq">&nbsp;</td>
    <td class="columnafecha">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="columnaselect"><div align="center"><input type="button" name="ELIMINAR" value="Eliminar" class="boton_button" onClick="EliminarEntrada(<?php echo $Pagina;?>)"/></div></td>
    <td class="columnaeditar"><div align="center"></div></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
   <tr class="titulolistado">
    <td class="lateralizq">&nbsp;</td>
    <td class="columnafecha">&nbsp;</td>
    <td>
    	
<?php 
if(($Pagina > 1) and ($Mostrar < $NumTotalRegistros)){
//echo "<a href=\"noticias-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\"><img src=\"images/pag_der_a.gif\" width=\"9\" height=\"13\" border=\"0\"></a>";
echo "<a href=\"noticias-listado.php?Pagina=".($Pagina - 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\" class=\"linkBlanco\"> << Anterior </a>";
}else{
//echo "<img src=\"images/pag_der_d.gif\" width=\"9\" height=\"13\" border=\"0\">";
}
if(($Pagina < $numPags ) and ($Mostrar < $NumTotalRegistros)){
//echo "<a href=\"noticias-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\"><img src=\"images/pag_der_a.gif\" width=\"9\" height=\"13\" border=\"0\"></a>";
echo "<a href=\"noticias-listado.php?Pagina=".($Pagina + 1)."&Mostrar=$Mostrar&buscar=$Buscar&idNucleoUrbano=$idNucleoUrbano&idSubservicio=$idSubservicio\" class=\"linkBlanco\"> Siguiente >> </a>";
}else{
//echo "<img src=\"images/pag_izq_d.gif\" width=\"9\" height=\"13\" border=\"0\">";
}
?>    	</td>
    <td>&nbsp;</td>
    <td class="columnaselect">&nbsp;</td>
    <td class="columnaeditar">&nbsp;</td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
</table>

<?php
}else{
	// No hay entradas en el directorio
?>
<div class="errortexto">No hay  Noticias.</div>
<?php
}
mysqli_free_result($result);
mysqli_close($link);	
?>
</div>
<br clear="left" />
</body>
</html>
