<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idEscudo = $_POST["IDESCUDO"] ?? '';
$Nombre = $_POST["NOMBRE"] ?? '';
$Direccion = $_POST["DIRECCION"] ?? '';
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$ErrorMsn = "";


if ($Nombre == ""){
	$ErrorMsn = "<span class=\"errortexto\">nombre.</a><br/>";
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
	$sqlUp = " Update Escudos set "
					. " Nombre = '". Limpiar($Nombre,255) ."', " 	 	   	    	
					. " Direccion = '". Limpiar($Direccion,255)  ."', "				
					. " idNucleoUrbano = ". $idNucleoUrbano  .", "			
					. " Descripcion = '". $Descripcion  ."' "
					. " where idEscudo = $idEscudo ";

	
	
	$result = mysqli_query($link,$sqlUp);
	
	mysqli_close($link);		


}
?>