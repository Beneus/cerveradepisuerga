<?php
namespace citcervera\Model\Entities;

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
		$this->idComoLlegar 	= parent::TakePOST('IDCOMOLLEGAR');
		$this->ImgDescripcion 	= parent::TakePOST('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakePOST('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idComoLlegar 	= parent::TakeGET('IDCOMOLLEGAR');
		$this->ImgDescripcion 	= parent::TakeGET('IMGDESCRIPCION', 255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'), ENT_QUOTES);
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
