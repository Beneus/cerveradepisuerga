<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioServicio extends EntityBase implements IEntityBase
{
	var $idDirectorioServicio;
	var $idDirectorio;
	var $idservicio;
	var $Fecha;

	function DirectorioServicio(
$_idDirectorioServicio,$_idDirectorio,$_idservicio,$_Fecha){
		$this->idDirectorioServicio = $_idDirectorioServicio;
		$this->idDirectorio = $_idDirectorio;
		$this->idservicio = $_idservicio;
		$this->Fecha = $_Fecha;
	}
}