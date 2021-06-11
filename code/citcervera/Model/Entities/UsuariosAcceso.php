<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class UsuariosAcceso extends EntityBase implements IEntityBase
{
	private $_tableName = 'UsuariosAcceso';
	private $_id = 'idUsuariosAcceso';
	public $idUsuariosAcceso;
	public $idusuario;
	public $idMenu;
	public $idSubMenu;
	public $Ambito;
	public $Campo;
	public $idAmbito;
	public $Fecha;

	function UsuariosAcceso(
		$_idUsuariosAcceso,
		$_idusuario,
		$_idMenu,
		$_idSubMenu,
		$_Ambito,
		$_Campo,
		$_idAmbito,
		$_Fecha
	) {
		$this->idUsuariosAcceso = $_idUsuariosAcceso;
		$this->idusuario = $_idusuario;
		$this->idMenu = $_idMenu;
		$this->idSubMenu = $_idSubMenu;
		$this->Ambito = $_Ambito;
		$this->Campo = $_Campo;
		$this->idAmbito = $_idAmbito;
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
		$this->idUsuariosAcceso = parent::TakePOST('IDUSUARIOSaCCESO');
		$this->idusuario 		= parent::TakePOST('IDUSUARIO');
		$this->idMenu 			= parent::TakePOST('IDMENU');
		$this->idSubMenu 		= parent::TakePOST('IDSUBMENU');
		$this->Ambito 			= parent::TakePOST('AMBITO');
		$this->Campo 			= parent::TakePOST('CAMPO');
		$this->idAmbito 		= parent::TakePOST('IDAMBITO');
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idUsuariosAcceso = parent::TakeGET('IDUSUARIOSaCCESO');
		$this->idusuario 		= parent::TakeGET('IDUSUARIO');
		$this->idMenu 			= parent::TakeGET('IDMENU');
		$this->idSubMenu 		= parent::TakeGET('IDSUBMENU');
		$this->Ambito 			= parent::TakeGET('AMBITO');
		$this->Campo 			= parent::TakeGET('CAMPO');
		$this->idAmbito 		= parent::TakeGET('IDAMBITO');
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
