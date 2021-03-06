<?php
include("../../includes/conn.php");

use citcervera\Controller\Controller;
use citcervera\Model\Entities\Noticias;

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    $id = '';
	if (isset($_GET['id'])) {
        $id = $_GET['id'];
	}

    $entity = new Noticias();
    $Controller = new Controller($entity,'DELETE', $id);
    $Controller->processRequest();
}
?>
