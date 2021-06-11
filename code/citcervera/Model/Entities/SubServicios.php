<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class SubServicios extends EntityBase implements IEntityBase
{
	var $idSubServicio;
	var $idServicio;
	var $icono;
	var $NombreSubServicio;

	function SubServicios(
$_idSubServicio,$_idServicio,$_icono,$_NombreSubServicio){
		$this->idSubServicio = $_idSubServicio;
		$this->idServicio = $_idServicio;
		$this->icono = $_icono;
		$this->NombreSubServicio = $_NombreSubServicio;
	}
}