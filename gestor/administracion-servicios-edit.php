<?php
session_start();
setlocale(LC_ALL, 'es_ES.ISO8859-1');
include("includes/variables.php");
include("includes/funciones.php");
include("includes/Conn.php");

$tipo = $_GET["tipo"];
$idServicio = $_GET["idServicio"];
$idSubServicio = $_GET["idSubServicio"];
$NombreServicio = $_GET["NombreServicio"];
$NombreSubServicio = $_GET["NombreSubServicio"];


$link = ConnBDCervera();

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if ($tipo == "Servicio"){
$sqlUp = " Update Servicios set "	   	    				
				. " NombreServicio = '". Limpiar($NombreServicio,50)  ."' "				 
				. " where idServicio = $idServicio ";
$result = mysqli_query($link,$sqlUp);
echo $sqlUp;
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if ($tipo == "SubServicio"){
$sqlUp = " Update SubServicios set "	   	    				
				. " NombreSubServicio = '". Limpiar($NombreSubServicio,50)  ."' "				 
				. " where idServicio = $idServicio and idSubServicio = $idSubServicio ";
$result = mysqli_query($link,$sqlUp);
echo $sqlUp;
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if ($tipo == "NuevoServicio"){
	
	$sql = "select * from Servicios where NombreServicio = '". Limpiar($NombreServicio,50) . "'";
	$result = mysqli_query($link,$sql);
	if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
	$max = mysqli_num_rows($result);	
	if($max == 0){
		$sqlIn = " insert into Servicios (NombreServicio) values "	   	    				
				. " ('". Limpiar($NombreServicio,50)  ."') ";
		$resultIn = mysqli_query($link,$sqlIn);

	}else{
		
		echo "El servicio ya existe";
	}
	mysqli_free_result($result);
	
	
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if ($tipo == "NuevoSubServicio"){
	
	$sql = "select * from SubServicios where NombreSubServicio = '". Limpiar($NombreSubServicio,50) . "'";
	$result = mysqli_query($link,$sql);
	if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
	$max = mysqli_num_rows($result);	
	if($max == 0){
		$sqlIn = " insert into SubServicios (idServicio, NombreSubServicio) values "	   	    				
				. " ($idServicio, '". Limpiar($NombreSubServicio,50)  ."') ";
		$resultIn = mysqli_query($link,$sqlIn);

	}else{
		
		echo "El servicio ya existe";
	}
	mysqli_free_result($result);
	
	
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if ($tipo == "EliminarServicio"){

$sqlDel = " delete from SubServicios where idServicio = $idServicio  ";
$result = mysqli_query($link,$sqlDel);
$sqlDel = " delete from Servicios where idServicio = $idServicio  ";
$result = mysqli_query($link,$sqlDel);
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if ($tipo == "EliminarSubServicio"){

$sqlDel = " delete from SubServicios where idSubServicio = $idSubServicio  ";
$result = mysqli_query($link,$sqlDel);
$sqlDel = " delete from directoriosubservicio where idSubServicio = $idSubServicio  "; 
$result = mysqli_query($link,$sqlDel);
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

mysqli_close($link);		
?>