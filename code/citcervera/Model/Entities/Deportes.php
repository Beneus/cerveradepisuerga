<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Deportes extends EntityBase implements IEntityBase
{
	private $_tableName = 'Deportes';
	private $_id = 'idDeporte';
	public $idDeporte;
	public $idNucleoUrbano;
	public $ActoDeportivo;
	public $FechaInicio;
	public $FechaFinal;
	public $Hora;
	public $Lugar;
	public $Contacto;
	public $Telefono;
	public $Email;
	public $URL;
	public $Descripcion;
	public $Precio;
	public $ImgDescripcion;
	public $DocDeporte;
	public $Fecha;

	function Deportes(
		$_idDeporte,
		$_idNucleoUrbano,
		$_ActoDeportivo,
		$_FechaInicio,
		$_FechaFinal,
		$_Hora,
		$_Lugar,
		$_Contacto,
		$_Telefono,
		$_Email,
		$_URL,
		$_Descripcion,
		$_Precio,
		$_ImgDescripcion,
		$_DocDeporte,
		$_Fecha
	) {
		$this->idDeporte = $_idDeporte;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->ActoDeportivo = $_ActoDeportivo;
		$this->FechaInicio = $_FechaInicio;
		$this->FechaFinal = $_FechaFinal;
		$this->Hora = $_Hora;
		$this->Lugar = $_Lugar;
		$this->Contacto = $_Contacto;
		$this->Telefono = $_Telefono;
		$this->Email = $_Email;
		$this->URL = $_URL;
		$this->Descripcion = $_Descripcion;
		$this->Precio = $_Precio;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->DocDeporte = $_DocDeporte;
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
		$this->idDeporte = parent::TakePOST('IDDEPORTE');
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->ActoDeportivo = parent::TakePOST('ACTODEPORTIVO');
		$this->FechaInicio = parent::TakePOST('FECHAINICIO');;
		$this->FechaFinal = parent::TakePOST('FECHAFINAL');
		$this->Hora = parent::TakePOST('HORA');
		$this->Lugar = parent::TakePOST('LUGAR');
		$this->Contacto = parent::TakePOST('CONTACTO');
		$this->Telefono = parent::TakePOST('TELEFONO');
		$this->Email = parent::TakePOST('EMAIL');
		$this->URL = parent::TakePOST('URL');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->Precio = parent::TakePOST('PRECIO');
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->DocDeporte = parent::TakePOST('DOCDEPORTE');
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDeporte = parent::TakeGET('IDDEPORTE');
		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->ActoDeportivo = parent::TakeGET('ACTODEPORTIVO');
		$this->FechaInicio = parent::TakeGET('FECHAINICIO');;
		$this->FechaFinal = parent::TakeGET('FECHAFINAL');
		$this->Hora = parent::TakeGET('HORA');
		$this->Lugar = parent::TakeGET('LUGAR');
		$this->Contacto = parent::TakeGET('CONTACTO');
		$this->Telefono = parent::TakeGET('TELEFONO');
		$this->Email = parent::TakeGET('EMAIL');
		$this->URL = parent::TakeGET('URL');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->Precio = parent::TakeGET('PRECIO');
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->DocDeporte = parent::TakeGET('DOCDEPORTE');
		$this->Fecha = parent::TakeGET('FECHA');
	}


}
