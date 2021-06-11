<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");



$NombreSubServicio = "Rehabilitación";
$NombreServicio = "Energía";
$idSubServicio = 141;
$idServicio = 29;
if ($ErrorMsn == "" ){	
$link = ConnBDCervera();
$sqlUp = " Update SubServicios set "
				. " NombreSubServicio = '$NombreSubServicio' " 	 	   	    	
				. " where idSubServicio = $idSubServicio ";
				
				$sqlUp = " Update Servicios set "
				. " NombreServicio = '$NombreServicio' " 	 	   	    	
				. " where idServicio = $idServicio ";

echo $sqlUp;


$result = mysqli_query($link,$sqlUp);

mysqli_close($link);		


}
?>