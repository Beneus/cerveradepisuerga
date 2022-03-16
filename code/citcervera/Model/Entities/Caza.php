<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Caza extends EntityBase implements IEntityBase
{
	private $_tableName = 'Caza';
	private $_id = 'idCaza';
	public $idCaza;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

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

	function GetId()
	{
		return $this->_id;
	}

	function _POST()
	{
		$this->idCaza 		= parent::TakePOST('IDCAZA');
		$this->ImgDescripcion 	= parent::TakePOST('IMGDESCRIPCION', 255);
		$this->Descripcion 	= htmlentities(parent::TakePOST('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idCaza 		= parent::TakeGET('IDCAZA');
		$this->ImgDescripcion 	= parent::TakeGET('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
