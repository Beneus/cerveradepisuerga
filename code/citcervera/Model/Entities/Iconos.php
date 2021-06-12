<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Iconos extends EntityBase implements IEntityBase
{
	private $_tableName = 'Iconos';
	private $_id = 'idIcono';
	public $idIcono;
	public $Codigo;
	public $Nombre;
	public $Tipo;
	public $Imagen;
	public $Orden;
	public $Fecha;

	function Imagenes(
		$_idIcono,
		$_Codigo,
		$_Nombre,
		$_Tipo,
		$_Imagen,
		$_Orden,
		$_Fecha
	) {
		$this->idIcono = $_idIcono;
		$this->Codigo = $_Codigo;
		$this->_Nombre = $_Nombre;
		$this->_Tipo = $_Tipo;
		$this->_Imagen = $_Imagen;
		$this->_Orden = $_Orden;
		$this->_Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId()
	{
		return $this->_id;
	}
}
