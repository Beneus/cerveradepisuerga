<?php
include("../../includes/conn.php");

header("Content-Type: application/json; charset=UTF-8");

use citcervera\Controller\Controller;

$entityName =  getEntityfromPath();

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $data = json_decode(file_get_contents("php://input"));

    $entity = new $entityName();
    $Controller = new Controller($entity,'PUT', $data);
    $Controller->processRequest();
}