<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Museos extends EntityBase implements IEntityBase
{
	private $_tableName = 'Museos';
	private $_id = 'idMuseo';
	public $idMuseo;
	public $idArea;
	public $idNucleoUrbano;
	public $Provincia;
	public $CP;
	public $Museo;
	public $Direccion;
	public $Latitud;
	public $Longitud;
	public $Telefono;
	public $Responsable;
	public $URL;
	public $Email;
	public $Tema;
	public $FechaInauguracion;
	public $FechaClausura;
	public $Tipo;
	public $Horario;
	public $Descripcion;
	public $ImgDescripcion;
	public $Fecha;

	function Museos(
		$_idMuseo,
		$_idArea,
		$_idNucleoUrbano,
		$_Provincia,
		$_CP,
		$_Museo,
		$_Direccion,
		$_Latitud,
		$_Longitud,
		$_Telefono,
		$_Responsable,
		$_URL,
		$_Email,
		$_Tema,
		$_FechaInauguracion,
		$_FechaClausura,
		$_Tipo,
		$_Horario,
		$_Descripcion,
		$_ImgDescripcion,
		$_Fecha
	) {
		$this->idMuseo = $_idMuseo;
		$this->idArea = $_idArea;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Provincia = $_Provincia;
		$this->CP = $_CP;
		$this->Museo = $_Museo;
		$this->Direccion = $_Direccion;
		$this->Latitud = $_Latitud;
		$this->Longitud = $_Longitud;
		$this->Telefono = $_Telefono;
		$this->Responsable = $_Responsable;
		$this->URL = $_URL;
		$this->Email = $_Email;
		$this->Tema = $_Tema;
		$this->FechaInauguracion = $_FechaInauguracion;
		$this->FechaClausura = $_FechaClausura;
		$this->Tipo = $_Tipo;
		$this->Horario = $_Horario;
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
}
