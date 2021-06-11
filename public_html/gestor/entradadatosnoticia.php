<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$Titulo = $_POST["TITULO"];
$Entradilla = $_POST["ENTRADILLA"];
$FechaNoticia = $_POST["FECHANOTICIA"];
if ($FechaNoticia == "")$FechaNoticia = NULL;
$Fuente = $_POST["FUENTE"];
$Cuerpo = htmlentities($_POST["CUERPO"],ENT_QUOTES);


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
	$sqlIns = " INSERT INTO Noticias (Titulo,Entradilla,Cuerpo,Fuente,ImgNoticia,FechaNoticia,Fecha) VALUES ("
					. " '". Limpiar($Titulo,255) ."', " 	 	   	    	
					. " '". Limpiar($Entradilla,255)  ."', "		
					. " '". $Cuerpo ."', " 
					. " '". Limpiar($Fuente,100) ."', " 
					. " ". 0 .", ";
					if(is_null($FechaNoticia)){$sqlIns .= " NULL, " ;}else{$sqlIns .= " '" .FechaReves($FechaNoticia) ."', " ;}
$sqlIns .= " Now()) ";
		
		
	
	
	$result = mysqli_query($link,$sqlIns);
	
	// obtengo el idMuseo del ultimo registro introducido

	$sql = " Select idNoticia from Noticias order by idNoticia desc limit 1";
	$result = mysqli_query($link,$sql);
		if (!$result)
			{
			$message = "Invalid query".mysqli_error($link)."\n";
			$message .= "whole query: " .$sql;	
			die($message);
			exit;
			}
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$idNoticia = $row["idNoticia"];
		mysqli_free_result($result);
		
	mysqli_close($link);		

//echo $idNoticia;
}
?>