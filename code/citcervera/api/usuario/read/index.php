<?php
include("../../includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = '';
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
	}
    $entity = new $entityName();
    $Controller = new $controller($entity,'GET', $id);
    $Controller->processRequest();
}
?>

