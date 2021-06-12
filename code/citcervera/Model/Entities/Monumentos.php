<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Monumentos extends EntityBase implements IEntityBase
{
	private $_tableName = 'Monumentos';
	private $_id = 'idMonumento';
	public $idMonumento;
	public $idNucleoUrbano;
	public $idArea;
	public $Monumento;
	public $Direccion;
	public $Latitud;
	public $Longitud;
	public $Telefono;
	public $Responsable;
	public $URL;
	public $Email;
	public $Descripcion;
	public $FechaInauguracion;
	public $FechaClausura;
	public $Tipo;
	public $Horario;
	public $ImgDescripcion;
	public $Fecha;

	function Monumentos(
		$_idMonumento,
		$_idNucleoUrbano,
		$_idArea,
		$_Monumento,
		$_Direccion,
		$_Latitud,
		$_Longitud,
		$_Telefono,
		$_Responsable,
		$_URL,
		$_Email,
		$_Descripcion,
		$_FechaInauguracion,
		$_FechaClausura,
		$_Tipo,
		$_Horario,
		$_ImgDescripcion,
		$_Fecha
	) {
		$this->idMonumento = $_idMonumento;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->idArea = $_idArea;
		$this->Monumento = $_Monumento;
		$this->Direccion = $_Direccion;
		$this->Latitud = $_Latitud;
		$this->Longitud = $_Longitud;
		$this->Telefono = $_Telefono;
		$this->Responsable = $_Responsable;
		$this->URL = $_URL;
		$this->Email = $_Email;
		$this->Descripcion = $_Descripcion;
		$this->FechaInauguracion = $_FechaInauguracion;
		$this->FechaClausura = $_FechaClausura;
		$this->Tipo = $_Tipo;
		$this->Horario = $_Horario;
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
}
