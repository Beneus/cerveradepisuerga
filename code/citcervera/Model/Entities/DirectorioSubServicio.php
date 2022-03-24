<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioSubServicio extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioSubServicio';
	private $_id = 'idDirectorioSubServicio';
	public $idDirectorioSubServicio;
	public $idDirectorio;
	public $idSubServicio;
	public $Fecha;

	function DirectorioSubServicio(
		$_idDirectorioSubServicio,
		$_idDirectorio,
		$_idSubServicio,
		$_Fecha
	) {
		$this->idDirectorioSubServicio = $_idDirectorioSubServicio;
		$this->idDirectorio = $_idDirectorio;
		$this->idSubServicio = $_idSubServicio;
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
		$this->idDirectorioSubServicio = parent::TakePOST('IDDIRECTORIOSUBSERVICIO');
		$this->idDirectorio = parent::TakePOST('IDDIRECTORIO');
		$this->idSubServicio = parent::TakePOST('IDSUBSERVICIO');
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDirectorioSubServicio = parent::TakeGET('IDDIRECTORIOSUBSERVICIO');
		$this->idDirectorio = parent::TakeGET('IDDIRECTORIO');
		$this->idSubServicio = parent::TakeGET('IDSUBSERVICIO');
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
