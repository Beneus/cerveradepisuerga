<?php
session_start();


include("includes/funciones.php");
include("includes/Conn.php");
$ErrorMsn = '';
$idDirectorio = $_POST["IDDIRECTORIO"] ?? '';
$NombreComercial = $_POST["NOMBRECOMERCIAL"] ?? '';
$Direccion = $_POST["DIRECCION"] ?? '';
$Latitud = $_POST["LATITUD"] ?? '';
$Longitud = $_POST["LONGITUD"] ?? '';
$idSubServicio = $_POST["IDSUBSERVICIO"] ?? ''; 
$idNucleoUrbano = $_POST["IDNUCLEOURBANO"] ?? '';
$Telefono = $_POST["TELEFONO"] ?? '';
$Movil = $_POST["MOVIL"] ?? '';
$Fax = $_POST["FAX"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$URL = $_POST["URL"] ?? '';
$NombreContacto = $_POST["NOMBRECONTACTO"] ?? '';

$Descripcion = htmlentities($_POST["DESCRIPCION"] ?? '',ENT_QUOTES);
$Apellido1Contacto = $_POST["APELLIDO1CONTACTO"] ?? '';
$Apellido2Contacto = $_POST["APELLIDO2CONTACTO"] ?? '';
$FechaCreacion = $_POST["FECHACREACION"] ?? '';
if ($FechaCreacion == "")$FechaCreacion = NULL;

// array de prestaciones de servicio
$Prestaciones = array();
foreach( $_POST['PRESTACIONES'] ?? [] as $So => $valor ) {
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
	

$sqlUp = " Update Directorio set "
				. " NombreComercial = '". Limpiar($NombreComercial,100) ."', " 	 	   	    	
				. " Direccion = '". Limpiar($Direccion,100)  ."', "	
				. " Latitud = '". Limpiar($Latitud,50)  ."', "
				. " Longitud = '". Limpiar($Longitud,50)  ."', "			
				. " idNucleoUrbano = $idNucleoUrbano , "	 			
				. " Provincia = 'PALENCIA', " 				
				. " CP = '$CodigoPostal', "	
				. " Telefono = '". Limpiar($Telefono,16) ."', "				
				. " Movil = '". Limpiar($Movil,16) ."', "
				. " Fax = '". Limpiar($Fax,16) ."', "			
				. " Email = '". Limpiar($Email,100) ."', " 				
				. " URL = '". Limpiar($URL,255) ."', " 				
				. " NombreContacto = '". Limpiar($NombreContacto,50) ."', " 			
				. " Apellido1Contacto = '". Limpiar($Apellido1Contacto,50) ."', " 	 			
				. " Apellido2contacto = '". Limpiar($Apellido2Contacto,50) ."', ";	
				if(is_null($FechaCreacion)){$sqlUp .= " FechaCreacion = NULL , " ;}else{$sqlUp .= " FechaCreacion = '" .FechaReves($FechaCreacion) ."', " ;}	 					
				$sqlUp .= " Descripcion = '". $Descripcion ."', "	
				. " Prestaciones = '". implode(",", $Prestaciones) ."' " 		
				. " where idDirectorio = $idDirectorio ";



$result = mysqli_query($link,$sqlUp);


// Introduzco el idArea del idDirectorio
$sqlUp = " Update DirectorioAreas set idArea = $idArea where idDirectorio = $idDirectorio ";
$result = mysqli_query($link,$sqlUp);

// Introduzco el idNucleoUrbano del idDirectorio
$sqlUp = " Update DirectorioNucleoUrbano set idNucleoUrbano = $idNucleoUrbano where idDirectorio = $idDirectorio";
$result = mysqli_query($link,$sqlUp);

// Servicios y SubServicios
// Primero elimino los servicios y subservicios existentes y despues introduzco los nuevos


$sqlDel = "delete from DirectorioServicio where idDirectorio = $idDirectorio";
$result = mysqli_query($link,$sqlDel);
$sqlDel = "delete from DirectorioSubServicio where idDirectorio = $idDirectorio";
$result = mysqli_query($link,$sqlDel);

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