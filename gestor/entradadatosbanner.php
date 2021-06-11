<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


/*
entradadatosbanner.php
?TEXTOBANNER=San Crist�bal-2010
&URLBANNER=http://cerveradepisuerga.eu/agenda-detalle.php?idAgenda=433
&FECHAINICIO=01/07/2010
&FECHAFIN=11/07/2010
&PAGINA=http://cerveradepisuerga.eu/
&IDBANNER=39
&BTNENVIAR=A�adir Banner
*/
$ErrorMsn = '';
$TextoBanner = $_POST["TEXTOBANNER"] ?? '';
$UrlBanner = str_replace("_38_","&",$_POST["URLBANNER"] ?? '');
$idBanner = $_POST["IDBANNER"] ?? '';
$FechaInicio = $_POST["FECHAINICIO"] ?? '';
$FechaFin = $_POST["FECHAFIN"] ?? '';
$Pagina = str_replace("_38_","&",$_POST["PAGINA"] ?? '');


if ($TextoBanner == ""){
	$ErrorMsn = "<span class=\"errortexto\">Texto del anuncio</a><br/>";
}
if ($UrlBanner == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Url del anuncio</a><br/>";
}
if ($FechaInicio == ""){
	$ErrorMsn .= "<span class=\"errortexto\">fecha inicio</a><br/>";
}
if ($FechaFin == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Fecha fin</a><br/>";
}
if ($Pagina == ""){
	$ErrorMsn .= "<span class=\"errortexto\">p�gina</a><br/>";
}

if($ErrorMsn != ""){
	header("Content-Type: text/html;iso-8859-1");
	echo "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
	echo "<blockquote>";
	echo $ErrorMsn;
	echo "</blockquote>";
	exit;
}


if ($ErrorMsn == "" ){	
	
	$link = ConnBDCervera();
	$sqlIns = " Insert INTO BannersGestion (idBanner,TextoBanner,UrlBanner,FechaInicio,FechaFin,Pagina,Publicar,Fecha) values ("
						.$idBanner .", "
						. "'" .$TextoBanner ."', "
						. "'" .urlencode($UrlBanner)."', "
						. "'" .FechaReves($FechaInicio) ."', "
						. "'" .FechaReves($FechaFin) ."', "
						. "'" .$Pagina ."', "		
						. "1, "
						. " Now()) ";


	
	
	$result = mysqli_query($link,$sqlIns);
	
	$sql = "select idBannersGestion from BannersGestion order by idBannersGestion desc limit 1";
	$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$idBannersGestion = $row["idBannersGestion"];
	mysqli_free_result($result);
	
	$sqlUp = "Update BannersGestion set Orden = $idBannersGestion where idBannersGestion = $idBannersGestion ";
	$result = mysqli_query($link,$sqlUp);
	
	
//echo $sqlIns;
mysqli_close($link);		


}
?>