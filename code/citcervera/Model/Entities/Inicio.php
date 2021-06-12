<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Inicio extends EntityBase implements IEntityBase
{
	private $_tableName = 'Inicio';
	private $_id = 'idInicio';
	public $idInicio;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

	function Inicio(
		$_idInicio,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idInicio = $_idInicio;
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
