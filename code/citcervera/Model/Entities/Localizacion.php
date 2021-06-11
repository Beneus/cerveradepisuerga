<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Localizacion extends EntityBase implements IEntityBase
{
	var $idLocalizacion;
	var $ImgDescripcion;
	var $Descripcion;
	var $Fecha;

	function Localizacion(
$_idLocalizacion,$_ImgDescripcion,$_Descripcion,$_Fecha){
		$this->idLocalizacion = $_idLocalizacion;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
		$this->Fecha = $_Fecha;
	}
}