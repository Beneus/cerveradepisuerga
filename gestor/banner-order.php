<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$SelA = $_POST["SELA"];
$SelB = $_POST["SELB"];

$link = ConnBDCervera();

$sql = "select Orden from Banners where idBanner = $SelA  ";
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
$sql = "select Orden from Banners where idBanner = $SelB  ";
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

$sqlUp = "Update Banners set Orden = $OrdenB where idBanner = $SelA ";
$result = mysqli_query($link,$sqlUp);
$sqlUp = "Update Banners set Orden = $OrdenA where idBanner = $SelB ";
$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		
?>