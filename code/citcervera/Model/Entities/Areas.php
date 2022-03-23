<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Areas extends EntityBase implements IEntityBase
{
	private $_tableName = 'Areas';
	private $_id = 'idArea';
	public $idArea;
	public $NombreArea;

	function Areas(
		$_idArea,
		$_NombreArea
	) {
		$this->idArea = $_idArea;
		$this->NombreArea = $_NombreArea;
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
		$this->idArea 		= parent::TakePOST('IDAREA');
		$this->NombreArea 	= parent::TakePOST('NOMBREAREA', 50);	
	}

	function _GET()
	{
		$this->idArea 		= parent::TakeGET('IDAREA');
		$this->NombreArea 	= parent::TakeGET('NOMBREAREA', 50);
	}
}
