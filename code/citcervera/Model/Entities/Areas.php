<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Areas extends EntityBase implements IEntityBase
{
	private $_tableName = 'Areas';
	private $_id = 'idAreas';
	var $idArea;
	var $NombreArea;

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

	function GetId(){
		return $this->_id;
	}
}
