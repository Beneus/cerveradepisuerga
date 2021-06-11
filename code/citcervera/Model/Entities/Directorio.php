<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Directorio extends EntityBase implements IEntityBase
{
	private $_tableName = 'Directorio';
	var $idDirectorio;
	var $NombreComercial;
	var $Direccion;
	var $Latitud;
	var $Longitud;
	var $idNucleoUrbano;
	var $Provincia;
	var $CP;
	var $Telefono;
	var $Movil;
	var $Fax;
	var $Email;
	var $URL;
	var $NombreContacto;
	var $Apellido1Contacto;
	var $Apellido2Contacto;
	var $FechaCreacion;
	var $ImgDescripcion;
	var $Descripcion;
	var $Prestaciones;
	var $Fecha;

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
}
