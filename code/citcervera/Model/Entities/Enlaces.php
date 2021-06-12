<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Enlaces extends EntityBase implements IEntityBase
{
	private $_tableName = 'Enlaces';
	private $_id = 'IdEnlace';
	public $idEnlace;
	public $TextoEnlace;
	public $Descripcion;
	public $UrlEnlace;
	public $Orden;
	public $Fecha;

	function Enlaces(
		$_idEnlace,
		$_TextoEnlace,
		$_Descripcion,
		$_UrlEnlace,
		$_Orden,
		$_Fecha
	) {
		$this->idEnlace = $_idEnlace;
		$this->TextoEnlace = $_TextoEnlace;
		$this->Descripcion = $_Descripcion;
		$this->UrlEnlace = $_UrlEnlace;
		$this->Orden = $_Orden;
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
