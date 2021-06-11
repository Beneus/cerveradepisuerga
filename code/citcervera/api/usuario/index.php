<?php
namespace citcervera;
error_reporting(E_ALL);
ini_set("display_errors","On");

include("includes/funciones.php");
include("includes/Conn.php");

use citcervera\Controller\UsuarioController;

$dc = new UsuarioController('GET','');
echo $dc->processRequest();