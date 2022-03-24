<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioServicio extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioServicio';
	private $_id = 'idDirectorioServicio';
	public $idDirectorioServicio;
	public $idDirectorio;
	public $idservicio;
	public $Fecha;

	function DirectorioServicio(
		$_idDirectorioServicio,
		$_idDirectorio,
		$_idservicio,
		$_Fecha
	) {
		$this->idDirectorioServicio = $_idDirectorioServicio;
		$this->idDirectorio = $_idDirectorio;
		$this->idservicio = $_idservicio;
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
		$this->idDirectorioServicio = parent::TakePOST('IDDIRECTORIOSERVICIO');
		$this->idDirectorio = parent::TakePOST('IDDIRECTORIO');
		$this->idservicio = parent::TakePOST('IDSERVICIO');
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDirectorioNucleoUrbano = parent::TakeGET('IDDIRECTORIOSERVICIO');
		$this->idDirectorio = parent::TakeGET('IDDIRECTORIO');
		$this->idservicio = parent::TakeGET('IDSERVICIO');
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
