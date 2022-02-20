<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Escudos extends EntityBase implements IEntityBase
{
	private $_tableName = 'Escudos';
	private $_id = 'idEscudo';
	public $idEscudo;
	public $Nombre;
	public $Direccion;
	public $idNucleoUrbano;
	public $Descripcion;
	public $ImgDescripcion;
	public $Fecha;

	function Escudos(
		$_idEscudo,
		$_Nombre,
		$_Direccion,
		$_idNucleoUrbano,
		$_Descripcion,
		$_ImgDescripcion,
		$_Fecha
	) {
		$this->idEscudo = $_idEscudo;
		$this->Nombre = $_Nombre;
		$this->Direccion = $_Direccion;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Descripcion = $_Descripcion;
		$this->ImgDescripcion = $_ImgDescripcion;
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
		$this->idEscudo = parent::TakePOST('IDESCUDO');
		$this->Nombre = parent::TakePOST('NOMBRE');
		$this->Direccion = parent::TakePOST('DIRECCION');
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idEscudo = parent::TakeGET('IDESCUDO');
		$this->Nombre = parent::TakeGET('NOMBRE');
		$this->Direccion = parent::TakeGET('DIRECCION');
		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
