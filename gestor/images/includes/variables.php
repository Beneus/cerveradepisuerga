<?php

$origen = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$query = $_SERVER["QUERY_STRING"]; 
if ((! $_SESSION["Conexion"]) or (($_SESSION["TipoUsuario"]!= "ADMIN") AND ($_SESSION["TipoUsuario"]!= "USERCIT"))){
		header("Location:login.php?$origen?$query");
		exit;
}

?>