<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class SetasSubOrden extends EntityBase implements IEntityBase
{
	private $_tableName = 'SetasSubOrden';
	private $_id = 'idSetasSubOrden';
	var $idSetasSubOrden;
	var $Clase;
	var $SubOrden;

	function SetasSubOrden(
		$_idSetasSubOrden,
		$_Clase,
		$_SubOrden
	) {
		$this->idSetasSubOrden = $_idSetasSubOrden;
		$this->Clase = $_Clase;
		$this->SubOrden = $_SubOrden;
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
