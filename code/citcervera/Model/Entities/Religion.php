<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Religion extends EntityBase implements IEntityBase
{
	var $idReligion;
	var $ImgDescripcion;
	var $Descripcion;
	var $Fecha;

	function Religion(
$_idReligion,$_ImgDescripcion,$_Descripcion,$_Fecha){
		$this->idReligion = $_idReligion;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
		$this->Fecha = $_Fecha;
	}
}