<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioAreas extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioAreas';
	var $idDirectorioAreas;
	var $idDirectorio;
	var $idArea;
	var $Fecha;

	function DirectorioAreas(
		$_idDirectorioAreas,
		$_idDirectorio,
		$_idArea,
		$_Fecha
	) {
		$this->idDirectorioAreas = $_idDirectorioAreas;
		$this->idDirectorio = $_idDirectorio;
		$this->idArea = $_idArea;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}
}
