<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Directorio extends EntityBase implements IEntityBase
{
	private $_tableName = 'Directorio';
	private $_id = 'idDirectorio';
	public $idDirectorio;
	public $NombreComercial;
	public $Direccion;
	public $Latitud;
	public $Longitud;
	public $idNucleoUrbano;
	public $Provincia;
	public $CP;
	public $Telefono;
	public $Movil;
	public $Fax;
	public $Email;
	public $URL;
	public $NombreContacto;
	public $Apellido1Contacto;
	public $Apellido2Contacto;
	public $FechaCreacion;
	public $ImgDescripcion;
	public $Descripcion;
	public $Prestaciones;
	public $Fecha;

	function Directorio(
		$_idDirectorio,
		$_NombreComercial,
		$_Direccion,
		$_Latitud,
		$_Longitud,
		$_idNucleoUrbano,
		$_Provincia,
		$_CP,
		$_Telefono,
		$_Movil,
		$_Fax,
		$_Email,
		$_URL,
		$_NombreContacto,
		$_Apellido1Contacto,
		$_Apellido2Contacto,
		$_FechaCreacion,
		$_ImgDescripcion,
		$_Descripcion,
		$_Prestaciones,
		$_Fecha
	) {
		$this->idDirectorio = $_idDirectorio;
		$this->NombreComercial = $_NombreComercial;
		$this->Direccion = $_Direccion;
		$this->Latitud = $_Latitud;
		$this->Longitud = $_Longitud;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Provincia = $_Provincia;
		$this->CP = $_CP;
		$this->Telefono = $_Telefono;
		$this->Movil = $_Movil;
		$this->Fax = $_Fax;
		$this->Email = $_Email;
		$this->URL = $_URL;
		$this->NombreContacto = $_NombreContacto;
		$this->Apellido1Contacto = $_Apellido1Contacto;
		$this->Apellido2Contacto = $_Apellido2Contacto;
		$this->FechaCreacion = $_FechaCreacion;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Descripcion = $_Descripcion;
		$this->Prestaciones = $_Prestaciones;
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
		$this->idDirectorio = parent::TakePOST('IDDIRECTORIO');
		$this->NombreComercial = parent::TakePOST('NOMBRECOMERCIAL',100);
		$this->Direccion = parent::TakePOST('DIRECCION',100);
		$this->Latitud = parent::TakePOST('LATITUD',50);
		$this->Longitud = parent::TakePOST('LONGITUD',50);
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->Provincia = parent::TakePOST('PROVINCIA',50);
		$this->CP = parent::TakePOST('CP',5);
		$this->Telefono = parent::TakePOST('TELEFONO',16);
		$this->Movil = parent::TakePOST('MOVIL',16);
		$this->Fax = parent::TakePOST('FAX',16);
		$this->Email = parent::TakePOST('EMAIL',100);
		$this->URL = parent::TakePOST('URL',255);
		$this->NombreContacto = parent::TakePOST('NOMBRECONTACTO',100);
		$this->Apellido1Contacto = parent::TakePOST('APELLIDO1CONTACTO',50);
		$this->Apellido2Contacto = parent::TakePOST('APELLIDO2CONTACTO',50);
		$this->FechaCreacion = parent::TakePOST('FECHACREACION');
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->Prestaciones = parent::TakePOST('PRESTACIONES',255);
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDirectorio = parent::TakeGET('IDDIRECTORIO');
		$this->NombreComercial = parent::TakeGET('NOMBRECOMERCIAL',100);
		$this->Direccion = parent::TakeGET('DIRECCION',100);
		$this->Latitud = parent::TakeGET('LATITUD',50);
		$this->Longitud = parent::TakeGET('LONGITUD',50);
		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->Provincia = parent::TakeGET('PROVINCIA',50);
		$this->CP = parent::TakeGET('CP',5);
		$this->Telefono = parent::TakeGET('TELEFONO',16);
		$this->Movil = parent::TakeGET('MOVIL',16);
		$this->Fax = parent::TakeGET('FAX',16);
		$this->Email = parent::TakeGET('EMAIL',100);
		$this->URL = parent::TakeGET('URL',255);
		$this->NombreContacto = parent::TakeGET('NOMBRECONTACTO',100);
		$this->Apellido1Contacto = parent::TakeGET('APELLIDO1CONTACTO',50);
		$this->Apellido2Contacto = parent::TakeGET('APELLIDO2CONTACTO',50);
		$this->FechaCreacion = parent::TakeGET('FECHACREACION');
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->Prestaciones = parent::TakeGET('PRESTACIONES',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
