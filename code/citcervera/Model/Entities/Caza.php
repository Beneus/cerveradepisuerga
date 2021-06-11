<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Caza extends EntityBase implements IEntityBase
{
	private $_tableName = 'Caza';
	private $_id = 'idCaza';
	var $idCaza;
	var $ImgDescripcion;
	var $Descripcion;
	var $Fecha;

	function Caza(
		$_idCaza,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idCaza = $_idCaza;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}
}
