<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Usuario extends EntityBase implements IEntityBase
{
	private $_tableName = 'Usuarios';
	private $_id = 'Idusuario';
	var $Idusuario;
	var $Usuario;
	var $Clave;
	var $TipoUsuario;
	var $Email;
	var $Fecha;

	public function __construct()
	{
		//parent::__construct();
	}

	public function Init(array $properties = array())
	{
		foreach ($properties as $key => $value) {
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

	function Usuarios(
		$_Idusuario,
		$_Usuario,
		$_Clave,
		$_TipoUsuario,
		$_Email,
		$_Fecha
	) {
		$this->Idusuario = $_Idusuario;
		$this->Usuario = $_Usuario;
		$this->Clave = $_Clave;
		$this->TipoUsuario = $_TipoUsuario;
		$this->Email = $_Email;
		$this->Fecha = $_Fecha;
	}

	function _POST()
	{
		$this->Idusuario 		= parent::TakePOST('IDUSUARIO');
		$this->Usuario 			= parent::TakePOST('USUARIO', 100);
		$this->Clave 			= parent::TakePOST('CLAVE', 16);
		$this->TipoUsuario 		= parent::TakePOST('TIPOUSUARIO');
		$this->Email 			= parent::TakePOST('EMAIL', 100);
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->Idusuario 		= parent::TakeGET('IDUSUARIO');
		$this->Usuario 			= parent::TakeGET('USUARIO', 100);
		$this->Clave 			= parent::TakeGET('CLAVE', 16);
		$this->TipoUsuario 		= parent::TakeGET('TIPOUSUARIO');
		$this->Email 			= parent::TakeGET('EMAIL', 100);
		$this->Fecha 			= parent::TakeGET('FECHA');
	}

	function _PUT()
	{
		$this->Idusuario 		= parent::TakePUT('IDUSUARIO');
		$this->Usuario 			= parent::TakePUT('USUARIO', 100);
		$this->Clave 			= parent::TakePUT('CLAVE', 16);
		$this->TipoUsuario 		= parent::TakePUT('TIPOUSUARIO');
		$this->Email 			= parent::TakePUT('EMAIL', 100);
		$this->Fecha 			= parent::TakePUT('FECHA');
	}
}
