<?php

$origen = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$query = $_SERVER["QUERY_STRING"]; 


if ((! $_SESSION["Conexion"])){
		header("Location:login.php?$origen?$query");
		exit;
}

?>