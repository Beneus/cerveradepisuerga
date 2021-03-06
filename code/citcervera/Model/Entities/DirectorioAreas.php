<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioAreas extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioAreas';
	private $_id = 'idDirectorioAreas';
	public $idDirectorioAreas;
	public $idDirectorio;
	public $idArea;
	public $Fecha;

	function DirectorioAreas(
		$_idDirectorioAreas,
		$_idDirectorio,
		$_idArea,
		$_Fecha
	) {
		$this->idDirectorioAreas = $_idDirectorioAreas;
		$this->idDirectorio = $_idDirectorio;
		$this->idArea = $_idArea;
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
		$this->idDirectorioAreas = parent::TakePOST('IDDIRECTORIOAREAS');
		$this->idDirectorio = parent::TakePOST('IDDIRECTORIO');
		$this->idArea = parent::TakePOST('IDAREA');
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDirectorioAreas = parent::TakeGET('IDDIRECTORIOAREAS');
		$this->idDirectorio = parent::TakeGET('IDDIRECTORIO');
		$this->idArea = parent::TakeGET('IDAREA');
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
