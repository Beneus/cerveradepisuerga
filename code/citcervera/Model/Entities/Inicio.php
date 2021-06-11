<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Inicio extends EntityBase implements IEntityBase
{
	var $idInicio;
	var $ImgDescripcion;
	var $Descripcion;
	var $Fecha;

	function Inicio(
$_idInicio,$_ImgDescripcion,$_Descripcion,$_Fecha){
		$this->idInicio = $_idInicio;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
		$this->Fecha = $_Fecha;
	}
}