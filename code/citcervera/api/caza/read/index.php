<?php
include("../../includes/conn.php");

use citcervera\Controller\Controller;
use citcervera\Model\Entities\Caza;

header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = '';
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
	}
    $entity = new Caza();
    $Controller = new Controller($entity,'GET', $id);
    $Controller->processRequest();
}
?>

