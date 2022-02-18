<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Localizacion extends EntityBase implements IEntityBase
{
	private $_tableName = 'Localizacion';
	private $_id = 'idLocalizacion';
	public $idLocalizacion;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

	function Localizacion(
		$_idLocalizacion,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idLocalizacion = $_idLocalizacion;
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
		$this->idLocalizacion 	= parent::TakePOST('IDLOCALIZATION');
		$this->ImgDescripcion 	= parent::TakePOST('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakePOST('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idLocalizacion 	= parent::TakeGET('IDLOCALIZATION');
		$this->ImgDescripcion 	= parent::TakeGET('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
