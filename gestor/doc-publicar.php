<?php
include("includes/Conn.php");
include("includes/variables-user.php");
include("includes/funciones.php");


use citcervera\Model\Entities\Documentos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

const __FILESPATH__ = 'files/';
$_ROOTPATH = $_SERVER['DOCUMENT_ROOT'] . '/' .  __FILESPATH__;

$dc = new DataCarrier();
$documento = new Documentos();
$documentManager = new Manager($documento);

$idDoc = $_POST["IDDOC"] ?? '';
$Publicar = $_POST["PUBLICAR"] ?? '';

$docToEdit = $documentManager->Get($idDoc);

$docToEdit->Publicar =  $Publicar;
$docToEdit->Fecha = date("Y-m-d H:m:s");
$docToEdit = $documentManager->Save($docToEdit);