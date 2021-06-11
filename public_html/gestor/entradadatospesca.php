<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

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
$ErrorMsn = '';



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
$sqlIns = " INSERT INTO Pesca (TipoTramo, Rio, Nombre, TipoPesca, Espacio, PeriodoHabil, DiasHabiles, CupoCapturas, TamanoCapturas, Cebos, PermisosDia, LimiteSuperior, LimiteInferior, Especies, Descripcion, ImgPesca, fecha) VALUES ("	
				. " '". $TipoTramo ."', "
				. " '". $Rio ."', "
				. " '". $Nombre ."', "
				. " '". $TipoPesca ."', "
				. " ". $Espacio .", "
				. " '". $PeriodoHabil ."', "
				. " '". $DiasHabiles ."', "
				. " ". $CupoCapturas .", "
				. " ". $TamanoCapturas .", "
				. " '". $Cebos ."', "
				. " ". $PermisosDia .", "
				. " '". $LimiteSuperior ."', "
				. " '". $LimiteInferior ."', "
				. " '". $Especies ."', "
				. " '". $Descripcion ."', "
				. " '". $ImgPesca ."', "
				. " Now()) ";
				


$result = mysqli_query($link,$sqlIns);

mysqli_close($link);		


}
?>