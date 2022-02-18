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

	function _POST()
	{
		$this->idMonumento = parent::TakePOST('IDMONUMENTO');
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->idArea = parent::TakePOST('IDAREA');
		$this->Monumento = parent::TakePOST('MONUMENTO');
		$this->Direccion = parent::TakePOST('DIRECCION');
		$this->Latitud = parent::TakePOST('LATITUD');
		$this->Longitud = parent::TakePOST('LONGITUD');
		$this->Telefono = parent::TakePOST('TELEFONO');
		$this->Responsable = parent::TakePOST('RESPONSABLE');
		$this->URL = parent::TakePOST('URL');
		$this->Email = parent::TakePOST('EMAIL');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->FechaInauguracion = parent::TakePOST('FECHAINAUGURACION');
		$this->FechaClausura = parent::TakePOST('FECHACLAUSURA');
		$this->Tipo = parent::TakePOST('TIPO');
		$this->Horario = parent::TakePOST('HORARIO');
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idMonumento = parent::TakeGET('IDMONUMENTO');
		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->idArea = parent::TakeGET('IDAREA');
		$this->Monumento = parent::TakeGET('MONUMENTO');
		$this->Direccion = parent::TakeGET('DIRECCION');
		$this->Latitud = parent::TakeGET('LATITUD');
		$this->Longitud = parent::TakeGET('LONGITUD');
		$this->Telefono = parent::TakeGET('TELEFONO');
		$this->Responsable = parent::TakeGET('RESPONSABLE');
		$this->URL = parent::TakeGET('URL');
		$this->Email = parent::TakeGET('EMAIL');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->FechaInauguracion = parent::TakeGET('FECHAINAUGURACION');
		$this->FechaClausura = parent::TakeGET('FECHACLAUSURA');
		$this->Tipo = parent::TakeGET('TIPO');
		$this->Horario = parent::TakeGET('HORARIO');
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
