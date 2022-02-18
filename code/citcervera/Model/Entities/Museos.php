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

	function _POST()
	{
		$this->idMuseo = parent::TakePOST('IDMUSEO');
		$this->idArea = parent::TakePOST('IDAREA');
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->Provincia = parent::TakePOST('PROVINCIA');
		$this->CP = parent::TakePOST('CP');;
		$this->Museo = parent::TakePOST('MUSEO');
		$this->Direccion = parent::TakePOST('DIRECCION');
		$this->Latitud = parent::TakePOST('LATITUD');
		$this->Longitud = parent::TakePOST('LONGITUD');
		$this->Telefono = parent::TakePOST('TELEFONO');
		$this->Responsable = parent::TakePOST('RESPONSABLE');
		$this->URL = parent::TakePOST('URL');
		$this->Email = parent::TakePOST('EMAIL');
		$this->Tema = parent::TakePOST('TEMA');
		$this->FechaInauguracion = parent::TakePOST('FECHAINAUGURACION');
		$this->FechaClausura = parent::TakePOST('FECHACLAUSURA');
		$this->Tipo = parent::TakePOST('TIPO');;
		$this->Horario = parent::TakePOST('HORARIO');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->Fecha = parent::TakePOST('FECHA');

	}

	function _GET()
	{
		$this->idMuseo = parent::TakeGET('IDMUSEO');
		$this->idArea = parent::TakeGET('IDAREA');
		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->Provincia = parent::TakeGET('PROVINCIA');
		$this->CP = parent::TakeGET('CP');;
		$this->Museo = parent::TakeGET('MUSEO');
		$this->Direccion = parent::TakeGET('DIRECCION');
		$this->Latitud = parent::TakeGET('LATITUD');
		$this->Longitud = parent::TakeGET('LONGITUD');
		$this->Telefono = parent::TakeGET('TELEFONO');
		$this->Responsable = parent::TakeGET('RESPONSABLE');
		$this->URL = parent::TakeGET('URL');
		$this->Email = parent::TakeGET('EMAIL');
		$this->Tema = parent::TakeGET('TEMA');
		$this->FechaInauguracion = parent::TakeGET('FECHAINAUGURACION');
		$this->FechaClausura = parent::TakeGET('FECHACLAUSURA');
		$this->Tipo = parent::TakeGET('TIPO');;
		$this->Horario = parent::TakeGET('HORARIO');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
