<?php
include("../../includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $entity = new $entityName();

    $validate = validate($entity, $data);
    if ($validate['status'] === 'OK') {
        $data->Fecha = date("Y-m-d H:i:s");
        $Controller = new $controller($entity, 'POST', $data);
        $Controller->processRequest();
    } else {
        echo json_encode($validate);
    }
}
