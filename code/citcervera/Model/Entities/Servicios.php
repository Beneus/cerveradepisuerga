<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Servicios extends EntityBase implements IEntityBase
{
	private $_tableName = 'Servicios';
	private $_id = 'IdServicio';
	public $idServicio;
	public $NombreServicio;

	function Servicios(
		$_idServicio,
		$_NombreServicio
	) {
		$this->idServicio = $_idServicio;
		$this->NombreServicio = $_NombreServicio;
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
