<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$ErrorMsn = '';
$NombreComercial = $_POST["NOMBRECOMERCIAL"] ?? '';
$Direccion = $_POST["DIRECCION"] ?? '';
$Latitud = $_POST["LATITUD"] ?? '';
$Longitud = $_POST["LONGITU"] ?? '';
$idSubServicio = $_POST["IDSUBSERVICIO"] ?? ''; 
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
$Telefono = $_POST["TELEFONO"] ?? '';
$Movil = $_POST["MOVIL"] ?? '';
$Fax = $_POST["FAX"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$URL = $_POST["URL"] ?? '';
$NombreContacto = $_POST["NOMBRECONTACTO"] ?? '';
$Prestaciones = $_POST["PRESTACIONES"] ?? '';
$Descripcion = htmlentities($_POST["DESCRIPCION"],ENT_QUOTES);
$Apellido1Contacto = $_POST["APELLIDO1CONTACTO"] ?? '';
$Apellido2Contacto = $_POST["APELLIDO2CONTACTO"] ?? '';
$FechaCreacion = $_POST["FECHACREACION"] ?? '';
if ($FechaCreacion == "")$FechaCreacion = NULL;

// array de prestaciones de servicio
$Prestaciones = array();
foreach( $_POST['PRESTACIONES'] as $So => $valor ) {
	if($valor != "") {
		$Prestaciones[] = $valor;
	}
}

if ($NombreComercial == ""){
	$ErrorMsn = "<span class=\"errortexto\">Nombre comercial.</a><br/>";
}
if ($Direccion == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Direcci&oacute;n.</a><br/>";
}
if ($idSubServicio == ""){
	$ErrorMsn .= "<span class=\"errortexto\">Tipo de servicio.</a><br/>";
}

if(isset($FechaCreacion)){
	if (($FechaCreacion != "") && ((!isValidaFechaCorta($FechaCreacion)) or ( strlen($FechaCreacion) != 10))){
			$ErrorMsn .= "<span class=\"errortexto\">Fecha de Creaci&oacute;n.</a><br/>";
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
	
// Código Postal e idArea
$sql = " Select idArea, CodigoPostal from NucleosUrbanos where idNucleoUrbano = $idNucleoUrbano ";
$link = ConnBDCervera();
$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$idArea = $row["idArea"];
	$CodigoPostal = $row["CodigoPostal"];
	mysqli_free_result($result);
	
	
	
$sqlIns = " INSERT INTO Directorio (NombreComercial, Direccion, Latitud, Longitud, idNucleoUrbano, Provincia, CP, Telefono, Movil, Fax, Email, URL, NombreContacto, Apellido1Contacto ,Apellido2contacto ,FechaCreacion , ImgDescripcion, Descripcion, Prestaciones, Fecha) VALUES ("
				. " '". Limpiar($NombreComercial,100) ."', " 	 	   	    	
				. " '". Limpiar($Direccion,50)  ."', "
				. " '". Limpiar($Latitud,50)  ."', "
				. " '". Limpiar($Longitud,50)  ."', "				
				. $idNucleoUrbano  .", "	 			
				. " 'PALENCIA', " 				
				. " '". $CodigoPostal ."', "	
				. " '". Limpiar($Telefono,16) ."', "				
				. " '". Limpiar($Movil,16) ."', "
				. " '". Limpiar($Fax,16) ."', "			
				. " '". Limpiar($Email,100) ."', " 				
				. " '". Limpiar($URL,255) ."', " 				
				. " '". Limpiar($NombreContacto,50) ."', " 			
				. " '". Limpiar($Apellido1Contacto,50) ."', " 	 			
				. " '". Limpiar($Apellido2Contacto,50) ."', ";
				if(is_null($FechaCreacion)){$sqlIns .= " NULL, " ;}else{$sqlIns .= " '" .FechaReves($FechaCreacion) ."', " ;}		 			
$sqlIns .= " 0, " 			
				. " '". implode(",", $Prestaciones) ."', "	
				. " '". $Descripcion ."', "		 
				. " Now()) ";
				



$result = mysqli_query($link,$sqlIns);

// obtengo el idDirectorio del ultimo registro introducido

$sql = " Select idDirectorio from Directorio order by idDirectorio desc limit 1";
$result = mysqli_query($link,$sql);
	if (!$result)
		{
		$message = "Invalid query".mysqli_error($link)."\n";
		$message .= "whole query: " .$sql;	
		die($message);
		exit;
		}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$idDirectorio = $row["idDirectorio"];
	mysqli_free_result($result);



// Introduzco el idArea del idDirectorio
$sqlIns = " INSERT INTO DirectorioAreas (idDirectorio, idArea,	Fecha) VALUES("
				. $idDirectorio .", " 
				. $idArea .", " 		 				 
				. " Now()) ";
$result = mysqli_query($link,$sqlIns);
// Introduzco el idNucleoUrbano del idDirectorio
$sqlIns = " INSERT INTO DirectorioNucleoUrbano (idDirectorio,	idNucleoUrbano, Fecha) VALUES("
				. $idDirectorio .", " 
				. $idNucleoUrbano .", " 		 				 
				. " Now()) ";
$result = mysqli_query($link,$sqlIns);



$sql = " Select distinct idServicio from SubServicios where idSubServicio in (".str_replace("-",",",$idSubServicio).")";
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
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	
		$sqlIns = " INSERT INTO DirectorioServicio (idDirectorio,	idServicio, Fecha) VALUES("
				. $idDirectorio .", " 
				. $row["idServicio"] .", " 		 				 
				. " Now()) ";
		$result2 = mysqli_query($link,$sqlIns);
	
	}
}
mysqli_free_result($result);

$SubServicios = explode("-", $idSubServicio);
for($i=0; $i < sizeof($SubServicios); $i++){
	
	$sqlIns = " INSERT INTO DirectorioSubServicio (idDirectorio,	idSubServicio, Fecha) VALUES("
				. $idDirectorio .", " 
				. $SubServicios[$i] .", " 		 				 
				. " Now()) ";
	$result = mysqli_query($link,$sqlIns);	

}

mysqli_close($link);		


}
?>