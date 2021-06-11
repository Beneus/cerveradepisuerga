<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

$ErrorMsn = '';
$Comentarios = htmlentities($_POST["COMENTARIOS"] ?? '',ENT_QUOTES);

if ($Comentarios == ""){
	$ErrorMsn = "<span class=\"errortexto\">comentarios</a><br/>";
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
	$sqlIns = " Update Setas set "
						." Comentarios = '". $Comentarios ."', "
						." Fecha = Now() "
						. " where idSetas = 0";

	
	
	$result = mysqli_query($link,$sqlIns);



mysqli_close($link);		


}
?>