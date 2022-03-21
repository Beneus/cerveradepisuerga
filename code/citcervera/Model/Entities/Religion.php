<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Religion extends EntityBase implements IEntityBase
{
	private $_tableName = 'Religion';
	private $_id = 'idReligion';
	public $idReligion;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

	function Religion(
		$_idReligion,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idReligion = $_idReligion;
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
		$this->idReligion 	= parent::TakePOST('IDRELIGION');
		$this->ImgDescripcion 	= parent::TakePOST('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakePOST('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idReligion 	= parent::TakeGET('IDRELIGION');
		$this->ImgDescripcion 	= parent::TakeGET('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakeGET('FECHA');
	}



}
