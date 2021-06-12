<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioNucleoUrbano extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioNucleoUrbano';
	private $_id = 'idDirectorioNucleoUrbano';
	public $idDirectorioNucleoUrbano;
	public $idDirectorio;
	public $idNucleoUrbano;
	public $Fecha;

	function DirectorioNucleoUrbano(
		$_idDirectorioNucleoUrbano,
		$_idDirectorio,
		$_idNucleoUrbano,
		$_Fecha
	) {
		$this->idDirectorioNucleoUrbano = $_idDirectorioNucleoUrbano;
		$this->idDirectorio = $_idDirectorio;
		$this->idNucleoUrbano = $_idNucleoUrbano;
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
