<?php
include("../includes/conn.php");

use citcervera\Controller\UsuarioController;

$usuarioController = new UsuarioController('GET', 1);
$usuarioController->processRequest();

?>