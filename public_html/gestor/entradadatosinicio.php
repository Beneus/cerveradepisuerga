<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$ErrorMsn = '';


if ($Descripcion == ""){
	$ErrorMsn = "<span class=\"errortexto\">descripci&oacute;n</a><br/>";
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
	$sqlIns = " Update Inicio set "
						." Descripcion = '". $Descripcion ."', "
						." Fecha = Now() ";

	mysqli_query($link,"SET NAMES 'utf8'");
	mysqli_query($link,"SET CHARACTER SET 'utf8'");
	$result = mysqli_query($link,$sqlIns);


mysqli_close($link);		


}
?>