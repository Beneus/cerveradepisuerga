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

	function _POST()
	{
		$this->idDirectorioNucleoUrbano = parent::TakePOST('IDDIRECTORIONUCLEOURBANO');
		$this->idDirectorio = parent::TakePOST('IDDIRECTORIO');
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDirectorioNucleoUrbano = parent::TakeGET('IDDIRECTORIONUCLEOURBANO');
		$this->idDirectorio = parent::TakeGET('IDDIRECTORIO');
		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
