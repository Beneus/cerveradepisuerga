<?php
include("../../includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $data = json_decode(file_get_contents("php://input"));

    $entity = new $entityName();
    $Controller = new $controller($entity,'PUT', $data);
    $Controller->processRequest();
}