<?php

include("conn.php");

$entityName =  getEntityfromPath();
$controller = getController();
header("Content-Type: application/json; charset=UTF-8");
