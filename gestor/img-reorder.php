<?php
session_start();
include("includes/variables-user.php");
include("includes/funciones.php");
include("includes/Conn.php");

use citcervera\Model\Entities\Imagenes;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$imagen = new Imagenes();
$fileManager = new Manager($imagen);

foreach ($_POST['short'] as $item){
    //$img = new Imagenes();
    $img = $fileManager->Get($item['id'] );
    $img->Orden = $item['order'];
    $fileManager->Save($img );
}