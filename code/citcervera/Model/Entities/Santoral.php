<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Santoral extends EntityBase implements IEntityBase
{
	private $_tableName = 'Santoral';
	private $_id = 'idSantoral';
	public $idSantoral;
	public $Mes;
	public $Dia;
	public $Santos;

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId()
	{
		return $this->_id;
	}

	function Santoral(
		$_idSantoral,
		$_Mes,
		$_Dia,
		$_Santos
	) {
		$this->idSantoral = $_idSantoral;
		$this->Mes = $_Mes;
		$this->Dia = $_Dia;
		$this->Santos = $_Santos;
	}
}
