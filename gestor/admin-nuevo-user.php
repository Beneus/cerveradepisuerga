<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$Usuario = $_POST["USUARIO"] ?? '';
$Clave = $_POST["CLAVE"] ?? '';
$Clave2 = $_POST["CLAVE2"] ?? '';
$TipoUsuario = $_POST["TIPOUSUARIO"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$Ambito = $_POST["AMBITO"] ?? '';
$idAmbito = $_POST["IDAMBITO"] ?? '';
$ErrorMsn = '';


if ($Usuario == ""){
	$ErrorMsn = "<span class=\"errortexto\">Usuario.</span><br/>";
}elseif (strlen($Usuario) < 6){
	$ErrorMsn = "El <span class=\"errortexto\">Usuario.</span> debe de tener al menos 6 caracteres<br/>";
}
if ($Clave == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Clave.</span><br/>";
}elseif(strlen($Clave) < 6){
	$ErrorMsn = "La <span class=\"errortexto\">Clave.</span> debe de tener al menos 6 caracteres<br/>";
}
if ($Clave2 != $Clave){
	$ErrorMsn .= "Las <span class=\"errortexto\">Claves</span> introducidas no son iguales.<br/>";
}
if (($Email != "") and (!isEmail($Email))){
	$ErrorMsn .= "<span class=\"errortexto\">Email.</span><br/>";
}

// comprobamos si el usuario ya existe
$sql = "select Usuario From Usuarios where Usuario = '$Usuario' ";
$link = ConnBDCervera();
$result = mysqli_query($link,$sql);
if (!$result)
{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
}
$max = mysqli_num_rows($result);	
if($max > 0)
{  
	// el usuario ya existe, se debe de elegir otro.
	$ErrorMsn .= "El usuario <span class=\"errortexto\">$Usuario</span> ya existe, debe de elegir otro.<br/>";
}
mysqli_free_result($result);

if($ErrorMsn != "")
{
	header("Content-Type: text/html;iso-8859-1");
	echo "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
	echo "<blockquote>";
	echo $ErrorMsn;
	echo "</blockquote>";
	exit;
}

if ($ErrorMsn == "" )
{

	$sqlIns = " INSERT INTO Usuarios (Usuario, Clave, TipoUsuario, Email, Fecha) VALUES ("	
				. " '". Limpiar($Usuario,16) ."', " 	 	   	    	
				. " '". hashPassword($Clave)  ."', "				
				. " '". $TipoUsuario ."', "				
				. " '". Limpiar($Email,100) ."', "
				. " Now()) ";




	$result = mysqli_query($link,$sqlIns);


	$sql = "select idUsuario from Usuarios where Usuario = '$Usuario' ";
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
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$idUsuario = $row["idUsuario"];
}

mysqli_free_result($result);

if (($Ambito != "") and ($idAmbito != "") and ($idUsuario != "")){
	
	switch ($Ambito){
				case "Directorio":
							$Campo = "idDirectorio";
							break;
				case "Monumentos":
							$Campo = "idMonumento";
							break;
				case "Museos":
							$Campo = "idMuseo";
							break;
				case "Noticias":
							$Campo = "idNoticia";
							break;
				case "NucleosUrbanos":
							$Campo = "idNucleoUrbano";
							break;
			}
	$sqlIns = " INSERT INTO UsuariosAcceso (idUsuario, Ambito, Campo, idAmbito, Fecha) VALUES ("	
				. " ". $idUsuario .", " 	 	   	    	
				. " '". $Ambito  ."', "				
				. " '". $Campo  ."', "				
				. " ". $idAmbito .", "				
				. " Now()) ";



$result = mysqli_query($link,$sqlIns);
}

mysqli_close($link);		

}

?>