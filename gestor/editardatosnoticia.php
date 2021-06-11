<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idNoticia = $_POST["IDNOTICIA"] ?? '';
$Titulo = $_POST["TITULO"] ?? '';
$Entradilla = $_POST["ENTRADILLA"] ?? '';
$FechaNoticia = $_POST["FECHANOTICIA"] ?? '';
if ($FechaNoticia == "")$FechaNoticia = NULL;
$Fuente = $_POST["FUENTE"] ?? '';
$Cuerpo = htmlentities($_POST["CUERPO"] ?? '',ENT_QUOTES);
$ErrorMsn = '';


if ($Titulo == ""){
	$ErrorMsn = "<span class=\"errortexto\">T&iacute;tulo.</a><br/>";
}
if ($Entradilla == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Entradilla.</a><br/>";
}
if(isset($FechaNoticia)){
	if (($FechaNoticia != "") && ((!isValidaFechaCorta($FechaNoticia)) or ( strlen($FechaNoticia) != 10))){
			$ErrorMsn .= "<span class=\"errortexto\">Fecha de la noticia.</a><br/>";
	}
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
	$sqlUp = " Update Noticias set "
					. " Titulo = '". Limpiar($Titulo,255) ."', " 	 	   	    	
					. " Entradilla = '". Limpiar($Entradilla,255)  ."', "				
					. " Fuente = '". Limpiar($Fuente,100)  ."', "			
					. " Cuerpo = '". $Cuerpo  ."', ";
					if(is_null($FechaNoticia)){$sqlUp .= " FechaNoticia = NULL  " ;}else{$sqlUp .= " FechaNoticia = '" .FechaReves($FechaNoticia) ."' " ;}
$sqlUp .= " where idNoticia = $idNoticia ";
	

	
	
	$result = mysqli_query($link,$sqlUp);
	
	mysqli_close($link);		


}
?>