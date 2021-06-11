<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Servicios extends EntityBase implements IEntityBase
{
	var $idServicio;
	var $NombreServicio;

	function Servicios(
$_idServicio,$_NombreServicio){
		$this->idServicio = $_idServicio;
		$this->NombreServicio = $_NombreServicio;
	}
}