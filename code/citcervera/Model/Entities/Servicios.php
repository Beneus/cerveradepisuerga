<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Servicios extends EntityBase implements IEntityBase
{
	private $_tableName = 'Servicios';
	private $_id = 'idServicio';
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

	function _POST()
	{
		$this->idServicio = parent::TakePOST('IDSERVICIO');
		$this->NombreServicio = parent::TakePOST('NOMBRESERVICIO', 50);
	}

	function _GET()
	{
		$this->idServicio = parent::TakeGET('IDSERVICIO');
		$this->NombreServicio = parent::TakeGET('NOMBRESERVICIO', 50);
	}
}
