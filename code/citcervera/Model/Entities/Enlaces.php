<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Enlaces extends EntityBase implements IEntityBase
{
	private $_tableName = 'Enlaces';
	private $_id = 'IdEnlace';
	public $idEnlace;
	public $TextoEnlace;
	public $Descripcion;
	public $UrlEnlace;
	public $Orden;
	public $Fecha;

	function Enlaces(
		$_idEnlace,
		$_TextoEnlace,
		$_Descripcion,
		$_UrlEnlace,
		$_Orden,
		$_Fecha
	) {
		$this->idEnlace = $_idEnlace;
		$this->TextoEnlace = $_TextoEnlace;
		$this->Descripcion = $_Descripcion;
		$this->UrlEnlace = $_UrlEnlace;
		$this->Orden = $_Orden;
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
		$this->idEnlace 		= parent::TakePOST('IDENLACE');
		$this->TextoEnlace 		= parent::TakePOST('TEXTOENLACE',255);
		$this->Descripcion 		= htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->UrlEnlace 		= parent::TakePOST('URLENLACE');
		$this->Orden 			= parent::TakePOST('ORDEN');
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idEnlace 		= parent::TakeGET('IDENLACE');
		$this->TextoEnlace 		= parent::TakeGET('TEXTOENLACE',255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->UrlEnlace 		= parent::TakeGET('URLENLACE');
		$this->Orden 			= parent::TakeGET('ORDEN');
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
