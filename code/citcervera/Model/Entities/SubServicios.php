<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class SubServicios extends EntityBase implements IEntityBase
{
	private $_tableName = 'SubServicios';
	private $_id = 'idSubServicio';
	var $idSubServicio;
	var $idServicio;
	var $icono;
	var $NombreSubServicio;

	function SubServicios(
		$_idSubServicio,
		$_idServicio,
		$_icono,
		$_NombreSubServicio
	) {
		$this->idSubServicio = $_idSubServicio;
		$this->idServicio = $_idServicio;
		$this->icono = $_icono;
		$this->NombreSubServicio = $_NombreSubServicio;
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
		$this->idSubServicio = parent::TakePOST('IDSUBSERVICIO');
		$this->idServicio = parent::TakePOST('IDSERVICIO');
		$this->icono = parent::TakePOST('ICONO', 50);
		$this->NombreSubServicio = parent::TakePOST('NOMBRESUBSERVICIO', 50);
	}

	function _GET()
	{
		$this->idSubServicio = parent::TakeGET('IDSUBSERVICIO');
		$this->idServicio = parent::TakeGET('IDSERVICIO');
		$this->icono = parent::TakeGET('ICONO', 50);
		$this->NombreSubServicio = parent::TakeGET('NOMBRESUBSERVICIO', 50);
	}
}
