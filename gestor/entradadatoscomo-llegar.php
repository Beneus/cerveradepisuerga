<?php

include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$ErrorMsn = '';

$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);

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
	$sqlUp = " Update ComoLlegar set "
						." Descripcion = '". $Descripcion ."', "
						." Fecha = Now() ";

	$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>