<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Religion extends EntityBase implements IEntityBase
{
	private $_tableName = 'Religion';
	private $_id = 'IdReligion';
	public $idReligion;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

	function Religion(
		$_idReligion,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idReligion = $_idReligion;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
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
