<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idPesca = $_POST["IDPESCA"] ?? '';
$TipoTramo = $_POST["TIPOTRAMO"] ?? '';
$Rio = $_POST["RIO"] ?? '';
$Nombre = $_POST["NOMBRE"] ?? '';
$TipoPesca = $_POST["TIPOPESCA"] ?? '';
	$Espacio = $_POST["ESPACIO"] ?? '';
	if (!is_numeric($Espacio)) $Espacio = 0;
$PeriodoHabil = $_POST["PERIODOHABIL"] ?? '';
$DiasHabiles = $_POST["DIASHABILES"] ?? '';
	$CupoCapturas = $_POST["CUPOCAPTURAS"] ?? '';
	if (!is_numeric($CupoCapturas)) $CupoCapturas = 0;
	$TamanoCapturas = $_POST["TAMANOCAPTURAS"] ?? '';
	if (!is_numeric($TamanoCapturas)) $TamanoCapturas = 0;
$Cebos = $_POST["CEBOS"] ?? '';
	$PermisosDia = $_POST["PERMISOSDIA"] ?? '';
	if (!is_numeric($PermisosDia)) $PermisosDia = 0;
$LimiteSuperior = $_POST["LIMITESUPERIOR"] ?? '';
$LimiteInferior = $_POST["LIMITEINFERIOR"] ?? '';
$Especies = $_POST["ESPECIES"] ?? '';
$Longitud = $_POST["LONGITUD"] ?? '';
$Latitud = $_POST["LATITUD"] ?? '';
$encodedPoints = $_POST["ENCODEDPOINTS"] ?? '';
$encodedLevels = $_POST["ENCODEDLEVELS"] ?? '';
$numLevels = $_POST["NUMLEVELS"] ?? '';
$Zoom = $_POST["ZOOM"] ?? '';
$Color = $_POST["COLOR"] ?? '';
$LongitudLimiteSuperior = $_POST["LONGITUDLIMITESUPERIOR"] ?? '';
$LatitudLimiteSuperior  = $_POST["LATITUDLIMITESUPERIOR"] ?? '';
$LongitudLimiteInferior = $_POST["LONGITUDLIMITEINFERIOR"] ?? '';
$LatitudLimiteInferior  = $_POST["LATITUDLIMITEINFERIOR"] ?? '';
$NucleoUrbano = $_POST["NUCLEOURBANO"] ?? '';
$ErrorMsn = '';

$ImgPesca = '';
if ($Nombre == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nombre.</a><br/>";
}
if ($Rio == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Rio.</a><br/>";
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
$sqlUp = " Update Pesca set "
				. " TipoTramo = '". $TipoTramo ."', "
				. " Rio = '". $Rio ."', "
				. " Nombre = '". $Nombre ."', "
				. " TipoPesca = '". $TipoPesca ."', "
				. " Espacio = ". $Espacio .", "
				. " PeriodoHabil = '". $PeriodoHabil ."', "
				. " DiasHabiles = '". $DiasHabiles ."', "
				. " CupoCapturas = ". $CupoCapturas .", "
				. " TamanoCapturas = ". $TamanoCapturas .", "
				. " Cebos = '". $Cebos ."', "
				. " PermisosDia = ". $PermisosDia .", "
				. " LimiteSuperior = '". $LimiteSuperior ."', "
				. " LimiteInferior = '". $LimiteInferior ."', "
				. " Especies = '". $Especies ."', "
				. " ImgPesca = '". $ImgPesca ."', " 
				. " Longitud = '". $Longitud ."', " 
				. " Latitud = '". $Latitud ."', " 
				. " LongitudLimiteSuperior = '". $LongitudLimiteSuperior ."', "
				. " LatitudLimiteSuperior = '". $LatitudLimiteSuperior ."', "
				. " LongitudLimiteInferior = '". $LongitudLimiteInferior ."', "
				. " LatitudLimiteInferior = '". $LatitudLimiteInferior ."', "
				. " NucleoUrbano = '". $NucleoUrbano ."', "
				. " encodedPoints = '". $encodedPoints ."', " 
				. " encodedLevels = '". $encodedLevels ."', " 
				. " numLevels = '". $numLevels ."', " 
				. " Zoom = ". $Zoom .", " 
				. " Color = '". $Color ."' " 
				. " where idPesca = $idPesca ";



$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>