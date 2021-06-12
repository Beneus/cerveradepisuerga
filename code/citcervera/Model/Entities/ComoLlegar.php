<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class ComoLlegar extends EntityBase implements IEntityBase
{
	private $_tableName = 'ComoLlegar';
	private $_id = 'idComoLlegar';
	public $idComoLlegar;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

	function ComoLlegar(
		$_idComoLlegar,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idComoLlegar = $_idComoLlegar;
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
