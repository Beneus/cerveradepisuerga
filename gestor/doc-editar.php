<?php
session_start();

include("includes/Conn.php");
include("includes/variables-user.php");
include("includes/funciones.php");


use citcervera\Model\Entities\Documentos;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;


$idDoc = $_POST["IDDOC"] ?? '';
$Titulo = $_POST["TITULO"] ?? '';
$Pie = $_POST["PIE"] ?? '';
$Campo  = $_POST["CAMPO"] ?? '';


$dc = new DataCarrier();
$documento = new Documentos();
$documentManager = new Manager($documento);

$docToEdit = $documentManager->Get($idDoc);

if($Campo === 'TITULO'){
	$docToEdit->Titulo = $_POST["TITULO"];
}elseif($Campo === 'PIE'){
	$docToEdit->Pie = $_POST["PIE"];
}

$docToEdit->Publicar =  $Publicar;
$docToEdit->Fecha = date("Y-m-d H:m:s");
$docToEdit = $documentManager->Save($docToEdit);
