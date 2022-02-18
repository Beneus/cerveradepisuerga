<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Inicio extends EntityBase implements IEntityBase
{
	private $_tableName = 'Inicio';
	private $_id = 'idInicio';
	public $idInicio;
	public $ImgDescripcion;
	public $Descripcion;
	public $Fecha;

	function Inicio(
		$_idInicio,
		$_ImgDescripcion,
		$_Descripcion,
		$_Fecha
	) {
		$this->idInicio = $_idInicio;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
		$this->Fecha = $_Fecha;
	}

	public function __construct()
	{
		//parent::__construct();
	}
	
	public function Init(Array $properties=array())
	{
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
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
		$this->idInicio 		= parent::TakePOST('IDINICIO');
		$this->ImgDescripcion 	= parent::TakePOST('IMGDESCRIPCION',255);
		$this->Descripcion 	= htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idInicio 		= parent::TakeGET('IDINICIO');
		$this->ImgDescripcion 	= parent::TakeGET('IMGDESCRIPCION',255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
