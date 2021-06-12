<?php
include("../../includes/conn.php");

use citcervera\Controller\Controller;

$entityName =  getEntityfromPath();

header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = '';
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
	}
    $entity = new $entityName();
    $Controller = new Controller($entity,'GET', $id);
    $Controller->processRequest();
}
?>

