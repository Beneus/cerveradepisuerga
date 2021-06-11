<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idUsuario = $_POST["IDUSUARIO"] ?? '';
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
if (($Clave != "") and (strlen($Clave) < 6)){
	$ErrorMsn = "La <span class=\"errortexto\">Clave.</span> debe de tener al menos 6 caracteres<br/>";
}elseif(($Clave2 != $Clave)){
	$ErrorMsn .= "Las <span class=\"errortexto\">Claves</span> introducidas no son iguales.<br/>";
}
if (($Email != "") and (!isEmail($Email))){
	$ErrorMsn .= "<span class=\"errortexto\">Email.</span><br/>";
}

// comprobamos si el usuario ya existe
$sql = "select Usuario From Usuarios where Usuario = '$Usuario' and idUsuario <> $idUsuario ";
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
if($max > 0){  
	// el usuario ya existe, se debe de elegir otro.
	$ErrorMsn .= "El usuario <span class=\"errortexto\">$Usuario</span> ya existe, debe de elegir otro.<br/>";
}
mysqli_free_result($result);

if($ErrorMsn != ""){
	header("Content-Type: text/html;iso-8859-1");
	echo "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
	echo "<blockquote>";
	echo $ErrorMsn;
	echo "</blockquote>";
	exit;
}

if ($ErrorMsn == "" ){

$sqlUp  = " Update Usuarios set "
				. " Usuario = '". Limpiar($Usuario,16) ."', ";
					if($Clave != "")$sqlUp .= " Clave = '". hashPassword($Clave)  ."', ";
				$sqlUp .= " TipoUsuario = '". $TipoUsuario ."', "
				. " Email = '". Limpiar($Email,100) ."', "
				. " Fecha = Now() "
				." where idUsuario = $idUsuario ";



$result = mysqli_query($link,$sqlUp);


if (($Ambito != "") and ($idAmbito != "") and ($idUsuario != "")){
	
	switch ($Ambito){
				case "Directorio":
							$Campo = "idDirectorio";
							$idMenu = 8;
							$idSubMenu = null;
							break;
				case "Monumentos":
							$Campo = "idMonumento";
							$idMenu = 3;
							$idSubMenu = 7;
							break;
				case "Museos":
							$Campo = "idMuseo";
							$idMenu = 3;
							$idSubMenu = 6;
							break;
				case "Noticias":
							$Campo = "idNoticia";
							$idMenu = 7;
							$idSubMenu = null;
							break;
				case "NucleosUrbanos":
							$Campo = "idNucleoUrbano";
							$idMenu = 6;
							$idSubMenu = null;
							break;
				case "Rutas":
							$Campo = "idRuta";
							$idMenu = 3;
							$idSubMenu = 8;
							break;
				
			}
			
			
			
	$sqlIns = " INSERT INTO UsuariosAcceso (idUsuario, idMenu, idSubMenu, Ambito, Campo, idAmbito, Fecha) VALUES ("	
				. " ". $idUsuario .", " 
				. " ". $idMenu .", " 
				. " ". $idSubMenu .", " 	 	   	    	
				. " '". $Ambito  ."', "				
				. " '". $Campo  ."', "				
				. " ". $idAmbito .", "				
				. " Now()) ";



$result = mysqli_query($link,$sqlIns);
}

mysqli_close($link);		

}

?>