<?php
include("../../includes/conn.php");

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use citcervera\Controller\Controller;
use citcervera\Model\Entities\Setas;

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $data = json_decode(file_get_contents("php://input"));

    $entity = new Setas();
    $Controller = new Controller($entity,'PUT', $data);
    $Controller->processRequest();
}