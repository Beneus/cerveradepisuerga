<?php
session_start();
include("includes/variables-user.php");
include("includes/funciones.php");
include("includes/Conn.php");


$SelA = $_POST["SELA"];
$SelB = $_POST["SELB"];

$link = ConnBDCervera();

$sql = "select Orden from Imagenes where idImagen = $SelA  ";
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
	$OrdenA = $row["Orden"]; 
}
mysqli_free_result($result);
$sql = "select Orden from Imagenes where idImagen = $SelB  ";
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
	$OrdenB = $row["Orden"]; 
}
mysqli_free_result($result);


if (!is_numeric($OrdenA)){$OrdenA = $SelA;}
if (!is_numeric($OrdenB)){$OrdenB = $SelB;}

$sqlUp = "Update Imagenes set Orden = $OrdenB where idImagen = $SelA ";
$result = mysqli_query($link,$sqlUp);
$sqlUp = "Update Imagenes set Orden = $OrdenA where idImagen = $SelB ";
$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		
?>