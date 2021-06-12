<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioServicio extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioServicio';
	private $_id = 'idDirectorioServicio';
	public $idDirectorioServicio;
	public $idDirectorio;
	public $idservicio;
	public $Fecha;

	function DirectorioServicio(
		$_idDirectorioServicio,
		$_idDirectorio,
		$_idservicio,
		$_Fecha
	) {
		$this->idDirectorioServicio = $_idDirectorioServicio;
		$this->idDirectorio = $_idDirectorio;
		$this->idservicio = $_idservicio;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId()
	{
		return $this->_id;
	}
}
